<div class="w-full">
    @if ($payments->count())
        <div>
            <h3 class="font-semibold text-xl">Selecciona tu Tarjeta</h3>
            <p class="text-sm">Estas son tus tarjetas asociadas, selecciona una.</p>

            <x-jet-input-error for="slPayment" class="mt-2"/>
            <select class="select select-secondary block w-full max-w-xs mx-auto mt-1" wire:model="slPayment">
                <option selected value="">Selecciona</option>
                @foreach ($payments as $payment)
                    <option value="{{$payment->id}}">{{ $payment->number .' '. $payment->name}}</option>                
                @endforeach
            </select>

            <div class="divider">O</div>

            <p class="text-sm">Añade una nueva tarjeta</p>
            <button wire:click="$set('openAdd', true)" class="btn btn-outline btn-success btn-sm block mx-auto">
                Añadir
            </button>
        </div>
        <div class="divider"></div>
    @else
        <p class="text-center">No hay tarjetas asociadas, registrala ahora!</p>
        <button class="btn btn-outline btn-success btn-sm block mx-auto my-3" wire:click="$set('openAdd', true)">
            Añadir
        </button>
        <div class="divider"></div>
    @endif

    {{-- Valida si el stock está disponible, muestra botones de acción --}}
    @livewire('checkout.checkout')

    {{-- Notificaciones  --}}
    <div 
        x-data="{ show: false, message: '' }"
        x-cloak
        x-show="show"
        x-transition.scale.origin.right
        x-init="$wire.on('error', $message => { show = true; message = $message; setTimeout(() => { show = false }, 3500) })"
        class="absolute top-14 right-0 rounded bg-red-200 border-l-4 border-red-600 text-slate-700 p-4"
        style="display: none !important;">
            <span x-text="message"></span>
    </div>

    <div 
        x-data="{ show: false, message: '' }"
        x-cloak
        x-show="show"
        x-transition.scale.origin.right
        x-init="$wire.on('nice', $message => { show = true; message = $message ; setTimeout(() => { show = false }, 3500) })"
        class="absolute top-14 right-0 rounded bg-green-200 border-l-4 border-green-600 text-slate-700 p-4"
        style="display: none !important;">
        <span x-text="message"></span>
    </div>
    {{-- Fin Notificaciones --}}

    {{-- Modal --}}
    <x-jet-dialog-modal wire:model="openAdd">
        @slot('title')
            Añadir tarjeta
        @endslot
        @slot('content')
            <div class="p-2">
                <x-jet-input-error for="payment.name" />
                <x-jet-label value="Nombre" />
                <input type="text" wire:model.lazy="payment.name" placeholder="Nombre Tarjeta" class="input input-bordered w-full mb-3">

                <div class="flex flex-wrap gap-3">
                    <div class="flex-1">
                        <x-jet-input-error for="payment.number" />
                        <x-jet-label value="N. Tajeta" />
                        <input type="number" wire:model.lazy="payment.number" placeholder="1234567890" class="input input-bordered w-full mb-3">
                    </div>
                    <div>
                        <x-jet-input-error for="payment.expiration" />
                        <x-jet-label value="Expiracion" />
                        <input type="month" wire:model.lazy="payment.expiration" min="{{ now()->addMonth()->format('Y-m') }}"  class="input input-bordered w-full mb-3">
                    </div>
                </div>

                <div class="flex flex-wrap gap-3">
                    <div>
                        <x-jet-input-error for="payment.doc_type" />
                        <x-jet-label value="Tipo documento" />
                        <select class="select select-bordered w-full max-w-xs" wire:model="payment.doc_type">
                            <option value="">select</option>
                            <option>C.C</option>
                            <option>C.E</option>
                            <option>PASSPORT</option>
                        </select>
                    </div>
                    <div class="flex-1">
                        <x-jet-input-error for="payment.document" />
                        <x-jet-label value="N. Documento" />
                        <input type="number" wire:model.lazy="payment.document" placeholder="1234567890" class="input input-bordered w-full mb-3">
                    </div>
                </div>
            </div>            
        @endslot
        @slot('footer')
            <div>
                <button class="btn btn-sm btn-outline btn-success" wire:click="addPayment">Añadir</button>
                <button class="btn btn-sm btn-error" wire:click="$set('openAdd', false)">Cancelar</button>
            </div>
        @endslot
    </x-jet-dialog-modal>
</div>
