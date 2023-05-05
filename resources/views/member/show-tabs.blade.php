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
                                      'text-gray-500 bg-gray-100 hover:text-gray-700 hover:bg-gray-200 rounded-full'
                                    }">
                {{-- TABS SECTION --}}
                <div class="w-full px-6 ">
                    <ul class="flex">
                        <li class="-mb-px mr-3 md:mb-0 sm:mb-3" :class="{ '-mb-px': openTab === '#personal' }" @click="openTab =
                        '#personal'">
                            <a :class="openTab === '#personal' ? activeClasses : inactiveClasses" class="bg-white
                            inline-block py-2 px-4 font-semibold" href="#details">Personal Details</a>
                        </li>
                        <li class="-mb-px mr-3 md:mb-0 sm:mb-3" @click="openTab = '#membership'">
                            <a :class="openTab === '#membership' ? activeClasses : inactiveClasses" class="bg-white
                            inline-block
                            py-2 px-4 font-semibold" href="#membership">Membership</a>
                        </li>
                        <li class="-mb-px mr-3 md:mb-0 sm:mb-3" @click="openTab = '#grading'">
                            <a :class="openTab === '#grading' ? activeClasses : inactiveClasses" class="bg-white
                            inline-block
                            py-2 px-4 font-semibold" href="#grading">Grading</a>
                        </li>
                        <li class="-mb-px mr-3 md:mb-0 sm:mb-3" @click="openTab = '#notes'">
                            <a :class="openTab === '#notes' ? activeClasses : inactiveClasses" class="bg-white
                            inline-block
                            py-2 px-4 font-semibold" href="#notes">Notes</a>
                        </li>
                        <li class="-mb-px mr-3 md:mb-0 sm:mb-3" @click="openTab = '#forms'">
                            <a :class="openTab === '#forms' ? activeClasses : inactiveClasses" class="bg-white
                            inline-block
                            py-2 px-4 font-semibold" href="#forms">Forms</a>
                        </li>
                        <li class="-mb-px mr-3 md:mb-0 sm:mb-3" @click="openTab = '#documents'">
                            <a :class="openTab === '#documents' ? activeClasses : inactiveClasses" class="bg-white
                            inline-block
                            py-2 px-4 font-semibold" href="#documents" id="documents">Documents</a>
                        </li>
                    </ul>
                </div>

                {{-- PERSONAL DETAILS  SECTION --}}
                <div class="w-full px-6 py-2" x-show="openTab === '#personal'">
                     <div class="w-full bg-white border-2 border-gray-200 flex flex-wrap rounded-xl my-4
                     p-4">
                            <div class="w-full md:w-1/2">
                                <h4 class="font-bold text-xl text-gray-500 mb-4">Personal details:</h4>
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
                                            {{ $member->special }}
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
                            <div class="flex flex-wrap justify-between">
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
                                    <input type="submit" value="Submit" class="button-judo">
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
                            <div class="flex flex-wrap justify-between">
                                <div class="flex flex-wrap">
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
                                        </select>
                                    </div>
                                    <div>
                                        <label for="type" class="block text-sm text-gray-400 mb-2 font-bold">Date
                                            attained</label>
                                        <input type="date" name="grade_date" id="grade_date"
                                               class="shadow border-gray-300 rounded w-48 py-2 px-3 text-grey-darker mr-2">
                                    </div>
                                    <div>
                                        <label for="type" class="block text-sm text-gray-400 mb-2 font-bold">Points to
                                            next
                                            grade</label>
                                        <input type="text" name="grade_points" id="grade_points"
                                               class="shadow border-gray-300 rounded w-64 py-2 px-3 text-grey-darker mr-2"
                                               placeholder="Points to next grade">
                                    </div>

                                </div>
                                <div>
                                    <input type="submit" value="Submit" class="button-judo">

                                </div>
                            </div>
                        </form>

                        <div class="w-full">
                            <table class="min-w-full table leading-normal mt-8">
                                <thead>
                                <tr>
                                    <th
                                        class="px-5 py-3 rounded-l bg-gray-600 text-left
                                        text-xs
                                        font-semibold text-gray-100 uppercase tracking-wider">
                                        Grade level
                                    </th>
                                    <th
                                        class="px-5 py-3 bg-gray-600 text-left text-xs
                                        font-semibold text-gray-100 uppercase tracking-wider">
                                        Grade date
                                    </th>
                                    <th
                                        class="px-5 py-3 bg-gray-600 text-left text-xs
                                        font-semibold text-gray-100 uppercase tracking-wider">
                                        Points to next
                                    </th>
                                    <th
                                        class="px-5 py-3 rounded-r bg-gray-600 text-center text-xs font-semibold
                                        text-gray-100
                                        uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @each('member.grade-list', $grades, 'grade', 'member.empty-grade')
                                </tbody>
                            </table>
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
