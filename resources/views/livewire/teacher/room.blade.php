<div>
    <div class="py-12">
        <!-- Breadcrump -->
        <div class="max-w-7xl mx-auto space-y-4 sm:px-6 lg:px-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            Room
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <x-icons.chevron-right-icon class="w-5 h-5 text-gray-400 mx-1" />
                            <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2">Section</a>
                        </div>
                    </li>
                </ol>
            </nav>
            <!-- Title -->
            <div class="flex flex-row justify-between items-center">
                <h1 class="uppercase text-2xl font-bold text-yellow-700 text-start">
                    {{ $subject->name }}
                </h1>
            </div>

            <!-- Sections and Students List -->
            <div class="mt-6">
                @forelse($roomSections as $roomSection)
                <div class="bg-white shadow-sm rounded-lg mb-6">
                    <div class="p-6">
                        <!-- Section Information -->
                        <div class="mb-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Subject Information</h3>
                                <p class="mt-1 text-sm text-gray-900">
                                    Name: {{ $roomSection->subject->name }}<br>
                                    Code: {{ $roomSection->subject->code }}
                                </p>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Section Details</h3>
                                <p class="mt-1 text-sm text-gray-900">
                                    Section: {{ $roomSection->section->name }}
                                </p>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Room & Building</h3>
                                <p class="mt-1 text-sm text-gray-900">
                                    Room: {{ $roomSection->room->name }}<br>
                                    Building: {{ $roomSection->room->building->name }}
                                </p>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Schedule</h3>
                                <p class="mt-1 text-sm text-gray-900">
                                    Start Date: {{ $roomSection->start_date->format('M d, Y') }}<br>
                                    End Date: {{ $roomSection->end_date->format('M d, Y') }}
                                </p>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Teacher Information</h3>
                                <p class="mt-1 text-sm text-gray-900">
                                    Name: {{ $roomSection->teacher->name }}
                                </p>
                            </div>
                        </div>

                        <!-- Students Table -->
                        <div class="overflow-x-auto">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Students List</h3>
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Student Name
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Section
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Subject
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($roomSection->students as $student)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $student->name }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $roomSection->section->name }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $roomSection->subject->name }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                @php
                                                $existingGrade = $student->grades->where('room_section_id', $roomSection->id)->first();
                                                @endphp

                                                @if($existingGrade && $existingGrade->grade !== null)
                                                <span class="px-2 py-1 text-sm rounded-full {{ $existingGrade->status === 'Passed' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    Grade: {{ number_format($existingGrade->grade, 2) }} ({{ $existingGrade->status }})
                                                </span>
                                                @else
                                                <x-secondary-button @click="$wire.loadExistingGrade({{ $student->id }}, {{ $roomSection->id }}); $dispatch('open-grade-modal', { studentId: {{ $student->id }}, roomSectionId: {{ $roomSection->id }} })">
                                                    Add Grade
                                                </x-secondary-button>
                                                @endif
                                                <x-button @click="$dispatch('open-modal', { id: {{ $student->id }} })">
                                                    Remove
                                                </x-button>
                                            </div>
                                        </td>

                                        <!-- Modal For Delete Student -->
                                        <div x-data="{ showModal: false, studentId: null }"
                                            @open-modal.window="showModal = true; studentId = $event.detail.id"
                                            @student-removed.window="showModal = false"
                                            x-show="showModal"
                                            class="fixed inset-0 z-50 overflow-y-auto"
                                            style="display: none;">
                                            <div class="flex items-center justify-center min-h-screen px-4">
                                                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="showModal = false"></div>

                                                <div class="relative bg-white rounded-lg shadow-xl max-w-lg w-full">
                                                    <div class="p-6">
                                                        <h3 class="text-lg font-medium text-gray-900">Confirm Deletion</h3>
                                                        <p class="mt-2 text-sm text-gray-500">Are you sure you want to delete this user? This action cannot be undone.</p>

                                                        <div class="mt-4 flex space-x-3">
                                                            <button @click="showModal = false" type="button" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                                                Cancel
                                                            </button>
                                                            <button @click="$wire.removeStudent(studentId); showModal = false" type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                                Delete
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div x-data="{ 
                                            showGradeModal: false,
                                            grade: null,
                                            init() {
                                                window.addEventListener('open-grade-modal', (event) => {
                                                    this.showGradeModal = true;
                                                    $wire.selectedStudentId = event.detail.studentId;
                                                    $wire.selectedRoomSectionId = event.detail.roomSectionId;
                                                });
                                            }
                                        }"
                                            x-show="showGradeModal"
                                            class="fixed inset-0 z-50 overflow-y-auto"
                                            style="display: none;">
                                            <div class="flex items-center justify-center min-h-screen px-4">
                                                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="showGradeModal = false"></div>

                                                <div class="relative bg-white rounded-lg shadow-xl max-w-lg w-full">
                                                    <div class="p-6">
                                                        <h3 class="text-lg font-medium text-gray-900">Add Grade</h3>

                                                        <div class="mt-4">
                                                            <div class="flex justify-between items-center">
                                                                <label class="block text-sm font-medium text-gray-700">Quiz Scores</label>
                                                                <div class="flex items-center space-x-4">
                                                                    <div class="text-sm text-gray-500">
                                                                        <span>Total Score: {{ collect($quizzes)->sum('quiz_score') }} / {{ collect($quizzes)->sum('quiz_over') }}</span>
                                                                        @php
                                                                        $totalScore = collect($quizzes)->sum('quiz_score');
                                                                        $totalOver = collect($quizzes)->sum('quiz_over');
                                                                        $percentage = $totalOver > 0 ? round(($totalScore / $totalOver) * 100, 2) : 0;
                                                                        @endphp
                                                                        <span class="ml-2 px-2 py-1 text-xs rounded-full {{ $percentage >= 75 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                                            {{ $percentage }}%
                                                                        </span>
                                                                    </div>
                                                                    <button type="button"
                                                                        wire:click="addQuiz"
                                                                        class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                                                        Add Quiz
                                                                    </button>
                                                                </div>
                                                            </div>

                                                            <div class="space-y-3 mt-2">
                                                                @foreach($quizzes as $index => $quiz)
                                                                <div class="flex items-center space-x-2">
                                                                    <div class="flex-1">
                                                                        <input type="text"
                                                                            wire:model="quizzes.{{ $index }}.quiz_name"
                                                                            placeholder="Quiz Name"
                                                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                                        @error("quizzes.{$index}.quiz_name")
                                                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="flex-1">
                                                                        <input type="number"
                                                                            wire:model="quizzes.{{ $index }}.quiz_score"
                                                                            placeholder="Score"
                                                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                                        @error("quizzes.{$index}.quiz_score")
                                                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="flex-1">
                                                                        <input type="number"
                                                                            wire:model="quizzes.{{ $index }}.quiz_over"
                                                                            placeholder="Over"
                                                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                                        @error("quizzes.{$index}.quiz_over")
                                                                        <span class="text-red-500 text-xs">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="flex-none w-20">
                                                                        @php
                                                                        $score = floatval($quiz['quiz_score'] ?? 0);
                                                                        $over = floatval($quiz['quiz_over'] ?? 1);
                                                                        $quizPercentage = $over > 0 ? round(($score / $over) * 100, 2) : 0;
                                                                        @endphp
                                                                        <span class="px-2 py-1 text-xs rounded-full {{ $quizPercentage >= 75 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                                            {{ $quizPercentage }}%
                                                                        </span>
                                                                    </div>
                                                                    <button type="button"
                                                                        wire:click="removeQuiz({{ $index }})"
                                                                        class="text-red-600 hover:text-red-800">
                                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                                @endforeach

                                                            </div>
                                                        </div>

                                                        <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-3">
                                                            <div>
                                                                <label for="prelim_grade" class="block text-sm font-medium text-gray-700">Prelim Exam Grade</label>
                                                                <input type="number"
                                                                    wire:model="prelim_grade"
                                                                    step="0.01"
                                                                    min="1"
                                                                    max="5"
                                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                                @error('prelim_grade') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                                            </div>

                                                            <div>
                                                                <label for="midterm_grade" class="block text-sm font-medium text-gray-700">Midterm Exam Grade</label>
                                                                <input type="number"
                                                                    wire:model="midterm_grade"
                                                                    step="0.01"
                                                                    min="1"
                                                                    max="5"
                                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                                @error('midterm_grade') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                                            </div>

                                                            <div>
                                                                <label for="final_grade" class="block text-sm font-medium text-gray-700">Final Exam Grade</label>
                                                                <input type="number"
                                                                    wire:model="final_grade"
                                                                    step="0.01"
                                                                    min="1"
                                                                    max="5"
                                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                                @error('final_grade') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                                            </div>
                                                        </div>

                                                        <div class="mt-4">
                                                            <label for="grade" class="block text-sm font-medium text-gray-700">Grade (1-5)</label>
                                                            <input type="number"
                                                                wire:model="grade"
                                                                step="0.01"
                                                                min="1"
                                                                max="5"
                                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                            @error('grade') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                                        </div>

                                                        <div class="mt-4 flex space-x-3">
                                                            <button @click="showGradeModal = false" type="button" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                                                Cancel
                                                            </button>
                                                            <button wire:click="saveGrade" @click="showGradeModal = false" type="button" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700">
                                                                Save Grade
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                                            No students found in this section
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white shadow-sm rounded-lg">
                    <div class="p-6 text-center text-gray-500">
                        No sections found for this subject
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>