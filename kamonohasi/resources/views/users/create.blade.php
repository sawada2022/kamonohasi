@extends('layouts.app')
@section('title','会員管理業務')
@section('content')
@include('commons/backBtn', ['path' => 'users'])


<h1>会員情報登録</h1>
<form action="{{ route('users.store', $user->id) }}" method="post">
    @csrf
    @include('commons/user_form')


    <p>
        <label>会員ID</label>
        <input type="" name="" value=" {{ $user->id }} ">
    </p>
    <p>
        <label>名前</label>
        <input type="text" name="name" value="{{ $user->user_name }}">
    </p>
    <p>
        <label>メールアドレス</label>
        <input type="email" name="email" value="{{ $user->email }}">
    </p>
    <p>
        <label>電話番号</label>
        <input type="" name="" value="">
    </p>
    <p>
        <label>住所</label>
        <input type="" name="" value="{{ $user->adress }}">
    </p>
    <p>
        <label>生年月日</label>
        <input type="" name="" value="">
    </p>
    <p>
        <label>備考</label>
        <input type="" name="" value="">
    </p>

    <button>登録</button>
</form>





@endsection
