<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Food;
use Livewire\Component;

class ParametrComponent extends Component
{
    public $categoryId;
    public $categories;
    public $foods;

    public function mount($categoryId)
    {
        $this->foods = Food::where('category_id', $categoryId)->get();
    }

    public function render()
    {
        $this->categories = Category::orderBy('sort', 'ASC')->get();

        return view('livewire.order', ['foods' => $this->foods])->layout('components.layouts.main', ['categories' => $this->categories]);
    }
}
