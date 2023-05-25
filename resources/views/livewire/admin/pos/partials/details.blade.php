
    <div>
        @livewire('admin.pos.searching-by-code')
        @if (count($cart))
        <table class="small-table">
            <thead>
                <tr>
                    <th width="12%">Imagen</th>
                    <th  class="text-center">Producto</th>
                    <th  class="text-center">Marca</th>
                    <th  class="text-center">Precio</th>
                    <th width="12%" class="text-center">Qty</th>
                    <th  class="text-center">Subtotal</th>
                    <th  class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $item)
                <tr>
                    <td class="flex justify-center">
                        <img class="w-14 max-h-20 object-cover object-center" src="{{ Storage::url($item->options->image) }}" alt="img">    
                    </td>
                    <td class="text-center">{{ $item->name }}</td>
                    <td class="text-center">{{ $item->options->brand }}</td>
                    <td class="text-center">$ {{ $item->price }}</td>
                    <td class="text-center">
                        <x-input onchange="updateQty('{{ $item->rowId }}', '{{ $item->id }}', this.value)" type="number" step="1" value="{{ $item->qty }}" class="w-20" />
                    </td>
                    <td class="text-center">$ {{ $item->options->subtotal }}</td>
                    <td class="text-center"> 
                        <a wire:click.prevent="cartRemoveItem('{{ $item->rowId }}')" title="Eliminar {{ $item->name }}" class="cursor-pointer">
                            <i class="fas fa-trash mx-2 text-red-700 text-md md:text-lg"></i>   
                        </a>
                    </td>
                </tr>  
                @endforeach
            </tbody>
        </table>

        @else
        <div class="p-2 bg-white text-lg text-sky-800 text-center border border-sky-600">
            Escanear Productos para iniciar la venta!!
        </div>
        @endif
    </div>

    <script>
        /* UPDATING Qty by Product */
        function updateQty(rowId, id, qty){
            @this.modifyQty(rowId, id, qty);
            document.getElementById('scanCode').focus();
        }
    </script>
