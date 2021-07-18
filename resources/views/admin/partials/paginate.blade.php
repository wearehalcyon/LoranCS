@if ($paginator->lastPage() > 1)
    <nav class="pagination is-small" role="navigation" aria-label="pagination">
        <ul class="pagination-list">
            @if ($paginator->currentPage() != 1)
                <li>
                    <a href="{{ $paginator->url(1) }}" class="{{ ($paginator->currentPage() == 1) ? 'pagination-previous disabled' : 'pagination-previous' }}">Previous</a>
                </li>
            @endif()
            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                <li>
                    <a href="{{ $paginator->url($i) }}"  class="pagination-link" aria-label="Goto page {{ $i }}">{{ $i }}</a>
                </li>
            @endfor
            @if($paginator->currentPage() != $paginator->lastPage())
                <li>
                    <a href="{{ $paginator->url($paginator->currentPage()+1) }}"  class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? 'pagination-next disabled' : 'pagination-next' }}">Next</a>
                </li>
            @endif
        </ul>
    </nav>
@endif
