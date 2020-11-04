@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-10">
    <div class="w-full sm:px-6">

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                Clubs Index
            </header>

            <div class="w-full p-6">
                <div class="text-gray-700 block py-4">
                    <x-button class="button-judo mb-8" href="{{ route('clubs.create') }}">
                        + Add new club
                    </x-button>
                </div>
                @livewire('clubs-table')
            </div>
        </section>
    </div>
</main>
@endsection
