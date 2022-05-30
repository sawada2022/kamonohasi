@extends('layouts.app')
@section('title','会員管理業務')
@section('content')
@include('commons/backBtn', ['path' => 'users'])


<h1>会員情報登録</h1>

<div class="singleFormStyle">
    @include('commons/flash')
    <form action="{{ route('users.store', $user->id) }}" method="post" class="card singleForm">
        @csrf
        @include('commons/user_form')

        <button class="btnBase"><i class="fa-solid fa-plus"></i><span>登録</span></button>
    </form>
</div>

@endsection
