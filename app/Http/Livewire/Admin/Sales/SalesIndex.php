<?php

namespace App\Http\Livewire\Admin\Sales;

use App\Models\Sale;
use App\Models\User;
use Livewire\Component;

class SalesIndex extends Component
{
    /* Params */
    public $title, $selectedId, $items, $details, $currentSale, $salesTotalMoney, $salesTotalQty, $formDetailsOpen;

    public function mount(){
        $this->title = 'VENTAS';
        $this->selectedId = 0;
        $this->items = Sale::where('cashout_id', NULL)->get();
        $this->details = [];
        $this->currentSale = [];
        if(count($this->items)){
            $this->salesTotalMoney = $this->items->sum('total');; 
            $this->salesTotalQty = $this->items->sum('qty');
        }else{
            $this->salesTotalMoney = 0.0; 
            $this->salesTotalQty = 0;
        }
        
        $this->formDetailsOpen = false;
    }

    protected $listeners = ['getSalesByCashier'];

    public function render()
    {
        
        return view('livewire.admin.sales.sales-index')
                    ->extends('layouts.app')
                    ->section('content');
    }

    /* Show Details */
    public function showDetailsForm(Sale $sale){
        
        $this->selectedId = $sale->id;
        $this->details = $sale->saledetails;
        $this->currentSale = $sale;
        //dd($this->currentSale);
        $this->formDetailsOpen = true;
    }

    public function getSalesByCashier($sales, $moneySum, $qtySum){
        $this->items = $sales;
        $this->salesTotalMoney = $moneySum;
        $this->salesTotalQty = $qtySum;
    }

    public function resetUI(){
        $this->reset(['selectedId', 'items', 'details', 'currentSale', 'salesTotalMoney', 'salesTotalQty', 'formDetailsOpen']);
    }
}
