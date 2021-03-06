<td class="px-5 py-5 border-b border-gray-200">
    <div class="text-gray-700 font-bold">{{ $designated->name }}</div>
    <div class="text-sm">
        <span class="font-bold text-gray-500 w-8">e:</span>
        <a href="mailto:{{ $designated->email }}">
            {{ $designated->email }}</a>
        <br>
        <span
            class="font-bold text-gray-500 w-8">t:</span>
        {{ $designated->phone }}
    </div>
</td>
<td class="px-5 py-5 border-b border-gray-200">
    <div class="flex items-center text-sm">
        <div>
            <div class="gray-date">
                {{ $designated->safeguarding_completion ?? 'Not set' }}</div>
            @if ( $designated->safeguarding_expiry)
                @if($designated->safeguarding_expiry < now())
                    <div class="expired-date">{{
                                                                    $designated->safeguarding_expiry }}</div>
                @else
                    <div class="valid-date">
                        {{ $designated->safeguarding_expiry }}
                    </div>
                @endif
            @else
                <div
                    class="gray-date">
                    Not set
                </div>
            @endif
        </div>
    </div>
</td>
<td class="px-5 py-5 border-b border-gray-200">
    <div class="flex items-center text-sm">
        <div>
            <div class="gray-date">
                {{ $designated->vetting_completion ?? 'Not set' }}</div>
            @if ( $designated->vetting_expiry)
                @if($designated->vetting_expiry < now())
                    <div class="expired-date">{{
                                                                    $designated->vetting_expiry }}</div>
                @else
                    <div class="valid-date">
                        {{ $designated->vetting_expiry }}
                    </div>
                @endif
            @else
                <div
                    class="gray-date">
                    Not set
                </div>
            @endif
        </div>
    </div>
</td>
<td class="px-5 py-5 border-b border-gray-200">
</td>
<td class="px-5 py-5 border-b border-gray-200 text-sm">
</td>
<td class="py-12 border-b border-gray-200 text-sm flex flex-wrap
                                                h-full justify-center">
    <a href="{{ route('personnel.edit', $designated->id) }}"
       class="text-judo-600 hover:text-judo-400 font-bold" title="Edit details"><i
            class="far fa-edit"></i></a>
    <form action="{{ route('personnel.destroy', $designated->id) }}"
          method="POST">
        @csrf
        <input type="hidden" name="_method" value="DELETE"/>
        <button type="submit"
                class="text-red-600 hover:text-red-300 whitespace-no-wrap ml-3"
                onclick="return confirm('Do you want to delete the record completely?')">
            <i class="far fa-trash-alt"></i></button>
    </form>
</td>
