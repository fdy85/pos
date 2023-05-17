<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Brand;
use App\Models\Category;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class CategoriesIndex extends Component
{
    use WithPagination;
    
    public $title, $add, $selectedId, $name, $slug, $status, $icon, $checkBrands = [], $products = [],
            $search, $formOpen;

    /* update query Search */
    public function updatingSearch(){
        $this->resetPage();
    }

    public function mount(){
        $this->title = 'CATEGORÍAS';
        $this->add = 'Categoría';
        $this->search = '';
        $this->formOpen = false;
    }

    public function render()
    {
        $items = Category::where('status', true)
                                ->where('name', 'LIKE', '%'.$this->search.'%')
                                ->paginate(20);
        $brands = Brand::all();

        return view('livewire.admin.categories.categories-index', ['items' => $items,
                                                                    'brands' => $brands])
                    ->extends('layouts.app')
                    ->section('content');
    }

    /* Show Form */
    public function showForm(){
        $this->resetUI();
        $this->formOpen = true;
    }

    /* store record */
    public function store(){
        /* Validation */
        $rules = ['name' => 'required'];
        $messages = ['name.required' => 'El nombre de la Categoría es requerido'];
        $this->validate($rules, $messages);
        /* store record */
        try{
            if(count($this->checkBrands)){
                $category = Category::create(['name' => $this->name,
                                            'slug' => Str::slug($this->name)
                                            ]);
                /* Brands & Toast */
                $category->brands()->sync($this->checkBrands);
                $this->emit('toast-message', ['msg' => 'Categoría ['.$category->name.'] y marcas relacionadas a ['.$category->name.'] fueron actualizadas', 'icon' =>'success']);
            }else{
                $this->emit('toast-message', ['msg' => 'La Categoría ['.$this->name.'] no puede quedar sin marcas relacionadas', 'icon' =>'error']);
                return;
            }
        }catch(Exception $ex){
            $this->emit('toast-message', ['msg' => $ex->getMessage(), 'icon' => 'error']);
        }
        $this->resetUI();
    }

    /* Show Form [with Info] */
    public function edit(Category $category){
        $this->resetUI();
        $this->selectedId = $category->id;
        $this->name = $category->name;
        $this->status = $category->status;

        //get Brands & Products
        if($category->brands->count()){
            foreach($category->brands as $brand){
                array_push($this->checkBrands, $brand->id);
            }
        }
        $this->products = $category->products;
        $this->formOpen = true;
    }

    /* Update record */
    public function update(){
        /* get Info */
        $category = Category::find($this->selectedId);
        /* Validation */
        $rules = ['name' => 'required'];
        $messages = ['name.required' => 'El nombre de la Categoría es requerido'];
        $this->validate($rules, $messages);
        /* Update */
        try{
            if(count($this->checkBrands)){
                $category->update(['name' => $this->name,
                                    'slug' => Str::slug($this->name)
                                ]);
                /* Brands & Toast */
                if(count($this->checkBrands) <> $category->brands->count()){
                    /* BUG same # of brands but different brand names */
                    $category->brands()->detach();
                    $category->brands()->sync($this->checkBrands);
                    $this->emit('toast-message', ['msg' => 'Categoría ['.$category->name.'] y marcas relacionadas a ['.$category->name.'] fueron actualizadas', 'icon' =>'success']);
                }else{
                    $this->emit('toast-message', ['msg' => 'Categoría ['.$category->name.'] actualizada', 'icon' =>'success']);
                }
            }else{
                $this->emit('toast-message', ['msg' => 'La Categoría ['.$category->name.'] no puede quedar sin marcas relacionadas', 'icon' =>'error']);
                return;
            }
                        
        }catch(Exception $ex){
            $this->emit('toast-message', ['msg' => $ex->getMessage(), 'icon' => 'error']);
        }
        $this->resetUI();
    }

    public function resetUI(){
        $this->reset(['selectedId', 'name', 'slug', 'status', 'icon', 'checkBrands', 'products',
                    'search', 'formOpen']);
    }
}
