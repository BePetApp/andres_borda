<div>
    <div class="divider"></div>
    <div class="flex justify-end gap-3">
        @if ($showButton)
            <button class="btn btn-outline btn-primary btn-md block mx-auto" wire:click="newOrder">
                Siguiente paso
            </button>
        @endif 
        <a href="{{ route('products.show', $product)}}" class="btn  btn-error lock mx-auto">
            cancelar
        </a>
    </div>
</div>
