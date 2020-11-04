@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-10 md:mt-0">
    <div class="w-full sm:px-6 flex flex-col mt-10">

        @if (session('status'))
            <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <section class="w-full align-middle break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg rounded-lg" style="min-height:60%">

            <div class="w-full p-6">
                <img src="{{ asset(images/ija-logo.jpg) }}" alt="Irihs Judo Logo" class="mx-auto w-24 h-24">
                <h1 class="judo-green text-4xl font-bold text-center my-6">
                    Welcome to Judo Membership Portal
                </h1>
                <p class="text-gray-500 text-lg text-center leading-8">
                    You need to be a registered user to access it.</br>
                    If you have an account already use the login form below, otherwise contact the administrators of the page.
                </p>
                <div class="text-center">
                    <form class="w-full lg:w-1/2 px-6 py-2 pb-8 rounded space-y-6 sm:px-10 sm:space-y-8 mt-6 mx-auto bg-gray-100" method="POST" action="{{ route('login') }}">
                        @csrf
    
                        <div class="flex flex-wrap">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                {{ __('E-Mail Address') }}:
                            </label>
    
                            <input id="email" type="email"
                                class="form-input w-full @error('email') border-red-500 @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>
    
                            @error('email')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
    
                        <div class="flex flex-wrap">
                            <label for="password" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                {{ __('Password') }}:
                            </label>
    
                            <input id="password" type="password"
                                class="form-input w-full @error('password') border-red-500 @enderror" name="password"
                                required>
    
                            @error('password')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
    
                        <div class="flex items-center">
                            <label class="inline-flex items-center text-sm text-gray-700" for="remember">
                                <input type="checkbox" name="remember" id="remember" class="form-checkbox"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <span class="ml-2">{{ __('Remember Me') }}</span>
                            </label>
    
                            @if (Route::has('password.request'))
                            <a class="text-sm text-green-500 hover:text-green-700 whitespace-no-wrap no-underline hover:underline ml-auto"
                                href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
                        </div>
    
                        <div class="flex flex-wrap">
                            <button type="submit"
                            class="w-1/2 mx-auto select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-judo-green hover:bg-green-600 sm:py-4">
                                {{ __('Login') }}
                            </button>
    
                            @if (Route::has('register'))
                            <p class="w-full text-xs text-center text-gray-700 my-6 sm:text-sm sm:my-8">
                                {{ __("Don't have an account?") }}
                                <a class="text-blue-500 hover:text-blue-700 no-underline hover:underline" href="{{ route('register') }}">
                                    {{ __('Register') }}
                                </a>
                            </p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</main>
@endsection
