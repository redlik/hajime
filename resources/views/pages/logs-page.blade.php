@extends('layouts.app')

@section('content')
    <main class="sm:mx-2 mx-10 sm:mt-10">
        <div class="w-full sm:px-6">

            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

                <header class="font-semibold text-xl bg-gray-600 text-gray-100 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                    Activity log
                </header>
                <div class="px-8">
                    <div class="text-gray-500 text-sm mt-4 text-right">Sorted from newest to oldest</div>
                    <table class="w-full table-auto leading-normal mt-4 mb-8">
                        <thead>
                        <tr>
                            <th
                                class="px-5 py-3 rounded-l bg-gray-600 text-left text-xs font-semibold text-gray-100 uppercase
                    tracking-wider">
                                #
                            </th>
                            <th
                                class="px-5 py-3 bg-gray-600 text-left text-xs
                        font-semibold
                        text-gray-100 uppercase tracking-wider">
                                Activity
                            </th>
                            <th
                                class="px-5 py-3 bg-gray-600 text-left text-xs font-semibold
                        text-gray-100 uppercase tracking-wider">
                                Changed Item
                            </th>
                            <th
                                class="px-5 py-3 bg-gray-600 text-left text-xs font-semibold
                        text-gray-100 uppercase tracking-wider">
                                Changed By
                            </th>
                            <th
                                class="px-5 py-3 bg-gray-600 text-center text-xs font-semibold
                        text-gray-100 uppercase tracking-wider">
                                Date & Time
                            </th>
                            <th
                                class="px-5 py-3 rounded-r bg-gray-600 text-left text-xs
                        font-semibold
                        text-gray-100 uppercase tracking-wider">
                                Operations
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($logs as $log)
                            <tr class="hover:bg-gray-200">
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                    <div class="flex items-center">
                                        <div class="">
                                            <p class="text-gray-400 whitespace-no-wrap">
                                                {{ $loop->iteration }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                    <div class="flex items-center">
                                        <div>
                                            <p class="text-gray-900 whitespace-no-wrap font-bold">
                                                {{ $log->description }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                    <div class="flex items-center">
                                        <div>
                                            <p class="text-gray-900 whitespace-no-wrap font-bold">
                                                {{ $log->getExtraProperty('name') }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm hidden lg:block">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        @php
                                        $user = \App\Models\User::find($log->causer_id);
                                         @endphp
                                        {{ $user->name }}
                                    </p>
                                </td>
                                <td class="py-5 border-b border-gray-200 text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap text-center">
                                        {{ \Carbon\Carbon::parse($log->created_at)->format('d/m/Y H:i') }}
                                    </p>
                                </td>

                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                    </p>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </section>
        </div>
    </main>
@endsection
