<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Food;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class OrderComponent extends Component
{
    public $categories;
    public $foods;
    public $cartItemsCount;

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

    public function addToCart(Food $food)
    {
        $cart = Session::get('cart', []);
    
        foreach ($cart as $item) {
            if ($item['id'] == $food->id) {
                return;
            }
        }
    
        $cart[] = ['id' => $food->id, 'name' => $food->name, 'img' => $food->img, 'price' => $food->price];
        
        Session::put('cart', $cart);
        $this->cartItemsCount = $this->getCartItemsCount();
    }
    

    public function render()
    {
        return view('livewire.order')->layout('components.layouts.main', [
            'categories' => $this->categories,
            'cartItemsCount' => $this->cartItemsCount,
        ]);
    }
}
