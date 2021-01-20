@extends('layouts.app')

@section('content')
    <main class="sm:container sm:mx-auto sm:mt-10">
        <div class="w-full sm:px-6">

            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

                <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                    <i class="fas fa-sticky-note mr-2 text-gray-500"></i> Add new note
                </header>

                <div class="w-full p-6">
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul id="errors list-unstyled">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ action('App\Http\Controllers\MembernoteController@store') }}"
                          role="form">
                        @csrf
                        <input type="hidden" name="member_id" value="{{ $member_id }}">
                        <input type="hidden" name="url" value="{{ $url }}">
                        <input type="hidden" name="author" value="{{ Auth::user()->id }}">
                        <div class="w-full border-2 border-gray-300 rounded-xl p-8 mb-4">
                            <div class="mb-4 flex items-start">
                                <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="title">
                                    Title
                                </label>
                                <input
                                    class="shadow border-gray-300 rounded w-full md:w-1/2 py-2 px-3 text-grey-darker"
                                    id="title" name="title" type="text" placeholder="Title" required>
                            </div>
                            <div class="mb-4 flex items-start">
                                <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="body">
                                    Body
                                </label>
                                <textarea id="body" name="body" rows="20" cols="50" class="shadow border-gray-300 rounded w-full md:w-1/2 py-2 px-3 text-grey-darker" placeholder="Insert body of the note">
                                </textarea>
                            </div>
                            <div class="mt-6">
                                <input type="submit" value="+ Add new note" class="button-judo">
                            </div>
                        </div>

                    </form>
                </div>
            </section>
        </div>
    </main>
@endsection
