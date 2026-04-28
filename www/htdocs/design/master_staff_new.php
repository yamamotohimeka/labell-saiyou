<?php include('common/resource.php'); ?>
<title>スタッフ＋メールアドレス｜マスター登録</title>
<?php include('common/header.php'); ?>


  <article>
    <section class="top_content_wrap">

    </section>
    <section>
      <div class="container table_cmn">
        <h1 class="breadcrumb"><span>スタッフ＋メールアドレスの追加</span></h1>
        <div class="mstr_signup">
          <div class="mstr_signup_box">
            <p>名前 <span class="required">必須</span></p>
            <input type="text" name="名前" value="" size="30" class="master_name_txt">
            <p>ふりがな <span class="required">必須</span></p>
            <input type="text" name="ふりがな" value="" size="30" class="master_name_txt">
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
          <div class="checkbx mstr_sender">
            <label>
              <input type="checkbox" name="check_staff_sender" class="checkbx_sqar mstr_sender" value="1">
              <span class="checkbx_txt mstr_sender">採用情報送信者</span>
            </label>
          </div>
        </div>
        
        <div class="mstr_signup_btn">
          <button type="button" class="btn_orange">登録</button>
        </div>
        
      </div>
    </section>
  </article>

<?php include('common/footer.php'); ?>
