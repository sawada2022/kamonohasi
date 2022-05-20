@extends('layouts.app')

@section('content')
<a href="rental/index">戻る</a>
<h3>会員情報</h3>
<!-- フォームの挿入  -->
<form action="{{route('rentals.create')}}" method="post">
    会員ID
    <input type="number" name="user_id" value="user_id">
    <input type="submit" value="検索">
</form>
<!-- 会員情報を表にする-->
<table>
    <tr>
        <th>ID</th>
        <td>{{$users->user_id}}</td>
    </tr>
    <tr>
        <th>名前</th>
        <td>{{$users->name}}</td>
    </tr>
    <tr>
        <th>備考</th>
        <td>{{$users->commnent}}</td>
    </tr>
</table>
<!-- 「会員詳細」の作成 -->
<button>会員詳細</button>
<!-- 「借りてる本の詳細」の作成 -->
<button>借りてる本の詳細</button>

<h3>資料情報</h3>
<!-- 借りる本の情報を表にする--><!-- フォームの挿入  -->
<form action="{{route('rentals.create')}}" method="post">
    会員ID
    <input type="number" name="book_id" value="book_id">
    <input type="submit" value="検索">
</form>
<table>
    <tr>
        <th></th>
        <th>資料名</th>
        <th>著者名</th>
        <th>出版社</th>
    </tr>
    <tr>
        <td>
            <!--ここに冊数をインクリメントしたい-->
        </td><!--本当は、5冊以上だったらエラーをだしたい-->
        <td>{{$book_id->name}}</td>
        <td>{{$book_id->author}}</td>
        <td>{{$book_id->publisher}}</td>
    <tr>
</table>
@endsection