<div >
    <div>
        <p class="text-xl text-gray-700">Talla: </p>

        <select wire:model="sizeSelected" class="form-control-lsg w-full">
            <option value="" selected disabled> Seleccione una talla</option>
            @foreach ($sizes as $size)
                <option value="{{ $size->id }}"> {{ $size->name }}</option>

            @endforeach
        </select>
    </div>

    <div class="mt-2">
        <p>STOCKKK: {{ $stock}} </p>

        <p class="text-xl text-gray-700">Color: </p>

        <select wire:model="colorSelected" class="form-control-lsg w-full">
            <option value="" selected disabled> Seleccione un color</option>
            @foreach ($colors as $color)
                <option value="{{ $color->id }}"> {{ $color->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="flex mt-4">
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
            <!-- mientras stock esté a false (a cero) que esté disabled -->
            <x-button-lsg
                color="orange" class="w-full"
                x-bind:disabled="!wire.stock"
                >
                Añadir al carrito de compra
            </x-button-lsg>

        </div>
    </div>

</div>
