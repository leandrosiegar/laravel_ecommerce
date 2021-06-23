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

        @livewireStyles

         <!-- Scripts -->
         <script src="{{ mix('js/app.js') }}" defer></script>

         <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.7/glider.min.js" integrity="sha512-tHimK/KZS+o34ZpPNOvb/bTHZb6ocWFXCtdGqAlWYUcz+BGHbNbHMKvEHUyFxgJhQcEO87yg5YqaJvyQgAEEtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

         <!-- esta carpeta vendor la hemos creado nosotros y allí vamos a ir poniendo todos los plugins que vamos a usar -->
         <script src="{{ asset('vendor/flexslider/jquery.flexslider-min.js') }}"></script>

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


        <script>
            function dropdownLSG() {
                return {
                    mostrar: false,
                    mostrarlo() {
                        if (this.mostrar) {
                            this.mostrar = false;
                            // habilitar el scroll
                            document.getElementsByTagName('html')[0].style.overflow = 'auto';
                        }
                        else {
                            this.mostrar = true;
                            // deshabilitar el scroll
                            document.getElementsByTagName('html')[0].style.overflow = 'hidden';
                        }
                    },
                    cerrar() {
                        this.mostrar = false;
                        // habilitar el scroll
                        document.getElementsByTagName('html')[0].style.overflow = 'auto';
                    }
                }
            }
        </script>

        <!-- Aquí cargará los scripts de cada página -->
        @stack('scripts')


    </body>
</html>
