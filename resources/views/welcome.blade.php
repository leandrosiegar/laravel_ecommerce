<!-- estas en resources\views\welcome.blade.php -->
<x-app-layout>
    <div class="container py-8">
        <section>
            <h1 class="text-lg uppercase font-semibold text-gray-700">
                {{ $categories->first()->name }}
            </h1>

            @livewire('div-category-products', ['category' => $categories->first()])
        </section>
    </div>

    <script>
        new Glider(document.querySelector('.glider'), {
            slidesToScroll: 1,
            slidesToShow: 5.5,
            draggable: true,
            dots: '.dots',
            arrows: {
            prev: '.glider-prev',
            next: '.glider-next'
            }
        });
    </script>
</x-app-layout>
