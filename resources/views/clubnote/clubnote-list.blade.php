<tr>
    <td class="px-5 py-5 border-b border-gray-200 text-sm">
        <div class="flex items-center">
            <div class="">
                <p class="text-gray-900 whitespace-no-wrap font-bold">
                    <a href="{{ route('clubnote.show', $note->slug) }}"
                       class="hover:text-cool-gray-400"
                       title="View full note">{{ $note->title }}</a>
                </p>
            </div>
        </div>
    </td>
    <td class="px-5 py-5 border-b border-gray-200 text-sm">
        @if ($note->author)
            {{ $note->hasAuthor->name }}
        @endif
    </td>
    <td class="px-5 py-5 border-b border-gray-200 text-sm">
        {{ $note->created_at->format('d-m-Y') }}
    </td>
    <td class="px-5 py-5 border-b border-gray-200 text-sm flex
                                            flex-wrap justify-center">
        <div><a href="{{ route('clubnote.show', $note->slug) }}"
                class="text-blue-600 font-bold hover:text-blue-300"
                title="View full note"><i class="far fa-eye"></i></a></div>
        <div><a href="{{ route('clubnote.edit', $note) }}"
                class="text-green-600 font-bold ml-3" title="Edit note"><i
                    class="far fa-edit"></i></a></div>
        <div>
            <form action="{{ route('clubnote.destroy' , $note)}}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="DELETE"/>
                <button type="submit"
                        class="text-red-600 hover:text-red-300 whitespace-no-wrap ml-3"
                        onclick="return confirm('Do you want to delete the record completely?')">
                    <i class="far fa-trash-alt"></i></button>
            </form>
        </div>
    </td>
</tr>
