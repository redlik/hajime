@extends('layouts.app')

@section('content')
    <main class="w-full flex" style="height: calc(100vh - 48px);">
        <div class="hidden md:block w-1/2 h-full">
            <img src="{{ asset('images/registration-bg.jpg') }}" class="h-full object-cover" alt="">
        </div>
        <div class="w-full lg:w-1/2 flex flex-col bg-white h-full justify-center">

            @if (session('status'))
                <div
                    class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4"
                    role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <section class="flex flex-col px-2 md:px-12">

                    <header class="font-semibold text-judo-700 text-2xl py-5 px-6 sm:py-6 text-center">
                        {{ __('Register new club access account') }}
                    </header>

                    <form class="w-full px-6 bg-gray-100 rounded shadown-sm space-y-4 sm:px-10 sm:space-y-8" method="POST"
                          action="{{ route('club.access.create-user') }}">
                        @csrf

                        <div class="flex flex-wrap">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                {{ __('Name') }}:
                            </label>

                            <input id="name" type="text" class="border-gray-300 rounded shadow-sm focus:shadow-lg w-full @error('name')  border-red-500 @enderror"
                                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="flex flex-wrap">
                            <label for="clubs" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                {{ __('Club') }}:
                            </label>

                            <select name="clubs" id="clubs" class="border-gray-300 rounded shadow-sm focus:shadow-lg w-full" required>
                                <option value="" disabled selected>Select your club</option>
                                @foreach($clubs as $club)
                                    <option value="{{ $club->id }}">{{ $club->name }}</option>
                                @endforeach
                            </select>

                            @error('email')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="flex flex-wrap">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                {{ __('E-Mail Address') }}:
                            </label>

                            <input id="email" type="email"
                                   class="border-gray-300 rounded shadow-sm focus:shadow-lg w-full @error('email') border-red-500 @enderror" name="email"
                                   value="{{ old('email') }}" required autocomplete="email">

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
                                   class="border-gray-300 rounded shadow-sm focus:shadow-lg w-full @error('password') border-red-500 @enderror" name="password"
                                   required autocomplete="new-password">

                            @error('password')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="flex flex-wrap">
                            <label for="password-confirm" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                {{ __('Confirm Password') }}:
                            </label>

                            <input id="password-confirm" type="password" class="border-gray-300 rounded shadow-sm focus:shadow-lg w-full"
                                   name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="flex flex-wrap">
                            <button type="submit"
                                    class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-judo-500 hover:bg-judo-600 sm:py-4">
                                {{ __('Register') }}
                            </button>

                            <p class="w-full text-xs text-center text-gray-700 my-6 sm:text-sm sm:my-8">
                                {{ __('Already have an account?') }}
                                <a class="text-judo-500 hover:text-judo-700 no-underline hover:underline" href="{{ route('login') }}">
                                    {{ __('Login') }}
                                </a>
                            </p>
                        </div>
                    </form>

                </section>

        </div>
    </main>
@endsection

