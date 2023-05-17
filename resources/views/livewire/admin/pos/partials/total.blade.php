{{-- TOTALES --}}
<div class="p-1">
    <div class="border-b border-sky-700 text-center text-base">{{ $summary }}</div>
    <div class="w-full my-2 bg-white rounded-md shadow-md">
        <div class="flex-col">
            <div class="flex justify-between pb-1 px-4">
                <span>Articulos:</span>
                <span># {{ $totalItems ? $totalItems : 0 }}</span>
            </div>
            <div class="flex justify-between py-1 px-4">
                <span>Subtotal:</span>
                <span>$ {{ $subtotal ? $subtotal : 0 }}</span>
            </div>
            <div class="flex justify-between py-1 px-4">
                <span>Iva:</span>
                <span>$ {{ $iva ? $iva : 0 }}</span>
            </div>
            <div class="flex justify-between pt-1 px-4 text-lg font-semibold">
                <span>total:</span>
                <span>$ {{ $total ? $total : 0 }}</span>
            </div>
        </div>
    </div>
</div>