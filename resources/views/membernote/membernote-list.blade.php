<tr>
    <td class="px-5 py-5 border-b border-gray-200 text-sm">
        <div class="flex items-center">
            <div class="ml-3">
                <p class="text-gray-900 whitespace-no-wrap font-bold">
                    <a href="{{ route('membernote.show', $note->slug) }}"
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

    <td class="px-5 py-5 border-b border-gray-200 text-sm justify-center flex
                                        flex-wrap">
        <a href="{{ route('membernote.show', $note->slug) }}"
           class="text-blue-600 font-bold hover:text-blue-300 mr-2"
           title="View full note"><i class="far fa-eye"></i></a>
        <a href="{{ route('membernote.edit', $note) }}"
           class="text-green-600 font-bold mx-2" title="Edit note"><i
                class="far fa-edit"></i></a>
        <form action="{{ route('membernote.destroy' , $note)}}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="DELETE"/>
            <button type="submit"
                    class="text-red-600 hover:text-red-300 whitespace-no-wrap ml-2"
                    onclick="return confirm('Do you want to delete the record completely?')">
                <i class="far fa-trash-alt"></i></button>
        </form>
    </td>
</tr>
