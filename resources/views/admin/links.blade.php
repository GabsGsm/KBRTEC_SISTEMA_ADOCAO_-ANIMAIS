<ul class="pagination justify-content-end pt-4 pb-2">
    @if ($paginator->onFirstPage())
        <li class="page-item "><span class="page-link bg-custom border-dark link-light">Anterior</span></li>
    @else
        <li class="page-item"><a class="page-link bg-custom border-dark link-light" href="{{ $paginator->previousPageUrl() }}">Anterior</a></li>
    @endif

    @foreach ($elements as $element)
        @if (is_string($element))
            <li class="page-item disabled"><span class="page-link bg-custom border-dark link-light">{{ $element }}</span></li>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="page-item active"><span class="page-link bg-custom border-dark link-light">{{ $page }}</span></li>
                @else
                    <li class="page-item"><a class="page-link bg-custom border-dark link-light" href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach

    @if ($paginator->hasMorePages())
        <li class="page-item"><a class="page-link bg-custom border-dark link-light" href="{{ $paginator->nextPageUrl() }}">Próximo</a></li>
    @else
        <li class="page-item "><span class="page-link bg-custom border-dark link-light">Próximo</span></li>
    @endif
</ul>
