<?php

namespace App\Livewire\Admin\Section;

use App\Models\Room;
use App\Models\RoomSection;
use Livewire\Component;
use App\Models\Section;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\RoomSectionStudent;
use App\Models\Subject;
use App\Models\Evaluation;
use App\Models\Department;
use Carbon\Carbon;

class Create extends Component
{
    public $name;
    public $user_id;
    public $room_id;
    public $student_ids = [];
    public $subject_id;
    public $start_date;
    public $end_date;
    public $rooms;
    public $existingSections = [];
    public $users;
    public $students;
    public $semester;
    public $year_level;
    public $department_id;
    public $subjects = []; // Add the subjects property
    public $searchQuery = ''; // For real-time search
    public $filteredStudents = [];
    public $academic_year;
    public $selected_day;
    public $selected_time;
    public $selected_time2;


    public function mount()
    {
        $this->rooms = Room::all();
        $this->users = collect();
        $this->students = collect();
        $this->subjects = collect(); // Initialize subjects as an empty collection
        $this->department_id = null;
        $this->filteredStudents = collect();
    }


    public function updatedDepartmentId($value)
    {
        if ($value) {
            // Get teachers using the correct relationship and table names
            $this->users = User::role('teacher')
                ->whereExists(function ($query) use ($value) {
                    $query->select(DB::raw(1))
                        ->from('department_teachers')
                        ->whereColumn('department_teachers.teacher_id', 'users.id')
                        ->where('department_teachers.department_id', $value);
                })
                ->get();

            // Get students using the correct relationship and table names
            $this->students = User::role('student')
                ->whereExists(function ($query) use ($value) {
                    $query->select(DB::raw(1))
                        ->from('department_students')
                        ->whereColumn('department_students.student_id', 'users.id')
                        ->where('department_students.department_id', $value);
                })
               // ->whereDoesntHave('roomSections')  // Filter students without a section
                ->get();

            // Apply the search filter if there's a search query
            $this->applySearchFilter();

            // Fetch subjects based on the department_id
            $this->subjects = Subject::where('department_id', $value)->get();

            // Add debug logging
            \Log::info('Department ID:', ['id' => $value]);
            \Log::info('Teachers found:', ['count' => $this->users->count(), 'teachers' => $this->users->pluck('name')]);
            \Log::info('Students found:', ['count' => $this->students->count(), 'students' => $this->students->pluck('name')]);
        } else {
            $this->users = collect();
            $this->students = collect();
            $this->subjects = collect(); // Reset subjects when no department is selected
        }

        // Reset selections
        $this->user_id = null;
        $this->student_ids = [];
    }

