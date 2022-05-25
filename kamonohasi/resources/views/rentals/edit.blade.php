@extends('layouts.app')
@section('content')

@include('commons/header')
<h1>会員情報</h1>
<table>
    <tr>
        <td>ID</td>
        <td>{{ $user->id }}</td>
    </tr>
    <tr>
        <td>名前</td>
        <td>{{ $user->user_name }}</td>
    </tr>
    <tr>
        <td>備考</td>
        <td>{{ $user->comment }}</td>
    </tr>
</table>
<button>会員詳細</button>
</form>

<h1>資料情報</h1>
@if($flag === 0)
<table>
    <thead>
        <tr>
            <th>資料名</th>
            <th>著者</th>
            <th>出版社</th>
        </tr>
    </thead>
    <tbody>
        @foreach($books as $index => $book)
        <tr>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->publisher }}</td>
            <td>
            <form action="{{ route('rentals.update', $user->id) }}" method="post">
                @method('patch')
                @csrf
                <input type="hidden" name="delete_index" value="{{ $index }}">
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input type="submit" value="削除">
            </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<form action="{{ route('rentals.update', $user->id) }}" method="post">
@method('patch')
@csrf
<input type="hidden" name="user_id" value="{{ $user->id }}">
<input type="submit" value="返却">
</form>

@else
<p>貸出無し</p>

@endif

@endsection