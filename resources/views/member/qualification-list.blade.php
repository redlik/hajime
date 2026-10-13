<tr class="odd:bg-white even:bg-gray-200">
    <td class="px-5 py-4 border-b border-gray-200 text-sm">
        <p class="text-gray-900 whitespace-no-wrap">
            {{ $qualification->level }}
        </p>
    </td>
    <td class="px-5 py-4 border-b border-gray-200 text-sm">
        <p class="text-gray-900 whitespace-no-wrap">
            {{ $qualification->date_attained }}
        </p>
    </td>
    <td class="px-5 py-4 border-b border-gray-200 text-sm">
        <p class="text-gray-900 whitespace-no-wrap">
            {{ $qualification->notes }}
        </p>
    </td>
    <td class="px-5 py-4 border-b border-gray-200 text-sm justify-center flex items-center gap-4">
        <button class="text-judo-600 hover:text-judo-300 whitespace-no-wrap"
                wire:click="editModal({{ $qualification->id }})"
                title="Edit qualification entry">
            <i class="fas fa-edit"></i>
        </button>
        <form action="{{ route('qualification.destroy', $qualification) }}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="DELETE"/>
            <button type="submit"
                    class="text-red-600 hover:text-red-300 whitespace-no-wrap"
                    onclick="return confirm('Do you want to delete the record completely?')">
                <i class="far fa-trash-alt"></i></button>
        </form>
    </td>
</tr>
