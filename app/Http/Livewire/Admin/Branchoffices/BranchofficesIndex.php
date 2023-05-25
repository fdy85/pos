<?php

namespace App\Http\Livewire\Admin\Branchoffices;

use App\Models\BranchOffice;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class BranchofficesIndex extends Component
{
    use WithPagination;

    /* Params */
    public $title, $add, $selectedId, 
            $name, $address, $phone, $phone2, $status, 
            $search, $formOpen;

    public function mount(){
        $this->title = 'SUCURSALES';
        $this->add = 'Sucursal';
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
        $items = BranchOffice::where('status', true)
                            ->where('name', 'LIKE', '%'.$this->search.'%')
                            ->orWhere('address', 'LIKE', '%'.$this->search.'%')
                            ->orWhere('phone', 'LIKE', '%'.$this->search.'%')
                            ->paginate(10);
        /* Main View w/params */
        return view('livewire.admin.branchoffices.branchoffices-index', ['items' => $items])
                    ->extends('layouts.app')
                    ->section('content');
    }

    /* Show Form */
    public function showForm(){
        $this->resetUI();
        $this->formOpen = true;
    }

    /* Store record */
    public function store(){
        /* validation */
        $rules = ['name' => 'required',
                    'address' => 'required',
                    'phone' => 'required'];
        $messages = ['name.required' => 'El nombre de la Empresa es requerido',
                    'address.required' => 'La dirección de la Empresa es requerida',
                    'phone.required' => 'El teléfone de la Empresa es requerido'];
        $this->validate($rules, $messages);
        /* store record */
        try{
            $branchOffice = BranchOffice::create([
                                                    'name' => $this->name,
                                                    'address' => $this->address,
                                                    'phone' => $this->phone,
                                                    'phone2' => $this->phone2,
                                                    'modified_by' => Auth::id(),
                                                    'company_id' => 1,
                                                ]);
            /* Toast */
            $this->emit('toast-message', ['msg' => 'Sucursal ['.$branchOffice->name.'] creada correctamente', 'icon' =>'success']);
        }catch(Exception $ex){
            $this->emit('toast-message', ['msg' => $ex->getMessage(), 'icon' => 'error']);
        }
        /* Reset params */
        $this->resetUI();
    }

    /* Show Form [with Info] */
    public function edit(BranchOffice $branchOfficce){
        /* Reset params */
        $this->resetUI();
        /* Set params */
        $this->selectedId = $branchOfficce->id;
        $this->name = $branchOfficce->name;
        $this->address = $branchOfficce->address; 
        $this->phone = $branchOfficce->phone;
        $this->phone2 = $branchOfficce->phone2; 
        $this->status = $branchOfficce->status; 
        /* open Form */
        $this->formOpen = true;
    }

    public function update(){
        /* validation */
        $branchOffice = BranchOffice::find($this->selectedId);
        $rules = ['name' => 'required',
                    'address' => 'required',
                    'phone' => 'required'];
        $messages = ['name.required' => 'El nombre de la Empresa es requerido',
                    'address.required' => 'La dirección de la Empresa es requerida',
                    'phone.required' => 'El teléfone de la Empresa es requerido'];
        $this->validate($rules, $messages);
        /* update record */
        try{
            $branchOffice->update([
                                    'name' => $this->name,
                                    'address' => $this->address,
                                    'phone' => $this->phone,
                                    'phone2' => $this->phone2,
                                    'status' => $this->status,
                                    'modified_by' => Auth::id(),
                                    'company_id' => 1,
                                ]);
            /* Toast */
            $this->emit('toast-message', ['msg' => 'Sucursal ['.$branchOffice->name.'] actualizada correctamente', 'icon' =>'success']);
        }catch(Exception $ex){
            $this->emit('toast-message', ['msg' => $ex->getMessage(), 'icon' => 'error']);
        }
        $this->resetUI();
    }

    /* reset */
    public function resetUI(){
        $this->reset([
                        'selectedId', 
                        'name', 'address', 'phone', 'phone2', 'status',
                        'formOpen'
                    ]);
    }

}
