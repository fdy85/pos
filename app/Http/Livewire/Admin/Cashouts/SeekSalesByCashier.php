<?php

namespace App\Http\Livewire\Admin\Cashouts;

use App\Models\Sale;
use App\Models\User;
use Livewire\Component;

class SeekSalesByCashier extends Component
{
    public $cashierId, $initDate, $finishDate;

    public function mount(){
    }

    public function render()
    {
        $cashiers = User::where('status', true)->get();
        return view('livewire.admin.cashouts.seek-sales-by-cashier', ['cashiers' => $cashiers]);
    }

    public function getSales(){
        $rules = [
                    'cashierId' => 'required',
                    'initDate' => 'required',
                    'finishDate' => 'required',
                ];
        $messages = [
                    'cashierId.required' => 'El cajero es requerido',
                    'initDate.required' => 'La fecha inicial es requerida',
                    'finishDate.required' => 'La fecha final es requerida',
        ];
        $this->validate($rules, $messages);
        $sales = Sale::where('user_id', $this->cashierId)
                      ->whereBetween('created_at', [$this->initDate.' 00:00:00', $this->finishDate.' 23:59:59'])
                      ->get();
        $moneySum = $sales->sum('total');
        $qtySum = $sales->sum('qty');

        $this->emitTo('admin.cashouts.cashouts-index', 'getSalesByCashier', $sales, $moneySum, $qtySum);

    }

    public function resetUI(){
        $this->reset(['cashierId', 'initDate', 'finishDate']);
    }
}
