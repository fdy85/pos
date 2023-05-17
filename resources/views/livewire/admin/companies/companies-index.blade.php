<div class="w-full">
    <x-common.main-content sucursal='Sucursal' >
        <x-slot name="content">
            <x-common.component-index-header title="{{ $title }}"  />

            <x-common.searchBar />

            {{-- table --}}
            <div class="mx-2">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Empresa</th>
                            <th  class="text-center">Dirección</th>
                            <th  class="text-center">RFC</th>
                            <th  class="text-center">Estatus</th>
                            <th  class="text-center" colspan="2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td  class="text-center">{{ $item->address }}</td>
                            <td  class="text-center">{{ $item->rfc }}</td>
                            <td  class="text-center"> 
                            {{-- Call Status Component --}}
                                <x-common.item-status :status="$item->status" />
                            </td>
                            <td colspan="2">
                            {{-- Actions with Permissions --}}
                                <x-common.basic-item-actions :itemId="$item->id" editPermission="admin.companies.edit" destroyPermission="admin.companies.destroy" />
                            </td>
                        </tr>  
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-slot>
    </x-common.main-content>




    

    {{-- Modal --}}
    @include('livewire.admin.companies.partials.form')
</div>
