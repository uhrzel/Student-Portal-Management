<?php

namespace App\Livewire\Admin\Subjects;

use Livewire\Component;
use App\Models\Subject;
use App\Models\Department;

class Edit extends Component
{
    public $name, $code, $description;
    public $subject_id;
    public $subject;

    public function mount($subject_id)
    {
        $this->subject_id = $subject_id;
        $this->loadSubjectData();
    }

    public function loadSubjectData()
    {
        $this->subject = Subject::findOrFail($this->subject_id);
        $this->name = $this->subject->name;
        $this->code = $this->subject->code;
        $this->description = $this->subject->description;
    }

    public function updateSubject()
    {
        $this->subject->update([
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
            'department_id' => $this->department_id,

        ]);

        toastr()->success('Subject updated successfully');
        return redirect()->route('admin.subjects');
    }

    public function render()
    {
        $departments = Department::all();
        return view('livewire.admin.subjects.edit', compact('departments'));
    }
}
