<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    /**
     * Los campos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    /**
     * Relación: una categoría tiene muchos productos.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
