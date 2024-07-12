@extends('layouts.app')

@section('content')
    <main class="sm:mx-2 mx-10 sm:mt-10">
        <div class="w-full sm:px-6" x-data="{openModal : $wire.entangle('showModal')}">

            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm">

                <header
                    class="font-semibold text-xl bg-gray-600 text-gray-100 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                    Options
                </header>
                <div class="px-8 py-8">
                    <h3 class="text-xl font-bold mb-4">Disable club access</h3>

                    @livewire('club-access-toggle')
                </div>
            </section>
        </div>

    </main>
@endsection
