<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Se obtiene el id y el total $ de los 5 productos con mayor valor en ventas
        $productsId = DB::table('order_product')
                        ->join('products', 'product_id', '=', 'products.id')
                        ->join('orders', 'order_id', '=', 'orders.id')
                        ->select(DB::raw('sum(quantity) as total, products.name'))
                        ->whereDate('orders.created_at', '>', now()->subMonth()->toDateTimeString())
                        ->groupBy('product_id')
                        ->limit(5)
                        ->orderByDesc('total')
                        ->pluck('total', 'products.name');
        
        // Cantidad de usuarios nuevos por mes 
        $users = [];
        for ($i = 1; $i <= 4; $i++) { 
            $userCount = User::whereDate('created_at', '>', now()->subMonths($i)->toDateTimeString())
                ->whereDate('created_at', '<', now()->addDay()->subMonths($i -1)->toDateTimeString())
                ->count();            
            $users[now()->subMonths($i - 1)->format('F')] = $userCount;
        }

        return view('admin.dashboard', [
            'products' => json_decode($productsId, true), 
            'users'    => array_reverse($users),
        ]);
    }
}
