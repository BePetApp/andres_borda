<div>
    <div class="w-full p-3 flex gap-2 items-center">
        <div>
            <div class="inline-block">
                <x-jet-label value="From" />
                <input type="date" max="{{ now()->subDay()->toDateString() }}" wire:model.defer="dateFrom" id="from">
            </div>

            <div class="inline-block">
                <x-jet-label value="To" />
                <input type="date" wire:model.defer="dateTo" id="to">
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
            <input type="checkbox" @click="message = $event.target.checked ? 'Por Enviar' : 'Enviados';" wire:model="onlyOrders" class="checkbox">
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="table table-compact md:w-4/5 mx-auto">
            <thead>
                <tr>
                    <th></th> 
                    <th>Valor</th> 
                    <th class="cursor-pointer select-none" wire:click="order">
                        Fecha Orden
                        @if ($dir == 'asc')
                            <i class="fa-solid fa-arrow-up-short-wide ml-3"></i>
                        @else
                            <i class="fa-solid fa-arrow-down-short-wide ml-3"></i>
                        @endif
                    </th> 
                    <th></th> 
                </tr>
            </thead> 
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <th>{{ $loop->iteration }}</th> 
                        <td><b>$</b> {{ number_format($order->total_price) }}</td> 
                        <td class="px-5">{{ $order->created_at->format('d-F-Y')}}</td>
                        <td><button class="btn btn-ghost btn-xs" wire:click="openDetails({{$loop->index}})">Detalle</button></td>
                    </tr>   
                @endforeach
            </tfoot>
        </table>
    </div>

    {{-- Modal --}}
    <x-jet-dialog-modal wire:model="openShow">
        @slot('title')
            Detalles de tu compra
        @endslot
        @slot('content')
            <div class="overflow-x-auto">
                @if ($orders->count())
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
</div>
