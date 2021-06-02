<!-- estas en resources\views\welcome.blade.php -->
<x-app-layout class="container">

    <div class="container py-8">
        @foreach ($categories as $category)
            <section class="mb-6">
                <h1 class="text-lg uppercase font-semibold text-gray-700">
                    {{ $category->name }}
                </h1>

                @livewire('div-category-products', ['category' => $category])
            </section>
        @endforeach


    </div>


    @push("scripts")
        <script>
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
