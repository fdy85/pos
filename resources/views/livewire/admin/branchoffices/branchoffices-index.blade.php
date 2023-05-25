<div class="w-full">
    <x-common.main-content sucursal='{{ auth()->user()->branchOffice->name }}' >
        <x-slot name="content">
            <x-common.component-index-header title="{{ $title }}" add="{{ $add }}"  />

            <x-common.searchBar />

            {{-- table --}}
            @if ($items->count())
            <div class="mx-2">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sucursal</th>
                            <th  class="text-center">Dirección</th>
                            <th  class="text-center">Phone</th>
                            <th  class="text-center">Estatus</th>
                            <th  class="text-center" colspan="2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td  class="text-center">{{ $item->address }}</td>
                            <td  class="text-center">{{ $item->phone }}</td>
                            <td  class="text-center"> 
                            {{-- Call Status Component --}}
                                <x-common.item-status :status="$item->status" />
                            </td>
                            <td colspan="2">
                            {{-- Actions with Permissions --}}
                                <x-common.basic-item-actions :itemId="$item->id" editPermission="admin.branchofficces.edit" destroyPermission="admin.branchofficces.destroy" />
                            </td>
                        </tr>  
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="mx-4 mt-4 border-t-2 border-sky-700 text-lg">
                <x-common.no-items-found />
            </div>
            @endif
        </x-slot>
    </x-common.main-content>

    {{-- Modal --}}
    @include('livewire.admin.branchoffices.partials.form')
</div>
