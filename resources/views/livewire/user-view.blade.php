<div class="p-6">
    <div class="flex justify-between mb-4">
        <div class="w-1/3 mb-4">
            <input type="search" wire:model.live.debounce.500ms="search"
                   class="shadow border-gray-300 rounded w-full py-2 px-3 text-grey-darker"
                   placeholder="Filter by person's or a club's name">
            @if($searchQuery !='')
                <a href="" wire:click="clear" class="text-xs text-red-700 font-semibold mt-1 ml-2 block">Clear</a>
            @endif
        </div>
        <div class="flex justify-end gap-8 text-gray-600">
            <div class="flex items-center">
                <label for="status" class="mr-2 text-sm">Status</label>
                <select name="status" class="text-sm" wire:model.live="status">
                    <option value="" selected>All Statuses</option>
                    <option value="active" selected>Active</option>
                    <option value="pending" selected>Pending</option>
                </select>
            </div>
            <div class="flex items-center">
                <label for="email_status" class="mr-2 text-sm">Email Ver. Status</label>
                <select name="email_status" class="text-sm" wire:model.live="email_status">
                    <option value="" selected>All Statuses</option>
                    <option value="requested" selected>Requested</option>
                    <option value="granted" selected>Granted</option>
                    <option value="rejected" selected>Rejected</option>
                </select>
            </div>
        </div>
    </div>

    @if(Session::has('email_status'))
        <div class="alert-success">
            {{ Session::get('email_status') }}
        </div>
    @endif
    @if(Session::has('email_status_rejected'))
        <div class="alert-danger">
            {{ Session::get('email_status_rejected') }}
        </div>
    @endif
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
                ID
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
                class="px-5 py-3 bg-gray-600 text-left text-xs font-semibold text-gray-100 uppercase
                                    tracking-wider">
                Email 2-FA
            </th>
            <th
                class="px-5 py-3 rounded-r bg-gray-600 text-left text-xs font-semibold text-gray-100 uppercase
                                    tracking-wider">
                Operations
            </th>
        </tr>
        </thead>
        <tbody>
        @forelse ($users as $user)
            <tr class="hover:bg-gray-200">
                <td class="px-5 py-3 border-b border-gray-200 text-sm">
                    <div class="flex items-center">
                        <div class="ml-3">
                            <p class="text-gray-900 whitespace-no-wrap font-bold">
                                {{ $loop->iteration + $users->firstItem() - 1}}
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
                    <p class="text-gray-900 whitespace-no-wrap">{{ $user->id }}</p>
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
                <td class="px-5 py-3 border-b border-gray-200">
                    <span class="text-sm font-semibold text-gray-500 mr-4">{{ ucfirst($user->email_request_status) }}</span>
                    @if($user->email_request_status == 'requested')
                        <a class="cursor-pointer" title="Grant access" wire:click="grantAccess({{ $user }})"><i class="fas fa-thumbs-up mr-2 text-green-600"></i> </a>
                        <a class="cursor-pointer" title="Decline access" wire:click="rejectAccess({{ $user }})">
                            <i class="fas fa-thumbs-down text-red-700"></i></a>
                    @endif
                </td>
                <td class="px-5 py-3 border-b border-gray-200 text-sm">
                    <div class="flex space-x-4 content-center">
                        <a href="{{ route('user.delete-user', $user) }}" onclick="return confirm('Are you sure you want to delete this user?')"
                           class="text-red-700 font-semibold hover:underline">Delete</a>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="px-4 py-8 text-xl text-gray-400 font-semibold text-center">No users with this criteria</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div class="mt-4 text-right">
        {{ $users->links() }}
    </div>
</div>
