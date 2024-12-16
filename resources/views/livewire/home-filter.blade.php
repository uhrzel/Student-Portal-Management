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

</div>