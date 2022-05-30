@extends('layouts.app')
@section('content')

@include('commons/backBtn', ['path' => 'books'])

<h1>資料新規登録</h1>

<div class="singleFormStyle">
    @include('commons/flash')
    <form action="{{ route('books.store') }}" method="post" class="card singleForm">
    @csrf
    <div class="searchFormInputFlex">
        <span>
            <label for="title">資料名</label>
            <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}">
        </span>
        <span>
            <label for="author">著者</label>
            <input type="text" id="author" name="author" value="{{ old('author',$book->author) }}">
        </span>
        <span>
            <label for="publisher">出版社</label>
            <input type="text" id="publisher" name="publisher" value="{{ old('publisher',$book->publisher )}}">
        </span>
        <span>
            <label for="isbn">ISBN番号</label>
            <input type="text" id="isbn" name="isbn" value="{{ old('isbn',$book->isbn) }}">
        </span>
        <span>
            <label for="category">分類コード</label>
            <select id="category" name="category_id">
                <option value=""></option>
                @foreach($categories as $category)
                <option value="{{ $category->category_id }}">
                    {{ $category->category_id }}：{{ $category->genre }}
                </option>
                @endforeach
            </select>
        </span>
        <span>
            <label for="published_on">出版日</label>
            <input type="date" id="published_on" name="published_on" value="{{ old('published_on',$book->published_on) }}">
        </span>
        <span>
            <label for="comment">備考</label>
            <input type="text" id="comment" name="comment" value="{{ old('comment',$book->comment) }}">
        </span>
        <span>
            <label for="deleted_on">廃棄年月日</label>
            <input type="date" id="deleted_on" name="deleted_on" value="{{ old('deleted_on',$book->deleted_on) }}">
        </span>
    </div>
    <button class="btnBase"><i class="fa-solid fa-plus"></i><span>登録</span></button>
    </form>
</div>
@endsection
