<div class="flex items-center" x-data>
    <!-- x-data sirve para poder utilizar alpine en todo lo q englobe esta capa -->
    <x-jet-secondary-button
            x-bind:disabled="$wire.cantidad <= 1"
            wire:loading.attr="disabled"
            wire:target="decrementar"
            wire:click="decrementar"
        >
        -
    </x-jet-secondary-button>

    <span class="mx-2 text-gray-700"> {{ $cantidad }}</span>

    <x-jet-secondary-button
        x-bind:disabled="$wire.cantidad >= {{ $stock }}"
        wire:loading.attr="disabled"
        wire:target="incrementar"
        wire:click="incrementar"
    >
        +
    </x-jet-secondary-button>
</div>
