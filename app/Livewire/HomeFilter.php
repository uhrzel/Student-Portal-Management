<?php

namespace App\Livewire;

use App\Models\RoomSection;
use Livewire\Component;
use Livewire\WithPagination;

class HomeFilter extends Component
{
    use WithPagination;

    public $selectedYearLevel = null;
    public $selectedSemester = null;
    public $academicYear = null;
    public $yearLevels = ['1st', '2nd', '3rd', '4th'];
    public $semesters = ['1st', '2nd'];
    public $totalStudents = 0;

    public function mount()
    {
        $this->calculateTotalStudents();
    }

    public function render()
    {
        $roomSections = RoomSection::where('teacher_id', auth()->id())
            ->when($this->selectedYearLevel, function ($query) {
                $query->where('year_level', $this->selectedYearLevel);
            })
            ->when($this->selectedSemester, function ($query) {
                $query->where('semester', $this->selectedSemester);
            })
            ->when($this->academicYear, function ($query) {
                $query->where('academic_year', $this->academicYear);
            })
            ->with(['section', 'subject', 'room', 'teacher', 'students'])
            ->paginate(6); // Pagination managed by Livewire

        return view('livewire.home-filter', compact('roomSections'));
    }

    public function updated($propertyName)
    {
        // Reset pagination when a filter is updated
        $this->resetPage();

        // Recalculate the total students
        $this->calculateTotalStudents();
    }

    private function calculateTotalStudents()
    {
        $this->totalStudents = RoomSection::where('teacher_id', auth()->id())
            ->when($this->selectedYearLevel, function ($query) {
                $query->where('year_level', $this->selectedYearLevel);
            })
            ->when($this->selectedSemester, function ($query) {
                $query->where('semester', $this->selectedSemester);
            })
            ->when($this->academicYear, function ($query) {
                $query->where('academic_year', $this->academicYear);
            })
            ->with('students')
            ->get()
            ->sum(function ($roomSection) {
                return $roomSection->students->count();
            });
    }
}
