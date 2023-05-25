@props(['items', 'color1' => 'bg-lime-400', 'color2' => 'bg-lime-500'])
<div class="mb-4">
{{-- Only if exists records --}}
    @if ($items && $items->count())
    <div class="ml-1 -mt-2">
        <span class="relative flex h-2 w-2">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full {{ $color1 }} opacity-75"></span>
            <span class="relative inline-flex rounded-full h-2 w-2 {{ $color2 }}"></span>
        </span>
    </div>  
    @endif
</div>