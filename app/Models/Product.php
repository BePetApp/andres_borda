<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'stock',
        'wood_type_id',
        'category_id',
    ];

    // --- Media --- //
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('cover')
            ->singleFile();
        
        $this
            ->addMediaCollection('gallery');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
              ->width(268)
              ->height(132)
              ->sharpen(10);
    }

    // --- Relationships --- //

    /**
     * Obtiene el _wooden_type_ al que pertenece
     */
    public function woodType()
    {
        return $this->belongsTo(WoodType::class);
    }

    /**
     * Obtiene la categoria a la que pertenece
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Obtiene los rates que posee
     */
    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    /**
     * Obtiene las preguntas realizadas al producto 
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Obtiene las ordenes en las que está el producto
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class)->using(OrderProduct::class)->withPivot('price', 'quantity');
    }
}
