<div>
    <!-- Filters Section -->
    <div class="my-4 flex gap-4">
        <div>
            <label for="year_level" class="block text-sm font-medium text-gray-700">Year Level</label>
            <select wire:model.live="selectedYearLevel" id="year_level" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 sm:text-sm">
                <option value="">All Year Levels</option>
                @foreach($yearLevels as $yearLevel)
                    <option value="{{ $yearLevel }}">{{ $yearLevel }} Year</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="semester" class="block text-sm font-medium text-gray-700">Semester</label>
            <select wire:model.live="selectedSemester" id="semester" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 sm:text-sm">
                <option value="">All Semesters</option>
                @foreach($semesters as $semester)
                    <option value="{{ $semester }}">{{ ucfirst($semester) }} Semester</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="academicYear" class="block text-sm font-medium text-gray-700">Academic Year</label>
            <select wire:model.live="academicYear" name="academicYear" id="academicYear" class="block w-full rounded-md shadow-gray-400 shadow-md border-0 px-3.5 py-2 text-gray-900 sm:text-sm/6">
                <option value="">Select Academic Year</option>
                <option value="2023-2024">2023-2024</option>
                <option value="2024-2025">2024-2025</option>
                <option value="2025-2026">2025-2026</option>
                <option value="2026-2027">2026-2027</option>
                <option value="2027-2028">2027-2028</option>
            </select>
        </div>
    </div>

    <!-- Student Count Section -->
    <h1 class="uppercase text-2xl font-bold text-yellow-700 text-start my-8">Student Count</h1>

    @php
        $totalStudents = 0;
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($roomSections as $roomSection)
            @php
                $subject = $roomSection->subject;
                $studentCount = $roomSection->students->count();
                $totalStudents += $studentCount;
            @endphp
            <a href="{{ route('teacher.room', ['subject_id' => $subject->id]) }}">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <div class="flex flex-col justify-center items-center border-2 border-gray-200 rounded-lg p-4">
                        <x-application-logo class="w-20 h-20" />
                        <h1 class="font-bold text-gray-700">Section: {{ $roomSection->section->name }}</h1>
                        <p class="text-gray-700 text-sm">Subject: {{ $subject->name }}</p>
                        <p class="text-gray-700 text-sm my-2">Total Students: {{ $studentCount }}</p>
                        <p class="text-gray-700 text-sm">Room: {{ $roomSection->room->name }}</p>
                        <p class="text-gray-700 text-sm">Teacher: {{ $roomSection->teacher->name }}</p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $roomSections->links() }}
    </div>

    <!-- Total Students Card -->
    <div class="mt-4">
        <div class="bg-yellow-700 overflow-hidden shadow-xl sm:rounded-lg p-4">
            <div class="flex flex-col justify-center items-center border-2 border-yellow-600 rounded-lg p-4">
                <h1 class="font-bold text-white text-xl">Total Students Across All Subjects</h1>
                <p class="text-white text-2xl font-bold my-2">{{ $totalStudents }}</p>
            </div>
        </div>
    </div>
</div>
