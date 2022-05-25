@extends('layouts.app')

@section('content')
@include('commons/header')

<div id="userModal" class="modal">
    <div class="modalContent">
        <table class="modalTable">
            <tr>
                <th>ID</th>
                <td>{{$users->id}}</td>
            </tr>
            <tr>
                <th>名前</th>
                <td>{{$users->user_name}}</td>
            </tr>
            <tr>
                <th>住所</th>
                <td>{{$users->adress}}</td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td>{{$users->tel}}</td>
            </tr>
        </table>
        <button class="modalBtn" onclick="modalClose('user')"><i class="fa-solid fa-xmark modalIcon"></i></button>
    </div>
</div>

<div  id="bookModal" class="modal">
    <div class="modalContent">
        <table class="modalTable">
            <!-- 対象ユーザが借りている本の表示に変更 -->
            <tr>
                <th>資料名</th>
                <th>著者</th>
                <th>貸出期限</th>
            </tr>
            @if($book_flag === 0)
            @foreach($books as $book)
            <tr>
                <td>{{$book->title}}</td>
                <td>{{$book->author}}</td>
                <td>{{$book->created_at}}</td>
            <tr>
            @endforeach
            @endif
        </table>
        <button class="modalBtn" onclick="modalClose('book')"><i class="fa-solid fa-xmark modalIcon"></i></button>
    </div>
</div>

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
<button onclick="modal('user')">会員詳細</button>
<!-- 「借りてる本の詳細」の作成 -->
<button onclick="modal('book')">借りてる本の詳細</button>

<h3>資料情報</h3>
<form action="{{route('rentals.create')}}" method="get">
@csrf
    資料ID
    <input type="hidden" name="user_id" value="{{$users->id}}">
    <input type="number" name="book_id" >
    <input type="submit" value="追加">
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

<script>
    function modal(flg){
        if(flg === 'user'){
            document.getElementById('userModal').style.display = 'block';
        }else if(flg === 'book'){
            document.getElementById('bookModal').style.display = 'block';
        }
    }

    function modalClose(flg){
        if(flg === 'user'){
            document.getElementById('userModal').style.display = 'none';
        }else if(flg === 'book'){
            document.getElementById('bookModal').style.display = 'none';
        }
    }

    // user modal close when click outside
    document.getElementById('userModal').addEventListener('click',function(e) {
        if(!e.target.closest('.modalContent')){
        document.getElementById('userModal').style.display = 'none';
        }
    })

    // book modal close when click outside
    document.getElementById('bookModal').addEventListener('click',function(e) {
        if(!e.target.closest('.modalContent')){
        document.getElementById('bookModal').style.display = 'none';
        }
    })

</script>

@endsection
