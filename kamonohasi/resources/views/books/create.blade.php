@extends('layouts.app')
@section('content')

@include('commons/backBtn', ['path' => 'books'])

<h3>資料新規登録</h3>
@include('commons/flash')
<form action="{{ route('books.store') }}" method="post">

@csrf
    <label>
        資料名
        <input type="text" name="title" value="{{ $book->title }}">
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
    <select id="category" name="category_id">
        <option value=""></option>
        @foreach($categories as $category)
        <option value="{{ $category->category_id }}">
            {{ $category->category_id }}：{{ $category->genre }}
        </option>
        @endforeach
    </select>
    <label>
        出版日
        <input type="date" name="published_on" value="{{ $book->published_on }}">
    </label>
    <label>
        備考
        <input type="text" name="comment" value="{{ $book->comment }}">
    </label>
    <label>
        廃棄年月日
        <input type="date" name="deleted_on" value="{{ $book->deleted_on }}">
    </label>
    <button>登録</button>
</form>

</form>
@endsection
