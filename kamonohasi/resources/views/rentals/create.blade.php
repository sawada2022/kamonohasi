@extends('layouts.app')

@section('content')
<a href="rental/index">戻る</a>

<h3>会員情報</h3>
<!-- フォームの挿入  -->
<form action="{{route('rentals.create')}}" method="get">
@csrf
    会員ID
    <input type="number" name="user_id">
    <input type="submit" value="検索">
</form>
<!-- 会員情報を表にする-->
@if($user_flag === 0)
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
@endif
<!-- 「会員詳細」の作成 -->
<button>会員詳細</button>
<!-- 「借りてる本の詳細」の作成 -->
<button>借りてる本の詳細</button>

<h3>資料情報</h3>
<!-- 借りる本の情報を表にする--><!-- フォームの挿入  -->
<form action="{{route('rentals.create')}}" method="get">
@csrf
    資料ID
    <input type="number" name="book_id" >
    <input type="submit" value="検索">
</form>
@if($book_flag === 0)
<table>
    <tr>
        <th>資料名</th>
        <th>著者名</th>
        <th>出版社</th>
    </tr>
    <tr>
        <td>
            <!--ここに冊数をインクリメントしたい-->
        </td><!--本当は、5冊以上だったらエラーをだしたい-->
        <td>{{$books->title}}</td>
        <td>{{$books->author}}</td>
        <td>{{$books->publisher}}</td>
    <tr>
</table>
@endif

<form action="{{route('rentals.store')}}" method="post">
    @csrf
    <input type="text" value="{{$users->id}}" name="user_id_rental" style='display:none;'>
    <input type="text" value="{{$books->id}}" name="book_id_rental" style='display:none;'>
    <input type="submit" value="貸し出し">
</form>

@endsection