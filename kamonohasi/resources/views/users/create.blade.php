@extends('layouts.app')
@section('title','会員管理業務')
@section('content')

@include('commons/backBtn', ['path' => 'users'])

<h1>会員情報編集</h1>

<form action="{{ route('users.store') }}" method="post">
    @csrf
    @include('commons/user_form')

    <button type="submit">登録</button>
</form>

@endsection
