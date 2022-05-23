@extends('layouts.app')
@section('content')
@include('commons/header')

<h3>会員詳細情報</h3>
<a href="{{route('users.create')}}">新規登録</a>

<form action="{{route('users.index', $users->email)}}" method="get">
    @csrf
    <label>
        メールアドレス
        <input type="text" name="email" >
    </label>
    <input type="submit" value="検索">
</form>

@if ($flag === 0)
<p>メールアドレスが「{{ $email }}」と一致するユーザはいません。</p>
@endif

@endsection
