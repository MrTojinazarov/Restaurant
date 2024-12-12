<?php

namespace App\Livewire;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class UserComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $roles;
    public $activeCreate = false;
    public $editFormModel = false;

    public $role_id;
    public $name;
    public $phone;
    public $email;
    public $password;
    public $img;

    public $editRole_id;
    public $editEmail;
    public $editPassword;
    public $editName;
    public $editPhone;
    public $editImg;


    protected $rules = [
        'role_id' => 'required|integer|exists:roles,id',
        'name' => 'required|string|min:3',
        'email' => 'required|email|string|unique:users,email',
        'phone' => 'required|numeric',
        'password' => 'required|min:6',
        'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
    ];

    public function validateOnBlur($field)
    {
        $this->validateOnly($field);
    }

    public function mount()
    {
        $this->roles = Role::orderBy('sort', 'ASC')->get();
    }


    public function render()
    {
        $users = User::latest()->paginate(10);

        return view('livewire.user', [
            'models' => $users,
            'roles' => $this->roles,
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
            if ($this->img) {
                $ext = $this->img->getClientOriginalExtension();
                $date = now();

                $folder = "pictures";
                $filename = $date->format('YmdHisv') . '.' . $ext;

                $path = $this->img->storeAs($folder, $filename, 'public');

                $validatedData['img'] = $path;
            }
            
            User::create($validatedData);

            session()->flash('message', 'User created successfully!');
            $this->resetForm();
        }
    }

    public function resetForm()
    {
        $this->role_id = '';
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->phone = '';
        $this->img = '';
        $this->activeCreate = false;
    }

    public function delete(User $user)
    {
        $user->delete();
        session()->flash('message', 'User deleted successfully!');
    }

    public function editForm(User $user)
    {
        $this->editFormModel = $user->id;
        $this->editRole_id = $user->role_id;
        $this->editName =  $user->name;
        $this->editEmail =  $user->email;
        $this->editPassword =  $user->password;
        $this->editPhone = $user->phone;
        $this->editImg = $user->img;
    }

    public function updateUser()
    {
        $user = User::findOrFail($this->editFormModel);
        if ($this->editImg != $user->img) {
            $ext = $this->editImg->getClientOriginalExtension();
            $date = now();

            $folder = "pictures";
            $filename = $date->format('YmdHisv') . '.' . $ext;

            $path = $this->editImg->storeAs($folder, $filename, 'public');
            $this->editImg = $path;
        } else {
            $this->editImg = $user->img;
        }

        $user->update([
            'role_id' => $this->editRole_id,
            'name' => $this->editName,
            'email' => $this->editEmail,
            'phone' => $this->editPhone,
            'password' => $this->editPassword,
            'img' => $this->editImg,
        ]);
        $this->editFormModel = false;
    }
}

