<x-dialog-modal wire:model="formOpen">
        <x-slot name="title">
            <div class="divider">
                {{ $title}} | {{$selectedId==0?'CREAR':'ACTUALIZAR' }}
            </div>
        </x-slot>

        <x-slot name="content">
        {{-- FORM --}}
            <div class="my-3">
                <x-label value="Nombre del Role" />
                <x-input type="text" wire:model.lazy="name" placeholder="Nombred del Role" class="form-input" />      
            {{-- Error Msg by Validation --}}        
                <x-input-error for="name" />          
            </div>
            <div class="my-3 grid grid-cols-2 gap-2">
                <div class="w-full text-center col-span-2 text-xl">PERMISOS</div>
            {{-- Permissions --}}
            
                @foreach ($cats as $cat)
                <div class="border-2 border-sky-700 px-2 pb-2 rounded-lg shadow-lg">
                    <div class="b-divider flex-1 justify-center text-center text-lg">
                        {{ucfirst(substr($cat, 1, strlen($cat)))}}
                    </div>
                
                    @foreach ($permissions as $permission)
                        @if (strpos($permission['name'], $cat) !== false)
                        <div class="text-sm my-2">
                            <span>
                                <input type="checkbox" wire:model.lazy="rolePermissions" value="{{ $permission['id'] }}" >
                                <span class="ml-2">{{ $permission['desc'] }}</span>
                            </span>
                        </div>
                        @endif       
                    @endforeach
                </div>
                @endforeach
                
            </div>
        </x-slot>

        <x-slot name="footer">
        {{-- Common form actions --}}
            <x-common.modal-footer-buttons />
        </x-slot>
</x-dialog-modal>