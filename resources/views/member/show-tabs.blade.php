@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-10">
    <div class="w-full sm:px-6">

        <section class="flex flex-col break-words bg-gray-100 sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header
                class="font-bold text-xl bg-gray-600 text-gray-100 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md flex
                justify-between items-center mb-6">
                <div>
                    {{ ucfirst($member->first_name) }} {{ ucfirst($member->last_name) }}
                <span class="text-sm text-gray-200 ml-2">No: {{ $member->number }}</span>

                @if ($member->active)
                <span class="text-sm text-green-700 bg-green-300 p-2 rounded ml-2">Active</span>
                @else
                <span class="text-sm text-red-700 bg-red-300 p-2 rounded ml-2">Inactive</span>
                @endif
                    <a href="{{ route('member.edit', $member) }}" class="text-judo-200 hover:text-judo-50 font-bold ml-3"
                        title="Edit member details"><i class="far fa-edit"></i></a>
                </div>
                <div class="font-bold text-sm">
                    <a href="{{ route('clubs.show', $member->club) }}#members">
                        Club: {{ $member->club->name }}</a>
                </div>
            </header>

            <div id="main" x-data="{openTab: window.location.hash ? window.location.hash : '#personal',
                                      activeClasses:
                                      'bg-gray-600 text-gray-100 rounded-full shadow-inner shadow outline-none',
                                      inactiveClasses:
                                      'text-gray-500 bg-white hover:text-gray-700 hover:bg-gray-200 rounded-full'
                                    }">
                {{-- TABS SECTION --}}
                <div class="w-full px-6 ">
                    <ul class="flex">
                        <li class="-mb-px mr-3 md:mb-0 sm:mb-3" :class="{ '-mb-px': openTab === '#personal' }" @click="openTab =
                        '#personal'">
                            <a :class="openTab === '#personal' ? activeClasses : inactiveClasses" class="
                            inline-block py-2 px-4 font-semibold" href="#details">Personal Details</a>
                        </li>
                        <li class="-mb-px mr-3 md:mb-0 sm:mb-3" @click="openTab = '#membership'">
                            <a :class="openTab === '#membership' ? activeClasses : inactiveClasses" class="
                            inline-block
                            py-2 px-4 font-semibold" href="#membership">Membership</a>
                        </li>
                        <li class="-mb-px mr-3 md:mb-0 sm:mb-3" @click="openTab = '#grading'">
                            <a :class="openTab === '#grading' ? activeClasses : inactiveClasses" class="
                            inline-block
                            py-2 px-4 font-semibold" href="#grading">Grading</a>
                        </li>
                        <li class="-mb-px mr-3 md:mb-0 sm:mb-3" @click="openTab = '#referee'">
                            <a :class="openTab === '#referee' ? activeClasses : inactiveClasses" class="
                            inline-block
                            py-2 px-4 font-semibold" href="#referee">Referee</a>
                        </li>
                        <li class="-mb-px mr-3 md:mb-0 sm:mb-3" @click="openTab = '#tableofficial'">
                            <a :class="openTab === '#tableofficial' ? activeClasses : inactiveClasses" class="
                            inline-block
                            py-2 px-4 font-semibold" href="#tableofficial">Table Official</a>
                        </li>
                        <li class="-mb-px mr-3 md:mb-0 sm:mb-3" @click="openTab = '#coach'">
                            <a :class="openTab === '#coach' ? activeClasses : inactiveClasses" class="
                            inline-block
                            py-2 px-4 font-semibold" href="#coach">Coach</a>
                        </li>
                        <li class="-mb-px mr-3 md:mb-0 sm:mb-3" @click="openTab = '#compliance'">
                            <a :class="openTab === '#compliance' ? activeClasses : inactiveClasses" class="
                            inline-block
                            py-2 px-4 font-semibold" href="#compliance">Compliance</a>
                        </li>
                        <li class="-mb-px mr-3 md:mb-0 sm:mb-3" @click="openTab = '#notes'">
                            <a :class="openTab === '#notes' ? activeClasses : inactiveClasses" class="
                            inline-block
                            py-2 px-4 font-semibold" href="#notes">Notes {{ $notes->count()>0 ? $notes->count() : '' }}</a>
                        </li>
                        <li class="-mb-px mr-3 md:mb-0 sm:mb-3" @click="openTab = '#forms'">
                            <a :class="openTab === '#forms' ? activeClasses : inactiveClasses" class="
                            inline-block
                            py-2 px-4 font-semibold" href="#forms">Forms {{ $forms->count()>0 ? $forms->count() : '' }}</a>
                        </li>
                        <li class="-mb-px mr-3 md:mb-0 sm:mb-3" @click="openTab = '#documents'">
                            <a :class="openTab === '#documents' ? activeClasses : inactiveClasses" class="
                            inline-block
                            py-2 px-4 font-semibold" href="#documents" id="documents">Documents {{ $documents->count()>0 ? $documents->count() : '' }}</a>
                        </li>
                    </ul>
                </div>

                {{-- PERSONAL DETAILS  SECTION --}}
                <div class="w-full px-6 py-2" x-show="openTab === '#personal'">
                     <div class="w-full bg-white border-2 border-gray-200 flex flex-wrap rounded-xl my-4
                     p-4">
                            <div class="w-full md:w-1/2">
                                <h4 class="font-bold text-xl text-gray-500 mb-4">Personal details:</h4>
                                <div class="mb-6">
                                    @if ($member->getFirstMedia('photo'))
                                        <img src="{{ $member->getFirstMediaUrl('photo', 'profile') }}"
                                             class="w-48 h-48 object-contain rounded border border-gray-300" alt="Member photo">
                                        <div class="text-xs text-gray-500 mt-1">
                                            Uploaded {{ $member->getFirstMedia('photo')->created_at->format('d/m/Y') }}
                                        </div>
                                    @else
                                        <div class="w-48 h-48 flex items-center justify-center rounded border border-dashed border-gray-300 text-xs text-gray-400 text-center p-2">
                                            No photo on file
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-8">
                                    <div class="w-full md:w-1/2 mb-4">
                                        <div class="w-full flex flex-wrap mb-4">
                                            <div class="w-36 font-bold">Date of birth:</div>
                                            <div class="w-auto">{{ $member->dob }}
                                            </div>
                                        </div>
                                        <div class="w-full flex flex-wrap mb-4">
                                            <div class="w-36 font-bold">Current age:</div>
                                            <div class="w-auto">{{ $member->age }}
                                            </div>
                                        </div>
                                        <div class="w-full flex flex-wrap mb-4">
                                            <div class="w-36 font-bold">Gender:</div>
                                            <div class="w-auto">{{ $member->gender }}</div>
                                        </div>
                                        @if ($member->parent)
                                        <div class="w-full flex flex-wrap mb-4">
                                            <div class="w-36 font-bold">Parent/Guardian:</div>
                                            <div class="w-auto">{{ $member->parent }}</div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="w-full md:w-1/2">
                                <h4 class="font-bold text-xl text-gray-500 mb-4">Contact details:</h4>
                                <div class="flex flex-wrap">
                                    <div class="w-full flex flex-wrap">
                                        <div class="w-full flex flex-wrap mb-4">
                                            <div class="w-36 font-bold">Phone:</div>
                                            <div class="w-auto">{{ $member->phone }}
                                            </div>
                                        </div>
                                        <div class="w-full flex flex-wrap mb-4">
                                            <div class="w-36 font-bold">Mobile:</div>
                                            <div class="w-auto">{{ $member->mobile }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full flex flex-wrap mb-4">
                                        <div class="w-36 font-bold">Email:</div>
                                        <div class="w-auto">
                                            <a href="mailto:{{ $member->email }}">{{ $member->email }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full md:w-1/2 mb-2">
                                <h4 class="font-bold text-xl text-gray-500 mb-4">Address details:</h4>
                                <div class="mb-3">{{ $member->address1}}</div>
                                <div class="my-3">{{ $member->address2}}</div>
                                <div class="my-3">{{ $member->city}}</div>
                                <div class="my-3">{{ ucfirst($member->county) }}</div>
                                <div class="my-3">{{ ucfirst($member->province) }}</div>
                                <div class="my-3">{{ $member->eircode}}</div>
                            </div>
                            <div class="w-full md:w-1/2 mb-2">
                                <h4 class="font-bold text-xl text-gray-500 mb-4">Additional information:</h4>
                                <div class="w-full flex flex-wrap">
                                    <div class="w-full flex flex-wrap mb-4">
                                        <div class="w-48 font-bold">Membership Source:</div>
                                        <div class="w-auto">{{ $member->source }}
                                        </div>
                                    </div>
                                    <div class="w-full flex flex-wrap mb-3">
                                        <div class="w-48 font-bold">Email Consent:</div>
                                        <div class="w-auto">
                                            @if ($member->email_consent == "Yes")
                                                <span class="green-pillow">{{ $member->email_consent }}</span>
                                            @else
                                                <span class="red-pillow">{{ $member->email_consent }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    @if($member->adaptive)
                                        <div class="w-48 font-bold">Adaptive Judo:</div>
                                        <div class="w-auto">
                                            {{ $member->special ?? "Not specified" }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                     </div>
                </div>

                {{-- MEMBERSHIP SECTION --}}
                <div class="w-full px-6 py-2" x-show="openTab === '#membership'">
                    <div class="w-full bg-white border-2 border-gray-200 rounded-xl my-4 p-4">
                        <h4 class="font-bold text-xl text-gray-500 mb-4">Membership details:</h4>
                        <form method="POST" action="{{ action('App\Http\Controllers\MembershipController@store') }}"
                              role="form">
                            @csrf
                            <input type="hidden" name="member_id" value="{{ $member->id }}">
                            <div class="flex flex-wrap gap-8 items-end">
                                <div class="flex flex-wrap">
                                    <div>
                                        <label for="membership_type"
                                               class="block text-sm text-gray-400 mb-2 font-bold">Membership
                                            type</label>
                                        <select type="text" name="membership_type" id="membership_type"
                                               class="shadow border-gray-300 rounded w-64 py-2 px-3 text-grey-darker
                                               mr-2"
                                               placeholder="Membership type" required>
                                            <option value="" disabled selected>Select type</option>
                                            <option value="Under 12 – Junior Membership">Under 12 – Junior Membership</option>
                                            <option value="Under 18 – Youth Membership">Under 18 – Youth Membership</option>
                                            <option value="Over 18 – Adult Membership">Over 18 – Adult Membership</option>
                                            <option value="Student Membership">Student Membership</option>
                                            <option value="Life Membership">Life Membership</option>
                                            <optgroup label="Women in Sport">
                                                <option value="WIS – Under 12">WIS – Under 12</option>
                                                <option value="WIS – Under 18">WIS – Under 18</option>
                                                <option value="WIS – Over 18">WIS – Over 18</option>
                                                <option value="WIS - Student">WIS - Student</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="join_date" class="block text-sm text-gray-400 mb-2 font-bold">Joining
                                            date</label>
                                        <input type="date" name="join_date" id="join_date"
                                               class="shadow border-gray-300 rounded w-48 py-2 px-3
                                               text-grey-darker mr-2" required>
                                    </div>
                                    <div>
                                        <label for="expiry_date" class="block text-sm text-gray-400 mb-2 font-bold">Expiry
                                            date</label>
                                        <input type="date" name="expiry_date" id="expiry_date"
                                               class="shadow border-gray-300 rounded w-48 py-2 px-3
                                               text-grey-darker mr-2" required>
                                    </div>
                                </div>
                                <div>
                                    <input type="submit" value="Submit" class="button-judo px-6 py-3 rounded-lg">
                                </div>
                            </div>
                        </form>
                        <div class="w-full">
                            <table class="min-w-full table leading-normal mt-8">
                                <thead>
                                <tr>
                                    <th
                                        class="px-5 py-3 rounded-l bg-gray-600 text-left
                                        text-xs font-semibold text-gray-100 uppercase tracking-wider">
                                        Membership type
                                    </th>
                                    <th
                                        class="px-5 py-3 bg-gray-600 text-left text-xs
                                        font-semibold
                                         text-gray-100 uppercase tracking-wider">
                                        Join date
                                    </th>
                                    <th
                                        class="px-5 py-3 bg-gray-600 text-left text-xs
                                        font-semibold
                                         text-gray-100 uppercase tracking-wider">
                                        Expiry date
                                    </th>
                                    <th
                                        class="px-5 py-3 rounded-r bg-gray-600 text-center text-xs font-semibold
                                        text-gray-100
                                        uppercase
                                        tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @each('member.membership-list', $memberships, 'membership', 'member.empty-membership')
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- GRADING SECTION --}}
                <div class="w-full px-6 py-2" x-show="openTab === '#grading'">
                    <div class="w-full bg-white border-2 border-gray-200 rounded-xl my-4 p-4">
                        <h4 class="font-bold text-xl text-gray-500 mb-4">Grading details:</h4>
                        <form method="POST" action="{{ action('App\Http\Controllers\GradeController@store') }}"
                              role="form">
                            @csrf
                            <input type="hidden" name="member_id" value="{{ $member->id }}">
                            <div class="flex flex-wrap justify-between items-end">
                                <div class="flex flex-wrap gap-4">
                                    <div>
                                        <label for="grade_level" class="block text-sm text-gray-400 mb-2 font-bold">Grade
                                            level</label>
                                        <select name="grade_level" id="grade_level"
                                                class="shadow border-gray-300 rounded w-48 py-2 px-3 text-grey-darker mr-2">>
                                            <option value="" selected disabled>Select grade level</option>
                                            <optgroup label="Junior Grades">
                                                <option value="1st Mon White">1st Mon White</option>
                                                <option value="2nd Mon Red">2nd Mon Red</option>
                                                <option value="3rd Mon White/Yellow">3rd Mon White/Yellow</option>
                                                <option value="4th Mon Yellow">4th Mon Yellow</option>
                                                <option value="5th Mon Yellow/Orange">5th Mon Yellow/Orange</option>
                                                <option value="6th Mon Orange">6th Mon Orange</option>
                                                <option value="7th Mon Orange/Green">7th Mon Orange/Green</option>
                                                <option value="8th Mon Green">8th Mon Green</option>
                                                <option value="9th Mon Green/Blue">9th Mon Green/Blue</option>
                                                <option value="10th Mon Blue">10th Mon Blue</option>
                                                <option value="11th Mon Blue/Brown">11th Mon Blue/Brown</option>
                                                <option value="12th Mon Brown">12th Mon Brown</option>
                                            </optgroup>
                                            <optgroup label="Senior Grades">
                                                <option value="6th Kyu White">6th Kyu White</option>
                                                <option value="5th Kyu Yellow">5th Kyu Yellow</option>
                                                <option value="4th Kyu Orange">4th Kyu Orange</option>
                                                <option value="3rd Kyu Green">3rd Kyu Green</option>
                                                <option value="2nd Kyu Blue">2nd Kyu Blue</option>
                                                <option value="1st Kyu Brown">1st Kyu Brown</option>
                                            </optgroup>
                                            <optgroup label="Dan Grades">
                                                <option value="1st Dan">1st Dan</option>
                                                <option value="2nd Dan">2nd Dan</option>
                                                <option value="3rd Dan">3rd Dan</option>
                                                <option value="4th Dan">4th Dan</option>
                                                <option value="5th Dan">5th Dan</option>
                                                <option value="6th Dan">6th Dan</option>
                                                <option value="7th Dan">7th Dan</option>
                                                <option value="8th Dan">8th Dan</option>
                                            </optgroup>
                                            <optgroup label="Shamrock Grades">
                                                <option value="1st Shamrock">1st Shamrock</option>
                                                <option value="2nd Shamrock">2nd Shamrock</option>
                                                <option value="3rd Shamrock">3rd Shamrock</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="type" class="block text-sm text-gray-400 mb-2 font-bold">Date
                                            attained</label>
                                        <input type="date" name="grade_date" id="grade_date"
                                               class="shadow border-gray-300 rounded w-48 py-2 px-3 text-grey-darker mr-2">
                                    </div>
                                    <div>
                                        <label for="type" class="block text-sm text-gray-400 mb-2 font-bold">Points / Wins</label>
                                        <input type="text" name="grade_points" id="grade_points"
                                               class="shadow border-gray-300 rounded w-64 py-2 px-3 text-grey-darker mr-2"
                                               placeholder="Points / Wins">
                                    </div>
                                    <div>
                                        <label for="type" class="block text-sm text-gray-400 mb-2 font-bold">Competition</label>
                                        <input type="text" name="competition" id="competition"
                                               class="shadow border-gray-300 rounded w-64 py-2 px-3 text-grey-darker mr-2">
                                    </div>

                                </div>
                                <div>
                                    <input type="submit" value="Submit" class="button-judo">
                                </div>
                            </div>
                        </form>

                        @livewire('grade-list', ['member' => $member->id])
                    </div>
                </div>

                {{-- REFEREE SECTION --}}
                <div class="w-full px-6 py-2" x-show="openTab === '#referee'">
                    <div class="w-full bg-white border-2 border-gray-200 rounded-xl my-4 p-4">
                        <h4 class="font-bold text-xl text-gray-500 mb-4">Referee qualifications:</h4>
                        <form method="POST" action="{{ action('App\Http\Controllers\QualificationController@store') }}"
                              role="form">
                            @csrf
                            <input type="hidden" name="member_id" value="{{ $member->id }}">
                            <input type="hidden" name="type" value="referee">
                            <div class="flex flex-wrap justify-between items-end">
                                <div class="flex flex-wrap gap-4">
                                    <div>
                                        <label for="referee_level" class="block text-sm text-gray-400 mb-2 font-bold">Qualification
                                            level</label>
                                        <select name="level" id="referee_level"
                                                class="shadow border-gray-300 rounded w-64 py-2 px-3 text-grey-darker mr-2" required>
                                            @include('member.qualification-options', ['type' => 'referee', 'selected' => null])
                                        </select>
                                    </div>
                                    <div>
                                        <label for="referee_date" class="block text-sm text-gray-400 mb-2 font-bold">Date
                                            attained</label>
                                        <input type="date" name="date_attained" id="referee_date"
                                               class="shadow border-gray-300 rounded w-48 py-2 px-3 text-grey-darker mr-2">
                                    </div>
                                    <div>
                                        <label for="referee_notes" class="block text-sm text-gray-400 mb-2 font-bold">Notes</label>
                                        <input type="text" name="notes" id="referee_notes"
                                               class="shadow border-gray-300 rounded w-64 py-2 px-3 text-grey-darker mr-2">
                                    </div>
                                </div>
                                <div>
                                    <input type="submit" value="Submit" class="button-judo">
                                </div>
                            </div>
                        </form>

                        @livewire('qualification-list', ['member' => $member->id, 'type' => 'referee'])
                    </div>
                </div>

                {{-- TABLE OFFICIAL SECTION --}}
                <div class="w-full px-6 py-2" x-show="openTab === '#tableofficial'">
                    <div class="w-full bg-white border-2 border-gray-200 rounded-xl my-4 p-4">
                        <h4 class="font-bold text-xl text-gray-500 mb-4">Table Official qualifications:</h4>
                        <form method="POST" action="{{ action('App\Http\Controllers\QualificationController@store') }}"
                              role="form">
                            @csrf
                            <input type="hidden" name="member_id" value="{{ $member->id }}">
                            <input type="hidden" name="type" value="table_official">
                            <div class="flex flex-wrap justify-between items-end">
                                <div class="flex flex-wrap gap-4">
                                    <div>
                                        <label for="tableofficial_level" class="block text-sm text-gray-400 mb-2 font-bold">Qualification
                                            level</label>
                                        <select name="level" id="tableofficial_level"
                                                class="shadow border-gray-300 rounded w-64 py-2 px-3 text-grey-darker mr-2" required>
                                            @include('member.qualification-options', ['type' => 'table_official', 'selected' => null])
                                        </select>
                                    </div>
                                    <div>
                                        <label for="tableofficial_date" class="block text-sm text-gray-400 mb-2 font-bold">Date
                                            attained</label>
                                        <input type="date" name="date_attained" id="tableofficial_date"
                                               class="shadow border-gray-300 rounded w-48 py-2 px-3 text-grey-darker mr-2">
                                    </div>
                                    <div>
                                        <label for="tableofficial_notes" class="block text-sm text-gray-400 mb-2 font-bold">Notes</label>
                                        <input type="text" name="notes" id="tableofficial_notes"
                                               class="shadow border-gray-300 rounded w-64 py-2 px-3 text-grey-darker mr-2">
                                    </div>
                                </div>
                                <div>
                                    <input type="submit" value="Submit" class="button-judo">
                                </div>
                            </div>
                        </form>

                        @livewire('qualification-list', ['member' => $member->id, 'type' => 'table_official'])
                    </div>
                </div>

                {{-- COACH QUALIFICATION SECTION --}}
                <div class="w-full px-6 py-2" x-show="openTab === '#coach'">
                    <div class="w-full bg-white border-2 border-gray-200 rounded-xl my-4 p-4">
                        <h4 class="font-bold text-xl text-gray-500 mb-4">Coach qualifications:</h4>
                        <form method="POST" action="{{ action('App\Http\Controllers\QualificationController@store') }}"
                              role="form">
                            @csrf
                            <input type="hidden" name="member_id" value="{{ $member->id }}">
                            <input type="hidden" name="type" value="coach">
                            <div class="flex flex-wrap justify-between items-end">
                                <div class="flex flex-wrap gap-4">
                                    <div>
                                        <label for="coach_level" class="block text-sm text-gray-400 mb-2 font-bold">Qualification
                                            level</label>
                                        <select name="level" id="coach_level"
                                                class="shadow border-gray-300 rounded w-64 py-2 px-3 text-grey-darker mr-2" required>
                                            @include('member.qualification-options', ['type' => 'coach', 'selected' => null])
                                        </select>
                                    </div>
                                    <div>
                                        <label for="coach_date" class="block text-sm text-gray-400 mb-2 font-bold">Date
                                            attained</label>
                                        <input type="date" name="date_attained" id="coach_date"
                                               class="shadow border-gray-300 rounded w-48 py-2 px-3 text-grey-darker mr-2">
                                    </div>
                                    <div>
                                        <label for="coach_notes" class="block text-sm text-gray-400 mb-2 font-bold">Notes</label>
                                        <input type="text" name="notes" id="coach_notes"
                                               class="shadow border-gray-300 rounded w-64 py-2 px-3 text-grey-darker mr-2">
                                    </div>
                                </div>
                                <div>
                                    <input type="submit" value="Submit" class="button-judo">
                                </div>
                            </div>
                        </form>

                        @livewire('qualification-list', ['member' => $member->id, 'type' => 'coach'])
                    </div>
                </div>

                {{-- COMPLIANCE SECTION --}}
                <div class="w-full px-6 py-2" x-show="openTab === '#compliance'">
                    <div class="w-full bg-white border-2 border-gray-200 rounded-xl my-4 p-4">
                        <h4 class="font-bold text-xl text-gray-500 mb-4">Compliance:</h4>
                        <div class="w-full flex flex-wrap gap-8">
                            <div>
                                <div class="font-bold text-gray-500 mb-2">Safeguarding</div>
                                <div class="gray-date">{{ $member->safeguarding_completion ?? 'Not set' }}</div>
                                @if ($member->safeguarding_expiry)
                                    @if($member->safeguarding_expiry < now())
                                        <div class="expired-date">{{ $member->safeguarding_expiry }}</div>
                                    @else
                                        <div class="valid-date">{{ $member->safeguarding_expiry }}</div>
                                    @endif
                                @else
                                    <div class="amber-date">Not set</div>
                                @endif
                            </div>
                            <div>
                                <div class="font-bold text-gray-500 mb-2">Vetting</div>
                                <div class="gray-date">{{ $member->vetting_completion ?? 'Not set' }}</div>
                                @if ($member->vetting_expiry)
                                    @if($member->vetting_expiry < now())
                                        <div class="expired-date">{{ $member->vetting_expiry }}</div>
                                    @else
                                        <div class="valid-date">{{ $member->vetting_expiry }}</div>
                                    @endif
                                @else
                                    <div class="amber-date">Not set</div>
                                @endif
                            </div>
                            <div>
                                <div class="font-bold text-gray-500 mb-2">First Aid</div>
                                <div class="gray-date">{{ $member->first_aid_completion ?? 'Not set' }}</div>
                                @if ($member->first_aid_expiry)
                                    @if($member->first_aid_expiry < now())
                                        <div class="expired-date">{{ $member->first_aid_expiry }}</div>
                                    @else
                                        <div class="valid-date">{{ $member->first_aid_expiry }}</div>
                                    @endif
                                @else
                                    <div class="amber-date">Not set</div>
                                @endif
                            </div>
                        </div>
                        <div class="w-full mt-6">
                            <div class="font-bold text-gray-500 mb-2">Comments <span class="text-xs font-normal text-gray-400">(e.g. notes on volunteering at more than one club)</span></div>
                            <div class="w-full whitespace-pre-line">{{ $member->compliance_comments ?? 'No comments recorded.' }}</div>
                        </div>
                        <div class="w-full mt-6">
                            <a href="{{ route('member.edit', $member) }}#compliance-edit" class="blue-pillow">Edit compliance details</a>
                        </div>
                    </div>
                </div>

                {{-- NOTES SECTION --}}
                <div class="w-full px-6 py-2" x-show="openTab === '#notes'">
                    <div class="w-full bg-white border-2 border-gray-200 rounded-xl my-4 p-4">
                        <h4 class="font-bold text-xl text-gray-500 mb-4">Member notes:</h4>
                        <a href="{{ route('membernote.create.member', [$member->id]) }}">
                            <button class="button-judo">+ Add new note</button>
                        </a>
                        <div class="w-full mt-8">
                            <table class="min-w-full table leading-normal mt-8">
                                <thead>
                                <tr>
                                    <th
                                        class="w-1/2 px-5 rounded-l py-3 bg-gray-600 text-left
                                        text-xs
                                        font-semibold text-gray-100 uppercase tracking-wider">
                                        Title
                                    </th>
                                    <th
                                        class="w-1/4 px-5 py-3 bg-gray-600 text-left text-xs
                                         font-semibold
                                        text-gray-100 uppercase tracking-wider">
                                        Created by
                                    </th>
                                    <th
                                        class="w-1/4 px-5 py-3 rounded-r bg-gray-600 text-center text-xs
                                        font-semibold text-gray-100 uppercase tracking-wider">
                                        Operations
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @each('membernote.membernote-list', $notes, 'note', 'membernote.empty')
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Forms Section -->
                <div class="w-full px-6 py-2" x-show="openTab === '#forms'">
                    <div class="w-full bg-white border-2 border-gray-200 rounded-xl my-4 p-4">
                        <h4 class="font-bold text-gray-500 text-xl mb-4">Club forms:</h4>
                        <div>
                            <button class="button-judo" onclick="showForm()">+ Add new form</button>
                        </div>
                        <div class="w-full my-4 hidden bg-gray-100 p-2 rounded" id="addForm">
                            <form action="{{ route('memberdoc.store') }}" method="POST" role="form" class="w-full flex
                                        flex-wrap
                                        justify-between" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="member_id" value="{{ $member->id }}">
                                <input type="hidden" name="type" value="Form">
                                <input type="hidden" name="author" value="{{ Auth::user()->id }}">
                                <div class="flex flex-wrap w-1/2 mr-4">
                                    <label class="inline-block text-gray-600 text-sm font-bold mr-4 py-2" for="title">
                                        Title
                                    </label>
                                    <input
                                        class="shadow border-gray-300 w-5/6 rounded px-3 text-grey-darker"
                                        id="title" name="title" type="text" required>
                                </div>
                                <div class="flex flex-wrap align-middle">
                                    <label class="inline-block text-gray-600 text-sm font-bold mr-4 py-2" for="link">
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
                            <table class="min-w-full table-auto leading-normal mt-8">
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
                                @each('member.form-list', $forms, 'form', 'member.empty-form')
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Documents Section -->
                <div class="w-full px-6 py-2" x-show="openTab === '#documents'">
                    <div class="w-full bg-white border-2 border-gray-200 rounded-xl my-4 p-4">
                        <h4 class="font-bold text-gray-500 text-xl mb-4">Club documents:</h4>
                        <div>
                            <button class="button-judo" onclick="showDocForm()">+ Add new document</button>
                        </div>
                        <div class="w-full my-4 hidden bg-gray-100 p-2 rounded shadow" id="addDocument">
                            <form action="{{ route('memberdoc.store') }}" method="POST" role="form" class="w-full flex
                                        flex-wrap
                                        justify-between" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="member_id" value="{{ $member->id }}">
                                <input type="hidden" name="type" value="Document">
                                <input type="hidden" name="author" value="{{ Auth::user()->id }}">
                                <div class="flex flex-wrap w-1/2 mr-4">
                                    <label class="inline-block text-gray-600 text-sm font-bold mr-4 py-2" for="title">
                                        Title
                                    </label>
                                    <input
                                        class="shadow border-gray-300 w-5/6 rounded px-3 text-grey-darker"
                                        id="title" name="title" type="text" required>
                                </div>
                                <div class="flex flex-wrap align-middle">
                                    <label class="inline-block text-gray-600 text-sm font-bold mr-4 py-2" for="link">
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
                                @each('member.document-list', $documents, 'document', 'member.empty-document')
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full p-6">
                <a href="{{ route('clubs.show', $member->club) }}#members" class="gray-button" title="View club page">
                    << Back to club view</a>
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
