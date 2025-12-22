@if ($paginator->hasPages())
<?php
$first = $paginator->currentPage() - $paginator->onEachSide;
if ($first < 1) $first = 1;
$last = $paginator->currentPage() + $paginator->onEachSide;
if (($paginator->lastPage() - $last) < 0) $last = $paginator->lastPage();
?>
<div class="pagination">
    @if ($first > 1)
        <a href="{{ $paginator->url(1) }}">1</a>
        @if ($first > 2)
            <span>...</span>
        @endif
    @endif
    @for ($i = $first; $i <= $last; $i++)
        @if ($i==$paginator->currentPage())
            <span>{{ $i }}</span>
        @else
            <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
        @endif
    @endfor
    @if (($paginator->lastPage() - $last) > 0)
        @if (($paginator->lastPage() - $last) > 1)
            <span>...</span>
        @endif
        <a href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
    @endif
</div>
@endif