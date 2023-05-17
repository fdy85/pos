<x-jet-dialog-modal wire:model="formOpen">
        <x-slot name="title">
            <div class="b-divider">
                {{ $title}} | {{$selectedId==0?'CREAR':'ACTUALIZAR' }}
            </div>
            
        </x-slot>

        <x-slot name="content">
            <div class="flex my-3 justify-between items-center">
                <div @if ($selectedId > 0) class="flex-col w-full md:w-1/2 mr-2" @else class="flex-col w-full" @endif>
                    <x-jet-label value="Nombre del Usuario" />
                    <x-jet-input type="text" wire:model.lazy="name" placeholder="Nombred Usuario" class="form-input" />
                {{-- Error Msg by Validation --}}        
                    <x-jet-input-error for="name" />
                </div>
                @if ($selectedId > 0)
                <div class="flex-col md:flex border-l-2 md:border-none">
                    <span class="mx-4 ml-3 text-sm font-medium text-sky-900 whitespace-nowrap">
                        @if($status)Activo @else Inactivo @endif
                    </span>
                    <label class="mx-auto cursor-pointer flex justify-center">
                        @if ($status)
                        <input type="checkbox" checked wire:change="$set('status', 0)" class="sr-only peer">    
                        @else
                        <input type="checkbox" wire:change="$set('status', 1)" class="sr-only peer">    
                        @endif
                        <x-common.form-input-switch />                     
                    </label>
                </div>
                @endif
            </div>
            
            <div class="my-3">
                <x-jet-label value="E-mail" />
                <x-jet-input type="text" wire:model.lazy="email" placeholder="E-mail" class="form-input" />
            {{-- Error Msg by Validation --}}        
                <x-jet-input-error for="email" />
            </div>
            <div class="my-3">
                <x-jet-label value="Celular" />
                <x-jet-input type="text" wire:model.lazy="cel" placeholder="Celular" class="form-input" />
            </div>
            <div class="my-3">
                <x-jet-label value="Role para el usuario" />
                <select wire:model.lazy="role" class="form-input">
                    <option value="" selected >Tipo de Role</option>
                    @foreach ($roles as $role)
                    <option value="{{ $role->name }}" >{{ $role->name }}</option>
                    @endforeach
                </select>
            {{-- Error Msg by Validation --}}        
                <x-jet-input-error for="role" />
            </div>
            <div class="my-3">
                @if ($selectedId == 0)
                <x-jet-label value="Contraseña" />
                <x-jet-input type="password" wire:model.lazy="password" placeholder="Contraseña" class="form-input" />
                @endif
            {{-- Error Msg by Validation --}}        
                <x-jet-input-error for="password" />
            </div>
            @if ($selectedId > 0 && $status == 0)
            <div>
                <span class="error-msg">Si Desactiva el Usuario, este no podrá iniciar sesión</span>
            </div>
            @endif
        </x-slot>

        <x-slot name="footer">
            {{-- Common form actions --}}
            <x-common.modal-footer-buttons />
        </x-slot>
</x-jet-dialog-modal>