<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto space-y-4 sm:px-6 lg:px-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.departments') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            Departments
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <x-icons.chevron-right-icon class="w-5 h-5 text-gray-400 mx-1" />
                            <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2">Create</a>
                        </div>
                    </li>
                </ol>
            </nav>
            <!-- Title -->
            <div class="flex flex-row justify-between items-center">
                <h1 class="uppercase text-2xl font-bold text-yellow-700 text-start">Departments</h1>
            </div>

            <!-- Form -->
            <div>
                <form wire:submit.prevent="storeDepartment" method="POST" class="mx-auto">
                    <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2 isolate bg-white  rounded-md sm:p-4">
                        <!-- Name -->
                        <div>
                            <x-label class="text-sm/6 text-gray-900 " for="name">Department Name</x-label>
                            <div class="mt-2.5">
                                <x-input type="text" wire:model="name" name="name" id="name" autocomplete="name" class="block w-full rounded-md shadow-gray-400 shadow-md border-0 px-3.5 py-2 text-gray-900 sm:text-sm/6" />
                                @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Courses -->
                        <div>
                            <x-label class="text-sm/6 text-gray-900 " for="course">Course</x-label>
                            <select name="course" id="course" wire:model="course"
                                class="block w-full rounded-md shadow-gray-400 shadow-md dark:shadow-sm dark:shadow-bg-gray-100 border-0 px-3.5 py-2 text-gray-900 sm:text-sm/6">
                                <option value="">Select Course</option>
                                @foreach($courses as $key => $course)
                                <option value="{{ $key }}">{{ $course }}</option>
                                @endforeach
                            </select>
                            @error('course')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Teachers -->
                        <div>
                            <x-label for="teachers" class="text-sm/6 text-gray-900">Teachers</x-label>
                            <div class="mt-2.5">
                                <select name="selectedTeachers[]" id="teachers" wire:model="selectedTeachers"
                                    class="block w-full rounded-md shadow-gray-400 shadow-md dark:shadow-sm dark:shadow-bg-gray-100 border-0 px-3.5 py-2 text-gray-900 sm:text-sm/6"
                                    multiple>
                                    @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                                @error('selectedTeachers')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Hold Ctrl/Cmd to select multiple teachers</p>
                        </div>

                        <!-- Students -->
                        <div>
                            <x-label for="students" class="text-sm/6 text-gray-900">Students</x-label>
                            <div class="mt-2.5">
                                <select name="selectedStudents[]" id="students" wire:model="selectedStudents"
                                    class="block w-full rounded-md shadow-gray-400 shadow-md dark:shadow-sm dark:shadow-bg-gray-100 border-0 px-3.5 py-2 text-gray-900 sm:text-sm/6"
                                    multiple>
                                    @foreach($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                    @endforeach
                                </select>
                                @error('selectedStudents')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Search and select multiple students</p>
                        </div>

                        <!-- Initialize Tom Select -->
                        <script>
                            document.addEventListener('livewire:initialized', function() {
                                new TomSelect('#students', {
                                    plugins: ['remove_button'],
                                    maxItems: null,
                                    valueField: 'value',
                                    labelField: 'text',
                                    searchField: ['text'],
                                    create: false
                                });
                            });

                            document.addEventListener('livewire:initialized', function() {
                                new TomSelect('#teachers', {
                                    plugins: ['remove_button'],
                                    maxItems: null,
                                    valueField: 'value',
                                    labelField: 'text',
                                    searchField: ['text'],
                                    create: false
                                });
                            });
                        </script>

                    </div>
                    <div class="flex flex-row space-x-4 mt-4">
                        <x-button type="submit">Submit</x-button>
                        <x-secondary-button type="button">
                            <a href="{{ route('admin.departments') }}" wire:navigate>Cancel</a>
                        </x-secondary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>