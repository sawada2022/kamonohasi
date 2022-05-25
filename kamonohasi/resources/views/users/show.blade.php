@extends('layouts.app')
@section('title','会員管理業務')
@section('content')


<a href="{{ route('users.index') }}">戻る</a>

<h1>会員情報詳細</h1>

<p>会員情報</p>
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

<a href="{{ route('users.edit', $users->id) }}">編集</a>
<a href="#" id="deleteUserBtn">削除</a>
<form action="{{ route('users.destroy', $users->id) }}" method="post" type id="user-delete">
    @csrf
    @method('delete')
</form>

<h1>借りている本</h1>
@if($flag === 1)
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
@endif
@if($flag === 2)
<p>貸出無し</p>
@endif
@endsection
