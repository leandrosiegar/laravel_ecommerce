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
                <x-jet-input type="text" class="w-full mt-1"></x-jet-input>

                <x-jet-label>
                    Slug
                </x-jet-label>
                <x-jet-input type="text" class="w-full mt-1"></x-jet-input>

                <x-jet-label>
                    Icono
                </x-jet-label>
                <x-jet-input type="text" class="w-full mt-1"></x-jet-input>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Marcas
                </x-jet-label>
                <div class="grid grid-cols-4">
                    @foreach($brands as $brand)
                        <x-jet-label>
                            <x-jet-checkbox></x-jet-checkbox>
                            {{ $brand->name }}
                        </x-jet-label>
                    @endforeach
                </div>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-jet-label>
                    Imagen
                </x-jet-label>

                <input type="file" class="mt-1" name="" id="">
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-jet-button>
                Agregar
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>