@extends('layouts.app')
@section('title','資料管理業務')
@section('content')

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
                @if($flag === 1)
                <tr>
                    <td>{{ $users->id }}</td>
                    <td>{{ $users->user_name }}</td>
                    <td>{{ $users->email }}</td>
                    <td>{{ $users->adress }}</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
