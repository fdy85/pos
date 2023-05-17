<x-jet-dialog-modal wire:model="formOpen">
        <x-slot name="title">
            <div class="b-divider">
                {{ $title}} | {{$selectedId==0?'CREAR':'ACTUALIZAR' }}
            </div>
        </x-slot>

        <x-slot name="content">
            @if ($selectedId > 0)
            <div class="my-3 flex justify-between items-center">
                <div class="flex-col">
                    <div>
                        <x-jet-label value="{{ $item->company->name }} [ {{ $item->company->rfc }} ]" />
                        <x-jet-label value="" />
                    </div>
                </div>
                <div class="flex-col just md:flex border-l-2 md:border-none">
                    <span class="mx-4 ml-3 text-sm font-medium text-sky-900 dark:text-gray-300">
                        @if($status)Activa @else Inactiva @endif
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
            </div>   
            @endif
            
            <div class="my-3">
                <x-jet-label value="Nombre de la Sucursal" />
                <x-jet-input type="text" wire:model.lazy="name" placeholder="Nombre de la Sucursal" class="form-input" />
            {{-- Error Msg by Validation --}}        
                <x-jet-input-error for="name" />    
            </div>
            <div class="my-3">
                <x-jet-label value="Dirección" />
                <x-jet-input type="text" wire:model.lazy="address" placeholder="Dirección" class="form-input" />
            {{-- Error Msg by Validation --}}        
                <x-jet-input-error for="address" />   
            </div>
            <div class="my-3">
                <x-jet-label value="Teléfono" />
                <x-jet-input type="text" wire:model.lazy="phone" placeholder="Teléfono" class="form-input" />
            {{-- Error Msg by Validation --}}        
                <x-jet-input-error for="phone" />    
            </div>
            <div class="my-3">
                <x-jet-label value="Teléfono #2" />
                <x-jet-input type="text" wire:model.lazy="phone2" placeholder="Teléfono #2" class="form-input" />
            </div>
            @if ($selectedId > 0 && $status == 0)
            <div>
                <span class="error-msg">Si Desactiva la Sucursal, toda la información relacionada será deshabilitada</span>
            </div>
            @endif
        </x-slot>

        <x-slot name="footer">
            {{-- Common form actions --}}
            <x-common.modal-footer-buttons />
        </x-slot>
</x-jet-dialog-modal>