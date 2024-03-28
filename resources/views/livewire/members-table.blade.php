<div class="container">
    <div class="w-full">
        <div class="flex flex-wrap content-center justify-between mt-4">
            <div class="w-1/2">
                <input type="search" wire:model.live.debounce.500ms="searchQuery"
                       class="shadow border-gray-300 rounded w-full py-2 px-3 text-grey-darker"
                       placeholder="Filter by name, number or date of birth"></div>
            <div class="">
                {{ $members->links() }}</div>
        </div>
        <table class="min-w-full table leading-normal mt-8">
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
                    Memb. No
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
                    D.O.B.
                </th>
                <th
                    class="px-5 py-3 bg-gray-600 text-left text-xs font-semibold text-gray-100 uppercase
                    tracking-wider">
                    Membership
                </th>
                <th
                    class="px-5 py-3 rounded-r bg-gray-600 text-left text-xs font-semibold text-gray-100 uppercase
                    tracking-wider">
                    Operations
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach ($members as $member)
                <tr class="hover:bg-gray-200">
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        <div class="flex items-center">
                            <div class="ml-3">
                                <p class="text-gray-400 whitespace-no-wrap">
                                    {{ $loop->iteration }}
                                </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        <div class="flex items-center">
                            <div class="ml-3">
                                <p class="text-gray-900 whitespace-no-wrap font-bold">
                                    {{ $member->number }}
                                </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        <div class="flex items-center">
                            <div class="ml-0">
                                <p class="text-gray-900 whitespace-no-wrap font-bold">
                                    <a href="{{ route('member.show', $member) }}" class="hover:text-cool-gray-400"
                                       title="View club page">{{ $member->first_name }} {{ $member->last_name }}</a>
                                </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $member->club->name ?? "Error, why?"}}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $member->dob }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">
                            @if ($member->active == true)
                                <span class="green-pillow">Active</span>
                            @else
                                <span class="red-pillow">Inactive</span>
                            @endif

                        </p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">
                            <a href="{{ route('member.show', $member) }}"
                               class="text-blue-600 font-bold hover:text-blue-300" title="View member page"><i
                                    class="far fa-eye"></i></a>
                            <a href="{{ route('member.edit', $member) }}" class="text-green-600 font-bold ml-3"
                               title="Edit member details"><i class="far fa-edit"></i></a>
                        </p>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="mt-4 text-right">
            {{ $members->links() }}
        </div>
    </div>
</div>
