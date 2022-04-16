<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class ShoppingForm extends Component
{
    public $product;
    public $amount = 1;

    public function mount($productId)
    {
        $this->product = Product::find($productId);
    }

    protected function rules()
    {
        return [
            'amount' => ['required', 'numeric', 'max:'.$this->product->stock ,  'min:1']
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     * Encripta los datos de la compra y redirige a la seleccion de 
     * direccion.
     */
    public function shopSingle()
    {
        $this->validate();

        $data = $this->amount.'|'.$this->product->price;
        $dataCrypt = Crypt::encrypt($data);

        return redirect()->route('buy.single', [$this->product, $dataCrypt]);
    }   

    public function render()
    {
        return view('livewire.products.shopping-form');
    }
}
