<x-dialog-modal wire:model="formOpen">
        <x-slot name="title">
            <div class="b-divider">
                {{ $title}} | {{$selectedId==0?'CREAR':'ACTUALIZAR' }}
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="flex my-3 justify-between items-center">
                <div class="flex-col w-full">
                    <x-label value="Nombre de la Empresa" />
                    <x-input type="text" wire:model.lazy="name" placeholder="Nombre de la Empresa" class="form-input" />
                {{-- Error Msg by Validation --}}        
                    <x-input-error for="name" />
                </div>
                
            </div>
            <div class="my-3">
                <x-label value="Dirección" />
                <x-input type="text" wire:model.lazy="address" placeholder="Dirección" class="form-input" />
            {{-- Error Msg by Validation --}}        
                <x-input-error for="address" />
            </div>
            <div class="my-3">
                <x-label value="RFC" />
                <x-input type="text" wire:model.lazy="rfc" placeholder="RFC" class="form-input" />
            {{-- Error Msg by Validation --}}        
                <x-input-error for="rfc" />
            </div>
        </x-slot>

        <x-slot name="footer">
            {{-- Common form actions --}}
            <x-common.modal-footer-buttons />
        </x-slot>
</x-dialog-modal>