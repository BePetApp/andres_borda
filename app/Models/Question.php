<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'answer_id',
        'user_id',
        'product_id',
    ];

    // --- Relationships --- //

    /**
     * Obtiene el usuario al que pertenece
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtiene el producto relacionado
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
