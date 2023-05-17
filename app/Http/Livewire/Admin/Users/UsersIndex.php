<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\BranchOffice;
use App\Models\Client;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Rules\Role;
use Livewire\Component;
use Livewire\Livewire;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role as ModelsRole;

class UsersIndex extends Component
{
    use WithPagination;

    public $title, $add, $selectedId,
            $name, $email, $cel, $password, $status, $level, $role,
            $search, $formOpen;

    public function mount(){
        $this->search = '';
        $this->title = 'USUARIOS';
        $this->add = 'Usuario';
        $this->formOpen = false;
        if($this->selectedId > 0){
            $this->edit(User::find($this->selectedId));
        }
    }

    /* update query Search */
    public function updatingSearch(){
        $this->resetPage();
    }

    /* GET Parameter from URL if exists */
    protected $queryString = ['selectedId'];

    /* Listeners */
    protected $listeners = ['destroy' ];

    public function render()
    {
        $users = User::where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('email', 'like', '%'.$this->search.'%')
                        ->orWhere('cel', 'like', '%'.$this->search.'%')
                        ->paginate(20);

        $roles = ModelsRole::all();

        return view('livewire.admin.users.users-index', 
                                                    ['items' => $users, 
                                                    'roles' => $roles])
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
                'email' => 'required|email',
                'cel' => 'required',
                'password' => 'required|min:8',
                'role' => 'required',
                ];
        $messages = ['name.required' => 'El nombre es requerido',
                    'name.min' => 'El nombre debe contener al menos 6 caracteres',
                    'email.required' => 'El correo Electronico es requerido',
                    'email.email' => 'El correo electronico debe tener formato de Correo Electronico',
                    'cel.required' => 'El celular del Usuario es requerido',
                    'password.required' => 'La contraseña es requerida',
                    'password.min' => 'La contraseña debe contener al menos 8 caracteres',
                    'role.required' => 'El tipo de Role es requerido',
                    ];
        $this->validate($rules, $messages);
        /* store record */
        try {
            $newUser = User::create(['name' => $this->name,
                                    'email' => $this->email,
                                    'cel' => $this->cel,
                                    'password' => Hash::make($this->password),
                                    'level' => $this->level,
                                    ]);
            /* Assign Role */
            $newUser->assignRole($this->role);
            /* Email */
            /* Toast */
            $this->emit('toast-message', ['msg' => 'Usuario ['.$newUser->name.'] creado correctamente!', 'icon' => 'success']);
            
        } catch (Exception $ex) {
            $this->emit('toast-message', ['msg' => $ex->getMessage(), 'icon' => 'error']);
        }
        $this->resetUI();
    }

    /* show Form [with Info] */
    public function edit(User $user){
        $this->resetUI();
        $this->selectedId = $user->id; 
        $this->name = $user->name;
        $this->email = $user->email;
        $this->cel = $user->cel;
        $this->status = $user->status;
        $this->level = $user->level;
        $this->role = $user->getRoleNames();    //Get 1st RoleNmae
        $this->formOpen = true;
    }

    /* update record */
    public function update(){
        /* Validation */
        $rules = ['name' => 'required|min:6',
                    'email' => 'required|email',
                    'role' => 'required',
                ];
        $messages = ['name.required' => 'El nombre es requerido',
                    'name.min' => 'El nombre debe contener al menos 6 caracteres',
                    'email.required' => 'El correo Electronico es requerido',
                    'email.email' => 'El correo electronico debe tener formato de Correo Electronico',
                    'role.required' => 'El tipo de Role es requerido',
                    ];
        $this->validate($rules, $messages);
        /* find record */
        $user = User::find($this->selectedId);
        /* update record */
        try{
            $user->update(['name' => $this->name,
                            'email' => $this->email,
                            'cel' => $this->cel,
                            'level' => $this->role[0],  //get 1st roleName
                            'status' => $this->status,
                        ]);
            /* Sync roles */
            $user->syncRoles($this->role);
            /* Toast */
            $this->emit('toast-message', ['msg' => 'Usuario ['.$user->name.'] Actualizado!', 'icon' =>'success']);
        } catch (Exception $ex) {
            $this->emit('toast-message', ['msg' => $ex->getMessage(), 'icon' => 'error']);
        }
        $this->resetUI();
    }

    /* delete record [listener] */
    public function destroy(User $user){
        try{
            $user->delete();
            $this->emit('toast-message', ['msg' => 'Usuario Eliminado', 'icon' =>'success']);
            
            
        } catch (Exception $ex) {
            $this->emit('toast-message', ['msg' => $ex->getMessage(), 'icon' => 'error']);
        } 
        $this->resetUI();
    }

    public function resetUI(){
        $this->reset(['selectedId', 'name', 'email', 'cel', 'password', 'status', 'level', 'role',
                        'search', 'formOpen']);
    }
}
