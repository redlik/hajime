<div class="container">

    <div class="w-full">
        <div class="w-full flex flex-wrap items-center gap-8 my-4 p-3 rounded bg-gray-100">
            <div class="">
                <input type="search" wire:model.debounce.500ms="searchQuery"
                       class="shadow border-gray-300 rounded w-[400px] py-2 px-3 text-grey-darker"
                       placeholder="Filter by name or membership number">
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
                    #
                </th>
                <th
                    class="px-5 py-3 bg-gray-600 text-left text-xs font-semibold
                        text-gray-100
                        uppercase tracking-wider shadow-lg">
                    Name
                </th>
                <th
                    class="px-5 py-3 bg-gray-600 text-center text-xs font-semibold
                        text-gray-100
                        uppercase tracking-wider shadow-lgg">
                    Membership No
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
                        <p class="text-gray-900 whitespace-no-wrap">{{ $loop->iteration }}
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
                    <td class="py-5 border-b border-gray-200 text-sm text-center">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $member->number }}
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

        <div class="text-sm text-gray-500 mt-4 ml-8">{{ $members->total() }} {{ \Illuminate\Support\Str::of('member')->plural($members->total())}} listed</div>

    </div>
</div>
