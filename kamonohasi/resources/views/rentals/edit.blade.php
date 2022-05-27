@extends('layouts.app')
@section('content')

@include('commons/backBtn', ['path' => 'rentals'])
@include('commons/flash')
<div id="userModal" class="modal">
    <div class="modalContent">
        <table class="tableBase" frame="void">
            <tr>
                <th>ID</th>
                <td>{{$user->id}}</td>
            </tr>
            <tr>
                <th>名前</th>
                <td>{{$user->user_name}}</td>
            </tr>
            <tr>
                <th>住所</th>
                <td>{{$user->adress}}</td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td>{{$user->tel}}</td>
            </tr>
        </table>
        <button class="modalBtn" onclick="modalClose('user')"><i class="fa-solid fa-xmark modalIcon"></i></button>
    </div>
</div>

<h1>会員情報</h1>
<table>
    <tr>
        <td>ID</td>
        <td>{{ $user->id }}</td>
    </tr>
    <tr>
        <td>名前</td>
        <td>{{ $user->user_name }}</td>
    </tr>
    <tr>
        <td>備考</td>
        <td>{{ $user->comment }}</td>
    </tr>
</table>
<button onclick="modal('user')">会員詳細</button>
</form>

<h1>資料情報</h1>
@if($flag === 0)
<table>
    <thead>
        <tr>
            <th>資料名</th>
            <th>著者</th>
            <th>出版社</th>
            <th>貸出期限</th>
        </tr>
    </thead>
    <tbody>
        @foreach($books as $index => $book)
        <tr>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->publisher }}</td>
            <td>{{$rentals[$index]->deadline}}</td>
            <td>
            <form action="{{ route('rentals.edit', $user->id) }}" method="get">
                @csrf
                <input type="hidden" name="delete_index" value="{{ $index }}">
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input type="submit" value="削除">
            </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<form action="{{ route('rentals.update', $user->id) }}" method="post">
@method('patch')
@csrf
<input type="hidden" name="user_id" value="{{ $user->id }}">
<input type="submit" value="返却">
</form>

@else
<p>貸出無し</p>

@endif

<script>
    function modal(flg){
        if(flg === 'user'){
            document.getElementById('userModal').style.display = 'block';
        }
    }

    function modalClose(flg){
        if(flg === 'user'){
            document.getElementById('userModal').style.display = 'none';
        }
    }

    // user modal close when click outside
    document.getElementById('userModal').addEventListener('click',function(e) {
        if(!e.target.closest('.modalContent')){
        document.getElementById('userModal').style.display = 'none';
        }
    })
</script>

@endsection
