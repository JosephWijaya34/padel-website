@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="hidden md:block px-4 py-2 text-gray-500 bg-gray-200 rounded cursor-not-allowed">
                &larr; Previous
            </span>
            <span class="md:hidden px-4 py-2 text-gray-500 bg-gray-200 rounded cursor-not-allowed">
                &larr;
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                class="hidden md:block px-4 py-2 text-white bg-primary rounded hover:bg-green-800">
                &larr; Previous
            </a>
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                class="md:hidden px-4 py-2 text-white bg-primary rounded hover:bg-green-800">
                &larr;
            </a>
        @endif

        {{-- Pagination Elements --}}
        <div class="flex items-center space-x-2">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="px-4 py-2 text-gray-500">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-4 py-2 text-white bg-primary rounded">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-4 py-2 text-secondary bg-gray-200 rounded hover:bg-gray-300">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                class="hidden md:block px-4 py-2 text-white bg-primary rounded hover:bg-green-800">
                Next &rarr;
            </a>
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                class="md:hidden px-4 py-2 text-white bg-primary rounded hover:bg-green-800">
                &rarr;
            </a>
        @else
            <span class="hidden md:block px-4 py-2 text-gray-500 bg-gray-200 rounded cursor-not-allowed">
                Next &rarr;
            </span>
            <span class="md:hidden px-4 py-2 text-gray-500 bg-gray-200 rounded cursor-not-allowed">
                &rarr;
            </span>
        @endif
    </nav>
@endif