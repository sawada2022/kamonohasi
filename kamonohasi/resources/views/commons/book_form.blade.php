<!-- TODO -->
<!-- optionをforeachで自動生成する -->
<!-- old関数の中身を追加 -->
    @csrf
    <label>
        資料名
        <input type="text" name="book_name" value="{{ $book->title }}">
    </label>
    <label>
        著者
        <input type="text" name="author" value="{{ $book->author }}">
    </label>
    <label>
        出版社
        <input type="text" name="publisher" value="{{ $book->publisher }}">
    </label>
    <label>
        ISBN番号
        <input type="text" name="isbn" value="{{ $book->isbn }}">
    </label>
    <label for="category">分類コード</label>
    <select id="category" name="category">
        @foreach($categories as $category)
        @if($category->category_id === $book->category_id)
        <option value="{{ $category->category_id }}" selected>
        @else
        <option value="{{ $category->category_id }}">
        @endif
            {{ $category->category_id }}：{{ $category->genre }}
        </option>
        @endforeach
    </select>
    <label>
        出版日
        <input type="date" name="publication_date" value="{{ $book->published_on }}">
    </label>
    <label>
        備考
        <input type="text" name="remarks" value="{{ $book->comment }}">
    </label>
    <label>
        廃棄年月日
        <input type="date" name="remarks" value="{{ $book->deleted_on }}">
    </label>
    <button>登録</button>
</form>
