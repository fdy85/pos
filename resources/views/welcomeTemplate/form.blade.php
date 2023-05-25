<x-jet-dialog-modal wire:model="formOpen">
        <x-slot name="title">
            <div class="divider text-black">
                {{ $modalTitle }} | CONTACTO
            </div>
            
        </x-slot>

        <x-slot name="content">
            <div class="my-3">
                <x-jet-label value="Nombre del Contacto" />
                <x-jet-input type="text" wire:model="name" placeholder="Nombre del Contacto" class="form-input" />
                
                @error('name')
                <span class="error-msg">{{ $message }}</span>
                @enderror
                
            </div>
            <div class="my-3">
                <x-jet-label value="E-mail" />
                <x-jet-input type="email" wire:model="email" placeholder="E-mail" class="form-input" />

                @error('email')
                <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>
            <div class="my-3">
                <x-jet-label value="Asunto" />
                <x-jet-input type="text" wire:model="subject" placeholder="Asunto" class="form-input" />

                @error('subject')
                <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>
            <div class="my-3">
                <x-jet-label value="Mensaje" />
                <x-jet-input type="text" wire:model="msg" placeholder="Mensaje" class="form-input" />

                @error('msg')
                <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>
            
            
        </x-slot>

        <x-slot name="footer">
            {{-- Common form actions --}}
            <div class="flex justify-start">
                <button wire:click.prevent="sendContactForm" type="button" class="btn text-gray-700" >
                    Enviar!
                </button>
            </div>
        </x-slot>
</x-jet-dialog-modal>