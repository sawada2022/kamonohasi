@extends('layout.app')

@section('content')
<h1>会員情報編集</h1>

<form action="{{ route('users.update', $user->id) }}" method="post">
    @method('patch')
    @include('commons/user_form')
    <button type="submit">更新</button>
</form>
@endsection