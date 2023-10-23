@extends('layouts.app')

@section('content')
    <main class="sm:container sm:mx-auto sm:mt-10">
        <div class="w-full sm:px-6">
            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm shadow-lg">

                <header class="font-semibold text-xl bg-gray-600 text-gray-100 py-4 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                    User accounts
                </header>
            @livewire('user-view')
            </section>
        </div>
    </main>
@endsection
