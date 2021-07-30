@extends('layouts.master')

@section('content')
    <welcome-component>
        <div class="flex justify-center">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a class="ml-4" href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    </welcome-component>
@endsection
