@extends('layouts.app')

@section('content')
    <main class="sm:container sm:mx-auto sm:mt-10">
        <div class="w-full sm:px-6">
            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

                <header class="font-semibold text-xl bg-gray-600 text-gray-100 py-4 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                    User accounts
                </header>

                <div class="p-6">
                    <table class="min-w-full table leading-normal">
                        <thead>
                        <tr>
                            <th
                                class="px-5 py-3 rounded-l bg-gray-600 text-left text-xs font-semibold text-gray-100 uppercase
                                    tracking-wider">
                                No
                            </th>
                            <th
                                class="px-5 py-3 bg-gray-600 text-left text-xs font-semibold text-gray-100 uppercase
                                    tracking-wider">
                                Name
                            </th>
                            <th
                                class="px-5 py-3 bg-gray-600 text-left text-xs font-semibold text-gray-100 uppercase
                                    tracking-wider">
                                Club
                            </th>
                            <th
                                class="px-5 py-3 bg-gray-600 text-left text-xs font-semibold text-gray-100 uppercase
                                    tracking-wider">
                                Status
                            </th>
                            <th
                                class="px-5 py-3 rounded-r bg-gray-600 text-left text-xs font-semibold text-gray-100 uppercase
                                    tracking-wider">
                                Operations
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-200">
                                <td class="px-5 py-3 border-b border-gray-200 text-sm">
                                    <div class="flex items-center">
                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap font-bold">
                                                {{ $loop->iteration }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-3 border-b border-gray-200 text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $user->name }}
                                        <br>
                                    <span class="text-xs text-gray-500">{{ $user->email }}</span></p>

                                </td>
                                <td class="px-5 py-3 border-b border-gray-200 text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $user->club_manager->name }}</p>
                                </td>
                                <td class="px-5 py-3 border-b border-gray-200 text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ ucfirst($user->status) }}</p>
                                </td>
                                <td class="px-5 py-3 border-b border-gray-200 text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        @if ($user->status == 'pending')
                                            <span class="green-pillow">Activate</span>
                                        @else
                                            <span class="red-pillow">Deactivate</span>
                                        @endif

                                    </p>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4 text-right">
                        {{ $users->links() }}
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
