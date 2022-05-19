@extends(layouts.app)

@section('content')
<button>戻る</button>

<h3>会員詳細情報</h3>
<p><a href="{{route('user.create')}}">新規作成</a></p>

<form action="{{route('index')}}" method="post">
    @csrf
    <p>
        <label>会員情報<label>
        <input type="text" name="user_id">
        <input type="submit" value="検索">
    </p>
</form>
@endsection