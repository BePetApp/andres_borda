<?php

namespace App\Http\Livewire;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class UserPayments extends Component
{
    public $data;
    public $slPayment;
    public $productSlug;
    public $openAdd = false;
    public $payment = [
        'name' => '',
        'number' => '',
        'expiration' => '',
        'doc_type' => '',
        'document' => '',
    ];

    protected $listeners =['render'];

    protected $validationAttributes = [
        'payment.name'       => 'Name',
        'payment.number'     => 'Number',
        'payment.expiration' => 'Expiration Date',
        'payment.doc_type'   => 'Document Type',
        'payment.document'   => 'Identification',
    ];

    protected function rules()
    {
        return [
            'payment.name'       => 'required',
            'payment.number'     => 'required|max:12|min:12|unique:payments,number|regex:/^[0-9]*$/i',
            'payment.expiration' => 'required|date|after_or_equal:'. now()->addMonth()->toDateTimeString(),
            'payment.doc_type'   => 'required|in:C.C,C.E,PASSPORT',
            'payment.document'   => 'required|max:15|min:8|regex:/^[0-9]*$/',
        ];
    }

    public function mount()
    {
        $this->productSlug = request()->route('product');
        $this->data        = request()->route('data');
    }

    /**
     * Validacion en tiempo real
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     * Valida si se selecciono un 'payment' valido.
     * Si si lo es, envia el id a otro componente livewire
     */
    public function updatedSlPayment()
    {   
        $this->emit('showCheckout', null);

        $this->validate([
            'slPayment' => 'required|numeric|exists:payments,id'
        ], ['slPayment.*' => 'Debes seleccionar una tarjeta valida']);

        $this->emit('showCheckout', $this->slPayment);
    }

    // Añade una tarjeta nueva 
    public function addPayment()
    {
        $this->validate();

        try {
            \App\Models\Payment::create([
                'user_id'          => auth()->id(),
                'name'             => $this->payment['name'],
                'number'           => $this->payment['number'],
                'expiration_date'  => Carbon::parse($this->payment['expiration'])->toDateTimeString(),
                'document'         => $this->payment['document'],
                'document_type'    => $this->payment['doc_type'],
            ]);
            $this->reset('payment', 'openAdd');
            $this->emit('nice', 'Tajeta añadida con exito!');
        } catch (\Throwable $th) {
            $this->openAdd = false;
            $this->emit('error', 'Ha ocurrido un error, intenta más tarde. Lo lamento.');
        }
    }

    public function render()
    {
        $payments = auth()->user()->payments;

        return view('livewire.user-payments', [
            'payments' => $payments
        ]);
    }
}
