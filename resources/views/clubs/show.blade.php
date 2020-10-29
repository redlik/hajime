@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-10">
    <div class="w-full sm:px-6">

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header
                class="font-bold text-xl bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md flex justify-between align-middle">
                <div> {{ $club->name }} </div>
                <div class="font-bold text-sm"> {{ ucfirst($club->type) }} </div>
            </header>

            <div class="w-full p-6">
                <div class="w-full border border-gray-300 rounded-xl my-4 p-4 flex flex-wrap">
                    <div class="w-full md:w-1/2 sm:w-full">
                        <h4 class="font-bold text-xl text-black mb-4">Location data:</h4>
                        <p class="mb-2">{{ $club->address1 }}</p>
                        <p class="mb-2">{{ $club->address2 }}</p>
                        <p class="mb-2">{{ ucfirst($club->town) }}</p>
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
                    <h4 class="font-bold text-xl text-black mb-4">Club Personel:</h4>
                    {{-- <div class="w-full mb-4">
                        <a href="{{ route('club.addPersonnel', $club->id ) }}">
                            <button class="button-primary">+ Insert details</button>
                        </a>
                    </div> --}}
                    <div class="w-full">
                        <div class="w-36 inline-block font-bold mb-2 text-gray-500 p-2">Head Coach:</div>
                        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">{{ $personnel['Head Coach']->name ?? 'Not set' }}</div>
                        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Email:</div>
                        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">{{ $personnel['Head Coach']->email ?? 'Not set' }}</div>
                        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Phone:</div>
                        <div class="w-48 bg-gray-100 p-2 rounded inline-block font-semibold">{{ $personnel['Head Coach']->phone ?? 'Not set' }}</div>
                        @if ($personnel['Head Coach'])
                        <div class="w-auto inline-block font-bold mb-2 p-2 text-right">
                            <a href="" title="View details"><i class="far fa-eye text-green-500 mr-2"></i></a>
                            <a href="" title="Edit"><i class="far fa-edit text-blue-500 mr-2"></i></a>
                        <a href="{{ route('personnel.delete', [$personnel['Head Coach']->id]) }}" title="Delete person record" onclick="return confirm('Do you want to delete the record completely?')"><i class="far fa-trash-alt text-red-600"></i></a>
                        </div>
                        @else
                        <div class="w-auto inline-block font-bold mb-2 p-2 text-right text-green-500">
                            <a href="{{ route('club.addPersonnel', $club->id ) }}">
                                <i class="fas fa-user-plus text-green-500"></i> Add new
                            </a>
                        </div>
                        @endif
                    </div>
                    <div class="w-full mt-2">
                        <div class="w-36 inline-block font-bold mb-2 text-gray-500 p-2">Secretary:</div>
                        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">{{ $personnel['Secretary']->name ?? 'Not set' }}</div>
                        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Email:</div>
                        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">{{ $personnel['Secretary']->email ?? 'Not set' }}</div>
                        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Phone:</div>
                        <div class="w-48 bg-gray-100 p-2 rounded inline-block font-semibold">{{ $personnel['Secretary']->phone ?? 'Not set' }}</div>
                        @if ($personnel['Secretary'])
                        <div class="w-auto inline-block font-bold mb-2 p-2 text-right">
                            <a href="" title="View details"><i class="far fa-eye text-green-500 mr-2"></i></a>
                            <a href="" title="Edit"><i class="far fa-edit text-blue-500 mr-2"></i></a>
                        <a href="{{ route('personnel.delete', [$personnel['Secretary']->id]) }}" title="Delete person record" onclick="return confirm('Do you want to delete the record completely?')"><i class="far fa-trash-alt text-red-600"></i></a>
                        </div>
                        @else
                        <div class="w-auto inline-block font-bold mb-2 p-2 text-right text-green-500">
                            <a href="{{ route('club.addPersonnel', $club->id ) }}">
                                <i class="fas fa-user-plus text-green-500"></i> Add new
                            </a>
                        </div>
                        @endif
                    </div>
                    <div class="w-full mt-2">
                        <div class="w-36 inline-block font-bold mb-2 text-gray-500 p-2">Designated Off:</div>
                        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">{{ $personnel['Designated Officer']->name ?? 'Not set' }}</div>
                        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Email:</div>
                        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">{{ $personnel['Designated Officer']->email ?? 'Not set' }}</div>
                        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Phone:</div>
                        <div class="w-48 bg-gray-100 p-2 rounded inline-block font-semibold">{{ $personnel['Designated Officer']->phone ?? 'Not set' }}</div>
                        @if ($personnel['Designated Officer'])
                        <div class="w-auto inline-block font-bold mb-2 p-2 text-right">
                            <a href="" title="View details"><i class="far fa-eye text-green-500 mr-2"></i></a>
                            <a href="" title="Edit"><i class="far fa-edit text-blue-500 mr-2"></i></a>
                        <a href="{{ route('personnel.delete', [$personnel['Designated Officer']->id]) }}" title="Delete person record" onclick="return confirm('Do you want to delete the record completely?')"><i class="far fa-trash-alt text-red-600"></i></a>
                        </div>
                        @else
                        <div class="w-auto inline-block font-bold mb-2 p-2 text-right text-green-500">
                            <a href="{{ route('club.addPersonnel', $club->id ) }}">
                                <i class="fas fa-user-plus text-green-500"></i> Add new
                            </a>
                        </div>
                        @endif
                    </div>
                    <div class="w-full mt-2">
                        <div class="w-36 inline-block font-bold mb-2 text-gray-500 p-2">Childrens Off:</div>
                        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">{{ $personnel['Childrens Officer']->name ?? 'Not set' }}</div>
                        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Email:</div>
                        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">{{ $personnel['Childrens Officer']->email ?? 'Not set' }}</div>
                        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Phone:</div>
                        <div class="w-48 bg-gray-100 p-2 rounded inline-block font-semibold">{{ $personnel['Childrens Officer']->phone ?? 'Not set' }}</div>
                        @if ($personnel['Childrens Officer'])
                        <div class="w-auto inline-block font-bold mb-2 p-2 text-right">
                            <a href="" title="View details"><i class="far fa-eye text-green-500 mr-2"></i></a>
                            <a href="" title="Edit"><i class="far fa-edit text-blue-500 mr-2"></i></a>
                        <a href="{{ route('personnel.delete', [$personnel['Childrens Officer']->id]) }}" title="Delete person record" onclick="return confirm('Do you want to delete the record completely?')"><i class="far fa-trash-alt text-red-600"></i></a>
                        </div>
                        @else
                        <div class="w-auto inline-block font-bold mb-2 p-2 text-right text-green-500">
                            <a href="{{ route('club.addPersonnel', $club->id ) }}">
                                <i class="fas fa-user-plus text-green-500"></i> Add new
                            </a>
                        </div>
                        @endif
                    </div>
                    <div class="w-full mt-2">
                        <div class="w-36 inline-block font-bold mb-2 text-gray-500 p-2">Coach:</div>
                        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">{{ $personnel['Coach']->name ?? 'Not set' }}</div>
                        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Email:</div>
                        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">{{ $personnel['Coach']->email ?? 'Not set' }}</div>
                        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Phone:</div>
                        <div class="w-48 bg-gray-100 p-2 rounded inline-block font-semibold">{{ $personnel['Coach']->phone ?? 'Not set' }}</div>
                        @if ($personnel['Coach'])
                        <div class="w-auto inline-block font-bold mb-2 p-2 text-right">
                            <a href="" title="View details"><i class="far fa-eye text-green-500 mr-2"></i></a>
                            <a href="" title="Edit"><i class="far fa-edit text-blue-500 mr-2"></i></a>
                        <a href="{{ route('personnel.delete', [$personnel['Coach']->id]) }}" title="Delete person record" onclick="return confirm('Do you want to delete the record completely?')"><i class="far fa-trash-alt text-red-600"></i></a>
                        </div>
                        @else
                        <div class="w-auto inline-block font-bold mb-2 p-2 text-right text-green-500">
                            <a href="{{ route('club.addPersonnel', $club->id ) }}">
                                <i class="fas fa-user-plus text-green-500"></i> Add new
                            </a>
                        </div>
                        @endif
                    </div>
                    <div class="w-full mt-2">
                        <div class="w-36 inline-block font-bold mb-2 text-gray-500 p-2">Volunteer:</div>
                        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">{{ $personnel['Volunteer']->name ?? 'Not set' }}</div>
                        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Email:</div>
                        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">{{ $personnel['Volunteer']->email ?? 'Not set' }}</div>
                        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Phone:</div>
                        <div class="w-48 bg-gray-100 p-2 rounded inline-block font-semibold">{{ $personnel['Volunteer']->phone ?? 'Not set' }}</div>
                        @if ($personnel['Volunteer'])
                        <div class="w-auto inline-block font-bold mb-2 p-2 text-right">
                            <a href="" title="View details"><i class="far fa-eye text-green-500 mr-2"></i></a>
                            <a href="" title="Edit"><i class="far fa-edit text-blue-500 mr-2"></i></a>
                        <a href="{{ route('personnel.delete', [$personnel['Volunteer']->id]) }}" title="Delete person record" onclick="return confirm('Do you want to delete the record completely?')"><i class="far fa-trash-alt text-red-600"></i></a>
                        </div>
                        @else
                        <div class="w-auto inline-block font-bold mb-2 p-2 text-right text-green-500">
                            <a href="{{ route('club.addPersonnel', $club->id ) }}">
                                <i class="fas fa-user-plus text-green-500"></i> Add new
                            </a>
                        </div>
                        @endif
                    </div>

                </div>
                <div class="w-full border border-gray-300 rounded-xl my-4 p-4 flex flex-wrap">
                    <h4 class="font-bold text-xl text-black mb-4">Members:</h4>
                    <div class="w-full">
                        <button class="button-primary">+ Add new member</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
@endsection
