<?php

namespace App\Http\Livewire\Admin\Cashouts;

use App\Models\Cashout;
use App\Models\CashRegister;
use App\Models\Sale;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class CashoutsIndex extends Component
{
    /* Pagination */
    use WithPagination;

    /* params */
    public $title, $add, $selectedId, $date, $cashStart, $cashRegisterId, $comments, $status, 
            $sales = [], $search, $formOpen, $formDetailsOpen;

    public function mount(){
        $this->title = 'CORTES DE CAJA';
        $this->add = 'Aperturar Caja';
        $this->selectedId = 0;
        $this->cashStart = 0.0;
        $this->search = "";
        $this->formOpen = false;
        $this->formDetailsOpen = false;
    }

    public function render()
    {
        $items = Cashout::where('date', 'LIKE', '%'.$this->search.'%')
                        ->orderBy('id', 'DESC')
                        ->paginate(20);
        $cashRegisters = CashRegister::where('status', true)
                                    ->where('is_available', true)
                                    ->where('branch_office_id', Auth::id())
                                    ->get();
        /* Main view w/params */
        return view('livewire.admin.cashouts.cashouts-index', [
                                                                'items' => $items,
                                                                'cashRegisters' => $cashRegisters
                                                                ])
                    ->extends('layouts.app')
                    ->section('content');
    }

    /* Show Form [create] */
    public function showForm(){
        /* RESET params */
        $this->resetUI();
        /* Validate if cash register is OPEN and get cashier INFO */
        $cashRegisterExists = auth()->user()->cashRegister;
        $cashier = auth()->user()->name;
        /* Validation Toast */
        if($cashRegisterExists && $cashRegisterExists->count()){
            $this->emit('toast-message', ['msg' => 'El Cajero ['.$cashier.'] ya tiene la caja ['.$cashRegisterExists->name.'] abierta!', 'icon' => 'error']);
            return;
        }
        /* SET params */
        $this->title = 'CORTES DE CAJA';
        /* Use Carbon::now('GMT-6') for an exact hour/day */
        $this->date = Carbon::now('GMT-6')->format('d-m-Y');
        $this->formOpen = true;
    }

    /* store record */
    public function store(){
        /* validation */
        $rules = ['cashRegisterId' => 'required',
                    'cashStart' => 'required'
                ];
        $messages = ['cashRegisterId.required' => 'El nombre de la caja es requerido',
                    'cashStart.required' => 'El monto de apertura es requerida',
                    ];
        $this->validate($rules, $messages);
        /* store record by TRANSACTION */

        /* PENDIENTE */
        DB::beginTransaction();
            try {
                $cashRegisterSelected = CashRegister::find($this->cashRegisterId);
                $cashout = Cashout::create(['date' => $this->date,
                                            'cash_start' => $this->cashStart,
                                            'total' => $this->cashStart,
                                            'comments' => $this->comments,
                                            'cash_register_id' => $this->cashRegisterId,
                                            'user_id' => Auth::id(),
                                            'branch_office_id' => 1,
                                            ]);
                $cashRegisterSelected->update(['is_available' => false,
                                                'user_id' => Auth::id(),
                                            ]);
                DB::commit();
                /* Toast */
                $this->emit('toast-message', ['msg' => 'Apertura de caja ['.$cashout->date.'] creado correctamente!', 'icon' => 'success']);
                
            } catch (Exception $ex) {
                DB::rollBack();
                $this->emit('toast-message', ['msg' => $ex->getMessage(), 'icon' => 'error']);
            }
        $this->resetUI();
    }

    /*  */
    public function showDetailsForm(Cashout $cashout){
        //dd($cashout->sales);
        $this->selectedId = $cashout->id;
        $this->date = $cashout->date;
        $this->cashStart = $cashout->cash_start;
        $this->comments = $cashout->comments;
        $this->status = $cashout->status;
        //0 => Abierto  1 => Cerrado
        if($cashout->status){
            $this->sales = $cashout->sales;
            
        }else{
            $this->sales = Sale::where('cashout_id', NULL)->get();
        }
        //dd($this->sales);
        $this->formDetailsOpen = true;
    }

    /* show Form [with Info] */
    public function edit(Cashout $cashout){
        $this->resetUI();
        $this->title = 'CORTES DE CAJA';
        $this->selectedId = $cashout->id;
        $this->date = $cashout->date;
        $this->cashStart = $cashout->cash_start;
        $this->comments = $cashout->comments;
        $this->cashRegisterId = $cashout->cash_register_id;
        $this->status = $cashout->status;
        $this->formOpen = true;
    }

    /* update record */
    public function update(){
        /* Validation */
        $rules = ['cashRegisterId' => 'required',
                    'cashStart' => 'required'
                ];
        $messages = ['cashRegisterId.required' => 'El nombre de la caja es requerido',
                    'cashStart.required' => 'El monto de apertura es requerida',
                    ];
        $this->validate($rules, $messages);
        /* find record */
        $cashout = Cashout::find($this->selectedId);
        /* update record */
        try{
            $cashout->update(['date' => $this->date,
                                'cash_start' => $this->cashStart,
                                'comments' => $this->comments,
                                'cash_register_id' => $this->cashRegisterId,
                            ]);
            /* Toast */
            $this->emit('toast-message', ['msg' => 'Apertura de caja ['.$cashout->date.'] Actualizado!', 'icon' =>'success']);
        } catch (Exception $ex) {
            $this->emit('toast-message', ['msg' => $ex->getMessage(), 'icon' => 'error']);
        }
        $this->resetUI();
    }

    public function resetUI(){
        $this->reset(['selectedId', 'date', 'cashStart', 'cashRegisterId', 'comments', 'status', 
                    'sales', 'formOpen', 'formDetailsOpen']);
    }
}
