@extends('layouts.app')
@section('content')
@include('commons/header')

<a href="{{ route('rentals.index') }}">戻る</a>

<p>以下の内容で貸し出し完了しました</p>

<p>会員情報</p>
<p>ID　{{ $users->id }}</p>
<p>名前　{{ $users->user_name }}</p>

<p>借りている本</p>
<table>
    <thead>
        <tr>
            <th>冊数</th>
            <th>資料名</th>
            <th>著者</th>
            <th>出版社</th>
            <th>貸出日</th>
        </tr>
    </thead>
    <tbody>
        @foreach($books as $book)
        <tr>
            <td>{{ $book->id }}</td>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->publisher }}</td>
            <td>{{ $book->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
