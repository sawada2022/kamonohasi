@extends('layouts.app')
@section('content')

<button>戻る</button>

<h1>資料情報編集</h1>

<form action="{{ route('books.update', $book->id) }}" method="post">
@method('patch')
@include('commons/book_form', ['categories' => $categories])

@endsection
