<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>かものはしLibrary<title>
         <!--   <link rel="stylesheet" href="/css/main.css">CSSファイルつくる-->
    </head>
    <body>
        <header>
            <div class="container">
                <a class="brand" href="/">かものはしLibrary</a>
                <?php
                    $filePath = '/kamonohasi.png';
                    $data = file_get_contents($filePath);// パスから画像データを取得
                    header('Content-type: image/jpg');// header関数でコンテンツの形式が画像であると宣言
                    echo $data;//データを出力
                ?>
            </div>
        </header>
    </body>
</html>