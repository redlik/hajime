@extends('layouts.app')

@section('content')
    <main class="w-full flex" style="height: calc(100vh - 48px);">
        <div class="hidden md:block w-1/2 h-full">
            <img src="{{ asset('images/registration-bg.jpg') }}" class="h-full object-cover" alt="">
        </div>
        <div class="w-full lg:w-1/2 flex flex-col bg-gray-100 h-full justify-center">

            @if (session('status'))
                <div
                    class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4"
                    role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <section class="flex flex-col px-2 md:px-12">

                    <header class="font-semibold text-red-700 text-2xl py-5 px-6 sm:py-6 text-center">
                        {{ __('Activation Failed') }}
                    </header>

                    <div class="text-center text-gray-700 text-lg">
                        <p class="mb-4">The activation link is invalid or has expired.</p>
                        <p class="mb-6">Should you received more than one invitation emails please make sure you use the newest one.</p>
                        <p>If the issue persist please contact <a href="mailto:admin@irishjudoassociation.ie" class="font-bold underline">admin@irishjudoassociation.ie</a> with your details</p>
                    </div>
                    <div class="text-center text-xs text-gray-400 italic font-medium mt-8">
                        Error: User not found.
                    </div>

                </section>

        </div>
    </main>
@endsection
