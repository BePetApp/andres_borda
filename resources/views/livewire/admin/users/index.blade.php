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
    </div>

    @if ($users->count())
        {{-- Paginarion --}}
        <div class="mb-2">
            {{ $users->links() }}
        </div>

        {{-- Tabla --}}
        <div class="overflow-x-auto w-full">
            <table class="table w-full">
              <!-- head -->
                <thead>
                    <tr class="cursor-pointer">
                        <th wire:click="order('id')">
                            {{-- El componente 'table-header' lo que hace es mostrar los iconos de ordenamiento
                             por eso necesita las variables 'orderBy' y 'dir'--}}
                            <x-table-header :field="['id' => '']" :order="$orderBy" :dir="$dir" />
                        </th>
                        <th wire:click="order('name')" class="text-sm">
                            <x-table-header :field="['name' => 'Nombre']" :order="$orderBy" :dir="$dir" />
                        </th> 
                        <th wire:click="order('email')" class="text-sm">
                            <x-table-header :field="['email' => 'Email']" :order="$orderBy" :dir="$dir" />
                        </th> 
                        <th>Estado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    @foreach ($users as $user)
                    <tr class="text-sm">
                        <th>{{ $user->id }}</th>
                        <td>
                            <div class="flex items-center space-x-3">
                            <div class="avatar">
                                <div class="mask mask-squircle w-10 h-10">
                                <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" />
                                </div>
                            </div>
                            <div>
                                <div class="font-bold">{{ $user->name }}</div>
                            </div>
                            </div>
                        </td>
                        <td>
                            {{ $user->email }}
                        </td>
                        <td>
                            <div wire:ignore>
                                <center>
                                    <input type="checkbox" @if ($user->status) checked @endif wire:click.debounce.400ms="changeStatus({{ $user->id }})" class="checkbox">
                                </center>
                            </div>
                        </td>
                        <th>
                            <button class="btn btn-ghost btn-xs" wire:click="editModal({{ $user->id }})">Editar</button>
                        </th>
                    </tr>
                    @endforeach
                </tbody>
                <!-- foot -->
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        {{-- Paginarion --}}
        <div class="mb-2">
            {{ $users->links() }}
        </div>
    @else 
        <p>No hay productos que mostrar</p>
    @endif


        {{------------------------ MODALES ---------------------------}}

{{-- Modal de Edición --}}
<x-jet-dialog-modal wire:model="openEdit">
    <x-slot name="title">
        <h2 class="text-gray-800 text-xl">Modificar Usuario</h2>
    </x-slot>

    <x-slot name="content">
        @if ($errors->any())
        <div class="mb-3">
            <h3 class="text-red-700">Error:</h3>
            @foreach ($errors->all() as $error)
                <p class="text-sm text-red-600">{{ $error }}</p>
            @endforeach
        </div>
        @endif

        <div>
            <x-jet-label for="name" value="Nombre" />
            <input type="text" wire:model.lazy="focusedUser.name" placeholder="Type here" class="input input-bordered w-full">
        </div>

        <div class="mt-3">
            <x-jet-label for="email" value="Email" />
            <input type="email" wire:model.lazy="email" placeholder="email" class="input input-bordered w-full">
        </div>


        <div class="mt-3">
            <x-jet-label for="email" value="Email confirmar" />
            <input type="email" wire:model.lazy="email_confirmation" placeholder="email" class="input input-bordered w-full">
        </div>
        


        <div class="flex gap-4 mt-3">
            <div>
                <x-jet-label for="role" value="Hacer ADMIN" />
                <input type="checkbox" @if ($this->focusedUser->is_admin ?? 0) checked @endif wire:model="focusedUserRoleId" class="checkbox">
            </div>
            @if ($this->focusedUser->is_admin ?? 0) 
                <span class="text-red-600 text-sm">El usuario pasará a ser administrador CUIDADO</span>
            @endif
        </div>
    </x-slot>
    
    <x-slot name="footer">
        <button class="btn btn-outline btn-success mr-2" wire:click="updateUser">
            Actualizar
        </button>
        <button class="btn btn-outline btn-error" wire:click="resetData()">
            Cancelar
        </button>
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
