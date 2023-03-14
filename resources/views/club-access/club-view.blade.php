@extends('layouts.app')

@section('content')
    <main class="sm:container sm:mx-auto sm:mt-10">
        <div class="w-full sm:px-6">

            <section class="flex flex-col break-words bg-gray-100 sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

                <header
                    class="font-bold text-xl bg-gray-600 text-gray-100 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md flex
                     flex-wrap justify-between content-center mb-6">
                    <div>
                        {{ $club->name }}
                    </div>
                    <div class="font-bold text-sm"> {{ ucfirst($club->type) }} </div>
                </header>
                <div id="main" x-data="{openTab: window.location.hash ? window.location.hash : '#details',
                                      activeClasses:
                                      'bg-gray-600 text-gray-100 rounded-full shadow-inner shadow outline-none',
                                      inactiveClasses:
                                      'text-gray-500 bg-gray-100 hover:text-gray-700 hover:bg-gray-200 rounded-full'
                                    }">
                    {{-- TABS SECTION --}}
                    <div class="w-full px-6">
                        <ul class="flex flex-wrap justify-center">
                            <li class="-mb-px mr-3 md:mb-0 sm:mb-3" :class="{ '-mb-px': openTab === '#details' }"
                                @click="openTab =
                        '#details'">
                                <a :class="openTab === '#details' ? activeClasses : inactiveClasses" class="bg-white
                            inline-block py-2 px-4 font-semibold" href="#details">Club Details</a>
                            </li>
                            <li class="-mb-px mr-3 md:mb-0 sm:mb-3" @click="openTab = '#personnel'">
                                <a :class="openTab === '#personnel' ? activeClasses : inactiveClasses" class="bg-white
                            inline-block
                            py-2 px-4 font-semibold" href="#personnel">Club Personnel</a>
                            </li>
                            <li class="-mb-px mr-3 md:mb-0 sm:mb-3" @click="openTab = '#volunteers'">
                                <a :class="openTab === '#volunteers' ? activeClasses : inactiveClasses" class="bg-white
                            inline-block
                            py-2 px-4 font-semibold" href="#volunteers">Volunteers</a>
                            </li>
                            <li class="-mb-px mr-3 md:mb-0 sm:mb-3" @click="openTab = '#members'">
                                <a :class="openTab === '#members' ? activeClasses : inactiveClasses" class="bg-white
                            inline-block
                            py-2 px-4 font-semibold" href="#members">Members</a>
                            </li>
                        </ul>
                    </div>
                    {{-- Club Details Section --}}
                    <div class="w-full px-6 py-2" x-show="openTab === '#details'">
                        <div class="w-full border-2 bg-white border-gray-200 rounded-xl my-4 p-4 flex flex-wrap">
                            <div class="w-full md:w-1/2 sm:w-full">
                                <h4 class="font-bold text-xl text-gray-600 mb-4">Location data:</h4>
                                <p class="mb-2">{{ $club->address1 }}</p>
                                <p class="mb-2">{{ $club->address2 }}</p>
                                <p class="mb-2">{{ ucfirst($club->city) }}</p>
                                <p class="mb-2">{{ ucfirst($club->county) }}</p>
                                <p class="mb-2">{{ $club->province }}</p>
                                <p class="mb-8">{{ strtoupper($club->eircode) }}</p>
                                <div>
                                    <h4 class="font-bold text-xl text-gray-600 mb-4" id="venues">Correspondence:</h4>
                                    <p class="mb-4"><span class="w-40 inline-block">Main postal address:</span>
                                        <span class="gray-pillow">
                                            {{ $club->postal ?? 'Not set'}}
                                        </span>
                                    </p>
                                    <p class="mb-2">
                                        <span class="w-40 inline-block">Main email contact:</span>
                                        <span class="gray-pillow">
                                            {{ $club->correspondence ?? 'Not set'}}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="w-full md:w-1/2 sm:w-full">
                                <h4 class="font-bold text-xl text-gray-600 mb-4">Contact details:</h4>
                                <div class="mb-2">
                                    <div class="w-36 inline-block">Phone:</div>
                                    <div class="w-auto inline-block font-semibold text-gray-600">
                                        {{ $club->phone ?? 'Not set' }}</div>
                                </div>
                                <div class="mb-2">
                                    <div class="w-36 inline-block">Email:</div>
                                    @if ($club->email)
                                        <div class="w-auto inline-block font-semibold text-gray-600">
                                            <a href="mailto:{{ $club->email }}">{{ $club->email }}</a>
                                        </div>
                                    @else
                                        <div class="inline-block text-gray-600">Not set</div>
                                    @endif

                                </div>
                                <div class="mb-2">
                                    <div class="w-36 inline-block">Website:</div>
                                    <div class="w-auto inline-block font-semibold text-gray-600">
                                        {{ $club->website ?? 'Not set' }}</div>
                                </div>
                                <div class="mb-2">
                                    <div class="w-36 inline-block">Facebook:</div>
                                    <div class="w-auto inline-block font-semibold text-gray-600">
                                        {{ $club->facebook ?? 'Not set' }}
                                    </div>
                                </div>
                                <div class="mt-12">
                                    <h4 class="font-bold text-xl text-gray-600 mb-4">Club Rights:</h4>
                                    <div class="mb-4">
                                        <div class="w-36 inline-block">Full compliance:</div>
                                        <div class="w-auto inline-block font-bold">
                                            @if ($club->compliant)
                                                <span class="green-pillow">YES</span>
                                            @else
                                                <span class="red-pillow">NO</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="w-36 inline-block">Voting Rights:</div>
                                        <div class="w-auto inline-block font-bold">
                                            @if ($club->voting_rights)
                                                <span class="green-pillow">YES</span>
                                            @else
                                                <span class="red-pillow">NO</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="w-36 inline-block">Affiliation Paid on:</div>
                                        <div class="w-auto inline-block font-semibold text-gray-600">
                                            {{ $club->affiliation ?? 'Not set' }}
                                        </div>
                                    </div>
                                    <div>
                                        <div class="w-auto inline-block mr-4">Sport Ireland Ethics Self-Assessment Completed:</div>
                                        <div class="w-auto inline-block font-semibold text-gray-600">
                                            @if($club->ethics_assessment)
                                                <span class="green-pillow">Yes @ {{ $club->ethics_assessment_date }}</span>
                                            @else
                                                <span class="red-pillow">No</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full border bg-white border-gray-300 rounded-xl my-4 p-4 flex flex-wrap">
                            <h4 class="font-bold text-xl text-gray-600 mb-4" id="venues">Training Venues:</h4>
                            <table class="min-w-full table leading-normal">
                                <thead>
                                <tr>
                                    <th
                                        class="px-5 py-3 rounded-l bg-gray-600 text-left
                                        text-xs
                                        font-semibold text-white uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th
                                        class="px-5 py-3 bg-gray-600 text-left text-xs
                                        font-semibold text-white uppercase tracking-wider">
                                        Contact
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @each('venue.venue-list-club', $club->venues, 'venue', 'venue.empty')
                                </tbody>
                            </table>
                        </div>

                    </div>

                    {{-- Club Personnel Section --}}
                    <div class="w-full px-6 py-2" x-show="openTab === '#personnel'">
                        <div class="w-full bg-white border-2 border-gray-200 rounded-xl my-4 p-4 flex flex-wrap">
                            <h4 class="font-bold text-xl text-gray-600">Club Personnel:</h4>
                            <div class="w-full my-4">
                                <table class="min-w-full table leading-normal">
                                    <thead>
                                    <tr>
                                        <th
                                            class="w-48 pl-5 py-3 rounded-l bg-gray-600
                                            text-left text-xs font-semibold text-white uppercase tracking-wider
                                            shadow-lg">
                                            Role
                                        </th>
                                        <th
                                            class="px-5 py-3 bg-gray-600
                                            text-left text-xs font-semibold text-white uppercase tracking-wider
                                            shadow-lg">
                                            Name
                                        </th>
                                        <th
                                            class="px-5 py-3 bg-gray-600
                                            text-left text-xs font-semibold text-white uppercase tracking-wider
                                            shadow-lg">
                                            Safeguarding
                                        </th>
                                        <th
                                            class="px-5 py-3 bg-gray-600
                                            text-left text-xs font-semibold text-white uppercase tracking-wider
                                            shadow-lg">
                                            Vetting
                                        </th>
                                        <th
                                            class="px-5 py-3 bg-gray-600
                                            text-left text-xs font-semibold text-white uppercase tracking-wider
                                            shadow-lg">
                                            First Aid
                                        </th>
                                        <th
                                            class="px-5 py-3 bg-gray-600
                                            text-left text-xs font-semibold text-white uppercase tracking-wider
                                            shadow-lg">
                                            Qualifications
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($personnels as $personnel)
                                    @switch($personnel->role)
                                        @case('Head Coach')
                                        <tr>
                                            <td class="px-5 py-5 border-b border-gray-200 font-bold
                                                    text-judo-700">
                                                Head Coach
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200">
                                                <div class="text-gray-700 font-bold">{{ $personnel->name }}</div>
                                                <div class="text-sm">
                                                    <span class="font-bold text-gray-500 w-8">e:</span>
                                                    <a href="mailto:{{ $personnel->email }}">
                                                        {{ $personnel->email }}</a>
                                                    <br>
                                                    <span
                                                        class="font-bold text-gray-500 w-8">t:</span>
                                                    {{ $personnel->phone }}
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200">
                                                <div class="flex items-center text-sm">
                                                    <div>
                                                        <div class="gray-date">
                                                            {{ $personnel->safeguarding_completion ?? 'Not set' }}</div>
                                                        @if ( $personnel->safeguarding_expiry)
                                                            @if($personnel->safeguarding_expiry < now())
                                                                <div class="expired-date">{{
                                                                    $personnel->safeguarding_expiry }}</div>
                                                            @else
                                                                <div class="valid-date">
                                                                    {{ $personnel->safeguarding_expiry }}
                                                                </div>
                                                            @endif
                                                        @else
                                                            <div
                                                                class="bg-gray-200 text-gray-600 rounded-lg py-1 px-2">
                                                                Not set
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200">
                                                <div class="flex items-center text-sm">
                                                    <div>
                                                        <div class="gray-date">
                                                            {{ $personnel->vetting_completion ?? 'Not set' }}</div>
                                                        @if ( $personnel->vetting_expiry)
                                                            @if($personnel->vetting_expiry < now())
                                                                <div class="expired-date">{{
                                                                    $personnel->vetting_expiry }}</div>
                                                            @else
                                                                <div class="valid-date">
                                                                    {{ $personnel->vetting_expiry }}
                                                                </div>
                                                            @endif
                                                        @else
                                                            <div
                                                                class="gray-date">
                                                                Not set
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200">
                                                <div class="flex items-center text-sm">
                                                    <div>
                                                        <div class="gray-date">
                                                            {{ $personnel->first_aid_completion ?? 'Not set' }}</div>
                                                        @if ( $personnel->first_aid_expiry)
                                                            @if($personnel->first_aid_expiry < now())
                                                                <div class="expired-date">{{
                                                                    $personnel->first_aid_expiry }}</div>
                                                            @else
                                                                <div class="valid-date">
                                                                    {{ $personnel->first_aid_expiry }}
                                                                </div>
                                                            @endif
                                                        @else
                                                            <div
                                                                class="gray-date">
                                                                Not set
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200">
                                                <div class="flex items-center text-sm">
                                                    <div>
                                                        <div class="gray-date">
                                                            {{$personnel->coaching_qualification ?? 'Not set'}}
                                                        </div>
                                                        <div class="gray-date">
                                                            {{ $personnel->coaching_date ?? 'Not set'}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @break
                                        @case('Secretary')
                                        <tr>
                                            <td class="px-5 py-5 border-b border-gray-200 font-bold
                                                    text-judo-700">
                                                Secretary
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200">
                                                <div class="text-gray-700 font-bold">{{ $personnel->name }}</div>
                                                <div class="text-sm">
                                                    <span class="font-bold text-gray-500 w-8">e:</span>
                                                    <a href="mailto:{{ $personnel->email }}">
                                                        {{ $personnel->email }}</a>
                                                    <br>
                                                    <span
                                                        class="font-bold text-gray-500 w-8">t:</span>
                                                    {{ $personnel->phone }}
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200">
                                                <div class="flex items-center text-sm">
                                                    <div>
                                                        <div class="gray-date">
                                                            {{ $personnel->safeguarding_completion ?? 'Not set' }}</div>
                                                        @if ( $personnel->safeguarding_expiry)
                                                            @if($personnel->safeguarding_expiry < now())
                                                                <div class="expired-date">{{
                                                                    $personnel->safeguarding_expiry }}</div>
                                                            @else
                                                                <div class="valid-date">
                                                                    {{ $personnel->safeguarding_expiry }}
                                                                </div>
                                                            @endif
                                                        @else
                                                            <div
                                                                class="gray-date">
                                                                Not set
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200">
                                                <div class="flex items-center text-sm">
                                                    <div>
                                                        <div class="gray-date">
                                                            {{ $personnel->vetting_completion ?? 'Not set' }}</div>
                                                        @if ( $personnel->vetting_expiry)
                                                            @if($personnel->vetting_expiry < now())
                                                                <div class="expired-date">{{
                                                                    $personnel->vetting_expiry }}</div>
                                                            @else
                                                                <div class="valid-date">
                                                                    {{ $personnel->vetting_expiry }}
                                                                </div>
                                                            @endif
                                                        @else
                                                            <div
                                                                class="gray-date">
                                                                Not set
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200">

                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 text-sm">

                                            </td>
                                        </tr>
                                        @break
                                        @case('Designated Person')
                                        <tr>
                                            <td class="px-5 py-5 border-b border-gray-200 font-bold
                                                    text-judo-700">
                                                Designated Person
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200">
                                                <div class="text-gray-700 font-bold">{{ $personnel->name }}</div>
                                                <div class="text-sm">
                                                    <span class="font-bold text-gray-500 w-8">e:</span>
                                                    <a href="mailto:{{ $personnel->email }}">
                                                        {{ $personnel->email }}</a>
                                                    <br>
                                                    <span
                                                        class="font-bold text-gray-500 w-8">t:</span>
                                                    {{ $personnel->phone }}
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200">
                                                <div class="flex items-center text-sm">
                                                    <div>
                                                        <div class="gray-date">
                                                            {{ $personnel->safeguarding_completion ?? 'Not set' }}</div>
                                                        @if ( $personnel->safeguarding_expiry)
                                                            @if($personnel->safeguarding_expiry < now())
                                                                <div class="expired-date">{{
                                                                    $personnel->safeguarding_expiry }}</div>
                                                            @else
                                                                <div class="valid-date">
                                                                    {{ $personnel->safeguarding_expiry }}
                                                                </div>
                                                            @endif
                                                        @else
                                                            <div
                                                                class="gray-date">
                                                                Not set
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200">
                                                <div class="flex items-center text-sm">
                                                    <div>
                                                        <div class="gray-date">
                                                            {{ $personnel->vetting_completion ?? 'Not set' }}</div>
                                                        @if ( $personnel->vetting_expiry)
                                                            @if($personnel->vetting_expiry < now())
                                                                <div class="expired-date">{{
                                                                    $personnel->vetting_expiry }}</div>
                                                            @else
                                                                <div class="valid-date">
                                                                    {{ $personnel->vetting_expiry }}
                                                                </div>
                                                            @endif
                                                        @else
                                                            <div
                                                                class="gray-date">
                                                                Not set
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200">
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                            </td>
                                        </tr>
                                        @break
                                        @case('Childrens Officer')
                                        <tr>
                                            <td class="px-5 py-5 border-b border-gray-200 font-bold
                                                    text-judo-700">
                                                Children's Officer
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200">
                                                <div class="text-gray-700 font-bold">{{ $personnel->name }}</div>
                                                <div class="text-sm">
                                                    <span class="font-bold text-gray-500 w-8">e:</span>
                                                    <a href="mailto:{{ $personnel->email }}">
                                                        {{ $personnel->email }}</a>
                                                    <br>
                                                    <span
                                                        class="font-bold text-gray-500 w-8">t:</span>
                                                    {{ $personnel->phone }}
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200">
                                                <div class="flex items-center text-sm">
                                                    <div>
                                                        <div class="gray-date">
                                                            {{ $personnel->safeguarding_completion ?? 'Not set' }}</div>
                                                        @if ( $personnel->safeguarding_expiry)
                                                            @if($personnel->safeguarding_expiry < now())
                                                                <div class="expired-date">{{
                                                                    $personnel->safeguarding_expiry }}</div>
                                                            @else
                                                                <div class="valid-date">
                                                                    {{ $personnel->safeguarding_expiry }}
                                                                </div>
                                                            @endif
                                                        @else
                                                            <div
                                                                class="gray-date">
                                                                Not set
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200">
                                                <div class="flex items-center text-sm">
                                                    <div>
                                                        <div class="gray-date">
                                                            {{ $personnel->vetting_completion ?? 'Not set' }}</div>
                                                        @if ( $personnel->vetting_expiry)
                                                            @if($personnel->vetting_expiry < now())
                                                                <div class="expired-date">{{
                                                                    $personnel->vetting_expiry }}</div>
                                                            @else
                                                                <div class="valid-date">
                                                                    {{ $personnel->vetting_expiry }}
                                                                </div>
                                                            @endif
                                                        @else
                                                            <div
                                                                class="gray-date">
                                                                Not set
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200">
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                            </td>

                                        </tr>
                                        @break
                                    @endswitch
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="text-xs text-gray-500 bg-gray-100 p-2 mt-4 font-medium rounded">
                                    First date indicates the completion of the qualification, the second date is its expiry. Expired dates are shown in red.
                                </div>
                            </div>
                            <div class="w-full mt-12">
                                <h4 class="font-bold text-xl text-gray-600 mb-4" id="volunteers">Coaches:</h4>
                                <table class="min-w-full table leading-normal mt-8">
                                    <thead>
                                    <tr>
                                        <th
                                            class="px-5 py-3 bg-gray-600
                                            text-left text-xs font-semibold text-white uppercase tracking-wider
                                            rounded-l shadow-lg">
                                            Name
                                        </th>
                                        <th
                                            class="px-5 py-3 bg-gray-600
                                            text-left text-xs font-semibold text-white uppercase tracking-wider
                                            shadow-lg">
                                            Safeguarding
                                        </th>
                                        <th
                                            class="px-5 py-3 bg-gray-600
                                            text-left text-xs font-semibold text-white uppercase tracking-wider
                                            shadow-lg">
                                            Vetting
                                        </th>
                                        <th
                                            class="px-5 py-3 bg-gray-600
                                            text-left text-xs font-semibold text-white uppercase tracking-wider
                                            shadow-lg">
                                            First Aid
                                        </th>
                                        <th
                                            class="px-5 py-3 bg-gray-600
                                            text-left text-xs font-semibold text-white uppercase tracking-wider
                                            shadow-lg">
                                            Qualifications
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <td></td>
                                    </tbody>
                                </table>

                            </div>
                        </div>


                    </div>

                    {{-- Club Volunteers Section --}}
                    <div class="w-full px-6 py-2" x-show="openTab === '#volunteers'">
                        <div class="w-full bg-white border-2 border-gray-200 rounded-xl my-4 p-4 flex flex-wrap">
                            <h4 class="font-bold text-xl text-gray-600 mb-4" id="personnel">Club Volunteers:</h4>
                            <div class="w-full flex flex-wrap">
                                <div class="w-full">
                                    <table class="min-w-full table leading-normal mt-8">
                                        <thead>
                                        <tr>
                                            <th
                                                class="px-5 py-3 rounded-l bg-gray-600
                                                text-left text-xs
                                                font-semibold text-gray-200 uppercase tracking-wider shadow-lg">
                                                Name
                                            </th>
                                            <th
                                                class="px-5 py-3 bg-gray-600 text-left text-xs
                                                font-semibold text-gray-200 uppercase tracking-wider shadow-lg">
                                                Contact
                                            </th>
                                            <th
                                                class="px-5 py-3 bg-gray-600 text-left text-xs
                                                font-semibold text-gray-200 uppercase tracking-wider shadow-lg">
                                                Vetting
                                            </th>
                                            <th
                                                class="px-5 py-3 bg-gray-600 text-left text-xs
                                                font-semibold text-gray-200 uppercase tracking-wider shadow-lg">
                                                Safe Guarding
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tbody>
                                        @each('volunteer.volunteer-list', $club->volunteer, 'volunteer', 'volunteer.empty')
                                        </tbody>
                                        </tbody>
                                    </table>
                                    <div class="text-xs text-gray-500 bg-gray-100 p-2 mt-4 font-medium rounded">
                                        First date indicates the completion of the qualification, the second date is its expiry. Expired dates are shown in red.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Club Members Section --}}
                    <div class="w-full px-6 py-2" x-show="openTab === '#members'">
                        <div class="w-full bg-white border-2 border-gray-200 rounded-xl my-4 p-4 flex flex-wrap">
                            <h4 class="font-bold text-xl text-gray-600 mb-4 block w-full">Members:</h4>
                            <div class="w-full block mb-8">
                                @livewire('club-members', ['club_id' => $club->id])
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
