<?php

namespace App\Livewire\Admin\Subjects;

use Livewire\Component;
use App\Models\Subject;
use App\Models\Department;

class Edit extends Component
{
    public $name, $code, $description, $department_id;
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
        $this->department_id = $this->subject->department_id; // Ensure department_id is loaded
    }


    public function updateSubject()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50',
            'description' => 'nullable|string|max:255',
            'department_id' => 'required|exists:departments,id',
        ]);

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
