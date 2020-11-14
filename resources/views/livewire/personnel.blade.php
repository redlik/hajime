<div x-data="{showModal: false}" @keydown.escape="showModal = false" x-cloak>

    <div class="w-full">
        <div class="w-36 inline-block font-bold mb-2 text-gray-500 p-2">Head Coach:</div>
        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">
            {{ $headCoach->name ?? 'Not set' }}</div>
        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Email:</div>
        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">
            {{ $headCoach->email ?? 'Not set' }}</div>
        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Phone:</div>
        <div class="w-48 bg-gray-100 p-2 rounded inline-block font-semibold">
            {{ $headCoach->phone ?? 'Not set' }}</div>
        @if ($headCoach)
            <div class="w-auto inline-block font-bold mb-2 p-2 text-right">
                <button type="button" title="View details" @click="showModal=true"><i
                        class="far fa-eye text-green-500 mr-2"></i></button>
                <a href="" title="Edit"><i class="far fa-edit text-blue-500 mr-2"></i></a>
                <a href="{{ route('personnel.delete', [$headCoach->id]) }}"
                   title="Delete person record"
                   onclick="return confirm('Do you want to delete the record completely?')"><i
                        class="far fa-trash-alt text-red-600"></i></a>
            </div>
        @else
            <div class="w-auto inline-block font-bold mb-2 p-2 text-right judo-green">
                <a href="{{ route('club.addPersonnel', $club->id ) }}">
                    <i class="fas fa-user-plus"></i> Add new
                </a>
            </div>
        @endif
    </div>
    <div class="w-full mt-2">
        <div class="w-36 inline-block font-bold mb-2 text-gray-500 p-2">Secretary:</div>
        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">
            {{ $secretary->name ?? 'Not set' }}</div>
        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Email:</div>
        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">
            {{ $secretary->email ?? 'Not set' }}</div>
        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Phone:</div>
        <div class="w-48 bg-gray-100 p-2 rounded inline-block font-semibold">
            {{ $secretary->phone ?? 'Not set' }}</div>
        @if ($secretary)
            <div class="w-auto inline-block font-bold mb-2 p-2 text-right">
                <a href="" title="View details"><i class="far fa-eye text-green-500 mr-2"></i></a>
                <a href="" title="Edit"><i class="far fa-edit text-blue-500 mr-2"></i></a>
                <a href="{{ route('personnel.delete', [$secretary->id]) }}"
                   title="Delete person record"
                   onclick="return confirm('Do you want to delete the record completely?')"><i
                        class="far fa-trash-alt text-red-600"></i></a>
            </div>
        @else
            <div class="w-auto inline-block font-bold mb-2 p-2 text-right judo-green">
                <a href="{{ route('club.addPersonnel', $club->id ) }}">
                    <i class="fas fa-user-plus"></i> Add new
                </a>
            </div>
        @endif
    </div>
    <div class="w-full mt-2">
        <div class="w-36 inline-block font-bold mb-2 text-gray-500 p-2">Designated Off:</div>
        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">
            {{ $designatedOfficer->name ?? 'Not set' }}</div>
        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Email:</div>
        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">
            {{ $designatedOfficer->email ?? 'Not set' }}</div>
        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Phone:</div>
        <div class="w-48 bg-gray-100 p-2 rounded inline-block font-semibold">
            {{ $designatedOfficer->phone ?? 'Not set' }}</div>
        @if ($designatedOfficer)
            <div class="w-auto inline-block font-bold mb-2 p-2 text-right">
                <a href="" title="View details"><i class="far fa-eye text-green-500 mr-2"></i></a>
                <a href="" title="Edit"><i class="far fa-edit text-blue-500 mr-2"></i></a>
                <a href="{{ route('personnel.delete', [$designatedOfficer->id]) }}"
                   title="Delete person record"
                   onclick="return confirm('Do you want to delete the record completely?')"><i
                        class="far fa-trash-alt text-red-600"></i></a>
            </div>
        @else
            <div class="w-auto inline-block font-bold mb-2 p-2 text-right judo-green">
                <a href="{{ route('club.addPersonnel', $club->id ) }}">
                    <i class="fas fa-user-plus"></i> Add new
                </a>
            </div>
        @endif
    </div>
    <div class="w-full mt-2">
        <div class="w-36 inline-block font-bold mb-2 text-gray-500 p-2">Childrens Off:</div>
        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">
            {{ $childrensOfficer->name ?? 'Not set' }}</div>
        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Email:</div>
        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">
            {{ $childrensOfficer->email ?? 'Not set' }}</div>
        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Phone:</div>
        <div class="w-48 bg-gray-100 p-2 rounded inline-block font-semibold">
            {{ $childrensOfficer->phone ?? 'Not set' }}</div>
        @if ($childrensOfficer)
            <div class="w-auto inline-block font-bold mb-2 p-2 text-right">
                <a href="" title="View details"><i class="far fa-eye text-green-500 mr-2"></i></a>
                <a href="" title="Edit"><i class="far fa-edit text-blue-500 mr-2"></i></a>
                <a href="{{ route('personnel.delete', [$childrensOfficer->id]) }}"
                   title="Delete person record"
                   onclick="return confirm('Do you want to delete the record completely?')"><i
                        class="far fa-trash-alt text-red-600"></i></a>
            </div>
        @else
            <div class="w-auto inline-block font-bold mb-2 p-2 text-right judo-green">
                <a href="{{ route('club.addPersonnel', $club->id ) }}">
                    <i class="fas fa-user-plus"></i> Add new
                </a>
            </div>
        @endif
    </div>
    <div class="w-full mt-2">
        <div class="w-36 inline-block font-bold mb-2 text-gray-500 p-2">Coach:</div>
        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">
            {{ $coach->name ?? 'Not set' }}</div>
        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Email:</div>
        <div class="w-56 bg-gray-100 p-2 rounded inline-block font-semibold">
            {{ $coach->email ?? 'Not set' }}</div>
        <div class="w-24 inline-block font-bold mb-2 text-gray-500 p-2 text-right">Phone:</div>
        <div class="w-48 bg-gray-100 p-2 rounded inline-block font-semibold">
            {{ $coach->phone ?? 'Not set' }}</div>
        @if ($coach)
            <div class="w-auto inline-block font-bold mb-2 p-2 text-right">
                <a href="" title="View details"><i class="far fa-eye text-green-500 mr-2"></i></a>
                <a href="" title="Edit"><i class="far fa-edit text-blue-500 mr-2"></i></a>
                <a href="{{ route('personnel.delete', [$coach->id]) }}"
                   title="Delete person record"
                   onclick="return confirm('Do you want to delete the record completely?')"><i
                        class="far fa-trash-alt text-red-600"></i></a>
            </div>
        @else
            <div class="w-auto inline-block font-bold mb-2 p-2 text-right judo-green">
                <a href="{{ route('club.addPersonnel', $club->id ) }}">
                    <i class="fas fa-user-plus"></i> Add new
                </a>
            </div>
        @endif
    </div>
    <div class="w-full mt-4">
        <h4 class="font-bold text-xl text-black mb-4">Volunteers:</h4>
    </div>
    {{-- Modal starts here --}}
    <div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="showModal"
         :class="{ 'absolute inset-0 z-10 flex items-center justify-center': showModal }">
        <!--Dialog-->
        <div class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg py-4 text-left px-6"
             x-show="showModal" @click.away="showModal = false" @keydown.escape="showModal = false"
             x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
             x-transition:enter-end="opacity-100">

            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold" x-text="name"></p>
                <div class="cursor-pointer z-50" @click="showModal = false">
                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18"
                         height="18" viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                        </path>
                    </svg>
                </div>
            </div>

            <!-- content -->
            <div class="inline-block w-36">Phone:</div>
            <p class="inline-block w-auto font-bold" ></p>

            <!--Footer-->
            <div class="flex justify-end pt-2">
                <button
                    class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400"
                    @click="showModal = false">Close</button>
            </div>


        </div>
        <!--/Dialog -->
    </div><!-- /Overlay -->

    <!--Overlay-->

</div>
