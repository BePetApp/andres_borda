<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    // --- Relationships --- //

    /**
     * Obtiene los productos que pertenecen a la categoria
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
