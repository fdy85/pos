<x-dialog-modal wire:model="formOpen">
    <x-slot name="title">
        <div class="b-divider">
            {{ $title}} | {{$selectedId==0?'CREAR':'ACTUALIZAR' }}
        </div>
    </x-slot>

    <x-slot name="content">
        <div class="flex my-3 justify-between items-center">
            <div @if ($selectedId > 0) class="flex-col w-3/4 mr-2" @else class="flex-col w-full" @endif>
                <x-label value="Nombre de la Caja" />
                <x-input type="text" wire:model="name" placeholder="Nombre de la Caja" class="form-input" />
            {{-- Error Msg by Validation --}}        
                <x-input-error for="name" />
            </div>
            @if ($selectedId > 0)
            <div class="flex-col border-l-2 md:border-none">
                <span class="mx-4 ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                    @if($status)Activo @else Inactivo @endif
                </span>
                <label class="mx-auto cursor-pointer flex justify-center">
                    @if ($status)
                    <input type="checkbox" checked wire:change="$set('status', 0)" class="sr-only peer">    
                    @else
                    <input type="checkbox" wire:change="$set('status', 1)" class="sr-only peer">    
                    @endif
                {{-- Call status component --}}
                    <x-common.form-input-switch />
                </label>
            </div>
            @endif
        </div>

        <div class="my-3">
            <x-label value="Sucursal" />
            <select wire:model.lazy="branchId" class="form-input">
                <option value="null" selected disabled >Sucursal..</option>
                @foreach ($branches as $branch)
                <option value="{{ $branch['id'] }}" >{{ $branch['name'] }}</option>
                @endforeach
            </select>
        {{-- Error Msg by Validation --}}        
            <x-input-error for="branchId" />
        </div>
        
        @if ($selectedId > 0 && $status == 0)
        <div>
            <span class="error-msg">Si Desactiva la Caja Registradora, Los cajeros no podrán seleccionarla</span>
        </div>
        @endif
    </x-slot>

    <x-slot name="footer">
        {{-- Common form actions --}}
        <x-common.modal-footer-buttons />
    </x-slot>
</x-dialog-modal>