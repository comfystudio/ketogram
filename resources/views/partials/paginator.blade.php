@if ($paginator->hasPages())
    <!-- Pagination Section 5 -->
    <div class="section-block pagination-3 pt-20">
        <div class="row">
            <div class="column width-12">
                <ul>
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        {{--<li><a class="pagination-previous icon-left-open disabled"><span class="icon-left-open-mini"></span></a></li>--}}
                        <li></li>

                    @else
                        <li><a class="pagination-previous icon-left-open" href="{{$paginator->previousPageUrl()}} "><span class="icon-left-open-mini"></span></a></li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="disabled"><span>{{ $element }}</span></li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li><a class="current">{{$page}}</a></li>
                                @else
                                    <li><a href = "{{$url}}">{{$page}}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li><a class="pagination-next" href="{{$paginator->nextPageUrl()}}"><span class="icon-right-open-mini"></span></a></li>
                    @else
                        {{--<li><a class="pagination-next disabled"><span class="icon-right-open-mini"></span></a></li>--}}
                        <li></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <!-- Pagination Section 5 End -->
@endif