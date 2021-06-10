<div class="containerLSG py-8">
   <section class="bg-white rounded-lg shadow-lg p-6 text-gray-700">
       <h1 class="text-lg font-semibold mb-6">
           CARRITO DE COMPRA
       </h1>
       @if (Cart::count())
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th></th>
                        <th>Precio</th>
                        <th>Cant</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach (Cart::content() as $item)
                        <tr>
                            <td>
                                <div class="flex">
                                    <img class="h-15 w-20 object-cover mr-4" src="{{ $item->options->rutaImagen }}" alt="">
                                    <div>
                                        <p class="font-bold">
                                            {{ $item->name }}
                                        </p>
                                        <!-- lo de __() es para traduciarlo a ES -->
                                        @if ($item->options->color_name)
                                            <span class="mr-1">Color: {{ __($item->options->color_name) }}</span>
                                        @endif

                                        @if ($item->options->size_name)
                                            <span> - {{ __($item->options->size_name) }}</span>
                                        @endif
                                    </div>
                                </div>

                            </td>

                            <td class="text-center">
                                <span>€ {{ $item->price }}</span>
                                <a class="ml-6 cursor-pointer hover:text-red-600"
                                    wire:click="borrarItem('{{ $item->rowId }}')"
                                    wire:loading.class="text-red-600 opacity-25"
                                    wire:target="borrarItem('{{ $item->rowId }}')"
                                    >
                                    <i class="fas fa-trash"></i>

                                </a>
                            </td>

                            <td class="text-center">
                                <div class="flex justify-center">
                                    <!-- $item->rowId es el id que Cart da a cada elemento del carrito -->
                                    @if ($item->options->size_name) <!-- prod con color y size -->
                                        @livewire('update-cart-item-color-size', ['rowId' => $item->rowId], key($item->rowId))
                                    @elseif ($item->options->color_name) <!-- prod solo con color -->
                                        @livewire('update-cart-item-color', ['rowId' => $item->rowId], key($item->rowId))
                                    @else <!-- prod sin color y sin size -->
                                        @livewire('update-cart-item', ['rowId' => $item->rowId], key($item->rowId))
                                    @endif
                                </div>
                            </td>

                            <td class="text-center">

                                € {{ $item->price * $item->qty }}
                            </td>
                        </tr>

                    @endforeach

                </tbody>
                </table>


            <a class="text-sm cursor-pointer hover:underline mt-3 inline-block" wire:click="borrarCarrito" >
                <i class="fas fa-trash"></i>
                Borrar carrito de compra
            </a>
       @else
            <div class="flex flex-col items-center">
                <!-- x-carrito dibuja el icono del carrito -->
                <x-carrito color="black" ></x-carrito>

                <p class="text-lg text-gray-700 mt-4">Tu carrito de compra está vacío</p>

                <x-btn-custom-enlace href="/" class="mt-4 px-16"> Ir al inicio </x-btn-custom-enlace>
            </div>

       @endif



   </section>

   @if (Cart::count())
        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mt-4">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-700">
                        <span class="font-bold text-lg">
                            TOTAL:
                        </span>
                        € {{ Cart::subTotal() }}
                    </p>
                </div>

                <div>
                     <x-btn-custom-enlace href="{{ route('orders.create')}}">
                         Continuar
                     </x-btn-custom-enlace>
                </div>

            </div>

        </div>

   @endif
</div>
