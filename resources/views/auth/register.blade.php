@extends('layouts.app')

@section('content')
<div
    class="min-h-screen flex items-center justify-center bg-nord-dark2 py-12 px-4 sm:px-6 lg:px-8"
  >
    <div class="max-w-md w-full bg-nord-dark4 p-8 rounded-md">
      <div>
        <img class="mx-auto h-12 w-auto" src="/images/codeicon.png" alt="Workflow" />
        <h2
          class="mt-6 text-center text-2xl leading-9 font-extrabold text-nord-light3"
        >Register for an account</h2>
      </div>
      
      
      
      <form class="mt-8" action="/register" method="POST">
        @csrf
        
          <div>
            <input
              aria-label="Name"
              name="name"
              type="name"
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5"
              placeholder="Name"
              value="{{ old('name') }}" required autocomplete="name" autofocus
            />
          </div>
          <div class="mt-4">
            <input
              aria-label="Email address"
              name="email"
              type="email"
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5"
              placeholder="Email address"
              value="{{ old('email') }}" required autocomplete="email" autofocus
            />
          </div>
          <div class="mt-4">
            <input
              aria-label="Password"
              name="password"
              type="password"
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5"
              placeholder="Password"
            />
          </div>
          <div class="mt-4">
            <input
              aria-label="Password Confirm"
              name="password_confirmation"
              type="password"
              class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5"
              placeholder="{{ __('Confirm Password') }}"
            />
          </div>
          
          <div class="mt-2">
              @error('name')
                  <p class="text-red-400 text-xs" role="alert">
                      <strong>{{ $message }}</strong>
                  </p>
              @enderror
              @error('email')
                  <p class="text-red-400 text-xs" role="alert">
                      <strong>{{ $message }}</strong>
                  </p>
              @enderror
              @error('password')
                  <p class="text-red-400 text-xs" role="alert">
                      <strong>{{ $message }}</strong>
                  </p>
              @enderror
          </div>

        <div class="mt-6">
          <button
            type="submit"
            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-nord-light1 bg-nord-dark2 hover:bg-nord-dark1 focus:outline-none focus:border-nord-dark3 focus:shadow-outline-indigo transition duration-150 ease-in-out"
          >
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
              <svg
                class="h-5 w-5 text-nord-light3 group-hover:text-nord-light2 transition ease-in-out duration-150"
                fill="currentColor"
                viewBox="0 0 20 20"
              >
                <path
                  fill-rule="evenodd"
                  d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                  clip-rule="evenodd"
                />
              </svg>
            </span>
            {{ __('Register') }}
          </button>
        </div>
      </form>
    </div>
  </div>
@endsection
