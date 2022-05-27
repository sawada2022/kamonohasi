@extends('layouts.app')
@section('title','蔵書業務')
@section('content')

@include('commons/backBtn', ['path' => '/'])
<h1>蔵書情報</h1>
<a class="btnBase" href="{{ route('books.create') }}"><i class="fa-solid fa-plus"></i><span>新規登録</span></a>

@include('books/index_form')
@include('commons/flash')
@if($flag === 0)
    <table>
        <thead>
            <tr>
                <th>資料名</th>
                <th>著者</th>
                <th>出版社</th>
                <th>ジャンル</th>
                <th>出版日</th>
                <th>入荷日</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <td><a href="{{ route('books.show', $book->id) }}"> {{ $book->title }}</a></td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->publisher }}</td>
                <td>{{ $book->category_id }}</td>
                <td>{{ $book->published_on }}</td>
                <td>{{ $book->created_at }}</td>
            </tr>
            @endforeach
        </tbody>       
    </table>
    {{ $books->appends(request()->query())->links('vendor.pagination.custom') }}
@endif

@endsection
