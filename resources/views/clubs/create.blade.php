@extends('layouts.app')

@section('content')
    <main class="sm:container sm:mx-auto sm:mt-10">
        <div class="w-full sm:px-6">

            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

                <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                    Add new club panel
                </header>

                <div class="w-full p-6">
                    <form>
                        <div class="mb-4">
                            <label class="inline-block w-1/5 text-grey-darker text-sm font-bold mb-2" for="name">
                                Club Name
                            </label>
                            <input class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-grey-darker" id="name" type="text" placeholder="Club name">
                        </div>
                        <div class="mb-4">
                            <label class="inline-block w-1/5 text-grey-darker text-sm font-bold mb-2" for="address1">
                                Address Line 1
                            </label>
                            <input class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-grey-darker" id="address1" type="text" placeholder="Address Line 1">
                        </div>
                        <div class="mb-4">
                            <label class="inline-block w-1/5 text-grey-darker text-sm font-bold mb-2" for="address2">
                                Address Line 2
                            </label>
                            <input class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-grey-darker" id="address2" type="text" placeholder="Address Line 2">
                        </div>
                        <div class="mb-4">
                            <label class="inline-block w-1/5 text-grey-darker text-sm font-bold mb-2" for="town">
                                Town / City
                            </label>
                            <input class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-grey-darker" id="town" type="text" placeholder="Town/City">
                        </div>
                        <div class="mb-4">
                            <label class="inline-block w-1/5 text-grey-darker text-sm font-bold mb-2" for="town">
                                County
                            </label>
                            <input class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-grey-darker" id="town" type="text" placeholder="Town/City">
                        </div>

                    </form>
                    <p class="text-gray-700 mt-6">
                        <x-button class="button-success" href="/">
                            + Add Club
                        </x-button>
                    </p>
                </div>
            </section>
        </div>
    </main>
@endsection
