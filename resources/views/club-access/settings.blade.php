@extends('layouts.app')

@section('content')
    <main class="sm:container sm:mx-auto sm:mt-10">
        <div class="w-full sm:px-6">
            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">
                <header class="font-semibold text-xl bg-gray-600 text-gray-100 py-4 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                    Settings
                </header>
                <div id="main" class="p-6">
                    @if(session('status') === 'two-factor-authentication-enabled')
                        <div class="mb-4 font-medium text-green-600">
                            Two factor authentication has been enabled, now scan the QR code below with your authenticator app.
                        </div>
                        <div class="mb-8">
                            <h3 class="font-semibold text-lg mb-4">Scan this QR code into your authenticator app.</h3>
                            {!! request()->user()->twoFactorQrCodeSvg() !!}
                        </div>
                        <div class="mb-8">
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
                    @else
                        <h3 class="font-bold text-xl mb-4">Welcome to Hajime</h3>
                        <p>Before you access your club page please enable 2FA to access your club page.</p>
                        <p>You can use authenticator apps on your smartphone such as Google Authenticator, Authy or Microsoft Authenticator. Check your Apple App Store or Google Play Store.</p>
                        <form action="/user/two-factor-authentication" method="POST" class="mt-8">
                            @csrf
                            <button class="button-judo">Enable 2FA</button>
                        </form>
                    @endif

                </div>
            </section>
        </div>
    </main>
@endsection
