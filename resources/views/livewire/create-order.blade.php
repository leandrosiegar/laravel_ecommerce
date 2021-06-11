<div class="containerLSG py-8 grid grid-cols-5 gap-6">
    <div class="col-span-3">

        <div class="bg-white rounded-lg shadow p-6">
            <div class="mb-4">
                <x-jet-label value="Nombre de contacto"> </x-jet-label>
                <x-jet-input type="text"
                    placeholder="Ingrese el nombre de la persona que recibirá el producto"
                    class="w-full"
                    >
                </x-jet-input>
            </div>

            <div>
                <x-jet-label value="Teléfono de contacto"> </x-jet-label>
                <x-jet-input type="text"
                    placeholder="Ingrese un número de teléfono"
                    class="w-full"
                    >
                </x-jet-input>
            </div>

        </div>

        <!-- ENVIOS -->
        <!-- cuando pones x-data ya no puedes usar Alpine dentro de todo ese div -->
        <!-- con entangle se le asigna el valor q tenga la propiedad envio_type (por defecto 1) -->
        <div x-data="{ envio_type: @entangle('envio_type') }">
            <p class="mt-6 mb-3 text-lg text-gray-700 font-semibold">
                Envíossss
            </p>

            <label class="bg-white rounded-lg shadow px-6 py-4 flex items-center mb-4">
                <input x-model="envio_type" type="radio" name="envio" value="1" class="text-gray-600">
                <span class="ml-2 text-gray-700">
                    Recoger en tienda (Calle loquesea 5A)
                </span>

                <span class="font-semibold text-gray-700 ml-auto">
                    Gratis
                </span>
            </label>

            <div class="bg-white rounded-lg shadow">
                <label class="px-6 py-4 flex items-center">
                    <input x-model="envio_type" type="radio" name="envio" value="2" class="text-gray-600">
                    <span class="ml-2 text-gray-700">
                        Envío a Domicilio
                    </span>
                </label>

                <div class="px-6 pb-6 grid-cols-2 gap-6 hidden" :class="{ 'hidden': envio_type != 2 }">
                    <!-- Departamentos -->
                    <div>
                        <x-jet-label value="Departamento"></x-jet-label>
                        <select class="form-control-lsg" wire:model="departamento_id">
                            <option value="" disabled selected> Seleccione un departamento</option>
                            @foreach ($departamentos as $departamento)
                                <option value="{{$departamento->id}}"> {{$departamento->name}}</option>
                            @endforeach

                        </select>
                    </div>

                     <!-- ciudades -->
                     <div>
                        <x-jet-label value="Ciudad"></x-jet-label>
                        <select class="form-control-lsg" wire:model="ciudad_id">
                            <option value="" disabled selected> Seleccione una ciudad</option>
                            @foreach ($ciudades as $ciudad)
                                <option value="{{$city->id}}"> {{$city->name}}</option>
                            @endforeach

                        </select>
                    </div>

                    <!-- distritos -->
                    <div>
                        <x-jet-label value="Distrito"></x-jet-label>
                        <select class="form-control-lsg" wire:model="distrito_id">
                            <option value="" disabled selected> Seleccione un distrito</option>
                            @foreach ($distritos as $distrito)
                                <option value="{{$distrito->id}}"> {{$distrito->name}}</option>
                            @endforeach

                        </select>
                    </div>

                    <!-- dirección -->
                    <div>
                        <x-jet-label value="Dirección"></x-jet-label>
                        <x-jet-input type="text" class="w-full" wire:model="address">
                        </x-jet-input>
                    </div>

                    <!-- dirección -->
                    <div class="col-span-2">
                        <x-jet-label value="Referencia"></x-jet-label>
                        <x-jet-input type="text" class="w-full" wire:model="reference">
                        </x-jet-input>
                    </div>


                </div>
            </div>
        </div>

        <div>
            <x-jet-button class="mt-6 mb-4 ">
                Continuar con la compra
            </x-jet-button>

            <hr>

            <p class="text-sm text-gray-700 mt-2">Al aceptar este envío aceptas nuestra política de privacidad
                <a href="" class="font-semibold text-orange-500">Política y privacidad</a>
            </p>
        </div>

    </div>

    <div class="col-span-2">
        <div class="bg-white rounded-lg shadow p-6">
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

                                @if($item->options["color_id"] != null)
                                    <p class="mx-2">- Color: {{ __($item->options["color_name"]) }}</p>
                                @endif

                                @if($item->options["size_id"] != null)
                                    <p> {{ __($item->options["size_name"]) }}</p>
                                @endif

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

            <hr class="mt-4 mb-3">

            <div class="text-gray-700">
                <p class="flex justify-between items-center">
                    Subtotal:
                    <span class="font-semibold"> {{ Cart::subtotal() }} €</span>
                </p>
                <p class="flex justify-between items-center">
                    Envío:
                    <span class="font-semibold"> xxxx </span>
                </p>

                <hr class="mt-4 mb-3">

                <p class="flex justify-between items-center font-semibold">
                    <span class="text-lg">Total:</span>
                     xxxx €
                </p>



            </div>

        </div>

    </div>


</div>
