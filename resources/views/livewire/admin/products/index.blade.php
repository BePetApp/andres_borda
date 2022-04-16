<div>
    {{-- filtros --}}
    <div class="flex mb-4 gap-2 flex-wrap">
        <div class="form-control w-full sm:max-w-xs inline-block">
            <label class="label">
              <span class="label-text">Buscar producto:</span>
            </label>
            <input type="text" placeholder="Type here" wire:model="search" class="input input-bordered w-full">
        </div>
        <div class="form-control max-w-xs inline-block">
            <label class="label">
              <span class="label-text">Por pagina:</span>
            </label>
            <select class="select select-bordered w-full max-w-xs" wire:model="perPage">
                <option>10</option>
                <option>20</option>
                <option>30</option>
                <option>40</option>
                <option>50</option>
                <option>80</option>
                <option>100</option>
            </select>
        </div>
        <div class="form-control max-w-xs inline-block float-right">
            <label class="label">
              <span class="label-text">Crear producto:</span>
            </label>
            <button class="btn btn-outline btn-info mr-2 w-full" wire:click="createModal">
                Crear
            </button>
        </div>
    </div>
    
    @if ($products->count())

        <div class="mb-2">
            {{ $products->links() }}
        </div>
        <div class="overflow-x-auto mb-4">
            <table class="table table-compact w-full" style="table-layout: auto !important;">
                <thead>
                    <tr class="cursor-pointer">
                        <th wire:click="order('id')">
                            
                            {{-- El componente 'table-header' lo que hace es mostrar los iconos de ordenamiento
                             por eso necesita las variables --}}

                            <x-table-header :field="['id' => '']" :order="$orderBy" :dir="$dir" />
                        </th> 
                        <th wire:click="order('name')" class="text-sm">
                            <x-table-header :field="['name' => 'Nombre']" :order="$orderBy" :dir="$dir" />
                        </th> 
                        <th wire:click="order('price')" class="text-sm">
                            <x-table-header :field="['price' => 'Precio']" :order="$orderBy" :dir="$dir" />
                        </th> 
                        <th wire:click="order('stock')" class="text-sm">
                            <x-table-header :field="['stock' => 'Stock']" :order="$orderBy" :dir="$dir" />
                        </th> 
                        <th></th> 
                    </tr>
                </thead> 
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <th>{{$product->id}}</th>
                            <td>{{$product->name}}</td>
                            <td class="px-6"><b>$ </b>{{ number_format($product->price) }}</td>
                            <td class="px-8">{{$product->stock}}</td>
                            <td>
                                <div class="relative" x-data="{ openOptions: false }">
                                    <button
                                    @click="openOptions = ! openOptions" 
                                    class="btn btn-outline btn-success btn-sm w-full focus:ring-4 focus:border-green-600 focus:ring-green-600 focus:bg-green-500 focus:text-green-200">
                                        Acciones
                                    </button>
                                    <div 
                                        x-show="openOptions" 
                                        x-cloak
                                        class="absolute -top-2"
                                        @click.away="openOptions = false"
                                        style="display: none !important; left: -8.3rem;">

                                        <ul class="menu bg-base-100 w-32 rounded-box shadow-lg text-gray-50" data-theme="dark">
                                            <li @clic="openOptions = false"><button wire:click="editModal({{$product->id}})">Editar</button></li>
                                            <li><button wire:click="mediaModal({{$product->id}})">Galeria</button></li>
                                            <li><button wire:click="deleteModal({{$product->id}})" class="bg-red-500 hover:bg-red-600">Eliminar</button></li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="mt-2">
            {{ $products->links() }}
        </div>
    @else 
        <p>No hay productos que mostrar</p>
    @endif



    {{------------------------ MODALES ---------------------------}}

