<div class="flex justify-center gap-3">
    @if ($showCheckoutButton)
        <button class="btn btn-outline btn-primary btn-md" wire:click="checkout">
            Finalizar Compra
        </button>
    @endif
    <a href="{{ route('products.show', $product )}}" class="btn btn-error">
        cancelar
    </a>

    <div 
    x-data="{ show: false, message: '' }"
    x-cloak
    x-show="show"
    x-transition.scale.origin.right
    x-init="$wire.on('NoStock', $message => { show = true; message = $message; setTimeout(() => { show = false }, 20000) })"
    class="fixed top-14 right-0 rounded bg-red-200 border-l-4 border-red-600 text-slate-700 p-4"
    style="display: none !important;">
        <span x-text="message"></span>
    </div>
</div>
