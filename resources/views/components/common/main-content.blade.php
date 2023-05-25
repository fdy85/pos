@props(['sucursal'])
<div class="main-card ">
    <div class=" pb-1">
        <div class="flex justify-between mx-4">
            <div class="flex items-center">
                <span class="font-thin text-lg mr-1 text-gray-500">Sucursal </span>
                <span class="font-thin text-lg ml-1 text-sky-800">| {{ $sucursal }}</span>
            </div>
            <div class="flex items-center">
                <span class="font-thin text-lg mr-1 text-gray-500">{{ auth()->user()->name }}</span> 
                <span class="font-thin text-lg ml-1 text-sky-800"> | {{ auth()->user()->level }}</span>
            </div>
            
        </div>
        {{ $content }}
        
        {{-- Footer --}}
        <div class="flex flex-1 justify-between mx-6 text-xs text-slate-500">
            <div>Sistema POS todos los derechos reservados c 2023</div>
            <div>v1 <i class="fas fa-heart text-sky-800"></i></div> 
        </div>
    </div>
</div>