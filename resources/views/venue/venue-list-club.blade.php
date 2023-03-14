<tr>
    <td class="px-5 py-5 border-b border-gray-200 text-sm">
        <div class="flex items-center">
            <div class="">
                <p class="text-gray-900 whitespace-no-wrap font-bold">
                    {{ $venue->name }}
                    <br/>
                    <span class="text-sm text-gray-600 font-medium">
                                                            {{ $venue->address1 }}
                        {{ $venue->address2 }}
                        {{ $venue->city }}
                        {{ ucfirst ($venue->county) }}
                        {{ strtoupper($venue->eircode) }}
                                                        </span>
                </p>
            </div>
        </div>
    </td>
    <td class="px-5 py-5 border-b border-gray-200 text-sm">
        <div class="flex items-center">
            <div>
                <p class="text-gray-900 whitespace-no-wrap font-bold">{{ $venue->contact }}
                    <br><span
                        class="font-bold text-gray-500">t:</span>{{ $venue->phone }}
                </p>
            </div>
        </div>
    </td>
</tr>
