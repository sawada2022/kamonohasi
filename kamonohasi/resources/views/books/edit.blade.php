@extends('layouts.app')
@section('content')

@include('commons/header')

<button>戻る</button>

<h1>資料情報編集</h1>
@include('commons/flash')
<form action="{{ route('books.update', $book->id) }}" method="post">
@method('patch')
@include('commons/book_form', ['book' => $book, 'categories' => $categories])

@endsection
