<x-dialog-modal wire:model="formOpen">
        <x-slot name="title">
            <div class="b-divider flex flex-1 justify-between">
                <div>
                    {{ $title}} | {{ $name }}
                </div>
                <div class="flex">
                    <span class="mx-4 ml-3 product-label-info">
                        @if($status)Activo @else Inactivo @endif
                    </span>
                </div>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="flex w-full my-5">
                <div class="flex-col w-1/4">
                    <x-label value="Categoría" class="product-label-title" />
                    <x-label value="{{ $category }}" class="product-label-info" />
                </div>
                <div class="flex-col w-1/4">
                    <x-label value="Marca" class="product-label-title" />
                    <x-label value="{{ $brand }}" class="product-label-info" />
                </div>
                <div class="flex-col w-1/4">
                    <x-label value="Cod. Barras" class="product-label-title" />
                    <x-label value="{{ $barcode }}" class="product-label-info" />
                </div>

                <div class="flex-col w-1/4">
                    <img class="w-20 max-h-20 object-cover object-center" @if($image != null) src="{{ Storage::url($image) }}" @endif alt="img">
                </div>
            </div>

            <div class="flex my-5">
                <div class=" w-full">
                    <x-label value="Descripción del Producto" class="product-label-title" />
                    <x-label value="{{ $description }}" class="product-label-info" />
                </div>
            </div>

            <div class="flex my-5">
                <div class="flex-col w-1/4 mx-1">
                    <x-label value="Existencias" class="product-label-title" />
                    <x-label value="{{ $qty }}" class="product-label-info" />
                </div>
                <div class="flex-col w-1/4 mr-2">
                    <x-label value="Costo" class="product-label-title" />
                    <x-label value="$ {{ $cost }}" class="product-label-info" />
                </div>
                <div class="flex-col w-1/4 mx-1">
                    <x-label value="Precio" class="product-label-title" />
                    <x-label value="$ {{ $price }}" class="product-label-info" />
                </div>
                <div class="flex-col w-1/4 ml-2">
                    <x-label value="Alerta" class="product-label-title" />
                    <x-label value="{{ $alert }}" class="product-label-info" />
                </div>
            </div>
        
        </x-slot>

        <x-slot name="footer">
            {{-- Common form actions --}}
            
        </x-slot>
</x-dialog-modal>