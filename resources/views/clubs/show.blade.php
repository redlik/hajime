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
            </div>
        </section>
    </div>
</main>
@endsection
