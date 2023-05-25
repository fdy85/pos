@props(['status'])
@if ($status)
<i class="text-sky-900 fas fa-check fa-lg"></i>
@else
<i class="text-red-600 fas fa-times fa-lg"></i>
@endif 