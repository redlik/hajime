<div class="w-full sm:px-6" x-data="{openModal : $wire.entangle('showModal')}">

    <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm">

        <header
            class="font-semibold text-xl bg-gray-600 text-gray-100 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
            Admin Users List
        </header>
        <div class="px-8 py-8">
            <x-button class="button-success bg-judo-green my-8" @click="openModal = ! openModal ">
                + Add new admin
            </x-button>
            <div class="text-judo-600 my-6">
                {{ $message }}
            </div>
            <table class="w-full table-auto leading-normal my-8">
                <thead>
                <tr>
                    <th
                        class="px-5 py-3 rounded-l bg-gray-600 text-left text-xs font-semibold text-gray-100 uppercase
                    tracking-wider">
                        #
                    </th>
                    <th
                        class="px-5 py-3 bg-gray-600 text-left text-xs
                        font-semibold
                        text-gray-100 uppercase tracking-wider">
                        Name
                    </th>
                    <th
                        class="px-5 py-3 bg-gray-600 text-left text-xs font-semibold
                        text-gray-100 uppercase tracking-wider">
                        Email
                    </th>
                    <th
                        class="px-5 py-3 bg-gray-600 text-left text-xs font-semibold
                        text-gray-100 uppercase tracking-wider">
                        Created At
                    </th>
                    <th
                        class="px-5 py-3 rounded-r bg-gray-600 text-left text-xs
                        font-semibold
                        text-gray-100 uppercase tracking-wider">
                        Operations
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($admins as $admin)
                    <tr class="hover:bg-gray-200">
                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                            <div class="flex items-center">
                                <div class="">
                                    <p class="text-gray-400 whitespace-no-wrap">
                                        {{ $loop->iteration }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                            <div class="flex items-center">
                                <div>
                                    <p class="text-gray-900 whitespace-no-wrap font-bold">
                                        {{ $admin->name }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                            <div class="flex items-center">
                                <div>
                                    <p class="text-gray-900 whitespace-no-wrap font-bold">
                                        {{ $admin->email }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 text-sm hidden lg:block">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ \Carbon\Carbon::parse($admin->created_at)->format('d/m/Y H:i') }}
                            </p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                            @if($admin->id != 1)
                                @if(auth()->user()->id == $admin->id)
                                    <i class="far fa-trash-alt text-gray-400 text-xl cursor-not-allowed"
                                       title="Cannot delete your own account"></i>
                                @else
                                    <button type="button" wire:click="deleteAdmin({{ $admin->id }})"
                                            class="text-red-600 hover:text-red-300 whitespace-no-wrap"
                                            onclick="return confirm('Do you want to delete the user completely?')"
                                            title="Remove user from Hajime">
                                        <i class="far fa-trash-alt text-xl"></i></button>
                                @endif
                            @else
                                    <i class="far fa-trash-alt text-gray-400 text-xl cursor-not-allowed"
                                       title="Cannot delete this user"></i>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </section>
    <div x-show="openModal">
        <div @keydown.window.escape="openModal = false" x-show="openModal"
             class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" x-ref="dialog"
             aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>

                <div x-show="openModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                     x-description="Background backdrop, show/hide based on modal state."
                     class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

                <div x-show="openModal" x-transition:enter="ease-out duration-300"
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
                                    Add new admin user
                                </h3>
                                <div class="mt-2">
                                    <form id="addAdmin" wire:submit="createAdmin">
                                        <div class="mt-4">
                                            <label for="name" class="block text-sm text-gray-400 mb-2 font-bold">Name</label>
                                            <input type="name" name="name" id="name"
                                                   class="shadow border-gray-300 rounded w-64 py-2 px-3 text-grey-darker mr-2"
                                                   wire:model="name">
                                            @error('name') <div class="text-sm text-red-600 mt-2">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="mt-4">
                                            <label for="email" class="block text-sm text-gray-400 mb-2 font-bold">Admin email</label>
                                            <input type="email" name="email" id="email"
                                                   class="shadow border-gray-300 rounded w-64 py-2 px-3 text-grey-darker mr-2"
                                                   wire:model="email">
                                            @error('email') <div class="text-sm text-red-600 mt-2">{{ $message }}</div> @enderror

                                        </div>
                                        <div class="mt-4">
                                            <label for="password" class="block text-sm text-gray-400 mb-2 font-bold">Password</label>
                                            <input type="password" name="password" id="password"
                                                   class="shadow border-gray-300 rounded w-64 py-2 px-3 text-grey-darker mr-2"
                                                   wire:model="password">
                                            @error('password') <div class="text-sm text-red-600 mt-2">{{ $message }}</div> @enderror

                                        </div>
                                        <div class="mt-4">
                                            <label for="password_confirmation" class="block text-sm text-gray-400 mb-2 font-bold">Repeat Password</label>
                                            <input type="password" name="password_confirmation" id="password_confirmation"
                                                   class="shadow border-gray-300 rounded w-64 py-2 px-3 text-grey-darker mr-2"
                                                   wire:model="password_confirmation">
                                            @error('password_confirmation') <div class="text-sm text-red-600 mt-2">{{ $message }}</div> @enderror

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse" @click.stop>
                        <button type="submit" form="addAdmin"
                                class="button-judo ml-4">
                            Create
                        </button>
                        <button type="button"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                @click="openModal = false">
                            Dismiss
                        </button>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
