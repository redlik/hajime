<tr>
    <td class="px-5 py-5 border-b border-gray-200 text-sm">
        <div class="flex items-center">
            <div class="ml-3">
                <p class="text-gray-900 whitespace-no-wrap font-bold">
                    {{ $document->title }}
                </p>
            </div>
        </div>
    </td>
    <td class="px-5 py-5 border-b border-gray-200 text-sm">
        <a href="{{ asset('/storage/attachments/'.$document->link) }}"
           target="_blank">
            <i class="fas fa-file-pdf text-2xl text-red-700"></i>
        </a>
    </td>
    <td class="px-5 py-5 border-b border-gray-200 text-sm">
        @if ($document->author)
            {{ $document->hasAuthor->name }}
        @endif
    </td>
    <td class="px-5 py-5 border-b border-gray-200 text-sm">
        {{ $document->created_at->format('d-m-Y') }}
    </td>
    <td class="px-5 py-6 border-b border-gray-200 text-sm flex flex-wrap
                                        justify-center">
        <form action="{{ route('memberdoc.destroy', $document->id) }}"
              method="POST">
            @csrf
            <input type="hidden" name="_method" value="DELETE"/>
            <button type="submit"
                    class="text-red-600 hover:text-red-300 whitespace-no-wrap ml-3"
                    onclick="return confirm('Do you want to delete the record completely?')">
                <i class="far fa-trash-alt"></i></button>
        </form>
    </td>
</tr>
