@extends('layouts.app')

@section('content')
    <main class="sm:container sm:mx-auto sm:mt-10">
        <div class="w-full sm:px-6">

            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

                <header
                    class="font-bold text-xl bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md flex
                     justify-between align-middle mb-6">
                    <div>
                        {{ $club->name }}
                        <a href="{{ route('clubs.edit', $club) }}" class="text-green-600 font-bold ml-3"
                           title="Edit club details"><i class="far fa-edit"></i></a>
                    </div>
                    <div class="font-bold text-sm"> {{ ucfirst($club->type) }} </div>
                </header>
                <div id="main" x-data="{openTab: window.location.hash ? window.location.hash : '#details',
                                      activeClasses: 'border-l border-t-4 border-r rounded-t text-blue-700',
                                      inactiveClasses: 'text-gray-500 hover:text-gray-700'
                                    }">
                    {{-- TABS SECTION --}}
                    <div class="w-full px-6">
                        <ul class="flex border-b">
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
                        <div class="w-full border border-gray-300 rounded-xl my-4 p-4 flex flex-wrap">
                            <div class="w-full md:w-1/2 sm:w-full">
                                <h4 class="font-bold text-xl text-black mb-4">Location data:</h4>
                                <p class="mb-2">{{ $club->address1 }}</p>
                                <p class="mb-2">{{ $club->address2 }}</p>
                                <p class="mb-2">{{ ucfirst($club->city) }}</p>
                                <p class="mb-2">{{ ucfirst($club->county) }}</p>
                                <p class="mb-2">{{ ucfirst($club->province) }}</p>
                                <p class="mb-8">{{ strtoupper($club->eircode) }}</p>
                                <div>
                                    <h4 class="font-bold text-xl text-black mb-4" id="venues">Correspondence:</h4>
                                    <p class="mb-2">Main postal address: <span class="font-bold">{{ $club->postal
                                    ?? 'Not set'}}</span></p>
                                    <p class="mb-2">Main email contact: <span class="font-bold">{{ $club->correspondence
                                    ?? 'Not set'}}</span></p>
                                </div>
                            </div>
                            <div class="w-full md:w-1/2 sm:w-full">
                                <h4 class="font-bold text-xl text-black mb-4">Contact details:</h4>
                                <div class="mb-2">
                                    <div class="w-24 inline-block">Phone:</div>
                                    <div class="w-auto inline-block font-bold"> {{ $club->phone ?? 'Not set' }}</div>
                                </div>
                                <div class="mb-2">
                                    <div class="w-24 inline-block">Email:</div>
                                    @if ($club->email)
                                        <div class="w-auto inline-block font-bold">
                                            <a href="mailto:{{ $club->email }}">{{ $club->email }}</a>
                                        </div>
                                    @else
                                        <div class="inline-block text-gray-600">Not set</div>
                                    @endif

                                </div>
                                <div class="mb-2">
                                    <div class="w-24 inline-block">Website:</div>
                                    <div class="w-auto inline-block font-bold"> {{ $club->website ?? 'Not set' }}</div>
                                </div>
                                <div class="mb-2">
                                    <div class="w-24 inline-block">Facebook:</div>
                                    <div class="w-auto inline-block font-bold"> {{ $club->facebook ?? 'Not set' }}</div>
                                </div>

                            </div>
                        </div>
                        <div class="w-full border border-gray-300 rounded-xl my-4 p-4 flex flex-wrap">
                            <h4 class="font-bold text-xl text-black mb-4" id="venues">Training Venues:</h4>
                            <div class="w-full mb-6">
                                <a href="{{ route('venue.create.club', $club->id) }}">
                                    <button class="button-judo">+ Add new venue</button>
                                </a>
                            </div>
                            <table class="min-w-full table leading-normal">
                                <thead>
                                <tr>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Contact
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($venues as $venue)
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                            <div class="flex items-center">
                                                <div class="ml-3">
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
                        <div class="w-full border border-gray-300 rounded-xl my-4 p-4 flex flex-wrap">
                            <h4 class="font-bold text-xl text-black mb-4">Club Personnel:</h4>
                            <div class="w-full my-4">
                                <table class="min-w-full table leading-normal">
                                    <thead>
                                    <tr>
                                        <th
                                            class="w-48 pl-5 py-3 border-b-2 border-gray-200 bg-gray-100
                                            text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Role
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100
                                            text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Name
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100
                                            text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Safeguarding
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100
                                            text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Vetting
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100
                                            text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            First Aid
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100
                                            text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Qualifications
                                        </th>
                                        <th
                                            class="w-24 py-3 border-b-2 border-gray-200 bg-gray-100
                                            text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
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
                                                   class="font-medium text-judo-700">+ Add new Headcoach</a>
                                            </td>
                                            @else
                                                <td class="px-5 py-5 border-b border-gray-200">
                                                    <div class="text-gray-700 font-bold">{{ $headCoach->name }}</div>
                                                    <div class="text-sm">
                                                        <span class="font-bold text-gray-500 w-8">e:</span>
                                                        <a href="mailto:{{ $headCoach->email }}">
                                                        {{ $headCoach->email }}</a>
                                                        <br>
                                                        <span
                                                            class="font-bold text-gray-500 w-8">t:</span>
                                                        {{ $headCoach->phone }}
                                                    </div>

                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200">
                                                    <div class="flex items-center">
                                                        <div>
                                                            <div class="bg-gray-200 rounded-lg py-1 px-2 mb-2">
                                                                {{ $headCoach->safeguarding_completion ?? 'Not set' }}</div>
                                                            @if ( $headCoach->safeguarding_expiry)
                                                                @if($headCoach->safeguarding_expiry < now())
                                                                    <div class="bg-red-700 text-white rounded-lg py-1
                                                                                px-2">{{ $headCoach->safeguarding_expiry }}</div>
                                                                @else
                                                                    <div class="bg-indigo-100 rounded-lg py-1 px-2">
                                                                        {{ $headCoach->safeguarding_expiry }}
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
                                                    <div class="flex items-center">
                                                        <div>
                                                            <div class="bg-gray-200 rounded-lg py-1 px-2 mb-2">
                                                                {{ $headCoach->vetting_completion ?? 'Not set' }}</div>
                                                            @if ( $headCoach->vetting_expiry)
                                                                @if($headCoach->vetting_expiry < now())
                                                                    <div class="bg-red-700 text-white rounded-lg py-1
                                                                                px-2">{{ $headCoach->vetting_expiry }}</div>
                                                                @else
                                                                    <div class="bg-indigo-100 rounded-lg py-1 px-2">
                                                                        {{ $headCoach->vetting_expiry }}
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
                                                    <div class="flex items-center">
                                                        <div>
                                                            <div class="bg-gray-200 rounded-lg py-1 px-2 mb-2">
                                                                {{ $headCoach->first_aid_completion ?? 'Not set' }}</div>
                                                            @if ( $headCoach->first_aid_expiry)
                                                                @if($headCoach->first_aid_expiry < now())
                                                                    <div class="bg-red-700 text-white rounded-lg py-1
                                                                                px-2">{{ $headCoach->first_aid_expiry }}</div>
                                                                @else
                                                                    <div class="bg-indigo-100 rounded-lg py-1 px-2">
                                                                        {{ $headCoach->first_aid_expiry }}
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
                                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                                    <div class="flex items-center">
                                                        <div>
                                                            <div class="bg-gray-200 rounded-lg py-1 px-2 mb-2">
                                                                {{$headCoach->coaching_qualification ?? 'Not set'}}
                                                            </div>
                                                            <div class="bg-gray-200 rounded-lg py-1 px-2 text-center">
                                                                {{ $headCoach->coaching_date ?? 'Not set'}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="py-12 border-b border-gray-200 text-sm flex flex-wrap h-full">
                                                    <a href="{{ route('personnel.edit', $headCoach->id) }}"
                                                       class="text-green-600 font-bold ml-3" title="Edit details"><i
                                                            class="far fa-edit"></i></a>
                                                    <form action="{{ route('personnel.destroy', $headCoach->id) }}"
                                                          method="POST">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="DELETE"/>
                                                        <button type="submit"
                                                                class="text-red-600 hover:text-red-300 whitespace-no-wrap ml-3"
                                                                onclick="return confirm('Do you want to delete the record completely?')">
                                                            <i class="far fa-trash-alt"></i></button>
                                                    </form>
                                                </td>
                                            @endif
                                        </tr>
                                        <tr><td class="px-5 py-5 border-b border-gray-200 font-bold
                                                text-judo-700">
                                                Secretary
                                            </td>
                                            @if(!$secretary)
                                            <td colspan="6" class="px-5 py-5 border-b border-gray-200">
                                                <a href="{{ route('club.addPersonnel', [$club->id, 'Secretary'])}}"
                                                   class="font-medium text-judo-700">+ Add new Secretary</a>
                                            </td>
                                            @else
                                                <td class="px-5 py-5 border-b border-gray-200">
                                                    <div class="text-gray-700 font-bold">{{ $secretary->name }}</div>
                                                    <div class="text-sm">
                                                        <span class="font-bold text-gray-500 w-8">e:</span>
                                                        <a href="mailto:{{ $secretary->email }}">
                                                            {{ $secretary->email }}</a>
                                                        <br>
                                                        <span
                                                            class="font-bold text-gray-500 w-8">t:</span>
                                                        {{ $secretary->phone }}
                                                    </div>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200">
                                                    <div class="flex items-center">
                                                        <div>
                                                            <div class="bg-gray-200 rounded-lg py-1 px-2 mb-2">
                                                                {{ $secretary->safeguarding_completion ?? 'Not set' }}</div>
                                                            @if ( $secretary->safeguarding_expiry)
                                                                @if($secretary->safeguarding_expiry < now())
                                                                    <div class="bg-red-700 text-white rounded-lg py-1
                                                                                px-2">{{ $secretary->safeguarding_expiry }}</div>
                                                                @else
                                                                    <div class="bg-indigo-100 rounded-lg py-1 px-2">
                                                                        {{ $secretary->safeguarding_expiry }}
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
                                                    <div class="flex items-center">
                                                        <div>
                                                            <div class="bg-gray-200 rounded-lg py-1 px-2 mb-2">
                                                                {{ $secretary->vetting_completion ?? 'Not set' }}</div>
                                                            @if ( $secretary->vetting_expiry)
                                                                @if($secretary->vetting_expiry < now())
                                                                    <div class="bg-red-700 text-white rounded-lg py-1
                                                                                px-2">{{ $secretary->vetting_expiry }}</div>
                                                                @else
                                                                    <div class="bg-indigo-100 rounded-lg py-1 px-2">
                                                                        {{ $secretary->vetting_expiry }}
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

                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 text-sm">

                                                </td>
                                                <td class="py-12 border-b border-gray-200 text-sm flex flex-wrap h-full">
                                                    <a href="{{ route('personnel.edit', $secretary->id) }}"
                                                       class="text-green-600 font-bold ml-3" title="Edit details"><i
                                                            class="far fa-edit"></i></a>
                                                    <form action="{{ route('personnel.destroy', $secretary->id) }}"
                                                          method="POST">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="DELETE"/>
                                                        <button type="submit"
                                                                class="text-red-600 hover:text-red-300 whitespace-no-wrap ml-3"
                                                                onclick="return confirm('Do you want to delete the record completely?')">
                                                            <i class="far fa-trash-alt"></i></button>
                                                    </form>
                                                </td>
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
                                                   class="font-medium text-judo-700">+ Add new Designated
                                                    Person</a>
                                            </td>
                                            @else
                                                <td class="px-5 py-5 border-b border-gray-200">
                                                    <div class="text-gray-700 font-bold">{{ $designated->name }}</div>
                                                    <div class="text-sm">
                                                        <span class="font-bold text-gray-500 w-8">e:</span>
                                                        <a href="mailto:{{ $designated->email }}">
                                                            {{ $designated->email }}</a>
                                                        <br>
                                                        <span
                                                            class="font-bold text-gray-500 w-8">t:</span>
                                                        {{ $designated->phone }}
                                                    </div>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200">
                                                    <div class="flex items-center">
                                                        <div>
                                                            <div class="bg-gray-200 rounded-lg py-1 px-2 mb-2">
                                                                {{ $designated->safeguarding_completion ?? 'Not set' }}</div>
                                                            @if ( $designated->safeguarding_expiry)
                                                                @if($designated->safeguarding_expiry < now())
                                                                    <div class="bg-red-700 text-white rounded-lg py-1
                                                                                px-2">{{ $designated->safeguarding_expiry }}</div>
                                                                @else
                                                                    <div class="bg-indigo-100 rounded-lg py-1 px-2">
                                                                        {{ $designated->safeguarding_expiry }}
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
                                                    <div class="flex items-center">
                                                        <div>
                                                            <div class="bg-gray-200 rounded-lg py-1 px-2 mb-2">
                                                                {{ $designated->vetting_completion ?? 'Not set' }}</div>
                                                            @if ( $designated->vetting_expiry)
                                                                @if($designated->vetting_expiry < now())
                                                                    <div class="bg-red-700 text-white rounded-lg py-1
                                                                                px-2">{{ $designated->vetting_expiry }}</div>
                                                                @else
                                                                    <div class="bg-indigo-100 rounded-lg py-1 px-2">
                                                                        {{ $designated->vetting_expiry }}
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
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                                </td>
                                                <td class="py-12 border-b border-gray-200 text-sm flex flex-wrap h-full">
                                                    <a href="{{ route('personnel.edit', $designated->id) }}"
                                                       class="text-green-600 font-bold ml-3" title="Edit details"><i
                                                            class="far fa-edit"></i></a>
                                                    <form action="{{ route('personnel.destroy', $designated->id) }}"
                                                          method="POST">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="DELETE"/>
                                                        <button type="submit"
                                                                class="text-red-600 hover:text-red-300 whitespace-no-wrap ml-3"
                                                                onclick="return confirm('Do you want to delete the record completely?')">
                                                            <i class="far fa-trash-alt"></i></button>
                                                    </form>
                                                </td>
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
                                                   class="font-medium text-judo-700">+ Add new Children's
                                                    Officer</a>
                                            </td>
                                            @else
                                                <td class="px-5 py-5 border-b border-gray-200">
                                                    <div class="text-gray-700 font-bold">{{ $childrens->name }}</div>
                                                    <div class="text-sm">
                                                        <span class="font-bold text-gray-500 w-8">e:</span>
                                                        <a href="mailto:{{ $childrens->email }}">
                                                            {{ $childrens->email }}</a>
                                                        <br>
                                                        <span
                                                            class="font-bold text-gray-500 w-8">t:</span>
                                                        {{ $childrens->phone }}
                                                    </div>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200">
                                                    <div class="flex items-center">
                                                        <div>
                                                            <div class="bg-gray-200 rounded-lg py-1 px-2 mb-2">
                                                                {{ $childrens->safeguarding_completion ?? 'Not set' }}</div>
                                                            @if ( $childrens->safeguarding_expiry)
                                                                @if($childrens->safeguarding_expiry < now())
                                                                    <div class="bg-red-700 text-white rounded-lg py-1
                                                                                px-2">{{ $childrens->safeguarding_expiry }}</div>
                                                                @else
                                                                    <div class="bg-indigo-100 rounded-lg py-1 px-2">
                                                                        {{ $childrens->safeguarding_expiry }}
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
                                                    <div class="flex items-center">
                                                        <div>
                                                            <div class="bg-gray-200 rounded-lg py-1 px-2 mb-2">
                                                                {{ $childrens->vetting_completion ?? 'Not set' }}</div>
                                                            @if ( $childrens->vetting_expiry)
                                                                @if($childrens->vetting_expiry < now())
                                                                    <div class="bg-red-700 text-white rounded-lg py-1
                                                                                px-2">{{ $childrens->vetting_expiry }}</div>
                                                                @else
                                                                    <div class="bg-indigo-100 rounded-lg py-1 px-2">
                                                                        {{ $childrens->vetting_expiry }}
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
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                                </td>
                                                <td class="py-12 border-b border-gray-200 text-sm flex flex-wrap h-full">
                                                    <a href="{{ route('personnel.edit', $childrens->id) }}"
                                                       class="text-green-600 font-bold ml-3" title="Edit details"><i
                                                            class="far fa-edit"></i></a>
                                                    <form action="{{ route('personnel.destroy', $childrens->id) }}"
                                                          method="POST">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="DELETE"/>
                                                        <button type="submit"
                                                                class="text-red-600 hover:text-red-300 whitespace-no-wrap ml-3"
                                                                onclick="return confirm('Do you want to delete the record completely?')">
                                                            <i class="far fa-trash-alt"></i></button>
                                                    </form>
                                                </td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="w-full mt-12">
                                <h4 class="font-bold text-xl text-black mb-4" id="volunteers">Coaches:</h4>
                                <a href="{{ route('coach.addCoach', [$club->id])}}">
                                    <button class="button-judo">+ Add new Coach</button>
                                </a>
                                <table class="min-w-full table leading-normal mt-8">
                                    <thead>
                                    <tr>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100
                                            text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Name
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100
                                            text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Safeguarding
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100
                                            text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Vetting
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100
                                            text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            First Aid
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100
                                            text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Qualifications
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100
                                            text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($coaches as $coach)
                                        <tr>
                                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                                <div class="flex items-center">
                                                    <div class="ml-3">
                                                        <p class="text-gray-900 whitespace-no-wrap font-bold">
                                                        <div class="font-bold">{{ $coach->name }}</div>
                                                        <div>
                                                            <span class="font-bold text-gray-500">e:</span>
                                                            <a href="mailto:{{ $coach->email }}">{{ $coach->email }}</a>
                                                            <br>
                                                            <span class="font-bold text-gray-500">t:</span>
                                                            {{ $coach->phone }}
                                                        </div>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                                <div class="flex items-center">
                                                    <div>
                                                        <div class="bg-gray-200 rounded-lg py-1 px-2 mb-2">{{
                                                                        $coach->safeguarding_completion ?? 'Not set' }}</div>
                                                        @if ( $coach->safeguarding_expiry)
                                                            @if($coach->safeguarding_expiry < now())
                                                                <div class="bg-red-700 text-white rounded-lg py-1
                                                                                px-2">{{ $coach->safeguarding_expiry }}</div>
                                                            @else
                                                                <div class="bg-indigo-100 rounded-lg py-1 px-2">{{
                                                                                $coach->safeguarding_expiry }}</div>
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
                                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                                <div class="flex items-center">
                                                    <div>
                                                        <div class="bg-gray-200 rounded-lg py-1 px-2 mb-2">{{
                                                                        $coach->vetting_completion ?? 'Not set' }}</div>
                                                        @if ( $coach->vetting_expiry)
                                                            @if($coach->vetting_expiry < now())
                                                                <div class="bg-red-700 text-white rounded-lg py-1
                                                                                px-2">{{ $coach->vetting_expiry }}</div>
                                                            @else
                                                                <div class="bg-indigo-100 rounded-lg py-1 px-2">{{
                                                                                $coach->vetting_expiry }}</div>
                                                            @endif
                                                        @else
                                                            <div
                                                                class="bg-gray-200 text-gray-600 rounded-lg py-1 px-2">
                                                                Not
                                                                set
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                                <div class="flex items-center">
                                                    <div>
                                                        <div class="bg-gray-200 rounded-lg py-1 px-2 mb-2">{{
                                                                            $coach->first_aid_completion ?? 'Not set'}}</div>
                                                        @if ( $coach->first_aid_expiry)
                                                            @if($coach->first_aid_expiry < now())
                                                                <div
                                                                    class="bg-red-700 text-white rounded-lg py-1 px-2">{{ $coach->first_aid_expiry }}</div>
                                                            @else
                                                                <div class="bg-indigo-100 rounded-lg py-1 px-2">{{
                                                                                                                               $coach->first_aid_expiry }}</div>
                                                            @endif
                                                        @else
                                                            <div
                                                                class="bg-gray-200 text-gray-600 rounded-lg py-1 px-2">
                                                                Not
                                                                set
                                                            </div>
                                                        @endif</div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                                <div class="flex items-center">
                                                    <div>
                                                        <div class="bg-gray-200 rounded-lg py-1 px-2 mb-2">
                                                            {{$coach->coaching_qualification ?? 'Not set'}}
                                                        </div>
                                                        <div class="bg-gray-200 rounded-lg py-1 px-2 text-center">
                                                            {{ $coach->coaching_date ?? 'Not set'}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-8 py-12 border-b border-gray-200 text-sm flex flex-wrap
                                            h-full">
                                                <a href="{{ route('coach.edit', $coach->id) }}"
                                                   class="text-green-600 font-bold ml-3" title="Edit coach details"><i
                                                        class="far fa-edit"></i></a>
                                                <form action="{{ route('coach.destroy', $coach->id) }}"
                                                      method="POST">
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

                    {{-- Club Volunteers Section --}}
                    <div class="w-full px-6 py-2" x-show="openTab === '#volunteers'">
                        <div class="w-full border border-gray-300 rounded-xl my-4 p-4 flex flex-wrap">
                            <h4 class="font-bold text-xl text-black mb-4" id="personnel">Club Volunteers:</h4>
                            <div class="w-full flex flex-wrap">
                                <div class="w-full">
                                    <a href="{{ route('volunteer.addVolunteer', [$club->id])}}">
                                        <button class="button-judo">+ Add new volunteer</button>
                                    </a>
                                    <table class="min-w-full table leading-normal mt-8">
                                        <thead>
                                        <tr>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Name
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Contact
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Vetting
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Safe Guarding
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Actions
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($volunteers as $volunteer)
                                            <tr>
                                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                                    <div class="flex items-center">
                                                        <div class="ml-3">
                                                            <p class="text-gray-900 whitespace-no-wrap font-bold">
                                                                {{ $volunteer->name }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                                    <div class="flex items-center">
                                                        <div>
                                                             <span class="font-bold text-gray-500 w-8">e:</span>
                                                            <a href="mailto:{{ $volunteer->email }}">{{ $volunteer->email }}</a>
                                                            <br>
                                                             <span
                                                                class="font-bold text-gray-500 w-8">t:</span>
                                                            {{ $volunteer->phone }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                                    <div class="flex items-center">
                                                        <div>
                                                                        <span class="bg-gray-200 rounded-lg py-1 px-2">{{
                                                                        $volunteer->vetting_completion ?? 'Not set' }}</span>
                                                            -
                                                            @if ( $volunteer->vetting_expiry)
                                                                @if($volunteer->vetting_expiry < now())
                                                                    <span
                                                                        class="bg-red-700 text-white rounded-lg py-1 px-2">{{ $volunteer->vetting_expiry }}</span>
                                                                @else
                                                                    <span
                                                                        class="bg-indigo-100 rounded-lg py-1 px-2">{{ $volunteer->vetting_expiry }}</span>
                                                                @endif
                                                            @else
                                                                <span
                                                                    class="bg-gray-200 text-gray-600 rounded-lg py-1 px-2">Not
                                                                                    set</span>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                                    <div class="flex items-center">
                                                                        <span
                                                                            class="bg-gray-200 rounded-lg py-1 px-2 mr-1">{{
                                                                        $volunteer->safeguarding_completion ?? 'Not set'}}</span>
                                                        -
                                                        @if ( $volunteer->safeguarding_expiry)
                                                            @if($volunteer->safeguarding_expiry < now())
                                                                <span
                                                                    class="bg-red-700 text-white rounded-lg py-1 px-2 ml-2">{{ $volunteer->safeguarding_expiry }}</span>
                                                            @else
                                                                <span
                                                                    class="bg-indigo-100 rounded-lg py-1 px-2 ml-2">{{ $volunteer->safeguarding_expiry }}</span>
                                                            @endif
                                                        @else
                                                            <span
                                                                class="bg-gray-200 text-gray-600 rounded-lg py-1 px-2">Not
                                                                                    set</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="px-8 py-8 border-b border-gray-200 text-sm flex flex-wrap h-full">
                                                    <a href="{{ route('volunteer.edit', $volunteer->id) }}"
                                                       class="text-green-600 font-bold ml-3"
                                                       title="Edit volunteer details"><i
                                                            class="far fa-edit"></i></a>
                                                    <form action="{{ route('volunteer.destroy', $volunteer->id) }}"
                                                          method="POST">
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
                    </div>

                    {{-- Club Members Section --}}
                    <div class="w-full px-6 py-2" x-show="openTab === '#members'">
                        <div class="w-full border border-gray-300 rounded-xl my-4 p-4 flex flex-wrap">
                            <h4 class="font-bold text-xl text-black mb-4 block w-full">Members:</h4>
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
                        <div class="w-full border border-gray-300 rounded-xl my-4 p-4">
                            <h4 class="font-bold text-xl mb-4">Club notes:</h4>
                            <a href="{{ route('clubnote.create.club', [$club->id]) }}">
                                <button class="button-judo">+ Add new note</button>
                            </a>
                            <div class="w-full mt-8">
                                <table class="min-w-full table leading-normal mt-8">
                                    <thead>
                                    <tr>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Title
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Created by
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Created on
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Operations
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($notes as $note)
                                        <tr>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <div class="flex items-center">
                                                    <div class="ml-3">
                                                        <p class="text-gray-900 whitespace-no-wrap font-bold">
                                                            <a href="{{ route('clubnote.show', $note->slug) }}"
                                                               class="hover:text-cool-gray-400"
                                                               title="View full note">{{ $note->title }}</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                Author
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                {{ $note->created_at->format('d-m-Y') }}
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm flex flex-wrap">
                                                <a href="{{ route('clubnote.show', $note->slug) }}"
                                                   class="text-blue-600 font-bold hover:text-blue-300"
                                                   title="View full note"><i class="far fa-eye"></i></a>
                                                <a href="{{ route('clubnote.edit', $note) }}"
                                                   class="text-green-600 font-bold ml-3" title="Edit note"><i
                                                        class="far fa-edit"></i></a>
                                                <form action="{{ route('clubnote.destroy' , $note)}}" method="POST">
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

                    {{-- Club Forms Section --}}
                    <div class="w-full px-6 py-2" x-show="openTab === '#forms'">
                        <div class="w-full border border-gray-300 rounded-xl my-4 p-4">
                            <h4 class="font-bold text-xl mb-4">Club forms:</h4>
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
                                    <div class="flex flex-wrap w-1/2 mr-4">
                                        <label class="inline-block text-gray-600 text-sm font-bold mr-4 py-2"
                                               for="title">
                                            Title
                                        </label>
                                        <input
                                            class="shadow appearance-none border w-5/6 rounded px-3 text-grey-darker"
                                            id="title" name="title" type="text" required>
                                    </div>
                                    <div class="flex flex-wrap align-middle">
                                        <label class="inline-block text-gray-600 text-sm font-bold mr-4 py-2"
                                               for="link">
                                            Attachment
                                        </label>
                                        <input class="py-2" id="link" name="link" type="file" required>
                                    </div>
                                    <div class="mr-8 py-2">
                                        <input type="submit" value="Submit" class="button-judo">
                                    </div>
                                    <div class="mr-8 py-2">
                                        <button class="button-danger" onclick="hideForm()">Cancel</button>
                                    </div>
                                </form>
                            </div>

                            <div class="w-full mt-8">
                                <table class="min-w-full table leading-normal mt-8">
                                    <thead>
                                    <tr>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Title
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Created by
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Link
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Created on
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Operations
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($forms as $form)
                                        <tr>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <div class="flex items-center">
                                                    <div class="ml-3">
                                                        <p class="text-gray-900 whitespace-no-wrap font-bold">
                                                            {{ $form->title }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                Author
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <a href="{{ asset('/storage/attachments/'.$form->link) }}"
                                                   target="_blank">
                                                    <i class="fas fa-file-pdf text-2xl text-red-700"></i>
                                                </a>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                {{ $form->created_at->format('d-m-Y') }}
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm flex flex-wrap">
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
                        <div class="w-full border border-gray-300 rounded-xl my-4 p-4">
                            <h4 class="font-bold text-xl mb-4">Club Documents:</h4>
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
                                    <div class="flex flex-wrap w-1/2 mr-4">
                                        <label class="inline-block text-gray-600 text-sm font-bold mr-4 py-2"
                                               for="title">
                                            Title
                                        </label>
                                        <input
                                            class="shadow appearance-none border w-5/6 rounded px-3 text-grey-darker"
                                            id="title" name="title" type="text" required>
                                    </div>
                                    <div class="flex flex-wrap align-middle">
                                        <label class="inline-block text-gray-600 text-sm font-bold mr-4 py-2"
                                               for="link">
                                            Attachment
                                        </label>
                                        <input class="py-2" id="link" name="link" type="file" required>
                                    </div>
                                    <div class="mr-8 py-2">
                                        <input type="submit" value="Submit" class="button-judo">
                                    </div>
                                    <div class="mr-8 py-2">
                                        <button class="button-danger" onclick="hideDocForm()">Cancel</button>
                                    </div>
                                </form>
                            </div>
                            <div class="w-full mt-8">
                                <table class="min-w-full table leading-normal mt-8">
                                    <thead>
                                    <tr>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Title
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Created by
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Link
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Created on
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Operations
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($documents as $document)
                                        <tr>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <div class="flex items-center">
                                                    <div class="ml-3">
                                                        <p class="text-gray-900 whitespace-no-wrap font-bold">
                                                            {{ $document->title }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                Author
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <a href="{{ asset('/storage/attachments/'.$document->link) }}"
                                                   target="_blank">
                                                    <i class="fas fa-file-pdf text-2xl text-red-700"></i>
                                                </a>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                {{ $document->created_at->format('d-m-Y') }}
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm flex flex-wrap">
                                                <form action="{{ route('clubdoc.destroy', $document->id) }}"
                                                      method="POST">
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
