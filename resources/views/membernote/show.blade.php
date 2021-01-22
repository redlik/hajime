@extends('layouts.app')

@section('content')
    <main class="sm:container sm:mx-auto sm:mt-10">
        <div class="w-full sm:px-6">

            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

                <header class="font-semibold bg-gray-600 text-gray-100 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                    <i class="fas fa-sticky-note mr-2 text-gray-500"></i> {{ $note->title }}
                </header>

                <div class="w-full p-6">
                    <div class="w-full border-2 border-gray-300 rounded-xl p-8 mb-4">
                        <div class="w-full"><p>
                                {!! nl2br(e($note->body))!!}
                            </p></div>

                    </div>
                    <div class="w-full py-8 mb-4">
                        <a href="{{ url()->previous().'#notes' }} "class="gray-button mt-8"><< Back to Member page</a>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
