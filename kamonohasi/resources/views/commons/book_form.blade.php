<!-- TODO -->
<!-- optionをforeachで自動生成する -->
<!-- old関数の中身を追加 -->
    @csrf
    <div class="searchFormInputFlex">
        <span>
            <label for="title">資料名</label>
            <input type="text" id="title" name="title" value="{{ old('title',$book->title) }}">
        </span>
        <span>
            <label for="author">著者</label>
            <input type="text" id="author" name="author" value="{{ old('author',$book->author) }}">
        </span>
        <span>
            <label for="publisher">出版社</label>
            <input type="text" id="publisher" name="publisher" value="{{ old('publisher',$book->publisher) }}">
        </span>
        <span>
            <label for="isbn">ISBN番号</label>
            <input type="text" id="isbn" name="isbn" value="{{ old('isbn',$book->isbn) }}">
        </span>
        <span>
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
        </span>
        <span>
            <label for="published_at">出版日</label>
            <input type="date" id="published_at" name="published_at" value="{{  old('published_on',$book->published_on )}}">
        </span>
        <span>
            <label for="comment">備考</label>
            <input type="text" id="comment" name="comment" value="{{ old('comment', $book->comment) }}">
        </span>
        <span>
            <label for="deleted_at">廃棄年月日</label>
            <input type="date" id="deleted_at" name="deleted_at" value="{{ old('deleted_on',$book->deleted_on) }}">
        </span>
    </div>
    <button class="btnBase"><i class="fa-solid fa-check"></i><span>更新</span></button>
</form>
