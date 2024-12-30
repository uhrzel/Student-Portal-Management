<?php

namespace App\Livewire\Admin\Section;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Section;
use DB;

class Student extends Component
{
    use WithPagination;

    public $search = '';
    public $departmentSearch = '';

    public function deleteSection($id)
    {
        $section = Section::find($id);
        $section->delete();
        toastr()->info('Section ' . $section->name . ' has been deleted successfully!');
    }

    public function restoreSection($id)
    {
        $section = Section::withTrashed()->find($id);
        $section->restore();
        toastr()->info('Section ' . $section->name . ' has been restored successfully!');
        return redirect()->back();
    }

    public function forceDeleteSection($id)
    {
        $section = Section::withTrashed()->find($id);
        $section->forceDelete();
        toastr()->error('Section ' . $section->name . ' has been permanently deleted!');
        return redirect()->back();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedDepartmentSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        
        $department = DB::table('departments')->get();


        //get all students
        $query = DB::table('Users as u')
                   ->join('model_has_roles as m', 'm.model_id','u.id')
                   ->leftjoin('room_section_students as rss', 'rss.student_id','u.id')
                   ->leftjoin('room_sections as rs', 'rs.id','rss.room_section_id')
                   ->leftjoin('departments as d', 'd.id','rs.department_id')
                   ->leftjoin('rooms as r', 'r.id','rs.room_id')
                   ->leftjoin('buildings as b','b.id','r.building_id')
                   ->leftjoin('subjects as sb','sb.id','rs.subject_id')
                   ->leftjoin('sections as sec','sec.id','rs.section_id')
                   ->select('u.id','u.name as student','u.email','d.name as department','d.course',
                   'b.name as building','r.name as room','rs.year_level','rs.semester','sb.code',
                   'sb.name as subject','sec.name as section','u.deleted_at')
                   ->where('m.role_id',4);
                  // ->whereNotNull('d.course');

        if($this->search){
              $query = $query->where('u.name', 'like', '%' . $this->search . '%');
        }

          // Filter by department
        if ($this->departmentSearch) {
            $query = $query->where('d.name', 'like', '%' . $this->departmentSearch . '%');
        }
      


        return view('livewire.admin.section.student', [
            'students' => $query->paginate(10),
            'departments' => $department,
        ]);
    }
}
