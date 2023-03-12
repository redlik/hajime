@extends('layouts.app')

@section('content')
    <main class="sm:container sm:mx-auto sm:mt-10">
        <div class="w-full sm:px-6">
            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

                <header class="font-semibold text-xl bg-gray-600 text-gray-100 py-4 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                    User accounts
                </header>

                <div class="p-6">
                    @if(Session::has('message'))
                    <div class="alert-success">
                        {{ Session::get('message') }}
                    </div>
                    @endif
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
                                Registered at
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
                                    <p class="text-gray-900 whitespace-no-wrap">{{ $user->created_at->format('d M Y') }}</p>
                                </td>
                                <td class="px-5 py-3 border-b border-gray-200 text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap font-semibold">
                                        @switch($user->status)
                                            @case('pending')
                                            <span class="rounded p-2 shadow-sm bg-gray-200 text-gray-600">Pending</span>
                                            @break
                                            @case('active')
                                            <span class="rounded p-2 shadow-sm bg-green-100 text-green-700">Active</span>
                                            @break
                                            @case('deactivated')
                                            <span class="rounded p-2 shadow-sm bg-purple-100 text-purple-600">Deactivated</span>
                                            @break
                                        @endswitch
                                        </p>
                                </td>
                                <td class="px-5 py-3 border-b border-gray-200 text-sm">
                                    <div class="flex space-x-4 content-center">
                                        @if ($user->status == 'pending' || $user->status == 'deactivated')
                                        <form action="{{ route('user.activate-account') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="user" value="{{ $user->id }}">
                                            <input type="submit" class="green-pillow cursor-pointer hover:bg-judo-500 hover:text-white" value="Activate">
                                        </form>
                                        @else
                                        <form action="{{ route('user.deactivate-user') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="user" value="{{ $user->id }}">
                                            <input type="submit" class="red-pillow bg-purple-500 text-white cursor-pointer hover:bg-purple-700" value="Deactivate">
                                        </form>
                                        @endif
                                            <a href="{{ route('user.delete-user', $user) }}" onclick="return confirm('Are you sure you want to delete this user?')"
                                            class="text-red-700 font-semibold hover:underline">Delete</a>
                                    </div>
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
