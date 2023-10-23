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
        <table class="min-w-full table-auto leading-normal">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 rounded-l bg-gray-600 text-left text-xs font-semibold
                        text-gray-100
                        uppercase tracking-wider shadow-lg">
                        Memb. No
                    </th>
                    <th
                        class="px-5 py-3 bg-gray-600 text-left text-xs font-semibold
                        text-gray-100
                        uppercase tracking-wider shadow-lg">
                        Name
                    </th>
                    <th
                        class="px-5 py-3 bg-gray-600 text-left text-xs font-semibold
                        text-gray-100
                        uppercase tracking-wider hidden md:block shadow-lg">
                        Age
                    </th>
                    <th
                        class="px-5 py-3 bg-gray-600 text-left text-xs font-semibold
                        text-gray-100
                        uppercase tracking-wider shadow-lg">
                        Status
                    </th>
                    <th
                        class="px-5 py-3 bg-gray-600 text-left text-xs font-semibold
                        text-gray-100
                        uppercase tracking-wider shadow-lg">
                        Membership Type
                    </th>
                    <th
                        class="px-5 py-3 bg-gray-600 text-left text-xs font-semibold
                        text-gray-100
                        uppercase tracking-wider shadow-lg">
                        Grade
                    </th>
                    @role('admin')
                    <th
                        class="px-5 py-3 rounded-r bg-gray-600 text-center text-xs font-semibold text-gray-100
                        uppercase
                        tracking-wider shadow-lg">
                        Actions
                    </th>
                    @endrole
                    @role('manager')
                    <th
                        class="px-5 py-3 rounded-r bg-gray-600 text-center text-xs font-semibold text-gray-100
                        uppercase
                        tracking-wider shadow-lg">
                    </th>
                    @endrole
                </tr>
            </thead>
            <tbody>
                @forelse ($members as $member)
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
                            <span class="green-pillow">Active</span>
                            @else
                            <span class="red-pillow">Inactive</span>
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
                        @role('admin')
                        <p class="text-gray-900 whitespace-no-wrap">
                            <a href="{{ route('member.show', $member) }}" class="text-blue-600 font-bold
                            hover:text-blue-300" title="View member details"><i class="far fa-eye"></i></a>
                            <a href="{{ route('member.edit', $member) }}" class="text-green-600 font-bold ml-3"
                               title="Edit member details"><i class="far fa-edit"></i></a>
                            <a href="{{ route('member.duplicate.existing', $member->id) }}" class="text-pink-600
                            font-bold
                            hover:text-pink-300 ml-3" title="Clone existing member"><i class="far fa-clone"></i></a>
                        </p>
                        @endrole
                    </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <h4 class="text-xl text-gray-400 my-5 text-center">No member with active
                                membership registered right now.</h4>
                        </td>
                    </tr>
                    @endforelse
            </tbody>
        </table>

    </div>
</div>
