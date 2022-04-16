<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class ShoppingController extends Controller
{
    /**
     * Retorna la página de seleccion de direccion (domicilio).
     * 
     * @param Product $product
     * @param str $data
     * 
     * @return view 
     */
    public function singleShopping(Product $product, $data)
    {
        try {
            $data =  Crypt::decrypt($data);
            $data = explode('|', $data);
        } catch (\Throwable $th) {
            abort(403);
        }

        $amount = $data[0];
        $price  = $data[1];

        return view('checkout.single-product', [
            'product' => $product,
            'price'   => $price,
            'amount'  => $amount,
        ]);
    }

    /**
     * Retorna la página de seleccion de tarjeta.
     * 
     * @param Product $product
     * @param str $data
     * 
     * @return view 
     */
    public function paymentSingleProduct(Product $product, $data)
    {
        try {
            $data =  Crypt::decrypt($data);
            $data = explode('|', $data);
        } catch (\Throwable $th) {
            abort(403);
        }
        
        $shopData = [
            'amount'  => $data[0],
            'price'   => $data[1],
            'address' => $data[2],
        ];

        return view('checkout.payment', [
            'product' => $product,
            'shopData'=> $shopData,
        ]);
    }

    /**
     * Envia un email con información de la compra al usuario.
     * 
     * @param str $data
     * 
     * @return void
     */
    public function sendEmail($data)
    {
        try {
            $data =  Crypt::decrypt($data);
        } catch (\Throwable $th) {
            abort(403);
        }

        $order = Order::findOrFail($data);

        $orderMessage = (new OrderShipped($order))->onQueue('mails');
        Mail::to(auth()->user())->queue($orderMessage);

        return redirect()->route('basic.checkout');
    }

    /**
     * Retorna pagina de agradecimiento por la compra
     * 
     * @return view 
     */
    public function basicCheckout()
    {
        return view('checkout.checkout');
    }
}
