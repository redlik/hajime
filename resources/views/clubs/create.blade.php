@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-10">
    <div class="w-full sm:px-6">

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header class="font-semibold bg-gray-600 text-gray-100 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                Add new club
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
                <form method="POST" action="{{ action('App\Http\Controllers\ClubController@store') }}" role="form">
                    @csrf
                    <div class="w-full border-2 border-gray-300 rounded-xl mb-4 p-8">
                        <div class="mb-4">
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="name">
                                Club Name
                            </label>
                            <input class="shadow border-gray-300 rounded w-1/2 py-2 px-3 text-grey-darker"
                                id="name" name="name" type="text" placeholder="Club name">
                        </div>
                        <div class="mb-4">
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="type">
                                Club Type
                            </label>
                            <select class="shadow border-gray-300 rounded w-64 py-2 px-3 text-grey-darker" id="type"
                                    name="type" type="text"
                                placeholder="Club type">
                                <option value="" disabled selected>Select club type</option>
                                <option value="ordinary club">Ordinary club</option>
                                <option value="school club">School club</option>
                                <option value="university club">University club</option>
                            </select>
                        </div>
                        <div class="mb-4">
                                <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="status">
                                    Status
                                </label>
                                <select class="shadow border-gray-300 rounded w-64 py-2 px-3 text-grey-darker"
                                        id="status" name="status" required>
                                    <option value="" disabled selected>Select status</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                        </div>
                        <div>
                                <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2"
                                       for="affiliation">
                                    Affiliation paid on
                                </label>
                                <input class="shadow border-gray-300 rounded w-64 py-2 px-3 text-grey-darker"
                                       id="affiliation" name="affiliation" type="date">
                        </div>
                    </div>
                    <div class="w-full border-2 border-gray-300 rounded-xl mb-4 p-8">
                        <div class="mb-4">
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="address1">
                                Address Line 1
                            </label>
                            <input class="shadow border-gray-300 rounded w-1/2 py-2 px-3 text-grey-darker"
                                id="address1" name="address1" type="text" placeholder="Address Line 1">
                        </div>
                        <div class="mb-4">
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="address2">
                                Address Line 2
                            </label>
                            <input class="shadow border-gray-300 rounded w-1/2 py-2 px-3 text-grey-darker"
                                id="address2" name="address2" type="text" placeholder="Address Line 2">
                        </div>
                        <div class="mb-4">
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="city">
                                Town / City
                            </label>
                            <input class="shadow border-gray-300 rounded w-1/2 py-2 px-3 text-grey-darker"
                                id="city" name="city" type="text" placeholder="Town/City">
                        </div>
                        <div class="mb-4">
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="county">
                                County
                            </label>
                            <select class="shadow border-gray-300 rounded w-64 py-2 px-3 text-grey-darker" id="county"
                                    name="county" type="text"
                                placeholder="County">
                                <option value="" disabled selected>Select county</option>
                                <option value="antrim">Antrim</option>
                                <option value="armagh">Armagh</option>
                                <option value="carlow">Carlow</option>
                                <option value="cavan">Cavan</option>
                                <option value="clare">Clare</option>
                                <option value="cork">Cork</option>
                                <option value="derry">Derry</option>
                                <option value="donegal">Donegal</option>
                                <option value="down">Down</option>
                                <option value="dublin">Dublin</option>
                                <option value="fermanagh">Fermanagh</option>
                                <option value="galway">Galway</option>
                                <option value="kerry">Kerry</option>
                                <option value="kildare">Kildare</option>
                                <option value="kilkenny">Kilkenny</option>
                                <option value="laois">Laois</option>
                                <option value="leitrim">Leitrim</option>
                                <option value="limerick">Limerick</option>
                                <option value="longford">Longford</option>
                                <option value="louth">Louth</option>
                                <option value="mayo">Mayo</option>
                                <option value="meath">Meath</option>
                                <option value="monaghan">Monaghan</option>
                                <option value="offaly">Offaly</option>
                                <option value="roscommon">Roscommon</option>
                                <option value="sligo">Sligo</option>
                                <option value="tipperary">Tipperary</option>
                                <option value="tyrone">Tyrone</option>
                                <option value="waterford">Waterford</option>
                                <option value="westmeath">Westmeath</option>
                                <option value="wexford">Wexford</option>
                                <option value="wicklow">Wicklow</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="province">
                                Province
                            </label>
                            <select class="shadow border-gray-300 rounded w-64 py-2 px-3 text-grey-darker" id="province"
                                type="text" placeholder="Province" name="province">
                                <option value="" disabled selected>Select province</option>
                                <option value="connaught">Connaught</option>
                                <option value="leinster">Leinster</option>
                                <option value="munster">Munster</option>
                                <option value="ulster">Ulster</option>
                            </select>
                        </div>
                        <div>
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="eircode">
                                Eircode / Postcode
                            </label>
                            <input class="shadow border-gray-300 rounded w-64 py-2 px-3 text-grey-darker"
                                id="eircode" name="eircode" type="text" placeholder="Eircode / Post Code">
                        </div>
                    </div>
                    <div class="w-full border-2 border-gray-300 rounded-xl mb-4 p-8">
                        <div class="mb-4">
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="phone">
                                Telephone
                            </label>
                            <input class="shadow border-gray-300 rounded w-64 py-2 px-3 text-grey-darker"
                                id="phone" name="phone" type="text" placeholder="Telephone">
                        </div>
                        <div class="mb-4">
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="email">
                                Email
                            </label>
                            <input class="shadow border-gray-300 rounded w-64 py-2 px-3 text-grey-darker"
                                id="email" name="email" type="email" placeholder="Email">
                        </div>
                        <div class="mb-4">
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="website">
                                Website
                            </label>
                            <input class="shadow border-gray-300 rounded w-1/2 py-2 px-3 text-grey-darker"
                                id="website" name="website" type="text" placeholder="Website">
                        </div>
                        <div>
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="facebook">
                                Facebook
                            </label>
                            <input class="shadow border-gray-300 rounded w-1/2 py-2 px-3 text-grey-darker"
                                id="facebook" name="facebook" type="text" placeholder="Facebook page">
                        </div>
                    </div>

                    <div class="w-full border-2 border-gray-300 rounded-xl mb-4 p-8">
                        <div class="mb-4">
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="compliant">
                                Club fully compliant
                            </label>
                            <div class="inline-block w-64">
                                <div class="inline-block mr-6">
                                    <input class="inline-block" type="radio" id="yes" name="compliant" value="1">
                                    <label for="yes" class="inline-block">Yes</label><br>
                                </div>
                                <div class="inline-block">
                                    <input class="inline-block" type="radio" id="no" name="compliant" value="0">
                                    <label for="no">No</label><br>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="voting">
                                Voting rights obtained
                            </label>
                            <div class="inline-block w-64">
                                <div class="inline-block mr-6">
                                    <input class="inline-block" type="radio" id="yes" name="voting_rights" value="1">
                                    <label for="yes" class="inline-block">Yes</label><br>
                                </div>
                                <div class="inline-block">
                                    <input class="inline-block" type="radio" id="no" name="voting_rights" value="0">
                                    <label for="no">No</label><br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full border-2 border-gray-300 rounded-xl mb-4 p-8">
                        <p class="font-bold mb-4">Select <span class="text-judo-600">Main Postal</span> correspondence
                                                               address:</p>
                        <input type="radio" class="text-gray-600" name="postal" value="Head Coach" id="postal_head">
                        <label for="postal_head" class="text-gray-600 mr-12">Head Coach</label>
                        <input type="radio" class="text-gray-600" name="postal" value="Secretary" id="postal_secretary">
                        <label for="postal_secretary" class="text-gray-600">Secretary</label>

                        <p class="font-bold mb-4 mt-12">Select <span class="text-judo-600">Email</span> correspondence
                            address:</p>
                        <input type="radio" class="text-gray-600" name="correspondence" value="Head Coach"
                               id="postal_head">
                        <label for="postal_head" class="text-gray-600 mr-12">Head Coach</label>
                        <input type="radio" class="text-gray-600" name="correspondence" value="Secretary" id="postal_secretary">
                        <label for="postal_secretary" class="text-gray-600">Secretary</label>
                    </div>
                    <div class="mt-6">
                        <input type="submit" value="+ Add new club" class="button-judo">
                    </div>
                </form>
                <p class="text-gray-700 mt-6">

                </p>
            </div>
        </section>
    </div>
</main>
@endsection
