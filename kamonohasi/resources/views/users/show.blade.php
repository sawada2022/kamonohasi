@extends('layouts.app')
@section('content')

@include('commons/header')

<a href="{{ route('users.index') }}">戻る</a>

<h1>会員情報詳細</h1>
{{--
<form action="{{ route('users.show', $users->email) }}" method="get">
    @csrf
    <label>
        メールアドレス
        <input type="email" name="email" value="">
    </label>
    <button>検索</button>
</form>
<p>会員情報</p>
--}}
{{--@if ($flag === 0)--}}
<table>
    <tbody>
        <tr>
            <td>会員ID</td>
            <td>{{ $users->id }}</td>
        </tr>
        <tr>
            <td>名前</td>
            <td>{{ $users->user_name }}</td>
        </tr>
        <tr>
            <td>メールアドレス</td>
            <td>{{ $users->email }}</td>
        </tr>
        <tr>
            <td>住所</td>
            <td>{{ $users->adress }}</td>
        </tr>
    </tbody>
</table>
{{--@endif--}}

<a href="{{ route('users.edit', $users->id) }}">編集</a>
<a href="#" id="deleteUserBtn">削除</a>
<form action="{{ route('users.destroy', $users->id) }}" method="post" type id="user-delete">
    @csrf
    @method('delete')
</form>

<p>借りている本</p>
<table>
    <thead>
        <tr>
            <th>冊数</th>
            <th>資料名</th>
            <th>著者</th>
            <th>出版社</th>
            <th>貸出期限</th>
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
