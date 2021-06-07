<div x-data>
    <!-- para poder usar alpine hay que poner eso de x-data -->
    <!-- con x-data se consigue que se pueda acceder a cualquier elemento dentro de ese div -->
    <p class="text-xl text-gray-700">  Color: </p>
    <select wire:model="colorSelected" name="" id="" class="form-control-lsg w-full">
        <option value=""  selected disabled> Seleccionar un valor </option>
        @foreach ($colors as $color)
            <!-- lo de __() es para q lo traduzca a ES, debes tenerlo en resources\lang\es.json -->
            <option value="{{ $color->id }}"> {{ __($color->name) }} </option>
        @endforeach
    </select>

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
                wire:click="addItem"
                wire:loading.attr="disabled"
                wire:target="addItem"
                >
                Añadir al carrito de compra
            </x-button-lsg>

        </div>
    </div>

</div>
