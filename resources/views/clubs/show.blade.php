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
                    <h4 class="font-bold text-xl text-black mb-4">Club Personel:</h4>
                    {{-- <div class="w-full mb-4">
                        <a href="{{ route('club.addPersonnel', $club->id ) }}">
                    <button class="button-primary">+ Insert details</button>
                    </a>
                </div> --}}
                {{-- Alpine JS Modal starts here--}}
                <div x-data="{showModal: false, name: 'name'}" @keydown.escape="showModal = false" x-cloak>

                    <div class="w-full">
                        @php
                            if ($personnel['Head Coach']) {
                                $name = $personnel['Head Coach']->name;
                                $email = $personnel['Head Coach']->email;
                                $phone = $personnel['Head Coach']->phone;
                            }
                        @endphp
                        <div class="w-36 inline-block font-bold mb-2 text-gray-500 p-2">Head Coach:</div>
                        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">
                            {{ $personnel['Head Coach']->name ?? 'Not set' }}</div>
                        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Email:</div>
                        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">
                            {{ $personnel['Head Coach']->email ?? 'Not set' }}</div>
                        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Phone:</div>
                        <div class="w-48 bg-gray-100 p-2 rounded inline-block font-semibold">
                            {{ $personnel['Head Coach']->phone ?? 'Not set' }}</div>
                        @if ($personnel['Head Coach'])
                        <div class="w-auto inline-block font-bold mb-2 p-2 text-right">
                        <button type="button" title="View details" @click="showModal=true, name='{{ $name }}', email = '{{ $email}}', phone='{{ $phone }}'"><i
                                    class="far fa-eye text-green-500 mr-2"></i></button>
                            <a href="" title="Edit"><i class="far fa-edit text-blue-500 mr-2"></i></a>
                            <a href="{{ route('personnel.delete', [$personnel['Head Coach']->id]) }}"
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
                    </div>
                    <div class="w-full mt-2">
                        <div class="w-36 inline-block font-bold mb-2 text-gray-500 p-2">Secretary:</div>
                        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">
                            {{ $personnel['Secretary']->name ?? 'Not set' }}</div>
                        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Email:</div>
                        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">
                            {{ $personnel['Secretary']->email ?? 'Not set' }}</div>
                        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Phone:</div>
                        <div class="w-48 bg-gray-100 p-2 rounded inline-block font-semibold">
                            {{ $personnel['Secretary']->phone ?? 'Not set' }}</div>
                        @if ($personnel['Secretary'])
                        <div class="w-auto inline-block font-bold mb-2 p-2 text-right">
                            <a href="" title="View details"><i class="far fa-eye text-green-500 mr-2"></i></a>
                            <a href="" title="Edit"><i class="far fa-edit text-blue-500 mr-2"></i></a>
                            <a href="{{ route('personnel.delete', [$personnel['Secretary']->id]) }}"
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
                    </div>
                    <div class="w-full mt-2">
                        <div class="w-36 inline-block font-bold mb-2 text-gray-500 p-2">Designated Off:</div>
                        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">
                            {{ $personnel['Designated Officer']->name ?? 'Not set' }}</div>
                        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Email:</div>
                        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">
                            {{ $personnel['Designated Officer']->email ?? 'Not set' }}</div>
                        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Phone:</div>
                        <div class="w-48 bg-gray-100 p-2 rounded inline-block font-semibold">
                            {{ $personnel['Designated Officer']->phone ?? 'Not set' }}</div>
                        @if ($personnel['Designated Officer'])
                        <div class="w-auto inline-block font-bold mb-2 p-2 text-right">
                            <a href="" title="View details"><i class="far fa-eye text-green-500 mr-2"></i></a>
                            <a href="" title="Edit"><i class="far fa-edit text-blue-500 mr-2"></i></a>
                            <a href="{{ route('personnel.delete', [$personnel['Designated Officer']->id]) }}"
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
                    </div>
                    <div class="w-full mt-2">
                        <div class="w-36 inline-block font-bold mb-2 text-gray-500 p-2">Childrens Off:</div>
                        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">
                            {{ $personnel['Childrens Officer']->name ?? 'Not set' }}</div>
                        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Email:</div>
                        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">
                            {{ $personnel['Childrens Officer']->email ?? 'Not set' }}</div>
                        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Phone:</div>
                        <div class="w-48 bg-gray-100 p-2 rounded inline-block font-semibold">
                            {{ $personnel['Childrens Officer']->phone ?? 'Not set' }}</div>
                        @if ($personnel['Childrens Officer'])
                        <div class="w-auto inline-block font-bold mb-2 p-2 text-right">
                            <a href="" title="View details"><i class="far fa-eye text-green-500 mr-2"></i></a>
                            <a href="" title="Edit"><i class="far fa-edit text-blue-500 mr-2"></i></a>
                            <a href="{{ route('personnel.delete', [$personnel['Childrens Officer']->id]) }}"
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
                    </div>
                    <div class="w-full mt-2">
                        <div class="w-36 inline-block font-bold mb-2 text-gray-500 p-2">Coach:</div>
                        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">
                            {{ $personnel['Coach']->name ?? 'Not set' }}</div>
                        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Email:</div>
                        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">
                            {{ $personnel['Coach']->email ?? 'Not set' }}</div>
                        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Phone:</div>
                        <div class="w-48 bg-gray-100 p-2 rounded inline-block font-semibold">
                            {{ $personnel['Coach']->phone ?? 'Not set' }}</div>
                        @if ($personnel['Coach'])
                        <div class="w-auto inline-block font-bold mb-2 p-2 text-right">
                            <a href="" title="View details"><i class="far fa-eye text-green-500 mr-2"></i></a>
                            <a href="" title="Edit"><i class="far fa-edit text-blue-500 mr-2"></i></a>
                            <a href="{{ route('personnel.delete', [$personnel['Coach']->id]) }}"
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
                    </div>
                    <div class="w-full mt-2">
                        <div class="w-36 inline-block font-bold mb-2 text-gray-500 p-2">Volunteer:</div>
                        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">
                            {{ $personnel['Volunteer']->name ?? 'Not set' }}</div>
                        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Email:</div>
                        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">
                            {{ $personnel['Volunteer']->email ?? 'Not set' }}</div>
                        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Phone:</div>
                        <div class="w-48 bg-gray-100 p-2 rounded inline-block font-semibold">
                            {{ $personnel['Volunteer']->phone ?? 'Not set' }}</div>
                        @if ($personnel['Volunteer'])
                        <div class="w-auto inline-block font-bold mb-2 p-2 text-right">
                            <a href="" title="View details"><i class="far fa-eye text-green-500 mr-2"></i></a>
                            <a href="" title="Edit"><i class="far fa-edit text-blue-500 mr-2"></i></a>
                            <a href="{{ route('personnel.delete', [$personnel['Volunteer']->id]) }}"
                                title="Delete person record"
                                onclick="return confirm('Do you want to delete the record completely?')"><i
                                    class="far fa-trash-alt text-red-600"></i></a>
                        </div>
                        @else
                        <div class="w-auto inline-block font-bold mb-2 p-2 text-right judo-green">
                            <a href="{{ route('club.addPersonnel', $club->id ) }}">
                                <i class="fas fa-user-plus judo-green"></i> Add new
                            </a>
                        </div>
                        @endif
                    </div>

                    {{-- Modal starts here --}}
                    <!--Overlay-->
                    <div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="showModal"
                        :class="{ 'absolute inset-0 z-10 flex items-center justify-center': showModal }">
                        <!--Dialog-->
                        <div class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg py-4 text-left px-6"
                            x-show="showModal" @click.away="showModal = false"
                            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
                            x-transition:enter-end="opacity-100">

                            <!--Title-->
                            <div class="flex justify-between items-center pb-3">
                                <p class="text-2xl font-bold" x-text="name"></p>
                                <div class="cursor-pointer z-50" @click="showModal = false">
                                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18"
                                        height="18" viewBox="0 0 18 18">
                                        <path
                                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                        </path>
                                    </svg>
                                </div>
                            </div>

                            <!-- content -->
                            <div class="inline-block w-36">Phone:</div>
                            <p class="inline-block w-auto font-bold" x-text="phone"></p>

                            <!--Footer-->
                            <div class="flex justify-end pt-2">
                                <button
                                    class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400"
                                    @click="showModal = false">Close</button>
                            </div>


                        </div>
                        <!--/Dialog -->
                    </div><!-- /Overlay -->
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
                <h4 class="font-bold text-xl text-gray-500 mb-4">Club notes:</h4>
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
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        <a href="{{ route('clubnote.show', $note->slug) }}" class="text-blue-600 font-bold hover:text-blue-300" title="View full note"><i class="far fa-eye"></i></a>
                                        <a href="{{ route('clubnote.edit', $note) }}" class="text-green-600 font-bold ml-3" title="Edit note"><i class="far fa-edit"></i></a>
                                    </p>
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
