<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto space-y-4 sm:px-6 lg:px-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.sections') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            Sections
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
                <h1 class="uppercase text-2xl font-bold text-yellow-700 text-start">Sections</h1>
            </div>

            <!-- Form -->
            <div>
                <form wire:submit.prevent="storeSection" method="POST" class="mx-auto">
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

                        <!-- Department -->
                        <div>
                            <x-label class="text-sm/6 text-gray-900" for="department_id">Department</x-label>
                            <div class="mt-2.5">
                                <select wire:model.live="department_id" name="department_id" id="department_id"
                                    class="block w-full rounded-md shadow-gray-400 shadow-md border-0 px-3.5 py-2 text-gray-900 sm:text-sm/6">
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Teacher -->
                        <div>
                            <x-label class="text-sm/6 text-gray-900" for="user_id">Teacher</x-label>
                            <div class="mt-2.5">
                                <select wire:model="user_id" name="user_id" id="user_id"
                                    class="block w-full rounded-md shadow-gray-400 shadow-md border-0 px-3.5 py-2 text-gray-900 sm:text-sm/6"
                                    {{ !$department_id ? 'disabled' : '' }}>
                                    <option value="">{{ !$department_id ? 'Select a department first' : 'Select Teacher' }}</option>
                                    @forelse ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @empty
                                    <option disabled>No teachers found in this department</option>
                                    @endforelse
                                </select>
                                @error('user_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Room -->
                        <div>
                            <x-label class="text-sm/6 text-gray-900" for="room_id">Room</x-label>
                            <div class="mt-2.5">
                                <select wire:model="room_id" name="room_id" id="room_id" class="block w-full rounded-md shadow-gray-400 shadow-md border-0 px-3.5 py-2 text-gray-900 sm:text-sm/6">
                                    <option value="">Select Room</option>
                                    @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Subject -->
                        <div>
                            <x-label class="text-sm/6 text-gray-900" for="subject_id">Subject</x-label>
                            <div class="mt-2.5">
                                <select wire:model="subject_id" name="subject_id" id="subject_id" class="block w-full rounded-md shadow-gray-400 shadow-md border-0 px-3.5 py-2 text-gray-900 sm:text-sm/6">
                                    <option value="">Select Subject</option>
                                    @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                                @error('subject_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>



                        <!-- Semester and Year Level -->
                        <div class="flex flex-col gap-y-2">
                            <div>
                                <x-label class="text-sm/6 text-gray-900" for="semester">Semester</x-label>
                                <div class="mt-2.5">
                                    <select wire:model="semester" name="semester" id="semester" class="block w-full rounded-md shadow-gray-400 shadow-md border-0 px-3.5 py-2 text-gray-900 sm:text-sm/6">
                                        <option value="">Select Semester</option>
                                        <option value="1st">1st</option>
                                        <option value="2nd">2nd</option>
                                    </select>
                                    @error('semester')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <x-label class="text-sm/6 text-gray-900" for="year_level">Year Level</x-label>
                                <div class="mt-2.5">
                                    <select wire:model="year_level" name="year_level" id="year_level" class="block w-full rounded-md shadow-gray-400 shadow-md border-0 px-3.5 py-2 text-gray-900 sm:text-sm/6">
                                        <option value="">Select Year Level</option>
                                        <option value="1st">1st</option>
                                        <option value="2nd">2nd</option>
                                        <option value="3rd">3rd</option>
                                        <option value="4th">4th</option>
                                    </select>
                                    @error('year_level')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Students -->
                        <div>
                            <x-label class="text-sm/6 text-gray-900" for="student_ids">Students</x-label>
                            <div class="mt-2.5">
                                <select wire:model="student_ids" name="student_ids[]" id="student_ids"
                                    class="block w-full rounded-md shadow-gray-400 h-52 shadow-md border-0 px-3.5 py-2 text-gray-900 sm:text-sm/6"
                                    multiple
                                    {{ !$department_id ? 'disabled' : '' }}>
                                    @forelse ($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                    @empty
                                    <option disabled>No students found in this department</option>
                                    @endforelse
                                </select>
                                @error('student_ids')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Hold Ctrl/Cmd to select multiple students</p>
                        </div>

                        <!-- Existing Section Times -->
                        @if(count($existingSections) > 0)
                        <div class="sm:col-span-2">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h3 class="text-sm font-semibold text-gray-900 mb-2">Existing Section Times in This Room:</h3>
                                <div class="space-y-2">
                                    @foreach($existingSections as $section)
                                    <div class="flex items-center text-sm text-gray-600 bg-white p-2 rounded">
                                        <span class="font-medium">{{ $section['name'] }}:</span>
                                        <span class="ml-2">{{ $section['start_date'] }} to {{ $section['end_date'] }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Start Date -->
                        <div>
                            <x-label class="text-sm/6 text-gray-900 " for="start_date">Start Date</x-label>
                            <div class="mt-2.5">
                                <x-input type="datetime-local" wire:model="start_date" name="start_date" id="start_date" autocomplete="start_date" class="block w-full rounded-md shadow-gray-400 shadow-md border-0 px-3.5 py-2 text-gray-900 sm:text-sm/6" />
                                @error('start_date')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- End Date -->
                        <div>
                            <x-label class="text-sm/6 text-gray-900 " for="end_date">End Date</x-label>
                            <div class="mt-2.5">
                                <x-input type="datetime-local" wire:model="end_date" name="end_date" id="end_date" autocomplete="end_date" class="block w-full rounded-md shadow-gray-400 shadow-md border-0 px-3.5 py-2 text-gray-900 sm:text-sm/6" />
                                @error('end_date')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="flex flex-row space-x-4 mt-4">
                        <x-button type="submit">Submit</x-button>
                        <x-secondary-button type="button">
                            <a href="{{ route('admin.sections') }}" wire:navigate>Cancel</a>
                        </x-secondary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add this temporarily at the top of your form for debugging -->
@if($department_id)
<div class="bg-gray-100 p-4 mb-4">
    <p>Selected Department: {{ $department_id }}</p>
    <p>Teachers Count: {{ $users->count() }}</p>
    <p>Students Count: {{ $students->count() }}</p>
</div>
@endif