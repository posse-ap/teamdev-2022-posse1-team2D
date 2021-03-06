<?php
require('../dbconnect.php');
if (isset($_GET)) {
  try {
    $id = $_GET['id'];
    $name = $_GET['name'];
    $img = $_GET['img'];
    $url = $_GET['url'];
    $industry = $_GET['industry'];
    $tag = $_GET['tag'];
    $representative = $_GET['representative'];
    $address = $_GET['address'];
  } catch (PDOException $e) {
    exit('データベースに接続できませんでした。' . $e->getMessage());
  }
}
?>
<?php 
$keep_count = $_SESSION['keep_count'];
$keep_count = intval($keep_count);
?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>詳細ページ</title>
  <!-- Bootstrap CSS-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- Bootstrap Icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <!-- 私たちのCSS -->
  <link href="../public/css/style.css" rel="stylesheet">
  <!-- Bootstrap JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
  <!-- ヘッダー -->
  <header>
    <!-- ナヴィゲーション -->
    <nav class="navbar navbar-dark fixed-top py-1 px-4" id="header">
      <!-- container-fluid・・・横幅はどのデバイスでも画面幅全体 -->
      <div class="container-fluid">

        <a class="navbar-brand fw-bold me-md-5 text-light" href="../index.php">
          <h1 class="mb-0">CRAFT</h1>
          <div class="h6">by 就活.com</div>
        </a>

        <div class="float-end">
          <!-- 法人ページ（ログインしている場合は管理画面、していない場合はログイン画面に遷移 -->
          <a href="/admin/index.php" class="h5 text-light d-none d-md-inline corporation-link">法人の方へ</a>
          <!-- キープマーク -->
          <a href="../keep.php" class="keep-star ms-5">
            <i class="bi bi-star text-light" style="font-size: 1.6rem;"></i>
            <span class="d-inline bg-danger px-2 py-1 text-white circle"><?php echo $keep_count; ?></span>
          </a>
          <!-- ハンバーガーメニューボタン -->
          <button class="navbar-toggler ms-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
        <!-- ハンバーガーメニュー内部 -->
        <div class="collapse navbar-collapse bg-light navbar-expand-lg" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 ps-3 py-2 mb-lg-0 row">
            <li class="nav-item col-md-6">
              <a class="h6 nav-link active text-dark" aria-current="page" href="../index.php">トップページ</a>
            </li>
            <li class="nav-item col-md-6">
              <a class="h6 nav-link text-dark" href="../agents.php">エージェント一覧</a>
            </li>
            <li class="nav-item col-md-6">
              <a class="h6 nav-link text-dark" href="../index.php#CRAFTSec">CRAFTを利用した就活の流れ</a>
            </li>
            <li class="nav-item col-md-6">
              <a class="h6 nav-link text-dark" href="../index.php#jobHuntingSec">就活エージェントとは</a>
            </li>
            <li class="nav-item col-md-6">
              <a class="h6 nav-link text-dark" href="../contact.php">boozerへのお問い合わせ<i class="bi bi-pencil-square"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <!-- コンテンツ -->
  <div class="wrapper">
    <div class="first-size"><a href="../result.php"><i class="bi bi-arrow-left-circle link-dark" type="button" onclick="window.close();" value="window.close()" href="../result.php"></i></a>エージェント企業一覧に戻る</div>
    <div class="container rounded col-10">
      <div class="row d-flex py-2 my-3">
        <div class="col-md-5"><img src="../public/images/<?php echo $img; ?>" class="" alt="企業ロゴ"></div>
        <div class="col-md-7 ">
          <p class="h1 fw-bold py-2"><?= $name ?></p>
          <p class="forth-size mb-0"><i class="bi bi-tags-fill text-success"></i><span class="fw-bold">タグ</span></p>
          <p class="forth-size">
            <?= $tag; ?>
          </p>
          <p class="forth-size mb-0 fw-bold"><i class="bi bi-megaphone-fill pe-1 text-success"></i>強みの業界</p>
          <p class="forth-size"><?= $industry; ?></p>
          <p class="forth-size"><span class="fw-bold">・代表者：</span><?= $representative ?></p>
          <p class="forth-size"><span class="fw-bold">・所在地：</span><?= $address ?></p>
          <div class="py-2">
            <a href="<?= $url; ?>" class="forth-size" target="_blank" rel="noopener noreferrer">・公式サイト<i class="bi bi-box-arrow-up-right"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="d-flex flex-column align-items-center">
      <form action="" method="POST">
        <input type="hidden" name="keep_id" value="<?= $id; ?>">
        <input type="hidden" name="name" value="<?= $name; ?>">
        <!-- tagの名前 -->
        <?php foreach ((array)$tags as $key => $tag) : ?>
            <input type="hidden" name="tags[]" value="<?= $tag; ?>">
        <?php endforeach; ?>
        <input type="hidden" name="official_site" value="<?= $url; ?>">
        <input type="hidden" name="detail" value="agent-details/agent1.php?name=<?= $name; ?>&url=<?= $url; ?>&tag=<?php foreach ($tags as $key => $tag) {
                                                                                                                                                                        echo $tag . ' ';
                                                                                                                                                             } ?>&representative=<?= $representative; ?>&address=<?= $address; ?>&img=<?= $img; ?>?>">
        <input type="hidden" name="logo" value="<?= $img; ?>">
      </form>
    </div>
  </div>
   <!-- フッター -->
   <footer>
        <div id="footer">
            <div class="text-center">
                <a class="h1 mb-0 me-md-5 text-light" href="../index.php">CRAFT</a>
            </div>
            <div class="text-center">
                <a class="h6 me-md-5 text-light" href="../index.php">by 就活.com</a>
            </div>
            <div class="footer-nav">
                <ul class="ps-0">
                    <li>
                        <a class="text-light" href="../index.php">トップページ</a>
                    </li>
                    <li>
                        <a class="text-light" href="../agents.php">エージェント一覧</a>
                    </li>
                    <li>
                        <a class="text-light" href="../index.php#CRAFTSec">CRAFTを利用した就活の流れ</a>
                    </li>
                    <li>
                        <a class="text-light" href="../index.php#jobHuntingSec">就活エージェントとは</a>
                    </li>
                    <li>
                        <a class="text-light" href="../contact.php">boozerへのお問い合わせ</a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>

  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- 私たちのJS -->
  <script src="../public/js/app.js"></script>
</body>