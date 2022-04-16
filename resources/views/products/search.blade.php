<x-app-layout>
    @slot('title')
        Buscar Producto
    @endslot

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-center text-2xl mb-4 font-bold">Woody E-commerce</h1>
            @livewire('products.search')
        </div>
    </div>
</x-app-layout>