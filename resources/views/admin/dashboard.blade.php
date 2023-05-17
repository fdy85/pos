<x-app-layout>
    <x-common.main-content sucursal="Sucursal">
        <x-slot name="content">
            <div class="flex">
                <x-common.dashboard-card></x-common.dashboard-card>
                <x-common.dashboard-card color="bg-green-400"></x-common.dashboard-card>
                <x-common.dashboard-card color="bg-orange-300"></x-common.dashboard-card>
            </div>
        </x-slot>
    </x-common.main-content>
</x-app-layout>
