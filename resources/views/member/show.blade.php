@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-10">
    <div class="w-full sm:px-6">

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header
                class="font-bold text-xl bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md flex justify-between align-middle">
                <div>
                    {{ $member->first_name }} {{ $member->last_name }} 
                <span class="text-sm text-gray-500">{{ $member->active }}</span>
                    <a href="{{ route('member.edit', $member) }}" class="text-green-600 font-bold ml-3"
                        title="Edit club details"><i class="far fa-edit"></i></a>
                </div>
                <div class="font-bold text-sm"> Club: {{ $member->club->name }} </div>
            </header>

            <div class="w-full p-6">
                <a href="{{ route('clubs.show', $member->club) }}"
                    class="text-blue-500 font-bold hover:text-blue-300 mb-4" title="View club page">
                    << Back to club view</a> <div
                        class="w-full border border-gray-300 flex flex-wrap rounded-xl my-4 p-4">
                        <div class="w-full md:w-1/2">
                            <h4 class="font-bold text-xl text-gray-500 mb-4">Personal details:</h4>
                            <div class="mb-8">
                                <div class="w-full md:w-1/2 mb-4">
                                    <div class="w-full flex flex-wrap mb-4">
                                        <div class="w-36 font-bold">Date of birth:</div>
                                        <div class="w-auto">{{ $member->dob }}
                                        </div>
                                    </div>
                                    <div class="w-full flex flex-wrap mb-4">
                                        <div class="w-36 font-bold">Current age:</div>
                                        <div class="w-auto">{{ $member->age }}
                                        </div>
                                    </div>
                                    <div class="w-full flex flex-wrap mb-4">
                                        <div class="w-36 font-bold">Gender:</div>
                                        <div class="w-auto">{{ $member->gender }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2">
                            <h4 class="font-bold text-xl text-gray-500 mb-4">Contact details:</h4>
                            <div class="flex flex-wrap">
                                <div class="w-full flex flex-wrap">
                                    <div class="w-full flex flex-wrap mb-4">
                                        <div class="w-36 font-bold">Phone:</div>
                                        <div class="w-auto">{{ $member->phone }}
                                        </div>
                                    </div>
                                    <div class="w-full flex flex-wrap mb-4">
                                        <div class="w-36 font-bold">Mobile:</div>
                                        <div class="w-auto">{{ $member->mobile }}
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full flex flex-wrap mb-4">
                                    <div class="w-36 font-bold">Email:</div>
                                    <div class="w-auto">{{ $member->email }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full mb-2">
                            <h4 class="font-bold text-xl text-gray-500 mb-4 ">Address:</h4>
                            <div class="w-full md:w-1/2 flex flex-wrap">
                                {{ $member->address1}}, @if ($member->address2)
                                , {{ $member->address2}}
                                @endif
                                {{ $member->city}}, {{ $member->county}}, {{ $member->province}}
                            </div>
                        </div>
            </div>
            {{-- GRADING SECTION --}}
            <div class="w-full border border-gray-300 rounded-xl my-4 p-4">
                <h4 class="font-bold text-xl text-gray-500 mb-4">Grading details:</h4>
                <form method="POST" action="{{ action('App\Http\Controllers\GradeController@store') }}" role="form">
                    @csrf
                    <input type="hidden" name="member_id" value="{{ $member->id }}">
                    <div class="flex flex-wrap justify-between">
                        <div class="flex flex-wrap">
                            <div>
                                <label for="grade_level" class="block text-sm text-gray-400 mb-2 font-bold">Grade
                                    level</label>
                                <input type="text" name="grade_level" id="grade_level"
                                    class="shadow appearance-none border rounded w-64 py-2 px-3 text-grey-darker mr-2"
                                    placeholder="Grade">
                            </div>
                            <div>
                                <label for="type" class="block text-sm text-gray-400 mb-2 font-bold">Date
                                    attained</label>
                                <input type="date" name="grade_date" id="grade_date"
                                    class="shadow appearance-none border rounded w-48 py-2 px-3 text-grey-darker mr-2">
                            </div>
                            <div>
                                <label for="type" class="block text-sm text-gray-400 mb-2 font-bold">Points to next
                                    grade</label>
                                <input type="text" name="grade_points" id="grade_points"
                                    class="shadow appearance-none border rounded w-64 py-2 px-3 text-grey-darker mr-2"
                                    placeholder="Points to next grade">
                            </div>

                        </div>
                        <div>
                            <input type="submit" value="Submit" class="button-judo">

                        </div>
                    </div>
                </form>

                <div class="w-full">
                    <table class="min-w-full table leading-normal mt-8">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Grade level
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Grade date
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Points to next
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-red-500 uppercase tracking-wider">
                                    Remove
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($grades as $grade)
                            <tr class="odd:bg-white even:bg-gray-200">
                                <td class="px-5 py-2 border-b border-gray-200 text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $grade->grade_level}}
                                    </p>
                                </td>
                                <td class="px-5 py-2 border-b border-gray-200 text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $grade->grade_date}}
                                    </p>
                                </td>
                                <td class="px-5 py-2 border-b border-gray-200 text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $grade->grade_points}}
                                    </p>
                                </td>
                                <td class="px-5 py-2 border-b border-gray-200 text-sm">
                                    <form action="{{ route('grade.destroy' , $grade)}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <input type="hidden" name="member_id" value="{{$member->id }}" />
                                        <button type="submit" class="text-red-600 hover:text-red-300 whitespace-no-wrap" onclick="return confirm('Do you want to delete the record completely?')"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- MEMBERSHIP SECTION --}}
            <div class="w-full border border-gray-300 rounded-xl my-4 p-4">
                <h4 class="font-bold text-xl text-gray-500 mb-4">Membership details:</h4>
                <form method="POST" action="{{ action('App\Http\Controllers\MembershipController@store') }}"
                    role="form">
                    @csrf
                    <input type="hidden" name="member_id" value="{{ $member->id }}">
                    <div class="flex flex-wrap justify-between">
                        <div class="flex flex-wrap">
                            <div>
                                <label for="membership_type"
                                    class="block text-sm text-gray-400 mb-2 font-bold">Membership type</label>
                                <input type="text" name="membership_type" id="membership_type"
                                    class="shadow appearance-none border rounded w-64 py-2 px-3 text-grey-darker mr-2"
                                    placeholder="Membership type">
                            </div>
                            <div>
                                <label for="join_date" class="block text-sm text-gray-400 mb-2 font-bold">Joining
                                    date</label>
                                <input type="date" name="join_date" id="join_date"
                                    class="shadow appearance-none border rounded w-48 py-2 px-3 text-grey-darker mr-2">
                            </div>
                            <div>
                                <label for="expiry_date" class="block text-sm text-gray-400 mb-2 font-bold">Expiry
                                    date</label>
                                <input type="date" name="expiry_date" id="expiry_date"
                                    class="shadow appearance-none border rounded w-48 py-2 px-3 text-grey-darker mr-2">
                            </div>
                        </div>
                        <div>
                            <input type="submit" value="Submit" class="button-judo">
                        </div>
                    </div>
                </form>
                <div class="w-full">
                    <table class="min-w-full table leading-normal mt-8">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Membership type
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Join date
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Expiry date
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-red-500 uppercase tracking-wider">
                                    Remove
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($memberships as $membership)
                            <tr>
                                <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $membership->membership_type }}
                                    </p>
                                </td>
                                <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $membership->join_date }}
                                    </p>
                                </td>
                                <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $membership->expiry_date }}
                                    </p>
                                </td>
                                <td class="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                    <form action="{{ route('membership.destroy' , $membership)}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <input type="hidden" name="member_id" value="{{$member->id }}" />
                                        <button type="submit" class="text-red-600 hover:text-red-300 whitespace-no-wrap" onclick="return confirm('Do you want to delete the record completely?')"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </div>



    </section>
    </div>
</main>
@endsection
