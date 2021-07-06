<div>
    <x-jet-form-section submit="save" class="mb-6">
        <x-slot name="title">
            Crear nueva categoría
        </x-slot>

        <x-slot name="description">
            Complete la información necesaria para poder crear una nueva categoría
        </x-slot>

        <x-slot name="form">
            <!-- por defecto el slot form lo divide 6 columna -->
            <div class="col-span-6 sm:col-span-4">

                <x-jet-label>
                    Nombre
                </x-jet-label>
                <x-jet-input type="text" class="w-full mt-1" wire:model="createform.name"></x-jet-input>
                <x-jet-input-error for="createform.name"></x-jet-input-error>

                <x-jet-label>
                    Slug
                </x-jet-label>
                <x-jet-input type="text" disabled class="w-full mt-1 bg-gray-100" wire:model="createform.slug"></x-jet-input>
                <x-jet-input-error for="createform.slug"></x-jet-input-error>

                <x-jet-label>
                    Icono
                </x-jet-label>
                <x-jet-input type="text" class="w-full mt-1" wire:model.defer="createform.icon"></x-jet-input>
                <x-jet-input-error for="createform.icon"></x-jet-input-error>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Marcas
                </x-jet-label>
                <div class="grid grid-cols-4">
                    @foreach($brands as $brand)
                        <x-jet-label>
                            <x-jet-checkbox
                            wire:model.defer="createform.brands"
                            name="brands[]"
                            value="{{ $brand->id}}"
                            >
                            </x-jet-checkbox>
                            {{ $brand->name }}
                        </x-jet-label>
                    @endforeach
                </div>
                <x-jet-input-error for="createform.brands"></x-jet-input-error>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Imagen
                </x-jet-label>

                <input type="file" class="mt-1" accept="image/*" wire:model="createform.image" id="{{ $rand }}">
                <x-jet-input-error for="createform.image"></x-jet-input-error>
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                Categoría creada correctamente
            </x-jet-action-message>

            <x-jet-button>
                Agregar
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>



    <x-jet-action-section>
        <x-slot name="title">
            Lista de categorías
        </x-slot>
        <x-slot name="description">
            Aquí encontrará todas las categorías existentes
        </x-slot>
        <x-slot name="content">
            <table class="text-gray-600">
                <thead class="border-b border-gray-300">
                    <tr class="text-left">
                        <th class="py-2 w-full">Nombre</th>
                        <th class="py-2">Acción</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300">
                    @foreach ($categories as $category)
                        <tr>
                            <td class="py-2">
                                <span class="inline-block w-8 text-center mr-2">
                                    <!-- { y !! para que ejecute el html y no el texto -->
                                    {!! $category->icon !!}
                                </span>

                                <span class="uppercase">
                                    {{ $category->name }}
                                </span>
                            </td>
                            <td class="py-2">
                                <div class="flex divide-x divide-gray-300 font-semibold">
                                    <a class="pr-2 hover:text-blue-600 cursor-pointer;">Editar</a>
                                    <a class="pl-2 hover:text-red-600 cursor-pointer;" wire:click="$emit('deleteCategory','{{$category->slug}}')">Eliminar</a>

                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </x-slot>
    </x-jet-action-section>


