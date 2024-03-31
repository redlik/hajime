@extends('layouts.app')

@section('content')
<main class="sm:mx-2 mx-10 sm:mt-10">
    <div class="w-full sm:px-6">

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header class="font-semibold text-xl bg-gray-600 text-gray-100 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                All Members Index
            </header>

            <div class="w-full p-6">
                <div class="text-gray-700 block py-4">
                    <x-button class="button-success bg-judo-green mb-8" href="{{ route('member.create') }}">
                        + Add new Member
                    </x-button>
                </div>
                @livewire('members-table')
            </div>
        </section>
    </div>
</main>
@endsection
