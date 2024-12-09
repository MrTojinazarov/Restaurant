<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Food;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ParametrComponent extends Component
{
    public $categoryId;
    public $categories;
    public $foods;
    public $cartItemsCount;

    public function mount($categoryId)
    {
        $this->foods = Food::where('category_id', $categoryId)->get();
    }

    public function render()
    {
        $this->categories = Category::orderBy('sort', 'ASC')->get();
        $this->cartItemsCount = $this->getCartItemsCount();

        return view('livewire.order', ['foods' => $this->foods])->layout('components.layouts.main', ['categories' => $this->categories, 'cartItemsCount' => $this->cartItemsCount,]);
    }

    public function addToCart(Food $food)
    {
        $cart = Session::get('cart', []);
    
        foreach ($cart as $item) {
            if ($item['id'] == $food->id) {
                return;
            }
        }

        $cart[] = ['id' => $food->id, 'name' => $food->name, 'img' =>$food->img, 'price' => $food->price];
    
        Session::put('cart', $cart);
    }
    
    private function getCartItemsCount()
    {
        $cart = Session::get('cart', []);
        return count($cart); 
    }
}
