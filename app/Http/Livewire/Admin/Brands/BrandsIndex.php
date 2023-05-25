<?php

namespace App\Http\Livewire\Admin\Brands;

use App\Models\Brand;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class BrandsIndex extends Component
{
    /* Pagination */
    use WithPagination;
    
    /* params */
    public $title, $add, $selectedId, $name, $slug, $status, $search, $formOpen;

    /* update query Search */
    public function updatingSearch(){
        $this->resetPage();
    }

    public function mount(){
        $this->title = 'Marcas';
        $this->add = 'Marca';
        $this->search = '';
        $this->formOpen = false;
    }

    public function render()
    {
        $items = Brand::where('name', 'LIKE', '%'.$this->search.'%')
                        ->paginate(20);
        /* Main view */
        return view('livewire.admin.brands.brands-index', ['items' => $items])
                        ->extends('layouts.app')
                        ->section('content');
    }

    /* Show Form */
    public function showForm(){
        /* reset params */
        $this->resetUI();
        $this->formOpen = true;
    }

    /* store record */
    public function store(){
        /* Validation */
        $rules = ['name' => 'required'];
        $messages = ['name.required' => 'El nombre de la Marca es requerido'];
        $this->validate($rules, $messages);
        /* store record */
        try{
            $brand = Brand::create([
                                    'name' => $this->name,
                                    'slug' => Str::slug($this->name)
                                    ]);
            /* Toast */
            $this->emit('toast-message', ['msg' => 'Marca ['.$brand->name.'] Registrada', 'icon' =>'success']);
        }catch(Exception $ex){
            $this->emit('toast-message', ['msg' => $ex->getMessage(), 'icon' => 'error']);
        }
        $this->resetUI();
    }

    /* Show Form [with Info] */
    public function edit(Brand $brand){
        /* REESET params */
        $this->resetUI();
        /* SET params */
        $this->selectedId = $brand->id;
        $this->name = $brand->name;
        $this->status = $brand->status;
        $this->formOpen = true;
    }

    /* Update record */
    public function update(){
        /* get Info */
        $brand = Brand::find($this->selectedId);
        /* Validation */
        $rules = ['name' => 'required'];
        $messages = ['name.required' => 'El nombre de la Categoría es requerido'];
        $this->validate($rules, $messages);
        /* Update */
        try{
            $brand->update([
                            'name' => $this->name,
                            'slug' => Str::slug($this->name),
                            'status' => $this->status,
                            ]);
            /* Toast */
            $this->emit('toast-message', ['msg' => 'Marca ['.$brand->name.'] Actualizada', 'icon' =>'success']);
        }catch(Exception $ex){
            $this->emit('toast-message', ['msg' => $ex->getMessage(), 'icon' => 'error']);
        }
        /* RESET params */
        $this->resetUI();
    }

    public function resetUI(){
        $this->reset(['selectedId', 'name', 'slug', 'status', 'search', 'formOpen']);
    }
}
