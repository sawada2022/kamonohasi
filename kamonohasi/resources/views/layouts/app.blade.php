<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <!--   <link rel="stylesheet" href="/css/main.css">CSSファイルつくる-->
    </head>
    <body>
        @include('commons/header')
        @yield('content')
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
