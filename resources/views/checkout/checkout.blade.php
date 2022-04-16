<x-app-layout>
    @slot('title')
        Gracias por Comprar
    @endslot
    <div class="py-8" style="background-image: url({{ asset('svg/patternpad.svg')}})" >
        <div class="max-w-6xl mx-auto px-3 sm:px-6 lg:px-8">
            <h1 class="text-center text-2xl mb-4 font-bold">Compra hecha correctamente</h1>
            <div class="p-8 bg-base-100 shadow-gray-800/50 shadow-md max-w-sm mx-auto rounded">
                <p class="text-4xl sm:text-5xl text-center italic font-semibold"> Gracias Por Comprar en Woody E-commerce</p>
                <article class="prose mt-5">
                    <p class="text-center">Tu <b>articulo</b> se ha enlistado con exito. Te avisaremos cuando se envie.</p>
                    <a href="{{ route('home') }}" class="btn btn-link block mx-auto">Volver a Inicio</a>
                </article>
            </div>
        </div>
    </div>
</x-app-layout>