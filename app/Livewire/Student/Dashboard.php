<?php

namespace App\Livewire\Student;

use App\Models\Room;
use Livewire\Component;
use App\Models\EvaluationResponse;
use App\Models\StudentGrade;
use App\Models\RoomSection;
use App\Models\RoomSectionStudent;
use App\Http\Controllers\DashboardController;

class Dashboard extends Component
{
    public $totalSubjects;
    public $subjects;
    public $selectedSemester = null;
    public $selectedYear;
    public $semesters = ['1st', '2nd'];
    public $yearLevels = ['1st', '2nd', '3rd', '4th'];
    public $selectedYearLevel = null;
    public $hasCompletedEvaluation = false;
    public $grade = null;
    public $status = null;
    public $rooms;
    public $academicYear = null;
    public function mount()
    {
        $this->selectedYear = date('Y');
        $this->updateTotalSubjects();
    }

    public function updatedSelectedSemester()
    {
        $this->updateTotalSubjects();
    }

    public function updatedSelectedYearLevel()
    {
        $this->updateTotalSubjects();
    }

    public function updatedAcademicYear()
    {
        $this->updateTotalSubjects();
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['selectedYearLevel', 'selectedSemester', 'academicYear'])) {
            $this->updateTotalSubjects();
        }
    }

 

    private function updateTotalSubjects()
    {
        $studentId = auth()->id();

        $this->subjects = RoomSection::whereHas('roomSectionStudents', function ($query) use ($studentId) {
            $query->where('student_id', $studentId);
        })->with(['roomSectionStudents' => function ($query) use ($studentId) {
            $query->where('student_id', $studentId);
        },'subject',
            'teacher',
            'section',
            'room',
            'studentGrades' => function ($q) use ($studentId) {
                $q->where('student_id', $studentId);
            }]);
        
        //if selected year level is null get all the records with the student base on the year level
        if($this->selectedYearLevel != null){
            $this->subjects =   $this->subjects->where('year_level', $this->selectedYearLevel);
        }

         //if selected semester  is null get all the records with the student base on the semester
        if($this->selectedSemester != null){
            $this->subjects =   $this->subjects->where('semester', $this->selectedSemester);
        }

         //if selected academic year  is null get all the records with the student base on the academic year

        if($this->academicYear != null){
            $this->subjects =   $this->subjects->where('academic_year', $this->academicYear);
        }

        //if year level and semester is not null get the record of student base on year and semeter

        if($this->selectedYearLevel != null && $this->selectedSemester != null) {
            $this->subjects =   $this->subjects->where('year_level', $this->selectedYearLevel)
                                    ->where('semester', $this->selectedSemester);
        }

        if($this->selectedYearLevel != null && $this->selectedSemester != null && $this->academicYear != null) {
            $this->subjects =   $this->subjects->where('year_level', $this->selectedYearLevel)
                                    ->where('semester', $this->selectedSemester)
                                    ->where('academic_year', $this->academicYear);
        }
      
        $this->subjects = $this->subjects->get();
        $this->totalSubjects = $this->subjects->count();
       
    

        // $this->subjects = Room::whereHas('roomSections', function ($query) use ($studentId) {
        //     $query->join('room_section_students', 'room_sections.id', '=', 'room_section_students.room_section_id')
        //         ->where('room_section_students.student_id', $studentId)
        //         ->when($this->selectedSemester, function ($q) {
        //             $q->where('room_sections.semester', $this->selectedSemester);
        //         })
        //         ->when($this->selectedYearLevel, function ($q) {
        //             $q->where('room_sections.year_level', $this->selectedYearLevel);
        //         })
        //         ->when($this->academicYear, function ($q) {
        //             $q->where('room_sections.academic_year', $this->academicYear);
        //         });
        // })
        //     ->with(['roomSections' => function ($query) use ($studentId) {
        //         $query->join('room_section_students', 'room_sections.id', '=', 'room_section_students.room_section_id')
        //             ->where('room_section_students.student_id', $studentId)
        //             ->when($this->selectedSemester, function ($q) {
        //                 $q->where('room_sections.semester', $this->selectedSemester);
        //             })
        //             ->when($this->selectedYearLevel, function ($q) {
        //                 $q->where('room_sections.year_level', $this->selectedYearLevel);
        //             })
        //             ->when($this->academicYear, function ($q) {
        //                 $q->where('room_sections.academic_year', $this->academicYear);
        //             })
        //             ->with([
        //                 'subject',
        //                 'teacher',
        //                 'section',
        //                 'room',
        //                 'studentGrades' => function ($q) use ($studentId) {
        //                     $q->where('student_id', $studentId);
        //                 }
        //             ]);
        //     }])
        //     ->get();

      //$this->totalSubjects = $this->subjects->flatMap->room->count();
    }

    public function checkEvaluation($roomSectionId)
    {
        $studentId = auth()->id();

        // First check evaluation response
        $evaluationResponse = EvaluationResponse::where('room_section_id', $roomSectionId)
            ->where('student_id', $studentId)
            ->first();

        $this->hasCompletedEvaluation = $evaluationResponse?->is_completed ?? false;

        // Always check for grade regardless of evaluation status
        $grade = StudentGrade::where('room_section_id', $roomSectionId)
            ->where('student_id', $studentId)
            ->first();

        // Set grade and status even if evaluation is not completed
        $this->grade = $grade?->grade;
        $this->status = $grade?->status;

        // Add logging to debug
        logger('Check Evaluation:', [
            'roomSectionId' => $roomSectionId,
            'studentId' => $studentId,
            'hasCompletedEvaluation' => $this->hasCompletedEvaluation,
            'grade' => $this->grade,
            'status' => $this->status
        ]);
    }

    public function redirectToEvaluation($roomSectionId)
    {
        // Check if user has student role
        if (!auth()->user()->hasRole('student')) {
            return;
        }

        return redirect()->route('student.evaluation', ['roomSection' => $roomSectionId]);
    }

    public function render()
    {
        return view('livewire.student.dashboard');
    }

    public function checkEvaluationStatus($roomSectionId)
    {
        // Get the grade for the current student and room section
        $grade = StudentGrade::where('student_id', auth()->id())
            ->where('room_section_id', $roomSectionId)
            ->first();

        // Check if evaluation is completed
        $evaluationResponse = EvaluationResponse::where('room_section_id', $roomSectionId)
            ->where('student_id', auth()->id())
            ->where('is_completed', true)
            ->first();
        \Log::info($evaluationResponse .'-lol');
        return [
            'grade' => $grade,
            'evaluationResponse' => $evaluationResponse
        ];
    }
}
