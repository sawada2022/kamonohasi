@extends('layouts.app')
@section('content')
<h1>会員情報</h1>
<table>
    <tr>
        <td>ID</td>
        <td>{{ $user->id }}</td>
    </tr>
    <tr>
        <td>名前</td>
        <td>{{ $user->name }}</td>
    </tr>
    <tr>
        <td>備考</td>
        <td>{{ $user->remarks }}</td>
    </tr>
</table>
<a href="{{ route('users.show', $user) }}">会員詳細</a>

<h1>資料情報</h1>
<table>
    <thead>
        <tr>
            <th>資料名</th>
            <th>著者</th>
            <th>出版社</th>
        </tr>
    </thead>
    <tbody>
        @foreach($books as $book)
        <tr>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->publisher }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection