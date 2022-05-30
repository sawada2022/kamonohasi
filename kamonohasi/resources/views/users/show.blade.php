@extends('layouts.app')
@section('title','会員管理業務')
@section('content')

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
                <td style="text-align: center;">貸出無し</td>
            </tr>
        </table>
        @endif
    </div>
</div>

@endsection
