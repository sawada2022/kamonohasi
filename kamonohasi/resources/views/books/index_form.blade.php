<form class="searchForm card" action="{{ route('books.index') }}" method="get">
    @csrf

    <div class="searchInputArea">
        <div class="searchFormInputFlex">
            <span>
                <label for="title">資料名</label><input type="text" id="title" name="title" value="{{ old('title') }}">
            </span>
            <span>
                <label for="author">著者名</label>
                <input type="text" id="author" name="author" value="{{ old('autor') }}">
            </span>
            <span>
                <label for="keyword">キーワード</label>
                <input type="text" id="keyword" name="keyword" value="{{ old('keyword') }}">
            </span>
        </div>

        <div class="searchFormInputFlex">
            <span>
                <label for="book_id">資料ID</label>
                <input type="text" id="book_id" name="book_id" value="{{ old('book_id') }}">
            </span>
            <span>
                <label for="genre">ジャンル</label>
                <select id="genre" name="genre">
                    <option value=""></option>
                    @for($i=0; $i<=10; $i++)
                    <option value={!! $i !!} >{{ $i }}</option>
                    @endfor
                </select>
            </span>
            <span>
                <label for="publised_year">出版年</label>
                <select id="publised_year" name="publised_year">
                    <option value=""></option>
                    @for($i=2022; $i>=1900; $i--)
                    <option value={!! $i !!}>{{ $i }}</option>
                    @endfor
                </select>
            </span>
        </div>
    </div>

    <button class="btnBase"><span>検索</span><i class="fa-solid fa-magnifying-glass"></i></button>
</form>
