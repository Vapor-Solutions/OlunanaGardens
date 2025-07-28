@php
if (! isset($scrollTo)) {
$scrollTo = 'body';
}

$scrollIntoViewJsSnippet = ($scrollTo !== false)
? <<<JS
    (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
    JS
    : '' ;
    @endphp

    <div>
    @if ($paginator->hasPages())
    <div class="row d-flex  ">
        <div class="col-md-12 text-center d-sm-none">
            <ul class="news-pagination-wrap align-center mb-30 mt-30">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                <li>
                    <a><i class="ti-angle-left"></i></a>
                </li>
                @else
                <li>
                    <a dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled">@lang('pagination.previous')</a>
                </li>
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                <li>
                    <a dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled">@lang('pagination.next')</a>
                </li>
                @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link" aria-hidden="true">@lang('pagination.next')</span>
                </li>
                <li class="disabled">
                    <a><i class="ti-angle-right"></i></a>
                </li>
                @endif
            </ul>
        </div>

        <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
            <div>
                <p class="small text-muted">
                    {!! __('Showing') !!}
                    <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
                    {!! __('of') !!}
                    <span class="fw-semibold">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <div class="col-md-12 text-center">
                <ul class="news-pagination-wrap align-center mb-30 mt-30">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                    <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <a><i class="ti-angle-left"></i></a>
                    </li>
                    @else
                    <li>
                        <a dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                    </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                    <li class="disabled" aria-disabled="true">
                        <a>{{ $element }}</a>
                    </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                    @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                    <li wire:key="paginator-{{ $paginator->getPageName() }}-page-{{ $page }}" aria-current="page">
                        <a class="active">{{ $page }}</a>
                    </li>
                    @else
                    <li wire:key="paginator-{{ $paginator->getPageName() }}-page-{{ $page }}">
                        <a wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}">{{ $page }}</a>
                    </li>
                    @endif
                    @endforeach
                    @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                    <li>
                        <a dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" aria-label="@lang('pagination.next')">
                            <i class="ti-angle-right"></i>
                        </a>
                    </li>
                    @else
                    <li class="disabled">
                        <a><i class="ti-angle-right"></i></a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    @endif
    </div>
