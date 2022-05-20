@extends('layouts.app')
@section('content')

<button>戻る</button>

<h1>会員情報詳細</h1>

<form action="" method="get">
    @csrf
    <label>
        メールアドレス
        <input type="email" name="email" value="">
    </label>
    <button>検索</button>
</form>

<p>会員情報</p>
<table>
    <tbody>
        <tr>
            <td>会員ID</td>
            <td>123456789</td>
        </tr>
        <tr>
            <td>名前</td>
            <td>山田太郎</td>
        </tr>
        <tr>
            <td>メールアドレス</td>
            <td>sample@sample.com</td>
        </tr>
        <tr>
            <td>住所</td>
            <td>東京都○○○○1丁目○○○○</td>
        </tr>
    </tbody>
</table>

<button>編集</button>
<button>削除</button>

<p>借りている本</p>
<table>
    <thead>
        <tr>
            <th>冊数</th>
            <th>資料名</th>
            <th>著者</th>
            <th>出版社</th>
            <th>貸出期限</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>phpの本</td>
            <td>山田太郎</td>
            <td>テスト出版</td>
            <td>2022年6月1日</td>
        </tr>
    </tbody>
</table>

@endsection
