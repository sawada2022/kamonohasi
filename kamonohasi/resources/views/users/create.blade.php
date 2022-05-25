@extends('layouts.app')
@section('title','会員管理業務')
@section('content')

@include('commons/header')
<h1>会員情報編集</h1>

<form action="{{ route('users.store') }}" method="post">
    @csrf
    <label>
        名前
        <input type="text" name="user_name" value="{{ old('') }}">
    </label>
    <label>
        メールアドレス
        <input type="email" name="email" value="{{ old('') }}">
    </label>
    <label>
        電話番号
        <input type="tel" name="tel" value="{{ old('') }}">
    </label>
    <label>
        郵便番号
        <input type="text" name="postal_code" value="{{ old('') }}">
    </label>
    <label>
        住所
        <input type="text" name="adress" value="{{ old('') }}">
    </label>
    <label>
        生年月日
        <input type="date" name="birthday" value="{{ old('') }}">
    </label>
    <label>
        備考
        <input type="text" name="comment" value="{{ old('') }}">
    </label>

    <button type="submit">登録</button>
</form>

@endsection
