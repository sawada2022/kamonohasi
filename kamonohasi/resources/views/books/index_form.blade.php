

<form action="{{ route('books.index') }}" method="get">
    @csrf
<table>
<tr>
    <td>資料名<input type="text" name="title" value="{{ old('title') }}"></td>
    <td>資料ID<input type="text" name="book_id" value="{{ old('book_id') }}"></td>
</tr>
<tr>
    <td>著者<input type="text" name="author" value="{{ old('autor') }}"></td>
    <td>分類コード
        <select name="genre">
        @foreach($categories as $category)
        <option value="{{ $category->category_id }}">
            {{ $category->category_id }}：{{ $category->genre }}
        </option>
        @endforeach
    </select></td>
</tr>
<tr>
    <td>キーワード<input type="text" name="keyword" value="{{ old('keyword') }}"></td>
    <td>出版年<select name="publised_year">
        <option value=""></option>
        @for($i=2022; $i>=1900; $i--)
        <option value={!! $i !!}>{{ $i }}</option>
        @endfor
    </select></td>
</tr>
</table>
<input type="submit" value="検索">
</form>
