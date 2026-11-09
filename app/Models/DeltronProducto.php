<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeltronProducto extends Model
{
   protected $table = 'deltron_productos';

    protected $fillable = [
        'sku',
        'nombre',
        'precio',
        'precio_costo_soles',
        'precio_costo_usd',
        'stock',
        'imagen',
        'categoria_id',
        'marca',
        'especificaciones_html',
        'enlace',
        'enlaceVea'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}
