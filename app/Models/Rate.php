<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'body',
        'product_id',
    ];

    // --- Relationships --- //
    
    /**
     * Obtiene el producto al que le dieron el rate
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Obtiene el usuario que hizo el rate
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
