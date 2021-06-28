<div>
    <div class="my-12 bg-white shadow-lg rounded-lg p-6">
        <!-- color -->
        <div class="mb-6">
            <x-jet-label>
                Color
            </x-jet-label>
            <div class="grid grid-cols-6 gap-6">
                @foreach ($colors as $color)
                    <label for="">
                        <input type="radio"
                            name="color_id"
                            id=""
                            value="{{ $color->id }}"
                            wire:model.defer="color_id">
                        <span class="ml-2 text-gray-700 capitalize">
                            {{ __($color->name) }}
                        </span>
                    </label>

                @endforeach
            </div>
            <x-jet-input-error for="color_id"></x-jet-input-error>

        </div>

        <!-- cantidad -->
        <div class="">
            <x-jet-label>Cantidad</x-jet-label>
            <x-jet-input
                class="w-full"
                type="number"
                wire:model.defer="quantity"
                placeholder="Ingrese una cantidad">
            </x-jet-input>
            <x-jet-input-error for="quantity"></x-jet-input-error>
        </div>

        <div class="flex justify-end items-center mt-4">
            <x-jet-action-message class="mr-3" on="guardado">
                Dado de alta correctamente
            </x-jet-action-message>

            <x-jet-button
                wire:loading.attr="disabled"
                wire:target="guardar"
                wire:click="guardar"
            >
                  Dar de alta
            </x-jet-button>
        </div>
    </div>

    @if ($product_colors->count())
        <div class="bg-white shadow-lg rounded-lg p-6">
            <table>
                <thead>
                    <tr>
                        <th class="px-4 py-2 w-1/3">Color</th>
                        <th class="px-4 py-2 w-1/3">Cantidad</th>
                        <th class="px-4 py-2 w-1/3"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product_colors as $product_color)
                    <!-- wire:key es para poder identificar ese tr en concreto por si queremos luego manipularlo lo q sea -->
                        <tr wire:key="product_color_{{$product_color->pivot->id}}">
                            <td class="capitalize px-4 py-2">
                                {{ __($colors->find($product_color->pivot->color_id)->name) }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $product_color->pivot->quantity }} Unidades
                            </td>
                            <td class="px-4 py-2 flex">
                                <!-- a editar le pasamos el id de la tabla intermedia -->
                                <x-jet-secondary-button
                                    class="ml-auto mr-2"
                                    wire:click="editar({{$product_color->pivot->id}})"
                                    wire:loading.attr="disabled"
                                    wire:target="editar({{$product_color->pivot->id}})"
                                    >
                                    Actualizar
                                </x-jet-secondary-button>

                                <x-jet-danger-button
                                    wire:click="$emit('deletePivot',{{$product_color->pivot->id}})">
                                    Eliminar
                                </x-jet-danger-button>
                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>

        </div>
    @endif


    <x-jet-dialog-modal wire:model="abrirModal">
        <x-slot name="title">
            Editar colores
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label>Color</x-jet-label>
                <select class="form-control w-full" wire:model="pivot_color_id">
                    <option value="">Seleccione un color</option>
                    @foreach ($colors as $color)
                        <option value="{{$color->id}}"> {{ ucfirst(__($color->name)) }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <x-jet-label>Cantidad</x-jet-label>
                <x-jet-input
                    class="w-full"
                    wire:model="pivot_quantity"
                    type="number"
                    placeholder="ingrese una cantidad">
                </x-jet-input>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button
                wire:click="$set('abrirModal',false) ">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-button
                wire:click="actualizar"
                wire:loading.attr="disabled"
                wire:target="actualizar"
                >
                Actualizar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>

@push("scripts")
<script>
    Livewire.on('deletePivot', pivotId => {
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('borrar', pivotId)
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            }
        })
    });


</script>

@endpush
