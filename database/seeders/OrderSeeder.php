<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i=0; $i < 10 ; $i++) { 
            $address = \App\Models\Address::inRandomOrder()->first();
            $product =\App\Models\Product::where('stock', '>', 0)->inRandomOrder()->limit(1)->first();

            $quantity = rand(1, $product->stock);
            $price = $product->price;

            \App\Models\Order::create([
                'user_id'     => $address->user_id,
                'address_id'  => $address->id,
                'total_price' => $quantity * $price,
            ])->products()->attach($product->id, [
                'quantity' => $quantity,
                'price'    => $price
            ]);
        }
    }
}
