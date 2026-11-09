<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Models\DeltronProducto;
use App\Models\Categoria;

class SyncDeltronCatalog extends Command
{
    /**
     * El nombre y firma del comando en la consola.
     *
     * @var string
     */
    protected $signature = 'deltron:sync-catalog';

    /**
     * La descripción del comando.
     *
     * @var string
     */
    protected $description = 'Autentica con caché de 23h y sincroniza el catálogo masivo de Deltron';

    /**
     * Ejecuta el comando de consola.
     */
    public function handle()
    {
        // Ampliar memoria y tiempo límite de ejecución para procesos pesados
        ini_set('memory_limit', '512M');
        set_time_limit(1800); // 30 minutos máximos

        $baseUrl = config('services.deltron.base_url');
        $apiKey  = config('services.deltron.key');
        $secret  = config('services.deltron.secret');

        $this->info('1. Obteniendo token de autenticación (Caché / API)...');

        try {
            // Reutilizar token por 23 horas (82,800 segundos) para prevenir error HTTP 429
            $token = Cache::remember('deltron_bearer_token', 82800, function () use ($baseUrl, $apiKey, $secret) {
                $authResponse = Http::post($baseUrl . '/api/auth/token', [
                    'api_key'    => $apiKey,
                    'api_secret' => $secret
                ]);

                if ($authResponse->failed() || ($authResponse->json('status') !== 'ok')) {
                    throw new \Exception('Falló la autenticación con Deltron. HTTP Status: ' . $authResponse->status());
                }

                $result = $authResponse->json('result');
                if (isset($result['client_ip'])) {
                    $this->info('IP detectada por Deltron: ' . $result['client_ip']);
                }

                return $result['token'];
            });
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            return 1;
        }

        $this->info('2. Descargando catálogo masivo (/api/catalogo)...');

        $catalogResponse = Http::timeout(300)
            ->withToken($token)
            ->get($baseUrl . '/api/catalogo');

        // Si el token expira o es rechazado (HTTP 401), se borra la caché para obligar regeneración
        if ($catalogResponse->status() === 401) {
            Cache::forget('deltron_bearer_token');
            $this->error('Token rechazado (401). Caché limpiada, vuelve a ejecutar el comando.');
            return 1;
        }

        if ($catalogResponse->failed() || ($catalogResponse->json('status') !== 'ok')) {
            $this->error('Error al descargar el catálogo. Código HTTP: ' . $catalogResponse->status());
            return 1;
        }

        $data = $catalogResponse->json('result');
        $tipoCambio = $data['currency_change_val'] ?? 3.80;
        $items = $data['items'] ?? [];
        $margenGanancia = 0.25; // Margen de ganancia comercial del 25%

        $this->info('3. Procesando ' . count($items) . ' productos del catálogo...');

        foreach ($items as $item) {
            // Crear o vincular a la categoría correspondiente
            $categoria = Categoria::firstOrCreate([
                'nombreCategoria' => trim($item['category_name'] ?? 'General')
            ]);

            // Consolidar stock total de todos los almacenes
            $stockTotal = 0;
            if (isset($item['stock']['almacenes']) && is_array($item['stock']['almacenes'])) {
                foreach ($item['stock']['almacenes'] as $alm) {
                    $stockTotal += $alm['cantidad'] ?? 0;
                }
            }

            // 1. Seleccionar precio base en USD (promoción o regular)
            $tienePromo = !empty($item['promocion_activa']) && !empty($item['price_promo']);
            $precioBaseUSD = $tienePromo ? $item['price_promo'] : ($item['price'] ?? 0);

            // 2. Costo del proveedor en Soles con IGV 18% (Ej: S/ 100.00)
            $precioConIgvUSD = $precioBaseUSD * 1.18;
            $precioCostoSoles = round($precioConIgvUSD * $tipoCambio, 2);

            // 3. Precio de Venta al Público (+25% sobre el costo en soles) (Ej: S/ 125.00)
            $precioVentaFinal = round($precioCostoSoles * (1 + $margenGanancia), 2);

            // 4. Insertar o actualizar registro por SKU
            DeltronProducto::updateOrCreate(
                ['sku' => $item['sku']],
                [
                    'nombre'                => $item['name'] ?? 'Producto sin nombre',
                    'precio'                => $precioVentaFinal, // Se muestra en la web (S/ 125.00)
                    'precio_costo_soles'    => $precioCostoSoles, // Costo del proveedor (S/ 100.00)
                    'precio_costo_usd'      => $precioBaseUSD,
                    'stock'                 => $stockTotal,
                    'imagen'                => $item['images']['image_listado'] ?? null,
                    'categoria_id'          => $categoria->id,
                    'marca'                 => $item['brand_name'] ?? null,
                    'especificaciones_html' => $item['specs']['specs_all_html'] ?? null,
                    'enlace'                => 'https://wa.me/51905467384?text=' . urlencode('Hola, deseo consultar por el producto [' . ($item['sku'] ?? '') . '] ' . ($item['name'] ?? '')),
                    'enlaceVea'             => null
                ]
            );
        }

        $this->info('¡Sincronización del catálogo de Deltron completada con éxito!');
        return 0;
    }
}