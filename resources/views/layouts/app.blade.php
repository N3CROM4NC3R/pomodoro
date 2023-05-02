<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>  @yield("title")  </title>
    <link rel="shortcut icon" href="pomo-logo.ico" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="js/vendor/axios.js"></script>
    <link href="styles.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/5e4402aed6.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>

</head>
<body>
    <div id="app" class="app">
        <nav class="navbar navbar-expand-lg custom-navbar">
            <div class="container">
                <a class="navbar-brand custom-navbar-brand " href="{{ url('/') }}">
                    <img src="pomo-logo.png" class="me-2" width="40px"/><span class="align-middle">{{ config('app.name', 'Pomo') }}</span>
                </a>
                <button class="navbar-toggler custom-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <i class="fa-solid fa-bars" style="color: #ffffff;"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @if (Route::is("pomodoro"))
                            <li class="nav-item">
                                <button class="nav-link custom-nav-link settings-button" id="settings-button">Settings</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link custom-nav-link settings-button" id="statistics-button">Statistics</button>
                            </li>
                        @endif
                        @guest

                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link custom-nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link custom-nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle custom-nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <input name="is-logged" type="hidden" id="is-logged" value="true"/>
                                <div class="dropdown-menu dropdown-menu-end custom-dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item custom-dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        <div class="bottom d-flex justify-content-center align-items-center">
            <div class="bottom__content">
                <p> To focus better by </p>
                <a href="#">N3CR0M4NC3R</a>
            </div>
        </div>
    </div>
    <div>
        @yield ("bottom-scripts")
    </div>
</body>
</html>
