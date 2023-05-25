<div class="mx-2 flex-1 relative top-0 z-50">
    <div class="flex-1 ">
        <x-input wire:model.deboucing.200ms="searchProduct" type="text" class="w-full" placeholder="Ingrese Producto" />

        <button wire:click.prevent="findProductInformation({{ $searchProduct }})" class="absolute top-0 right-0 bg-slate-500 w-12 h-full rounded-r-md">
            <x-common.search size="text-xxl" color="text-white" />
        </button>
    </div>
    @if ($productsList)
    <div class=" max-h-56 bg-white absolute top-10 w-full overflow-y-auto">
        <ul>
            @foreach ($productsList as $product)
            @php
                $images = $product->images->first();
                $image = $images != null 
                ? $images->url
                : 'noImg.jpg';    
            @endphp
            
            <li wire:click.prevent="selectProduct({{ $product['id'] }})" 
                class="flex mx-3 my-1 text-xxl text-slate-400 hover:bg-slate-200 hover:text-sky-700 cursor-pointer" 
                value="{{ $product['id'] }}" 
            >
                <img class=" w-16 h-16 object-cover object-center" @if ($image != null) src="{{ Storage::url($image) }}" @endif alt="">
                <span class="ml-6">{{ $product['name'] }}</span>
                
            </li>
            @endforeach
        </ul>
    </div>    
    @endif
    

    @include('livewire.welcome.partials.form')
</div>
