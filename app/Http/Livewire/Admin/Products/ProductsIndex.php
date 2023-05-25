<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class ProductsIndex extends Component
{
    /* Pagination & FileUpload */
    use WithPagination;
    use WithFileUploads;

    /* Params */
    public $title, $add, $selectedId, $name, $slug, $description, $barcode, $cost, $price, $qty, 
            $lowStock, $status, $brandId, $categoryId, $brands = [],
            $search, $formOpen;

    /* update query Search */
    public function updatingSearch(){
        $this->resetPage();
    }

    public function mount(){
        $this->title = 'PRODUCTOS';
        $this->add = 'Producto';
        $this->search = '';
        $this->formOpen = false;
    }

    public function render()
    {
        /* Filter Items */
        $items = Product::where('name', 'LIKE', '%'.$this->search.'%')
                        ->orWhere('description', 'LIKE', '%'.$this->search.'%')
                        ->orWhere('barcode', 'LIKE', '%'.$this->search.'%')
                        ->orWhereHas('brand', function(Builder $q){
                            $q->where('name', 'LIKE', '%'.$this->search.'%');
                        })
                        ->paginate(40);
        /* Get Categories */
        $categories = Category::where('status', true)->get();
        /* Main view w/params */
        return view('livewire.admin.products.products-index', ['items' => $items,
                                                                'categories' => $categories])
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
        /* Validation */
        $rules = ['name' => 'required',
                    'categoryId' => 'required',
                    'description' => 'required',
                    'barcode' => 'required',
                    //'cost' => 'required',
                    //'qty' => 'required',
                    'price' => 'required',
                    'brandId' => 'required',
                ];
        $messages = ['name.required' => 'El nombre del Productgo es requerido',
                        'categoryId.required' => 'El nombre de la Categoría para el producto es requerido',
                        'description.required' => 'La descripción del Producto es requerida',
                        'barcode.required' => 'El código de barras para el Producto es requerido',
                        //'cost.required' => 'El costo del Producto es requerido',
                        //'qty.required' => 'La cantidad del Productgo en Almacén es requerida',
                        'price.required' => 'El precio del Productgo es requerido',
                        'brandId.required' => 'La marca del Productgo es requerida',
                    ];
        $this->validate($rules, $messages);
        /* store record */
        try{
            $product = Product::create(['name' => $this->name,
                                            'slug' => Str::slug($this->name),
                                            'category_id' => $this->categoryId,
                                            'description' => $this->description,
                                            'barcode' => $this->barcode,
                                            'cost' => $this->cost,
                                            'qty' => $this->qty,
                                            'low_stock' => $this->lowStock,
                                            'price' => $this->price,
                                            'brand_id' => $this->brandId,
                                        ]);
            /* Toast */
            $this->emit('toast-message', ['msg' => 'Producto ['.$product->name.'] creado correctamente', 'icon' =>'success']);            
        }catch(Exception $ex){
            $this->emit('toast-message', ['msg' => $ex->getMessage(), 'icon' => 'error']);
        }
        /* RESET params */
        $this->resetUI();
    }

    /* Show Form [with Info] */
    public function edit(Product $product){
        /* RESET params */
        $this->resetUI();
        /* SET params */
        $this->selectedId = $product->id; 
        $this->name = $product->name; 
        $this->description = $product->description; 
        $this->barcode = $product->barcode;
        $this->cost = $product->cost; 
        $this->price = $product->price; 
        $this->qty = $product->qty; 
        $this->lowStock = $product->low_stock;
        $this->status = $product->status; 
        $this->categoryId = $product->category->id;
        $this->brandId = $product->brand->id; 
        $this->brands = $product->category->brands;
        $this->formOpen = true;
    }

    /* setBrands by Category */
    public function setBrands(){
        $this->brands = Category::find($this->categoryId)->brands;
    }

    /* update record */
    public function update(){
        /* Validation */
        $rules = ['name' => 'required',
                    'categoryId' => 'required',
                    'description' => 'required',
                    'barcode' => 'required',
                    //'cost' => 'required',
                    //'qty' => 'required',
                    'price' => 'required',
                    'brandId' => 'required',
                ];
        $messages = ['name.required' => 'El nombre del Productgo es requerido',
                        'categoryId.required' => 'El nombre de la Categoría para el producto es requerido',
                        'description.required' => 'La descripción del Producto es requerida',
                        'barcode.required' => 'El código de barras para el Producto es requerido',
                        //'cost.required' => 'El costo del Producto es requerido',
                        //'qty.required' => 'La cantidad del Productgo en Almacén es requerida',
                        'price.required' => 'El precio del Productgo es requerido',
                        'brandId.required' => 'La marca del Productgo es requerida',
                    ];
        $this->validate($rules, $messages);
        $product = Product::find($this->selectedId);
        /* store record */
        try{
            $product->update(['name' => $this->name,
                                'slug' => Str::slug($this->name),
                                'category_id' => $this->categoryId,
                                'description' => $this->description,
                                'barcode' => $this->barcode,
                                'cost' => $this->cost,
                                'qty' => $this->qty,
                                'low_stock' => $this->lowStock,
                                'price' => $this->price,
                                'brand_id' => $this->brandId,
                            ]);
            /* Toast */
            $this->emit('toast-message', ['msg' => 'Producto ['.$product->name.'] creado correctamente', 'icon' =>'success']);            
        }catch(Exception $ex){
            $this->emit('toast-message', ['msg' => $ex->getMessage(), 'icon' => 'error']);
        }
        /* RESET params */
        $this->resetUI();
    }

    /* RESET params */
    public function resetUI(){
        $this->reset([
                        'selectedId', 'name', 'slug', 'description', 'barcode', 'cost', 'price', 'qty', 
                        'lowStock', 'status', 'brandId', 'categoryId', 'brandId', 'brands',
                        'search', 'formOpen'
                    ]);
    }
}
