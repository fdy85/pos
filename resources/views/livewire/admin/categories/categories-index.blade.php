<div class="w-full">
    <x-common.main-content sucursal='Sucursal' >
        <x-slot name="content">
            <x-common.component-index-header title="{{ $title }}" add="{{ $add }}"  />

            <x-common.searchBar />

            @if ($items->count())
            {{-- card -table --}}
            <div class="mx-2">
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>Categoría</th>
                            <th  class="text-center">Slug</th>
                            <th  class="text-center">Icon</th>
                            <th  class="text-center">Estatus</th>
                            <th  class="text-center" colspan="2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td  class="text-center">{{ $item->slug }}</td>
                            <td  class="text-center">{!! $item->icon !!}</td>
                            
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
                No hay Elementos para mostrar
            </div>
            @endif
        </x-slot>
    </x-common.main-content>
{{-- Modal --}}
    @include('livewire.admin.categories.partials.form')
</div>