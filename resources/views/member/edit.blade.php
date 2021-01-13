@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-10">
    <div class="w-full sm:px-6">

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header class="font-semibold bg-gray-200 text-gray-500 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                Edit <span class="text-gray-700 font-bold">{{ $member->first_name }} {{ $member->last_name }}</span> details
            </header>

            <div class="w-full p-6">
                @if(Session::has('message'))
                    <p class="bg-green-100 text-green-700 p-6 rounded mb-4">{{ Session::get('message') }}</p>
                    <a href="{{ route('member.show', $member->id) }}" class="text-blue-600 font-bold hover:text-blue-300"> << Back to detail view </a>
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
                <form method="POST" action="{{ action('App\Http\Controllers\MemberController@update', ['member' => $member->id]) }}"
                      role="form">
                    @csrf
                    <input name="_method" type="hidden" value="PUT">
                    <div class="w-full border-2 border-gray-300 rounded-xl p-8 mb-4">
                        <div class="mb-4 flex flex-wrap">
                            <div class="w-full md:w-1/2">
                                <label class="inline-block w-32 text-grey-darker text-sm font-bold mb-2" for="role">
                                    Club
                                </label>
                                <select name="club_id" id="club_id"
                                        class="shadow border-gray-300 rounded w-auto py-2 px-3 text-grey-darker">

                                    @foreach ($clubs as $club)
                                        <option value="{{ $club->id }}"
                                                @if ($member->club_id == $club->id)
                                                selected
                                            @endif

                                        >{{ $club->name}}</option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="w-full md:w-1/2">
                                <label class="inline-block w-32 text-grey-darker text-sm font-bold mb-2"
                                           for="number">
                                        Membership no
                                    </label>
                                    <input
                                        class="shadow  border-gray-300  rounded w-full md:w-1/2 py-2 px-3 text-grey-darker"
                                id="number" name="number" type="text" value="{{ $member->number }}" required>
                            </div>
                        </div>
                        <div class="mb-4 flex flex-wrap">
                            <div class="w-full md:w-1/2 ">
                                <label class="inline-block w-32 text-grey-darker text-sm font-bold mb-2"
                                       for="first_name">
                                    First Name
                                </label>
                                <input
                                    class="shadow  border-gray-300  rounded w-full md:w-1/2 py-2 px-3 text-grey-darker"
                            id="first_name" name="first_name" type="text" placeholder="First name" required value="{{ $member->first_name }}">
                            </div>
                            <div class="w-full md:w-1/2">
                                <label class="inline-block w-32 text-grey-darker text-sm font-bold mb-2"
                                       for="last_name">
                                    Last Name
                                </label>
                                <input
                                    class="shadow  border-gray-300  rounded w-full md:w-1/2 py-2 px-3 text-grey-darker"
                                    id="last_name" name="last_name" type="text" placeholder="Last name" value="{{ $member->last_name }}" required>
                            </div>
                        </div>
                        <div class="mb-4 flex flex-wrap">
                            <div class="w-full md:w-1/2">
                                <label class="inline-block w-32 text-grey-darker text-sm font-bold mb-2" for="dob">
                                    Date of birth
                                </label>
                                <input
                                    class="shadow  border-gray-300  rounded w-full md:w-1/2 py-2 px-3 text-grey-darker"
                            id="dob" name="dob" type="date" value="{{ $member->dob }}">
                            </div>
                            <div class="w-full md:w-1/2 mt-4 md:mt-0">
                                <label class="inline-block w-32 text-grey-darker text-sm font-bold mb-2"
                                       for="gender">
                                    Gender
                                </label>
                                <div class="inline-block">
                                    <div class="inline-block mr-6">
                                        <input class="inline-block" type="radio" id="female" name="gender"
                                               value="Female" @if ($member->gender == 'Female')
                                                   checked
                                               @endif>
                                        <label for="female" class="inline-block">Female</label><br>
                                    </div>
                                    <div class="inline-block">
                                        <input class="inline-block" type="radio" id="male" name="gender"
                                               value="Male" @if ($member->gender == 'Male')
                                               checked
                                           @endif>
                                        <label for="male">Male</label><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 mt-4">
                            <label class="inline-block w-32 text-grey-darker text-sm font-bold mb-2"
                                   for="parent">
                                Parent/Guardian
                            </label>
                            <input
                                @if ($member->parent)
                                class="shadow border-gray-300 rounded w-full md:w-1/2 py-2 px-3 text-grey-darker"
                                @else
                                class="shadow border-gray-300 bg-gray-500 rounded w-full md:w-1/2 py-2 px-3
                                text-grey-darker"
                                disabled
                                @endif
                                id="parent" name="parent" type="text" value="{{ $member->parent}}">
                        </div>
                    </div>
                    <div class="w-full border-2 border-gray-300 rounded-xl p-8 mb-4">
                        <div class="mb-4 flex flex-wrap">
                            <div class="w-full md:w-1/2">
                                <label class="inline-block w-32 text-grey-darker text-sm font-bold mb-2"
                                       for="address1">
                                    Address 1
                                </label>
                                <input
                                    class="shadow  border-gray-300  rounded w-full md:w-1/2 py-2 px-3 text-grey-darker"
                            id="address1" name="address1" type="text" placeholder="Address 1" value="{{ $member->address1}}" required>
                            </div>
                            <div class="w-full md:w-1/2">
                                <label class="inline-block w-32 text-grey-darker text-sm font-bold mb-2"
                                       for="address2">
                                    Address 2
                                </label>
                                <input
                                    class="shadow  border-gray-300  rounded w-full md:w-1/2 py-2 px-3 text-grey-darker"
                                    id="address2" name="address2" type="text" placeholder="Address 2" value="{{ $member->address2}}" >
                            </div>
                        </div>
                        <div class="mb-4 flex flex-wrap">
                            <div class="w-full md:w-1/2">
                                <label class="inline-block w-32 text-grey-darker text-sm font-bold mb-2"
                                       for="city">
                                    Town / City
                                </label>
                                <input
                                    class="shadow  border-gray-300  rounded w-full md:w-1/2 py-2 px-3 text-grey-darker"
                                    id="city" name="city" type="text" placeholder="Town / City" value="{{ $member->city }}" >
                            </div>
                            <div class="w-full md:w-1/2">
                                <label class="inline-block w-32 text-grey-darker text-sm font-bold mb-2"
                                       for="address1">
                                    County
                                </label>
                                <select class="shadow border-gray-300 rounded w-64 py-2 px-3 text-grey-darker" id="county"
                                        name="county" type="text"
                                        placeholder="County">
                                    <option value="{{ $member->county }}"  selected>{{ ucfirst($member->county) }}</option>
                                    <optgroup label="Ireland and NI only">
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
                                    </optgroup>
                                    <optgroup label="Great Britain and overseas">
                                        <option value="england">England</option>
                                        <option value="scotland">Scotland</option>
                                        <option value="wales">Wales</option>
                                        <option value="overseas">Overseas</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="mb-4 flex flex-wrap">
                            <div class="w-full md:w-1/2">
                                <label class="inline-block w-32 text-grey-darker text-sm font-bold mb-2"
                                       for="eircode">
                                    Eircode
                                </label>
                                <input
                                    class="shadow  border-gray-300  rounded w-full md:w-1/2 py-2 px-3 text-grey-darker"
                                    id="eircode" name="eircode" type="text" placeholder="Eircode / Postcode" value="{{ $member->eircode }}">
                            </div>
                            <div class="w-full md:w-1/2">
                                <label class="inline-block w-32 text-grey-darker text-sm font-bold mb-2"
                                       for="province">
                                    Province
                                </label>
                                <select class="shadow border-gray-300 rounded w-64 py-2 px-3 text-grey-darker" id="province"
                                        type="text" placeholder="Province" name="province">
                                    <option value="{{ $member->province }}" selected>{{ ucfirst($member->province) }}</option>
                                    <option value="connaught">Connaught</option>
                                    <option value="leinster">Leinster</option>
                                    <option value="munster">Munster</option>
                                    <option value="ulster">Ulster</option>
                                    <option value="n/a">N/A</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-4 flex flex-wrap">
                            <div class="w-full sm:w-full md:w-1/2 ">
                                <label class="inline-block w-32 text-grey-darker text-sm font-bold mb-2"
                                       for="email">
                                    Email
                                </label>
                                <input
                                    class="shadow  border-gray-300  rounded w-full md:w-1/2 py-2 px-3 text-grey-darker"
                                    id="email" name="email" type="text" placeholder="Email" value="{{ $member->email }}">
                            </div>
                            <div class="w-full sm:w-full md:w-1/2 ">
                                <label class="inline-block w-32 text-grey-darker text-sm font-bold mb-2"
                                       for="phone">
                                    Phone
                                </label>
                                <input
                                    class="shadow  border-gray-300  rounded w-full md:w-1/2 py-2 px-3 text-grey-darker"
                                    id="phone" name="phone" type="text" placeholder="Phone" value="{{ $member->phone }}">
                            </div>
                        </div>
                        <div class="mb-4 flex flex-wrap">
                            <div class="w-full md:w-1/2">
                                <label class="inline-block w-32 text-grey-darker text-sm font-bold mb-2"
                                       for="mobile">
                                    Mobile
                                </label>
                                <input
                                    class="shadow  border-gray-300  rounded w-full md:w-1/2 py-2 px-3 text-grey-darker"
                                    id="mobile" name="mobile" type="text" placeholder="Mobile" value="{{ $member->mobile }}">
                            </div>
                        </div>
                    </div>
                    <div class="w-full border-2 border-gray-300 rounded-xl p-8 mb-4" x-data="{adaptive: false}">
                        <div class="w-full mb-4">
                            <label class="inline-block w-32 text-grey-darker text-sm font-bold mb-2" for="gender">
                                Adaptive Judo
                            </label>
                            <div class="inline-block">
                                <div class="inline-block mr-6">
                                    <input class="inline-block" type="radio" id="yes" name="adaptive"
                                           value="1" @click="adaptive = true">
                                    <label for="yes" class="inline-block">Yes</label><br>
                                </div>
                                <div class="inline-block">
                                    <input class="inline-block" type="radio" id="no" name="adaptive" value="0"
                                           checked @click="adaptive = false">
                                    <label for="no">No</label><br>
                                </div>
                            </div>
                        </div>
                        <div class="w-full" x-show="adaptive">
                            <label class="inline-block w-32 text-grey-darker text-sm font-bold mb-2"
                                   for="special">
                                Type
                            </label>
                            <input
                                class="shadow border-gray-300 rounded w-full md:w-1/2 py-2 px-3 text-grey-darker"
                                id="special" name="special" type="text" placeholder="List the requirements">
                        </div>
                    </div>
                    <div class="mt-6">
                        <input type="submit" value="Update record" class="button-judo">
                    </div>
                </form>
                <p class="text-gray-700 mt-6">

                </p>
            </div>
        </section>
    </div>
</main>
@endsection

@section('bottomScripts')
    <script>
        let dob = document.getElementById('dob');

        dob.addEventListener('change', function() {
            var enteredDate = document.getElementById('dob').value;
            var age = new Date(new Date() - new Date(enteredDate)).getFullYear() - 1970;
            if (age < 18) {
                let parent = document.getElementById('parent');
                parent.disabled=false;
                parent.classList.remove('bg-gray-500');
            } else {
                let parent = document.getElementById('parent');
                parent.value="";
                parent.disabled=true;
                parent.classList.add('bg-gray-500');

            }
        });
    </script>
@endsection
