<div>
    @if ($paginator->hasPages())
    @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : ($this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1))


    <ul class="news-pagination-wrap align-center mb-30 mt-30">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
            <a href="javascript:void(0)">
                <i class="ti-angle-left"></i>
            </a>

        </li>
        @else
        <li class="page-item">
            <a href="javascript:void(0)" type="button"
                dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                class="" wire:click="previousPage('{{ $paginator->getPageName() }}')"
                wire:loading.attr="disabled" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
        </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
        <li class="page-item disabled" aria-disabled="true">
            <span class="">
                <a href="javascript:void(0)">{{ $element }}</a>
            </span>
        </li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="page-item " wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page-{{ $page }}" aria-current="page">
            <span class="">
                <a href="javascript:void(0)" class="active">{{ $page }}</a>
            </span>
        </li>
        @else
        <li class="page-item" wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page-{{ $page }}">
            <a href="javascript:void(0)" type="button" class="" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')">{{ $page }}</a>
        </li>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li class="page-item">
            <a href="javascript:void(0)" type="button"
                dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                class="" wire:click="nextPage('{{ $paginator->getPageName() }}')"
                wire:loading.attr="disabled" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
        </li>
        @else
        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
            <span class="" aria-hidden="true">
                <a href="javascript:void(0)">&rsaquo;</a>
            </span>
        </li>
        @endif
    </ul>
    @endif
</div>
