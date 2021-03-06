<?php
session_start();

use LDAP\Result;

require(dirname(__FILE__) . "/dbconnect.php");
require(dirname(__FILE__) . "/uni-info.php");
$agents = isset($_SESSION['agents']) ? $_SESSION['agents'] : [];

if (empty($_SESSION['keep_count'])) {
  $keep_count = 0;
  $_SESSION['keep_count'] = $keep_count;
} else {
  $keep_count = $_SESSION['keep_count'];
}

// 変数の初期化
$page_flag = 0;

if (!empty($_POST['btn_confirm'])) {
  $page_flag = 1;
} elseif (!empty($_POST['btn_submit'])) {
  $page_flag = 2;
}
?>
<?php
// 使ってない
if (isset($_POST['student_name'], $_POST['student_university'], $_POST['student_faculty'], $_POST['student_department'], $_POST['student_graduation'], $_POST['student_tel'], $_POST['student_department'])) {
  $keep_name = isset($_POST['name']) ? htmlspecialchars($_POST['name'], ENT_QUOTES, 'utf-8') : ' ';
  $keep_id = isset($_POST['keep_id']) ? htmlspecialchars($_POST['keep_id'], ENT_QUOTES, 'utf-8') : ' ';
  $keep_email = isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES, 'utf-8') : ' ';
}
?>
<?php
$student_email = isset($_POST['student_email']) ? htmlspecialchars($_POST['student_email'], ENT_QUOTES, 'utf-8') : ' ';
$_SESSION['student_email'] = $student_email;
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
  <link type="text/css" rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/cupertino/jquery-ui.min.css" />
  <!-- 私たちのCSS -->
  <link href="public/css/style.css" rel="stylesheet">
  <!-- Bootstrap JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <!-- 郵便番号→住所自動化プラグイン -->
  <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>

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
          <a href="/admin/index.php" class="h5 text-light d-none d-md-inline corporation-link">法人の方へ</a>
          <!-- キープマーク -->
          <a href="keep.php" class="keep-star ms-5">
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
    <h2>お問い合わせ手続き</h2>
    <div class="Form">
      <?php if ($page_flag === 1) : ?>
        <form action="/admin/agent-index.php" method="POST">
          <p class="mb-2 h5 text-center">ご入力情報の確認</p>
          <!-- どの企業をキープしたかのエージェントのid -->
          <!-- foreachでキープした企業の数だけ、以下のinputタグを生成し、valueに、キープしたエージェントidをセット -->
          <?php foreach ($agents as $name => $agent) : ?>
            <input type="hidden" name="keep_agent_id[]" value="<?= $agent['keep_id']; ?>">
          <?php endforeach; ?>
          <div class="Form-Item">
            <p class="Form-Item-Label">
              <span class="Form-Item-Label-Required">必須</span>氏名
            </p>
            <input type="text" name="student_name" class="Form-Item-Input" value="<?= $_POST['student_name']; ?>" required>
          </div>
          <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>大学名</p>
            <input type="text" name="student_university" class="Form-Item-Input" value="<?php
                                                                                        for ($i = 0; $i < count($_POST["student_university"]); $i++) {
                                                                                          echo $_POST["student_university"][$i];
                                                                                        }
                                                                                        ?>" required>
          </div>
          <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>学部名</p>
            <input type="text" name="student_faculty" class="Form-Item-Input" value="<?= $_POST['student_faculty']; ?>" required>
          </div>
          <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>学科名</p>
            <input type="text" name="student_department" class="Form-Item-Input" value="<?= $_POST['student_department']; ?>" required>
          </div>
          <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>年度卒</p>
            <input type="text" name="student_graduation" class="Form-Item-Input" value="<?= $_POST['student_graduation']; ?>" required>
          </div>
          <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>電話</p>
            <input type="tel" name="student_tel" pattern="\d{2,4}-\d{3,4}-\d{3,4}" class="Form-Item-Input" value="<?= $_POST['student_tel']; ?>" required>
          </div>
          <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>メールアドレス</p>
            <input type="email" name="student_email" class="Form-Item-Input" value="<?= $_POST['student_email']; ?>" required>
          </div>
          <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>郵便番号</p>
            <!-- ▼郵便番号入力フィールド(3桁+4桁) -->
            <input type="text" name="zip21" style="background-color: #eaedf2; border: 1px solid #ddd; border-radius: 6px; margin-left: 40px;" size="4" maxlength="3" value="<?= $_POST['zip21']; ?>"> － <input type="text" name="zip22" style="background-color: #eaedf2; border: 1px solid #ddd; border-radius: 6px;" value="<?= $_POST['zip22']; ?>" size="5" maxlength="4" onKeyUp="AjaxZip3.zip2addr('zip21','zip22','addr21','addr21');">
          </div>
          <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>住所</p>
            <!-- ▼住所入力フィールド(都道府県+以降の住所) -->
            <input type="text" name="addr21" class="Form-Item-Input" value="<?= $_POST['addr21']; ?>" required>
          </div>
          <div class="Form-Item">
            <p class="Form-Item-Label isMsg"><span class="Form-Item-Label-Required">任意</span>お問い合わせ内容</p>
            <textarea name="student_content" class="Form-Item-Textarea"><?= $_POST['student_content']; ?></textarea>
          </div>
          <p>この内容で送信してよろしいですか？</p>
          <input type="submit" name="btn_back" class="Form-Btn unchecked" onclick=history.back() value="修正する">
          <input type="submit" name="btn_submit" class="Form-Btn unchecked" value="送信">
        </form>

        <!-- サンクスページ -->
      <?php elseif ($page_flag === 2) : ?>
        <div class="card thanks p-3 align-items-center justify-content-center">
          <h3>Thanks!!</h3>
          <p class="second-size">お問い合わせを受け付けました。</p>
          <p>折り返し自動送信メール（確認メール）をお送りさせていただきました。？？？？</p>
          <p> お問い合わせ内容を確認のうえ、回答させて頂きます。 </p>
          <div class="d-flex">
            <p>メールが届いていない場合<br>boozerへのお問い合わせ⇒</p>
            <button onclick="location.href='contact.php'" class="contact-circle  align-items-center justify-content-center mx-2 text-light"><i class="bi bi-envelope"></i></button>
          </div>
          <a href="index.php" class="my-2 link-success"><i class="bi bi-skip-backward-circle"></i>Topページに戻る</a>
        </div>


        <!-- 1. 最初の入力画面 -->
      <?php else : ?>
        <form action="" method="POST" onsubmit="return check(this)">
          <p class="mb-2 h6 text-center">必須事項をご記入の上、<br>お問い合わせ内容を入力してください。</p>
          <div class="Form-Item">
            <p class="Form-Item-Label">
              <span class="Form-Item-Label-Required">必須</span>氏名
            </p>
            <input type="text" name="student_name" class="Form-Item-Input" placeholder="例）山田太郎" required>
          </div>
          <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>大学名</p>
            <!-- <input type="text" name="student_university" class="Form-Item-Input" placeholder="例）慶應義塾大学" required> -->

            <!-- 大学の分類ラジオボタン -->
            <div class="d-flex" style="margin-left: 40px;">
              <div class="">
                <input class="" type="radio" name="maker" onclick="formSwitch()">
                <label class=""> 国立大学</label>
              </div>
              <div class="">
                <input class="" type="radio" name="maker" onclick="formSwitch()">
                <label class=""> 私立大学</label>
              </div>
            </div>
          </div>
          <!-- ラジオボタンで分岐 -->
          <div class="">
            <div id="nationalList" class="Form-Item">
              <p class="Form-Item-Label">国立大学：</p>
              <input type="text" value="" name="student_university[]" class="Form-Item-Input" list="nationalUniv" placeholder="例）入力すると候補が表示されます" autocomplete="off">
              <datalist id="nationalUniv" class="target">
                <?php foreach ($national_universities as $key => $national_university) : ?>
                  <option value="<?= $national_university; ?>"></option>
                <?php endforeach; ?>
              </datalist>
            </div>
            <div id="PrivateList" class="Form-Item">
              <p class="Form-Item-Label">私立大学：</p>
              <input type="text" value="" name="student_university[]" class="Form-Item-Input" list="privateUniv" placeholder="例）入力すると候補が表示されます" autocomplete="off">
              <datalist id="privateUniv">
                <?php foreach ($private_universities as $key => $private_university) : ?>
                  <option value="<?= $private_university; ?>">
                  <?php endforeach; ?>
              </datalist>
            </div>
          </div>
          <!-- 大学ここまで -->

          <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>学部名</p>
            <input type="text" name="student_faculty" class="Form-Item-Input" placeholder="例）理工学部" required>
          </div>
          <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>学科名</p>
            <input type="text" name="student_department" class="Form-Item-Input" placeholder="例）管理工学科" required>
          </div>
          <!-- プルダウンメニュー -->
          <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>年度卒</p>
            <select name="student_graduation" id="graduation" class="Form-Item-Input text-secondary" required>
              <option value="" class="text-secondary default-word" hidden>選択してください</option>
              <option value="2023" class="text-dark graduation">2023年卒</option>
              <option value="2024" class="text-dark graduation">2024年卒</option>
              <option value="2025" class="text-dark graduation">2025年卒</option>
              <option value="2026" class="text-dark graduation">2026年卒</option>
            </select>
          </div>
          <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>電話</p>
            <input type="tel" name="student_tel" pattern="\d{2,4}-\d{3,4}-\d{3,4}" class="Form-Item-Input" placeholder="例）000-0000-0000" required>
          </div>
          <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>メールアドレス</p>
            <input type="email" name="student_email" class="Form-Item-Input" placeholder="例）example@gmail.com" required>
          </div>
          <!-- ▼郵便番号入力フィールド(3桁+4桁) -->
          <div class="Form-Item">
            <p style="font-size: 14px;">※郵便番号のご入力で住所が自動表示されます。</p>
            <input type="text" name="zip21" style="background-color: #eaedf2; border: 1px solid #ddd; border-radius: 6px;" size="4" maxlength="3"> － <input type="text" name="zip22" style="background-color: #eaedf2; border: 1px solid #ddd; border-radius: 6px;" size="5" maxlength="4" onKeyUp="AjaxZip3.zip2addr('zip21','zip22','addr21','addr21');">
          </div>
          <div class="Form-Item">
            <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>住所</p>
            <!-- ▼住所入力フィールド(都道府県+以降の住所) -->
            <input type="text" name="addr21" class="Form-Item-Input" size="60" placeholder="例）東京都世田谷区１丁目" required>
          </div>
          <div class="Form-Item">
            <p class="Form-Item-Label isMsg"><span class="Form-Item-Label-Required">任意</span>お問い合わせ内容</p>
            <textarea name="student_content" class="Form-Item-Textarea"></textarea>
          </div>
          <div id="hoge" class="box px-2 mx-3">
            <p>プライバシーポリシー</p>
            <p>CRAFT（以下,「当社」といいます。）は,本ウェブサイト上で提供するサービス（以下,「本サービス」といいます。）における，ユーザーの個人情報の取扱いについて，以下のとおりプライバシーポリシー（以下，「本ポリシー」といいます。）を定めます。</p>
            <p>第1条（個人情報）<br>「個人情報」とは，個人情報保護法にいう「個人情報」を指すものとし，生存する個人に関する情報であって，当該情報に含まれる氏名，生年月日，住所，電話番号，連絡先その他の記述等により特定の個人を識別できる情報及び容貌，指紋，声紋にかかるデータ，及び健康保険証の保険者番号などの当該情報単体から特定の個人を識別できる情報（個人識別情報）を指します。</p>
            <p>第2条</p>
            <p>第3条</p>
          </div>
          <label class="Form-CheckItem-Label">
            <input type="checkbox" name="" value="" id="check" class="Form-CheckItem-Label-Input" disabled>
            <span class="Form-CheckItem-Label-CheckIcon"></span>
            <span class="Form-CheckItem-Label-SquareIcon"></span>
            <span class="Form-CheckItem-Label-Text">プライバシーポリシーに同意する</span>
          </label>
    </div>
    <input type="submit" name="btn_confirm" class="Form-Btn send" value="入力内容を確認する">
    </form>
  <?php endif; ?>
  </div>

  </div>
  <!-- フッター -->
  <footer class="">
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
  </footer>


  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <!-- 私たちのJS -->
  <script src="public/js/app.js"></script>
  <script>
    function formSwitch() {
      hoge = document.getElementsByName('maker')
      if (hoge[0].checked) {
        // 好きな食べ物が選択されたら下記を実行します
        document.getElementById('nationalList').style.display = "";
        document.getElementById('PrivateList').style.display = "none";
      } else if (hoge[1].checked) {
        // 好きな場所が選択されたら下記を実行します
        document.getElementById('nationalList').style.display = "none";
        document.getElementById('PrivateList').style.display = "";
      } else {
        document.getElementById('nationalList').style.display = "none";
        document.getElementById('PrivateList').style.display = "none";
      }
    }
    window.addEventListener('load', formSwitch());
  </script>
</body>

</html>