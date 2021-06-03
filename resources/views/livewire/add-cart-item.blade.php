<div x-data>
    <!-- con x-data se consigue que se pueda acceder a cualquier elemento dentro de ese div -->

    <p class="text-gray-700 mb-4">
        <span class="font-semibold text-lg">
            Stock disponible:
        </span>
       {{ $stock }}

    </p>
    <div class="flex">
        <div class="mr-4">
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
        <div class="flex-1"> <!-- con flex-1 ocupa todo el ancho posible que quede -->
            <x-button-lsg color="orange" class="w-full">
                Añadir al carrito de compra
            </x-button-lsg>

        </div>
    </div>
</div>
