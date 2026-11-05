<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Categoria
 *
 * @property $id
 * @property $nombreCategoria
 * @property $created_at
 * @property $updated_at
 *
 * @property Producto[] $productos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Categoria extends Model
{
    
    static $rules = [
		'nombreCategoria' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombreCategoria'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productos()
    {
        return $this->hasMany('App\Models\Producto', 'categoria_id', 'id');
    }
    
    // Nueva relación con productos de Deltron
    public function productosDeltron()
    {
        return $this->hasMany(DeltronProducto::class, 'categoria_id');
    }

    // Accessor para combinar productos locales y de Deltron
    public function getTodosLosProductosAttribute()
    {
        return $this->productos->concat($this->productosDeltron);
    }

}
