@extends('layouts.app')
@section('content')

@include('commons/header')

<button>戻る</button>

<h1>新規会員登録</h1>

<form action="" method="get">
    @csrf

    <p>
        <label>会員ID</label>
        <input type="" name="" value="">
    </p>
    <p>
        <label>名前</label>
        <input type="text" name="name" value="">
    </p>
    <p>
        <label>メールアドレス</label>
        <input type="email" name="email" value="">
    </p>
    <p>
        <label>電話番号</label>
        <input type="" name="" value="">
    </p>
    <p>
        <label>住所</label>
        <input type="" name="" value="">
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
