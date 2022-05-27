@extends('layouts.app')
@section('title','会員管理業務')

@section('content')

<h1>会員情報編集</h1>
@include('commons/flash')
<form action="{{ route('users.update', $user->id) }}" method="post">
    @method('patch')
    @csrf
    @include('commons/user_form')
    <button type="submit">更新</button>
</form>
@endsection
