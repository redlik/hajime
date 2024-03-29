@extends('layouts.app')

@section('content')
    <main class="sm:container sm:mx-auto sm:mt-10">
        <div class="w-full sm:px-6">

            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

                <header class="font-semibold bg-gray-600 text-gray-100 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                    Edit <span class="text-gray-200 font-bold">{{ $club->name }}</span> details
                </header>

                <div class="w-full p-6">
                    @if(Session::has('message'))
                        <p class="bg-green-100 text-green-700 p-6 rounded mb-4">{{ Session::get('message') }}</p>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul id="errors list-unstyled">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="mb-4">
                        <a class="blue-pillow" href="{{ route('clubs.show', $club->id) }}"> < Back to detail view </a>
                    </div>
                    <form method="POST" action="{{ action('App\Http\Controllers\ClubController@update', ['club' => $club->id]) }}" role="form">
                        @csrf
                        <input name="_method" type="hidden" value="PUT">
                        <div class="w-full border-2 border-gray-300 rounded-xl mb-4 p-8">
                            <div class="mb-4">
                                <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="name">
                                    Club Name
                                </label>
                                <input class="input-box"
                                       id="name" name="name" type="text" value="{{ $club->name }}">
                            </div>
                            <div class="mb-4">
                                <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="type">
                                    Club Type
                                </label>
                                <select class="input-box w-64" id="type"
                                        name="type" type="text"
                                        placeholder="Club type">
                                    <option value="ordinary club"
                                            @if ($club->type == 'ordinary club')
                                                selected
                                        @endif
                                    >Ordinary club
                                    </option>
                                    <option value="school club"
                                            @if ($club->type == 'school club')
                                                selected
                                        @endif >School club
                                    </option>
                                    <option value="university club"
                                            @if ($club->type == 'university club')
                                                selected
                                        @endif>University club
                                    </option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="status">
                                    Status
                                </label>
                                <select class="input-box w-64"
                                        id="status" name="status" required>
                                    <option value="Active"
                                            @if ($club->status == "Active")
                                                selected
                                        @endif
                                    >Active
                                    </option>
                                    <option value="Inactive"
                                            @if ($club->status == "Inactive")
                                                selected
                                        @endif
                                    >Inactive
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2"
                                       for="affiliation">
                                    Affiliation paid on
                                </label>
                                <input class="input-box w-64"
                                       id="affiliation" name="affiliation" type="date" value="{{ $club->affiliation }}">
                            </div>
                        </div>
                        <div class="w-full border-2 border-gray-300 rounded-xl mb-4 p-8">
                            <div class="mb-4">
                                <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="address1">
                                    Address Line 1
                                </label>
                                <input class="input-box w-1/2"
                                       id="address1" name="address1" type="text" value="{{ $club->address1 }}">
                            </div>
                            <div class="mb-4">
                                <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="address2">
                                    Address Line 2
                                </label>
                                <input class="input-box w-1/2"
                                       id="address2" name="address2" type="text" value="{{ $club->address2 }}">
                            </div>
                            <div class="mb-4">
                                <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="town">
                                    Town / City
                                </label>
                                <input class="input-box w-1/2"
                                       id="city" name="city" type="text" value="{{ $club->city }}">
                            </div>
                            <div class="mb-4">
                                <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="county">
                                    County
                                </label>
                                <select class="input-box w-64" id="county"
                                        name="county"
                                        type="text"
                                        placeholder="County">
                                    <option value="{{ $club->county }}" selected>{{ ucfirst($club->county) }}</option>
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
                                <select class="input-box w-64" id="province"
                                        type="text" placeholder="Province" name="province">
                                    <option value="{{ $club->province }}" selected>{{ ucfirst($club->province) }}</option>
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
                                <input class="input-box w-64"
                                       id="eircode" name="eircode" type="text" value="{{ $club->eircode }}">
                            </div>
                        </div>
                        <div class="w-full border-2 border-gray-300 rounded-xl mb-4 p-8">
                            <div class="mb-4">
                                <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="phone">
                                    Telephone
                                </label>
                                <input class="input-box w-64"
                                       id="phone" name="phone" type="text" value="{{ $club->phone }}">
                            </div>
                            <div class="mb-4">
                                <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="email">
                                    Email
                                </label>
                                <input class="input-box w-64"
                                       id="email" name="email" type="email" value="{{ $club->email }}">
                            </div>
                            <div class="mb-4">
                                <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="website">
                                    Website
                                </label>
                                <input class="input-box w-1/2"
                                       id="website" name="website" type="text" value="{{ $club->website }}">
                            </div>
                            <div>
                                <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="facebook">
                                    Facebook
                                </label>
                                <input class="input-box w-1/2"
                                       id="facebook" name="facebook" type="text" value="{{ $club->facebook }}">
                            </div>
                        </div>

                        <div class="w-full border-2 border-gray-300 rounded-xl mb-4 p-8">
                            <div class="mb-4">
                                <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="compliant">
                                    Club fully compliant
                                </label>
                                <div class="inline-block w-64">
                                    <div class="inline-block mr-6">
                                        <input class="inline-block" type="radio" id="yes" name="compliant" value="1"
                                               @if ($club->compliant)
                                                   checked
                                            @endif
                                        >
                                        <label for="yes" class="inline-block">Yes</label><br>
                                    </div>
                                    <div class="inline-block">
                                        <input class="inline-block" type="radio" id="no" name="compliant" value="0"
                                               @if (!$club->compliant)
                                                   checked
                                            @endif
                                        >
                                        <label for="no">No</label><br>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="voting">
                                    Voting rights obtained
                                </label>
                                <div class="inline-block w-64">
                                    <div class="inline-block mr-6">
                                        <input class="inline-block" type="radio" id="yes" name="voting_rights" value="1"
                                               @if ($club->voting_rights)
                                                   checked
                                            @endif
                                        >
                                        <label for="yes" class="inline-block">Yes</label><br>
                                    </div>
                                    <div class="inline-block">
                                        <input class="inline-block" type="radio" id="no" name="voting_rights" value="0"
                                               @if (!$club->voting_rights)
                                                   checked
                                            @endif>
                                        <label for="no">No</label><br>
                                    </div>
                                </div>
                            </div>
                            <div x-data="{assessment: '{{ $club->ethics_assessment }}'}">
                                <div class="mb-2">
                                    <label class="inline-block w-auto text-grey-darker text-sm font-bold mb-2 mr-4" for="ethics_assessment">
                                        Sport Ireland Ethics Self-Assessment Completed
                                    </label>
                                    <div class="inline-block w-64">
                                        <div class="inline-block mr-6">
                                            <input x-model="assessment" class="inline-block" type="radio" id="yes" name="ethics_assessment" value="1"
                                                   @if($club->ethics_assessment)
                                                       checked
                                                @endif
                                            >
                                            <label for="yes" class="inline-block">Yes</label><br>
                                        </div>
                                        <div class="inline-block">
                                            <input x-model="assessment" class="inline-block" type="radio" id="no" name="ethics_assessment" value="0"
                                                   @if(!$club->ethics_assessment)
                                                       checked
                                                @endif>
                                            <label for="no">No</label><br>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2 mr-4" for="ethics_assessment">
                                        Completion date
                                    </label>
                                    <input class="input-box" type="date" id="ethics_assessment_date" name="ethics_assessment_date"
                                           x-bind:disabled="(assessment == '1') ? false : true" x-bind:required="(assessment == '1') ? true : false"
                                           value="{{ $club->ethics_assessment_date }}">
                                </div>
                            </div>
                        </div>
                        <div class="w-full border-2 border border-gray-300 rounded-xl mb-4 p-8">
                            <p class="font-bold mb-4">Select
                                <span class="text-judo-600">Main Postal</span> correspondence
                                address:</p>
                            <input type="radio" class="text-gray-600" name="postal" value="Head Coach" id="postal_head"
                                   @if ($club->postal == "Head Coach")
                                       checked
                                @endif>
                            <label for="postal_head" class="text-gray-600 mr-12">Head Coach</label>
                            <input type="radio" class="input-box text-gray-600" name="postal" value="Secretary" id="postal_secretary"
                                   @if ($club->postal == "Secretary")
                                       checked
                                @endif>
                            <label for="postal_secretary" class="text-gray-600">Secretary</label>

                            <p class="font-bold mb-4 mt-12">Select
                                <span class="text-judo-600">Email</span> correspondence
                                address:</p>
                            <input type="radio" class="text-gray-600" name="correspondence" value="Head Coach"
                                   id="postal_head"
                                   @if ($club->correspondence == "Head Coach")
                                       checked
                                @endif>
                            <label for="postal_head" class="text-gray-600 mr-12">Head Coach</label>
                            <input type="radio" class="text-gray-600" name="correspondence" value="Secretary" id="postal_secretary"
                                   @if ($club->correspondence == "Secretary")
                                       checked
                                @endif>
                            <label for="postal_secretary" class="text-gray-600 ml-1">Secretary</label>
                        </div>
                        <div class="mt-6">
                            <input type="submit" value="Update details" class="button-judo">
                        </div>
                    </form>
                    <p class="text-gray-700 mt-6">

                    </p>
                </div>
            </section>
        </div>
    </main>
@endsection
