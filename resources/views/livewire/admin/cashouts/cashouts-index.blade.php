@inject('carbon', '\Carbon\Carbon')
<div class="w-full">
    <x-common.main-content sucursal='Sucursal' >
        <x-slot name="content">
            <x-common.component-index-header title="{{ $title }}" />

            @livewire('admin.cashouts.seek-sales-by-cashier')

            <div class="mx-6 b-divider"></div>

            <div class="flex w-full my-4">
                <div class="w-1/4">
                    <div class="flex-col bg-sky-800 mx-4 text-white rounded-lg">
                        <div class="flex justify-between mx-4 pt-4 pb-1">
                            <span>Ventas Totales:</span>
                            @if (count($items))
                            <strong class="text-lg">$ {{ number_format($salesTotalMoney, 2, '.', ',') }}</strong>
                            @endif
                        </div>
                        <div class="flex justify-between mx-4 pt-1 pb-4">
                            <span>Total de Artículos:</span>
                            @if (count($items))
                            <strong class="text-lg">{{ $salesTotalQty }}</strong>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="w-3/4">
                    @if (count($items))
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Folio</th>
                                <th  class="text-center">Totals</th>
                                <th  class="text-center">Artículos</th>
                                <th  class="text-center">Estatus</th>
                                <th  class="text-center">Fecha</th>
                                <th  class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                            <tr>
                                <td>{{ $item['id'] }}</td>
                                <td  class="text-center">${{ number_format($item['total'], 2, '.', ',') }}</td>
                                <td  class="text-center">{{ $item['qty'] }}</td>
                                <td  class="text-center">{{ $item['status'] }}</td>
                                <td  class="text-center">{{ $carbon::parse($item['created_at'])->format('d-m-Y')  }}</td>
                                
                                <td>
                                {{-- Actions --}}
                                    <a wire:click.prevent="showDetailsForm({{ $item['id'] }})" class="px-4 h-full flex justify-center items-center text-sky-900 cursor-pointer font-semibold" title="Venta # {{ $item['id'] }}">
                                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                            <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>  
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div>
                        <span class="text-lg text-sky-800">Buscar ventas por Cajero y rango de fechas</span>
                    </div>
                    @endif
                    
                </div>
            </div>
        </x-slot>
    </x-common.main-content>

    {{-- Modal --}}
    @include('livewire.admin.cashouts.partials.form')
</div>
