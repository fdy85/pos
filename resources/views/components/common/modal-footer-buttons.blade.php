<div>
    <button wire:click.prevent="resetUI" type="button" class="btn btn-close">Cerrar</button>
    @if($this->selectedId == 0)
    <button wire:click.prevent="store" type="button" class="btn btn-save">
        Guardar
    </button>
    @else
    <button wire:click.prevent="update" type="button" class="btn btn-update">
        Actualizar
    </button>
    @endif
</div>