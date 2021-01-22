<td class="px-5 py-5 border-b border-gray-200">
    <div class="text-gray-700 font-bold">{{ $headCoach->name }}</div>
    <div class="text-sm">
        <span class="font-bold text-gray-500 w-8">e:</span>
        <a href="mailto:{{ $headCoach->email }}">
            {{ $headCoach->email }}</a>
        <br>
        <span
            class="font-bold text-gray-500 w-8">t:</span>
        {{ $headCoach->phone }}
    </div>

</td>
<td class="px-5 py-5 border-b border-gray-200">
    <div class="flex items-center text-sm">
        <div>
            <div class="gray-date">
                {{ $headCoach->safeguarding_completion ?? 'Not set' }}</div>
            @if ( $headCoach->safeguarding_expiry)
                @if($headCoach->safeguarding_expiry < now())
                    <div class="expired-date">{{
                                                                    $headCoach->safeguarding_expiry }}</div>
                @else
                    <div class="valid-date">
                        {{ $headCoach->safeguarding_expiry }}
                    </div>
                @endif
            @else
                <div
                    class="bg-gray-200 text-gray-600 rounded-lg py-1 px-2">
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
                {{ $headCoach->vetting_completion ?? 'Not set' }}</div>
            @if ( $headCoach->vetting_expiry)
                @if($headCoach->vetting_expiry < now())
                    <div class="expired-date">{{
                                                                    $headCoach->vetting_expiry }}</div>
                @else
                    <div class="valid-date">
                        {{ $headCoach->vetting_expiry }}
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
                {{ $headCoach->first_aid_completion ?? 'Not set' }}</div>
            @if ( $headCoach->first_aid_expiry)
                @if($headCoach->first_aid_expiry < now())
                    <div class="expired-date">{{
                                                                    $headCoach->first_aid_expiry }}</div>
                @else
                    <div class="valid-date">
                        {{ $headCoach->first_aid_expiry }}
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
                {{$headCoach->coaching_qualification ?? 'Not set'}}
            </div>
            <div class="gray-date">
                {{ $headCoach->coaching_date ?? 'Not set'}}
            </div>
        </div>
    </div>
</td>
<td class="py-12 border-b border-gray-200 text-sm flex flex-wrap
                                                justify-center h-full">
    <a href="{{ route('personnel.edit', $headCoach->id) }}"
       class="text-judo-600 hover:text-judo-400 font-bold" title="Edit details"><i
            class="far fa-edit"></i></a>
    <form action="{{ route('personnel.destroy', $headCoach->id) }}"
          method="POST">
        @csrf
        <input type="hidden" name="_method" value="DELETE"/>
        <button type="submit"
                class="text-red-600 hover:text-red-300 whitespace-no-wrap ml-3"
                onclick="return confirm('Do you want to delete the record completely?')">
            <i class="far fa-trash-alt"></i></button>
    </form>
</td>
