@extends('layouts.app')

@section('content')
<h1>会員情報編集</h1>

<form action="{{ route('users.update') }}" method="post">
    @method('patch')
    @include('commons/user_form')
    <button type="submit">更新</button>
</form>
@endsection