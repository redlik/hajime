@extends('layouts.app')

@section('content')
    <main class="sm:mx-2 mx-10 sm:mt-10">
        <div class="w-full sm:px-6">

            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

                <header class="font-semibold text-xl bg-gray-600 text-gray-100 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                    Activity log
                </header>
                <div class="fi-ta-container p-8 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm">
                    @livewire('activation-codes-view')
                </div>
            </section>
        </div>
    </main>
@endsection
