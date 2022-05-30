@extends('layouts.app')
@section('title','会員管理業務')
@section('content')
@include('commons/backBtn', ['path' => "users/{$user->id}?flag=1&user={$user->id}"])

<h1>会員情報編集</h1>

<div class="singleFormStyle">
    @include('commons/flash')
    <form action="{{ route('users.update', $user->id) }}" method="post" class="card singleForm">
        @method('patch')
        @csrf
        @include('commons/user_form')

        <button class="btnBase"><i class="fa-solid fa-check"></i><span>更新</span></button>
    </form>
</div>

@endsection
