<?php

namespace App\Http\Livewire\Admin\Cashouts;

use App\Models\Sale;
use App\Models\User;
use Livewire\Component;

class CashoutsIndex extends Component
{
    public $title, $selectedId, $items, $details, $saleDetailsItemsQty, $saleDetailsTotalMoney, $salesTotalMoney, $salesTotalQty, $formDetailsOpen;

    public function mount(){
        $this->title = 'VENTAS';
        $this->selectedId = 0;
        $this->items = [];
        $this->details = [];
        $this->saleDetailsItemsQty = 0;
        $this->saleDetailsTotalMoney = 0.0;
        $this->salesTotalMoney = 0.0; 
        $this->salesTotalQty = 0;
        $this->formDetailsOpen = false;
    }

    protected $listeners = ['getSalesByCashier'];

    public function render()
    {
        return view('livewire.admin.cashouts.cashouts-index')
                    ->extends('layouts.app')
                    ->section('content');
    }

    /* Show Details */
    public function showDetailsForm(Sale $sale){
        $this->selectedId = $sale->id;
        $this->details = $sale->saledetails;
        $this->saleDetailsItemsQty = $sale->qty;
        $this->saleDetailsTotalMoney = $sale->total;
        $this->formDetailsOpen = true;
    }

    public function getSalesByCashier($sales, $moneySum, $qtySum){
        $this->items = $sales;
        $this->salesTotalMoney = $moneySum;
        $this->salesTotalQty = $qtySum;
    }

    public function resetUI(){
        $this->reset(['selectedId', 'items', 'details', 'saleDetailsItemsQty', 'saleDetailsTotalMoney', 'salesTotalMoney', 'salesTotalQty', 'formDetailsOpen']);
    }
}
