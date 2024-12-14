<?php

namespace App\Livewire;

use App\Models\Attendence;
use Livewire\Component;

class AttendenceComponent extends Component
{
    public $employees;

    public function mount()
    {
        $this->all();
    }

    public function all()
    {
        $this->employees = Attendence::all();

        return [$this->employees];
    }

    public function render()
    {
        return view('livewire.attendence');
    }
}
