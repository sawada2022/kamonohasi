@extends('layouts.app')
@section('title','資料管理業務')
@section('content')

<div id="histModal" class="modal">
    <div class="modalContent">
        <table class="tableBase" frame="void">
            @if($rental_flag === 0)
            <caption>貸し出し履歴</caption>
            <tr>
                <th>累計貸出人数</th>
                <th>会員ID</th>
                <th>名前</th>
                <th>貸出日</th>
                <th>返却日</th>
            </tr>
            @foreach($user_hist as $index => $hist)
            <tr>
                <td>{{count($user_hist) - $index}}</td>
                <td>{{$hist->id}}</td>
                <td>{{$hist->user_name}}</td>
                <td>{{$rental_hist[$index]->created_at}}</td>
                <td>{{$rental_hist[$index]->updated_at}}</td>
            </tr>
            @endforeach
            @else
            <p class="no-rental-msg">この本の貸し出し履歴はありません。</p>
            @endif
        </table>
        <button class="modalBtn" onclick="modalClose('hist')"><i class="fa-solid fa-xmark modalIcon"></i></button>
    </div>
</div>

@include('commons/backBtn', ['path' => 'books'])

<h1>資料詳細情報</h1>

<div class="mainContentFlex">
    <div class="showTableFlex card">
        <table class="tableBase" frame="void">
            <caption>資料情報</caption>
            <tbody>
                <tr>
                    <td>資料名</td>
                    <td>{{ $book->title }}</td>
                </tr>
                <tr>
                    <td>著者</td>
                    <td>{{ $book->author }}</td>
                </tr>
                <tr>
                    <td>出版社</td>
                    <td>{{ $book->publisher }}</td>
                </tr>
                <tr>
                    <td>ISBN番号</td>
                    <td>{{ $book->isbn }}</td>
                </tr>
                <tr>
                    <td>分類コード</td>
                    <td>{{ $book->category_id }}</td>
                </tr>
                <tr>
                    <td>出版日</td>
                    <td>{{ $book->published_on }}</td>
                </tr>
                <tr>
                    <td>備考</td>
                    <td>{{ $book->comment }}</td>
                </tr>
            </tbody>
        </table>

        <div class="btnFlex">
        <a class="btnBase" href="{{ route('books.edit', $book->id) }}"><i class="fa-solid fa-user-pen"></i><span>編集</span></a>
        <a class="btnBase" href="#" id="deleteBookBtn"><i class="fa-solid fa-trash-can"></i><span>削除</span></a>
        </div>
        <form action="{{ route('books.destroy', $book->id) }}" method="post" id="book-delete" style="display:none;">
            @csrf
            @method('delete')
        </form>
    </div>

    <div class="card">
        @if($flag === 1)
        <table class="tableBase" frame="void">
            <caption>借りている人の情報</caption>
            <thead>
                <tr>
                    <th>会員ID</th>
                    <th>名前</th>
                    <th>メールアドレス</th>
                    <th>住所</th>
                    
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $users->id }}</td>
                    <td>{{ $users->user_name }}</td>
                    <td>{{ $users->email }}</td>
                    <td>{{ $users->adress }}</td>
                </tr>
            </tbody>
        </table>
        @endif
        @if($flag === 0)
        <table style="width:15rem;">
            <caption>借りている人の情報</caption>
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
