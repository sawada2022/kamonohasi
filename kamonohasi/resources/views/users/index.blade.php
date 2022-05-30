@extends('layouts.app')

@section('title','会員管理業務')
@section('content')

@include('commons/backBtn', ['path' => '/'])

<h1>会員情報検索</h1>

@if ($flag === 0)
<p class="userSearchError"><i class="fa-solid fa-circle-exclamation"></i><span>メールアドレスが「{{ $email }}」と一致するユーザはいません。</span></p>
@endif

@include('commons/flash')
<form class="card rentalIndexForm" action="{{route('users.index', $users->email)}}" method="get">
    @csrf
    <div>
        <label for="email">メールアドレス</label>
        <input type="text" id="email" class="input" name="email" >
    </div>
    <button class="btnBase btn-green"><span>検索</span><i class="fa-solid fa-magnifying-glass"></i></button>
</form>

<a class="btnBase addUserBtn" href="{{route('users.create')}}"><i class="fa-solid fa-plus"></i><span>新規登録</span></a>

@endsection
