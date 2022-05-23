@extends('layouts.app')
@section('content')

<h1>かものはし Library</h1>

<a href="{{route('rentals.index')}}">貸借業務</a>
<a href="{{route('users.index')}}">会員管理業務</a>
<a href="{{route('books.index')}}">資料管理業務</a>

<img src="/image/kamonohasi.png" alt="かものはしのイラスト" />

@endsection
