@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-10">
    <div class="w-full sm:px-6">

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header
                class="font-bold text-xl bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md flex justify-between align-middle">
                <div>
                    {{ $club->name }}
                    <a href="{{ route('clubs.edit', $club) }}" class="text-green-600 font-bold ml-3" title="Edit club details"><i class="far fa-edit"></i></a>
                </div>
                <div class="font-bold text-sm"> {{ ucfirst($club->type) }} </div>
            </header>

            <div class="w-full p-6">
                <div class="w-full border border-gray-300 rounded-xl my-4 p-4 flex flex-wrap">
                    <div class="w-full md:w-1/2 sm:w-full">
                        <h4 class="font-bold text-xl text-black mb-4">Location data:</h4>
                        <p class="mb-2">{{ $club->address1 }}</p>
                        <p class="mb-2">{{ $club->address2 }}</p>
                        <p class="mb-2">{{ ucfirst($club->city) }}</p>
                        <p class="mb-2">{{ ucfirst($club->county) }}</p>
                        <p class="mb-2">{{ ucfirst($club->province) }}</p>
                        <p class="mb-2">{{ $club->eircode }}</p>
                    </div>
                    <div class="w-full md:w-1/2 sm:w-full">
                        <h4 class="font-bold text-xl text-black mb-4">Contact details:</h4>
                        <div class="mb-2">
                            <div class="w-24 inline-block">Phone:</div>
                            <div class="w-auto inline-block font-bold"> {{ $club->phone ?? 'Not set' }}</div>
                        </div>
                        <div class="mb-2">
                            <div class="w-24 inline-block">Email:</div>
                            <div class="w-auto inline-block font-bold"> {{ $club->email ?? 'Not set' }}</div>
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
                    <h4 class="font-bold text-xl text-black mb-4">Club Personnel:</h4>
                    <div class="w-full mb-6">
                        <a href="{{ route('club.addPersonnel', [$club->id])}}">
                            <button class="button-judo">+ Add new person</button>
                        </a>
                    </div>
                {{-- Alpine JS Modal starts here--}}
                    <div x-data="{headCoach: false, secretary: false, designated: false, childrens:false, coach: false}" x-cloak class="w-full flex flex-wrap">

                        <div class="w-full md:w-1/2">
                            <div class="w-full mb-3">
                                <div class="w-36 inline-block font-bold mb-2 text-gray-500 p-2">Head Coach:</div>
                                <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">
                                    {{ $headCoach->name ?? 'Not set' }}</div>
                                @if ($headCoach)
                                    <div class="w-auto inline-block font-bold mb-2 p-2 text-right">
                                        <button type="button" title="View details"
                                                @click="headCoach = ! headCoach">
                                            <i class="far fa-eye text-green-500 mr-2"
                                               :class="{ 'text-gray-300' : headCoach, 'text-green-500' : ! headCoach}"></i></button>
                                        <a href="" title="Edit"><i class="far fa-edit text-blue-500 mr-2"></i></a>
                                        <a href="{{ route('personnel.delete', [$headCoach->id]) }}"
                                           title="Delete person record"
                                           onclick="return confirm('Do you want to delete the record completely?')"><i
                                                class="far fa-trash-alt text-red-600"></i></a>
                                    </div>
                                @else
                                    <div class="w-auto inline-block font-bold mb-2 p-2 text-right judo-green">
                                        <a href="{{ route('club.addPersonnel', $club->id ) }}">
                                            <i class="fas fa-user-plus"></i> Add new
                                        </a>
                                    </div>
                                @endif
                                <div x-show="headCoach" @keydown.escape="headCoach = false" class="p-2 bg-green-100 rounded w-auto flex flex-wrap shadow-lg relative">
                                    <div class="absolute right-2">
                                        <button @click="headCoach = false" title="Close panel">
                                            <i class="fas fa-window-close text-red-800"></i>
                                        </button>
                                    </div>
                                    <div class="w-1/2 flex flex-wrap">
                                        <div class="w-24 text-sm text-gray-500">Phone:</div>
                                        <div class="w-auto font-semibold">
                                            {{ $headCoach->phone ?? 'Not set' }}</div>
                                    </div>
                                    <div class="w-1/2 flex flex-wrap">
                                        <div class="w-24 text-sm inline-block text-gray-500">Email:</div>
                                        <div class="w-auto inline-block font-semibold">
                                            {{ $headCoach->email ?? 'Not set' }}</div>
                                    </div>
                                    <div class="w-1/2 flex flex-wrap">
                                        <div class="w-full font-bold text-gray-500 mt-4 mb-2">Vetting:</div>
                                        <div class="w-24 text-sm inline-block text-gray-500">Completion:</div>
                                        <div class="w-auto inline-block font-semibold">
                                            {{ $headCoach->vetting_completion ?? 'Not set' }}</div>
                                        <div class="w-24 text-sm inline-block text-gray-500 mt-2">Expiry:</div>
                                        <div class="w-auto inline-block font-semibold mt-2">
                                            {{ $headCoach->vetting_expiry ?? 'Not set' }}</div>
                                    </div>
                                    <div class="w-1/2 flex flex-wrap">
                                        <div class="w-full font-bold text-gray-500 mt-4 mb-2">Safeguarding:</div>
                                        <div class="w-24 text-sm inline-block text-gray-500">Completion:</div>
                                        <div class="w-auto inline-block font-semibold">
                                            {{ $headCoach->safeguarding_completion ?? 'Not set' }}</div>
                                        <div class="w-24 text-sm inline-block text-gray-500 mt-2">Expiry:</div>
                                        <div class="w-auto inline-block font-semibold mt-2">
                                            {{ $headCoach->safeguarding_expiry ?? 'Not set' }}</div>
                                    </div>
                                    <div class="w-1/2 flex flex-wrap">
                                        <div class="w-full font-bold text-gray-500 mt-4 mb-2">First Aid:</div>
                                        <div class="w-24 text-sm inline-block text-gray-500">Completion:</div>
                                        <div class="w-auto inline-block font-semibold">
                                            {{ $headCoach->first_aid_completion ?? 'Not set' }}</div>
                                        <div class="w-24 text-sm inline-block text-gray-500 mt-2">Expiry:</div>
                                        <div class="w-auto inline-block font-semibold mt-2">
                                            {{ $headCoach->first_aid_expiry ?? 'Not set' }}</div>
                                    </div>
                                    <div class="w-1/2 flex flex-wrap">
                                        <div class="w-full font-bold text-gray-500 mt-4 mb-2">Coaching:</div>
                                        <div class="w-24 text-sm inline-block text-gray-500">Qualification:</div>
                                        <div class="w-auto inline-block font-semibold">
                                            {{ $headCoach->coaching_qualification ?? 'Not set' }}</div>
                                        <div class="w-24 text-sm inline-block text-gray-500 mt-2">Expiry:</div>
                                        <div class="w-auto inline-block font-semibold mt-2">
                                            {{ $headCoach->coaching_date ?? 'Not set' }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full mb-3">
                                <div class="w-36 inline-block font-bold mb-2 text-gray-500 p-2">Secretary:</div>
                                <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">
                                    {{ $secretary->name ?? 'Not set' }}</div>
                                @if ($secretary)
                                    <div class="w-auto inline-block font-bold mb-2 p-2 text-right">
                                        <button type="button" title="View details"
                                                @click="secretary = ! secretary">
                                            <i class="far fa-eye text-green-500 mr-2" :class="{ 'text-gray-300' : secretary, 'text-green-500' : ! secretary}"></i></button>
                                        <a href="" title="Edit"><i class="far fa-edit text-blue-500 mr-2"></i></a>
                                        <a href="{{ route('personnel.delete', [$secretary->id]) }}"
                                           title="Delete person record"
                                           onclick="return confirm('Do you want to delete the record completely?')"><i
                                                class="far fa-trash-alt text-red-600"></i></a>
                                    </div>
                                @else
                                    <div class="w-auto inline-block font-bold mb-2 p-2 text-right judo-green">
                                        <a href="{{ route('club.addPersonnel', $club->id ) }}">
                                            <i class="fas fa-user-plus"></i> Add new
                                        </a>
                                    </div>
                                @endif
                                <div x-show="secretary" @keydown.escape="secretary = false" class="p-2 bg-green-100 rounded w-auto flex flex-wrap shadow-lg relative">
                                    <div class="absolute right-2">
                                        <button @click="secretary = false" title="Close panel">
                                            <i class="fas fa-window-close text-red-800"></i>
                                        </button>
                                    </div>
                                    <div class="w-1/2 flex flex-wrap">
                                        <div class="w-24 text-sm text-gray-500">Phone:</div>
                                        <div class="w-auto font-semibold">
                                            {{ $secretary->phone ?? 'Not set' }}</div>
                                    </div>
                                    <div class="w-1/2 flex flex-wrap">
                                        <div class="w-24 text-sm inline-block text-gray-500">Email:</div>
                                        <div class="w-auto inline-block font-semibold">
                                            {{ $secretary->email ?? 'Not set' }}</div>
                                    </div>
                                    <div class="w-1/2 flex flex-wrap">
                                        <div class="w-full font-bold text-gray-500 mt-4 mb-2">Vetting:</div>
                                        <div class="w-24 text-sm inline-block text-gray-500">Completion:</div>
                                        <div class="w-auto inline-block font-semibold">
                                            {{ $secretary->vetting_completion ?? 'Not set' }}</div>
                                        <div class="w-24 text-sm inline-block text-gray-500 mt-2">Expiry:</div>
                                        <div class="w-auto inline-block font-semibold mt-2">
                                            {{ $secretary->vetting_expiry ?? 'Not set' }}</div>
                                    </div>
                                    <div class="w-1/2 flex flex-wrap">
                                        <div class="w-full font-bold text-gray-500 mt-4 mb-2">Safeguarding:</div>
                                        <div class="w-24 text-sm inline-block text-gray-500">Completion:</div>
                                        <div class="w-auto inline-block font-semibold">
                                            {{ $secretary->safeguarding_completion ?? 'Not set' }}</div>
                                        <div class="w-24 text-sm inline-block text-gray-500 mt-2">Expiry:</div>
                                        <div class="w-auto inline-block font-semibold mt-2">
                                            {{ $secretary->safeguarding_expiry ?? 'Not set' }}</div>
                                    </div>
                                </div>

                            </div>
                            <div class="w-full mb-3">
                                <div class="w-36 inline-block font-bold mb-2 text-gray-500 p-2">Designated Off:</div>
                                <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">
                                    {{ $designated->name ?? 'Not set' }}</div>
                                @if ($designated)
                                    <div class="w-auto inline-block font-bold mb-2 p-2 text-right">
                                        <button type="button" title="View details"
                                                @click="designated = ! designated">
                                            <i class="far fa-eye text-green-500 mr-2" :class="{ 'text-gray-300' : designated, 'text-green-500' : ! designated}"></i></button>

                                        <a href="" title="Edit"><i class="far fa-edit text-blue-500 mr-2"></i></a>
                                        <a href="{{ route('personnel.delete', [$designated->id]) }}"
                                           title="Delete person record"
                                           onclick="return confirm('Do you want to delete the record completely?')"><i
                                                class="far fa-trash-alt text-red-600"></i></a>
                                    </div>
                                @else
                                    <div class="w-auto inline-block font-bold mb-2 p-2 text-right judo-green">
                                        <a href="{{ route('club.addPersonnel', $club->id ) }}">
                                            <i class="fas fa-user-plus"></i> Add new
                                        </a>
                                    </div>
                                @endif
                                <div x-show="designated" @keydown.escape="designated = false" class="p-2 bg-green-100 rounded w-auto flex flex-wrap shadow-lg relative">
                                    <div class="absolute right-2">
                                        <button @click="designated = false" title="Close panel">
                                            <i class="fas fa-window-close text-red-800"></i>
                                        </button>
                                    </div>
                                    <div class="w-1/2 flex flex-wrap">
                                        <div class="w-24 text-sm text-gray-500">Phone:</div>
                                        <div class="w-auto font-semibold">
                                            {{ $designated->phone ?? 'Not set' }}</div>
                                    </div>
                                    <div class="w-1/2 flex flex-wrap">
                                        <div class="w-24 text-sm inline-block text-gray-500">Email:</div>
                                        <div class="w-auto inline-block font-semibold">
                                            {{ $designated->email ?? 'Not set' }}</div>
                                    </div>
                                    <div class="w-1/2 flex flex-wrap">
                                        <div class="w-full font-bold text-gray-500 mt-4 mb-2">Vetting:</div>
                                        <div class="w-24 text-sm inline-block text-gray-500">Completion:</div>
                                        <div class="w-auto inline-block font-semibold">
                                            {{ $designated->vetting_completion ?? 'Not set' }}</div>
                                        <div class="w-24 text-sm inline-block text-gray-500 mt-2">Expiry:</div>
                                        <div class="w-auto inline-block font-semibold mt-2">
                                            {{ $designated->vetting_expiry ?? 'Not set' }}</div>
                                    </div>
                                    <div class="w-1/2 flex flex-wrap">
                                        <div class="w-full font-bold text-gray-500 mt-4 mb-2">Safeguarding:</div>
                                        <div class="w-24 text-sm inline-block text-gray-500">Completion:</div>
                                        <div class="w-auto inline-block font-semibold">
                                            {{ $secretary->safeguarding_completion ?? 'Not set' }}</div>
                                        <div class="w-24 text-sm inline-block text-gray-500 mt-2">Expiry:</div>
                                        <div class="w-auto inline-block font-semibold mt-2">
                                            {{ $secretary->safeguarding_expiry ?? 'Not set' }}</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="w-full md:w-1/2">
                            <div class="w-full mb-3">
                                <div class="w-36 inline-block font-bold mb-2 text-gray-500 p-2">Childrens Off:</div>
                                <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">
                                    {{ $childrens->name ?? 'Not set' }}</div>
                                @if ($childrens)
                                    <div class="w-auto inline-block font-bold mb-2 p-2 text-right">
                                        <button type="button" title="View details"
                                                @click="childrens = ! childrens">
                                            <i class="far fa-eye text-green-500 mr-2" :class="{ 'text-gray-300' : childrens, 'text-green-500' : ! childrens}"></i></button>
                                        <a href="" title="Edit"><i class="far fa-edit text-blue-500 mr-2"></i></a>
                                        <a href="{{ route('personnel.delete', [$childrens->id]) }}"
                                           title="Delete person record"
                                           onclick="return confirm('Do you want to delete the record completely?')"><i
                                                class="far fa-trash-alt text-red-600"></i></a>
                                    </div>
                                @else
                                    <div class="w-auto inline-block font-bold mb-2 p-2 text-right judo-green">
                                        <a href="{{ route('club.addPersonnel', $club->id ) }}">
                                            <i class="fas fa-user-plus"></i> Add new
                                        </a>
                                    </div>
                                @endif
                                <div x-show="childrens" @keydown.escape="childrens = false" class="p-2 bg-green-100 rounded w-auto flex flex-wrap shadow-lg relative">
                                    <div class="absolute right-2">
                                        <button @click="childrens = false" title="Close panel">
                                            <i class="fas fa-window-close text-red-800"></i>
                                        </button>
                                    </div>
                                    <div class="w-1/2 flex flex-wrap">
                                        <div class="w-24 text-sm text-gray-500">Phone:</div>
                                        <div class="w-auto font-semibold">
                                            {{ $childrens->phone ?? 'Not set' }}</div>
                                    </div>
                                    <div class="w-1/2 flex flex-wrap">
                                        <div class="w-24 text-sm inline-block text-gray-500">Email:</div>
                                        <div class="w-auto inline-block font-semibold">
                                            {{ $childrens->email ?? 'Not set' }}</div>
                                    </div>
                                    <div class="w-1/2 flex flex-wrap">
                                        <div class="w-full font-bold text-gray-500 mt-4 mb-2">Vetting:</div>
                                        <div class="w-24 text-sm inline-block text-gray-500">Completion:</div>
                                        <div class="w-auto inline-block font-semibold">
                                            {{ $childrens->vetting_completion ?? 'Not set' }}</div>
                                        <div class="w-24 text-sm inline-block text-gray-500 mt-2">Expiry:</div>
                                        <div class="w-auto inline-block font-semibold mt-2">
                                            {{ $childrens->vetting_expiry ?? 'Not set' }}</div>
                                    </div>
                                    <div class="w-1/2 flex flex-wrap">
                                        <div class="w-full font-bold text-gray-500 mt-4 mb-2">Safeguarding:</div>
                                        <div class="w-24 text-sm inline-block text-gray-500">Completion:</div>
                                        <div class="w-auto inline-block font-semibold">
                                            {{ $childrens->safeguarding_completion ?? 'Not set' }}</div>
                                        <div class="w-24 text-sm inline-block text-gray-500 mt-2">Expiry:</div>
                                        <div class="w-auto inline-block font-semibold mt-2">
                                            {{ $childrens->safeguarding_expiry ?? 'Not set' }}</div>
                                    </div>
                                </div>

                            </div>
                            <div class="w-full mb-3">
                                <div class="w-36 inline-block font-bold mb-2 text-gray-500 p-2">Coach:</div>
                                <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">
                                    {{ $coach->name ?? 'Not set' }}</div>
                                @if ($coach)
                                    <div class="w-auto inline-block font-bold mb-2 p-2 text-right">
                                        <button type="button" title="View details"
                                                @click="coach = ! coach">
                                            <i class="far fa-eye text-green-500 mr-2" :class="{ 'text-gray-300' : coach, 'text-green-500' : ! coach}"></i></button>
                                        <a href="" title="Edit"><i class="far fa-edit text-blue-500 mr-2"></i></a>
                                        <a href="{{ route('personnel.delete', [$coach->id]) }}"
                                           title="Delete person record"
                                           onclick="return confirm('Do you want to delete the record completely?')"><i
                                                class="far fa-trash-alt text-red-600"></i></a>
                                    </div>
                                @else
                                    <div class="w-auto inline-block font-bold mb-2 p-2 text-right judo-green">
                                        <a href="{{ route('club.addPersonnel', $club->id ) }}">
                                            <i class="fas fa-user-plus"></i> Add new
                                        </a>
                                    </div>
                                @endif
                                <div x-show="coach" @keydown.escape="coach = false" class="p-2 bg-green-100 rounded w-auto flex flex-wrap shadow-lg relative">
                                    <div class="absolute right-2">
                                        <button @click="coach = false" title="Close panel">
                                            <i class="fas fa-window-close text-red-800"></i>
                                        </button>
                                    </div>
                                    <div class="w-1/2 flex flex-wrap">
                                        <div class="w-24 text-sm text-gray-500">Phone:</div>
                                        <div class="w-auto font-semibold">
                                            {{ $coach->phone ?? 'Not set' }}</div>
                                    </div>
                                    <div class="w-1/2 flex flex-wrap">
                                        <div class="w-24 text-sm inline-block text-gray-500">Email:</div>
                                        <div class="w-auto inline-block font-semibold">
                                            {{ $coach->email ?? 'Not set' }}</div>
                                    </div>
                                    <div class="w-1/2 flex flex-wrap">
                                        <div class="w-full font-bold text-gray-500 mt-4 mb-2">Vetting:</div>
                                        <div class="w-24 text-sm inline-block text-gray-500">Completion:</div>
                                        <div class="w-auto inline-block font-semibold">
                                            {{ $coach->vetting_completion ?? 'Not set' }}</div>
                                        <div class="w-24 text-sm inline-block text-gray-500 mt-2">Expiry:</div>
                                        <div class="w-auto inline-block font-semibold mt-2">
                                            {{ $coach->vetting_expiry ?? 'Not set' }}</div>
                                    </div>
                                    <div class="w-1/2 flex flex-wrap">
                                        <div class="w-full font-bold text-gray-500 mt-4 mb-2">Safeguarding:</div>
                                        <div class="w-24 text-sm inline-block text-gray-500">Completion:</div>
                                        <div class="w-auto inline-block font-semibold">
                                            {{ $coach->safeguarding_completion ?? 'Not set' }}</div>
                                        <div class="w-24 text-sm inline-block text-gray-500 mt-2">Expiry:</div>
                                        <div class="w-auto inline-block font-semibold mt-2">
                                            {{ $coach->safeguarding_expiry ?? 'Not set' }}</div>
                                    </div>
                                    <div class="w-1/2 flex flex-wrap">
                                        <div class="w-full font-bold text-gray-500 mt-4 mb-2">First Aid:</div>
                                        <div class="w-24 text-sm inline-block text-gray-500">Completion:</div>
                                        <div class="w-auto inline-block font-semibold">
                                            {{ $coach->first_aid_completion ?? 'Not set' }}</div>
                                        <div class="w-24 text-sm inline-block text-gray-500 mt-2">Expiry:</div>
                                        <div class="w-auto inline-block font-semibold mt-2">
                                            {{ $coach->first_aid_expiry ?? 'Not set' }}</div>
                                    </div>
                                    <div class="w-1/2 flex flex-wrap">
                                        <div class="w-full font-bold text-gray-500 mt-4 mb-2">Coaching:</div>
                                        <div class="w-24 text-sm inline-block text-gray-500">Qualification:</div>
                                        <div class="w-auto inline-block font-semibold">
                                            {{ $coach->coaching_qualification ?? 'Not set' }}</div>
                                        <div class="w-24 text-sm inline-block text-gray-500 mt-2">Expiry:</div>
                                        <div class="w-auto inline-block font-semibold mt-2">
                                            {{ $coach->coaching_date ?? 'Not set' }}</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="w-full mt-4">
                            <h4 class="font-bold text-xl text-black mb-4">Volunteers:</h4>
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
                                    </th><th
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
                                                        {{ $volunteer->first_name }} {{ $volunteer->last_name }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                            <div class="flex items-center">
                                                <div>
                                                   <span class="font-bold text-gray-500">e:</span> {{ $volunteer->email }} <br><span class="font-bold text-gray-500">t:</span>{{ $volunteer->phone }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                            <div class="flex items-center">
                                                <div>
                                                    <span class="bg-gray-200 rounded-lg py-1 px-2">{{ $volunteer->vetting_completion }}</span> -
                                                    @if($volunteer->vetting_expiry < now())
                                                    <span class="bg-red-700 text-white rounded-lg py-1 px-2">{{ $volunteer->vetting_expiry }}</span>
                                                    @else
                                                    <span class="bg-indigo-100 rounded-lg py-1 px-2">{{ $volunteer->vetting_expiry }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                            <div class="flex items-center">
                                                    <span class="bg-green-200 rounded-lg py-1 px-2 mr-1">{{ $volunteer->safeguarding_completion }}</span> -
                                                @if($volunteer->safeguarding_expiry < now())
                                                    <span class="bg-red-700 text-white rounded-lg py-1 px-2 ml-2">{{ $volunteer->safeguarding_expiry }}</span>
                                                @else
                                                    <span class="bg-indigo-100 rounded-lg py-1 px-2 ml-2">{{ $volunteer->safeguarding_expiry }}</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 text-sm flex flex-wrap h-full">
                                            <a href="{{ route('volunteer.edit', $volunteer->id) }}"
                                               class="text-green-600 font-bold ml-3" title="Edit note"><i class="far fa-edit"></i></a>
                                            <form action="" method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE" />
                                                <button type="submit" class="text-red-600 hover:text-red-300 whitespace-no-wrap ml-3" onclick="return confirm('Do you want to delete the record completely?')"><i class="far fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>


                        </div>

                    </div>


                </div>
            <div class="w-full border border-gray-300 rounded-xl my-4 p-4 flex flex-wrap">
                <h4 class="font-bold text-xl text-black mb-4 block w-full">Members:</h4>
                <div class="w-full block mb-8">
                    @livewire('club-members', ['club_id' => $club->id])
                </div>
                <div class="w-full block">
                    <a href="{{ route('member.createWithClub', ['club' => $club->id]) }}">
                        <button class="button-judo">+ Add new member</button>
                    </a>
                </div>
            </div>

            <div class="w-full border border-gray-300 rounded-xl my-4 p-4">
                <h4 class="font-bold text-xl text-gray-500 mb-4" id="notes">Club notes:</h4>
                <a href="{{ route('clubnote.create.club', [$club->id]) }}">
                    <button class="button-judo">+ Add new note</button>
                </a>
                <div class="w-full mt-8">
                    <table class="min-w-full table leading-normal mt-8">
                        <thead>
                        <tr>
                            <th
                                class="w-3/4 px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Title
                            </th>
                            <th
                                class="w-1/4 px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
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
                                                <a href="{{ route('clubnote.show', $note->slug) }}" class="hover:text-cool-gray-400" title="View full note">{{ $note->title }}</a>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm flex flex-wrap">
                                        <a href="{{ route('clubnote.show', $note->slug) }}" class="text-blue-600 font-bold hover:text-blue-300" title="View full note"><i class="far fa-eye"></i></a>
                                        <a href="{{ route('clubnote.edit', $note) }}" class="text-green-600 font-bold ml-3" title="Edit note"><i class="far fa-edit"></i></a>
                                        <form action="{{ route('clubnote.destroy' , $note)}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE" />
                                            <button type="submit" class="text-red-600 hover:text-red-300 whitespace-no-wrap ml-3" onclick="return confirm('Do you want to delete the record completely?')"><i class="far fa-trash-alt"></i></button>
                                        </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
    </section>
    </div>
</main>
@endsection

@section('bottomScripts')
    <script>
        function showPerson(person) {
            var selected_person = person;
            console.log(selected_person);
            return this.selected_person;
        }
    </script>
@endsection
