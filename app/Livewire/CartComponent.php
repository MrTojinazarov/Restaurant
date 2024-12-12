<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItems;
use Carbon\Carbon;
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
        $date = Carbon::now()->format('Y-m-d');
        $queue = Order::whereDate('date', $date)->count();
    
        $order = Order::create([
            'date' => $date,
            'queue' => ($queue + 1),
            'summ' => $this->getTotalPrice(),
        ]);
    
        $cartItems = session()->get('cart', []); 
        foreach ($cartItems as $item) {
            OrderItems::create([
                'order_id' => $order->id,
                'food_id' => $item['id'],
                'count' => $item['quantity'],
                'total_price' => $item['price'] * $item['quantity'],
            ]);
        }
    
        session()->forget('cart');
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
