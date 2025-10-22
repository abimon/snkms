<?php

namespace App\Livewire\Products;

use App\Models\Catalog;
use Flux\Flux;
use Livewire\Component;

class Catalogue extends Component
{
    use \Livewire\WithPagination;
    use \Livewire\WithFileUploads;

    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public $name,$price,$units,$category,$description,$cover;
    public $products;
    public $categories =[
        'Fruits',
        'Vegetables',
        'Dairy',
        'Meat',
        'Fish',
        'Bakery',
        'Snacks',
        'Beverages',
        'Personal Care',
        'Household',
        'Others'
    ];
    public function render()
    {
        $this->products = Catalog::orderBy($this->sortBy, $this->sortDirection)->get();
        return view('livewire.products.catalogue');
    }
    public function rules()
    {
        return [
            'name'=>'required|string|max:255',
            'price'=>'required|numeric',
            'units'=>'required|numeric',
            'category'=>'required|string|max:255',
            'description'=>'required|string|max:255',
            'cover'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
    public function delete($id){
        Catalog::destroy($id);
        $this->close('delete-'.$id );
    }
    public function close($name){
        Flux::modal($name)->close();
    }
    public function store(){
        $this->validate($this->rules());
        $path = $this->cover->store('images');
        Catalog::create([
            'name'=>$this->name,
            'price'=>$this->price,
            'units'=>$this->units,
            'category'=>$this->category,
            'description'=>$this->description,
            'cover'=>'/storage/'.$path
        ]);
        $this->reset();
        session()->flash('message','Product Added Successfully');
        Flux::modal('add-product')->close();

    }
    public function update($id){
        // $path = $this->cover->store('public/storage/images');
        $path = $this->cover->store('public/storage/images');
        Catalog::created([
            'name'=>$this->name,
            'price'=>$this->price,
            'units'=>$this->units,
            'category'=>$this->category,
            'description'=>$this->description,
            'cover'=>$path
        ]);
    }
    public function sortBy($field)
    {
        if ($this->sortDirection == 'asc') {
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortBy = $field;
        $this->products = Catalog::orderBy($this->sortBy, $this->sortDirection)->paginate(10);
        return view('livewire.products.catalogue');
    }

}
