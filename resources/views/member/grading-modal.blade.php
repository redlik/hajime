<div x-show="gradingModal">
    <div @keydown.window.escape="gradingModal = false" x-show="gradingModal"
         class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" x-ref="dialog"
         aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>

            <div x-show="gradingModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 x-description="Background backdrop, show/hide based on modal state."
                 class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

            <div x-show="gradingModal" x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-description="Modal panel, show/hide based on modal state."
                 class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-bold text-gray-900" id="modal-title">
                                Edit grading record
                            </h3>
                            <div class="mt-2">
                                @if($grade)
                                    <form wire:submit="updateGrade" id="updateGrade">
                                        <input type="hidden" x-bind:value="grade_id">
                                        <div>
                                            <label for="grade_level" class="block text-sm text-gray-400 mb-2 font-bold">Grade
                                                level</label>
                                            <select name="grade_level" id="grade_level"
                                                    class="shadow border-gray-300 rounded w-48 py-2 px-3 text-grey-darker mr-2"
                                                    wire:model="grade_level">
                                                <option value="" disabled>Select grade level</option>
                                                <optgroup label="Junior Grades">
                                                    <option
                                                        value="1st Mon White" @selected('1st Mon White' == $grade->grade_level)>
                                                        1st Mon White
                                                    </option>
                                                    <option
                                                        value="2nd Mon Red" @selected('2nd Mon Red' == $grade->grade_level)>
                                                        2nd Mon Red
                                                    </option>
                                                    <option
                                                        value="3rd Mon White/Yellow" @selected('3rd Mon White/Yellow' == $grade->grade_level)>
                                                        3rd Mon White/Yellow
                                                    </option>
                                                    <option
                                                        value="4th Mon Yellow" @selected('4th Mon Yellow' == $grade->grade_level)>
                                                        4th Mon Yellow
                                                    </option>
                                                    <option
                                                        value="5th Mon Yellow/Orange" @selected('5th Mon Yellow/Orange' == $grade->grade_level)>
                                                        5th Mon Yellow/Orange
                                                    </option>
                                                    <option
                                                        value="6th Mon Orange" @selected('6th Mon Orange' == $grade->grade_level)>
                                                        6th Mon Orange
                                                    </option>
                                                    <option
                                                        value="7th Mon Orange/Green" @selected('7th Mon Orange/Green' == $grade->grade_level)>
                                                        7th Mon Orange/Green
                                                    </option>
                                                    <option
                                                        value="8th Mon Green" @selected('8th Mon Green' == $grade->grade_level)>
                                                        8th Mon Green
                                                    </option>
                                                    <option
                                                        value="9th Mon Green/Blue" @selected('9th Mon Green/Blue' == $grade->grade_level)>
                                                        9th Mon Green/Blue
                                                    </option>
                                                    <option
                                                        value="10th Mon Blue" @selected('10th Mon Blue' == $grade->grade_level)>
                                                        10th Mon Blue
                                                    </option>
                                                    <option
                                                        value="11th Mon Blue/Brown" @selected('11th Mon Blue/Brown' == $grade->grade_level)>
                                                        11th Mon Blue/Brown
                                                    </option>
                                                    <option
                                                        value="12th Mon Brown" @selected('12th Mon Brown' == $grade->grade_level)>
                                                        12th Mon Brown
                                                    </option>
                                                </optgroup>
                                                <optgroup label="Senior Grades">
                                                    <option
                                                        value="6th Kyu White" @selected('6th Kyu White' == $grade->grade_level)>
                                                        6th Kyu White
                                                    </option>
                                                    <option
                                                        value="5th Kyu Yellow" @selected('5th Kyu Yellow' == $grade->grade_level)>
                                                        5th Kyu Yellow
                                                    </option>
                                                    <option
                                                        value="4th Kyu Orange" @selected('4th Kyu Orange' == $grade->grade_level)>
                                                        4th Kyu Orange
                                                    </option>
                                                    <option
                                                        value="3rd Kyu Green" @selected('3rd Kyu Green' == $grade->grade_level)>
                                                        3rd Kyu Green
                                                    </option>
                                                    <option
                                                        value="2nd Kyu Blue" @selected('2nd Kyu Blue' == $grade->grade_level)>
                                                        2nd Kyu Blue
                                                    </option>
                                                    <option
                                                        value="1st Kyu Brown" @selected('1st Kyu Brown' == $grade->grade_level)>
                                                        1st Kyu Brown
                                                    </option>
                                                </optgroup>
                                                <optgroup label="Dan Grades">
                                                    <option
                                                        value="1st Dan" @selected('1st Dan' == $grade->grade_level)>
                                                        1st Dan
                                                    </option>
                                                    <option
                                                        value="2nd Dan" @selected('2nd Dan' == $grade->grade_level)>
                                                        2nd Dan
                                                    </option>
                                                    <option
                                                        value="3rd Dan" @selected('3rd Dan' == $grade->grade_level)>
                                                        3rd Dan
                                                    </option>
                                                    <option
                                                        value="4th Dan" @selected('4th Dan' == $grade->grade_level)>
                                                        4th Dan
                                                    </option>
                                                    <option
                                                        value="5th Dan" @selected('5th Dan' == $grade->grade_level)>
                                                        5th Dan
                                                    </option>
                                                    <option
                                                        value="6th Dan" @selected('6th Dan' == $grade->grade_level)>
                                                        6th Dan
                                                    </option>
                                                    <option
                                                        value="7th Dan" @selected('7th Dan' == $grade->grade_level)>
                                                        7th Dan
                                                    </option>
                                                    <option
                                                        value="8th Dan" @selected('8th Dan' == $grade->grade_level)>
                                                        8th Dan
                                                    </option>
                                                </optgroup>
                                                <optgroup label="Shamrock Grades">
                                                    <option value="1st Shamrock" @selected('1st Shamrock' == $grade->grade_level)>1st Shamrock</option>
                                                    <option value="2nd Shamrock" @selected('2nd Shamrock' == $grade->grade_level)>2nd Shamrock</option>
                                                    <option value="3rd Shamrock" @selected('3rd Shamrock' == $grade->grade_level)>3rd Shamrock</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                        <div class="mt-4">
                                            <label for="type" class="block text-sm text-gray-400 mb-2 font-bold">Date
                                                attained</label>
                                            <input type="date" name="grade_date" id="grade_date"
                                                   class="shadow border-gray-300 rounded w-48 py-2 px-3 text-grey-darker mr-2" wire:model="grade_date">
                                        </div>
                                        <div class="mt-4">
                                            <label for="type" class="block text-sm text-gray-400 mb-2 font-bold">Points
                                                / Wins</label>
                                            <input type="text" name="grade_points" id="grade_points"
                                                   class="shadow border-gray-300 rounded w-64 py-2 px-3 text-grey-darker mr-2"
                                                   placeholder="Points / Wins" wire:model="grade_points">
                                        </div>
                                        <div class="mt-4">
                                            <label for="type" class="block text-sm text-gray-400 mb-2 font-bold">Competition</label>
                                            <input type="text" name="competition" id="competition"
                                                   class="shadow border-gray-300 rounded w-64 py-2 px-3 text-grey-darker mr-2"
                                                   wire:model="competition">
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse" @click.stop>
                    <button type="submit" form="updateGrade"
                            class="button-judo ml-4"
                            @click="gradingModal = false">
                        Update
                    </button>
                    <button type="button"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                            @click="gradingModal = false">
                        Dismiss
                    </button>

                </div>
            </div>

        </div>
    </div>
</div>
