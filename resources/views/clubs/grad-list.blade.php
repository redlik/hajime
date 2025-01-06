<tr>
    <td class="px-5 py-5 border-b border-gray-200 text-sm">
        <div class="flex items-center">
            <div class="ml-3">
                <p class="text-gray-900 whitespace-no-wrap font-bold">
                    <a href="{{ asset('/storage/grad-forms/'.$grad->link) }}"
                       target="_blank">
                        {{ $grad->title }}
                    </a>
                </p>
            </div>
        </div>
    </td>
    <td class="px-5 py-5 border-b border-gray-200 text-sm">
        <a href="{{ asset('/storage/grad-forms/'.$grad->link) }}"
           target="_blank">
            <i class="fas fa-file text-2xl text-gray-500 mr-3"></i><span
                class="text-gray-500">{{ $grad->link }}</span>
        </a>
    </td>
    <td class="px-5 py-5 border-b border-gray-200 text-sm">
        @if ($grad->user_id)
            {{ $grad->author->name }}
        @endif
    </td>
    <td class="px-5 py-5 border-b border-gray-200 text-sm">
        {{ $grad->created_at->format('d-m-Y') }}
    </td>
    <td class="px-5 py-6 border-b border-gray-200 text-sm flex flex-wrap">
        <form action="{{ route('gradform.destroy', $grad->id) }}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="DELETE"/>
            <button type="submit"
                    class="text-red-600 hover:text-red-300 whitespace-no-wrap ml-3"
                    onclick="return confirm('Do you want to delete the record completely?')">
                <i class="far fa-trash-alt"></i></button>
        </form>
    </td>
</tr>
