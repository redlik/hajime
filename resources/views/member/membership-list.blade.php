<tr>
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
            {{ $membership->expiry_date }}
        </p>
    </td>
    <td class="px-5 py-4 border-b border-gray-200 text-sm text-center">
        <form action="{{ route('membership.destroy' , $membership)}}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="DELETE"/>
            <button type="submit"
                    class="text-red-600 hover:text-red-300 whitespace-no-wrap"
                    onclick="return confirm('Do you want to delete the record completely?')">
                <i class="far fa-trash-alt"></i></button>
        </form>
    </td>
</tr>
