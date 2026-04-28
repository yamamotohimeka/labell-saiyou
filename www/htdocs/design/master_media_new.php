<?php include('common/resource.php'); ?>
<title>掲載求人名｜マスター登録</title>
<?php include('common/header.php'); ?>


  <article>
    <section class="top_content_wrap">

    </section>
    <section>
      <div class="container table_cmn">
        <h1 class="breadcrumb"><span>掲載求人の追加</span></h1>
        <div class="mstr_signup">
          <div class="mstr_signup_box">
            <p>掲載求人名</p>
            <input type="text" name="名前" value="" size="30" class="signup_txt group">
          </div>
          <div class="mstr_signup_box">
            <p>メールアドレス</p>
            <input type="text" name="メールアドレス" value="" size="30" class="master_name_txt mail">
            <p>＠</p>
            <div class="select_arrow select_mstr_mail">
              <select name="メールアドレス">
                <option value="">—</option>
                <option value="softbank.ne.jp">softbank.ne.jp</option>
                <option value="docomo.ne.jp">docomo.ne.jp</option>
                <option value="i.softbank.jp">i.softbank.jp</option>
                <option value="icloud.com">icloud.com</option>
                <option value="ezweb.ne.jp">ezweb.ne.jp</option>
              </select>
            </div>
          </div>
        </div>
        
        <div class="mstr_signup_btn">
          <button type="button" class="btn_orange">登録</button>
        </div>
      </div>
    </section>
  </article>

<?php include('common/footer.php'); ?>
