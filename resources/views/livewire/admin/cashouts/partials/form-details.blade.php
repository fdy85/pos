<x-dialog-modal wire:model="formDetailsOpen">
    <x-slot name="title">
        <div class="b-divider flex justify-between">
            <div>{{ $date }} | Detalles</div>
            <div>Apertura: ${{ $cashStart }}</div>
        </div>
    </x-slot>

    <x-slot name="content">
        <div class="mx-2 max-h-56 overflow-y-auto">
            
            <table class="small-table">
                <thead>
                    <tr>
                        <th>Cant.</th>
                        <th  class="text-center">Cliente</th>
                        <th  class="text-center">Total</th>
                        <th  class="text-center">Efectivo</th>
                        <th  class="text-center">Cambio</th>
                        <th  class="text-center">Estatus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                    <tr>
                        <td>{{ $sale['qty'] }}</td>
                        <td  class="text-center">{{ $sale['client']['name'] }}</td>
                        <td  class="text-center">$ {{ $sale['total'] }}</td>
                        <td  class="text-center">$ {{ $sale['cash'] }}</td>
                        <td  class="text-center">$ {{ $sale['change'] }}</td>
                        
                        <td  class="text-center"> 
                        {{-- Call status component --}}
                            <x-common.item-status :status="$item->status" />
                        </td>
                    </tr> 
                    @endforeach
                </tbody>
                
            </table>
            <div>
                <x-label value="Comentarios" />
                <x-input type="text" class="form-input" rows="4" value="{{ $comments }}" />
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        
        {{-- Common form actions --}}
        <button wire:click.prevent="resetUI" type="button" class="btn btn-close">Cerrar</button>
        @if(!$status)
        <button wire:click.prevent="partialWithdrawal" type="button" class="btn btn-save">
            Retiro Parcial
        </button>
        <button wire:click.prevent="store" type="button" class="btn btn-save">
            Verificar
        </button>
        @endif

    </x-slot>
</x-dialog-modal>