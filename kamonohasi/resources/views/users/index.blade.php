@extends('layouts.app')
@section('content')

<h3>会員詳細情報</h3>
<a href="{{route('users.create')}}">新規登録</a>

<form action="{{route('users.index')}}" method="post">
    <input type="text" name="name" >
    <input type="submit" value="検索">
</form>

@endsection