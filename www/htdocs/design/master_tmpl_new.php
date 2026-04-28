<?php include('common/resource.php'); ?>
<title>メールテンプレート｜マスター登録</title>
<?php include('common/header.php'); ?>


  <article>
    <section class="top_content_wrap">

    </section>
    <section>
      <div class="container table_cmn">
        <h1 class="breadcrumb"><span>メールテンプレートの追加</span></h1>
        <div class="mstr_signup">
          <div class="mstr_signup_box">
            <p>テンプレート名</p>
            <input type="text" name="テンプレート名" value="" size="20" class="signup_txt tmpl"><br>
            <p>タイトル名</p>
            <input type="text" name="タイトル名" value="" size="20" class="signup_txt tmpl2"><br>
            <p>本文</p><br>
            <textarea name="テンプレ本文" value="" class="tmpl_txt" size="110"></textarea>
          </div>
        </div>
        
        <div class="mstr_signup_btn">
          <button type="button" class="btn_orange">登録</button>
        </div>
      </div>
    </section>
  </article>

<?php include('common/footer.php'); ?>
