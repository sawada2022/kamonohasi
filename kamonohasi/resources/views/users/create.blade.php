@extends('layouts.app')
@section('title','会員管理業務')
@section('content')
@include('commons/backBtn', ['path' => 'users'])


<h1>会員情報登録</h1>
@include('commons/flash')
<form action="{{ route('users.store', $user->id) }}" method="post">
    @csrf
    @include('commons/user_form')

    <input type="submit" value="登録">
</form>


@endsection
