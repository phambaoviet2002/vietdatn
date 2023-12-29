@if ($paginator->hasPages())
<!-- <ul class="pager"> -->
<!-- <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
    <span class="flex items-center col-span-3">
        Hiện ... of ...
    </span>

    <span class="col-span-2"></span> -->
<!-- Pagination -->

<!-- <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
        <nav aria-label="Table navigation">
            <ul class="inline-flex items-center"> -->

<div class="pagination justify-content-center mt-100">
    <nav>
        <ul class="pagination m-0 d-flex align-items-center">
            @if ($paginator->onFirstPage())
            <!-- <li class="disabled"><span>← Previous</span></li> -->
            <!-- <li>
                    <button class="disabled px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple" aria-label="Previous">
                        <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                            <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                        </button>
                </li> -->
            <li class="item disabled">
                <a class="link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-left">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </a>
            </li>
            @else
            <!-- <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">← Previous</button></li> -->
            <!-- <li>
                    <a href="{{ $paginator->previousPageUrl() }}" class=" px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple" aria-label="Previous">
                        <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                            <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </a>
                </li> -->
            <li class="item ">
                <a class="link" href="{{ $paginator->previousPageUrl() }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-left">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </a>
            </li>
            @endif
            @foreach ($elements as $element)
            @if (is_string($element))

            <!-- <li class="disabled"><span>{{ $element }}</span></li> -->
            <li class="item disabled"><a class="link" href="#">{{ $element }}</a></li>
            @endif
            @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
            <!-- <li class="active my-active"><span>{{ $page }}</span></li> -->
            <!-- <li>
                    <button class="px-3 py-1 text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600 rounded-md focus:outline-none focus:shadow-outline-purple">
                        {{ $page }}
                    </button>
                </li> -->
            <li class="item active"><a class="link" href="#">{{ $page }}</a></li>
            @else
            <!-- <li><a href="{{ $url }}">{{ $page }}</a></li> -->
            <li class="item"><a class="link" href="{{ $url }}">{{ $page }}</a></li>
            <!-- <li>
                    <a href="{{ $url }}" class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                        {{ $page }}
                    </a>
                </li> -->
            @endif
            @endforeach
            @endif
            @endforeach
            @if ($paginator->hasMorePages())
            <!-- <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">Next →</a></li> -->
            <!-- <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple" aria-label="Next">
                        <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                            <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </a>
                </li> -->
            <li class="item">
                <a class="link" href="{{ $paginator->nextPageUrl() }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-right">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </a>
            </li>
            @else
            <!-- <li class="disabled"><span>Next →</span></li> -->
            <!-- <li>
                    <button class="disabled px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple" aria-label="Next">
                        <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                            <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </button>
                </li> -->
            <li class="item disabled">
                <a class="link" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-right">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </a>
            </li>
            @endif
            <!-- </ul> -->
        </ul>
    </nav>
    </span>
</div>
@endif
<!-- <div class="pagination justify-content-center mt-100">
    <nav>
        <ul class="pagination m-0 d-flex align-items-center">
            <li class="item disabled">
                <a class="link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-left">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </a>
            </li>
            <li class="item"><a class="link" href="#">1</a></li>
            <li class="item active"><a class="link" href="#">2</a></li>
            <li class="item"><a class="link" href="#">3</a></li>
            <li class="item"><a class="link" href="#">4</a></li>
            <li class="item">
                <a class="link" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-right">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </a>
            </li>
        </ul>
    </nav>
</div> -->