<?php

namespace App\Livewire\Products;

use App\Models\Order as ModelsOrder;
use Livewire\Component;
Use App\Livewire\Products\Checkout as Products;

class Order extends Component
{
    public $orders;
    public function mount(){
        $this->orders = ModelsOrder::all();
    }
    public function processOrder($id){
        $order = ModelsOrder::find($id);
        if(!$order->isPaid){
            session()->put('amount',$order->product->price * $order->quantity);
            session()->put('reference',$order->receipt_no);
            session()->put('user_id',$order->user_id);
            return redirect('checkout');
        } elseif ($order->isPaid && !$order->isDelivered) {
            $order->isDelivered = true;
            $order->save();
        }
        $this->mount(); // Refresh the orders list
    }
    public function render()
    {
        return view('livewire.products.order');
    }
}
