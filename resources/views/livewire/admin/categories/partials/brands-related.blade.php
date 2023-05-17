<div class="card p-4 my-1" x-data="{isCardOpen:false}">
    {{-- BRANDS W/Alpine functionality --}}
    <div>
        <div class="flex justify-between" x-bind:class="isCardOpen ? 'divider mb-5' : ''">
            <div :class="{'b-divider text-center':isCardOpen}" class=" w-full text-lg text-sky-900">Marcas Relacionadas</div>
            <div>
                <div><i x-show="isCardOpen" @click="isCardOpen = !isCardOpen" class="fa-solid fa-angle-up text-sky-900 cursor-pointer hover:text-slate-300" title="Contraer Marcas"></i></div>
                <div><i x-show="!isCardOpen" @click="isCardOpen = !isCardOpen" class="fa-solid fa-angle-down text-sky-900 cursor-pointer hover:text-slate-300" title="Desplegar Marcas"></i></div>
            </div>
        </div>

        <div x-show="isCardOpen" class="grid grid-cols-2 md:grid-cols-3 gap-1 md:gap-6">
            @foreach ($brands as $brand)
                <div class="flex-cols text-sm px-2 hover:bg-sky-50">
                    <span>
                        <input type="checkbox" wire:model.lazy="checkBrands" value="{{ $brand->id }}" >
                        <span class="ml-2">{{ $brand->name }}</span>
                    </span>
                </div>
                
            @endforeach
        </div>
    </div>
</div>