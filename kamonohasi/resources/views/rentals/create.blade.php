@extends('layouts.app')

@section('content')
@include('commons/header')
<a href="{{ route('rentals.index') }}">戻る</a>

<h3>会員情報</h3>
<table>
    <tr>
        <th>ID</th>
        <td>{{$users->id}}</td>
    </tr>
    <tr>
        <th>名前</th>
        <td>{{$users->user_name}}</td>
    </tr>
    <tr>
        <th>備考</th>
        <td>{{$users->comment}}</td>
    </tr>
</table>

<!-- 「会員詳細」の作成 -->
<button>会員詳細</button>
<!-- 「借りてる本の詳細」の作成 -->
<button>借りてる本の詳細</button>

<h3>資料情報</h3>
<form action="{{route('rentals.create')}}" method="get">
@csrf
    資料ID
    <input type="hidden" name="user_id" value="{{$users->id}}">
    <input type="number" name="book_id" >
    <input type="submit" value="検索">
</form>
<table>
    <tr>
        <th>資料名</th>
        <th>著者</th>
        <th>出版社</th>
    </tr>
    @if($book_flag === 0)
    @foreach($books as $book)
    <tr>
        <!--本当は、5冊以上だったらエラーをだしたい-->
        <td>{{$book->title}}</td>
        <td>{{$book->author}}</td>
        <td>{{$book->publisher}}</td>
    <tr>
    @endforeach
    @endif
</table>

<form action="{{route('rentals.store')}}" method="post">
    @csrf
    <input type="text" value="{{$users->id}}" name="user_id_rental" style='display:none;'>
    <input type="submit" value="貸し出し">
</form>


@endsection
