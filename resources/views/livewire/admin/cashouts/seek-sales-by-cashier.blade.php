<div class="w-full my-4">
    <div class="flex justify-between">
        <div class="flex">
            <div class="flex-col mx-4">
                <x-jet-label value="Cajeros" />
                <select wire:model.lazy="cashierId" wire:change="getSales" class="form-input">
                    <option value="null" selected disabled >Seleccione un Cajero</option>
                    @foreach ($cashiers as $cashier)
                    <option value="{{ $cashier->id }}" >{{ $cashier->name }}</option>
                    @endforeach
                </select>
            {{-- Error Msg by Validation --}}        
                <x-jet-input-error for="cashierId" />
            </div>
    
            <div class="flex-col mx-4">
                <x-jet-label value="Fecha Inicial" />
                <x-jet-input type="date" wire:model.lazy="initDate" class="form-input" />
                {{-- Error Msg by Validation --}}        
                <x-jet-input-error for="initDate" />
            </div>
    
            <div class="flex-col mx-4">
                <x-jet-label value="Fecha Final" />
                <x-jet-input type="date" wire:model.lazy="finishDate" class="form-input" />
                {{-- Error Msg by Validation --}}        
                <x-jet-input-error for="finishDate" />
            </div>

        </div>
        <div class="flex flex-1 justify-center items-center">
            <button class="btn btn-save" wire:click.prevent="getSales">Buscar</button>
            <button class="btn btn-save">Imprimir</button>
        </div>
        
    </div>
</div>
