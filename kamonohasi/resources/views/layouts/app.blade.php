<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>かものはしLibrary</title>
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        @include('commons/header')
        @yield('content')
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
