@extends('layouts.master')

@section('content')
<nav class="flex justify-between items-center h-12 px-8 shadow bg-nord-dark4 fixed w-full z-50">
    <a href="{{ url('/home') }}">
        <img src="{{ asset('/images/codeicon.png') }}" alt="web icon">
    </a>

    @guest
        <div>
            <a class="text-nord-light2 mr-2" href="{{ route('login') }}">{{ __('Login') }}</a>

            @if (Route::has('register'))
                <a class="text-nord-light2" href="{{ route('register') }}">{{ __('Register') }}</a>
            @endif
        </div>
    @else
        <div>
            <form action="/logout" method="post">
                @csrf
                <dropdown-component>
                    <template v-slot:username>
                        {{ auth()->user()->name }}
                    </template>    
                    
                    <template v-slot:links>
                        {{-- <button class="text-nord-light2 block py-2 px-4 hover:bg-gray-600 w-full text-left" type="submit">Account settings</button>
                        <button class="text-nord-light2 block py-2 px-4 hover:bg-gray-600 w-full text-left" type="submit">Support</button> --}}
                        <button class="text-nord-light2 block py-2 px-4 hover:bg-gray-600 w-full text-left" type="submit">Sign out</button>
                    </template>
                </dropdown-component>
            </form>
        </div>
    @endguest
</nav>

<div class="spacer h-12"></div>

<main>
    @yield('home')
</main>
@endsection









{{-- <!doctype html>
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
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body  class="bg-nord-dark1">
    <div id="app">
        <nav class="flex justify-between items-center h-12 px-8 shadow bg-nord-dark4 fixed w-full z-50">
            <a href="{{ url('/') }}">
                <img src="{{ asset('/images/codeicon.png') }}" alt="web icon">
            </a>

            @guest
                <div>
                    <a class="text-nord-light2 mr-2" href="{{ route('login') }}">{{ __('Login') }}</a>

                    @if (Route::has('register'))
                        <a class="text-nord-light2" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                </div>
            @else
                <form action="/logout" method="post">
                    @csrf

                    <div>
                        <button type="submit"
                            class="text-nord-light2">
                                Logout
                        </button>
                    </div>
                </form>
            @endguest
        </nav>

        <div class="spacer h-12"></div>

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html> --}}
