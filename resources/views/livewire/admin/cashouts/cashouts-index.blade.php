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
                            <th>Corte</th>
                            <th  class="text-center">Caja Registradora</th>
                            <th  class="text-center">Apertura</th>
                            <th  class="text-center">Total</th>
                            <th  class="text-center" colspan="2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>
                                <div class="flex justify-between items-center">
                                    <span>{{ $item->date }}</span>
                                    {{-- Call status component --}}
                                <x-common.item-cashout-status :status="$item->status" />
                                </div>
                            </td>
                            <td  class="text-center">{{ $item->cashRegister->name }}</td>
                            <td  class="text-center">$ {{ $item->cash_start }}</td>
                            <td  class="text-center">$ {{ $item->total }}</td>
                            <td colspan="2" class="table-actions items-center">
                            {{-- Actions --}}
                                @if (!$item['status'])
                                <x-common.basic-item-actions :itemId="$item->id" editPermission="admin.users.edit" destroyPermission="admin.users.destroy" />    
                                @endif
                                
                                <a wire:click.prevent="showDetailsForm({{ $item->id }})" class="px-4 h-full flex justify-center items-center text-sky-900 cursor-pointer font-semibold" 
                                    title="Corte # {{ $item['date'] }}">
                                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    </svg>
                                </a>
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
    @include('livewire.admin.cashouts.partials.form')
    @include('livewire.admin.cashouts.partials.form-details')
</div>