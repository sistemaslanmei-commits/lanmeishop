<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaModel extends Model
{
    use HasFactory;
    protected $table = 'categorias';
    protected $fillable = ['nombreCategoria'];

    public function productos()
    {
        return $this->hasMany(ProductoModel::class, 'categoria_id');
    }
}
