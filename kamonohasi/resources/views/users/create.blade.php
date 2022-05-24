@extends('layouts.app')
@section('content')

@include('commons/header')
<h1>会員情報編集</h1>

<form action="{{ route('users.store') }}" method="post">
    @csrf
    @include('commons/user_form')
    <button type="submit">登録</button>
</form>

@endsection
