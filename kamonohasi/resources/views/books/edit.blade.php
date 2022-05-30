@extends('layouts.app')
@section('content')

@include('commons/backBtn', ['path' => "books/{$book->id}"])

<h1>資料情報編集</h1>

<div class="singleFormStyle">
    @include('commons/flash')
    <form action="{{ route('books.update', $book->id) }}" method="post" class="card singleForm">
        @method('patch')
        @include('commons/book_form', ['book' => $book, 'categories' => $categories])
</div>
@endsection
