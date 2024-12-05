<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Food;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class FoodComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $categories;
    public $activeCreate = false;
    public $editFormFood = false;

    public $category_id;
    public $name;
    public $price;
    public $img;

    public $editCategory_id;
    public $editName;
    public $editPrice;
    public $editImg;


    protected $rules = [
        'category_id' => 'required|integer|exists:categories,id',
        'name' => 'required|string|min:3',
        'price' => 'required|numeric',
        'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
    ];

    public function validateOnBlur($field)
    {
        $this->validateOnly($field);
    }

    public function mount()
    {
        $this->categories = Category::orderBy('sort', 'ASC')->get();
    }


    public function render()
    {
        $foods = Food::latest()->paginate(10);

        return view('livewire.food', [
            'models' => $foods,
            'categories' => $this->categories
        ])->layout('components.layouts.app');
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
            
            Food::create($validatedData);

            session()->flash('message', 'Food created successfully!');
            $this->resetForm();
        }
    }

    public function resetForm()
    {
        $this->category_id = '';
        $this->name = '';
        $this->price = '';
        $this->img = '';
        $this->activeCreate = false;
    }

    public function delete(Food $food)
    {
        $food->delete();
        session()->flash('message', 'Food deleted successfully!');
    }

    public function editForm(Food $food)
    {
        $this->editFormFood = $food->id;
        $this->editCategory_id = $food->category_id;
        $this->editName =  $food->name;
        $this->editPrice = $food->price;
        $this->editImg = $food->img;
    }

    public function updateFood()
    {
        $food = Food::findOrFail($this->editFormFood);
        if ($this->editImg != $food->img) {
            $ext = $this->editImg->getClientOriginalExtension();
            $date = now();

            $folder = "pictures";
            $filename = $date->format('YmdHisv') . '.' . $ext;

            $path = $this->editImg->storeAs($folder, $filename, 'public');
            $this->editImg = $path;
        } else {
            $this->editImg = $food->img;
        }

        $food->update([
            'category_id' => $this->editCategory_id,
            'name' => $this->editName,
            'price' => $this->editPrice,
            'img' => $this->editImg,
        ]);
        $this->editFormFood = false;
    }
}
