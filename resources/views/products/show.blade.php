@php
    $starsRate = [1, 2, 3, 4, 5, 6];
@endphp

<x-app-layout>
    @slot('title')
        {{$product->name}}
    @endslot

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-center text-2xl mb-4 font-bold">Woody E-commerce</h1>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 rounded">

                <!-- Carousel -->
                <div 
                    x-data="{ showPhoto: 0, gallery: {{$gallery}}, thumbnails: {{$thumbnails}} }" 
                    class="p-8 flex flex-col max-w-2xl items-center shadow-gray-800/50 shadow-lg bg-base-100">
                    <div class="flex-1">
                        <template x-for="(photo, index) in gallery" :key="index">
                            <div x-show="index === showPhoto" class="w-full h-72 sm:h-full min-h-fit mx-auto">
                                <img 
                                    :src="photo" 
                                    alt="photo"
                                    class="h-full w-full object-cover object-center rounded shadow-gray-800/30 shadow-md"
                                >
                            </div>
                        </template>
                    </div>
                    <div class="mt-4 p-3 flex gap-1">
                        <template x-for="(phot, index) in thumbnails" :key="'button' + index">
                            <div 
                                class="h-16 w-16 cursor-pointer text-center border border-gray-300 brightness-50 hover:brightness-90 "
                                @click="showPhoto = index">
                                <img :src="phot" alt="ass" class="h-full w-full object-cover object-center">
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Info -->
                <div class="p-8">
                    <article class="prose">
                        <h2 class="heading-2">{{ $product->name }}</h2>
                        <p>{{$product->description}}</p>
                        <ul>
                            <li><b>Precio:</b> ${{ number_format($product->price) }}</li>
                            <li><b>Disponibles en stock:</b> {{ $product->stock }}</li>
                        </ul>
                        <div class="rating">
                            <span class=" mt-0.5 mr-2"><b>Calificacion: </b> {{$rate . ' / 5'}}</span>
                            @foreach ($starsRate as $star)
                                @if ($star == $rate + 1)
                                    <input 
                                        type="radio"
                                        disabled
                                        name="rating-2" 
                                        checked

                                        class="hidden mask mask-star-2 bg-orange-400">
                                @else
                                    <input 
                                    type="radio"
                                    disabled
                                    name="rating-2" 
                                    class="mask mask-star-2 bg-orange-400">
                                @endif

                            @endforeach
                        </div>
                        <div class="divider"></div>
                        @livewire('products.shopping-form', ['productId' => $product->id])
                    </article>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>