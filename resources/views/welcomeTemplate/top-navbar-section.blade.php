<header class="bg-sky-900 sticky top-0">
    <!-- Hamburger -->
    <div class="container h-16 flex items-center">
        
        <!-- Hamburger -->
        <a class="px-4 h-full flex items-center bg-white bg-opacity-25 text-white cursor-pointer font-semibold">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </a>
        {{-- LOGO --}}
        <x-application-mark class="blok mx-6 h-9 w-auto" />

        {{-- SearchBar --}}
        @livewire('welcome.search-bar')
        
        {{-- DropDown --}}
        <div class="ml-4">
            @auth
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </button>
                    @else
                        <span class="inline-flex rounded-md">
                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                {{ Auth::user()->name }}

                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                        </span>
                    @endif
                </x-slot>

                <x-slot name="content">
                    <!-- Account Management -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ auth()->user()->level }}
                    </div>

                    <x-dropdown-link href="{{ route('profile.show') }}">
                        Perfil
                    </x-dropdown-link>

                    <div class="border-t border-gray-200"></div>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-dropdown-link href="{{ route('logout') }}"
                                @click.prevent="$root.submit();">
                            Cerrar Sesión
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
            @else
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="p-1 flex text-sm border-2 border-transparent rounded-full bg-slate-100 focus:outline-none focus:border-gray-300 transition">
                        <i class="fa-solid fa-user text-xl text-sky-900 cursor pointer"></i>                    
                    </button>
                </x-slot>

                <x-slot name="content">
                    <!-- Account Management -->

                    <x-dropdown-link href="{{ route('login') }}">
                        Iniciar Sesión
                    </x-dropdown-link>
                    
                    <x-dropdown-link href="{{ route('register') }}">
                        Registrarse
                    </x-dropdown-link>
                </x-slot>
            </x-dropdown>
            @endauth
        </div>
        
    </div>
</header>

