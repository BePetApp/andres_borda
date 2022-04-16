<?php

namespace App\Http\Livewire\Users;

use App\Models\Order;
use Livewire\Component;

class Orders extends Component
{
    public $data;
    public $dateTo;
    public $dateFrom;

    public $n = 0;
    public $dir = 'desc';
    public $openShow = false;
    public $onlyOrders = true;

    public function mount()
    {
        $this->dateFrom = now()->subMonth()->toDateString();
        $this->dateTo   = now()->toDateString();
    }

    public function openDetails($index)
    {
        $this->n = $index;
        $this->openShow = true;
    }

    public function order()
    {
        $this->dir = $this->dir == 'desc' ? 'asc' : 'desc';
    }

    public function render()
    {
        $data = Order::query()->whereHas('products');

        if (! $this->onlyOrders) {
            $data->onlyTrashed();
        }

        $orders = $data->where('user_id', auth()->id())
                ->with('products')
                ->orderBy('created_at', $this->dir)
                ->whereDate('created_at', '>=',$this->dateFrom . ' 00:00:00')
                ->whereDate('created_at', '<=',$this->dateTo . ' 24:59:00')
                ->get();    
    // dd($data);                
        return view('livewire.users.orders', compact('orders'));
    }
}
