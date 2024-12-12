<?php

namespace App\Livewire\Admin\Subjects;

use App\Models\Subject;
use Livewire\Component;
use App\Models\Department;

class Create extends Component
{
    public $name, $code, $description, $department_id;

    public function storeSubject()
    {

        Subject::create([
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
            'department_id' => $this->department_id,
        ]);

        toastr()->success('Subject created successfully');
        return redirect()->route('admin.subjects');
    }
    public function render()
    {
        $departments = Department::all();

        return view('livewire.admin.subjects.create', compact('departments'));
    }
}
