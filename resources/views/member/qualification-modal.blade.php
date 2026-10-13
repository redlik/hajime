<div x-show="qualificationModal">
    <div @keydown.window.escape="qualificationModal = false" x-show="qualificationModal"
         class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" x-ref="dialog"
         aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-show="qualificationModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 x-description="Background backdrop, show/hide based on modal state."
                 class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

            <div x-show="qualificationModal" x-transition:enter="ease-out duration-300"
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
                                Edit qualification record
                            </h3>
                            <div class="mt-2">
                                @if($qualification)
                                    <form wire:submit="updateQualification" id="updateQualification">
                                        <div>
                                            <label for="level" class="block text-sm text-gray-400 mb-2 font-bold">Qualification level</label>
                                            <select name="level" id="level"
                                                    class="shadow border-gray-300 rounded w-48 py-2 px-3 text-grey-darker mr-2"
                                                    wire:model="level">
                                                @include('member.qualification-options', ['type' => $type, 'selected' => $qualification->level])
                                            </select>
                                        </div>
                                        <div class="mt-4">
                                            <label for="date_attained" class="block text-sm text-gray-400 mb-2 font-bold">Date
                                                attained</label>
                                            <input type="date" name="date_attained" id="date_attained"
                                                   class="shadow border-gray-300 rounded w-48 py-2 px-3 text-grey-darker mr-2" wire:model="date_attained">
                                        </div>
                                        <div class="mt-4">
                                            <label for="notes" class="block text-sm text-gray-400 mb-2 font-bold">Notes</label>
                                            <textarea name="notes" id="notes" rows="3"
                                                   class="shadow border-gray-300 rounded w-full py-2 px-3 text-grey-darker mr-2"
                                                   wire:model="notes"></textarea>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse" @click.stop>
                    <button type="submit" form="updateQualification"
                            class="button-judo ml-4"
                            @click="qualificationModal = false">
                        Update
                    </button>
                    <button type="button"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                            @click="qualificationModal = false">
                        Dismiss
                    </button>

                </div>
            </div>

        </div>
    </div>
</div>
