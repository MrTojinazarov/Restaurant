<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Food;
use Livewire\Component;

class OrderComponent extends Component
{
    public $categories;
    public $foods;

    public function mount()
    {
        $this->all();
    }

    public function all()
    {
        $this->categories = Category::orderBy('sort', 'ASC')->get();
        $this->foods = Food::all();

        return [$this->categories, $this->foods];
    }

    public function render()
    {
        return view('livewire.order')->layout('components.layouts.main', ['categories' => $this->categories]);
    }
}
