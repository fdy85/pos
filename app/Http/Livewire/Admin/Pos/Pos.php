<?php

namespace App\Http\Livewire\Admin\Pos;

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
    public $summary, $coins, $productId, $qty, $subtotal, $iva, $total, $cash, $change, $totalItems, 
            $itemFound, $itemFoundRowId, $itemFoundQty;

    public function mount(){
        $this->summary = 'Resumen de Venta';
        $this->coins = 'Denominaciones';
        $this->totalItems = 0;
        $this->productId = 0;
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
        $this->cash = 0;
        $this->change = 0;
        $this->itemFound = false;
        $this->itemFoundQty = 0;
    }

    //protected $casts = ['cash' => 'double', 'change' => 'double', 'total' => 'double'];

    protected $listeners = ['scanCode'];

    public function render()
    {
        $denominations = Denomination::all();
        return view('livewire.admin.pos.pos', ['cart' => Cart::content()])
                    ->extends('layouts.app')
                    ->section('content');
    }

    /* public function valueEntry(Denomination $denomination){
        $this->cash += $denomination->value;
        $this->change = $this->cash - $this->total;
    } */

    public function resetCash(){
        $this->cash = 0;
    }

    public function exact(){
        $this->cash = $this->total;
        $this->change = 0;
    }

    public function scanCode(Product $product){
        //dd($product->id);
        $this->productId = $product->id;
        //dd($this->productId);
        $images = $product->images->first();
        
        $img = $images != null 
                ? $images->url
                : 'products/noImg.png';

        /* VALIDATE IF PRODUCT EXIST IN CART */
        $allItems = Cart::content();
        foreach($allItems as $item){
            if($item->id === $this->productId){
                $this->itemFound = true;
                $this->itemFoundQty = $item->qty;
                $this->itemFoundRowId = $item->rowId;
                //dd($this->itemFound);
            break;
            }else{
                $this->itemFound = false;
            }
        }
        
        /* IF PRODUCT EXIST MODIFY QTY IF NOT ADD AS NEW PRODUCT */
        if($this->itemFound){
            $this->modifyQty($this->itemFoundRowId, $product, $this->itemFoundQty + 1);
        }else{
            Cart::add(['id' => $product->id, 'name' => $product->name, 'qty' => 1, 'price' => $product->price, 'weight' => 0, 
                    'options' => ['brand' => $product->brand->name, 'image' => $img, 'subtotal' => $product->price]]);

            /* if($item->qty > 1){
                Cart::update($item->rowId, ['qty' => $item->qty, 'options' => ['brand' => $product->brand->name, 'image' => $img , 'subtotal' => $item->price * $item->qty]]);
            } */
                        
            $this->emit('toast-message', ['msg' => 'Se agregó el producto ['.$product->name.']', 'icon' =>'success']);
            //dd(Cart::content());
            $this->subtotal = Cart::subtotal();
            $this->iva = Cart::tax();
            $this->total = Cart::total();
            $this->totalItems = Cart::count();
        }
    }

    public function modifyQty($rowId, Product $product, $qty){
        //dd($product);
        $images = $product->images->first();
        $img = $images != null 
                ? $images->url
                : 'products/noImg.png';
        if($product->qty >= $qty){
            if($qty > 0){
                Cart::update($rowId, ['qty' => $qty, 'options' => ['brand' => $product->brand->name, 'image' => $img , 'subtotal' => $product->price * $qty]]);
                $this->subtotal = Cart::subtotal();
                $this->iva = Cart::tax();
                $this->total = Cart::total();
                $this->emit('toast-message', ['msg' => 'Producto ['.$product->name.'] actualizado. Cantidad = ['.$qty.']', 'icon' =>'success']);
            }else{
                $this->cartRemoveItem($rowId);
                
            }
        }else{
            $this->emit('toast-message', ['msg' => 'El Producto ['.$product->name.'] está agotado. intente con otro código', 'icon' =>'error']);
        }
        $this->totalItems = Cart::count();
    }

    public function cartRemoveItem($rowId){
        Cart::remove($rowId);
        $this->emit('toast-message', ['msg' => 'Se eliminó el producto de la compra', 'icon' =>'success']);
        $this->subtotal = Cart::subtotal();
        $this->iva = Cart::tax();
        $this->total = Cart::total();
        $this->totalItems = Cart::count();
        $this->emit('toast-message', ['msg' => 'Se eliminó el producto de la compra', 'icon' =>'success']);
    }

    public function updatedCash(){
        if(empty($this->cash) || $this->cash == ""){
            $this->cash = 0;
        }
        //Take off comas from $total
        $this->change = $this->cash - str_replace(',', '', $this->total);
    }

    public function saveSale(){
        
        DB::beginTransaction();
            
        try{
            //Take off comas from $tax - $total
            /* $sale = Sale::create([
                'qty' => Cart::count(), 
                'subtotal' => str_replace(',', '', Cart::subtotal()), 
                'iva' => str_replace(',', '', Cart::tax()), 
                'total' => str_replace(',', '', Cart::total()), 
                'cash' => $this->cash, 
                'change' => $this->change,
                'user_id'   => Auth::id(),
            ]);
            if($sale){
                foreach(Cart::content() as $item){
                    $product = Product::find($item->id);
                    
                    SaleDetail::create([
                                    'qty' => $item->qty,
                                    'price' => $item->price,
                                    'product_id' => $item->id,
                                    'sale_id' => $sale->id
                                    ]);
                    $product->update(['qty' => $product->qty - $item->qty]);
                }
            }
            DB::commit();    
            Cart::destroy();
            $this->resetUI();
            $this->emit('toast-message', ['msg' => 'Venta con folio ['.$sale->id.'] realizada exitosamente!', 'icon' =>'success']);
 */
            //Print Ticket
            $this->dispatchBrowserEvent('NewWindowPrintTicket', ['saleId' => 1]);
        }catch(Exception $ex){
            DB::rollBack();
            $this->emit('toast-message', ['msg' => $ex->getMessage(), 'icon' =>'error']);
        }
    }
    
    public function cartDestroy(){
        Cart::destroy();
        $this->emit('toast-message', ['msg' => 'Se Canceló la venta', 'icon' =>'success']);
        $this->resetUI();
    }

    public function resetUI(){
        $this->reset(['productId', 'qty', 'subtotal', 'iva', 'total', 'cash', 'change', 'totalItems', 
                    'itemFound', 'itemFoundRowId', 'itemFoundQty'
                    ]);
    }
}
