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
        <select name="mail_tmplt1">
          <option value="">—</option>
          <option value="1">メールテンプレート１</option>
          <option value="2">メールテンプレート2</option>
          <option value="3">メールテンプレート3</option>
        </select>
      </div><br>
      <div class="scout_mail_ttl speed"></div>
      <div class="scout_mail_tmplt speed"></div>
    </div>
  </section>
  <div class="scout_mail_btn">
    <input class="btn_orange" type="button" value="送信">
  </div>
  <section class="scout_mail_wrap">
    <h2>エコ</h2>
    <div class="scout_mail_inner">
      <p>メールテンプレート</p>
      <div class="select_arrow select_tmpl">
        <select name="mail_tmplt2">
          <option value="">—</option>
          <option value="1">メールテンプレート１</option>
          <option value="2">メールテンプレート2</option>
          <option value="3">メールテンプレート3</option>
        </select>
      </div><br>
      <div class="scout_mail_ttl eco"></div>
      <div class="scout_mail_tmplt eco"></div>
    </div>
  </section>
  <div class="scout_mail_btn">
    <input class="btn_orange" type="button" value="送信">
  </div>

  <section class="scout_mail_wrap">
    <h2>ティーク</h2>
    <div class="scout_mail_inner">
      <p>メールテンプレート</p>
      <div class="select_arrow select_tmpl">
        <select name="mail_tmplt3">
          <option value="">—</option>
          <option value="1">メールテンプレート１</option>
          <option value="2">メールテンプレート2</option>
          <option value="3">メールテンプレート3</option>
        </select>
      </div><br>
      <div class="scout_mail_ttl tique"></div>
      <div class="scout_mail_tmplt tique"></div>
    </div>
  </section>
  <div class="scout_mail_btn">
    <input class="btn_orange" type="button" value="送信">
  </div>
</article>
</main>

<script src="js/scout_mail.js"></script>
<script>
//drawer
$(function() {
  $('.drawer').drawer();
});
</script>

<?php include('common/footer.php'); ?>
