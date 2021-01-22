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
                        <a href="{{ route('clubs.edit', $club) }}" class="text-judo-200 hover:text-judo-50
                        font-bold ml-3"
                           title="Edit club details"><i class="far fa-edit"></i></a>
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
                        <ul class="flex">
                            <li class="-mb-px mr-1" :class="{ '-mb-px': openTab === '#details' }" @click="openTab =
                        '#details'">
                                <a :class="openTab === '#details' ? activeClasses : inactiveClasses" class="bg-white
                            inline-block py-2 px-4 font-semibold" href="#details">Club Details</a>
                            </li>
                            <li class="-mb-px mr-1" @click="openTab = '#personnel'">
                                <a :class="openTab === '#personnel' ? activeClasses : inactiveClasses" class="bg-white
                            inline-block
                            py-2 px-4 font-semibold" href="#personnel">Club Personnel</a>
                            </li>
                            <li class="-mb-px mr-1" @click="openTab = '#volunteers'">
                                <a :class="openTab === '#volunteers' ? activeClasses : inactiveClasses" class="bg-white
                            inline-block
                            py-2 px-4 font-semibold" href="#volunteers">Volunteers</a>
                            </li>
                            <li class="-mb-px mr-1" @click="openTab = '#members'">
                                <a :class="openTab === '#members' ? activeClasses : inactiveClasses" class="bg-white
                            inline-block
                            py-2 px-4 font-semibold" href="#members">Members</a>
                            </li>
                            <li class="-mb-px mr-1" @click="openTab = '#notes'">
                                <a :class="openTab === '#notes' ? activeClasses : inactiveClasses" class="bg-white
                            inline-block
                            py-2 px-4 font-semibold" href="#notes">Notes</a>
                            </li>
                            <li class="-mb-px mr-1" @click="openTab = '#forms'">
                                <a :class="openTab === '#forms' ? activeClasses : inactiveClasses" class="bg-white
                            inline-block
                            py-2 px-4 font-semibold" href="#forms">Forms</a>
                            </li>
                            <li class="-mb-px mr-1" @click="openTab = '#documents'">
                                <a :class="openTab === '#documents' ? activeClasses : inactiveClasses" class="bg-white
                            inline-block
                            py-2 px-4 font-semibold" href="#documents">Documents</a>
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
                                <p class="mb-2">{{ ucfirst($club->province) }}</p>
                                <p class="mb-8">{{ strtoupper($club->eircode) }}</p>
                                <div>
                                    <h4 class="font-bold text-xl text-gray-600 mb-4" id="venues">Correspondence:</h4>
                                    <p class="mb-4"><span class="w-40 inline-block">Main postal address:</span> <span
                                            class="gray-pillow">{{
                                            $club->postal
                                    ?? 'Not set'}}</span></p>
                                    <p class="mb-2"><span class="w-40 inline-block">Main email contact:</span> <span
                                            class="gray-pillow">{{ $club->correspondence
                                    ?? 'Not set'}}</span></p>
                                </div>
                            </div>
                            <div class="w-full md:w-1/2 sm:w-full">
                                <h4 class="font-bold text-xl text-gray-600 mb-4">Contact details:</h4>
                                <div class="mb-2">
                                    <div class="w-24 inline-block">Phone:</div>
                                    <div class="w-auto inline-block font-semibold text-gray-600"> {{ $club->phone ?? 'Not
                                    set'
                                    }}</div>
                                </div>
                                <div class="mb-2">
                                    <div class="w-24 inline-block">Email:</div>
                                    @if ($club->email)
                                        <div class="w-auto inline-block font-semibold text-gray-600">
                                            <a href="mailto:{{ $club->email }}">{{ $club->email }}</a>
                                        </div>
                                    @else
                                        <div class="inline-block text-gray-600">Not set</div>
                                    @endif

                                </div>
                                <div class="mb-2">
                                    <div class="w-24 inline-block">Website:</div>
                                    <div class="w-auto inline-block font-semibold text-gray-600"> {{ $club->website ??
                                    'Not
                                    set'
                                    }}</div>
                                </div>
                                <div class="mb-2">
                                    <div class="w-24 inline-block">Facebook:</div>
                                    <div class="w-auto inline-block font-semibold text-gray-600"> {{ $club->facebook ??
                                    'Not
                                    set'
                                    }}</div>
                                </div>
                                <div class="mt-12">
                                    <h4 class="font-bold text-xl text-gray-600 mb-4">Club Rights:</h4>
                                    <div class="mb-4">
                                        <div class="w-32 inline-block">Full compliance:</div>
                                        <div class="w-auto inline-block font-bold">
                                            @if ($club->compliant)
                                                <span class="green-pillow">YES</span>
                                            @else
                                                <span class="red-pillow">NO</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div>
                                        <div class="w-32 inline-block">Voting Rights:</div>
                                        <div class="w-auto inline-block font-bold">
                                            @if ($club->voting_rights)
                                                <span class="green-pillow">YES</span>
                                            @else
                                                <span class="red-pillow">NO</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full border bg-white border-gray-300 rounded-xl my-4 p-4 flex flex-wrap">
                            <h4 class="font-bold text-xl text-gray-600 mb-4" id="venues">Training Venues:</h4>
                            <div class="w-full mb-6">
                                <a href="{{ route('venue.create.club', $club->id) }}">
                                    <button class="button-judo">+ Add new venue</button>
                                </a>
                            </div>
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
                                    <th
                                        class="px-5 py-3 rounded-r bg-gray-600 text-center
                                        text-xs font-semibold text-white uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($venues as $venue)
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                            <div class="flex items-center">
                                                <div class="">
                                                    <p class="text-gray-900 whitespace-no-wrap font-bold">
                                                        {{ $venue->name }}
                                                        <br/>
                                                        <span class="text-sm text-gray-600 font-medium">
                                                            {{ $venue->address1 }}
                                                            {{ $venue->address2 }}
                                                            {{ $venue->city }}
                                                            {{ ucfirst ($venue->county) }}
                                                            {{ strtoupper($venue->eircode) }}
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                            <div class="flex items-center">
                                                <div>
                                                    <p class="text-gray-900 whitespace-no-wrap font-bold">{{ $venue->contact }}
                                                        <br><span
                                                            class="font-bold text-gray-500">t:</span>{{ $venue->phone }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-8 py-8 border-b border-gray-200 text-sm flex flex-wrap h-full">
                                            <a href="{{ route('venue.edit', $venue->id) }}"
                                               class="text-green-600 font-bold ml-3" title="Edit venue"><i
                                                    class="far fa-edit"></i></a>
                                            <form action="{{ route('venue.destroy', $venue->id) }}"
                                                  method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE"/>
                                                <button type="submit"
                                                        class="text-red-600 hover:text-red-300 whitespace-no-wrap ml-3"
                                                        onclick="return confirm('Do you want to delete the venue ' +
                                                         'completely?')">
                                                    <i class="far fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
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
                                        <th
                                            class="w-24 py-3 rounded-r bg-gray-600
                                            text-center text-xs font-semibold text-white uppercase tracking-wider
                                            shadow-lg">
                                            Actions
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 font-bold
                                                text-judo-700">
                                            Head Coach
                                        </td>
                                        @if(!$headCoach)
                                            <td class="px-5 py-5 border-b border-gray-200">
                                                <a href="{{ route('club.addPersonnel', [$club->id, 'Head Coach'])}}"
                                                   class="action-button">+ Add new Headcoach</a>
                                            </td>
                                        @else
                                            @include('personnel.headcoach')
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 font-bold
                                                text-judo-700">
                                            Secretary
                                        </td>
                                        @if(!$secretary)
                                            <td colspan="6" class="px-5 py-5 border-b border-gray-200">
                                                <a href="{{ route('club.addPersonnel', [$club->id, 'Secretary'])}}"
                                                   class="action-button">+ Add new Secretary</a>
                                            </td>
                                        @else
                                            @include('personnel.secretary')
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 font-bold
                                                text-judo-700">
                                            Designated Person
                                        </td>
                                        @if(!$designated)
                                            <td colspan="6" class="px-5 py-5 border-b border-gray-200">
                                                <a href="{{ route('club.addPersonnel',
                                                            [$club->id, 'Designated Person'])}}"
                                                   class="action-button">+ Add new Designated
                                                    Person</a>
                                            </td>
                                        @else
                                            @include('personnel.designated')
                                        @endif
                                    </tr>
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 font-bold
                                                text-judo-700">
                                            Children's Officer
                                        </td>
                                        @if(!$childrens)
                                            <td colspan="6" class="px-5 py-5 border-b border-gray-200">
                                                <a href="{{ route('club.addPersonnel', [$club->id, 'Childrens Officer'])
                                                }}"
                                                   class="action-button">+ Add new Children's
                                                    Officer</a>
                                            </td>
                                        @else
                                            @include('personnel.children')
                                        @endif
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="w-full mt-12">
                                <h4 class="font-bold text-xl text-gray-600 mb-4" id="volunteers">Coaches:</h4>
                                <a href="{{ route('coach.addCoach', [$club->id])}}">
                                    <button class="button-judo">+ Add new Coach</button>
                                </a>
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
                                        <th
                                            class="px-5 py-3 rounded-r bg-gray-600
                                            text-left text-xs font-semibold text-white uppercase tracking-wider
                                            shadow-lg">
                                            Actions
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @each('coach.coach-list', $coaches, 'coach', 'coach.empty')
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
                                    <a href="{{ route('volunteer.addVolunteer', [$club->id])}}">
                                        <button class="button-judo">+ Add new volunteer</button>
                                    </a>
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
                                            <th
                                                class="px-5 py-3 rounded-r bg-gray-600 text-center
                                                text-xs
                                                font-semibold text-gray-200 uppercase tracking-wider shadow-lg">
                                                Actions
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @each('volunteer.volunteer-list', $volunteers, 'volunteer', 'volunteer.empty')
                                        </tbody>
                                    </table>


                                </div>

                            </div>


                        </div>
                    </div>

                    {{-- Club Members Section --}}
                    <div class="w-full px-6 py-2" x-show="openTab === '#members'">
                        <div class="w-full bg-white border-2 border-gray-200 rounded-xl my-4 p-4 flex flex-wrap">
                            <h4 class="font-bold text-xl text-gray-600 mb-4 block w-full">Members:</h4>
                            <div class="w-full block">
                                <a href="{{ route('member.createWithClub', ['club' => $club->id]) }}">
                                    <button class="button-judo">+ Add new member</button>
                                </a>
                            </div>
                            <div class="w-full block mb-8">
                                @livewire('club-members', ['club_id' => $club->id])
                            </div>
                        </div>
                    </div>

                    {{-- Club Notes Section --}}
                    <div class="w-full px-6 py-2" x-show="openTab === '#notes'">
                        <div class="w-full bg-white border-2 border-gray-200 rounded-xl my-4 p-4">
                            <h4 class="font-bold text-xl text-gray-600 mb-4">Club notes:</h4>
                            <a href="{{ route('clubnote.create.club', [$club->id]) }}">
                                <button class="button-judo">+ Add new note</button>
                            </a>
                            <div class="w-full mt-8">
                                <table class="min-w-full table leading-normal mt-8">
                                    <thead>
                                    <tr>
                                        <th
                                            class="px-5 py-3 rounded-l bg-gray-600 text-left
                                            text-xs
                                            font-semibold text-gray-100 uppercase tracking-wider shadow-lg">
                                            Title
                                        </th>
                                        <th
                                            class="px-5 py-3 bg-gray-600 text-left text-xs
                                            font-semibold text-gray-100 uppercase tracking-wider shadow-lg">
                                            Created by
                                        </th>
                                        <th
                                            class="px-5 py-3 bg-gray-600 text-left text-xs
                                            font-semibold text-gray-100 uppercase tracking-wider shadow-lg">
                                            Created on
                                        </th>
                                        <th
                                            class="px-5 py-3 rounded-r bg-gray-600 text-center text-xs font-semibold
                                            text-gray-100 uppercase tracking-wider shadow-lg">
                                            Actions
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($notes as $note)
                                        <tr>
                                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                                <div class="flex items-center">
                                                    <div class="">
                                                        <p class="text-gray-900 whitespace-no-wrap font-bold">
                                                            <a href="{{ route('clubnote.show', $note->slug) }}"
                                                               class="hover:text-cool-gray-400"
                                                               title="View full note">{{ $note->title }}</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                                @if ($note->author)
                                                    {{ $note->hasAuthor->name }}
                                                @endif
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                                {{ $note->created_at->format('d-m-Y') }}
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 text-sm flex
                                            flex-wrap justify-center">
                                                <div><a href="{{ route('clubnote.show', $note->slug) }}"
                                                        class="text-blue-600 font-bold hover:text-blue-300"
                                                        title="View full note"><i class="far fa-eye"></i></a></div>
                                                <div><a href="{{ route('clubnote.edit', $note) }}"
                                                        class="text-green-600 font-bold ml-3" title="Edit note"><i
                                                            class="far fa-edit"></i></a></div>
                                                <div>
                                                    <form action="{{ route('clubnote.destroy' , $note)}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="DELETE"/>
                                                        <button type="submit"
                                                                class="text-red-600 hover:text-red-300 whitespace-no-wrap ml-3"
                                                                onclick="return confirm('Do you want to delete the record completely?')">
                                                            <i class="far fa-trash-alt"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Club Forms Section --}}
                    <div class="w-full px-6 py-2" x-show="openTab === '#forms'">
                        <div class="w-full bg-white border-2 border-gray-200 rounded-xl my-4 p-4">
                            <h4 class="font-bold text-xl text-gray-600 mb-4">Club forms:</h4>
                            <div>
                                <button class="button-judo" onclick="showForm()">+ Add new form</button>
                            </div>
                            <div class="w-full my-4 hidden bg-gray-100 p-2 rounded" id="addForm">
                                <form action="{{ route('clubdoc.store') }}" method="POST" role="form" class="w-full flex
                                            flex-wrap
                                            justify-between" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="club_id" value="{{ $club->id }}">
                                    <input type="hidden" name="type" value="Form">
                                    <input type="hidden" name="author" value="{{ Auth::user()->id }}">
                                    <div class="w-full flex flex-wrap items-center">
                                        <div class="w-1/2">
                                            <label class="inline-block text-gray-600 text-sm font-bold mr-4 py-2"
                                                   for="title">
                                                Title
                                            </label>
                                            <input
                                                class="shadow border-gray-300 w-5/6 rounded px-3 text-grey-darker"
                                                id="title" name="title" type="text" required>
                                        </div>
                                        <div class="w-1/2 align-middle">
                                            <label class="inline-block text-gray-600 text-sm font-bold mr-4 py-2"
                                                   for="link">
                                                Attachment
                                            </label>
                                            <input class="py-2" id="link" name="link" type="file" required>
                                        </div>
                                    </div>
                                    <div class="w-full flex flex-wrap">
                                        <div class="mx-12 py-2">
                                            <input type="submit" value="Submit" class="button-judo">
                                        </div>
                                        <div class="py-2">
                                            <button class="button-danger" onclick="hideForm()">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="w-full mt-8">
                                <table class="min-w-full table leading-normal mt-8">
                                    <thead>
                                    <tr>
                                        <th
                                            class="px-5 py-3 rounded-l bg-gray-600 text-left
                                            text-xs
                                            font-semibold text-gray-100 uppercase tracking-wider shadow-lg">
                                            Title
                                        </th>
                                        <th
                                            class="px-5 py-3 bg-gray-600 text-left text-xs
                                            font-semibold text-gray-100 uppercase tracking-wider shadow-lg">
                                            Link
                                        </th>
                                        <th
                                            class="px-5 py-3 bg-gray-600 text-left text-xs
                                            font-semibold text-gray-100 uppercase tracking-wider shadow-lg">
                                            Created by
                                        </th>

                                        <th
                                            class="px-5 py-3 bg-gray-600 text-left text-xs
                                            font-semibold text-gray-100 uppercase tracking-wider shadow-lg">
                                            Created on
                                        </th>
                                        <th
                                            class="px-5 py-3 rounded-r bg-gray-600 text-center
                                            text-xs font-semibold text-gray-100 uppercase tracking-wider shadow-lg">
                                            Actions
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($forms as $form)
                                        <tr>
                                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                                <div class="flex items-center">
                                                    <div class="ml-3">
                                                        <p class="text-gray-900 whitespace-no-wrap font-bold">
                                                            <a href="{{ asset('/storage/attachments/'.$form->link) }}"
                                                               target="_blank">
                                                                {{ $form->title }}
                                                            </a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                                <a href="{{ asset('/storage/attachments/'.$form->link) }}"
                                                   target="_blank">
                                                    <i class="fas fa-file-pdf text-2xl text-red-700 mr-3"></i><span
                                                        class="text-gray-500">{{ $form->link }}</span>
                                                </a>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                                @if ($form->author)
                                                    {{ $form->hasAuthor->name }}
                                                @endif
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                                {{ $form->created_at->format('d-m-Y') }}
                                            </td>
                                            <td class="px-5 py-6 border-b border-gray-200 text-sm flex flex-wrap">
                                                <form action="{{ route('clubdoc.destroy', $form->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE"/>
                                                    <button type="submit"
                                                            class="text-red-600 hover:text-red-300 whitespace-no-wrap ml-3"
                                                            onclick="return confirm('Do you want to delete the record completely?')">
                                                        <i class="far fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Documents Section --}}
                    <div class="w-full px-6 py-2" x-show="openTab === '#documents'">
                        <div class="w-full bg-white border-2 border-gray-200 rounded-xl my-4 p-4">
                            <h4 class="font-bold text-xl text-gray-600 mb-4">Club documents:</h4>
                            <div>
                                <button class="button-judo" onclick="showDocForm()">+ Add new document</button>

                            </div>
                            <div class="w-full my-4 hidden bg-gray-100 p-2 rounded" id="addDocument">
                                <form action="{{ route('clubdoc.store') }}" method="POST" role="form" class="w-full flex
                                            flex-wrap
                                            justify-between" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="club_id" value="{{ $club->id }}">
                                    <input type="hidden" name="type" value="Document">
                                    <input type="hidden" name="author" value="{{ Auth::user()->id }}">
                                    <div class="w-full flex flex-wrap items-center">
                                        <div class="w-1/2">
                                            <label class="inline-block text-gray-600 text-sm font-bold mr-4 py-2"
                                                   for="title">
                                                Title
                                            </label>
                                            <input
                                                class="shadow border-gray-300 w-5/6 rounded px-3 text-grey-darker"
                                                id="title" name="title" type="text" required>
                                        </div>
                                        <div class="w-1/2 align-middle">
                                            <label class="inline-block text-gray-600 text-sm font-bold mr-4 py-2"
                                                   for="link">
                                                Attachment
                                            </label>
                                            <input class="py-2" id="link" name="link" type="file" required>
                                        </div>
                                    </div>
                                    <div class="w-full flex flex-wrap">
                                        <div class="mx-12 py-2">
                                            <input type="submit" value="Submit" class="button-judo">
                                        </div>
                                        <div class="mr-8 py-2">
                                            <button class="button-danger" onclick="hideDocForm()">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="w-full mt-8">
                                <table class="min-w-full table leading-normal mt-8">
                                    <thead>
                                    <tr>
                                        <th
                                            class="px-5 py-3 rounded-l bg-gray-600 text-left
                                            text-xs
                                            font-semibold text-gray-100 uppercase tracking-wider shadow-lg">
                                            Title
                                        </th>
                                        <th
                                            class="px-5 py-3 bg-gray-600 text-left text-xs
                                            font-semibold text-gray-100 uppercase tracking-wider shadow-lg">
                                            Link
                                        </th>
                                        <th
                                            class="px-5 py-3 bg-gray-600 text-left text-xs
                                            font-semibold text-gray-100 uppercase tracking-wider shadow-lg">
                                            Created by
                                        </th>
                                        <th
                                            class="px-5 py-3 bg-gray-600 text-left text-xs
                                            font-semibold text-gray-100 uppercase tracking-wider shadow-lg">
                                            Created on
                                        </th>
                                        <th
                                            class="px-5 py-3 rounded-r bg-gray-600 text-center
                                            text-xs font-semibold text-gray-100 uppercase tracking-wider shadow-lg">
                                            Actions
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($documents as $document)
                                        <tr>
                                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                                <div class="flex items-center">
                                                    <div class="ml-3">
                                                        <p class="text-gray-900 whitespace-no-wrap font-bold">
                                                            <a href="{{ asset('/storage/attachments/'.$document->link) }}"
                                                               target="_blank" title="{{ $document->link }}">
                                                                {{ $document->title }}
                                                            </a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                                <a href="{{ asset('/storage/attachments/'.$document->link) }}"
                                                   target="_blank" title="{{ $document->link }}">
                                                    <i class="fas fa-file-pdf text-2xl text-red-700 mr-3"></i><span
                                                        class="text-gray-500">{{ $document->link }}</span>
                                                </a>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                                @if ($document->author)
                                                    {{ $document->hasAuthor->name }}
                                                @endif
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                                {{ $document->created_at->format('d-m-Y') }}
                                            </td>
                                            <td class="px-5 py-6 border-b border-gray-200 text-sm flex flex-wrap
                                            justify-center">
                                                <form action="{{ route('clubdoc.destroy', $document->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE"/>
                                                    <button type="submit"
                                                            class="text-red-600 hover:text-red-300 whitespace-no-wrap"
                                                            onclick="return confirm('Do you want to delete the record completely?')"
                                                            title="Delete document">
                                                        <i class="far fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection

@section('bottomScripts')
    <script>
        function showForm() {
            let docForm = document.getElementById('addForm');
            docForm.classList.remove("hidden");
        }

        function hideForm() {
            let docForm = document.getElementById('addForm');
            docForm.classList.add("hidden");
        }

        function showDocForm() {
            let docForm = document.getElementById('addDocument');
            docForm.classList.remove("hidden");
        }

        function hideDocForm() {
            let docForm = document.getElementById('addDocument');
            docForm.classList.add("hidden");
        }
    </script>
@endsection
