<x-app-layout>
    @slot('title')
        Home
    @endslot
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-center text-2xl">Woody E-commerce</h1>
            <form action="{{ route('products.search')}}" class="px-3" method="get">
                <input type="text" placeholder="Busca Tu Producto aquí" name="search" class="input input-bordered w-full max-w-md block mx-auto text-center mb-2">
            </form>

            {{-- <input type="text" placeholder="Busca Tu Producto aquí" class="input input-bordered w-full block mx-auto text-center max-w-xs my-4"> --}}
            <div class="text-center mb-4 px-3">
                @foreach ($categories as $cat)
                    <a href="{!! route('products.search', ['selected[category]' => $cat->id]) !!}" class="badge badge-secondary hover:shadow-md">{{ $cat->name }}</a>                
                @endforeach
            </div>

            {{-- Productos destacados --}}
            
                <div class="p-5 my-4">
                    <h3 class="text-3xl font-bold">Productos destacados:</h3>
                    <p class="text-gray-500 text-sm mb-3">Echa un vistazo a nuestros productos populares: </p>
                </div>
                <div class="gap-4 grid p-8 pt-0 sm:p-0 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 max-w-5xl mx-auto">
                    @foreach ($products as $product)
                        <div class="card w-full bg-base-100 shadow-xl mr-5">
                            <figure>
                                    @if($product->getFirstMedia('cover'))
                                        <img src="{{$product->getFirstMedia('cover')->getUrl()}}" alt="Shoes" />
                                    @else
                                        <img src="https://api.lorem.space/image/furniture?w=400&h=225" alt="Shoes" /> 
                                    @endif
                                </figure>
                            <div class="card-body">
                                <h2 class="card-title">{{$product->name}}</h2>
                                <p>{{ substr($product->description, 0, 70) . '...' }}</p>
                                <div class="card-actions justify-end items-center">
                                    <span class="text-sm">$ {{ number_format($product->price) }}</span>
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-primary">Ver</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
    

            {{-- Mas Madera --}}
            <div class="hero min-h-max mt-20 mb-10">
                <div class="hero-content flex-col lg:flex-row-reverse">
                    @if($woodProduct->getFirstMedia('cover'))
                        <img 
                            src="{{$woodProduct->getFirstMedia('cover')->getUrl()}}" 
                            class="h-96 w-full md:w-3/5 lg:w-80 object-cover object-center shadow-gray-700/60 shadow-md rounded" alt="Shoes" />
                    @else
                        <img 
                            src="https://api.lorem.space/image/furniture?w=400&h=225" 
                            class="h-96 w-full md:w-3/5 lg:w-80 object-cover object-center shadow-gray-700/60 shadow-md rounded" alt="Shoes" /> 
                    @endif
                  {{-- <img src="https://api.lorem.space/image/furniture?w=260&h=400" class="max-w-sm rounded-lg shadow-2xl" /> --}}
                  <div>
                    <h1 class="text-5xl font-bold">Madera {{ $woodProduct->woodType->name }}!</h1>
                    <h2 class="font-semibold italic">{{$woodProduct->name}}</h2>
                    <p class="py-6">{{$woodProduct->description}}</p>
                    <a href="{{ route('products.search', ['selected[wood]' => $woodProduct->wood_type_id]) }}" class="btn btn-primary">Ver nuevos crafts</a>
                  </div>
                </div>
            </div>

            
            {{-- Category --}}
            <div class="p-5 mx-4">
                <h3 class="text-3xl font-bold">Nuevos en {{ $lastReleased->category->name}}:</h3>
                <p class="text-gray-500 mb-3">Echa un vistazo a este producto: </p>
            </div>
            <div class="card lg:card-side bg-base-100 shadow-xl my-0 mx-4">
                @if ($lastReleased->getFirstMedia('cover'))
                    <figure><img src="{{ $lastReleased->getFirstMedia('cover')->getUrl() }}" class="w-full max-h-60 lg:h-96 lg:w-80 lg:max-h-max object-cover" alt="Album"></figure>
                @else
                    <figure><img src="https://api.lorem.space/image/furniture?w=400&h=400" alt="Album"></figure>
                @endif
                <div class="card-body">
                    <h2 class="card-title">{{ $lastReleased->name}}</h2>
                    <p>{{ $lastReleased->description }}</p>
                    <div class="card-actions justify-end items-center">
                        <span class="text-sm">$ {{ number_format($lastReleased->price) }}</span>
                        <a class="btn btn-primary" href="{{ route('products.show', $lastReleased )}}">Ver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
