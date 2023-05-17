<?php

namespace App\Http\Livewire\Admin\Companies;

use App\Models\Company;
use Exception;
use Livewire\Component;

class CompaniesIndex extends Component
{
    public $title, $add, $selectedId, 
            $name, $address, $rfc, $status, 
            $formOpen;

    public function mount(){
        $this->title = 'EMPRESAS';
        $this->add = 'Empresa';
        $this->selectedId = 0;
        $this->formOpen = false;
    }

    public function render()
    {
        $items = Company::where('status', true)->get();

        return view('livewire.admin.companies.companies-index',['items' => $items])
                ->extends('layouts.app')
                ->section('content');
    }

    /* Show Form [with Info] */
    public function edit(Company $company){
        $this->resetUI();
        $this->selectedId = $company->id;
        $this->name = $company->name;
        $this->address = $company->address; 
        $this->rfc = $company->rfc; 
        $this->status = $company->status; 
        $this->formOpen = true;
    }

    /* Update record */
    public function update(){
        /* get Info */
        $company = Company::find($this->selectedId);
        /* Validation */
        $rules = ['name' => 'required',
                    'address' => 'required',
                    'rfc' => 'required'];
        $messages = ['name.required' => 'El nombre de la Empresa es requerido',
                    'address.required' => 'La dirección de la Empresa es requerida',
                    'rfc.required' => 'El RFC de la Empresa es requerido'];
        $this->validate($rules, $messages);
        /* Update */
        try{
            $company->update(['name' => $this->name,
                            'address' => $this->address,
                            'rfc' => 'required']);
            /* Toast */
            $this->emit('toast-message', ['msg' => 'Información de Empresa Actualizada!', 'icon' => 'success']);
        } catch (Exception $ex) {
            $this->emit('toast-message', ['msg' => $ex->getMessage(), 'icon' => 'error']);
        }
        $this->resetUI();
    }

    public function resetUI(){
        $this->reset(['selectedId', 
                    'name', 'address', 'rfc', 'status',
                    'formOpen']);
    }

}
