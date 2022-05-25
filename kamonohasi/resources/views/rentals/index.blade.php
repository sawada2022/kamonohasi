@extends('layouts.app')
@section('title','貸し借り業務')
@section('content')

@include('commons/backBtn', ['path' => '/'])

<form action="{{ route('rentals.index', $users->email) }}" method="get">
    @csrf
    <label>
        会員ID
        <input type="number" name="user_id" min="1" value="">
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

<a href="{{ route('rentals.create', ['users' => $users,'book_flag' => $book_flag, 'rental_flag' => $rental_flag, 'rentals' => $rentals]) }}">貸出</a>
<a href="{{ route('rentals.edit', $users->id) }}">返却</a>

@endsection
