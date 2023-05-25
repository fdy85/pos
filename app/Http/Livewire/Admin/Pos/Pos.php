<?php

namespace App\Http\Livewire\Admin\Pos;

use App\Models\Cashout;
use App\Models\Denomination;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Pos extends Component
{
    /* Params */
    public $summary, $coins, $productId, $qty, $subtotal, $iva, $total, $cash, $change, $totalItems, 
            $itemFound, $itemFoundRowId, $itemFoundQty;
            
    public function mount(){
        $this->summary = 'Resumen de Venta';
        $this->coins = 'Denominaciones';
        $this->totalItems = 0;
        $this->productId = 0;
        $this->cash = 0;
        $this->change = 0;
        $this->itemFound = false;
        $this->itemFoundQty = 0;

        /* SET [total] params BY CART */
        if(Cart::content()->count()){
            $this->totalItems = Cart::count();
            $this->subtotal = Cart::subtotal();
            $this->iva = Cart::tax();
            $this->total = Cart::total();
        }else{
            $this->subtotal = 0;
            $this->iva = 0;
            $this->total = 0;
        }
    }

    /* listeners */
    protected $listeners = ['scanCode'];

    public function render()
    {
        /* Validate if Cash Register is Open */
        /* Render view by Validation */
        if(auth()->user()->cashRegister){
            return view('livewire.admin.pos.pos', ['cart' => Cart::content()])
                    ->extends('layouts.app')
                    ->section('content');
        }else{
            return view('livewire.admin.pos.no-cash-register-open', ['cart' => Cart::content()])
                    ->extends('layouts.app')
                    ->section('content');
        }  
    }

    /* Backspace button */
    public function resetCash(){
        $this->cash = 0;
    }

    /* Exact Cash Button */
    public function exact(){
        $this->cash = $this->total;
        $this->change = 0;
    }

    /* Scanning Product */
    public function scanCode(Product $product){
        /* SET params */
        $this->productId = $product->id;
        /* Get Product's Images and take first */
        $images = $product->images->first();
        /* Validate if exists Image */
        $img = $images != null 
                ? $images->url
                : 'noImg.jpg';

        /* VALIDATE IF NEW PRODUCT EXIST IN CURRENT CART */
        $allItems = Cart::content();
        foreach($allItems as $item){
            /* Validate if PRODUCT exists */
            if($item->id === $this->productId){
                /* Get item Info & Break loop */
                $this->itemFound = true;
                $this->itemFoundQty = $item->qty;
                $this->itemFoundRowId = $item->rowId;
            break;
            }else{
                $this->itemFound = false;
            }
        }
        
        /* IF PRODUCT EXIST MODIFY QTY IF NOT ADD TO CART AS NEW PRODUCT */
        if($this->itemFound){
            /* Call method with params */
            $this->modifyQty($this->itemFoundRowId, $product, $this->itemFoundQty + 1);
        }else{
            /* ADD PRODUCT TO CART AS NEW */
            Cart::add(['id' => $product->id, 'name' => $product->name, 'qty' => 1, 'price' => $product->price, 'weight' => 0, 
                    'options' => ['brand' => $product->brand->name, 'image' => $img, 'subtotal' => $product->price]]);
            /* Toast */
            $this->emit('toast-message', ['msg' => 'Se agregó el producto ['.$product->name.']', 'icon' =>'success']);
            /* SET Totals params */
            $this->subtotal = Cart::subtotal();
            $this->iva = Cart::tax();
            $this->total = Cart::total();
            $this->totalItems = Cart::count();
        }
    }

    public function modifyQty($rowId, Product $product, $qty){
        /* Get Product's Images and take first */
        $images = $product->images->first();
        /* Validate if exists Image */
        $img = $images != null 
                ? $images->url
                : 'products/noImg.png';
        /* Validate STOCK */
        if($product->qty >= $qty){
            /* Validate if PRODUCT IN CART is decreased to ZERO */
            if($qty > 0){
                /* UPDATE qty Information */
                Cart::update($rowId, ['qty' => $qty, 'options' => ['brand' => $product->brand->name, 'image' => $img , 'subtotal' => $product->price * $qty]]);
                /* SET Totals params */
                $this->subtotal = Cart::subtotal();
                $this->iva = Cart::tax();
                $this->total = Cart::total();
                /* Toast */
                $this->emit('toast-message', ['msg' => 'Producto ['.$product->name.'] actualizado. Cantidad = ['.$qty.']', 'icon' =>'success']);
            }else{
                /* Remove Item from CURRENT CART */
                $this->cartRemoveItem($rowId);
            }
        }else{
            /* Validation Toast */
            $this->emit('toast-message', ['msg' => 'El Producto ['.$product->name.'] está agotado. intente con otro código', 'icon' =>'error']);
        }
        /* SET param */
        $this->totalItems = Cart::count();
    }

    /* Remove Item */
    public function cartRemoveItem($rowId){
        /* Remove a specific Item */
        Cart::remove($rowId);
        /* SET Totals params */
        $this->subtotal = Cart::subtotal();
        $this->iva = Cart::tax();
        $this->total = Cart::total();
        $this->totalItems = Cart::count();
        /* Toast */
        $this->emit('toast-message', ['msg' => 'Se eliminó el producto de la compra', 'icon' =>'success']);
    }

    /* Update Property CASH */
    public function updatedCash(){
        if(empty($this->cash) || $this->cash == ""){
            $this->cash = 0;
        }
        //Take off comas from $total [FOR DB]
        $this->change = $this->cash - str_replace(',', '', $this->total);
    }

    /* SAVE Sale */
    public function saveSale(){
        /* Save Sale with TRANSACTION */
        DB::beginTransaction();
        try{
            //Take off comas from $tax - $total [FOR DB]
            $sale = Sale::create([
                                    'qty' => Cart::count(), 
                                    'subtotal' => str_replace(',', '', Cart::subtotal()), 
                                    'iva' => str_replace(',', '', Cart::tax()), 
                                    'total' => str_replace(',', '', Cart::total()), 
                                    'cash' => $this->cash, 
                                    'change' => $this->change,
                                    'user_id'   => Auth::id(),
                                    'client_id' => 1,
                                ]);
            /* Validate sale */
            if($sale){
                /* Save DETAILS */
                foreach(Cart::content() as $item){
                    /* Find Product & Save*/
                    $product = Product::find($item->id);
                    SaleDetail::create([
                                        'qty' => $item->qty,
                                        'price' => $item->price,
                                        'product_id' => $item->id,
                                        'sale_id' => $sale->id,
                                        ]);
                    /* Update product's STOCK */
                    $product->update(['qty' => $product->qty - $item->qty]);
                }
            }
            /* Update current CASHOUT Total */
            $currentUserCashout = Cashout::where('user_id', Auth::id())
                                            ->where('status', false)
                                            ->where('reviewed_by', NULL)
                                            ->first();
            $currentUserCashout->update(['total' => $currentUserCashout->total + $sale->total]);
            /* COMMIT TRANSACTION */
            DB::commit();    
            /* RESET CART */
            Cart::destroy();
            /* RESET params */
            $this->resetUI();
            /* Toast */
            $this->emit('toast-message', ['msg' => 'Venta con folio ['.$sale->id.'] realizada exitosamente!', 'icon' =>'success']);
            //WINDOW to Print Ticket
            $this->dispatchBrowserEvent('NewWindowPrintTicket', ['saleId' => 1]);
        }catch(Exception $ex){
            DB::rollBack();
            $this->emit('toast-message', ['msg' => $ex->getMessage(), 'icon' =>'error']);
        }
    }
    
    /* RESET CART */
    public function cartDestroy(){
        Cart::destroy();
        $this->emit('toast-message', ['msg' => 'Se Canceló la venta', 'icon' =>'success']);
        /* RESET params */
        $this->resetUI();
    }

    /* Reset params */
    public function resetUI(){
        $this->reset(['productId', 'qty', 'subtotal', 'iva', 'total', 'cash', 'change', 'totalItems', 
                    'itemFound', 'itemFoundRowId', 'itemFoundQty'
                    ]);
    }
}
