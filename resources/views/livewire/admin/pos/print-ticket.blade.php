<div>
    {{-- Specific styles --}}
    <style>
        #printed_ticket{
            /* box-shadow: 0 0 1in -0.25in rgb(0, 0, 0.5); */
            padding: 1mm;
            margin: 0 auto;
            width: 80mm;
            height: auto;
            background: #fff;
        }
        
        #logo{
            height: 60px;
            width: 150px;
        }
    </style>

    {{-- Class Carbon for parse dates --}}
    @inject('carbon', 'Carbon\Carbon')
{{-- TICKET SIMULATOR --}}
    <div class="flex-col justify-center scroll-my-1" id="printed_ticket" >
    {{-- Buttons to Print Ticket [Original - Copy] --}}
        <div class="flex w-full" id="btnGroup"> 
            <button type="button" class="py-1 w-full border-none bg-sky-900 text-white cursor-pointer items-center hover:bg-sky-800" 
            onClick="sendToPrint()" >
                Imprimir
            </button>
            
        </div> 
        <div>
        {{-- Show All Information --}}
            @if($sale)

            <div class="w-full">
            {{-- Header --}}
                <div class="flex justify-center my-2">
                    <x-authentication-card-logo />
                </div>
                <div class="flex-col w-full justify-center my-2">
                    <div class="flex justify-center">Sonora #2426  -  Col Guerrero</div>
                    <div class="flex justify-center">(867)-719-0649 / (867)-753-3911</div>
                </div>
            </div>
            <div class="flex-col px-2">
            {{-- INFO --}}
                <div class="flex justify-center">
                    <div class="text-xl font-semibold">Venta #{{ $sale->id }}</div>
                </div>
            {{-- Date parsed --}}
                <div class="text-sm">Fecha: {{ $carbon::parse($sale->created_at)->format('d-m-Y H:m:s') }}</div>
                <div class="text-sm">Tipo de Folio: Venta Directa</div>
                <div class="text-sm">Cliente: Público en General</div>
                <div class="text-sm">Atendió: {{ $sale->user->name }}</div>
            </div>    
            <div class="w-full flex-col my-2 px-1">
            {{-- Ticket --}}
                <table class="table-ticket">
                    <thead class="table-ticket-divider">
                        <tr>
                            <th >Producto</th>
                            <th >Ctd</th>
                            <th >Precio</th>
                            <th >Subtot.</th>
                        </tr>
                    </thead>
                    <tbody class="table-ticket-divider">
                        @foreach ($sale->saleDetails as $item)
                        <tr>
                        {{-- Items --}}
                            <td class="text-sm">{{ $item->product->name }}</td>
                            <td class="text-center">{{ $item->qty }}</td>
                            <td class="text-center">${{ $item->price }}</td>
                            <td class="text-center">${{ $item->price * $item->qty }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table> 
                <div class="mx-2 flex-1 flex-col">
                {{-- Folio's TOTAL --}}
                    <div class="flex justify-end">Sub-Total: $ {{ $sale->subtotal }}</div>
                    <div class="flex justify-end">IVA: ${{ $sale->iva }}</div>
                    <div class="flex justify-end text-xl font-semibold">Total: ${{ $sale->total }}</div>
                </div>
            {{-- Slogan --}}
                <div class="mt-3 flex-col">
                    <div class="flex justify-center">************************************</div>
                    <div class="flex justify-center text-center">Gracias por comprar con Nosotros!!</div>
                </div>
            @endif
            </div>           
        </div>
    </div>
</div>
