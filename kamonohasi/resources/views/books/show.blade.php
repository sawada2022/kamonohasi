@extends('layouts.app')
@section('content')



<button>戻る</button>

<h1>資料詳細情報</h1>

<p>資料情報</p>
<table>
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

<a href="{{ route('books.edit', $book->id) }}">編集</a>
<a href="#" id="deleteUserBtn">削除</a>
<form action="{{ route('books.destroy', $book->id) }}" method="post" type id="book-delete">
    @csrf
    @method('delete')
</form>

<p>借りている人の情報</p>
<table>
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
@endsection