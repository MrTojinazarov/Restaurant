<?php

namespace App\Livewire;

use App\Models\Employee;
use App\Models\Section;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class EmployeeComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $sections;
    public $users;
    public $activeCreate = false;
    public $editFormEmployee = false;

    public $section_id;
    public $user_id;
    public $salary_type;
    public $salary;
    public $bonus;
    public $workhours;
    public $start_time;
    public $end_time;
    public $time;


    public $editSection_id;
    public $editSalary_type;
    public $editSalary;
    public $editBonus;
    public $editWorkhours;
    public $editStart_time;
    public $editEnd_time;

    protected $rules = [
        'section_id' => 'required|integer|exists:sections,id',
        'user_id' => 'required|integer|exists:users,id',
        'salary_type' => 'required',
        'salary' => 'required|numeric',
        'bonus' => 'nullable',
        'workhours' => 'required',
        'start_time' => 'required',
        'end_time' => 'required',
    ];

    public function validateOnBlur($field)
    {
        $this->validateOnly($field);
    }

    public function mount()
    {
        $this->sections = Section::orderBy('sort', 'ASC')->get();
        $this->users = User::orderBy('id', 'ASC')->get();
    }


    public function render()
    {
        $employees = Employee::latest()->paginate(10);

        return view('livewire.employee', [
            'models' => $employees,
            'sections' => $this->sections,
            'users' => $this->users,
        ]);
    }

    public function CreateModal()
    {
        $this->activeCreate = !$this->activeCreate;
    }

    public function store()
    {
        $validatedData = $this->validate();

        if ($validatedData) {
            $start = Carbon::createFromFormat('H:i', $validatedData['start_time']);
            $end = Carbon::createFromFormat('H:i', $validatedData['end_time']);
            $timeDifference = $start->diffInHours($end);

            Employee::create([
                'section_id' => $validatedData['section_id'],
                'user_id' => $validatedData['user_id'],
                'salary_type' => $validatedData['salary_type'],
                'salary' => $validatedData['salary'],
                'bonus' => $validatedData['bonus'],
                'workhours' => $validatedData['workhours'],
                'start_time' => $validatedData['start_time'],
                'end_time' => $validatedData['end_time'],
                'time' => $timeDifference,
            ]);

            session()->flash('message', 'Employee created successfully!');
            $this->resetForm();
        }
    }


    public function resetForm()
    {
        $this->section_id = '';
        $this->user_id = '';
        $this->salary_type = '';
        $this->salary = '';
        $this->bonus = '';
        $this->workhours = '';
        $this->start_time = '';
        $this->end_time = '';
        $this->time = '';
        $this->activeCreate = false;
    }

    public function delete(Employee $employee)
    {
        $employee->delete();
        session()->flash('message', 'Employee deleted successfully!');
    }

    public function editForm(Employee $employee)
    {
        $this->editFormEmployee = $employee->id;
        $this->editSection_id = $employee->section_id;
        $this->editSalary_type =  $employee->salary_type;
        $this->editSalary = $employee->salary;
        $this->editBonus = $employee->bonus;
        $this->editStart_time = $employee->start_time;
        $this->editEnd_time = $employee->end_time;
        $this->editWorkhours = $employee->workhours;
    }

    public function updateEmployee()
    {
        $employee = Employee::findOrFail($this->editFormEmployee);
        $this->editStart_time = substr($this->editStart_time, 0, 5); 
        $this->editEnd_time = substr($this->editEnd_time, 0, 5);
        $start = Carbon::createFromFormat('H:i', $this->editStart_time);
        $end = Carbon::createFromFormat('H:i', $this->editEnd_time);
        $timeDifference = $start->diffInHours($end);
        $employee->update([
            'section_id' => $this->editSection_id,
            'salary_type' => $this->editSalary_type,
            'salary' => $this->editSalary,
            'bonus' => $this->editBonus,
            'start_time' => $this->editStart_time,
            'end_time' => $this->editEnd_time,
            'workhours' => $this->editWorkhours,
            'time' => $timeDifference,
        ]);
        $this->editFormEmployee = false;
    }
}
