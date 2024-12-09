<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class CartComponent extends Component
{
    public $cart;
    public $categories;

    public function mount()
    {
        $this->cart = Session::get('cart', []);
        foreach ($this->cart as &$item) {
            if (!isset($item['quantity'])) {
                $item['quantity'] = 1;
            }
        }
        $this->updateCart();
    }

    public function increment($index)
    {
        $this->cart[$index]['quantity']++;
        $this->updateCart();
    }

    public function decrement($index)
    {
        if ($this->cart[$index]['quantity'] > 1) {
            $this->cart[$index]['quantity']--;
            $this->updateCart();
        }
    }

    public function removeProduct($index)
    {
        unset($this->cart[$index]);
        $this->cart = array_values($this->cart);
        $this->updateCart();
    }

    public function checkout()
    {
        Session::forget('cart');
        session()->flash('success', 'Buyurtma muvaffaqiyatli amalga oshirildi!');
        return redirect()->route('order.home'); 
    }

    private function updateCart()
    {
        Session::put('cart', $this->cart);
    }

    public function getTotalPrice()
    {
        return array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $this->cart));
    }

    public function canselOrder()
    {
        Session::forget('cart');
        return redirect()->route('order.home'); 
    }

    public function render()
    {
        $this->categories = Category::orderBy('sort', 'ASC')->get();
        return view('livewire.cart', ['cart' => $this->cart])->layout('components.layouts.main', ['categories' => $this->categories]);
    }
}
