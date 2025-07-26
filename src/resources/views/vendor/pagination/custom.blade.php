@if ($paginator->hasPages())
    <nav class="pagination">
        <ul>
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li><span class="pagination__ellipsis">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li><span class="pagination__active">{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}" class="pagination__link">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </ul>
    </nav>
@endif