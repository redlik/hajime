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
    <td class="px-8 py-8 border-b border-gray-200 text-sm flex flex-wrap h-full">
        <a href="{{ route('venue.edit', $venue->id) }}"
           class="text-green-600 font-bold ml-3" title="Edit venue"><i
                class="far fa-edit"></i></a>
        <form action="{{ route('venue.destroy', $venue->id) }}"
              method="POST">
            @csrf
            <input type="hidden" name="_method" value="DELETE"/>
            <button type="submit"
                    class="text-red-600 hover:text-red-300 whitespace-no-wrap ml-3"
                    onclick="return confirm('Do you want to delete the venue ' +
                                                         'completely?')">
                <i class="far fa-trash-alt"></i></button>
        </form>
    </td>
</tr>
