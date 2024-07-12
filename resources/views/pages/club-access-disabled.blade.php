@extends('layouts.app')

@section('content')
    <main class="sm:mx-2 mx-10 sm:mt-10">
        <div class="w-full sm:px-6" x-data="{openModal : $wire.entangle('showModal')}">

            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm">

                <div class="px-8 py-8">
                    <h3 class="text-xl font-bold mb-4">The access to Hajime database has been temporary disabled.</h3>
                    <p>Please contact site administrator for more details</p>
                </div>
            </section>
        </div>

    </main>
@endsection
