@extends('layouts.app')
@section('content')

<div class="homeMainArea">
    <div class="homeTitle">
        <p class="border border-color">かものはしLibrary</p>
        <img src="/image/kamonohasi.png" alt="かものはしのイラスト" /> 
    </div>

    <div class="homeBtnArea">
        <a href="{{route('rentals.index')}}" class="btn btn-malformation top-green"><i class="fa-solid fa-book-open-reader"></i><span>貸借業務</span></a>
        <a href="{{route('users.index')}}" class="btn btn-malformation top-yellow"><i class="fa-solid fa-user"></i><span>会員管理業務</span></a>
        <a href="{{route('books.index')}}" class="btn btn-malformation top-light-green"><i class="fa-solid fa-book"></i><span>資料管理業務</span></a>
    </div>
</div>
@endsection
