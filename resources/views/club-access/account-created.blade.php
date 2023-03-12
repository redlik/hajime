@extends('layouts.app')

@section('content')
    <main class="sm:container sm:mx-auto sm:max-w-lg sm:mt-10">
        <div class="flex">
            <div class="w-full">
                <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg px-6 py-12">
                    @if(session('registered'))
                        <div>
                            <h4 class="font-bold text-xl text-judo-700 mb-2">Thank you!</h4>
                            <p class="mb-6">
                                Your account has been created, but it's not activated just yet. The admins of the site will review it. Once approved you will get a notification email the account is ready to be used.
                            </p>
                            <a href="{{ route('home') }}" class="button-judo">Homepage</a>
                        </div>
                    @else
                    <div>
                        <p class="mb-6">You're not authorised to view this page</p>
                        <a href="{{ route('home') }}" class="button-judo">Homepage</a>
                    </div>
                    @endif
                </section>
            </div>
        </div>
    </main>
@endsection
