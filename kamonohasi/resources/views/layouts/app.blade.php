<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>かものはしLibrary</title>
        <!--   <link rel="stylesheet" href="/css/main.css">CSSファイルつくる-->
    </head>
    <body>
        <header>
            <div class="container">
                <a class="brand" href="/">かものはしLibrary</a>
                <img src="/image/kamonohasi.png" alt="かものはしのイラスト" />
            </div>
        </header>
        @yield('content')
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
