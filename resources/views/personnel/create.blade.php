@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-10">
    <div class="w-full sm:px-6">

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                Add new club panel
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
                <form method="POST" action="{{ action('App\Http\Controllers\PersonnelController@store') }}" role="form">
                    @csrf
                    <input type="hidden" name="club_id" value="{{ $club }}">
                    <div class="w-full border-2 border-gray-300 rounded-xl p-8 mb-4">
                        <div class="mb-4">
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="role">
                                Role
                            </label>
                            <select name="role" id="role" class="shadow border rounded w-64 py-2 px-3 text-grey-darker">
                                <option value="" disabled selected>Select role</option>
                                <option value="Head Coach">Head Coach</option>
                                <option value="Secretary">Secretary</option>
                                <option value="Designated Officer">Designated Officer</option>
                                <option value="Children's Officer">Children's Officer</option>
                                <option value="Coach">Coach</option>
                                <option value="Volunteer">Volunteer</option>
                            </select>
                        </div>
                        <div>
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="name">
                                Person's Name
                            </label>
                            <input class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-grey-darker"
                                id="name" name="name" type="text" placeholder="Name">
                        </div>
                    </div>
                    <div class="w-full border-2 border-gray-300 rounded-xl p-8">
                        <h4 class="w-48 text-gray-500 text-xl font-bold mb-6">Vetting information:</h4>
                        <div class="mb-4">
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="name">
                                Vetting completion
                            </label>
                            <input class="shadow appearance-none border rounded w-48 py-2 px-3 text-grey-darker"
                                id="name" name="name" type="text" placeholder="Name">
                        </div>
                        <div>
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="name">
                                Vetting expiry
                            </label>
                            <input class="shadow appearance-none border rounded w-48 py-2 px-3 text-grey-darker"
                                id="name" name="name" type="text" placeholder="Name">
                        </div>
                        <h4 class="w-auto text-gray-500 text-xl font-bold mb-6 mt-16">Safeguarding information:</h4>
                        <div class="mb-4">
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="name">
                                Safeguarding completion
                            </label>
                            <input class="shadow appearance-none border rounded w-48 py-2 px-3 text-grey-darker"
                                id="name" name="name" type="text" placeholder="Name">
                        </div>
                        <div>
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="name">
                                Safeguarding expiry
                            </label>
                            <input class="shadow appearance-none border rounded w-48 py-2 px-3 text-grey-darker"
                                id="name" name="name" type="text" placeholder="Name">
                        </div>
                    </div>
                    <div class="mt-6">
                        <input type="submit" value="+ Add new person" class="button-success">
                    </div>
                </form>
                <p class="text-gray-700 mt-6">

                </p>
            </div>
        </section>
    </div>
</main>
@endsection
