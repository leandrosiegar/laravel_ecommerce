<x-app-layout>
    <!-- estas en resources\views\orders\payment.blade.php -->
    <div class="containerLSG py-8">
        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6">
            <p class="text-gray-700 uppercase">
                <span class="font-semibold">Número de orden:</span> Orden-{{ $order->id }}
            </p>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <div class="grid grid-cols-2 gap-6 text-gray-700">
                <div>
                    <p class="text-lg font-semibold uppercase">Envío</p>
                    @if ($order->envio_type == 1)
                        <p class="text-sm">Los productos deben ser recogidos en tienda</p>
                        <p class="text-sm">C/ falsa, 123</p>
                    @else
                        <p class="text-sm">Los productos serán enviados a:</p>
                        <p class="text-sm">{{ $order->address }}</p>
                        <p>{{ $order->departamento->name }} - {{ $order->ciudad->name }} - {{ $order->distrito->name }}</p>
                    @endif
                </div>

                <div>
                    <p class="text-lg font-semibold uppercase">Datos de contacto</p>
                    <p class="text-sm">Persona que recibirá el producto: {{ $order->contact }}</p>
                    <p class="text-sm">Teléfono de contacto: {{ $order->phone }}</p>


                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 text-gray-700 mb-6">
            <p class="text-xl font-semibold mb-4">Resumen</p>

            <table class="table-auto w-full">
                <thead class="">
                    <th></th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($items as $item)
                        <tr>
                            <td>
                                <div class="flex">
                                    <img class="h-15 w-20 object-cover mr-4" src="{{ $item->options->rutaImagen }}" alt="">
                                    <article>
                                        <h1 class="font-bold"> {{ $item->name }}</h1>
                                        <div class="flex text-xs">
                                            @if ($item->options->color_id)
                                                Color: {{ __($item->options->color_name) }}
                                            @endif
                                            @if ($item->options->size_id)
                                               - {{ __($item->options->size_name) }}
                                            @endif
                                        </div>
                                    </article>
                                </div>
                            </td>

                            <td class="text-center">{{ $item->price }} €</td>
                            <td class="text-center">{{ $item->qty }} </td>
                            <td class="text-center">{{ $item->price * $item->qty}} €</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 flex justify-between items-center">
            <div class="w-1/2">
                <form action="/pagar_por_stripe" method="post" id="payment-form">
                    @csrf
                    <input type="hidden" name="cantidadPagar" value="{{ $order->total * 100 }}">
                    <input type="hidden" name="descPago" value="Orden-{{ $order->id }} | {{ $order->contact }} | {{ $order->phone }} ">
                    <img class="h-8" src="{{ asset('img/iconosTarjCredito.jpg') }}" alt="">
                    <label for="card-element">
                        Introduce tu tarjeta de crédito:
                    </label>
                    <div id="card-element"></div>
                    <div id="card-errors" role="alert"></div>
                    <div class="mt-4">
                        <x-button-lsg color="green"> Realizar el pago </x-button-lsg>
                    </div>
                </form>
            </div>



            <div class="text-gray-700">
                <p class="text-sm font-semibold">
                    Subtotal: {{ $order->total - $order->shipping_cost }} €
                </p>
                <p class="text-sm font-semibold">
                    Costes de envío: {{ $order->shipping_cost }} €
                </p>
                <p class="text-lg font-semibold uppercase">
                    Total: {{ $order->total }} €


                </p>


            </div>

        </div>



    </div>



    @push("scripts")
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            var stripe = Stripe("{{ config('services.stripe.key') }}");
            var elements = stripe.elements();

            // crear la tarjeta
            var style = {
                base: {
                    // Add your base input styles here. For example:
                    fontSize: '16px',
                    color: '#32325d',
                },
                };
            var card = elements.create('card', {style: style});
            card.mount('#card-element');

            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                // Submit the form
                form.submit();
            }

            // Create a token or display an error when the form is submitted.
            var form = document.getElementById('payment-form');
                form.addEventListener('submit', function(event) {
                    event.preventDefault();

                    stripe.createToken(card).then(function(result) {
                        if (result.error) {
                        // Inform the customer that there was an error.
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                        } else {
                        // Send the token to your server.
                        console.log(result.token.id);
                        stripeTokenHandler(result.token);
                        }
                    });
                });
        </script>

    @endpush
</x-app-layout>


