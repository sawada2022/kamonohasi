@extends('layouts.app')
@section('title','貸し借り業務')
@section('content')

@include('commons/backBtn', ['path' => '/'])
@include('commons/flash')
<form class="card rentalIndexForm" action="{{ route('rentals.index', $users->email) }}" method="get">
    @csrf
    <div>
        <label for="user_id">会員ID</label>
        <input type="number" id="user_id" class="input" name="user_id" min="1" value="">
    </div>
    <button class="btnBase"><span>検索</span><i class="fa-solid fa-magnifying-glass"></i></button>
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
