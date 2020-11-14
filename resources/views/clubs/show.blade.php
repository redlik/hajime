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
                    {{-- <div class="w-full mb-4">
                        <a href="{{ route('club.addPersonnel', $club->id ) }}">
                    <button class="button-primary">+ Insert details</button>
                    </a>
                </div> --}}
                {{-- Alpine JS Modal starts here--}}
                @livewire('personnel')

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
