<x-app-layout>
    @slot('title')
        Mis Compras
    @endslot

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-center text-2xl mb-4 font-bold">Mis Compras</h1>
        </div>
        <div class="p-2 max-w-6xl mx-auto">
            @livewire('users.orders')
        </div>
    </div>
</x-app-layout>