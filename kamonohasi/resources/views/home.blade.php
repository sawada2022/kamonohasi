@extends('layouts.app')
@section('content')


<a href="{{route('rentals.index')}}">貸借業務</a>
<a href="{{route('users.index')}}">会員管理業務</a>
<a href="{{route('books.index')}}">資料管理業務</a>


@endsection
