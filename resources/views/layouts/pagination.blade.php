@if ($paginator->hasPages())
    <nav class="flex items-center justify-center mt-4" role="navigation" aria-label="pagination">
        {{-- Previous Button --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1 rounded-lg opacity-50 cursor-not-allowed">
                <i class="material-icons">chevron_left</i>
            </span>
        @else
            <button wire:click="setPage('{{ $paginator->previousPageUrl() }}')"
                class="px-3 py-1 rounded-lg hover:bg-[--primary] hover:text-[--on-primary]">
                <i class="material-icons">chevron_left</i>
            </button>
        @endif

        {{-- Page Numbers --}}
        <div class="hidden sm:flex mx-2">
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-3 py-1">&hellip;</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-3 py-1 rounded-lg bg-[--primary] text-[--on-primary] mx-1">
                                {{ $page }}
                            </span>
                        @else
                            <button wire:click="setPage('{{ $url }}')"
                                class="px-3 py-1 rounded-lg hover:bg-[--primary] hover:text-[--on-primary] mx-1">
                                {{ $page }}
                            </button>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Button --}}
        @if ($paginator->hasMorePages())
            <button wire:click="setPage('{{ $paginator->nextPageUrl() }}')"
                class="px-3 py-1 rounded-lg hover:bg-[--primary] hover:text-[--on-primary]">
                <i class="material-icons">chevron_right</i>
            </button>
        @else
            <span class="px-3 py-1 rounded-lg opacity-50 cursor-not-allowed">
                <i class="material-icons">chevron_right</i>
            </span>
        @endif
    </nav>
@endif
