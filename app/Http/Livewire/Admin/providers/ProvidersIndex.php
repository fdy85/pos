<?php

namespace App\Http\Livewire\Admin\Providers;

use App\Models\Provider;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class ProvidersIndex extends Component
{
    use WithPagination;

    public $title, $add, $selectedId, $name, $address, $email, $rfc, $cel, $phone, $status, $search,  $formOpen;

    public function mount(){
        $this->search = '';
        $this->title = 'PROVEEDORES';
        $this->add = 'Proveedor';
        $this->selectedId = 0;
        $this->formOpen = false;
    } 

    /* update query Search */
    public function updatingSearch(){
        $this->resetPage();
    }

    /* Listeners */
    protected $listeners = ['destroy' ];

    public function render()
    {
        $items = Provider::where('name', 'LIKE', '%'.$this->search.'%')
                        ->orWhere('email', 'LIKE', '%'.$this->search.'%')
                        ->orWhere('rfc', 'LIKE', '%'.$this->search.'%')
                        ->orWhere('cel', 'LIKE', '%'.$this->search.'%')
                        ->paginate(20);
        return view('livewire.admin.providers.providers-index', ['items' => $items])
                    ->extends('layouts.app')
                    ->section('content');
    }

    /* show-form */
    public function showForm(){
        $this->resetUI();
        $this->formOpen = true;
    }

    /* store record */
    public function store(){
        /* validation */
        $rules = ['name' => 'required|min:6',
                'address' => 'required',
                'email' => 'required|email',
                'rfc' => 'required',
                'cel' => 'required',
                ];
        $messages = ['name.required' => 'El nombre es requerido',
                    'name.min' => 'El nombre debe contener al menos 6 caracteres',
                    'address.required' => 'La direccón del cliente es requerida',
                    'email.required' => 'El correo Electronico es requerido',
                    'email.email' => 'El correo electronico debe tener formato de Correo Electronico',
                    'rfc.required' => 'El RFC del proveedor es requerido',
                    'cel.required' => 'El Cel del proveedor es requerido',
                    ];
        $this->validate($rules, $messages);
        /* store record */
        try {
            $provider = Provider::create([
                                    'name' => $this->name,
                                    'address' => $this->address, 
                                    'email' => $this->email, 
                                    'rfc' => $this->rfc, 
                                    'cel' => $this->cel, 
                                    'phone' => $this->phone,
                                    ]);
            /* Toast */
            $this->emit('toast-message', ['msg' => 'Proveedor ['.$provider->name.'] creado correctamente!', 'icon' => 'success']);
            
        } catch (Exception $ex) {
            $this->emit('toast-message', ['msg' => $ex->getMessage(), 'icon' => 'error']);
        }
        $this->resetUI();
    }

    /* show Form [with Info] */
    public function edit(Provider $provider){
        $this->resetUI();
        $this->selectedId = $provider->id;
        $this->name = $provider->name; 
        $this->address = $provider->address; 
        $this->email = $provider->email; 
        $this->rfc = $provider->rfc; 
        $this->cel = $provider->cel; 
        $this->phone = $provider->phone; 
        $this->status = $provider->status;
        $this->formOpen = true;
    }

    /* update record */
    public function update(){
        /* Validation */
        $rules = ['name' => 'required|min:6',
                'address' => 'required',
                'email' => 'required|email',
                'rfc' => 'required',
                'cel' => 'required',
                ];
        $messages = ['name.required' => 'El nombre es requerido',
                    'name.min' => 'El nombre debe contener al menos 6 caracteres',
                    'address.required' => 'La direccón del cliente es requerida',
                    'email.required' => 'El correo Electronico es requerido',
                    'email.email' => 'El correo electronico debe tener formato de Correo Electronico',
                    'rfc.required' => 'El RFC del proveedor es requerido',
                    'cel.required' => 'El Cel del proveedor es requerido',
                    ];
        $this->validate($rules, $messages);
        /* find record */
        $provider = Provider::find($this->selectedId);
        /* update record */
        try{
            $provider->update([
                            'name' => $this->name,
                            'address' => $this->address, 
                            'email' => $this->email, 
                            'rfc' => $this->rfc, 
                            'cel' => $this->cel, 
                            'phone' => $this->phone,
                            ]);
            /* Toast */
            $this->emit('toast-message', ['msg' => 'Información del Proveedor ['.$provider->name.'] fue Actualizada!', 'icon' =>'success']);
        } catch (Exception $ex) {
            $this->emit('toast-message', ['msg' => $ex->getMessage(), 'icon' => 'error']);
        }
        $this->resetUI();
    }

    /* delete record [listener] */
    public function destroy(Provider $provider){
        try{
            $provider->delete();
            $this->emit('toast-message', ['msg' => 'Proveedor Eliminado', 'icon' =>'success']);
            
            
        } catch (Exception $ex) {
            $this->emit('toast-message', ['msg' => $ex->getMessage(), 'icon' => 'error']);
        } 
        $this->resetUI();
    }

    /* Reset Params */
    public function resetUI(){
        $this->reset(['selectedId', 'name', 'address', 'email', 'rfc', 'cel', 'phone', 'status', 'search',  'formOpen']);
    }
}
