<!-- TODO -->
<!-- formのactionを追加する -->
<!-- methodを登録と更新で変更する処理を追加する -->
<!-- optionをforeachで自動生成する -->
<!-- old関数の中身を追加 -->
<form action="{{ route('') }}" method="post">
    @csrf
    <label>
        資料名
        <input type="text" name="book_name" value="{{ old('') }}">
    </label>
    <label>
        著者
        <input type="text" name="author" value="{{ old('') }}">
    </label>
    <label>
        出版社
        <input type="text" name="publisher" value="{{ old('') }}">
    </label>
    <label>
        ISBN番号
        <input type="text" name="isbn" value="{{ old('') }}">
    </label>
    <label for="category">分類コード</label>
    <select id="category">
        <option></option>
    </select>
    <label>
        出版日
        <input type="text" name="publication_date" value="{{ old('') }}">
    </label>
    <label>
        備考
        <input type="text" name="remarks" value="{{ old('') }}">
    </label>
    <button>登録</button>
</form>
