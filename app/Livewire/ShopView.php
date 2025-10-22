<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Catalog;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ShopView extends Component
{
    #[Layout('components.layouts.front', ['title' => 'Shop'])]
    public $title = 'Shop',$price=0;
    public $category,$products,$allproducts,$keyword;
    public $categories = [
        "Fruits",
        "Vegetables",
        "Cereals",
        "Poutry"
    ];
    public $sorts = [
        ['name'=>"name",'order'=>"asc",'title'=>"Sort by name A-Z"],
        ['name'=>"price",'order'=>"asc",'title'=>"Sort by price low to high"],
        ['name'=>"discount",'order'=>"asc",'title'=>"Sort by discount lowest to highest"],
        ['name'=>"discount",'order'=>"asc",'title'=>"Sort by discount highest to lowest"],
        ['name'=>"name",'order'=>"desc",'title'=>"Sort by name Z-A"],
        ['name'=>"price",'order'=>"desc",'title'=>"Sort by price high to low"],
    ];
    
    public function sort($name,$order)
    {
        $this->products = Catalog::orderBy($name, $order)->get();
    }

    public function filter($value)
    {
        $this->products = Catalog::where('category', $value)->get();
    }
    public function search()
    {
        // dd();
        $this->products = Catalog::where('name', 'like', '%' . $this->keyword . '%')->get();
    }
    public function addtoCart($product_id){
        if (! Auth::check()) {
            return redirect()->route('login');
        }
        if (Cart::where([['product_id', $product_id], ['user_id', Auth::user()->id]])->exists()) {
            Cart::where([['product_id', $product_id], ['user_id', Auth::user()->id]])->increment('quantity');
        } else {
            Cart::create([
                'product_id' => $product_id,
                'user_id' => Auth::user()->id,
                'quantity' => 1
            ]);
        }
        session()->flash('message', 'Product added to cart successfully');
    }
    public function filterPrice($value)
    {
        $this->price = $value;
        $this->products = Catalog::where('price','>=',$value)->get();
    }
    public function mount(){
        $this->products = Catalog::all();
        $this->allproducts = Catalog::all();
    }

    public function render()
    {
       
        return view('livewire.shop-view');
    }
}
