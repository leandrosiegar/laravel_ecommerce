<div>
    <x-jet-dropdown width="96">
        <x-slot name="trigger">
            <span class="relative inline-block cursor-pointer">
                <x-carrito color="white" size="30" />
                @if (Cart::count())
                    <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold
                        leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                        {{ Cart::count() }}
                    </span>
                @else
                    <span class ="absolute top-0 right-0 inline-block w-2 h-2 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full"></span>
                @endif
        </x-slot>

        <x-slot name="content">
            <ul>
                <!-- forelse es exactamente igual q foreach solo q si no hay nada en la colección entonces te muestra lo
                    que haya en el else -->
                @forelse (Cart::content() as $item)
                    <li class="flex p-2 border-b border-gray-200"> <!-- siempre flex para q todo se coloque al costado (a la derecha y no para abajo) -->
                        <img class="h-15 w-20 object-cover mr-4" src="{{ $item->options->rutaImagen }}" alt="">
                        <article class="flex-1"> <!-- flex-1 para q  ocupe todo el ancho disponible -->
                            <h1 class="font-bold">{{ $item->name }}</h1>
                            <div class="flex"> <!-- flex lo coloca siempre al costa (a la derecha y no para abajo) -->
                                <p>Cant: {{ $item->qty }}</p>
                                @isset($item->options["color"])
                                    <p class="mx-2">- Color: {{ __($item->options["color"]) }}</p>
                                @endisset

                                @isset($item->options["size"])
                                    <p>- {{ __($item->options["size"]) }}</p>
                                @endisset

                            </div>

                            <p>€ {{ $item->price }}</p>

                        </article>
                    </li>
                @empty
                    <li class="py-6 px-4">
                        <p class="text-center text-gray-700">
                            No tiene todavía agregado nada al carrito
                        </p>
                    </li>
                @endforelse
            </ul>

            @if (Cart::count())
                <div class="py-2 px-3">
                    <p class="text-lg text-gray-700 mt-2 mb-3">
                        <span class="font-bold">Total:</span> € {{ Cart::subtotal() }}
                    </p>

                    <x-btn-custom-enlace color="orange" class="w-full">
                        Ir al carrito de compra
                    </x-btn-custom-enlace>

                </div>

            @endif

        </x-slot>

    </x-jet-dropdown>
</div>
