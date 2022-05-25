@extends('layouts.app')
@section('title','会員管理業務')
@section('content')

<h1>会員情報登録</h1>
<form action="{{ route('users.store', $user->id) }}" method="post">
    @csrf
    @include('commons/user_form')
    <button type="submit">登録</button>
</form>

@endsection
