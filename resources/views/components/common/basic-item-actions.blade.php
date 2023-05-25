{{-- Actions receiving permissions --}}
@props(['itemId', 'editPermission', 'destroyPermission'])
<div class="table-actions">
{{-- Permissions --}}
    {{-- @can($editPermission) --}}
    <a wire:click.prevent="edit({{ $itemId }})" title="Modificar" class="cursor-pointer">
        <i class="fa-regular fa-pen-to-square mx-2 text-sky-900 text-md md:text-lg"></i>
    </a>
    {{-- @endcan --}}
{{-- Permissions --}}
    {{-- @can($destroyPermission) --}}
    <a onclick="ConfirmDestroy({{ $itemId }})" title="Eliminar" class="cursor-pointer">
        <i class="fas fa-trash mx-2 text-red-700 text-md md:text-lg"></i>   
    </a>
    {{-- @endcan --}}
</div>