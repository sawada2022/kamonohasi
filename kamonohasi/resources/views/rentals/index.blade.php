@extends('layouts.app')
@section('content')

@include('commons/header')

<button>戻る</button>

<form action="{{ route('rentals.index', $users->email) }}" method="get">
    @csrf
    <label>
        会員ID
        <input type="text" name="user_id" value="">
    </label>
    <button>検索</button>
</form>

@if ($flag === 0)
<table>
    <tbody>
        <tr>
            <td>会員ID</td>
            <td>{{ $users->id }}</td>
        </tr>
        <tr>
            <td>名前</td>
            <td>{{ $users->user_name }}</td>
        </tr>
    </tbody>
</table>
@endif

<a href="{{ route('rentals.create', $users->id) }}">貸出</a>
<a href="{{ route('rentals.edit', $users->id) }}">返却</a>

@endsection
