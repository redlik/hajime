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
        <div class="md:flex items-center">
                <div class="gray-date mr-1">{{ $volunteer->vetting_completion ?? 'Not set' }}</div>
                <div>-</div>
                @if ( $volunteer->vetting_expiry)
                    @if($volunteer->vetting_expiry < now())
                        <div
                            class="expired-date ml-1">{{ $volunteer->vetting_expiry }}</div>
                    @else
                        <div
                            class="valid-date ml-1">{{ $volunteer->vetting_expiry }}</div>
                    @endif
                @else
                    <div
                        class="gray-date">Not set</div>
                @endif
        </div>
    </td>
    <td class="px-5 py-5 border-b border-gray-200 text-sm">
        <div class="md:flex items-center">
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
</tr>
