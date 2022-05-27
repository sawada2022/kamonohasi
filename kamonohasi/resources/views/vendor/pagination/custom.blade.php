@if ($paginator->hasPages())
    <nav class="p-pagination">
        <ul>
        <!-- 前へ移動ボタン -->
        @if ($paginator->onFirstPage())
            <li class="disabled">
                <div class="pagenateBtn">
                    <i class="fa-solid fa-angle-left"></i>
                    <p>前へ</p>
                </div>
            </li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}">
                    <div class="pagenateBtn">
                        <i class="fa-solid fa-angle-left"></i>
                        <p>前へ</p>
                    </div>
                </a>
            </li>
        @endif

        <!-- ページ番号　-->
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled">
                    {{ $element }}
                </li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active nowChoicePage">
                            {{ $page }}
                        </li>
                    @else
                        <li class="active">
                            <a class="activeNum" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        <!-- 次へ移動ボタン -->
        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}">
                    <div class="pagenateBtn">
                        <p>次へ</p>
                        <i class="fa-solid fa-angle-right"></i>
                    </div>
                </a>
            </li>
        @else
            <li class="disabled">
                <div class="pagenateBtn">
                    <p>次へ</p>
                    <i class="fa-solid fa-angle-right"></i>
                </div>
            </li>
        @endif
        </ul>
    </nav>
@endif
