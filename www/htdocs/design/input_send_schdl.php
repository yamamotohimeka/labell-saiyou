<?php include('common/resource.php'); ?>
<title>面接予定送信｜データ入力</title>
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
  <div class="send_col_wrap">
    <h2>面接予定送信</h2>
    <form class="white_box send">
      <p>グループ名を選択</p>
      <div class="select_arrow select_input_send">
        <select name="グループ名">
          <option value="">—</option>
          <option value="">難波グループ</option>
          <option value="">梅田グループ</option>
        </select>
      </div>
      <button class="btn_orange sentaku" type="submit" name="選択">選択</button>
    </form>
    <div class="input_sender_wrap">
    <p>送信先</p>
      <label for="allcheck" class="btn_wht">
        全て選択/解除<input type="checkbox" id="allcheck" style="display: none;">
      </label>
      <ul class="sender_check">
        <li>
          <label>
            <input type="checkbox" name="check_sender" class="check_sender-sqar" checked="checked">
            <span class="check_sender-txt">社長</span>
          </label>
        </li>
        <li>
          <label>
            <input type="checkbox" name="check_sender" class="check_sender-sqar" checked="checked">
            <span class="check_sender-txt">前田部長</span>
          </label>
        </li>
        <li>
          <label>
            <input type="checkbox" name="check_sender" class="check_sender-sqar" checked="checked">
            <span class="check_sender-txt">岩崎部長</span>
          </label>
        </li>
        <li>
        <label>
          <input type="checkbox" name="check_sender" class="check_sender-sqar" checked="checked">
          <span class="check_sender-txt">すけ</span>
        </label>
      </li>
      <li>
        <label>
          <input type="checkbox" name="check_sender" class="check_sender-sqar" checked="checked">
          <span class="check_sender-txt">かまちゃん</span>
        </label>
      </li>
      <li>
        <label>
          <input type="checkbox" name="check_sender" class="check_sender-sqar" checked="checked">
          <span class="check_sender-txt">スワン</span>
        </label>
      </li>
      <li>
        <label>
          <input type="checkbox" name="check_sender" class="check_sender-sqar" checked="checked">
          <span class="check_sender-txt">メンディー</span>
        </label>
      </li>
      </ul>
    </div>
    
    <div class="send_col_wrap">
    <div class="info_send">
      <a href="input_mail_schdl.php"><button type="button">送信確認</button></a>
    </div>
    <div class="info_return">
      <a href="input_send.php"><button type="button">前のページに戻る <i class="fa fa-undo"></i></button></a>
    </div>
  </div>
  </div>
</section>

</main>

<script type="text/javascript">
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
