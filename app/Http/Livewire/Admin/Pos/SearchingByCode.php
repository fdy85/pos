<?php

namespace App\Http\Livewire\Admin\Pos;

use App\Models\Product;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class SearchingByCode extends Component
{
    public $searchingByCode;

    public function mount(){
        $this->searchingByCode = "";
    }

    public function render()
    {
        return view('livewire.admin.pos.searching-by-code');
    }

    public function scanCode(){
        try{
            $product = Product::where('barcode', $this->searchingByCode)->first();

            if($product == null){
                $this->emit('toast-message', ['msg' => 'El Código no existe. intente con otro código', 'icon' =>'error']);
                $this->reset(['searchingByCode']);
                return;
            }
            if($product->count()){
                ($product->qty >= 1)
                    ? $this->emitTo('admin.pos.pos', 'scanCode', $product)
                    : $this->emit('toast-message', ['msg' => 'El Producto ['.$product->name.'] está agotado. intente con otro código', 'icon' =>'error']);
            }else{
                dd('nothing');
            }
        }catch(Exception $ex){

        }
        
        $this->reset(['searchingByCode']);
    }
}
