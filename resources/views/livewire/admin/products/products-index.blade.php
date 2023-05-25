<div class="w-full">
    <x-common.main-content sucursal='{{ auth()->user()->branchOffice->name }}' >
        <x-slot name="content">
            <x-common.component-index-header title="{{ $title }}" add="{{ $add }}"  />

            <x-common.searchBar />

            @if ($items->count())
            {{-- card -table --}}
            <div class="mx-2">
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th  class="text-center">Descripción</th>
                            <th  class="text-center">Imagen</th>
                            <th  class="text-center">Costo</th>
                            <th  class="text-center">Ctd.</th>
                            <th  class="text-center">Precio</th>
                            <th  class="text-center">Marca</th>
                            <th  class="text-center">Estatus</th>
                            <th  class="text-center" colspan="2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td  class="text-center">{{ substr($item->description, 0, 20) }} @if ( Str::length($item->description) > 20) .. @endif </td>
                            <td  class="text-center">
                                @if ($item->images->count())
                                <img class="w-14 max-h-20 object-cover object-center" src="{{ Storage::url($item->images[0]->url) }}" alt="img">    
                                @else
                                <img class="w-14 max-h-20 object-cover object-center" src="{{ Storage::url('products/NoImg.png') }}" alt="">
                                @endif
                                
                            </td>
                            <td  class="text-center">$ {{ $item->cost }}</td>
                            <td  class="text-center">{{ $item->qty }}</td>
                            <td  class="text-center">$ {{ $item->price }}</td>
                            <td  class="text-center">{{ $item->brand->name }}</td>
                            
                            <td  class="text-center"> 
                            {{-- Call status component --}}
                                <x-common.item-status :status="$item->status" />
                            </td>
                            <td colspan="2">
                            {{-- Actions --}}
                                <x-common.basic-item-actions :itemId="$item->id" editPermission="admin.users.edit" destroyPermission="admin.users.destroy" />
                            </td>
                        </tr>  
                        @endforeach
                    </tbody>
                </table>
            </div>
        {{-- Links --}}
            <div class="flex justify-start">
                {{ $items->links() }}
            </div>
            @else
            <div class="divider">
                <x-common.no-items-found />
            </div>
            @endif
        </x-slot>
    </x-common.main-content>
{{-- Modal --}}
    @include('livewire.admin.products.partials.form')
</div>