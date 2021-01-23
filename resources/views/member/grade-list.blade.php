<tr class="odd:bg-white even:bg-gray-200">
    <td class="px-5 py-4 border-b border-gray-200 text-sm">
        <p class="text-gray-900 whitespace-no-wrap">
            {{ $grade->grade_level}}
        </p>
    </td>
    <td class="px-5 py-4 border-b border-gray-200 text-sm">
        <p class="text-gray-900 whitespace-no-wrap">
            {{ $grade->grade_date}}
        </p>
    </td>
    <td class="px-5 py-4 border-b border-gray-200 text-sm">
        <p class="text-gray-900 whitespace-no-wrap">
            {{ $grade->grade_points}}
        </p>
    </td>
    <td class="px-5 py-4 border-b border-gray-200 text-sm text-center">
        <form action="{{ route('grade.destroy' , $grade)}}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="DELETE"/>
            <button type="submit"
                    class="text-red-600 hover:text-red-300 whitespace-no-wrap"
                    onclick="return confirm('Do you want to delete the record completely?')">
                <i class="far fa-trash-alt"></i></button>
        </form>
    </td>
</tr>
