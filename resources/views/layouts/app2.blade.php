<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CSD Calendar') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
<!--     <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> -->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        *{
            font-family:'Segoe UI';
        }
        html, body { height: 100%; width: 100%; margin: 0;}
    </style>
</head>
<div style="min-height:100%;height:100%;position:relative;">
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="background-color:#0C75CB;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}" style="color:white;">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"  style="color:white;">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item" >
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}"  style="color:white;">{{ __('Register') }}</a>
                                @endif
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre  style="color:white;">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
    </div>

</body>
<!-- <footer style="font-family: 'Lato', sans-serif; position:absolute;
bottom:0;width:100%;padding:20px;">
@include('layouts.footer')
</footer> -->
</div>

</html>
