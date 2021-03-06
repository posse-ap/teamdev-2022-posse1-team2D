<?php 
session_start();
require(dirname(__FILE__) . "/dbconnect.php");
$agents = isset($_SESSION['agents']) ? $_SESSION['agents'] : [];
$keep_count = $_SESSION['keep_count'];
$keep_count = intval($keep_count);

$_SESSION['keep_count'] = $keep_count;
?>



<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>お問い合わせフォーム</title>
    <!-- Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- 私たちのCSS -->
    <link href="public/css/style.css" rel="stylesheet">
    <!-- Bootstrap JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link type="text/css" rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/cupertino/jquery-ui.min.css" />

</head>

<body>
    <!-- ヘッダー -->
    <header>
        <!-- ナヴィゲーション -->
        <nav class="navbar navbar-dark fixed-top py-1 px-4" id="header">
            <!-- container-fluid・・・横幅はどのデバイスでも画面幅全体 -->
            <div class="container-fluid">

                <a class="navbar-brand fw-bold me-md-5 text-light" href="index.php">
                    <h1 class="mb-0">CRAFT</h1>
                    <div class="h6">by 就活.com</div>
                </a>

                <div class="float-end">
                    <!-- 法人ページ（ログインしている場合は管理画面、していない場合はログイン画面に遷移 -->
                    <a href="/admin/index.php" class="h5 text-light d-none d-md-inline corporation-link mx-5">法人の方へ</a>
                    <!-- ハンバーガーメニューボタン -->
                    <button class="navbar-toggler ms-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <!-- ハンバーガーメニュー内部 -->
                <div class="collapse navbar-collapse bg-light navbar-expand-lg" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 ps-3 py-2 mb-lg-0 row">
                        <li class="nav-item col-md-6">
                            <a class="h6 nav-link active text-dark" aria-current="page" href="index.php">トップページ</a>
                        </li>
                        <li class="nav-item col-md-6">
                            <a class="h6 nav-link text-dark" href="agents.php">エージェント一覧</a>
                        </li>
                        <li class="nav-item col-md-6">
                            <a class="h6 nav-link text-dark" href="index.php#CRAFTSec">CRAFTを利用した就活の流れ</a>
                        </li>
                        <li class="nav-item col-md-6">
                            <a class="h6 nav-link text-dark" href="index.php#jobHuntingSec">就活エージェントとは</a>
                        </li>
                        <li class="nav-item col-md-6">
                            <a class="h6 nav-link text-dark" href="contact.php">boozerへのお問い合わせ<i class="bi bi-pencil-square"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="wrapper">
        <!-- サンクスページ -->
        <div class="card thanks p-3 align-items-center justify-content-center m-3">
            <h1>Thanks!!</h1>
            <p class="second-size">お問い合わせを受け付けました。</p>
            <p>折り返し自動送信メール（確認メール）をお送りさせていただきました。</p>
            <p> お問い合わせ内容を確認のうえ、回答させて頂きます。 </p>
            <div class="d-flex">
                <p class="text-success">メールが届いていない場合<br>boozerへのお問い合わせ⇒</p>
                <button onclick="location.href='contact.php'" class="contact-circle align-items-center justify-content-center mx-2 text-light"><i class="bi bi-envelope"></i></button>
            </div>
            <!-- <a href="index.php" class="my-2 link-success"><i class="bi bi-skip-backward-circle"></i>Topページに戻る</a> -->
            <form action="index.php" method="post">
            <button type="submit" name="remove" class="bi bi-skip-backward-circle text-success border-0" value="">Topページに戻る</button>
            </form>
        </div>
    </div>

    </div>
        <!-- フッター -->
        <footer>
        <div id="footer">
            <div class="text-center">
                <a class="h1 mb-0 me-md-5 text-light" href="index.php">CRAFT</a>
            </div>
            <div class="text-center">
                <a class="h6 me-md-5 text-light" href="index.php">by 就活.com</a>
            </div>
            <div class="footer-nav">
                <ul class="ps-0">
                    <li>
                        <a class="text-light" href="index.php">トップページ</a>
                    </li>
                    <li>
                        <a class="text-light" href="agents.php">エージェント一覧</a>
                    </li>
                    <li>
                        <a class="text-light" href="index.php#CRAFTSec">CRAFTを利用した就活の流れ</a>
                    </li>
                    <li>
                        <a class="text-light" href="index.php#jobHuntingSec">就活エージェントとは</a>
                    </li>
                    <li>
                        <a class="text-light" href="contact.php">boozerへのお問い合わせ</a>
                    </li>
                </ul>
            </div>
        </div>

</div>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- 私たちのJS -->
    <script src="public/js/app.js"></script>
</body>

</html>