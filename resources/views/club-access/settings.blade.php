@extends('layouts.app')

@section('content')
    <main class="sm:container sm:mx-auto sm:mt-10">
        <div class="w-full sm:px-6 mb-12">
            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg pb-8">
                <header class="font-semibold text-xl bg-gray-600 text-gray-100 py-4 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                    2 Factor Authentication setup
                </header>
                <div id="main" class="p-6">
                    <h3 class="font-bold text-xl mb-4">Welcome to Hajime</h3>
                    @if( $errors->confirmTwoFactorAuthentication->any() )
                        <div class="my-4 bg-red-50 p-2 rounded">
                            <ul>
                                @foreach( $errors->confirmTwoFactorAuthentication->all() as $error )
                                    <li class="text-red-500 text-sm font-medium" >{{ $error }}</li>
                                @endforeach
                            </ul>
                            <div class="font-bold mt-3 text-sm mt-2 text-red-600">Please repeat the process again.</div>
                        </div>

                    @endif
                    @if(session('request-sent'))
                        <div class="mb-8 bg-green-50 rounded p-4 text-green-700 font-semibold">
                            {{ session('request-sent') }}
                        </div>
                    @endif
                    @if(!session('status') || session('status') != "two-factor-authentication-confirmed")
                        <p class="mb-2">Before you access your club page please enable 2FA to access your club page.</p>
                        <p class="mb-2">You can use authenticator apps on your smartphone such as Google Authenticator, Authy or Microsoft Authenticator.
                        </p>
                        <p class="">Download the app from Apple App Store or Google Play Store on your phone.</p>
                        <div class="flex gap-8 my-4">
                            <form action="/user/two-factor-authentication" method="POST" class="">
                                @csrf
                                <button class="button-judo">Enable 2-Factor Authentication</button>
                            </form>
                        </div>

                    @endif

                    @if(Auth::user()->two_factor_confirmed_at)
                        <h3 class="font-bold text-xl mb-4">2-Factor authentication already enabled</h3>
                        <p>Your account is all good to go, proceed to your club page</p>
                            <a href="{{ route('club.access.club') }}" class="button-judo">My Club</a>
                    @else
                        @if(session('status') === 'two-factor-authentication-enabled')
                            <div class="mb-4 mt-8 font-medium text-green-600">
                                Two factor authentication has been enabled, now scan the QR code below with your authenticator app and paste the generated code from the app below.
                            </div>
                            <div class="mb-8">
                                <h3 class="font-semibold text-lg mb-4">Scan this QR code into your authenticator app.</h3>
                                {!! request()->user()->twoFactorQrCodeSvg() !!}
                            </div>
                            <div>
                                <form action="/user/confirmed-two-factor-authentication" method="POST">
                                    @csrf
                                    <div class="">
                                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                            {{ __('Confirm Authenticator code') }}:
                                        </label>
                                        <input id="code" type="text"
                                               class="w-48 block rounded border-gray-300 shadowmb mb-4"
                                               name="code"
                                               required autocomplete="false">
                                        <button class="button-judo" type="submit">Submit code</button>
                                    </div>
                                </form>
                            </div>
                            <div class="my-8">
                                <h3 class="font-semibold text-lg mb-4">Record these recovery codes in a safe place in case you can't access your authenticator app.</h3>
                                <div class="p-4 bg-gray-100 rounded">
                                    @foreach(request()->user()->recoveryCodes() as $code)
                                        <p class="font-medium text-gray-600">{{ $code }}</p>
                                    @endforeach
                                </div>
                            </div>
                            <form action="/user/two-factor-authentication" method="POST" class="mt-8">
                                @csrf
                                @method('DELETE')
                                <button class="button-judo">Not now</button>
                            </form>
                            @if(! session('request-sent'))
                                <div>
                                    <p class="my-4 rounded bg-red-100 p-2 mb-8 mt-16 text-gray-700">If you can't use the authenticator app or having trouble with it, you can request a different form of authentication - via email. Use the button below to make the request.</p>
                                    <a href="{{ route('user.email-request', Auth::user()) }}" class="button-judo">Request email verification</a>
                                </div>
                            @endif
                        @endif
                        @if(session('status') == 'two-factor-authentication-confirmed')
                        <div class="mb-4 font-medium text-sm">
                            Two factor authentication confirmed and enabled successfully, you can now view your club page.
                        </div>

                        <a class="button-judo" href="{{ route('club.access.club') }}">View my Club</a>
                    @endif
                    @endif
                </div>
            </section>
        </div>
    </main>
@endsection
