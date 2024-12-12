<?php

namespace App\Livewire;

use App\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;

class RoleComponent extends Component
{

    use WithPagination;

    public $models;
    public $activeCreate = false;
    public $editFormCategory = false;

    public $name;
    public $editName;
    
    public function mount()
    {
        $this->all();
    }

    public function all()
    {
        $this->models = Role::orderBy('sort', 'asc')->get();
        return $this->models;
    }

    public function render()
    {
        return view('livewire.role');
    }
    
    public function CreateModal()
    {
        $this->activeCreate = !$this->activeCreate;
    }

    public function store()
    {

        $count = Role::all()->count();
        
        if(!empty($this->name)){
            Role::create([
                'name' => $this->name,
                'sort' => ($count+1),
            ]);
            $this->activeCreate = false;
        }
        $this->name = '';
        $this->all();
    }

    public function delete(Role $category)
    {
        $category->delete();
        $this->all();
    }

    public function editForm(Role $category)
    {
        $this->editFormCategory = $category->id;
        $this->editName = $category->name;
    }
    
    public function update()
    {

        $category = Role::findOrFail($this->editFormCategory);
        $category->update([
            'name' => $this->editName,
        ]);
        $this->editFormCategory = false;
        $this->all();

    }

    public function updateCategoryTr($updateCategoryIds)
    {
        foreach ($updateCategoryIds as $key)
        {
            Role::where('id', $key['value'])->update((['sort' => $key['order']]));
        }
        $this->models = Role::orderBy('sort', 'asc')->paginate(10);
    }
}
