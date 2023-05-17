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
        #printed_ticket h1{
            font-size: 1.5em;
            color: #222;
        }
        #printed_ticket h2{
            font-size: 0.9em;
        }
        #printed_ticket h3{
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }
        #printed_ticket p{
            font-size: 1.2.em;
            font-weight: 300;
            line-height: 1.2em;
            color: #666;
        }
        #ticket_detail{
            width: 100%;
        }
        #ticket_detail th{
            text-align: center;
        }
        #ticket_detail td{
            text-align: center;
        }
        #ticket_detail .items{
            font-size: 0.9em;
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
            <button type="button" class="py-1 w-1/2 border-none bg-green-600 text-white cursor-pointer items-center hover:bg-green-700" 
            onClick="sendToPrint()" >
                Original
            </button>
            <button type="button" class="py-1 w-1/2 border-none bg-red-600 text-white cursor-pointer items-center hover:bg-red-700" 
            onClick="sendToPrintCopy()" >
                Copia
            </button>
        </div> 
        <div>
        {{-- Show All Information --}}
            @if($sale)

            <div class="w-full">
            {{-- Header --}}
                <div class="flex justify-center my-2">
                    <img class="w-28 h-10" src="">
                </div>
                <div class="flex-col w-full justify-center my-2">
                    <div class="flex justify-center">Sonora #2426  -  Col Guerrero</div>
                    <div class="flex justify-center">(867)-719-0649 / (867)-753-3911</div>
                </div>
            {{-- ONLY FOR Copy Ticket --}}
                <div id="copyHeader" class="flex-col w-full justify-center bg-black text-white mx-auto hidden"><strong>Copia  -  Copia  -  Copia  -  Copia  -  Copia</strong></h2>
            </div>
            <div class="flex-col px-2">
            {{-- INFO --}}
                <div class="flex justify-center">
                    <div class="text-xl font-semibold">Venta #{{ $sale->id }}</div>
                </div>
            {{-- Date parsed --}}
                <div>Fecha: {{ $carbon::parse($sale->created_at)->format('d-m-Y H:m:s') }}</div>
                <div>Tipo de Folio: Venta Directa</div>
                <div>Cliente: Público en General</div>
                <div>Atendió: {{ $sale->user->name }}</div>
            </div>    
            <div class="w-full flex-col my-2 px-1">
            {{-- Ticket --}}
                <table class="table-ticket">
                    <thead class="table-ticket-divider">
                        <tr>
                            <th>Material</th>
                            <th>Costo</th>
                            <th>Peso</th>
                            <th>Subtot.</th>
                        </tr>
                    </thead>
                    <tbody class="table-ticket-divider">
                        @foreach ($sale->saleDetails as $item)
                        <tr>
                        {{-- Material or Item by folio_type --}}
                           {{--  @if($currentFolio->folio_type == 'Compra')
                            <td>{{ $weight->material->name }}</td>
                            @else
                            <td>{{ $weight->item->name }}</td>
                            @endif
                            <td>${{ $weight->cost }}</td>
                            <td>{{ $weight->weight }}</td>
                            <td>${{ $weight->weight * $weight->cost }}</td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table> 
                <div class="mx-2 flex justify-end">
                {{-- Folio's TOTAL --}}
                    <div class="text-xl font-semibold">Total: ${{ $sale->total }}</div>
                </div>
            {{-- ONLY FOR Copy Ticket --}}
                <div id="copySign" class="flex-col mt-4 hidden">
                        <div class="flex justify-center">______________________________</div>
                        <div class="flex justify-center">Firma</div>
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
