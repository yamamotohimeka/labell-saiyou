<?php include('common/resource.php'); ?>
<title>掲載広告名｜マスター登録</title>
<?php include('common/header.php'); ?>


  <article>
    <section class="top_content_wrap">

    </section>
    <section>
      <div class="container table_cmn">
        <h1 class="breadcrumb"><span>掲載広告名の追加</span></h1>
        <div class="mstr_signup">
          <div class="mstr_signup_box">
            <p>掲載広告名</p>
            <input type="text" name="掲載広告名" value="" size="68" class="signup_txt group">
          </div>
          <br>
          <div class="mstr_signup_box radio">
            <p>カテゴリ</p>
            <label><input type="radio" name="cate" value="ネット">ネット</label>
            <label><input type="radio" name="cate" value="ネット">雑誌</label>
          </div>
        </div>
        <div class="mstr_signup_btn">
          <button type="button" class="btn_orange">登録</button>
        </div>
      </div>
    </section>
  </article>

<?php include('common/footer.php'); ?>
