<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItems;
use Livewire\Component;

class OrderItemsComponent extends Component
{

    public $models;
    public $progModels;
    public $doneModels;
    public $handModels;
    public $orderItems = [];
    public $order;

    public $counts = [
        'new' => 0,
        'inProgress' => 0,
        'done' => 0,
        'handed' => 0,
    ];

    public function mount()
    {
        $this->all();
    }

    public function all()
    {
        $this->models = Order::where('status', 1)->with('orderItem.food')->orderBy('queue', 'asc')->get();
        $this->progModels = Order::where('status', 2)->with('orderItem.food')->orderBy('queue', 'asc')->get();
        $this->doneModels = Order::where('status', 3)->with('orderItem.food')->orderBy('queue', 'asc')->get();
        $this->handModels = Order::where('status', 4)->with('orderItem.food')->orderBy('queue', 'desc')->get();

        $this->counts['new'] = $this->models->count();
        $this->counts['inProgress'] = $this->progModels->count();
        $this->counts['done'] = $this->doneModels->count();
        $this->counts['handed'] = $this->handModels->count();

        return [$this->models, $this->progModels, $this->doneModels, $this->handModels, $this->counts];
    }

    public function changeOrderStatus(Order $order)
    {
        $order->status = 2;
        $order->save();
        $this->all();
    }

    public function changeOrderItemsStatus(Order $order)
    {
        $order->status = 3;
        $order->save();
        $this->all();
    }

    public function toggleItemStatus($orderId, $itemId)
    {
        $order = Order::find($orderId);
        $food = OrderItems::find($itemId);
    
        if ($order && $food) {
            $food->status = 2;
            $food->save();
    
            $this->orderItems = $order->orderItem()->get();
    
            if ($order->orderItem()->where('status', '!=', 2)->count() === 0) {
                $order->status = 3;
                $order->save();
            }
        }
        $this->all();
    }
    
    public function getByWaiterChangeStatus(Order $order)
    {
        $order->status = 4;
        $order->save();
        $this->all();
    }
    
    public function render()
    {
        return view('livewire.order-items');
    }
}
