<tr>
    <td class="px-5 py-4 border-b border-gray-200 text-sm">
        <p class="text-gray-900 whitespace-no-wrap">
            {{ $membership->member->number }}
        </p>
    </td>
    <td class="px-5 py-4 border-b border-gray-200 text-sm">
        <p class="text-gray-900 whitespace-no-wrap">
            {{ $membership->member->first_name }} {{ $membership->member->last_name }}
        </p>
    </td>
    <td class="px-5 py-4 border-b border-gray-200 text-sm">
        <p class="text-gray-900 whitespace-no-wrap">
            {{ $membership->member->gender }}
        </p>
    </td>
    <td class="px-5 py-4 border-b border-gray-200 text-sm">
        <p class="text-gray-900 whitespace-no-wrap">
            {{ $membership->membership_type }}
        </p>
    </td>
    <td class="px-5 py-4 border-b border-gray-200 text-sm">
        <p class="text-gray-900 whitespace-no-wrap">
            {{ $membership->join_date }}
        </p>
    </td>
    <td class="px-5 py-4 border-b border-gray-200 text-sm">
        <p class="text-gray-900 whitespace-no-wrap">
            {{ $membership->member->source }}
        </p>
    </td>
    <td class="px-5 py-4 border-b border-gray-200 text-sm">
        <p class="text-gray-900 whitespace-no-wrap">
            {{ $membership->member->club->name }}
        </p>
    </td>
    <td class="px-5 py-4 border-b border-gray-200 text-sm">
        <p class="text-gray-900 whitespace-no-wrap">
            {{ ucfirst($membership->member->club->province) }}
        </p>
    </td>

</tr>
