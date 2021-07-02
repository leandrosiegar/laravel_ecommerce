<div>
    <div class="bg-white shadow-lg rounded-lg p-6 mt-12">
        <div>
            <x-jet-label>
                Talla
            </x-jet-label>

            <x-jet-input type="text" placeholder="Ingrese una talla" class="w-full" wire:model="name">
            </x-jet-input>

            <x-jet-input-error for="name"></x-jet-input-error>
        </div>

        <div class="flex justify-end items-center mt-4">
            <x-jet-button
                wire:click="guardar"
                wire.loading.attr="disabled"
                wire.target="guardar"
                >
                Agregar
            </x-jet-button>

        </div>
    </div>

    <ul class="mt-12 space-y-4">
        @foreach ($sizes as $size)
            <li class="bg-white shadow-lg rounded-lg p-6" wire:key="size-{{ $size->id }}">
                <div class="flex items-center">
                    <span class="text-xl font-medium"> {{ $size->name }} </span>
                    <div class="ml-auto">
                        <x-jet-button
                            wire:click="edit({{ $size }})"
                            wire:loading.attr="disabled"
                            wire:target="edit({{ $size->id }})"
                        >
                            <i class="fas fa-edit"></i>
                        </x-jet-secondary-button>

                        <x-jet-danger-button wire:click="$emit('deleteSize',{{ $size->id }})">
                            <i class="fas fa-trash"></i>
                        </x-jet-danger-button>


                    </div>
                </div>

                @livewire('admin.color-size', ['size' => $size], key("color_size_".$size->id))


            </li>

        @endforeach
    </ul>

    <x-jet-dialog-modal wire:model="abrirModal">
        <x-slot name="title">
            Editar talla
        </x-slot>

        <x-slot name="content">
            <x-jet-label>
                Talla
            </x-jet-label>
            <x-jet-input type="text"
                class="w-full"
                wire:model="name_edit"
                >
            </x-jet-input>

            <x-jet-input-error for="name_edit"></x-jet-input-error>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button
                wire:click="$set('abrirModal',false)"

                >
                Cancelar
            </x-jet-secondary-button>

            <x-jet-button
                wire:click="actualizar"
                wire:loading.attr="disabled"
                wire:target="actualizar">
                Actualizar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
