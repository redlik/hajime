<div class="container">
    <div class="w-full">
        <div class="w-full flex flex-wrap">
            <div class="w-full md:w-1/2">
                <input type="search" wire:model.debounce.500ms="searchQuery" class="shadow appearance-none border rounded w-full md:w-64 py-2 px-3 text-grey-darker mt-4" placeholder="Filter by name"></div>
            <div class="w-full md:w-1/2">
                {{ $members->links() }}</div>
        </div>
        
        
        <table class="min-w-full table leading-normal mt-8">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Name
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider hidden md:block">
                        Club
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Membership
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
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <div class="flex items-center">
                            <div class="ml-3">
                                <p class="text-gray-900 whitespace-no-wrap font-bold">
                                <a href="{{ route('clubs.show', $club) }}" class="hover:text-cool-gray-400" title="View club page">{{ $member->first_name }} {{ $member->last_name }}</a>
                                </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm hidden md:block">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $member->club->name }}
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">
                            Active
                        </p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
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
            {{ $members->links() }}
        </div>
    </div>
</div>