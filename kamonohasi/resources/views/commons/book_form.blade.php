<!-- TODO -->
<!-- optionをforeachで自動生成する -->
<!-- old関数の中身を追加 -->
    @csrf
    <label>
        資料名
        <input type="text" name="title" value="{{ old('title',$book->title) }}">
    </label>
    <label>
        著者
        <input type="text" name="author" value="{{ old('author',$book->author) }}">
    </label>
    <label>
        出版社
        <input type="text" name="publisher" value="{{ old('publisher',$book->publisher) }}">
    </label>
    <label>
        ISBN番号
        <input type="text" name="isbn" value="{{ old('isbn',$book->isbn) }}">
    </label>
    <label for="category">分類コード</label>
    <select id="category" name="category_id">
        @foreach($categories as $category)
        @if($category->category_id === $book->category_id)
        <option value="{{ old('category_id',$category->category_id) }}" selected>
        @else
        <option value="{{ old('category_id',$category->category_id) }}">
        @endif
            {{ old('category_id',$category->category_id) }}：{{ old('genre',$category->genre) }}
        </option>
        @endforeach
    </select>
    <label>
        出版日
        <input type="date" name="published_at" value="{{  old('published_on',$book->published_on )}}">
    </label>
    <label>
        備考
        <input type="text" name="comment" value="{{ old('comment', $book->comment) }}">
    </label>
    <label>
        廃棄年月日
        <input type="date" name="deleted_at" value="{{ old('deleted_on',$book->deleted_on) }}">
    </label>
    <button>登録</button>
</form>
