<?php include('common/resource.php'); ?>
<title>採用情報送信｜データ入力</title>
<?php include('common/header.php'); ?>
<?php include('common/array.php'); ?>


<header role="banner">
  <div class="interview_modal">
    <button type="button" class="drawer-toggle drawer-hamburger button">
    面接予定はこちら
    </button>
    <nav class="drawer-nav" role="navigation">
      <div class="drawer-menu">
      面接予定はいります
      </div>
    </nav>
  </div>
</header>

<main role="main">
<section class="top_content_wrap">

  </section>
<section class="container send_col">
  <h2>採用情報送信</h2>
  <div class="input_sender_wrap">
    <p>送信先</p>
      <label for="allcheck" class="btn_wht">
        全て選択/解除<input type="checkbox" id="allcheck" style="display: none;">
      </label>
    <ul class="sender_check">
      <li>
        <label>
          <input type="checkbox" name="check_sender" class="check_sender-sqar" value="1">
          <span class="check_sender-txt">社長</span>
        </label>
      </li>
      <li>
        <label>
          <input type="checkbox" name="check_sender" class="check_sender-sqar">
          <span class="check_sender-txt">前田部長</span>
        </label>
      </li>
      <li>
        <label>
          <input type="checkbox" name="check_sender" class="check_sender-sqar">
          <span class="check_sender-txt">岩崎部長</span>
        </label>
      </li>
      <li>
        <label>
          <input type="checkbox" name="check_sender" class="check_sender-sqar">
          <span class="check_sender-txt">猿木</span>
        </label>
      </li>
      <li>
        <label>
          <input type="checkbox" name="check_sender" class="check_sender-sqar">
          <span class="check_sender-txt">藤村</span>
        </label>
      </li>
      <li>
        <label>
          <input type="checkbox" name="check_sender" class="check_sender-sqar">
          <span class="check_sender-txt">スカイ</span>
        </label>
      </li>
      <li>
        <label>
          <input type="checkbox" name="check_sender" class="check_sender-sqar">
          <span class="check_sender-txt">くろちゃん</span>
        </label>
      </li>
      <li>
        <label>
          <input type="checkbox" name="check_sender" class="check_sender-sqar">
          <span class="check_sender-txt">あき</span>
        </label>
      </li>
      <li>
        <label>
          <input type="checkbox" name="check_sender" class="check_sender-sqar">
          <span class="check_sender-txt">ワイルド</span>
        </label>
      </li>
      <li>
        <label>
          <input type="checkbox" name="check_sender" class="check_sender-sqar">
          <span class="check_sender-txt">ニンニン</span>
        </label>
      </li>
      <li>
        <label>
          <input type="checkbox" name="check_sender" class="check_sender-sqar">
          <span class="check_sender-txt">りょうま</span>
        </label>
      </li>
      <li>
        <label>
          <input type="checkbox" name="check_sender" class="check_sender-sqar">
          <span class="check_sender-txt">りー</span>
        </label>
      </li>
      <li>
        <label>
          <input type="checkbox" name="check_sender" class="check_sender-sqar">
          <span class="check_sender-txt">きーぼー</span>
        </label>
      </li>
      <li>
        <label>
          <input type="checkbox" name="check_sender" class="check_sender-sqar">
          <span class="check_sender-txt">そうき</span>
        </label>
      </li>
      <li>
        <label>
          <input type="checkbox" name="check_sender" class="check_sender-sqar">
          <span class="check_sender-txt">すけ</span>
        </label>
      </li>
      <li>
        <label>
          <input type="checkbox" name="check_sender" class="check_sender-sqar">
          <span class="check_sender-txt">かまちゃん</span>
        </label>
      </li>
      <li>
        <label>
          <input type="checkbox" name="check_sender" class="check_sender-sqar">
          <span class="check_sender-txt">スワン</span>
        </label>
      </li>
      <li>
        <label>
          <input type="checkbox" name="check_sender" class="check_sender-sqar">
          <span class="check_sender-txt">メンディー</span>
        </label>
      </li>
    </ul>
  </div>
  <div class="send_col_wrap">
    <div class="info_send">
      <a href="input_mail_rcrt.php"><button type="button">送信確認</button></a>
    </div>
    <div class="info_return">
      <a href="input_send.php"><button type="button">前のページに戻る <i class="fa fa-undo"></i></button></a>
    </div>
  </div>
</section>

</main>

<script>
//一括チェック

$('#allcheck').on('click', function() {
    $('input[name=check_sender]').prop('checked', this.checked);
});


//drawer
$(function() {
  $('.drawer').drawer();
});

</script>

<?php include('common/footer.php'); ?>
