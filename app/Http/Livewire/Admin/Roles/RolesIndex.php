<?php

namespace App\Http\Livewire\Admin\Roles;

use App\Models\User;
use Exception;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesIndex extends Component
{
    public $title, $add, $selectedId, $name, $rolePermissions = [], 
            $search, $formOpen;

    public function mount(){
        $this->title = 'ROLES';
        $this->add = 'Role';
        $this->search = '';
        $this->formOpen = false;
    } 

    public function render()
    {
        $items = Role::all();
        //$categories = ;
        $cats = array_unique(Permission::orderBy('category', 'ASC')->get()->pluck('category')->toArray());
        //dd($cats);
        $permissions = Permission::all('id', 'name', 'desc', 'category')->toArray();
        //dd($this->permissions);
        //dd($this->permissions);
        return view('livewire.admin.roles.roles-index', ['items' => $items,
                                                        'cats' => $cats,
                                                        'permissions' => $permissions])
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
        /* validation */
        $rules = ['name' => 'required'];
        $messages = ['name.required' => 'El nombre del Role es requerido'];
        $this->validate($rules, $messages);
        /* store Role */
        try{
            $role = Role::create(['name' => $this->name]);
            /* Sync selected permissions */
                $role->syncPermissions($this->rolePermissions);
                $this->emit('toast-message', ['msg' => 'Role ['.$role->name.'] Creado!', 'icon' =>'success']);
            } catch (Exception $ex) {
                $this->emit('toast-message', ['msg' => $ex->getMessage(), 'icon' => 'error']);
            }
            $this->resetUI();
    }
    
    /* show Form [with Info] */
    public function edit(Role $role){
        $this->resetUI();
        $this->selectedId = $role->id;
    /* get Role's permissions */
        $arrs = $role->permissions;
        foreach($arrs as $arr){
            array_push($this->rolePermissions, $arr->id);
        }
        $this->name = $role->name;
        $this->formOpen = true;  
    }

    /* update record */
    public function update(){
        /* validation */
        $rules = ['name' => 'required'];
        $messages = ['name.required' => 'El nombre del Role es requerido'];
        $this->validate($rules, $messages);
        /* Update Role */
        try{
        /* Find selected Role */
            $role = Role::find($this->selectedId);
            $role->update(['name' => $this->name]);
        /* Delete current permissions */
            $role->syncPermissions();
        /* Sync selected permissions */
            $role->syncPermissions($this->rolePermissions);
            $this->emit('toast-message', ['msg' => 'Role Actualizado!', 'icon' =>'success']);
        } catch (Exception $ex) {
            $this->emit('toast-message', ['msg' => $ex->getMessage(), 'icon' => 'error']);
        }
        $this->resetUI();
    }

    /* delete record [listener] */
    public function destroy(Role $role){
    /* Get all users with Role */
        $users = User::role($role->name)->get();
        if($users->count()){
        /* Validate */
            $this->emit('toast-message', ['msg' => $users->count().' Usuarios Activos con este Role. Imposible Eliminar', 'icon' =>'warning']);
        }else{
            try{
                $role->update(['status' => false]);
                $this->emit('toast-message', ['msg' => 'Usuario Deshabilitado', 'icon' =>'success']);
            } catch (Exception $ex) {
                $this->emit('toast-message', ['msg' => $ex->getMessage(), 'icon' => 'error']);
            } 
        }
        $this->resetUI();
    }

    public function resetUI(){
        $this->reset(['selectedId', 'name', 'rolePermissions', 'search', 'formOpen']);
    }
}
