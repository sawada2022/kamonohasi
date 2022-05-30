@extends('layouts.app')
@section('content')

@include('commons/backBtn', ['path' => 'rentals'])

<div class="card rentalResult">
    <p class="rentalShowText"><i class="fa-solid fa-check"></i><span>以下の内容で貸し出し完了しました</span></p>

    <div class="rentalShowUserFlex">
        <h3>会員情報</h3>
        <p>ID：{{ $users->id }}</p>
        <p>名前：{{ $users->user_name }}</p>
    </div>

    <div class="rentalsShow">
        <table class="tableBase" frame="void">
            <thead>
                <tr>
                    <th>冊数</th>
                    <th>資料名</th>
                    <th>著者</th>
                    <th>出版社</th>
                    <th>貸出日</th>
                    <th>貸出期限</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $index => $book)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->publisher }}</td>
                    <td>{{ $rentaldate }}</td>
                    <td>{{ $deadline }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
