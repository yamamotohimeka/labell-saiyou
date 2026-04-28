<?php include('common/resource.php'); ?>
<title>スカウトメール</title>
<?php include('common/header.php'); ?>
<?php include('common/array.php'); ?>

<main role="main">
  <section class="top_content_wrap">

  </section>
<article id="scout" class="container">
  <section class="scout_mail_wrap">
    <h2>スピード</h2>
    <div class="scout_mail_inner">
      <p>メールテンプレート</p>
      <div class="select_arrow select_tmpl">
        <select name="mail_tmplt">
          <option value="">—</option>
          <option value="1">メールテンプレート１</option>
          <option value="2">メールテンプレート2</option>
          <option value="3">メールテンプレート3</option>
        </select>
      </div><br>
      <div class="scout_mail_ttl"></div>
      <div class="scout_mail_tmplt"></div>
    </div> 
  </section>
  <div class="scout_mail_btn">
    <input class="btn_orange" type="button" value="送信">
  </div>
</article>
</main>

<script>

$(function() {
  $('select').change(function() {
    var val = $(this).val();
    var tmp1 = "＜お礼のビジネスメールの例＞<br>○○会社営業部 部長<br>××様<br>いつも大変お世話になっております。<br>株式会社△△の田中です";
    var tmp2 = "取り急ぎ、ご報告があります。<br>本日、10時からの大和商会との打ち合わせですが、<br>遅刻してしまいました。<br>大事な打ち合わせでしたので、もう少し早く会社を出れば遅刻することはなかったと反省しています。";
    var tmp3 = "お疲れ様です。総務部の山田　太郎です。<br>本社会議室は、模様替え工事のため、下記期間の利用を一時停止いたします。";
    if ( val == 1 ) {
      $('.scout_mail_ttl').text("タイトル1");
      $('.scout_mail_tmplt').html(tmp1);
    }　else if ( val == 2 ) {
      $('.scout_mail_ttl').text("タイトル2");
      $('.scout_mail_tmplt').html(tmp2);
    } else if  ( val == 3 ){
      $('.scout_mail_ttl').text("タイトル3");
      $('.scout_mail_tmplt').html(tmp3);
    } else {
      $('.scout_mail_ttl').text("選択してください");
      $('.scout_mail_tmplt').text("選択してください");
    }
  });
});


//drawer
$(function() {
  $('.drawer').drawer();
});

</script>

<?php include('common/footer.php'); ?>
