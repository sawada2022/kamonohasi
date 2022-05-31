@if ( !request()->is('/') )
<header>
    <div class="headerLeft">
        <a href="/">
            <p class="headerText border border-color">かものはしLibrary</p>
        </a>
        <img src="/image/kamonohasi.png" alt="かものはしのイラスト" />          
        <p class="headerText">@yield('title')</p>
    </div>
    <div class="headerRight">
        <a class="indexLinkBar" href="{{route('rentals.index')}}">
            <p class="headerTextLink">貸借業務</p>
        </a>
        <a class="indexLinkBar" href="{{route('users.index')}}">
            <p class="headerTextLink">会員管理業務</p>
        </a>
        <a class="indexLinkBar" href="{{route('books.index')}}">
            <p class="headerTextLink">資料管理業務</p>
        </a>
    </div>
</header>
@endif
