@extends('layouts.app')

@section('content')
    <main class="sm:mx-2 mx-10 sm:mt-10">
        <div class="w-full sm:px-6">

            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

                <header class="font-semibold text-xl bg-gray-600 text-gray-100 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                    Review Active Memberships
                </header>
                <div class="px-8 pb-12">
                    <p class="py-8">Click on the button below to check entire members' list and deactivate those that don't have an active licence with an expiry date into the future</p>

                    <a class="button-judo" href="{{ route('members.checkMembershipsGlobally') }}">Check and Review Memberships</a>

                    @if(Session::has('message'))
                        <p class="bg-green-100 text-green-700 p-2 rounded mt-12"> {{ Session::get('message') }}</p>
                    @endif
                </div>


            </section>
        </div>
    </main>
@endsection
