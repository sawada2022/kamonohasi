@extends('layouts.app')

@section('content')
<h1>蔵書情報</h1>
<a href="{{ route('book.create') }}">新規登録</a>

@include('index_form')

@if($books)
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
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->publisher }}</td>
                <td>{{ $book->category_id }}</td>
                <td>{{ $book->published_on }}</td>
                <td>{{ $book->created_at }}</td>
            </tr>
        </tbody>       
    </table>
    {{ $book->links() }}
@endif