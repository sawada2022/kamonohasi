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
<!-- ここに会員情報を表示 -->

<button>編集</button>
<button>削除</button>

<p>借りている本</p>
<!-- ここに会員情報を表示 -->

@endsection
