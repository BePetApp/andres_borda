<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UserAddresses extends Component
{
    public $slAddress;
    public $openAdd = false;
    public $address = [
        'town' => '',
        'neighborhood' => '',
        'house' => '',
    ];

    protected $rules = [
        'address.*' => 'required'
    ];

    protected $messages = [
        'address.*.*' => 'El campo es obligatorio'
    ];

    /**
     * Valida si la direccion seleccionada es valida
     */
    public function updatedSlAddress()
    {
        $this->emit('selectedAddress');

        $this->validate([
            'slAddress' => 'required|numeric|exists:addresses,id'
        ], ['slAddress.*' => 'Debes seleccionar una direccion valida']);

        // Evento a livewire/CreateOrder
        $this->emit('selectedAddress', $this->slAddress);
    }

    // Añade una nueva direccion
    public function addAddress()
    {
        $this->validate();
        
        try {
            \App\Models\Address::create([
                'user_id' => auth()->id(),
                'town'    => $this->address['town'],
                'house'   => $this->address['house'],
                'neighborhood'    => $this->address['neighborhood'],
            ]);
    
            $this->reset('openAdd', 'address');
            $this->emit('nice', 'Direccion registrada correctamente!');

        } catch (\Throwable $th) {
            $this->emit('error', 'No se ha podidio resgistrar la direccion');
        }
    }

    public function render()
    {
        $addresses = auth()->user()->addresses;

        return view('livewire.user-addresses', [
            'addresses' => $addresses
        ]);
    }
}
