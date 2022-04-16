<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WoodType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    // --- Relationships --- //

    /**
     * Obtiene los productos relacionados a este _WoodType_
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
