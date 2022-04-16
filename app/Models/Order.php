<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'address_id',
        'total_price'
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
     * Obtiene la direccion a la cual será enviada la orden
     */
    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * Obtiene los productos asociados por medio de una relacion
     * muchos a muchos
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)->using(OrderProduct::class)->withPivot('price', 'quantity');
    }
}
