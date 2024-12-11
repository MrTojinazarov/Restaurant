<?php

namespace App\Livewire;

use App\Models\Section;
use Livewire\Component;
use Livewire\WithPagination;

class SectionComponent extends Component
{

    use WithPagination;

    public $models;
    public $activeCreate = false;
    public $editFormSection = false;

    public $name;
    public $editName;
    
    public function mount()
    {
        $this->all();
    }

    public function all()
    {
        $this->models = Section::orderBy('sort', 'asc')->get();
        return $this->models;
    }

    public function render()
    {
        return view('livewire.section');
    }
    
    public function CreateModal()
    {
        $this->activeCreate = !$this->activeCreate;
    }

    public function store()
    {

        $count = Section::all()->count();
        
        if(!empty($this->name)){
            Section::create([
                'name' => $this->name,
                'sort' => ($count+1),
            ]);
            $this->activeCreate = false;
        }
        $this->name = '';
        $this->all();
    }

    public function delete(Section $section)
    {
        $section->delete();
        $this->all();
    }

    public function editForm(Section $section)
    {
        $this->editFormSection = $section->id;
        $this->editName = $section->name;
    }
    
    public function update()
    {

        $section = Section::findOrFail($this->editFormSection);
        $section->update([
            'name' => $this->editName,
        ]);
        $this->editFormSection = false;
        $this->all();

    }

    public function updateSectionTr($updateSectionIds)
    {
        foreach ($updateSectionIds as $key)
        {
            Section::where('id', $key['value'])->update((['sort' => $key['order']]));
        }
        $this->models = Section::orderBy('sort', 'asc')->paginate(10);
    }
}
