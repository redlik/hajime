@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:max-w-lg sm:mt-10">
    <div class="flex">
        <div class="w-full">
            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

                <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                    {{ __('Email Verification') }}
                </header>

                <form class="w-full px-6 pb-8 space-y-6 sm:px-10 sm:space-y-8" method="POST" action="{{ route('email2fa.post') }}">
                    @csrf
                    <p class="text-center">We sent code to email : {{ substr(auth()->user()->email, 0, 5) . '******' . substr(auth()->user()->email,  -2) }}</p>
                    <div class="flex flex-wrap">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                            {{ __('Verification Code') }}:
                        </label>

                        <input id="code" type="number"
                            class="border-gray-300 rounded shadow-sm focus:shadow-lg w-full @error('code') border-red-500 @enderror" name="code"
                             required autofocus>

                        @error('code')
                        <p class="text-red-700 text-sm font-semibold mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div>
                        @if(session('resend'))
                            <p class="text-red-700 text-sm font-semibold">Code verification has been re-sent to your email</p>
                        @endif
                    </div>
                    <div class="text-right">
                        <a href="{{ route('email2fa.resend') }}" class="text-sm text-judo-600">Resend Code</a>
                    </div>
                    <div class="flex flex-wrap my-12">
                        <button type="submit"
                                class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-judo-green hover:bg-green-700 sm:py-4">
                            {{ __('Submit') }}
                        </button>
                    </div>
                </form>

            </section>
        </div>
    </div>
</main>
@endsection
