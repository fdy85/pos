<x-dialog-modal wire:model="formOpen">
    <x-slot name="title">
        <div class="b-divider flex justify-between">
            <div>{{ $title}} | {{$selectedId==0?'CREAR':'ACTUALIZAR' }}</div>
            <div><x-common.item-cashout-status @if ($selectedId>=1) :status="$status" @endif /></div>
            
        </div>
    </x-slot>

    <x-slot name="content">
        <div class="flex my-3 justify-between items-center">
            <div class="flex-col w-full">
                <x-label value="Título" />
                <x-input type="text" wire:model="date" placeholder="Fecha" class="form-input" disabled />
            {{-- Error Msg by Validation --}}        
                <x-input-error for="date" />
            </div>
        </div>

        <div class="my-3">
            <x-label value="Caja Registradora" />
            <select wire:model.lazy="cashRegisterId" class="form-input">
                <option value="null" selected disabled >Seleccione la Caja a Aperturar..</option>
                @foreach ($cashRegisters as $cashRegister)
                <option value="{{ $cashRegister->id }}" >{{ $cashRegister->name }}</option>
                @endforeach
            </select>
        {{-- Error Msg by Validation --}}        
            <x-input-error for="cashRegisterId" />
        </div>

        <div class="my-3">
            <x-label value="Aperturar caja con" />
            <div class="flex w-full">
                <span class="flex items-center whitespace-nowrap rounded-l border border-r-0 border-solid border-neutral-300 px-1 md:px-3 py-[0.25rem] text-center text-xs md:text font-normal leading-[1.6] text-neutral-700 dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200">
                    $
                </span>
                <input class="form-input" type="number" step=".01" wire:model="cashStart" placeholder="Aperturar caja con">
            </div>
        {{-- Error Msg by Validation --}}        
            <x-input-error for="cashStart" />
        </div>
    </x-slot>

    <x-slot name="footer">
        {{-- Common form actions --}}
        <x-common.modal-footer-buttons />
    </x-slot>
</x-dialog-modal>