    public function updateStudentListNotInTheSubject($value){
       
        //initialize student that has enrolled to that department and its subject
        $this->students = User::role('student')
        ->whereExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('department_students as ds')
                ->whereColumn('ds.student_id', 'users.id')
                ->where('ds.department_id', $this->department_id);
        })
        ->whereNotExists(function ($query) use ($value) {
            $query->select(DB::raw(1))
                ->from('room_sections as rs')
                ->join('room_section_students as rss', 'rss.room_section_id', 'rs.id')
                ->whereColumn('rss.student_id', 'users.id')
                ->where('rs.subject_id', $value);
        })
        ->get();

        $this->applySearchFilter(); //apply filter search to update the frontend

        \Log::info('Students found update subject:', ['count' => $this->students->count(), 'students' => $this->students->pluck('name'), 'dep' => $this->department_id]);

         // Reset selections
      //   $this->user_id = null;
       //  $this->student_ids = [];
    }

    public function updatedSearchQuery()
    {
        // Apply the search filter whenever the search query is updated
        $this->applySearchFilter();
    }

    private function applySearchFilter()
    {
        // Only apply search if students are available
        if ($this->students->isNotEmpty()) {
            // Filter the students based on the search query (case insensitive)
            $this->filteredStudents = $this->students->filter(function ($student) {
                return strpos(strtolower($student->name), strtolower($this->searchQuery)) !== false;
            });
        } else {
            $this->filteredStudents = collect(); // If no students, clear the filtered list
        }
    }

    public function updatedRoomId()
    {
        if ($this->room_id) {
            $this->existingSections = RoomSection::where('room_id', $this->room_id)
                ->whereHas('section')
                ->with('section')
                ->orderBy('start_date')
                ->get()
                ->map(function ($roomSection) {
                    return [
                        'name' => $roomSection->section?->name ?? 'Unknown Section',
                        'start_date' => $roomSection->start_date->format('Y-m-d H:i'),
                        'end_date' => $roomSection->end_date->format('Y-m-d H:i'),
                    ];
                })
                ->toArray();
        } else {
            $this->existingSections = [];
        }
    }

    public function storeSection()
    {

        $currentDate = Carbon::now()->format('Y-m-d'); // Get the current date

        $fields = [
            'name' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'student_ids' => 'required|array|min:1',
            'student_ids.*' => 'exists:users,id',
            'semester' => 'required|in:1st,2nd',
            'year_level' => 'required|in:1st,2nd,3rd,4th',
            'department_id' => 'required|exists:departments,id',
            'academic_year' => 'required'
        ];
        

        if ($this->selected_day && $this->selected_time) {
            
            $dateTime = Carbon::parse("{$currentDate} {$this->selected_time}"); // Combine date and time
            $this->start_date = $dateTime->format('Y-m-d H:i:s'); // Format as string

        }
            $fields = [
                'name' => 'required|string|max:255',
                'user_id' => 'required|exists:users,id',
                'room_id' => 'required|exists:rooms,id',
                'student_ids' => 'required|array|min:1',
                'student_ids.*' => 'exists:users,id',
                'semester' => 'required|in:1st,2nd',
                'year_level' => 'required|in:1st,2nd,3rd,4th',
                'department_id' => 'required|exists:departments,id',
                'academic_year' => 'required',
                'start_date' => 'required',
            ];
        

        if ($this->selected_day && $this->selected_time2) {
           
            $dateTime2 = Carbon::parse("{$currentDate} {$this->selected_time2}"); // Combine date and time
            $this->end_date = $dateTime2->format('Y-m-d H:i:s'); // Format as string
        }

        
            $fields = [
                'name' => 'required|string|max:255',
                'user_id' => 'required|exists:users,id',
                'room_id' => 'required|exists:rooms,id',
                'student_ids' => 'required|array|min:1',
                'student_ids.*' => 'exists:users,id',
                'semester' => 'required|in:1st,2nd',
                'year_level' => 'required|in:1st,2nd,3rd,4th',
                'department_id' => 'required|exists:departments,id',
                'academic_year' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ];
        
            $messages = [
                'start_date.required' => 'Please select a day or start time',
                'end_date.required' => 'Please select a day or end time',
            ];

        $this->validate($fields,$messages);
       
        
        DB::transaction(function () {
            // First create the section
            $section = Section::create([
                'name' => $this->name,
            ]);

            // Create room_section record with evaluation_id explicitly set to null
            $roomSection = RoomSection::create([
                'teacher_id' => $this->user_id,
                'room_id' => $this->room_id,
                'section_id' => $section->id,
                'subject_id' => $this->subject_id,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'semester' => $this->semester,
                'year_level' => $this->year_level,
                'department_id' => $this->department_id,
                'evaluation_id' => null,
                'academic_year' => $this->academic_year
            ]);

            // Create room_section_student records for each selected student
            foreach ($this->student_ids as $studentId) {
                RoomSectionStudent::create([
                    'room_section_id' => $roomSection->id,
                    'student_id' => $studentId,
                ]);
            }

            return redirect()->route('admin.sections')->with('success', 'Section created successfully.');
        });
    }

    public function render()
    {
        return view('livewire.admin.section.create', [
            'departments' => Department::all(),
            'rooms' => $this->rooms,
            'subjects' => $this->subjects,
            'existingSections' => $this->existingSections,
            'users' => $this->users,
            'filteredStudents' => $this->filteredStudents,
            'students' => $this->students,
        ]);
    }
}
