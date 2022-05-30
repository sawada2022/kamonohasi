@extends('layouts.app')
@section('content')


<a href="{{route('rentals.index')}}" class="btn btn-malformation top-green">貸借業務</a>
<a href="{{route('users.index')}}" class="btn btn-malformation top-yellow">会員管理業務</a>
<a href="{{route('books.index')}}" class="btn btn-malformation top-light-green">資料管理業務</a>


@endsection
