<?php

namespace App\Http\Livewire\Admin\Clients;

use App\Models\Client;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class ClientsIndex extends Component
{
    use WithPagination;

    public $title, $add, $selectedId, $name, $address, $email, $rfc, $cel, $phone, $status, $search,  $formOpen;

    public function mount(){
        $this->search = '';
        $this->title = 'CLIENTES';
        $this->add = 'Cliente';
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
        $items = Client::where('name', 'LIKE', '%'.$this->search.'%')
                        ->orWhere('email', 'LIKE', '%'.$this->search.'%')
                        ->orWhere('cel', 'LIKE', '%'.$this->search.'%')
                        ->paginate(20);
        return view('livewire.admin.clients.clients-index', ['items' => $items])
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
                ];
        $messages = ['name.required' => 'El nombre es requerido',
                    'name.min' => 'El nombre debe contener al menos 6 caracteres',
                    'address.required' => 'La direccón del cliente es requerida',
                    ];
        $this->validate($rules, $messages);
        /* store record */
        try {
            $client = Client::create([
                                    'name' => $this->name,
                                    'address' => $this->address, 
                                    'email' => $this->email, 
                                    'rfc' => $this->rfc, 
                                    'cel' => $this->cel, 
                                    'phone' => $this->phone,
                                    ]);
            /* Toast */
            $this->emit('toast-message', ['msg' => 'Cliente ['.$client->name.'] creado correctamente!', 'icon' => 'success']);
            
        } catch (Exception $ex) {
            $this->emit('toast-message', ['msg' => $ex->getMessage(), 'icon' => 'error']);
        }
        $this->resetUI();
    }

    /* show Form [with Info] */
    public function edit(Client $client){
        $this->resetUI();
        $this->selectedId = $client->id;
        $this->name = $client->name; 
        $this->address = $client->address; 
        $this->email = $client->email; 
        $this->rfc = $client->rfc; 
        $this->cel = $client->cel; 
        $this->phone = $client->phone; 
        $this->status = $client->status;
        $this->formOpen = true;
    }

    /* update record */
    public function update(){
        /* Validation */
        $rules = ['name' => 'required|min:6',
                'address' => 'required',
                ];
        $messages = ['name.required' => 'El nombre es requerido',
                    'name.min' => 'El nombre debe contener al menos 6 caracteres',
                    'address.required' => 'La direccón del cliente es requerida',
                    ];
        $this->validate($rules, $messages);
        /* find record */
        $client = Client::find($this->selectedId);
        /* update record */
        try{
            $client->update([
                            'name' => $this->name,
                            'address' => $this->address, 
                            'email' => $this->email, 
                            'rfc' => $this->rfc, 
                            'cel' => $this->cel, 
                            'phone' => $this->phone,
                            ]);
            /* Toast */
            $this->emit('toast-message', ['msg' => 'Información del cliente ['.$client->name.'] fue Actualizada!', 'icon' =>'success']);
        } catch (Exception $ex) {
            $this->emit('toast-message', ['msg' => $ex->getMessage(), 'icon' => 'error']);
        }
        $this->resetUI();
    }

    /* delete record [listener] */
    public function destroy(Client $client){
        try{
            $client->delete();
            $this->emit('toast-message', ['msg' => 'Cliente Eliminado', 'icon' =>'success']);
            
            
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
