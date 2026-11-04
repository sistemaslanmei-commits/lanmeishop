<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoModel extends Model
{
    use HasFactory;
    protected $table ='productos';
    protected $fillable = ['nombre', 'imagen', 'precio', 'stock', 'categoria_id','enlace','enlaceVea'];

    public function categoria()
    {
        return $this->belongsTo(CategoriaModel::class, 'categoria_id');
    }
}
