@extends('layouts.app')

@section('content')
    <main class="w-full flex" style="height: calc(100vh - 48px);">
        <div class="hidden md:block w-1/2 h-full">
            <img src="{{ asset('images/confirmation-bg.jpg') }}" class="h-full object-cover" alt="">
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
                @if(session('registered'))
                    <div class="w-full text-center">
                        <h4 class="font-bold text-xl text-judo-700 mb-2">Thank you!</h4>
                        <p class="mb-6">
                            Your account has been created, but it's not activated just yet. The admins of the site will review it. Once approved you will get a notification email the account is ready to be used.
                        </p>
                        <a href="/" class="button-judo">Homepage</a>
                    </div>
                @else
                    <div>
                        <p class="mb-6">You're not authorised to view this page</p>
                        <a href="{{ route('home') }}" class="button-judo">Homepage</a>
                    </div>
                @endif
            </section>

        </div>
    </main>
@endsection
