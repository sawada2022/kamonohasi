@extends('layouts.app')
@section('title','貸し借り業務')
@section('content')

@include('commons/backBtn', ['path' => '/'])
@include('commons/flash')
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
<a href="{{ route('rentals.create', ['user_id' => $users,'book_flag' => $book_flag, 'rental_flag' => $rental_flag, 'rentals' => $rentals]) }}" id="btn1">貸出</a>
<a href="{{ route('rentals.edit', [$users->id,'book_flag' => $book_flag]) }}" id="btn2" >返却</a>

@endif
@endsection
