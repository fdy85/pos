<x-jet-dialog-modal wire:model="formDetailsOpen">
        <x-slot name="title">
            <div class="b-divider">
                DETALLES DE VENTA | # <strong>{{$selectedId }}</strong>
            </div>
        </x-slot>

        <x-slot name="content">
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th  class="text-center">Precio</th>
                        <th  class="text-center">Cantidad</th>
                        <th  class="text-center">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td  class="text-center">$ {{ number_format($item->price, 2, '.', ',') }}</td>
                        <td  class="text-center">{{ $item->qty }}</td>
                        <td  class="text-center">$ {{ $item->qty * $item->price }}</td>
                    </tr>  
                    
                    @endforeach
                    <tr>
                        <td class="text-center" colspan="2">Totales</td>
                        <td class="text-center"><strong>{{ $saleDetailsItemsQty }}</strong></td>
                        <td class="text-center"><strong>$ {{ $saleDetailsTotalMoney }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </x-slot>

        <x-slot name="footer">
            {{-- Common form actions --}}
            <x-common.modal-footer-buttons />
        </x-slot>
</x-jet-dialog-modal>