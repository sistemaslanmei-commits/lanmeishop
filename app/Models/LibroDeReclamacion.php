<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibroDeReclamacion extends Model
{
    use HasFactory;

    // Si el nombre de la tabla no es plural, indícalo aquí
    protected $table = 'libro_de_reclamaciones';

    // Campos que pueden ser asignados en masa
    protected $fillable = [
        'tipo_documento',
        'numero_documento',
        'nombre_completo',
        'correo_electronico',
        'telefono',
        'tipo_reclamo',
        'reclamo',
    ];
}
