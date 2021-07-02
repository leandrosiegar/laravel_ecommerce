<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <!-- esta carpeta vendor la hemos creado nosotros y allí vamos a ir poniendo todos los plugins que vamos a usar -->
        <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/flexslider/flexslider.css') }}">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.7/glider.min.css" integrity="sha512-YM6sLXVMZqkCspZoZeIPGXrhD9wxlxEF7MzniuvegURqrTGV2xTfqq1v9FJnczH+5OGFl5V78RgHZGaK34ylVg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- CSS de dropzone -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        @livewireStyles

         <!-- Scripts -->
         <script src="{{ mix('js/app.js') }}" defer></script>



         <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.7/glider.min.js" integrity="sha512-tHimK/KZS+o34ZpPNOvb/bTHZb6ocWFXCtdGqAlWYUcz+BGHbNbHMKvEHUyFxgJhQcEO87yg5YqaJvyQgAEEtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

         <script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>

         <!-- esta carpeta vendor la hemos creado nosotros y allí vamos a ir poniendo todos los plugins que vamos a usar -->
         <script src="{{ asset('vendor/flexslider/jquery.flexslider-min.js') }}"></script>

         <!-- sweetalert -->
         <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

         <!-- dropzone -->
         <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js" integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    </head>
    <!-- estas en resources\views\layouts\app.blade.php -->
    <body class="font-sans antialiased">
        <!-- aqui va x-jet-banner -->
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            {{-- @livewire('barra-naveg') --}}
            @livewire('navigation-menu') <!-- es la barra de nav q viene con jetstream -->
                @if (isset($headerLSG))
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $headerLSG }}
                        </div>
                    </header>
                @endif

            <!-- Page Content -->
            <!-- Estás en resources\views\layouts\app.blade.php -->
            <!-- En $slot se carga la view del componente q se esté llamando -->
            <main class="containerlsg" style="margin-top:60px;">
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts





        <!-- Aquí cargará los scripts de cada página que se llamará con push en cada página -->
        @stack('scripts')

        <script>
            Livewire.on('errorSize', $mensaje => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: $mensaje,
                })
            });
        </script>


    </body>
</html>
