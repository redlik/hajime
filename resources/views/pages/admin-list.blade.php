@extends('layouts.app')

@section('content')
    <main class="sm:mx-2 mx-10 sm:mt-10">
        <div class="w-full sm:px-6">

            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

                <header class="font-semibold text-xl bg-gray-600 text-gray-100 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                    Admin Users List
                </header>
                <div class="px-8">
                    <table class="w-full table-auto leading-normal my-8">
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
                                Name
                            </th>
                            <th
                                class="px-5 py-3 bg-gray-600 text-left text-xs font-semibold
                        text-gray-100 uppercase tracking-wider">
                                Email
                            </th>
                            <th
                                class="px-5 py-3 bg-gray-600 text-left text-xs font-semibold
                        text-gray-100 uppercase tracking-wider">
                                Created At
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
                        @foreach ($admins as $admin)
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
                                                {{ $admin->name }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                    <div class="flex items-center">
                                        <div>
                                            <p class="text-gray-900 whitespace-no-wrap font-bold">
                                                {{ $admin->email }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm hidden lg:block">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ \Carbon\Carbon::parse($admin->created_at)->format('d/m/Y H:i') }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                    @if($admin->id != 1)
                                        <form action="" method="POST">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE"/>
                                            <button type="submit"
                                                    class="text-red-600 hover:text-red-300 whitespace-no-wrap"
                                                    onclick="return confirm('Do you want to delete the user completely?')"
                                                    title="Remove user from Hajime">
                                                <i class="far fa-trash-alt text-xl"></i></button>
                                        </form>
                                    @else
                                        <i class="far fa-trash-alt text-gray-400 text-xl cursor-not-allowed"
                                           title="Cannot delete this user"></i>
                                    @endif
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
