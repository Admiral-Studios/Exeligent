@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="page-item" data-page="{{ explode('page=', $paginator->previousPageUrl())[1] ?? '' }}">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @php
                $from = ($paginator->currentPage() - 1) * $paginator->perPage() + 1;
                $to = min($paginator->currentPage() * $paginator->perPage(), $paginator->total());
            @endphp
            <span class="text-results">{{ $from . '-' . $to }} of {{ $paginator->total() }} results</span>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item" data-page="{{ explode('page=', $paginator->nextPageUrl())[1] ?? '' }}">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
