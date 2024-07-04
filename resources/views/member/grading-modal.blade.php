<div x-show="gradingModal">
    <div @keydown.window.escape="gradingModal = false" x-show="gradingModal"
         class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" x-ref="dialog"
         aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>

            <div x-show="gradingModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-description="Background backdrop, show/hide based on modal state." class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

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
                                <span>
                                    @if($grade)
                                        {{ $grade->id }}
                                    @endif
                                </span>
                            </h3>
                            <div class="mt-2">
                                @if($grade)
                                <form action="" class="">
                                    <input type="hidden" x-bind:value="grade_id">
                                    <div>
                                        <label for="grade_level" class="block text-sm text-gray-400 mb-2 font-bold">Grade
                                            level</label>
                                        <select name="grade_level" id="grade_level"
                                                class="shadow border-gray-300 rounded w-48 py-2 px-3 text-grey-darker mr-2">>
                                            <option value="" disabled>Select grade level</option>
                                            <optgroup label="Junior Grades">
                                                <option value="1st Mon White" @selected('grade_level' == $grade->grade_level)>1st Mon White</option>
                                                <option value="2nd Mon Red">2nd Mon Red</option>
                                                <option value="3rd Mon White/Yellow">3rd Mon White/Yellow</option>
                                                <option value="4th Mon Yellow">4th Mon Yellow</option>
                                                <option value="5th Mon Yellow/Orange">5th Mon Yellow/Orange</option>
                                                <option value="6th Mon Orange">6th Mon Orange</option>
                                                <option value="7th Mon Orange/Green">7th Mon Orange/Green</option>
                                                <option value="8th Mon Green">8th Mon Green</option>
                                                <option value="9th Mon Green/Blue">9th Mon Green/Blue</option>
                                                <option value="10th Mon Blue">10th Mon Blue</option>
                                                <option value="11th Mon Blue/Brown">11th Mon Blue/Brown</option>
                                                <option value="12th Mon Brown">12th Mon Brown</option>
                                            </optgroup>
                                            <optgroup label="Senior Grades">
                                                <option value="6th Kyu White">6th Kyu White</option>
                                                <option value="5th Kyu Yellow">5th Kyu Yellow</option>
                                                <option value="4th Kyu Orange">4th Kyu Orange</option>
                                                <option value="3rd Kyu Green">3rd Kyu Green</option>
                                                <option value="2nd Kyu Blue">2nd Kyu Blue</option>
                                                <option value="1st Kyu Brown">1st Kyu Brown</option>
                                            </optgroup>
                                            <optgroup label="Dan Grades">
                                                <option value="1st Dan">1st Dan</option>
                                                <option value="2nd Dan">2nd Dan</option>
                                                <option value="3rd Dan">3rd Dan</option>
                                                <option value="4th Dan">4th Dan</option>
                                                <option value="5th Dan">5th Dan</option>
                                                <option value="6th Dan">6th Dan</option>
                                                <option value="7th Dan">7th Dan</option>
                                                <option value="8th Dan">8th Dan</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="type" class="block text-sm text-gray-400 mb-2 font-bold">Date
                                            attained</label>
                                        <input type="date" name="grade_date" id="grade_date"
                                               class="shadow border-gray-300 rounded w-48 py-2 px-3 text-grey-darker mr-2">
                                    </div>
                                    <div>
                                        <label for="type" class="block text-sm text-gray-400 mb-2 font-bold">Points / Wins</label>
                                        <input type="text" name="grade_points" id="grade_points"
                                               class="shadow border-gray-300 rounded w-64 py-2 px-3 text-grey-darker mr-2"
                                               placeholder="Points / Wins">
                                    </div>
                                    <div>
                                        <label for="type" class="block text-sm text-gray-400 mb-2 font-bold">Competition</label>
                                        <input type="text" name="competition" id="competition"
                                               class="shadow border-gray-300 rounded w-64 py-2 px-3 text-grey-darker mr-2">
                                    </div>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse" @click.stop>
                    <button type="button"
                            class="button-judo ml-4"
                            @click="gradingModal = false">
                        Update
                    </button>
                    <button type="submit"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                            @click="gradingModal = false">
                        Dismiss
                    </button>

                </div>
            </div>

        </div>
    </div>
</div>
