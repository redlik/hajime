<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Blocked -->
    <meta name="robots" content="noindex">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">


    <title>{{ config('app.name', 'Hajime') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    @livewireStyles

</head>
<body class="bg-gray-100 h-screen antialiased leading-none font-sans">
    <div id="app" class="h-full pb-12">
        <header class="bg-judo-green py-6">
            <div class="container mx-auto flex justify-between items-center px-6">
                <div class="flex items-center">
                        <div>
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('images/ija-logo.png') }}" alt="Irish Judo Logo" class="w-12 h-12 mr-1">
                            </a>
                        </div>
                        <div class="w-auto">
                            <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline">
                            {{ config('app.name', 'Laravel') }}
                            </a>
                        </div>
                    </a>
                </div>
                <nav class="space-x-4 text-white text-sm sm:text-base font-bold flex flex-wrap">
                    <a class="no-underline hover:underline hover:text-orange-200" href="/">Home</a>
                    <a class="no-underline hover:underline hover:text-orange-200" href="{{ route('clubs.index') }}">Clubs</a>
                    <a class="no-underline hover:underline hover:text-orange-200" href="{{ route('member.index') }}">Members</a>
                    @guest
                        <a class="no-underline hover:underline hover:text-orange-200" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @if (Route::has('register'))
                            <a class="no-underline hover:underline" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    @else

                        <div x-data="{ dropdownOpen: false }" class="relative flex flex-wrap cursor-pointer">
                            <button @click="dropdownOpen = !dropdownOpen">
                                <div class="flex flex-wrap hover:text-yellow-400 text-bold">
                                    <span>Hi {{ Auth::user()->name }}</span>
                                    <i x-show="!dropdownOpen" class="fas fa-chevron-down ml-2 pt-1"></i>
                                    <i x-show="dropdownOpen" class="fas fa-chevron-up ml-2 pt-1"></i>
                                </div>
                            </button>

                                <div x-show="dropdownOpen" class="absolute right-0 mt-8 py-2 w-48 bg-white rounded-md
                        shadow-xl z-20 text-left">
                                    <a href="#" class="block px-4 py-2 text-sm capitalize text-gray-700
                                    text-bold hover:bg-judo-500 hover:text-white">
                                        Your profile
                                    </a>
                                    <a href="#" class="block px-4 py-2 text-sm capitalize text-gray-700
                                    text-bold hover:bg-judo-500 hover:text-white">
                                        Activity
                                    </a>
                                    <a href="{{ route('logout') }}"
                                       class="block px-4 py-2 text-sm capitalize text-gray-700
                                       text-bold hover:bg-judo-500
                                       hover:text-white"
                                       onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                        </div>

                    @endguest
                </nav>
            </div>
        </header>

        @yield('content')
    </div>
@livewireScripts
@yield('bottomScripts')
</body>
</html>
