<tr>
    <td class="px-5 py-5 border-b border-gray-200 text-sm">
        <div class="flex items-center">
            <div>
                <p class="text-gray-900 whitespace-no-wrap font-bold">
                    {{ $volunteer->name }}
                </p>
            </div>
        </div>
    </td>
    <td class="px-5 py-5 border-b border-gray-200 text-sm">
        <div class="flex items-center">
            <div>
                <span class="font-bold text-gray-500 w-8">e:</span>
                <a href="mailto:{{ $volunteer->email }}">{{ $volunteer->email }}</a>
                <br>
                <span
                    class="font-bold text-gray-500 w-8">t:</span>
                {{ $volunteer->phone }}
            </div>
        </div>
    </td>
    <td class="px-5 py-5 border-b border-gray-200 text-sm">
        <div class="flex items-center">
            <div>
                <span class="gray-date">{{ $volunteer->vetting_completion ?? 'Not set' }}</span>
                -
                @if ( $volunteer->vetting_expiry)
                    @if($volunteer->vetting_expiry < now())
                        <span
                            class="expired-date">{{ $volunteer->vetting_expiry }}</span>
                    @else
                        <span
                            class="valid-date">{{ $volunteer->vetting_expiry }}</span>
                    @endif
                @else
                    <span
                        class="gray-date">Not set</span>
                @endif

            </div>
        </div>
    </td>
    <td class="px-5 py-5 border-b border-gray-200 text-sm">
        <div class="flex items-center">
            <span class="gray-date">{{ $volunteer->safeguarding_completion ?? 'Not set'}}</span>
            -
            @if ( $volunteer->safeguarding_expiry)
                @if($volunteer->safeguarding_expiry < now())
                    <span
                        class="expired-date">{{ $volunteer->safeguarding_expiry }}</span>
                @else
                    <span
                        class="valid-date">{{ $volunteer->safeguarding_expiry }}</span>
                @endif
            @else
                <span
                    class="gray-date">Not set</span>
            @endif
        </div>
    </td>
    @role('admin')
    <td class="px-8 py-8 border-b border-gray-200 text-sm flex flex-wrap h-full">
        <a href="{{ route('volunteer.edit', $volunteer->id) }}"
           class="text-green-600 font-bold ml-3"
           title="Edit volunteer details"><i
                class="far fa-edit"></i></a>
        <form action="{{ route('volunteer.destroy', $volunteer->id) }}"
              method="POST">
            @csrf
            <input type="hidden" name="_method" value="DELETE"/>
            <button type="submit"
                    class="text-red-600 hover:text-red-300 whitespace-no-wrap ml-3"
                    onclick="return confirm('Do you want to delete the record completely?')">
                <i class="far fa-trash-alt"></i></button>
        </form>
    </td>
    @endrole
</tr>
