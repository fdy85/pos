<div class="w-full">
    <x-common.main-content sucursal='{{ auth()->user()->branchOffice->name }}' >
        <x-slot name="content">
            <span class="flex mx-6 py-5 text-sky-800 text-xxl font-thin">Para iniciar la venta, es necesario Aperturar una caja!!</span>
        </x-slot>
    </x-common.main-content>
</div>
    
