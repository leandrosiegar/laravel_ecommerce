<div class="flex-1 relative" x-data>
    <form action="{{ route('search') }} " autocomplete="off">
        <x-jet-input name="nomProductoSearch" wire:model="search" type="text" class="w-full" placeholder="Escribe producto a buscar" />

        <button class="absolute top-0 right-0 w-12 h-full bg-orange-500 flex items-center justify-center rounded-r-md">
            <x-componente-lsg size=35 color=#EEEEEE />
        </button>
    </form>

    <div class="absolute w-full">
        <!-- :class agrega o quita clases dinámicamente a partir de la condición q pongamos -->
        <div class="bg-white rounded-lg shadow mt-1 hidden" :class="{ 'hidden': !$wire.abrir }" @click.away="$wire.abrir = false">
            <div class="px-4 py-3 space-y-1">
                @forelse ($products as $product)
                    <a class="flex" href="{{ route("products.show", $product) }}">
                        <img class="w-16 h-12 object-cover" src="{{ Storage::url($product->images->first()->url) }}" alt="">

                        <div class="ml-4 text-gray-700">
                            <p class="text-lg font-semibold leading-5">{{ $product->name}}</p>
                            <p>Categoría: {{ $product->subcategory->category->name }}</p>
                        </div>

                    </a>
                @empty
                    <p class="text-lg leading-5">No existe ningún producto con esa búsqueda</p>
                @endforelse

            </div>
        </div>

    </div>

</div>
