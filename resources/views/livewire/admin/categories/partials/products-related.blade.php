<div class="card p-4 my-1" x-data="{isCardOpen:false}">
    {{-- PRODUCTS W/Alpine functionality --}}
    <div>
        <div class="flex justify-between" x-bind:class="isCardOpen ? 'divider mb-5' : ''">
            <div :class="{'b-divider text-center':isCardOpen}" class="w-full text-lg text-sky-900">Productos Relacionados</div>
            <div>
                <div><i x-show="isCardOpen" @click="isCardOpen = !isCardOpen" class="fa-solid fa-angle-up text-sky-900 cursor-pointer hover:text-slate-300" title="Contraer Marcas"></i></div>
                <div><i x-show="!isCardOpen" @click="isCardOpen = !isCardOpen" class="fa-solid fa-angle-down text-sky-900 cursor-pointer hover:text-slate-300" title="Desplegar Marcas"></i></div>
            </div>
        </div>

        <div x-show="isCardOpen" class="flex-1">
            <div class="mx-2 max-h-56 overflow-y-auto">
    
                <table class="small-table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th  class="text-center">Costo</th>
                            <th  class="text-center">Qty</th>
                            <th  class="text-center">Precio</th>
                            <th  class="text-center">Marca</th>
                            <th  class="text-center">Estatus</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $product['name'] }}</td>
                            <td  class="text-center">$ {{ $product['cost'] }}</td>
                            <td  class="text-center">{{ $product['qty'] }}</td>
                            <td  class="text-center">$ {{ $product['price'] }}</td>
                            <td  class="text-center">{{ $product['brand']['name'] }}</td>
                            
                            <td  class="text-center"> 
                            {{-- Call status component --}}
                                <x-common.item-status :status="$item->status" />
                            </td>
                        </tr>  
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>