<?php

namespace App\Livewire\Products;

use App\Models\Cart as ModelsCart;
use App\Models\Notification;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Cart extends Component
{
    #[Layout('components.layouts.front', ['title' => 'Cart'])]
    
    public $carts;
    public $sum=0;
    public function mount()
    {
        $this->sum=0;
        $this->carts = ModelsCart::where('user_id', Auth::user()->id)->get();
        foreach ($this->carts as $cart) {
            $amount = ($cart->product->price) * ($cart->quantity);
            $this->sum += $amount;
        }
    }
    public function remove($id)
    {
        $cart = ModelsCart::find($id);
        $cart->delete();
        // $this->carts = ModelsCart::where('user_id', Auth::user()->id)->get();
    }
    public function addCart($id){
        ModelsCart::where('id',$id)->increment('quantity');
        $this->mount();
    }
    public function minusCart($id){
        $cart = ModelsCart::find($id);
        if($cart->quantity > 1){
            ModelsCart::where('id',$id)->decrement('quantity');
        }
        $this->mount();
    }
    public function processToCheckout()
    {
        $receipt = strtoupper(uniqid());
        foreach ($this->carts as $cart) {
            Order::create([
                'user_id'=>Auth::user()->id,
                'product_id'=>$cart->product_id,
                'quantity'=>$cart->quantity,
                'discount'=>$cart->product->discount,
                'receipt_no'=>$receipt,
            ]);
            ModelsCart::destroy($cart->id);
        }
        Notification::create([
            'user_id'=>Auth::user()->id,
            'type'=>'Order',
            'track_id'=>$receipt,
            'message'=>'An order with receipt no '.$receipt.' has been placed.',
        ]);
        session()->flash('message','Order placed successfully. Proceed to payment.');
        session()->put('amount',$this->sum);
        session()->put('reference',$receipt);
        session()->put('user_id',Auth::user()->id);
        return redirect()->route('checkout');
    }
    public function render()
    {
        // dd($this->sum);
        return view('livewire.products.cart');
    }
}
