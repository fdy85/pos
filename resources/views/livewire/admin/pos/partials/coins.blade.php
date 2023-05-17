{{-- COINS --}}
<div x-data="{isDenominationsOpen:true }" class="p-1">
    <div class="border-b flex justify-between px-4 border-sky-700 text-base">
        <div @click="isDenominationsOpen= !isDenominationsOpen" class="cursor-pointer" title="Números"><i class="fas fa-calculator"></i></div>
        <div>{{ $coins }}</div>
        <div @click="isDenominationsOpen=true" class="cursor-pointer" title="Denominaciones"><i></i></div>
    </div>
    {{-- <div x-show="isDenominationsOpen" class="w-full my-2 bg-white rounded-md shadow-md">
        <div class="grid grid-cols-3">
            @foreach ($denominations as $d)
            <div class="m-1 flex-1 bg-sky-700 text-white">
                <button class="w-full p-1" wire:click.prevent="valueEntry({{ $d->id }})">
                    <span class="text-xs">{!!$d->icon!!}</span> 
                    <span class="text-xs">${{number_format($d->value,2)}}</span>
                </button>
            </div>
                
            @endforeach
            <div class="m-1 flex-1 bg-sky-700 text-white">
                <button wire:click.prevent="exact" class="w-full p-1">
                    <span class="text-sm font-bold">Exacto</span>
                </button>
            </div>
        </div>
    </div> --}}
    <div x-show="!isDenominationsOpen" class="w-full my-2 bg-white rounded-md shadow-md">
        <div class="grid grid-cols-3">
            <div class="m-1 flex-1 bg-sky-700 text-white">
                <button class="w-full p-1">
                    <span class="text-sm font-bold">7</span>
                </button>
            </div>
            <div class="m-1 flex-1 bg-sky-700 text-white">
                <button class="w-full p-1">
                    <span class="text-sm font-bold">8</span>
                </button>
            </div>
            <div class="m-1 flex-1 bg-sky-700 text-white">
                <button class="w-full p-1">
                    <span class="text-sm font-bold">9</span>
                </button>
            </div>
            <div class="m-1 flex-1 bg-sky-700 text-white">
                <button class="w-full p-1">
                    <span class="text-sm font-bold">4</span>
                </button>
            </div>
            <div class="m-1 flex-1 bg-sky-700 text-white">
                <button class="w-full p-1">
                    <span class="text-sm font-bold">5</span>
                </button>
            </div>
            <div class="m-1 flex-1 bg-sky-700 text-white">
                <button class="w-full p-1">
                    <span class="text-sm font-bold">6</span>
                </button>
            </div>
            <div class="m-1 flex-1 bg-sky-700 text-white">
                <button class="w-full p-1">
                    <span class="text-sm font-bold">1</span>
                </button>
            </div>
            <div class="m-1 flex-1 bg-sky-700 text-white">
                <button class="w-full p-1">
                    <span class="text-sm font-bold">2</span>
                </button>
            </div>
            <div class="m-1 flex-1 bg-sky-700 text-white">
                <button class="w-full p-1">
                    <span class="text-sm font-bold">3</span>
                </button>
            </div>
            <div class="m-1 flex-1 bg-sky-700 text-white">
                <button class="w-full p-1">
                    <span class="text-sm font-bold">0</span>
                </button>
            </div>
            <div class="m-1 flex-1 bg-sky-700 text-white">
                <button class="w-full p-1">
                    <span class="text-sm font-bold">.</span>
                </button>
            </div>
            <div class="m-1 flex-1 bg-sky-700 text-white">
                <button wire:click.prevent="exact" class="w-full p-1">
                    <span class="text-sm font-bold">Exacto</span>
                </button>
            </div>
        </div>
    </div>
</div>