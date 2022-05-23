@extends('layouts.app')

@section('content')
<a href="rental/index">戻る</a>

<h3>資料情報</h3>
<!-- フォームの挿入  -->
<form action="{{route('rentals.create')}}" method="get">
    <input type="number" name="book_id" >
    <input type="submit" value="追加">
</form>
<!-- 資料情報を表にする-->
@if ($flag === 0)
<table>
    <tr>
        <th>資料名</th>
        <th>著者</th>
        <th>出版社</th>
    </tr>
    @foreach($books as $book)
    <tr>
        <td>{{$book->title}}</td>
        <td>{{$book->author}}</td>
        <td>{{$book->publisher}}</td>
    </tr>
    @endforeach
</table>
@endif

<!-- 貸し出しボタンの作成 -->
<button>貸し出し</button>
@endsection('content')