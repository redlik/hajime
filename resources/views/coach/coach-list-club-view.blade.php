<tr>
    <td class="px-5 py-5 border-b border-gray-200 text-sm">
        <div class="flex items-center">
            <div class="">
                <div class="text-gray-900 whitespace-no-wrap font-bold">{{ $coach->name }}</div>
            </div>
        </div>
    </td>
    <td class="px-5 py-5 border-b border-gray-200 text-sm">
        <div class="flex items-center">
            <div>
                <div class="gray-date">{{$coach->safeguarding_completion ?? 'Not set' }}</div>
                @if ( $coach->safeguarding_expiry)
                    @if($coach->safeguarding_expiry < now())
                        <div class="expired-date">{{ $coach->safeguarding_expiry }}</div>
                    @else
                        <div class="valid-date">{{ $coach->safeguarding_expiry }}</div>
                    @endif
                @else
                    <div class="amber-date">
                        Not set
                    </div>
                @endif
            </div>
        </div>
    </td>
    <td class="px-5 py-5 border-b border-gray-200 text-sm">
        <div class="flex items-center">
            <div>
                <div class="gray-date">{{ $coach->vetting_completion ?? 'Not set' }}</div>
                @if ( $coach->vetting_expiry)
                    @if($coach->vetting_expiry < now())
                        <div class="expired-date">{{ $coach->vetting_expiry
                                                                }}</div>
                    @else
                        <div class="valid-date">{{ $coach->vetting_expiry }}</div>
                    @endif
                @else
                    <div class="amber-date">
                        Not set
                    </div>
                @endif
            </div>
        </div>
    </td>
    <td class="px-5 py-5 border-b border-gray-200 text-sm">
        <div class="flex items-center">
            <div>
                <div class="gray-date">{{ $coach->first_aid_completion ?? 'Not set'}}</div>
                @if ( $coach->first_aid_expiry)
                    @if($coach->first_aid_expiry < now())
                        <div
                            class="expired-date">{{ $coach->first_aid_expiry }}</div>
                    @else
                        <div class="valid-date">{{ $coach->first_aid_expiry }}</div>
                    @endif
                @else
                    <div class="amber-date">
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
                    {{ $coach->coaching_qualification ?? 'Not set'}}
                </div>
                <div class="amber-date">
                    {{ $coach->coaching_date ?? 'Not set'}}
                </div>
            </div>
        </div>
    </td>
</tr>
