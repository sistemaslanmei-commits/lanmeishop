<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LibroDeReclamacion;

class ReclamacionesController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'tipo_documento' => 'required|string|in:dni,carnet_extranjeria',
            'numero_documento' => [
            'required',
            'numeric',
            function ($attribute, $value, $fail) use ($request) {
                if ($request->tipo_documento === 'dni' && strlen($value) !== 8) {
                    $fail('El DNI debe tener exactamente 8 dígitos.');
                }
                if ($request->tipo_documento === 'carnet_extranjeria' && strlen($value) < 8) {
                    $fail('El Carnet de Extranjería debe tener al menos 8 dígitos.');
                }
            },
        ],
            'nombre_completo' => 'required|string|regex:/^[a-zA-Z\s]+$/', // Validación que solo permite letras y espacios
            'correo_electronico' => 'required|email',
            'telefono' => 'required|digits:9',
            'tipo_reclamo' => 'required|in:Reclamación,Queja',
            'reclamo' => 'required|string',
            'acepto' => 'accepted', // ✅ Checkbox debe estar marcado
            'politica' => 'accepted', // ✅ Checkbox debe estar marcado
        ]);

        // Guardar la reclamación en la base de datos
        // Guardar el reclamo y obtener el ID generado
        $reclamo = LibroDeReclamacion::create([
            'tipo_documento' => $request->tipo_documento,
            'numero_documento' => $request->numero_documento,
            'nombre_completo' => $request->nombre_completo,
            'correo_electronico' => $request->correo_electronico,
            'telefono' => $request->telefono,
            'tipo_reclamo' => $request->tipo_reclamo,
            'reclamo' => $request->reclamo,
        ]);       

        // Crear el número de ticket
        $ticket = $request->numero_documento . '-' . $reclamo->id;

        return redirect()->back()->with('success', "Reclamo enviado con éxito. TU NRO DE TICKET ES: $ticket");   
    }
}
