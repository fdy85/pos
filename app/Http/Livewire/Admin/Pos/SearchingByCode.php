<?php

namespace App\Http\Livewire\Admin\Pos;

use App\Models\Product;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class SearchingByCode extends Component
{
    /* Params */
    public $searchingByCode;

    public function mount(){
        $this->searchingByCode = "";
    }

    public function render()
    {
        return view('livewire.admin.pos.searching-by-code');
    }

    /* Recognize BARCODE */
    public function scanCode(){
        try{
            /* Get Product info */
            $product = Product::where('barcode', $this->searchingByCode)->first();
            /* Validate Barcode */
            if($product == null){
                $this->emit('toast-message', ['msg' => 'El Código no existe. intente con otro código', 'icon' =>'error']);
                $this->reset(['searchingByCode']);
                return;
            }
            /* Product Exists */
            if($product->count()){
                /* Validate STOCK [If does call scanCode Method] */
                ($product->qty >= 1)
                    ? $this->emitTo('admin.pos.pos', 'scanCode', $product)
                    : $this->emit('toast-message', ['msg' => 'El Producto ['.$product->name.'] está agotado. intente con otro código', 'icon' =>'error']);
            }
        }catch(Exception $ex){
            $this->emit('toast-message', ['msg' => $ex->getMessage(), 'icon' =>'error']);
        }
        /* RESET param */
        $this->reset(['searchingByCode']);
    }
}
