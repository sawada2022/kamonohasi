@extends('layouts.app')
@section('content')

@include('commons/header')
<h1>会員情報</h1>
@if($flag === 0)
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
        <td>{{ $user->comment }}</td>
    </tr>
</table>
<form action="{{ route('users.show) }}" method="post">
    @csrf
    <input type="hidden" name="email" value="">
    <input type="submit" value="会員詳細">
</form>
@endif
<h1>資料情報</h1>
<table>
    <thead>
        <tr>
            <th>資料名</th>
            <th>著者</th>
            <th>出版社</th>
        </tr>
    </thead>
    @if($flag === 0)
    <tbody>
        @foreach($books as $book)
        <tr>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->publisher }}</td>
        </tr>
        @endforeach
    </tbody>
    @endif
</table>

@if($flag === 0)
<a href="{{ route('rentals.update', $user->id) }}">返却</a>
</form>
@endif
@endsection