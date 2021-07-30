@extends('layouts.app')

@section('content')
<login-comp>
    <template v-slot:csrf>
        @csrf
    </template>
    
    <template v-slot:errors>
        <div class="mt-2">
            @error('email')
                <p class="text-red-400 text-xs " role="alert">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror
            
            @error('password')
                <p class="text-red-400 text-xs" role="alert">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror
        </div>
    </template>
    
    <template v-slot:remember>
        <input
              id="remember_me"
              type="checkbox"
              name="remember"
              {{ old('remember') ? 'checked' : '' }}
              class="form-checkbox h-4 w-4 text-nord-light3 transition duration-150 ease-in-out"
            />
        <label for="remember_me" class="ml-2 block text-sm leading-5 text-nord-light3">Remember me</label>
    </template>
    
    
    <template v-slot:forgot>
        @if (Route::has('password.request'))
            <a
              href="{{ route('password.request') }}"
              class="font-medium text-nord-light3 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150"
            >{{ __('Forgot Your Password?') }}</a>
        @endif
    </template>
</login-comp>
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
