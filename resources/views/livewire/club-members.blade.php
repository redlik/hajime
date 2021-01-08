<div class="container">

    <div class="w-full">
        <div class="w-full flex flex-wrap items-center justify-between my-4 p-3 rounded bg-gray-100">
            <div class="">
                <input type="search" wire:model.debounce.500ms="searchQuery"
                       class="shadow border-gray-300 rounded w-full py-2 px-3 text-grey-darker"
                       placeholder="Filter by name, number or eircode">
            </div>
            <div class="">
                <label for="sort">Sort by:</label>
                <select wire:model="sortby" name="sort" id="sort" class="shadow border-gray-300 rounded w-48
                text-grey-darker ml-2">
                    <option value="last_name" selected>Last Name</option>
                    <option value="number">Memership No</option>
                </select>
            </div>
            <div class="">
                <input type="checkbox" wire:model="active" id="showActive" name="showActive" value="1" checked
                       class="rounded border-judo-300
                                text-judo-600 shadow-sm focus:border-judo-300 focus:ring focus:ring-judo-200
                                focus:ring-opacity-50">
                <label for="showActive">Show active members only</label>
            </div>
            <div class="">
                <a href="{{ route('club.checkMemberships', ['club' => $club_id]) }}" class="button-judo">
                    <i class="fas fa-sync-alt mr-2"></i>
                    Check memberships</a>
            </div>
        </div>
        <div class="w-full">
            <div class="w-full">
                @if(Session::has('message'))
                    <p class="bg-green-100 text-green-700 p-6 rounded mb-4">{{ Session::get('message') }}</p>
                @endif
            </div>
            <div class="w-full my-4">
                {{ $members->links() }}</div>
        </div>
        <table class="min-w-full table leading-normal">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Memb. No
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Name
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider hidden md:block">
                        Age
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Status
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Membership Type
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Grade
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Operations
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($members as $member)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm hidden md:block">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $member->number }}
                    </td>
                    <td class="py-5 border-b border-gray-200 text-sm">
                        <div class="flex items-center">
                            <div class="ml-3">
                                <p class="text-gray-900 whitespace-no-wrap font-bold">
                                <a href="{{ route('member.show', $member) }}" class="hover:text-cool-gray-400" title="View club page">{{ $member->first_name }} {{ $member->last_name }}</a>
                                </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm hidden md:block">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $member->age }} years
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        @if ($member->active == true)
                            <span class="p-1 px-2 rounded bg-green-200 text-green-700">Active</span>
                            @else
                            <span class="p-1 px-2 rounded bg-red-200 text-red-700">Inactive</span>
                            @endif
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        @if($member->membership()->exists())
                        <p class="text-gray-900">{{ $member->membership->last()->membership_type }}</p>
                        @endif
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        @if($member->grade()->exists())
                        <p class="text-gray-900">{{ $member->grade->last()->grade_level }}</p>
                        @endif
                    </td>

                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">
                            <a href="{{ route('member.show', $member) }}" class="text-blue-600 font-bold
                            hover:text-blue-300" title="View member details"><i class="far fa-eye"></i></a>
                            <a href="{{ route('member.edit', $member) }}" class="text-green-600 font-bold ml-3"
                               title="Edit member details"><i class="far fa-edit"></i></a>
                        </p>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
