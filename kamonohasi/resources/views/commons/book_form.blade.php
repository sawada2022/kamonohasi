<!-- TODO -->
<!-- optionをforeachで自動生成する -->
<!-- old関数の中身を追加 -->
    @csrf
    <label>
        資料名
        <input type="text" name="book_name" value="">
    </label>
    <label>
        著者
        <input type="text" name="author" value="">
    </label>
    <label>
        出版社
        <input type="text" name="publisher" value="">
    </label>
    <label>
        ISBN番号
        <input type="text" name="isbn" value="">
    </label>
    <label for="category">分類コード</label>
    <select id="category">
        <option></option>
    </select>
    <label>
        出版日
        <input type="date" name="publication_date" value="">
    </label>
    <label>
        備考
        <input type="text" name="remarks" value="">
    </label>
    <label>
        廃棄年月日
        <input type="date" name="remarks" value="">
    </label>
    <button>登録</button>
</form>
