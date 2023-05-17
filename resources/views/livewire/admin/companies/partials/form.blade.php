<x-jet-dialog-modal wire:model="formOpen">
        <x-slot name="title">
            <div class="b-divider">
                {{ $title}} | {{$selectedId==0?'CREAR':'ACTUALIZAR' }}
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="flex my-3 justify-between items-center">
                <div class="flex-col w-full">
                    <x-jet-label value="Nombre de la Empresa" />
                    <x-jet-input type="text" wire:model.lazy="name" placeholder="Nombre de la Empresa" class="form-input" />
                {{-- Error Msg by Validation --}}        
                    <x-jet-input-error for="name" />
                </div>
                
            </div>
            <div class="my-3">
                <x-jet-label value="Dirección" />
                <x-jet-input type="text" wire:model.lazy="address" placeholder="Dirección" class="form-input" />
            {{-- Error Msg by Validation --}}        
                <x-jet-input-error for="address" />
            </div>
            <div class="my-3">
                <x-jet-label value="RFC" />
                <x-jet-input type="text" wire:model.lazy="rfc" placeholder="RFC" class="form-input" />
            {{-- Error Msg by Validation --}}        
                <x-jet-input-error for="rfc" />
            </div>
        </x-slot>

        <x-slot name="footer">
            {{-- Common form actions --}}
            <x-common.modal-footer-buttons />
        </x-slot>
</x-jet-dialog-modal>