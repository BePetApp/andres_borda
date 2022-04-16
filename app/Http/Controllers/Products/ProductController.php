<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $rate  = $product->rates->avg('value');
        $media = $product->media()->get();

        // Todas las imagenes (incluyendo la portada)
        $gallery = $media->map(function ($m) {
            return $m->getUrl();
        });
    
        // Todas las 'miniaturas'
        $thumbnails = $media->map(function ($m) {
            return $m->getUrl('thumb');
        });

        // Si alguna de las colecciones está vacia, entocnes se enviará
        // una info random.
        return view('products.show', [            
            'gallery'    => count($gallery) > 0 ? $gallery : collect(['https://api.lorem.space/image/furniture?w=400&h=225']),
            'thumbnails' => count($thumbnails) > 0 ? $thumbnails : collect(['https://api.lorem.space/image/furniture?w=100&h=25']),
            'product'    => $product,
            'rate'       => round($rate, 0),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        return view('products.search');
    }
}
