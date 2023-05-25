<x-dialog-modal wire:model="formOpenCashRegister">
        <x-slot name="title">
            <div class="b-divider">
                {{ $title}} | {{$selectedId==0?'CREAR':'ACTUALIZAR' }}
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="flex my-3 justify-between items-center">
                <div @if ($selectedId > 0) class="flex-col w-3/4 mr-2" @else class="flex-col w-full" @endif>
                    <x-label value="Nombre del Producto" />
                    <x-input type="text" wire:model="name" placeholder="Nombre del Producto" class="form-input" />
                {{-- Error Msg by Validation --}}        
                    <x-input-error for="name" />
                </div>
                @if ($selectedId > 0)
                <div class="flex-col border-l-2 md:border-none">
                    <span class="mx-4 ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                        @if($status)Activo @else Inactivo @endif
                    </span>
                    <label class="mx-auto cursor-pointer flex justify-center">
                        @if ($status)
                        <input type="checkbox" checked wire:change="$set('status', 0)" class="sr-only peer">    
                        @else
                        <input type="checkbox" wire:change="$set('status', 1)" class="sr-only peer">    
                        @endif
                    {{-- Call status component --}}
                        <x-common.form-input-switch />
                    </label>
                </div>
                @endif
            </div>

            <div class="flex my-3">
                <div class=" w-full">
                    <x-label value="Categoría" />
                    <select wire:model.lazy="categoryId" wire:change="setBrands" class="form-input">
                        <option value="null" selected disabled >Categoría</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" >{{ $category->name }}</option>
                        @endforeach
                    </select>
                {{-- Error Msg by Validation --}}        
                    <x-input-error for="categoryId" />
                </div>
            </div>

            <div class="flex my-3">
                <div class=" w-full">
                    <x-label value="Descripción del Producto" />
                    <x-input type="text" wire:model="description" placeholder="Descripción del Producto" class="form-input" />
                {{-- Error Msg by Validation --}}        
                    <x-input-error for="description" />
                </div>
            </div>

            <div class="flex my-3">
                <div class=" w-full">
                    <x-label value="Código de Barras para del Producto" />
                    <x-input type="text" wire:model="barcode" placeholder="Código de Barras para del Producto" class="form-input" />
                {{-- Error Msg by Validation --}}        
                    <x-input-error for="barcode" />
                </div>
            </div>

            <div class="flex my-3">
                <div class="flex-col w-1/4 mr-2">
                    <x-label value="Costo" />
                    <div class="flex w-full">
                        <span class="flex items-center whitespace-nowrap rounded-l border border-r-0 border-solid border-neutral-300 px-1 md:px-3 py-[0.25rem] text-center text-xs md:text font-normal leading-[1.6] text-neutral-700 dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200">
                            $
                        </span>
                        <input class="form-input" type="number" step=".01" wire:model="cost" placeholder="Costo" >
                    </div>
                {{-- Error Msg by Validation --}}        
                    <x-input-error for="cost" />
                </div>
                <div class="flex-col w-1/4 mx-1">
                    <x-label value="Cantidad" />
                    <div class="flex w-full">
                        <span class="flex items-center whitespace-nowrap rounded-l border border-r-0 border-solid border-neutral-300 px-1 md:px-3 py-[0.25rem] text-center text-xs md:text font-normal leading-[1.6] text-neutral-700 dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200">
                            $
                        </span>
                        <input class="form-input" type="number" step=".01" wire:model="qty" placeholder="Cantidad">
                    </div>
                {{-- Error Msg by Validation --}}        
                    <x-input-error for="qty" />
                </div>
                <div class="flex-col w-1/4 mx-1">
                    <x-label value="Precio" />
                    <div class="flex w-full">
                        <span class="flex items-center whitespace-nowrap rounded-l border border-r-0 border-solid border-neutral-300 px-1 md:px-3 py-[0.25rem] text-center text-xs md:text font-normal leading-[1.6] text-neutral-700 dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200">
                            $
                        </span>
                        <input class="form-input" type="number" step=".01" wire:model="price" placeholder="Cantidad">
                    </div>
                {{-- Error Msg by Validation --}}        
                    <x-input-error for="price" />
                </div>
                <div class="flex-col w-1/4 ml-2">
                    <x-label value="Alerta" />
                    <x-input type="number" step="1" wire:model="alert" placeholder="Alerta" class="form-input" />
                {{-- Error Msg by Validation --}}        
                    <x-input-error for="alert" />
                </div>
            </div>

            <div class="flex my-3">
                <div class=" w-full">
                    <x-label value="Marca" />
                    <select wire:model.lazy="brandId" class="form-input">
                        <option value="null" selected disabled >Marca</option>
                        @foreach ($brands as $brand)
                        <option value="{{ $brand['id'] }}" >{{ $brand['name'] }}</option>
                        @endforeach
                    </select>
                {{-- Error Msg by Validation --}}        
                    <x-input-error for="brandId" />
                </div>
            </div>

            <div class="flex my-3">
                <div class="w-full">
                    <x-label value="Imagen" />
                    <x-input type="file" class="form-input" />
                {{-- Error Msg by Validation --}}        
                    <x-input-error for="image" />
                </div>
            </div>
            @if ($selectedId > 0 && $status == 0)
            <div>
                <span class="error-msg">Si Desactiva el Producto, toda la información relacionada será deshabilitada</span>
            </div>
            @endif
        </x-slot>

        <x-slot name="footer">
            {{-- Common form actions --}}
            <x-common.modal-footer-buttons />
        </x-slot>
</x-dialog-modal>