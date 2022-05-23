@extends('layouts.app')
@section('content')
@include('commons/header')
<h3>資料新規登録</h3>
<form action="{{ route('books.create') }}" method="post">
    @csrf
    <label>
        資料名
        <input type="text" name="book_name" value=""> </label>
        <input type="submit" value="検索">
</form>
@endsection
