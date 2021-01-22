<tr>
    <td class="px-5 py-5 border-b border-gray-200 text-sm">
        <div class="flex items-center">
            <div class="">
                <p class="text-gray-900 whitespace-no-wrap font-bold">
                <div class="font-bold">{{ $coach->name }}</div>
                <div>
                    <span class="font-bold text-gray-500">e:</span>
                    <a href="mailto:{{ $coach->email }}">{{ $coach->email }}</a>
                    <br>
                    <span class="font-bold text-gray-500">t:</span>
                    {{ $coach->phone }}
                </div>
                </p>
            </div>
        </div>
    </td>
    <td class="px-5 py-5 border-b border-gray-200 text-sm">
        <div class="flex items-center">
            <div>
                <div class="gray-date">{{
                                                                        $coach->safeguarding_completion ?? 'Not set' }}</div>
                @if ( $coach->safeguarding_expiry)
                    @if($coach->safeguarding_expiry < now())
                        <div class="expired-date">{{
                                                                $coach->safeguarding_expiry }}</div>
                    @else
                        <div class="valid-date">{{
                                                                                $coach->safeguarding_expiry }}</div>
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
    <td class="px-5 py-5 border-b border-gray-200 text-sm">
        <div class="flex items-center">
            <div>
                <div class="gray-date">{{
                                                                        $coach->vetting_completion ?? 'Not set' }}</div>
                @if ( $coach->vetting_expiry)
                    @if($coach->vetting_expiry < now())
                        <div class="expired-date">{{ $coach->vetting_expiry
                                                                }}</div>
                    @else
                        <div class="valid-date">{{
                                                                                $coach->vetting_expiry }}</div>
                    @endif
                @else
                    <div class="gray-date">
                        Not set
                    </div>
                @endif
            </div>
        </div>
    </td>
    <td class="px-5 py-5 border-b border-gray-200 text-sm">
        <div class="flex items-center">
            <div>
                <div class="gray-date">{{
                                                                            $coach->first_aid_completion ?? 'Not set'}}</div>
                @if ( $coach->first_aid_expiry)
                    @if($coach->first_aid_expiry < now())
                        <div
                            class="expired-date">{{ $coach->first_aid_expiry
                                                                    }}</div>
                    @else
                        <div class="valid-date">{{ $coach->first_aid_expiry
                                                                }}</div>
                    @endif
                @else
                    <div class="gray-date">
                        Not set
                    </div>
                @endif
            </div>
        </div>
    </td>
    <td class="px-5 py-5 border-b border-gray-200 text-sm">
        <div class="flex items-center">
            <div>
                <div class="gray-date">
                    {{$coach->coaching_qualification ?? 'Not set'}}
                </div>
                <div class="gray-date">
                    {{ $coach->coaching_date ?? 'Not set'}}
                </div>
            </div>
        </div>
    </td>
    <td class="px-8 py-12 border-b border-gray-200 text-sm flex flex-wrap
                                            h-full justify-center">
        <a href="{{ route('coach.edit', $coach->id) }}"
           class="text-judo-600 hover:text-judo-400 font-bold " title="Edit coach details"><i
                class="far fa-edit"></i></a>
        <form action="{{ route('coach.destroy', $coach->id) }}"
              method="POST">
            @csrf
            <input type="hidden" name="_method" value="DELETE"/>
            <button type="submit"
                    class="text-red-600 hover:text-red-300 whitespace-no-wrap
                                                             ml-4"
                    onclick="return confirm('Do you want to delete the record completely?')">
                <i class="far fa-trash-alt"></i></button>
        </form>
    </td>
</tr>
