@props(['title', 'add' => '', 'createPermission' => ''])
<div class="flex items-center justify-between mx-4 my-2">
    <div>
        <h3 class="text-xl text-sky-900">{{ $title }} | <span class="fs-4">Listado</span></h3>
    </div>
    @if (Str::length($add) > 0)
    <div>
        {{-- @can($createPermission) --}}
        <a wire:click="showForm" title="Crear {{ $add }}" 
            class="bg-sky-900 p-2 rounded-sm text-white cursor-pointer">+ {{ $add }}
        </a>    
        {{-- @endcan --}}
    </div>
    @endif
</div>