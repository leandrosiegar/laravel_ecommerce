<!-- estas en resources\views\welcome.blade.php -->
<x-app-layout class="container">

    @if (Session::has('pendiente'))
        <div id="divPendiente" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Pedidos pendientes</strong>
            <span class="block sm:inline">
                Tienes {{ $pendiente }} pedidos todavía pendientes <a class='font-bold' href='{{ route('orders.index') }}?status=1'>Ir a pagar</a>
            </span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-red-500" role="button" onclick="closeAlert(event)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title>
                <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>
    @endif

    @if (Session::has('mensaje'))
        <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
             <p class="font-bold">Mensaje</p>
             <p>{{ Session::get('mensaje') }}</p>
      </div>
    @endif

    <div class="container py-8">
        @foreach ($categories as $category)
            <section class="mb-6">
                <div class="flex items-center mb-2">
                    <h1 class="text-lg uppercase font-semibold text-gray-700">
                        {{ $category->name }}
                    </h1>

                    <a href="{{ route('categories.show', $category) }}" class="text-orange-500 ml-2 font-semibold hover:text-orange-400 hover:underline">Ver más</a>
                </div>


                @livewire('div-category-products', ['category' => $category])
            </section>
        @endforeach


    </div>


    @push("scripts")
        <script>


            function closeAlert(event){
                $("#divPendiente").hide();
            }

            // se ejecutará cuando se llama con emit a ejecutarGlider
            Livewire.on('ejecutarGlider', function(id) {
                new Glider(document.querySelector('.glider-'+id), {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    draggable: true,
                    dots: '.glider-'+id + '~ .dots',
                    arrows: {
                        prev: '.glider-'+id + '~ .glider-prev',
                        next: '.glider-'+id + '~ .glider-next'
                    },
                    responsive: [
                        {
                            breakpoint:  640,
                            settings: {
                                slidesToShow: 2.5,
                                slidesToScroll: 2,

                            }
                        },
                        {
                            breakpoint:  768,
                            settings: {
                                slidesToShow: 3.5,
                                slidesToScroll: 3,

                            }
                        },
                        {
                            breakpoint:  1024,
                            settings: {
                                slidesToShow: 4.5,
                                slidesToScroll: 4,

                            }
                        },
                        {
                            breakpoint:  1280,
                            settings: {
                                slidesToShow: 5.5,
                                slidesToScroll: 5,

                            }
                        },
                    ]
                });
            });
        </script>
    @endpush

</x-app-layout>
