<div class="container">
    <div class="w-full">
        <div class="flex flex-wrap content-center justify-between mt-4">
            <div class="w-full md:w-1/2">
                <input type="search" wire:model.debounce.500ms="searchQuery" class="shadow border-gray-300 rounded
                w-full py-2 px-3 text-grey-darker mt-4" placeholder="Filter by name"></div>
            <div class="">
                {{ $clubs->links() }}</div>
        </div>


        <table class="min-w-full table leading-normal mt-8">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 rounded-l bg-gray-600 text-left text-xs
                        font-semibold
                        text-gray-100 uppercase tracking-wider">
                        Club name
                    </th>
                    <th
                        class="px-5 py-3 bg-gray-600 text-left text-xs font-semibold
                        text-gray-100 uppercase tracking-wider hidden md:block">
                        Location
                    </th>
                    <th
                        class="px-5 py-3 bg-gray-600 text-center text-xs font-semibold
                        text-gray-100 uppercase tracking-wider">
                        Members (Active)
                    </th>
                    <th
                        class="px-5 py-3 bg-gray-600 text-center text-xs font-semibold
                        text-gray-100 uppercase tracking-wider">
                        Status
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
                @foreach ($clubs as $club)
                <tr class="hover:bg-gray-200">
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        <div class="flex items-center">
                            <div class="ml-3">
                                <p class="text-gray-900 whitespace-no-wrap font-bold">
                                    <a href="{{ route('clubs.show', $club) }}" class="hover:text-cool-gray-400" title="View club page">{{ $club->name }}</a>
                                </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm hidden md:block">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $club->address1}}, {{$club->city}}
                        </p>
                    </td>
                    <td class="py-5 border-b border-gray-200 text-sm">
                        <p class="text-gray-900 whitespace-no-wrap text-center">
                            {{ $club->activeMembersCount() }}
                        </p>
                    </td>
                    <td class="py-5 border-b border-gray-200 text-sm">
                        <p class="text-gray-900 whitespace-no-wrap text-center">
                            @if ($club->status == "Active")
                                <span class="green-pillow">Active</span>
                            @else
                                <span class="red-pillow">Inactive</span>
                            @endif
                        </p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">
                            <a href="{{ route('clubs.show', $club) }}" class="text-blue-600 font-bold hover:text-blue-300" title="View club page"><i class="far fa-eye"></i></a>
                            <a href="{{ route('clubs.edit', $club) }}" class="text-green-600 font-bold ml-3" title="Edit club details"><i class="far fa-edit"></i></a>
                        </p>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $clubs->links() }}
        </div>
    </div>
</div>