{{-- Modal de Edición --}}
<x-jet-dialog-modal wire:model="openEdit">
    <x-slot name="title">
        <h2 class="text-gray-800 text-xl">{{ $method }} Producto</h2>
    </x-slot>

    <x-slot name="content">
        <div>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
        <x-jet-label for="name" value="Nombre" />
        <input type="text" wire:model.defer="focusedProduct.name" placeholder="Type here" class="input input-bordered w-full">

        <div class="grid grid-cols-2 gap-4 my-2">
            <div>
                <x-jet-label for="stock" value="Stock" />
                <input type="number" wire:model="focusedProduct.stock" placeholder="Stock" class="input input-bordered w-full max-w-xs">
            </div>
            <div>
                <x-jet-label for="price" value="Precio" />
                <input type="number" wire:model.defer="focusedProduct.price" placeholder="Precio" class="input input-bordered w-full max-w-xs">
            </div>
        </div>

        <x-jet-label for="description" value="Descripcion"  />
        <textarea class="textarea textarea-bordered w-full" wire:model.defer="focusedProduct.description" placeholder="Bio"></textarea>

        <div class="grid grid-cols-2 gap-4 my-2">
            <div>
                <x-jet-label for="category_id" value="Categoria" />
                <select class="select select-bordered w-full max-w-xs" wire:model.defer="focusedProduct.category_id">
                    <option disabled selected>Categoria</option>
                    @foreach ($categories as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                    @endforeach
                    </select>
            </div>
            <div>
                <x-jet-label for="wood_type_id" value="Madera" />
                <select class="select select-bordered w-full max-w-xs" wire:model.defer="focusedProduct.wood_type_id">
                    <option disabled selected>Madera</option>
                    @foreach ($maderas as $item => $value)
                        <option value="{{$item}}">{{$value}}</option>
                    @endforeach
                    </select>
            </div>
        </div>
    </x-slot>
    
    <x-slot name="footer">
        <button class="btn btn-outline btn-success mr-2" wire:click="updateProduct">
            {{ $method }}
        </button>
        <button class="btn btn-outline btn-error" wire:click="resetData()">
            Cancelar
        </button>
    </x-slot>
</x-jet-dialog-modal>

{{-- Modal Eliminacion --}}
<x-jet-confirmation-modal wire:model="openDelete">
    <x-slot name="title">
        <h2 class="text-red-800 text-xl">Eliminar Producto</h2>
    </x-slot>
    <x-slot name="content">
        <div>
            <p><b>Estas a punto de eliminar:</b> <span class="italic text-sm"> {{ $focusedProduct->name ?? ''}}</span></p>
            <ul class="text-sm list-disc list-inside">
                <li><b>Precio: </b><span class="italic text-sm">{{ number_format($focusedProduct->price ?? 0) }}</span></li>
                <li><b>Stock: </b><span class="italic text-sm">{{ $focusedProduct->stock ?? ''}}</span></li>
                <li><b>Descripcion: </b><span class="italic text-sm">{{ $focusedProduct->description ?? ''}}</span></li>
            </ul>
        </div>
    </x-slot>
    <x-slot name="footer">
        <button class="mr-2 px-4" wire:click="deleteProduct">
            ELIMINAR
        </button>
        <button class="btn btn-outline btn-error" wire:click="resetData()">
            Cancelar
        </button>
    </x-slot>
</x-jet-confirmation-modal>

{{-- Images --}}
<x-jet-dialog-modal wire:model="openGallery">
    <x-slot name="title">
        <h2 class="text-gray-800 text-xl">Galeria</h2>
    </x-slot>

    <x-slot name="content">
        <div x-data="{ openTab: 'index' }">
            <div class="tabs">
                <a 
                    class="tab tab-lifted" 
                    x-on:click="()=> { openTab = 'index'; $dispatch('eve', 'index') }" 
                    x-bind:class="openTab === 'index' ? 'tab-active' : ''"
                    >Imagenes</a> 

                <a 
                    class="tab tab-lifted" 
                    x-on:click="()=> { openTab = 'create'; $dispatch('eve', 'create') }" 
                    x-bind:class="openTab === 'create' ? 'tab-active' : ''"
                    >Subir Imagen</a> 
            </div>
            <div class="p-4">
                <div x-show="openTab == 'index'">
                    @if ($this->focusedProduct)
                        <div x-data wire:ignore>
                            <p>Portada:</p>
                            <div class="flex flex-wrap justify-center gap-1 my-2">
                                @php
                                $proCover = $this->focusedProduct->getFirstMedia('cover');
                                $proGallery = $this->focusedProduct->getMedia('gallery');
                                @endphp
                                {{-- Si el producto tiene portada entonces muestramela --}}
                                @if (!is_null($proCover)) 
                                    <div class="indicator" x-ref="image{{ $proCover->id }}">
                                        <span 
                                            class="indicator-item badge badge-secondary cursor-pointer" 
                                            x-on:click="() => {
                                                $wire.deleteMedia({{$proCover->id}});
                                                $refs.image{{$proCover->id}}.remove();
                                            }">
                                            {{-- wire:click="deleteMedia({{$proCover->id}})"> --}}
                                            <i class="fa-solid fa-xmark"></i>
                                        </span> 
                                        <img 
                                            class="object-cover h-24 w-24 sm:h-32 sm:w-32 rounded shadow-sm inline-block" 
                                            src="{{ $proCover->getUrl() }}
                                        ">
                                    </div>
                                @endif
                            </div>

                            <div class="divider"></div>

                            <p>Galeria:</p>
                            <div class="flex flex-wrap justify-center gap-1 my-2">

                                {{-- Si el producto tiene alguna foto en gallery entonces muestramela --}}
                                @if (count($proGallery))
                                    @foreach ($proGallery as $photo)
                                        <div class="indicator" x-ref="image{{ $photo->id }}">
                                            <span 
                                                class="indicator-item badge badge-secondary cursor-pointer"
                                                x-on:click="() => {
                                                    $wire.deleteMedia({{$photo->id}});
                                                    $refs.image{{$photo->id}}.remove();
                                                }">
                                                <i class="fa-solid fa-xmark"></i>
                                            </span> 
                                            <img 
                                                class="object-cover h-24 w-24 sm:h-32 sm:w-32 rounded shadow-sm inline-block" 
                                                src="{{ $photo->getUrl() }}
                                            ">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Upload Gallery photos --}}
                <div x-show="openTab == 'create'">
                    <form wire:submit.prevent="saveGallery" id="uploadMedia">

                        <x-jet-label for="cover" value="Portada" />
                        <input type="file" name="cover" wire:model="cover" accept="image/jpeg,image/png" class="block w-full text-xs text-slate-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-sky-50 file:text-sky-700
                            hover:file:bg-sky-100
                        "/>
                        @error('cover')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @else
                            @if ($cover)
                                <img class="w-24 h-24 sm:w-32 sm:h-32 object-cover mx-auto mt-2 shadow" src="{{ $cover->temporaryUrl() }}">
                            @endif
                        @enderror

                        <div class=" divider"></div>

                        <x-jet-label for="gallery" value="Galeria" />
                        <input type="file" name="gallery" wire:model="gallery" multiple accept="image/jpeg,image/png" class="block w-full text-xs text-slate-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-violet-50 file:text-violet-700
                            hover:file:bg-violet-100
                        "/>

                        @error('gallery.*')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @else
                            @if ($gallery)
                                <div class="flex flex-wrap justify-center gap-1 my-2">
                                    @foreach ($gallery as $item)
                                        <img 
                                            class="object-cover h-24 w-24 sm:h-32 sm:w-32 rounded shadow-sm inline-block" 
                                            src="{{ $item->temporaryUrl() }}">
                                    @endforeach
                                </div>
                            @endif
                        @enderror
                    </form>
                </div>
            </div>
        </div>
    </x-slot>
    
    <x-slot name="footer">
        <div x-data="{ tab: ''}" @eve.window="tab = $event.detail">
            <div x-show="tab === 'create'" class="inline">
                <button type="submit" form="uploadMedia" class="btn btn-outline btn-success mr-2 text-xs sm:text-sm">
                    Establecer
                </button>
            </div>
            <button class="btn btn-outline btn-error text-xs sm:text-sm" wire:click="resetData()">
                Cancelar
            </button>
        </div>

    </x-slot>
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
    x-init="$wire.on('nice', $message => { show = true; message = $message ; setTimeout(() => { show = false }, 3500) })"
    class="absolute top-14 right-0 rounded bg-green-200 border-l-4 border-green-600 text-slate-700 p-4"
    style="display: none !important;">
    <span x-text="message"></span>
</div>
</div>
