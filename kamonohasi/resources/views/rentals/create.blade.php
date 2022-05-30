@extends('layouts.app')
@section('title','貸し借り業務')
@section('content')

<div id="userModal" class="modal">
    <div class="modalContent">
        <table class="tableBase" frame="void">
            <tr>
                <th>ID</th>
                <td>{{$users->id}}</td>
            </tr>
            <tr>
                <th>名前</th>
                <td>{{$users->user_name}}</td>
            </tr>
            <tr>
                <th>住所</th>
                <td>{{$users->adress}}</td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td>{{$users->tel}}</td>
            </tr>
        </table>
        <button class="modalBtn" onclick="modalClose('user')"><i class="fa-solid fa-xmark modalIcon"></i></button>
    </div>
</div>

<div  id="bookModal" class="modal">
    <div class="modalContent">
        <table class="tableBase" frame="void">
            @if($rental_flag === 0)
            <tr>
                <th>資料名</th>
                <th>著者</th>
                <th>貸出期限</th>
            </tr>
            @foreach($rentals as $index => $rental)
            <tr>
                <td>{{$rental->title}}</td>
                <td>{{$rental->author}}</td>
                <td>{{$rentalsAll[$index]->deadline}}</td>
            </tr>

            @endforeach
            @else
            <p>現在、{{$users->user_name}}さんに貸し出している本はありません。</p>
            @endif
        </table>
        <button class="modalBtn" onclick="modalClose('book')"><i class="fa-solid fa-xmark modalIcon"></i></button>
    </div>
</div>

@include('commons/backBtn', ['path' => 'rentals'])

<div class="mainContentFlex">
    <div class="showTableFlex card">
        <h3 class="rentalCardTitle">会員情報</h3>
        <table class="tableBase" frame="void">
            <tr>
                <th>ID</th>
                <td>{{$users->id}}</td>
            </tr>
            <tr>
                <th>名前</th>
                <td>{{$users->user_name}}</td>
            </tr>
            <tr>
                <th>備考</th>
                <td>{{$users->comment}}</td>
            </tr>
        </table>

        <div class="btnFlex">
            <button class="btnBase" onclick="modal('user')"><i class="fa-solid fa-user"></i><span>会員詳細</span></button>
            <button class="btnBase" onclick="modal('book')"><i class="fa-solid fa-book"></i><span>借りてる本の詳細</span></button>
        </div>
    </div>

    <div class="showTableFlex card">
        <h3 class="rentalCardTitle">資料情報</h3>
        <form class="rentalIndexForm rentalCardForm" action="{{route('rentals.create')}}" method="get">
        @csrf
            資料ID
            <input type="hidden" name="user_id" value="{{$users->id}}">
            <input type="number" class="input" name="book_id" min="1">
            <button class="btnBase btn-green"><span>追加</span><i class="fa-solid fa-plus"></i></button>
        </form>

        @include('commons/flash')

        @if($book_flag === 0)
        <table class="tableBase" frame="void">
            <tr>
                <th>資料名</th>
                <th>著者</th>
                <th>出版社</th>
            </tr>
            @foreach($books as $index => $book)
            <tr>
                <td>{{$book->title}}</td>
                <td>{{$book->author}}</td>
                <td>{{$book->publisher}}</td>
                <td>
                    <form action="{{ route('rentals.create') }}" method="get">
                        @csrf
                        <input type="hidden" name="delete_index" value="{{ $index }}">
                        <input type="hidden" name="user_id" value="{{ $users->id }}">
                        <button class="btnBase"><i class="fa-solid fa-trash"></i><span>削除</span></button>
                    </form>
                </td>
                <input type='hidden' name='added_book_ids[]' value="{{$book->id}}">
            </tr>
            @endforeach
        </table>
        @endif

        @if($books)
        </form>
        <form action="{{route('rentals.store')}}" method="post">
            @csrf
            <input type="text" value="{{$users->id}}" name="user_id_rental" style='display:none;'>
            <button class="btnBase btn-green"><i class="fa-solid fa-check"></i><span>貸し出し</span></button>
        </form>
        @endif
    </div>
</div>

<script>
    function modal(flg){
        if(flg === 'user'){
            document.getElementById('userModal').style.display = 'block';
            document.getElementById('userModal').style.animation = 'show 0.15s linear 0s';
        }else if(flg === 'book'){
            document.getElementById('bookModal').style.display = 'block';
            document.getElementById('bookModal').style.animation = 'show 0.15s linear 0s';
        }
    }

    function modalClose(flg){
        if(flg === 'user'){
            document.getElementById('userModal').style.display = 'none';
        }else if(flg === 'book'){
            document.getElementById('bookModal').style.display = 'none';
        }
    }

    // user modal close when click outside
    document.getElementById('userModal').addEventListener('click',function(e) {
        if(!e.target.closest('.modalContent')){
        document.getElementById('userModal').style.display = 'none';
        }
    })

    // book modal close when click outside
    document.getElementById('bookModal').addEventListener('click',function(e) {
        if(!e.target.closest('.modalContent')){
        document.getElementById('bookModal').style.display = 'none';
        }
    })

</script>

@endsection
