<div class="text-center">
    {{ $spanishName }} 
    @if ($sortColumn !== $columnName)
    <i class="fa-solid fa-arrow-down-up-across-line"></i>
    @elseif($sortDirection === 'ASC')
    <i class="fa-solid fa-chevron-down"></i>
    @else
    <i class="fa-solid fa-chevron-up"></i>
    @endif
</div>