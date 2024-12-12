<?php

namespace App\Livewire\Layout;

use App\Models\Building;
use App\Models\Department;
use App\Models\Room;
use App\Models\Section;
use App\Models\Subject;
use App\Models\User;
use Livewire\Component;

class Sidebar extends Component
{
    public $usersCount;
    public $departmentsCount;
    public $buildingsCount;
    public $roomsCount;
    public $sectionsCount;
    public $subjectsCount;

    public function mount()
    {
        $this->usersCount = User::count();
        $this->departmentsCount = Department::count();
        $this->buildingsCount = Building::count();
        $this->roomsCount = Room::count();
        $this->sectionsCount = Section::count();
        $this->subjectsCount = Subject::count();
    }

    public function render()
    {
        return view('livewire.layout.sidebar');
    }
}
