@extends('layouts.app')

@section('content')
    <main class="sm:container sm:mx-auto sm:mt-10">
        <div class="w-full sm:px-6">

            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

                <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                    Edit {{ $venue->name }} details
                </header>

                <div class="w-full p-6">
                    <a href="{{ route('clubs.show', $venue->club_id) }}#venues" class="rounded px-2 py-1
                    bg-blue-100 my-8
                    mb-16 font-semibold
                    text-blue-800"><< Back to Club
                        page</a>
                    @if(Session::has('message'))
                        <p class="bg-green-100 text-green-700 p-6 rounded my-4">{{ Session::get('message') }}</p>
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
                    <form method="POST" action="{{ action('App\Http\Controllers\VenueController@update', $venue->id) }}"
                          role="form" enctype="multipart/form-data">
                        @csrf
                        <input name="_method" type="hidden" value="PUT">
                        <div class="w-full border-2 border-gray-300 rounded-xl p-8 my-4">
                            <div class="mb-4">
                                <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2"
                                       for="name">
                                    Venue Name
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full md:w-1/2 py-2 px-3 text-grey-darker"
                                    id="name" name="name" type="text" value="{{ $venue->name }}" required>
                            </div>
                            <div class="mb-4">
                                <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="address1">
                                    Address Line 1
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full md:w-1/2 py-2 px-3 text-grey-darker"
                                    id="address1" name="address1" type="text" value="{{$venue->address1}}" required>
                            </div>
                            <div class="mb-4">
                                <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="address2">
                                    Address Line 2
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full md:w-1/2 py-2 px-3 text-grey-darker"
                                    id="address2" name="address2" type="text" value="{{$venue->address2}}">
                            </div>
                            <div class="mb-4">
                                <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="city">
                                    City/Town
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full md:w-1/2 py-2 px-3 text-grey-darker"
                                    id="city" name="city" type="text" value="{{$venue->city}}" required>
                            </div>
                            <div class="mb-4">
                                <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="county">
                                    County
                                </label>
                                <select class="shadow border rounded w-64 py-2 px-3 text-grey-darker" id="county" name="county" type="text">
                                    <option value="{{$venue->county}}" selected>{{ ucfirst($venue->county)}}</option>
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
                            <div class="mb-12">
                                <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="eircode">
                                    Eircode / Postcode
                                </label>
                                <input class="shadow appearance-none border rounded w-64 py-2 px-3 text-grey-darker"
                                       id="eircode" name="eircode" type="text" value="{{ $venue->eircode }}">
                            </div>
                            <div class="mb-4">
                                <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="contact">
                                    Contact Name
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full md:w-1/2 py-2 px-3 text-grey-darker"
                                    id="contact" name="contact" type="text" value="{{ $venue->contact }}">
                            </div>
                            <div class="mb-12">
                                <label class="inline-block w-48 text-grey-darker text-sm font-bold mb-2" for="phone">
                                    Phone
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full md:w-1/2 py-2 px-3 text-grey-darker"
                                    id="phone" name="phone" type="text" value="{{ $venue->phone }}">
                            </div>
                        </div>
                        <div class="mt-6">
                            <input type="submit" value="Save changes" class="button-judo">
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </main>
@endsection
