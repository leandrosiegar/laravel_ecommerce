<div>

<!-- estas en resources\views\livewire\barra-naveg.blade.php -->
<!-- z-50 es el z-index (50 es el valor máximo q permite) -->
<header class="bg-gray-700 sticky top-0 z-50" style="position:fixed;width:100%;" x-data="dropdownLSG()">
    <div class="containerlsg flex items-center h-16 justify-between md:justify-start">
        <a
            :class="{'bg-opacity-100 text-orange-500': mostrar }"
            x-on:click="mostrarlo()"
            class="flex flex-col items-center justify-center order-last md:order-first px-6 md:px-4 bg-white bg-opacity-25
            text-white cursor-pointer font-semibold h-full">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <span class="text-sm hidden md:block">
                    Categorías
                </span>
        </a>

        <a href="/" class="mx-6">
            <x-jet-application-mark class="block h-9 w-auto" />
        </a>
        <!-- md:block q se muestre a partir de una pantalla es mediana -->
        <div class="flex-1 hidden md:block">
            @livewire('buscar-producto')
        </div>


        <div class="mx-6 relative hidden md:block">
            <!-- que solo se muestre cuando estemos logueados -->
            @auth
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Account') }}
                        </div>

                        <x-jet-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-jet-dropdown-link>

                        <x-jet-dropdown-link href="{{ route('orders.index') }}">
                            Mis pedidos
                        </x-jet-dropdown-link>

                        <div class="border-t border-gray-100"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-jet-dropdown-link href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-jet-dropdown-link>
                        </form>
                    </x-slot>
                </x-jet-dropdown>
            @else <!-- No logueado -->
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <i class="fas fa-user-circle text-white text-3xl cursor-pointer"></i>
                    </x-slot>

                    <x-slot name="content">
                        <x-jet-dropdown-link href="{{ route('login') }}">
                            {{ __('login') }}
                        </x-jet-dropdown-link>

                        <x-jet-dropdown-link href="{{ route('register') }}">
                            {{ __('register') }}
                        </x-jet-dropdown-link>

                    </x-slot>
                </x-jet-dropdown>
            @endauth
        </div>

        <div class="hidden md:block">
            @livewire('dropdown-carrito')
        </div>
    </div>

    <!-- con x-show solo se va a mostrar cuando mostrar esté a true -->
    <nav id="navMenuNaveg"
        class="bg-trueGray-700 bg-opacity-25 w-full absolute"
        x-show="mostrar"
        >
        <!-- menú tamaño ordenador -->
        <div class="container h-full hidden md:block">
            <div x-on:click.away="cerrar()" class="grid grid-cols-4 h-full relative hidden object-cover"
                :class="{
                    'block': mostrar,
                    'hidden': !mostrar
                }"
                >

                <ul class="bg-white">
                    @foreach ($categories as $category)
                        <li class="navigation-link text-trueGray-500 hover:bg-orange-500 hover:text-white">
                            <a class="py-2 px-4 text-sm flex items-center" href="{{ route('categories.show', $category) }}">
                                <span class="flex justify-center w-9">
                                    <!-- se pone así para q lo ejecute pq si pones las dos llaves te escribe solo el texto -->
                                    {!! $category->icon !!}
                                </span>
                                {{ $category->name }}
                            </a>
                        </li>

                        <div class="navigation-submenu bg-gray-100 absolute w-3/4 h-full top-0 right-0 hidden">
                            <x-divSubcategories :category="$category">
                            </x-divSubcategories>
                        </div>
                    @endforeach
                </ul>
                <div class="col-span-3 bg-gray-100">
                    <!-- que por defecto nada más entrar muestra las subcategorias de la primera categoría -->
                    <x-divSubcategories :category="$categories->first()">
                    </x-divSubcategories>
                </div>
            </div>

        </div>

        <!-- menú móvil -->
        <div class="bg-white h-full overflow-y-auto">
            <div class="container pt-2 pb-2">
                @livewire('buscar-producto')
            </div>

            <ul>
                @foreach ($categories as $category)
                    <li class=" text-trueGray-500 hover:bg-orange-500 hover:text-white">
                        <a class="py-2 px-4 text-sm flex items-center" href="{{ route('categories.show', $category) }}">
                            <span class="flex justify-center w-9">
                                <!-- se pone así para q lo ejecute pq si pones las dos llaves te escribe solo el texto -->
                                {!! $category->icon !!}
                            </span>
                            {{ $category->name }}
                        </a>
                    </li>

                @endforeach
            </ul>

            <p class="text-trueGray-500 px-6 my-2">
                USUARIOS
            </p>
            @livewire('carrito-movil')

            @auth
                <a class="py-2 px-4 text-sm flex items-center  text-trueGray-500 hover:bg-orange-500 hover:text-white"
                    href="{{ route('profile.show') }}">
                    <span class="flex justify-center w-9">
                        <!-- se pone así para q lo ejecute pq si pones las dos llaves te escribe solo el texto -->
                        <i class="far fa-address-card"></i>
                    </span>
                    Perfil
                </a>

                <a
                    class="py-2 px-4 text-sm flex items-center  text-trueGray-500 hover:bg-orange-500 hover:text-white"
                    href=""
                    onclick="event.preventDefault();document.getElementById('form_logout').submit();"
                    >
                    <span class="flex justify-center w-9">
                        <!-- se pone así para q lo ejecute pq si pones las dos llaves te escribe solo el texto -->
                        <i class="fas fa-sign-out-alt"></i>
                    </span>
                    Cerrar sesión
                </a>

                <form id="form_logout" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            @else
                <a class="py-2 px-4 text-sm flex items-center  text-trueGray-500 hover:bg-orange-500 hover:text-white"
                    href="{{ route('login') }}">
                    <span class="flex justify-center w-9">
                        <!-- se pone así para q lo ejecute pq si pones las dos llaves te escribe solo el texto -->
                        <i class="fas fa-user-circle"></i>
                    </span>
                    Iniciar sesión
                </a>

                <a class="py-2 px-4 text-sm flex items-center  text-trueGray-500 hover:bg-orange-500 hover:text-white"
                    href="{{ route('register') }}">
                    <span class="flex justify-center w-9">
                        <!-- se pone así para q lo ejecute pq si pones las dos llaves te escribe solo el texto -->
                        <i class="fas fa-fingerprint"></i>
                    </span>
                    Regístrate
                </a>
            @endauth

        </div>
    </nav>

</header>


</div>
