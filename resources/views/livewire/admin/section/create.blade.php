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
                            <!-- Teacher Dropdown -->
                            <x-label class="text-sm/6 text-gray-900" for="user_id">Teacher</x-label>
                            <div class="mt-2.5">
                                <!-- Dropdown for Teachers, disabled until a department is selected -->
                                <select wire:model="user_id" name="user_id" id="user_id"
                                    class="block w-full rounded-md shadow-gray-400 shadow-md border-0 px-3.5 py-2 text-gray-900 sm:text-sm/6"
                                    {{ !$department_id ? 'disabled' : '' }}>
                                    <!-- Prompt user to select department if not selected yet -->
                                    <option value="">{{ !$department_id ? 'Select a department first' : 'Select Teacher' }}</option>

                                    <!-- Populate teachers dynamically based on selected department -->
                                    @forelse ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @empty
                                    <!-- Message when no teachers are found -->
                                    <option disabled>No teachers found in this department</option>
                                    @endforelse
                                </select>

                                <!-- Display validation error for 'user_id' -->
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
                                <select wire:model="subject_id" wire:change="updateStudentListNotInTheSubject($event.target.value)"  name="subject_id" id="subject_id" class="block w-full rounded-md shadow-gray-400 shadow-md border-0 px-3.5 py-2 text-gray-900 sm:text-sm/6">
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
                            <br>
                            <x-label class="text-sm/6 text-gray-900" for="academic_year">Academic Year</x-label>
                            <div class="mt-2.5">
                            <select wire:model="academic_year" name="academic_year" id="academic_year" class="block w-full rounded-md shadow-gray-400 shadow-md border-0 px-3.5 py-2 text-gray-900 sm:text-sm/6">
                                    <option value="">Select Academic Year</option>
                                    <option value="2023-2024">2023-2024</option>
                                    <option value="2024-2025">2024-2025</option>
                                    <option value="2025-2026">2025-2026</option>
                                    <option value="2026-2027">2026-2027</option>
                                    <option value="2027-2028">2027-2028</option>
                                </select>
                                @error('academic_year')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <!-- Students -->
                        <div>
                            <!-- Students Dropdown with Search Functionality -->
                            <x-label class="text-sm/6 text-gray-900" for="student_ids">Students</x-label>
                            <div class="mt-2.5">
                                <!-- Real-time search input -->
                                <input wire:model="searchQuery" type="text" class="block w-full rounded-md shadow-gray-400 shadow-md border-0 px-3.5 py-2 text-gray-900 sm:text-sm/6 mb-2" placeholder="Search for students..." />

                                <!-- Students dropdown with multiple selection -->
                                <select wire:model="student_ids" name="student_ids[]" id="student_ids"
                                    class="block w-full rounded-md shadow-gray-400 shadow-md border-0 px-3.5 py-2 text-gray-900 sm:text-sm/6"
                                    multiple
                                    {{ !$department_id ? 'disabled' : '' }}>
                                    <!-- Populate students dynamically based on department and search query -->
                                    @forelse ($filteredStudents as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                    @empty
                                    <!-- Display message when no students are found -->
                                    @if(strlen($searchQuery) > 0)
                                    <option disabled>No students found for "{{ $searchQuery }}"</option>
                                    @else
                                    <option disabled>No students available</option>
                                    @endif
                                    @endforelse
                                </select>

                                <!-- Validation error message -->
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
                            <x-label class="text-sm/6 text-gray-900 " for="start_date">Schedule</x-label>
                            <div class="mt-2.5">
                                <!-- <x-input type="datetime-local" wire:model="start_date" name="start_date" id="start_date" autocomplete="start_date" class="block w-full rounded-md shadow-gray-400 shadow-md border-0 px-3.5 py-2 text-gray-900 sm:text-sm/6" />
                                  -->
                                  <x-label class="text-sm/6 text-gray-900 " for="Day">Day</x-label>
                                  <select wire:model="selected_day" id="day" class="block w-full rounded-md shadow-gray-400 shadow-md border-0 px-3.5 py-2 text-gray-900 sm:text-sm/6">
                                        <option value="">Select a day</option>
                                        @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                            <option value="{{ $day }}">{{ $day }}</option>
                                        @endforeach
                                    </select>

                                    <!-- Time Input -->
                                    <x-label class="text-sm/6 text-gray-900 " for="Day">Start of Class</x-label>
                                    <input type="time" wire:model="selected_time" id="time" class="block w-full rounded-md shadow-gray-400 shadow-md border-0 px-3.5 py-2 text-gray-900 sm:text-sm/6" />
                                    @error('start_date')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                    <x-label class="text-sm/6 text-gray-900 " for="Day">End of Class</x-label>
                                    <input type="time" wire:model="selected_time2" id="time" class="block w-full rounded-md shadow-gray-400 shadow-md border-0 px-3.5 py-2 text-gray-900 sm:text-sm/6" />
                             
                                @error('end_date')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- End Date -->
                      

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