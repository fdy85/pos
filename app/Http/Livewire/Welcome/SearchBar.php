<?php

namespace App\Http\Livewire\Welcome;

use App\Models\Product;
use Livewire\Component;

class SearchBar extends Component
{
    public $title, $name, $description, $barcode, $cost, $price, $qty, $alert, $status, $brand, $category, $image,
            $productsList = [], $searchProduct, $formOpen;

    public function mount(){
        $this->title = 'PRODUCTO';
        $this->searchProduct = "";
        $this->formOpen = false;
    }

    public function render()
    {
        //$products = Product::where('status', true)->get();
        
        return view('livewire.welcome.search-bar');
    }

    public function updatedSearchProduct(){
        $this->productsList = $this->searchProduct != '' 
                            ? Product::where('name', 'LIKE', '%'.$this->searchProduct.'%')
                                    ->orWhere('barcode', 'LIKE', '%'.$this->searchProduct.'%')->get()
                            : null;
    }

    public function selectProduct(Product $product){
        //dd($produc);
        $this->reset(['productsList', 'searchProduct']);
        $this->name = $product->name; 
        $this->description = $product->description; 
        $this->barcode = $product->barcode; 
        $this->cost = $product->cost; 
        $this->price = $product->price; 
        $this->qty = $product->qty; 
        $this->alert = $product->alert; 
        $this->status = $product->status;
        $this->category = $product->category->name;
        $this->brand = $product->brand->name;
        $images = $product->images->first();
        
        $this->image = $images != null 
                ? $images->url
                : 'noImg.jpg';
        $this->formOpen = true;
    }

    public function findProductInformation(Product $produc){
        $this->formOpen = true;
    }
}
