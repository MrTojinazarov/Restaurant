<?php

namespace App\Livewire;

use App\Models\Employee;
use Carbon\Carbon;
use Livewire\Component;

class AttendenceComponent extends Component
{

    public $date;
    public $employees;
    public $name;

    public $employeeId;
    public $davomatDate;

    public function mount()
    {
        $this->date = Carbon::now();
        $this->employees = Employee::all(); 
    }

    public function render()
    {

        $daysInMonth = $this->date->daysInMonth;
        $days = [];

        for ($i = 1; $i <= $daysInMonth; $i++){
            $days[] = Carbon::create($this->date->year, $this->date->month, $i);
        }

        return view('livewire.attendence', ['days' => $days]);
    }

    public function changeDate($date)
    {
        $this->date = Carbon::parse($date);
    }

    public function inputView($id, $date)
    {
        $this->employeeId = $id;
        $this->davomatDate = $date;
    }
}
