@extends('layouts.app')

@section('title','会員管理業務')
@section('content')

@include('commons/backBtn', ['path' => '/'])

<h3>会員詳細情報</h3>
<a href="{{route('users.create')}}">新規登録</a>
@include('commons/flash')
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
