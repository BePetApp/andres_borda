<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'number',
        'expiration_date',
        'document_type',
        'document',
        'user_id',
    ];

    // --- Relationships --- //

    /**
     * Obtiene el usuario al que pertenece
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
