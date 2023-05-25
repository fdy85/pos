{{-- TOTALES --}}
<div class="p-1">
    <div class="w-full my-2 bg-white rounded-md shadow-md">
        <div class="flex-col p-2">
            <div class="flex justify-between">
                <x-input wire:model="cash" type="number" step=".01" class="form-input font-bold text-lg" onclick="this.select()"/>
                <div class="px-4 bg-sky-700 text-lg flex items-center cursor-pointer">
                    <a href="javascript:void(0)" wire:click.prevent="resetCash">
                        <i class="fas fa-backspace text-white"></i>
                    </a>
                </div>
            </div>
            <div class="flex justify-between">
                <x-label class="p-2 text-slate-500 text-lg" value="Cambio:" />
                <x-label class="p-2 text-sky-800 text-xl" value="${{ $change }}" />
            </div>
            <div class="mt-2 flex justify-between">
                @if ($total > 0)
                <button wire:click.prevent="cartDestroy" class="px-2 py-1 bg-red-600 text-white text-base">Cancelar Venta</button>
                @endif
                @if ($total > 0 && $cash >= $total)
                <button wire:click.prevent="saveSale" wire:block="$total" class="px-2 py-1 bg-sky-700 text-white text-base">Guardar Venta</button>
                @endif
            </div>
        </div>
    </div>
</div>
