<div>
    <x-jet-form-section submit="save">
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
            <x-jet-button>
                Agregar
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>
