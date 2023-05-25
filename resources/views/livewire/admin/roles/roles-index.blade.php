<div class="w-full">
    <x-common.main-content sucursal='{{ auth()->user()->branchOffice->name }}' >
        <x-slot name="content">
            <x-common.component-index-header title="{{ $title }}" add="{{ $add }}" />

            <x-common.searchBar />

            @if ($items->count())
            {{-- card -table --}}
            <div class="mx-2">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Role</th>
                            <th class="text-center" colspan="2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>
                                <div class="flex justify-between">
                                    <div>{{ $item->name }}</div>
                                {{-- Call Badge Quantity Component --}}
                                    <div> <x-common.badge-qty :qty=" $item->users->count().' Usuarios' " /> </div>    
                                </div>
                            </td>
                            <td colspan="2">
                            {{-- Actions with Permissions --}}
                                <x-common.basic-item-actions :itemId="$item->id" editPermission="admin.roles.edit" destroyPermission="admin.roles.destroy" />
                            </td>
                        </tr>  
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="mx-4 mt-4 border-t-2 border-sky-700 text-lg">
                No hay Elementos para mostrar
            </div>
            @endif
        </x-slot>
    </x-common.main-content>
{{-- Modal --}}
    @include('livewire.admin.roles.partials.form')
</div>