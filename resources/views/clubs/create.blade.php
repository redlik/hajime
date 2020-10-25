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
                    <div class="w-full border-2 border-gray-300 rounded-xl mb-4 p-8">
                        <div class="mb-4">
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="name">
                                Club Name
                            </label>
                            <input class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-grey-darker"
                                id="name" type="text" placeholder="Club name">
                        </div>
                        <div>
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="type">
                                Club Type
                            </label>
                            <select class="shadow border rounded w-64 py-2 px-3 text-grey-darker" id="town" type="text"
                                placeholder="Club type">
                                <option value="" disabled selected>Select club type</option>
                                <option value="ordinary club">Ordinary Club</option>
                                <option value="school club">School Club</option>
                                <option value="university club">University Club</option>
                            </select>
                        </div>
                    </div>
                    <div class="w-full border-2 border-gray-300 rounded-xl mb-4 p-8">
                        <div class="mb-4">
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="address1">
                                Address Line 1
                            </label>
                            <input class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-grey-darker"
                                id="address1" type="text" placeholder="Address Line 1">
                        </div>
                        <div class="mb-4">
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="address2">
                                Address Line 2
                            </label>
                            <input class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-grey-darker"
                                id="address2" type="text" placeholder="Address Line 2">
                        </div>
                        <div class="mb-4">
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="town">
                                Town / City
                            </label>
                            <input class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-grey-darker"
                                id="town" type="text" placeholder="Town/City">
                        </div>
                        <div class="mb-4">
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="town">
                                County
                            </label>
                            <select class="shadow border rounded w-64 py-2 px-3 text-grey-darker" id="town" type="text"
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
                            <select class="shadow border rounded w-64 py-2 px-3 text-grey-darker" id="province" type="text"
                                placeholder="Province">
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
                            <input class="shadow appearance-none border rounded w-64 py-2 px-3 text-grey-darker"
                                id="eircode" type="text" placeholder="Eircode / Post Code">
                        </div>
                        <div class="mt-8">
                            <x-button class="button-success" href="/">
                                + Additional training venue
                            </x-button>
                        </div>
                    </div>
                    <div class="w-full border-2 border-gray-300 rounded-xl mb-4 p-8">
                        <div class="mb-4">
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="phone">
                                Telephone
                            </label>
                            <input class="shadow appearance-none border rounded w-64 py-2 px-3 text-grey-darker"
                                id="phone" type="text" placeholder="Telephone">
                        </div>
                        <div class="mb-4">
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="email">
                                Email
                            </label>
                            <input class="shadow appearance-none border rounded w-64 py-2 px-3 text-grey-darker"
                                id="email" type="email" placeholder="Email">
                        </div>
                        <div class="mb-4">
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="website">
                                Website
                            </label>
                            <input class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-grey-darker"
                                id="website" type="text" placeholder="Website">
                        </div>
                        <div>
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="facebook">
                                Facebook
                            </label>
                            <input class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-grey-darker"
                                id="facebook" type="text" placeholder="Facebook page">
                        </div>
                    </div>
                    <div class="w-full border-2 border-gray-300 rounded-xl mb-4 p-8">
                        <div class="mb-8">
                            <x-button class="button-success mr-3" href="/">
                                + Add Head Coach
                            </x-button>
                            <x-button class="button-primary mr-3" href="/">
                                + Add Secretary
                            </x-button>
                            <x-button class="button-success mr-3" href="/">
                                + Add Designated Person
                            </x-button>
                            <x-button class="button-primary" href="/">
                                + Add Children's Officer
                            </x-button>
                        </div>
                        <div class="mb-4">
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="head-coach">
                                Head Coach
                            </label>
                            <div class="inline-block border rounded w-64 py-2 px-3 text-gray-400 bg-gray-200"
                                x-model="head-coach">Not set</div>
                        </div>
                        <div class="mb-4">
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="head-coach">
                                Secretary
                            </label>
                            <div class="inline-block border rounded w-64 py-2 px-3 text-gray-400 bg-gray-200"
                            x-model="secretary">Not set</div>
                        </div>
                        <div class="mb-4">
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="head-coach">
                                Designated person
                            </label>
                            <div class="inline-block border rounded w-64 py-2 px-3 text-gray-400 bg-gray-200"
                            x-model="designated-person">Not set</div>
                        </div>
                        <div>
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="head-coach">
                                Children's officer
                            </label>
                            <div class="inline-block border rounded w-64 py-2 px-3 text-gray-400 bg-gray-200"
                            x-model="children-officer">Not set</div>
                        </div>
                    </div>
                    <div class="w-full border-2 border-gray-300 rounded-xl mb-4 p-8">
                        <div class="mb-4">
                            <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="compliant">
                                Club fully compliant
                            </label>
                            <div class="inline-block w-64">
                                <div class="inline-block mr-6">
                                    <input class="inline-block" type="radio" id="yes" name="compliant" value="yes">
                                    <label for="yes" class="inline-block">Yes</label><br>
                                </div>
                                <div class="inline-block">
                                    <input class="inline-block" type="radio" id="no" name="compliant" value="no">
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
                                    <input class="inline-block" type="radio" id="yes" name="voting" value="yes">
                                    <label for="yes" class="inline-block">Yes</label><br>
                                </div>
                                <div class="inline-block">
                                    <input class="inline-block" type="radio" id="no" name="voting" value="no">
                                    <label for="no">No</label><br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6">
                        <x-button class="button-success" href="/">
                            + Add Club
                        </x-button>
                    </div>
                </form>
                <p class="text-gray-700 mt-6">
                    
                </p>
            </div>
        </section>
    </div>
</main>
@endsection
