<?php

namespace App\Http\Livewire\Admin\CashRegisters;

use App\Models\BranchOffice;
use App\Models\CashRegister;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class CashRegistersIndex extends Component
{
    /* Pagination */
    use WithPagination;

    /* Params */
    public $title, $add, $selectedId, $name, $status, $branchId, $search, $formOpen;

    public function mount(){
        $this->title = 'Cajas Registradoras';
        $this->add = 'Caja';
        $this->selectedId = 0; 
        $this->search = ''; 
        $this->formOpen = false;
    }

    /* update query Search */
    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $items = CashRegister::where('status', true)
                            ->where('name', 'LIKE', '%'.$this->search.'%')
                            ->paginate(5);
        $branches = BranchOffice::where('status', true)->get();
        /* Main view w/params */
        return view('livewire..admin.cash-registers.cash-registers-index', ['items' => $items,
                                                                            'branches' => $branches])
                        ->extends('layouts.app')
                        ->section('content');
    }

    /* Show Form [create] */
    public function showForm(){
        /* RESET params */
        $this->resetUI();
        $this->formOpen = true;
    }

    /* store record */
    public function store(){
        /* validation */
        $rules = ['name' => 'required|min:4',
                    'branchId' => 'required'
                ];
        $messages = ['name.required' => 'El nombre es requerido',
                    'name.min' => 'El nombre debe contener al menos 4 caracteres',
                    'branchId.required' => 'La sucursal es requerida',
                    ];
        $this->validate($rules, $messages);
        /* store record */
        try {
            $cashRegister = CashRegister::create([
                                                    'name' => $this->name,
                                                    'branch_office_id' => $this->branchId
                                                ]);
            /* Toast */
            $this->emit('toast-message', ['msg' => 'Caja ['.$cashRegister->name.'] creada correctamente!', 'icon' => 'success']);
        } catch (Exception $ex) {
            $this->emit('toast-message', ['msg' => $ex->getMessage(), 'icon' => 'error']);
        }
        $this->resetUI();
    }

    /* show Form [with Info] */
    public function edit(CashRegister $cashRegister){
        /* RESET params */
        $this->resetUI();
        /* SET params */
        $this->selectedId = $cashRegister->id;
        $this->name = $cashRegister->name;
        $this->status = $cashRegister->status;
        $this->branchId = $cashRegister->branch_office_id;
        $this->formOpen = true;
    }

    /* update record */
    public function update(){
        /* Validation */
        $rules = ['name' => 'required|min:4',
                    'branchId' => 'required'
                ];
        $messages = ['name.required' => 'El nombre es requerido',
                    'name.min' => 'El nombre debe contener al menos 4 caracteres',
                    'branchId.required' => 'La sucursal es requerida',
                    ];
        $this->validate($rules, $messages);
        /* find record */
        $cashRegister = CashRegister::find($this->selectedId);
        /* update record */
        try{
            $cashRegister->update([
                                    'name' => $this->name,
                                    'status' => $this->status,
                                    'branch_office_id' => $this->branchId
                                ]);
            /* Toast */
            $this->emit('toast-message', ['msg' => 'Información de la caja ['.$cashRegister->name.'] fue Actualizada!', 'icon' =>'success']);
        } catch (Exception $ex) {
            $this->emit('toast-message', ['msg' => $ex->getMessage(), 'icon' => 'error']);
        }
        $this->resetUI();
    }

    /* delete record */
    public function destroy(CashRegister $cashRegister){
        try{
            /* VALIDATE */
            //$cashRegister->delete();
            $this->emit('toast-message', ['msg' => 'Caja Eliminada', 'icon' =>'success']);
        } catch (Exception $ex) {
            $this->emit('toast-message', ['msg' => $ex->getMessage(), 'icon' => 'error']);
        } 
        $this->resetUI();
    }

    /* Reset params */
    public function resetUI(){
        $this->reset(['selectedId', 'name', 'status', 'branchId', 'search', 'formOpen']);
    }
}
