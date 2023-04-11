<div class="p-6">
    <div class="w-1/2 mb-4">
        <input type="search" wire:model.debounce.500ms="searchQuery"
               class="shadow border-gray-300 rounded w-full py-2 px-3 text-grey-darker"
               placeholder="Filter by person's or a club's name">
    </div>
    @if(Session::has('message'))
        <div class="alert-success">
            {{ Session::get('message') }}
        </div>
    @endif
    <table class="min-w-full table leading-normal">
        <thead>
        <tr>
            <th
                class="px-5 py-3 rounded-l bg-gray-600 text-center text-xs font-semibold text-gray-100 uppercase
                                    tracking-wider">
                #
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
