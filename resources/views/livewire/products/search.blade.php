<div class="flex flex-col gap-2">
    <div>
        {{-- Buscar  --}}
        <div class="px-4">
            <input type="text" placeholder="Busca Tu Producto aquí" wire:model.debounce.500ms="search" class="input input-bordered w-full block mx-auto text-center">
        </div>

        <div x-data="{ open: false }">
            <button class="btn btn-link btn-sm w-full" @click="open = !open">Filtros</button>
            <div x-show="open" x-cloak style="display: none !important" class="flex mt-2 gap-2 flex-wrap items-center justify-center p-2 mb-2">
                {{-- Maderas --}}
                <div class="flex gap-2">
                    <div>
                        <span class="text-sm">Madera: </span>
                        <select class="select select-bordered select-xs !h-9 w-full max-w-xs" wire:model="selected.wood">
                            <option value="">select</option>
                            @foreach ($wood as $woodType) 
                                <option value="{{ $woodType->id }}">{{ $woodType->name }}</option>  
                            @endforeach
                        </select>
                    </div>
        
                    {{-- Categorias --}}
                    <div>
                        <span class="text-sm">Categories: </span>
                        <select class="select select-bordered select-xs !h-9 w-full max-w-xs" wire:model="selected.category">
                            <option value="">select</option>
                            @foreach ($categories as $cat) 
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>  
                            @endforeach
                        </select>
                    </div>
                </div>
    
                {{-- Precios --}}
                <div class="flex gap-2">
                    <div>
                        <span class="text-sm">Min. Precio: </span>
                        <input 
                            type="range" 
                            min="{{ $minPrice }}" 
                            max="{{ ($maxPrice / 2) - 100 }}" 
                            wire:model.lazy="selected.minPrice" 
                            class="range range-xs inline-block"
                            oninput="this.nextElementSibling.value = this.value">
                        <output class="text-xs text-center">{{ $selected['minPrice'] }}</output>
                    </div>
    
                    <div>
                        <span class="text-sm">Max. Precio: </span>
                        <input 
                            type="range" 
                            min="{{ $maxPrice / 2 }}" 
                            max="{{ $maxPrice }}" 
                            class="range range-xs range-primary" 
                            wire:model.lazy="selected.maxPrice"
                            oninput="this.nextElementSibling.value = this.value">
                        <output class="text-xs text-center">{{ $selected['maxPrice'] }}</output>
                    </div>
                </div>
    
                {{-- Limpiar filtros --}}
                <button class="btn btn-outline btn-sm" wire:click="cleanFilters">
                    Limpiar
                </button>
            </div>
        </div>
    </div>

    {{--
        Cambiar la cantidad de productos mostrados por pagina 
        dependiendo del tamaño de la pantalla
    --}}
    <div x-data="{ width: window.innerWidth, pp: @entangle('perPage') }"
        x-init=" if (width < 767) {
            pp = 8;
        }"
        @resize.window="
            width = window.innerWidth;
            if (width < 767) {
                pp = 8;
            }
            else {
                pp = 16;
            }
        "
    >
    </div>

    {{-- Productos --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-x-2 gap-y-4 p-3">
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
                    <p class="text-sm">{{ substr($product->description, 0, 70) . '...' }}</p>
                    <ul class="text-xs">
                        <li>Cat.: {{$product->category->name}}</li>
                        <li>Madera: {{$product->woodType->name}}</li>
                    </ul>
                    <div class="card-actions justify-end items-center">
                        <span class="text-sm">$ {{ number_format($product->price) }}</span>
                        <a href="{{ route('products.show', $product) }}" class="btn btn-primary">Ver</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div>
        {{$products->links()}}
    </div>
</div>
