<x-jet-dialog-modal wire:model="formOpen">
        <x-slot name="title">
            <div class="b-divider">
                {{ $title}} | {{$selectedId==0?'CREAR':'ACTUALIZAR' }}
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="flex my-3 justify-between items-center">
                <div @if ($selectedId > 0) class="flex-col w-3/4 mr-2" @else class="flex-col w-full" @endif>
                    <x-jet-label value="Nombre de la Categoría" />
                    <x-jet-input type="text" wire:model="name" placeholder="Nombre de la Categoría" class="form-input" />
                {{-- Error Msg by Validation --}}        
                    <x-jet-input-error for="name" />
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

            {{-- Brands Related --}}
            @include('livewire.admin.categories.partials.brands-related')

            {{-- Products Related --}}
            @if ($selectedId > 0 && count($products))
                @include('livewire.admin.categories.partials.products-related')
            @endif

            
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