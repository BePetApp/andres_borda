<x-app-layout>
    @slot('title')
        Comprar
    @endslot

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-center text-2xl mb-4 font-bold">Datos Necesarios</h1>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 rounded">
                <div class="p-4">
                    <article class="prose">
                        <h2 class="heading-2">{{ $product->name }}</h2>
                        @if ($product->getFirstMedia('cover'))
                            <img 
                                src="{{ $product->getFirstMedia('cover')->getUrl()}}" 
                                class="w-52 h-32 object-cover object-center rounded shadow-md mx-auto" alt="{{$product->slug}}">
                        @else
                            <img 
                                src="https://api.lorem.space/image/furniture?w=400&h=225" 
                                class="w-52 h-32 object-cover object-center rounded shadow-md mx-auto" alt="{{$product->slug}}">
                        @endif

                        <p>{{substr($product->description, 0, 100).'...'}}</p>
                        <ul>
                            <li><b>Precio:</b> ${{ number_format($price) }}</li>
                            <li><b>Cantidad a comprar:</b> {{ $amount }}</li>
                            <li class="mt-3"><b>Subtotal:</b> ${{ number_format($price * $amount) }}</li>
                        </ul>
                    </article>
                </div>

                <div class="p-4 bg-base-100 rounded shadow-md shadow-gray-800/50 flex flex-col justify-center gap-2">
                    @livewire('user-addresses')
                    @livewire('create-order', ['amount' => $amount, 'price' => $price])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>