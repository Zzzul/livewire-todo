<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    @livewireStyles

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />
</head>

<body style="background-color:  #FAFDFB">
    {{-- #F8FAFC --}}
    <div id="app">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-6 p-0">
                    <nav class="navbar navbar-expand-md navbar-light bg-transparent">

                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{-- {{ config('app.name', 'Laravel') }} --}}
                            Livewire
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav mr-auto">
                                @auth
                                <li class="nav-item">
                                    <a href="home" class="nav-link">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a href="todo" class="nav-link">Todo</a>
                                </li>
                                @endauth
                            </ul>

                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ml-auto">
                                <!-- Authentication Links -->
                                @guest
                                @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @endif

                                @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                                @endif
                                @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <livewire:auth.logout />
                                    </div>
                                </li>
                                @endguest
                            </ul>
                        </div>
                    </nav>
                    <hr>
                </div>
            </div>
        </div>
        <main class="py-4">
            @yield('content')
            {{ isset($slot) ? $slot : null }}
        </main>
    </div>
    <footer>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <hr class="shadow-sm">
                    <p class="text-center">Made with <i class="fas fa-heart text-danger"></i> by
                        <a href="https://github.com/zzzul/">Mohammad Zulfahmi</a>.
                    </p>
                </div>
            </div>
            {{-- end of row --}}
        </div>
    </footer>
    @livewireScripts
    <x-livewire-alert::scripts />
    <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js"
        data-turbolinks-eval="false"></script>
</body>

</html>
