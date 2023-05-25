@props(['status'])
@if ($status)
<i class="text-red-600 fa-solid fa-lock fa-lg" title="Corte Cerrado"></i>
@else
<i class="text-green-600 fas fa-lock-open" title="Corte Abierto"></i>
@endif 