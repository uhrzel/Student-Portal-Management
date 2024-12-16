<?php

namespace App\Livewire;

namespace App\Livewire;

use Livewire\Component;

class HomeFilter extends Component
{
    public $selectedYearLevel = null;
    public $selectedSemester = null;

    public $yearLevels = ['1st', '2nd', '3rd', '4th'];
    public $semesters = ['1st', '2nd'];

    public function render()
    {
        return view('livewire.home-filter');
    }
}
