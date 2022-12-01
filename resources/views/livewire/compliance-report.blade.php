<main class="flex-1 relative overflow-y-auto focus:outline-none p-6" tabindex="0"
      x-data="{ report: @entangle('report') }" x-init="$el.focus()">
    <div>
        <form wire:submit.prevent="generateReport({{ $selected }})">
            <div class="flex">
                <div>
                    <select name="selectedClub" id="selectedClub"
                            class="shadow border border-gray-300 rounded w-auto py-2 px-3 text-grey-darker mr-4" wire:model="selected" required>
                        <option value="" disabled selected>Select Club</option>
                        @foreach ($clubs as $club)
                            <option value="{{ $club->id }}">
                                {{ $club->name}}
                            </option>
                        @endforeach
                    </select>
                    @error('selected') <span class="error">{{ $message }}</span> @enderror
                </div>
                <button type="submit"
                        class="button-judo">Generate report
                </button>
            </div>
        </form>
    </div>
    <div class="w-full mt-8">
        <div class="bg-white rounded shadow-sm p-8" x-show="report">
            @if($selectedClub)
                <div class="flex justify-between">
                    <div>
                        <h2 class="font-bold text-3xl mb-8">{{ $selectedClub->name ??  'Club name'}}</h2>
                    </div>
                    <div>
                        <a href="{{route('report.compliance-status.generate-pdf', $selectedClub)}}" class="button-judo"><i class="far fa-file-pdf mr-2"></i> Generate PDF</a>
                    </div>
                </div>
                <div class="flex mb-4">
                    <div class="w-64 font-bold">Name of Secretary</div>
                    <div>
                        <span @class([
		                'text-red-700' => ! $secretary->name ])>
                        {{ $secretary->name ?? 'Not set'}}
                        </span>
                    </div>
                </div>
        <div class="flex mb-8">
            <div class="w-64 font-bold">Name of Head / Lead Coach</div>
            <div>
                        <span @class([
		                'text-red-700' => ! $headCoach->name
])>
                        {{ $headCoach->name ?? 'Not set'}}
                        </span>
            </div>
        </div>
        <div class="mb-8">
            <h4 class="font-bold">Designated person</h4>
            @if($designated)
                <table class="min-w-full mt-4">
                    <thead class="bg-gray-100 rounded-t">
                    <tr>
                        <th scope="col" class="w-1/4 py-2 pl-4 pr-3 text-left text-sm font-semibold text-gray-600 font-bold">Name</th>
                        <th scope="col" class="hidden px-3 py-2 text-left text-sm font-semibold text-gray-600 lg:table-cell">Vetting Expiry Date</th>
                        <th scope="col" class="hidden px-3 py-2 text-left text-sm font-semibold text-gray-600 lg:table-cell">Safeguarding 3 Expiry Date</th>
                        <th scope="col" class="hidden px-3 py-2 text-left text-sm font-semibold text-gray-600 lg:table-cell">First Aid Expiry Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="hidden px-3 py-2 text-gray-700 lg:table-cell font-bold">{{ $designated->name }}</td>
                        <td class="hidden px-3 py-2 text-gray-700 lg:table-cell">
                                    <span class="{{ $designated->vetting_expiry > now() ? 'text-gray-600' : 'text-red-600' }} font-medium">{{ $designated->vetting_expiry ?? 'Outstanding'}}</span>
                        </td>
                        <td class="hidden px-3 py-2 text-gray-700 lg:table-cell">
                                    <span class="{{ $designated->safeguarding_expiry > now() ? 'text-gray-600' : 'text-red-600' }} font-medium">{{ $designated->safeguarding_expiry ?? 'Outstanding'}}</span>
                        </td>
                        <td class="hidden px-3 py-2 text-gray-700 lg:table-cell">
                                    <span>{{ $designated->first_aid_expiry ?? ''}}</span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            @else
                <div class="mt-4 text-gray-600 font-medium">Not set</div>
            @endif
        </div>
        <div class="mb-8">
            <h4 class="font-bold">Childrens Officer</h4>
            @if($childrens)
                <table class="min-w-full mt-4">
                    <thead class="bg-gray-100 rounded-t">
                    <tr>
                        <th scope="col" class="w-1/4 py-2 pl-4 pr-3 text-left text-sm font-semibold text-gray-600 font-bold">Name</th>
                        <th scope="col" class="hidden px-3 py-2 text-left text-sm font-semibold text-gray-600 lg:table-cell">Vetting Expiry Date</th>
                        <th scope="col" class="hidden px-3 py-2 text-left text-sm font-semibold text-gray-600 lg:table-cell">Safeguarding 2 Expiry Date</th>
                        <th scope="col" class="hidden px-3 py-2 text-left text-sm font-semibold text-gray-600 lg:table-cell">First Aid Expiry Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="hidden px-3 py-2 text-gray-700 lg:table-cell font-bold">{{ $childrens->name }}</td>
                        <td class="hidden px-3 py-2 text-gray-700 lg:table-cell">
                                    <span class="{{ $childrens->vetting_expiry > now() ? 'text-gray-600' : 'text-red-600' }} font-medium">{{ $childrens->vetting_expiry ?? 'Outstanding'}}</span>
                        </td>
                        <td class="hidden px-3 py-2 text-gray-700 lg:table-cell">
                                    <span class="{{ $childrens->safeguarding_expiry > now() ? 'text-gray-600' : 'text-red-600' }} font-medium">{{ $childrens->safeguarding_expiry ?? 'Outstanding'}}</span>
                        </td>
                        <td class="hidden px-3 py-2 text-gray-700 lg:table-cell">
                                    <span>{{ $childrens->first_aid_expiry ?? ''}}</span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            @else
                <div class="mt-4 text-gray-600 font-medium">Not set</div>
            @endif
        </div>
        <div class="mb-8">
            @if($secretary)
                <h4 class="font-bold">Secretary</h4>
                <table class="min-w-full mt-4">
                    <thead class="bg-gray-100 rounded-t">
                    <tr>
                        <th scope="col" class="w-1/4 py-2 pl-4 pr-3 text-left text-sm font-semibold text-gray-600 font-bold">Name</th>
                        <th scope="col" class="hidden px-3 py-2 text-left text-sm font-semibold text-gray-600 lg:table-cell">Vetting Expiry Date</th>
                        <th scope="col" class="hidden px-3 py-2 text-left text-sm font-semibold text-gray-600 lg:table-cell">Safeguarding 1 Expiry Date</th>
                        <th scope="col" class="hidden px-3 py-2 text-left text-sm font-semibold text-gray-600 lg:table-cell">First Aid Expiry Date</th>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="hidden px-3 py-2 text-gray-700 lg:table-cell font-bold">{{ $secretary->name }}</td>
                        <td class="hidden px-3 py-2 text-gray-700 lg:table-cell">
                                    <span class="{{ $secretary->vetting_expiry > now() ? 'text-gray-600' : 'text-red-600' }} font-medium">{{ $secretary->vetting_expiry ?? 'Outstanding'}}</span>
                        </td>
                        <td class="hidden px-3 py-2 text-gray-700 lg:table-cell">
                                    <span class="{{ $secretary->safeguarding_expiry > now() ? 'text-gray-600' : 'text-red-600' }} font-medium">{{ $secretary->safeguarding_expiry ?? 'Outstanding'}}</span>
                        </td>
                        <td class="hidden px-3 py-2 text-gray-700 lg:table-cell">
                                    <span>{{ $secretary->first_aid_expiry ?? ''}}</span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            @else
                <div class="mt-4 text-gray-600 font-medium">Not set</div>
            @endif
        </div>
        <div class="mt-8">
            <h3 class="font-bold text-xl text-gray-500">Coaches</h3>
            <table class="min-w-full mt-4">
                <thead class="bg-gray-100 rounded-t">
                <tr>
                    <th scope="col" class="py-2 pl-4 pr-3 text-left text-sm font-semibold text-gray-600 font-bold">Name</th>
                    <th scope="col" class="hidden px-3 py-2 text-left text-sm font-semibold text-gray-600 lg:table-cell">Qualifications</th>
                    <th scope="col" class="hidden px-3 py-2 text-left text-sm font-semibold text-gray-600 lg:table-cell">Vetting Expiry Date</th>
                    <th scope="col" class="hidden px-3 py-2 text-left text-sm font-semibold text-gray-600 lg:table-cell">Safeguarding 1 Expiry Date</th>
                    <th scope="col" class="hidden px-3 py-2 text-left text-sm font-semibold text-gray-600 lg:table-cell">First Aid Expiry Date</th>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($coaches as $coach)
                    <tr>
                        <td class="hidden px-3 py-2 text-gray-700 lg:table-cell font-bold">
                            {{ $loop->iteration }}.
                            {{ $coach->name }}</td>
                        <td class="hidden px-3 py-2 text-gray-700 lg:table-cell">{{ $coach->coaching_qualification }}
                            <br>
                            <span class="text-sm">{{ $coach->coaching_date }}</span></td>
                        <td class="hidden px-3 py-2 text-gray-700 lg:table-cell">
                                    <span class="{{ $coach->vetting_expiry > now() ? 'text-gray-600' : 'text-red-600' }} font-medium">{{ $coach->vetting_expiry ?? 'Outstanding'}}</span>
                        </td>
                        <td class="hidden px-3 py-2 text-gray-700 lg:table-cell">
                                    <span class="{{ $coach->safeguarding_expiry > now() ? 'text-gray-600' : 'text-red-600' }} font-medium">{{ $coach->safeguarding_expiry ?? 'Outstanding'}}</span>
                        </td>
                        <td class="hidden px-3 py-2 text-gray-700 lg:table-cell">
                                    <span class="{{ $coach->first_aid_expiry > now() ? 'text-gray-600' : 'text-red-600' }} font-medium">{{ $coach->first_aid_expiry ?? 'Outstanding'}}</span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>


        </div>
        <div class="mt-8">
            <h3 class="font-bold text-xl text-gray-500">Volunteers</h3>
            <table class="min-w-full mt-4">
                <thead class="bg-gray-100 rounded-t">
                <tr>
                    <th scope="col" class="py-2 pl-4 pr-3 text-left text-sm font-semibold text-gray-600 font-bold">Name</th>
                    <th scope="col" class="hidden px-3 py-2 text-left text-sm font-semibold text-gray-600 lg:table-cell">Vetting Expiry Date</th>
                    <th scope="col" class="hidden px-3 py-2 text-left text-sm font-semibold text-gray-600 lg:table-cell">Safeguarding Expiry Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($volunteers as $volunteer)
                    <tr>
                        <td class="hidden px-3 py-2 text-gray-700 lg:table-cell font-bold">
                            {{ $loop->iteration }}.
                            {{ $volunteer->name }}</td>
                        <td class="hidden px-3 py-2 lg:table-cell">
                                <span class="{{ $volunteer->vetting_expiry > now() ? 'text-gray-600' : 'text-red-600' }} font-medium">
                                    {{ $volunteer->vetting_expiry ?? 'Outstanding'}}
                                </span>

                        </td>
                        <td class="hidden px-3 py-2 text-gray-700 lg:table-cell">
                                <span class="{{ $volunteer->safeguarding_expiry > now() ? 'text-gray-600' : 'text-red-600' }} font-medium">
                                    {{ $volunteer->safeguarding_expiry ?? 'Outstanding'}}
                                </span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-8 flex">
            <div class="w-1/2">
                <h3 class="font-bold text-xl text-gray-500 mb-2">Sport Ireland Ethics – Club Self-Assessment</h3>
                @if($selectedClub->ethics_assessment)
                    <div><strong>Yes</strong> @ {{ $selectedClub->ethics_assessment_date }}</div>
                @else
                    <div class="text-red-700 font-bold">NO</div>
                @endif</div>
            <div class="w-1/2">
                <h3 class="font-bold text-xl text-gray-500 mb-2">Club Compliant</h3>
                @if($selectedClub->compliant)
                    <div><strong>Yes</strong></div>
                @else
                    <div class="text-red-700 font-bold">NO</div>
                @endif
            </div>
        </div>
        <div class="mt-8 flex bg-gray-100 rounded p-2 min-w-full">
            <div class="w-1/3 text-gray-600 mr-12">Report date: {{ date('d M Y') }}</div>
            <div class="w-1/3 text-gray-600">Checked by: {{ Auth::user()->name }}</div>
        </div>
        @endif
    </div>
    <div class="bg-white rounded shadow-sm p-8" x-show="!report">
        <h4 class="text-gray-500 text-lg">Please select a club from the dropdown to generate new report</h4>
    </div>
    </div>
</main>
