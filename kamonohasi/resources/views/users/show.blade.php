@extends('layouts.app')
@section('title','会員管理業務')
@section('content')

<div id="histModal" class="modal">
    <div class="modalContent">
        <table class="tableBase" frame="void">
            @if($rental_flag === 0)
            <caption>貸し出し履歴</caption>
            <tr>
                <th>資料ID</th>
                <th>資料名</th>
                <th>著者</th>
                <th>貸出日</th>
                <th>返却日</th>
            </tr>
            @foreach($book_hist as $hist)
            <tr>
                <td>{{$hist->id}}</td>
                <td>{{$hist->title}}</td>
                <td>{{$hist->author}}</td>
                <td>{{$hist->created_at}}</td>
                <td>{{$hist->created_at}}</td>
            </tr>
            @endforeach
            @else
            <p class="no-rental-msg">{{$users->user_name}}さんの貸し出し履歴はありません。</p>
            @endif
        </table>
        <button class="modalBtn" onclick="modalClose('hist')"><i class="fa-solid fa-xmark modalIcon"></i></button>
    </div>
</div>

@include('commons/backBtn', ['path' => 'users'])

<h1>会員情報詳細</h1>

<div class="mainContentFlex">
    <div class="showTableFlex card">
        <table class="tableBase" frame="void">
            <caption>会員情報</caption>
            <tbody>
                <tr>
                    <td>会員ID</td>
                    <td>{{ $users->id }}</td>
                </tr>
                <tr>
                    <td>名前</td>
                    <td>{{ $users->user_name }}</td>
                </tr>
                <tr>
                    <td>メールアドレス</td>
                    <td>{{ $users->email }}</td>
                </tr>
                <tr>
                    <td>電話番号</td>
                    <td>{{ $users->tel }}</td>
                </tr>
                <tr>
                    <td>郵便番号</td>
                    <td>{{ $users->postal_code }}</td>
                </tr>
                <tr>
                    <td>住所</td>
                    <td>{{ $users->adress }}</td>
                </tr>
                <tr>
                    <td>生年月日</td>
                    <td>{{ $users->birthday }}</td>
                </tr>
                <tr>
                    <td>備考</td>
                    <td>{{ $users->comment }}</td>
                </tr>
            </tbody>
        </table>

        <div class="btnFlex">
            <a class="btnBase" href="{{ route('users.edit', $users->id) }}"><i class="fa-solid fa-user-pen"></i><span>編集</span></a>
            <a class="btnBase" href="#" id="deleteUserBtn"><i class="fa-solid fa-trash-can"></i><span>削除</span></a>
        </div>
        <form action="{{ route('users.destroy', $users->id) }}" method="post" id="user-delete" style="display:none;">
            @csrf
            @method('delete')
        </form>
    </div>

    <div class="card">
        @if($flag === 1)
        <table class="tableBase" frame="void">
            <caption>借りている本</caption>
            <thead>
                <tr>
                    <th>冊数</th>
                    <th>資料名</th>
                    <th>著者</th>
                    <th>出版社</th>
                    <th>貸出日</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $index => $book)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->publisher }}</td>
                    <td>{{ $book->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        @if($flag === 2)
        <table style="width:15rem;">
            <caption>借りている本</caption>
            <tr>
                <td style="text-align: center;">貸出無し</td>
            </tr>
        </table>
        @endif
        <button class="btnBase histBtn" onclick="modal('hist')"><i class="fa-solid fa-clock-rotate-left"></i><span>貸し出し履歴</span></button>
    </div>
</div>

<script>
    function modal(flg){
        if(flg === 'hist'){
            document.getElementById('histModal').style.display = 'block';
            document.getElementById('histModal').style.animation = 'show 0.15s linear 0s';
        }
    }

    function modalClose(flg){
        if(flg === 'hist'){
            document.getElementById('histModal').style.display = 'none';
        }
    }

    // hist modal close when click outside
    document.getElementById('histModal').addEventListener('click',function(e) {
        if(!e.target.closest('.modalContent')){
        document.getElementById('histModal').style.display = 'none';
        }
    })
</script>

@endsection
