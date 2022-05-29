@extends('layouts.app')
@section('title','会員管理業務')
@section('content')

<div id="historyModal" class="modal">
    <div class="modalContent">
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
                @foreach($books as $book)
                <tr>
                    <td>{{ $book->id }}</td>
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
                <td style="text-align: center;">現在、{{ $users->user_name}}さんへの貸出はありません</td>
            </tr>
        </table>
        @endif
        <button class="modalBtn" onclick="modalClose('history')"><i class="fa-solid fa-xmark modalIcon"></i></button>
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
                    <td>住所</td>
                    <td>{{ $users->adress }}</td>
                </tr>
            </tbody>
        </table>

        <div class="btnFlex">
        <button class="btnBase" onclick="modal('history')"><i class="fa-solid fa-book"></i><span>貸出中</span></button>
            <a class="btnBase" href="{{ route('users.edit', $users->id) }}"><i class="fa-solid fa-user-pen"></i><span>編集</span></a>
            <a class="btnBase" href="#" id="deleteUserBtn"><i class="fa-solid fa-trash-can"></i><span>削除</span></a>
        </div>
        <form action="{{ route('users.destroy', $users->id) }}" method="post" id="user-delete" style="display:none;">
            @csrf
            @method('delete')
        </form>
        
    </div>

    <div class="card">
        <div class="showTableFlex card">
        <table class="tableBase" frame="void">
            <caption>貸出履歴</caption>
                @if($rental_flag === 0)
                <tr>
                    <th>資料名</th>
                    <th>著者</th>
                    <th>出版社</th>
                    <th>貸出日</th>
                    <th>返却日</th>                
                </tr>
                @foreach($book_hist as $index => $hist)
                <tr>
                    <td>{{$hist->title}}</td>
                    <td>{{$hist->author}}</td>
                    <td>{{$hist->publisher}}</td>
                    <td>{{$rental_hist[$index]->created_at}}</td>
                    <td>{{$rental_hist[$index]->updated_at}}</td>
                </tr>
                @endforeach
                @else
                <p>{{ $users->user_name }}さんへの貸出履歴はありません</p>
                @endif
        </table>
        </div>
            {{ $rental_hist->appends(request()->query())->links('vendor.pagination.custom') }}
    </div>
</div>

<script>
    function modal(flg){
        if(flg === 'history'){
            document.getElementById('historyModal').style.display = 'block';
        }
    }

    function modalClose(flg){
        if(flg === 'history'){
            document.getElementById('historyModal').style.display = 'none';
        }
    }

    // history modal close when click outside
    document.getElementById('historyModal').addEventListener('click',function(e) {
        if(!e.target.closest('.modalContent')){
        document.getElementById('historyModal').style.display = 'none';
        }
    })
</script>
@endsection