// ----------------Hiroki's area-------------------------------------------

// スクロール時にヘッダーにタグで絞り込むボタンを表示

// jQuery(function($){
//     $(window).on('scroll', function(){
//       if ($(window).scrollTop() > 300) {
//         $('#pagetop').fadeIn(400);
//       } else {
//         $('#pagetop').fadeOut(400);
//       }
//     });
//   });

// const tags = document.querySelectorAll(".tag");

// tags.forEach((tag) => {
//   tag.addEventListener("click", function () {
//     // console.log(this);
//     tag.classList.toggle("bi-check-lg");
//   });
// });

// blurTriggerにblurというクラス名を付ける定義

function BlurTextAnimeControl() {
  $('.blurTrigger').each(function(){ //blurTriggerというクラス名が
    var elemPos = $(this).offset().top-50;//要素より、50px上の
    var scroll = $(window).scrollTop();
    var windowHeight = $(window).height();
    if (scroll >= elemPos - windowHeight){
    $(this).addClass('blur');// 画面内に入ったらblurというクラス名を追記
    }else{
    $(this).removeClass('blur');// 画面外に出たらblurというクラス名を外す
    }
    });
}

// 画面が読み込まれたらすぐに動かしたい場合の記述
$(window).on('load', function () {
  BlurTextAnimeControl();/* アニメーション用の関数を呼ぶ*/
});// ここまで画面が読み込まれたらすぐに動かしたい場合の記述

// ドロップダウンメニュー項目を押してもドロップダウンメニューが閉じないようにする
$(".dropdown-item").on("click.bs.dropdown.data-api", (event) =>
  event.stopPropagation()
);

// タグが1つも選択されていない場合に、バリデーション
let checkedsum; //チェックが入っている個数
$('.search-agents').on("click",function(){
   checkedsum = $('.q2:checked').length; //チェックが入っているチェックボックスの取得
   if( checkedsum > 0 ){
        $('.q2').prop("required",false); //required属性の解除
   }else{
        $('.q2').prop("required",true); //required属性の付与
   }
});
// エージェント登録用のモーダルの動作
$(function () {
  $(".js-modal-open").on("click", function () {
    $(".js-modal").fadeIn();
    return false;
  });
  $(".js-modal-close").on("click", function () {
    $(".js-modal").fadeOut();
    return false;
  });
});

// エージェント更新用のモーダルの差別化
// モーダルにdata-whatever属性でsqlのデータを渡し、Ajaxでモーダルのどの部分にデータを代入するか指定する
$('#exampleModal').on('show.bs.modal', function (event) {
   var button = $(event.relatedTarget) //モーダルを呼び出すときに使われたボタンを取得
   var recipient = button.data('whatever') //data-whatever の値を取得

   //Ajaxの処理
   var modal = $(this)  //モーダルを取得
   modal.find('.modal-body form').attr("action", "edit.php?id=" + recipient) //formタグのactionに、データに対応した識別idを付与
   modal.find('.modal-body input#agent-number').val(recipient) //非表示のinputタグに識別idを付与
})
// ---------------Miu's area----------------------------------------------

let changeStars = document.querySelectorAll(".keep-btn");

changeStars.forEach((changeStar) => {
  changeStar.addEventListener("click", function () {
    console.log("a");
    changeStar.classList.remove("bi-star");
    changeStar.classList.remove("white-star");
    changeStar.classList.add("bi-star-fill");
    changeStar.classList.add("black-star");
  });
});


//バリデーション
// function check(form) {
//   if (form.student-name.value == "") {
//     alert("名前が入力されていません。");
//     form.student-name.focus();
//     return false;
//   }
//   if (form.student-university.value == "") {
//     alert("大学名が入力されていません。");
//     form.student-university.focus();
//     return false;
//   }


  // if (form.student-name.value == "") {
  //   alert("名前が入力されていません。");
  //   form.student-name.focus();
  //   return false;
  // }
  // if (form.student-name.value == "") {
  //   alert("名前が入力されていません。");
  //   form.student-name.focus();
  //   return false;
  // }
  // if (form.addr.value == "") {
  //   alert("住所が入力されていません。");
  //   form.addr.focus();
  //   return false;
  
//   return true;
// }

// プライバシーポリシーに同意したらお申込み送信
$(function(){
   $('.Form-CheckItem-Label').on('click', function(){
   if ($('#JS_CheckItem').prop("checked") == true) {
   $('.send').addClass('isActive');
   } else {
   $('.send').removeClass('isActive');
   }
   });
   });

// $(function () {
//   //始めにjQueryで送信ボタンを無効化する
//   $(".send").prop("disabled", true);

//   //始めにjQueryで必須欄を加工する
//   $("form input:required").each(function () {
//     $(this).prev("label").addClass("required");
//   });

//   //入力欄の操作時
//   $("form input:required").change(function () {
//     //必須項目が空かどうかフラグ
//     let flag = true;
//     //必須項目をひとつずつチェック
//     $("form input:required").each(function (e) {
//       //もし必須項目が空なら
//       if ($("form input:required").eq(e).val() === "") {
//         flag = false;
//       }
//     });
//     //全て埋まっていたら
//     if (flag) {
//       //送信ボタンを復活
//       $(".send").prop("disabled", false);
//     } else {
//       //送信ボタンを閉じる
//       $(".send").prop("disabled", true);
//     }
//   });
// });



//お申し込みフォーム画面の年度卒欄、灰色の選択肢を押したら黒色で入力される
let graduation = document.getElementById("graduation");
let defaultWord = document.querySelector(".default-word");

  graduation.addEventListener("change", function () {
     this.classList.add("text-dark");
     console.log(defaultWord)
     defaultWord.style.display="none";
  });

changeStars.forEach(changeStar => {
   changeStar.addEventListener('click', function () {
      console.log("a")
      changeStar.classList.remove('bi-star');
      changeStar.classList.remove('white-star');
      changeStar.classList.add('bi-star-fill');
      changeStar.classList.add('black-star');
   })
})

// プライバシーポリシーに同意したらお申込み送信
$(function(){
   $('.Form-CheckItem-Label').on('click', function(){
   if ($('#JS_CheckItem').prop("checked") == true) {
   $('.send').addClass('isActive');
   } else {
   $('.send').removeClass('isActive');
   }
   });
   });




