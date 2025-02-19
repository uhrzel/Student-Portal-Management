<div>
    <div>
        <div class="py-12">
            <!-- Breadcrump -->
            <div class="max-w-7xl mx-auto space-y-4 sm:px-6 lg:px-8">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                        <li class="inline-flex items-center">
                            <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                                Users
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <x-icons.chevron-right-icon class="w-5 h-5 text-gray-400 mx-1" />
                                <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2">Edit</a>
                            </div>
                        </li>
                    </ol>
                </nav>
                <!-- Title -->
                <div class="flex flex-row justify-between items-center">
                    <h1 class="uppercase text-2xl font-bold text-yellow-700 text-start">Users</h1>
                </div>

                <!-- Form -->
                <div>
                    <form wire:submit.prevent="updateUser" method="POST" class="mx-auto">
                        <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2 isolate bg-white  rounded-md sm:p-4">
                            <!-- Name -->
                            <div>
                                <x-label class="text-sm/6 text-gray-900 " for="name">Name</x-label>
                                <div class="mt-2.5">
                                    <x-input type="text" wire:model="name" name="name" id="name" autocomplete="name" class="block w-full rounded-md shadow-gray-400 shadow-md border-0 px-3.5 py-2 text-gray-900 sm:text-sm/6" />
                                    @error('name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Email -->
                            <div>
                                <x-label class="text-sm/6 text-gray-900 " for="email">Email</x-label>
                                <div class="mt-2.5">
                                    <x-input type="text" wire:model="email" name="email" id="email" autocomplete="email" class="block w-full rounded-md shadow-gray-400 shadow-md border-0 px-3.5 py-2 text-gray-900 sm:text-sm/6" />
                                    @error('email')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Roles -->
                            <div>
                                <x-label for="roles" class="text-sm/6 text-gray-900">Roles</x-label>
                                <div class="mt-2.5">
                                    <select name="selectedRoles[]" id="roles" wire:model="selectedRoles"
                                        class="block w-full rounded-md shadow-gray-400 shadow-md dark:shadow-sm dark:shadow-bg-gray-100 border-0 px-3.5 py-2 text-gray-900 sm:text-sm/6"
                                        multiple>
                                        @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!--upload  id-->
                            
                            @if($selectedRoles !== 2)
                            <div>
                                <x-label for="roles" class="text-sm/6 text-gray-900">Front Photo</x-label>
                                <div class="mt-2.5">
                                    <input type="file" wire:model="file">

                                    @error('file') 
                                        <span class="error">{{ $message }}</span>
                                    @enderror

                                </div>

                                <x-label for="roles" class="text-sm/6 text-gray-900">Back Photo</x-label>
                                <div class="mt-2.5">
                                    <input type="file" wire:model="file1">

                                    @error('file') 
                                        <span class="error">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="flex flex-row space-x-4 mt-4">
                            <x-button type="submit">Submit</x-button>
                            <x-secondary-button type="button">
                                <a href="{{ route('admin.users') }}" wire:navigate>Cancel</a>
                            </x-secondary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>