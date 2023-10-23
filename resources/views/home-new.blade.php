@extends('layouts.app')

@section('content')
    <main class="w-full flex" style="height: calc(100vh - 48px);">
        <div class="hidden md:block w-1/2 h-full">
            <img src="{{ asset('images/judo-bg.jpg') }}" class="h-full object-cover" alt="">
        </div>
        <div class="w-full lg:w-1/2 flex flex-col bg-white h-full justify-center">

            @if (session('status'))
                <div
                    class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4"
                    role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <section class="">

                <div class="w-full p-6">
                    <img src="{{ asset('images/ija-logo.jpg') }}" alt="Irihs Judo Logo" class="mx-auto w-24 h-24">
                    <h1 class="judo-green text-3xl font-bold text-center my-6">
                        Welcome to Hajime <br>Judo Membership Portal
                    </h1>
                    @guest
                        @if(session('activated'))
                            <div class="text-center px-12 mb-12">
                                <p class="text-gray-600 text-center font-medium leading-6">
                                    Thank you for activating your account, please use the login form below to finalise the account setup - 2-factor authentication.<br/>
                                    Once that done you'll be all set to view your club details.</br/>
                                    Thank you!
                                </p>
                            </div>
                        @else
                            <div class="text-center px-12 mb-12">
                                <p class="text-gray-600 text-center leading-6">
                                    This portal is for registered users only. If you're managing a Judo club but don't have an account yet, contact Irish Judo Association office. Otherwise, use your login details to access your club's page.
                                </p>
                            </div>
                        @endif

                        <div class="text-center">
                            <form
                                class="w-full lg:w-3/4 px-6 py-2 pb-8 rounded space-y-6 sm:px-10 sm:space-y-8 mt-6 mx-auto bg-gray-100"
                                method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="flex flex-wrap">
                                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                        {{ __('E-Mail Address') }}:
                                    </label>

                                    <input id="email" type="email"
                                           class="w-full rounded border-gray-300 shadow @error('email') border-red-500 @enderror"
                                           name="email"
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
                                           class="w-full rounded border-gray-300 shadow @error('password') border-red-500
                                            @enderror" name="password" required>

                                    @error('password')
                                    <p class="text-red-500 text-xs italic mt-4">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>

                                <div class="flex items-center">
                                    <label class="inline-flex items-center text-sm text-gray-700" for="remember">
                                        <input type="checkbox" name="remember" id="remember" class="rounded border-judo-300
                                text-judo-600 shadow-sm focus:border-judo-300 focus:ring focus:ring-judo-200
                                focus:ring-opacity-50"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <span class="ml-2">{{ __('Remember Me') }}</span>
                                    </label>

                                    @if (Route::has('password.request'))
                                        <a class="text-sm text-judo-600 hover:text-judo-800 whitespace-no-wrap no-underline
                            hover:underline ml-auto"
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
                                            <a class="text-blue-500 hover:text-blue-700 no-underline hover:underline"
                                               href="{{ route('register') }}">
                                                {{ __('Register') }}
                                            </a>
                                        </p>
                                    @endif
                                </div>
                            </form>
                        </div>
                        @endguest
                    @auth
                    <div class="w-full text-center mt-6">
                        <h5 class="font-semibold text-xl mb-4">{{ $clubs }} affiliated clubs and {{ $members }} active members</h5>
                    </div>
                    @endauth
                </div>
            </section>
        </div>
    </main>
@endsection
