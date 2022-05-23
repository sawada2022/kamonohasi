@extends('layouts.app')

@section('content')
@include('commons/header')
<a href="rental/index">戻る</a>
<h3>会員情報</h3>
<!-- フォームの挿入  -->
<form action="{{route('rentals.create')}}" method="post">
    <input type="number" name="user_id" >
    <input type="submit" value="検索">
</form>
<!-- 会員情報を表にする-->
<table>
    <tr>
        <th>ID</th>
        <td>{{$users->id}}</td>
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

@endsection
