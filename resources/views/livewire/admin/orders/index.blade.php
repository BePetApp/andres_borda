<div>
    <div class="w-full p-3 flex gap-2 items-center">
        <div>
            <div class="inline-block">
                <x-jet-label value="From" />
                <input type="date" max="{{ now()->subDay()->toDateString() }}" id="from" wire:model.defer="dateFrom">
            </div>

            <div class="inline-block">
                <x-jet-label value="To" />
                <input type="date" id="to" wire:model.defer="dateTo">
            </div>
        </div>
        <div>
            <x-jet-label value="Buscar fechas" />
            <button class="btn btn-outline btn-info" wire:click="$refresh">
                Buscar 
                <i class="fa-solid fa-magnifying-glass ml-3"></i>
            </button>
        </div>
        <div x-data="{ message: 'Por Enviar'}">
            {{-- <x-jet-label value="Por enviar" /> --}}
            <span class="block font-medium text-sm text-gray-700" x-text="message"></span>
            <input 
                type="checkbox" 
                {{-- message = $event.target.checked ? 'Por Enviar' : 'Enviados'; --}}
                x-on:click="
                        if ($event.target.checked ) {
                        message = 'Por enviar';
                        $dispatch('order-message', 'Ordenes por enviar');
                        } else {
                        message = 'Enviados';
                        $dispatch('order-message', 'Ordenes Enviadas');
                        }
                        " 
                wire:model="onlyOrders" class="checkbox">
        </div>
    </div>

    <div x-data="{ message: 'Ordenes por enviar'}" @order-message.window="message =  $event.detail">
        <p class="text-lg text-red-900 italic">Mostrando: <span class="font-semibold" x-text="message">Ordenes por enviar</span></p>
    </div>
    
    <div class="p-3">
        {{ $orders->links() }}
    </div>
    <div class="overflow-x-auto">
        <table class="table table-compact md:w-4/5 mx-auto">
            <thead>
                <tr>
                    <th></th> 
                    <th class="cursor-pointer select-none" wire:click="order('total_price')">
                        <x-table-header :field="['total_price' => 'Valor']" :order="$orderField" :dir="$dir" />
                    </th> 

                    <th class="cursor-pointer select-none" wire:click="order('created_at')">
                        <x-table-header :field="['created_at' => 'Fecha']" :order="$orderField" :dir="$dir" />
                    </th> 
                    <th></th> 
                </tr>
            </thead> 
            <tbody>
                @foreach ($orders as $order)
                    <tr class="hover">
                        <th>{{ $loop->iteration + ($orders->currentPage() == 1 ? 0 : ($orders->currentPage() - 1) * 15) }}</th> 
                        <td><b>$</b> {{ number_format($order->total_price) }}</td> 
                        <td class="px-5">{{ $order->created_at->format('d-F-Y')}}</td>
                        <td><button class="btn btn-ghost btn-xs" wire:click="openDetails({{$loop->index}})">Detalle</button></td>
                    </tr>   
                @endforeach
            </tfoot>
        </table>
    </div>

    <x-jet-dialog-modal wire:model="openShow">
        @slot('title')
            Detalles del Pedido
        @endslot
        @slot('content')
            <div class="overflow-x-auto">

                {{-- Se hace la validacion para evitar errores en la primera carga  --}}
                @if ($orders->count())
                    <div class="p-3 pt-0 mb-3">
                        Extra info:
                        <ul class=" list-inside list-disc text-sm">
                            <li><b>Cliente:</b> {{ $orders[$n]->user->name}}</li>
                            <li><b>Documento Cliente:</b> {{ $orders[$n]->user->document }}</li>
                            <li><b>Ubicacion:</b> 
                                {{ $orders[$n]->address->town}} | {{ $orders[$n]->address->house}} | {{ $orders[$n]->address->house }}
                            </li>
                        </ul>
                        <div class="form-control max-w-min">
                            <label class="label cursor-pointer">
                                <span class="label-text whitespace-nowrap mr-3 text-lg font-semibold">Marcar como enviado</span> 
                                <input type="checkbox" class="checkbox" @if ($orders[$n]->trashed()) checked="checked" @endif wire:click="sentOrder({{ $orders[$n]->id }})">
                            </label>
                        </div>
                    </div>
                    <table class="table table-compact w-full">
                        <thead>
                        <tr>
                            <th></th> 
                            <th>Nombre</th> 
                            <th>Cantidad</th> 
                            <th>Precio</th> 
                        </tr>
                        </thead> 
                        <tbody>
                                @foreach ($orders[$n]->products as $product)
                                    <tr>
                                        <th>
                                            @if ($product->getFirstMedia('cover'))
                                                <img src="{{ $product->getFirstMedia('cover')->getUrl('thumb') }}" class="h-10 w-10 object-cover object-center rounded-full shadow mx-auto" alt="">
                                            @else
                                                <img src="https://api.lorem.space/image/furniture?w=100&h=25" class="h-10 w-10 object-cover object-center rounded-full shadow mx-auto" alt="">
                                            @endif
                                        </th> 
                                        <td><a class="hover:text-orange-300" href="{{ route('products.show', $product)}}" target="_blank">{{ $product->name }}</a></td> 
                                        <td>{{ $product->pivot->quantity }}</td> 
                                        <td><b>$ </b>{{ number_format($product->pivot->price) }}</td> 
                                    </tr>
                                @endforeach
                        </tbody> 
                        <tfoot>
                        <tr>
                            <th></th> 
                            <th></th> 
                            <th>Total:</th> 
                            <th><b>$ </b>{{ number_format($orders[$n]->total_price) }}</th> 
                        </tr>
                        </tfoot>
                    </table>
                @endif
            </div>        
        @endslot
        @slot('footer')
            <div>
                <button class="btn btn-sm btn-error" wire:click="$set('openShow', false)">Cerrar</button>
            </div>
        @endslot
    </x-jet-dialog-modal>

            {{----------------------- Message  ---------------------------}}
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
        x-init="$wire.on('alert', $message => { show = true; message = $message; setTimeout(() => { show = false }, 3500) })"
        class="absolute top-14 right-0 rounded bg-amber-200 border-l-4 border-amber-600 text-slate-700 p-4"
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
</div>
