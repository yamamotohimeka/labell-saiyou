<?php include('common/resource.php'); ?>
<title>広告掲載エリア｜集計</title>
<?php include('common/header.php'); ?>
<?php include('common/array.php'); ?>


<article>
<section class="top_content_wrap">
</section>
<section class="">
  <div class="container analyze_wrap date_info_col">
    <h1 class="breadcrumb">&gt;&nbsp;集計</h1>
    <?php include('common/analyze_navi.php'); ?>
    <!-- date_info_inner-->
    <form class="analyze_info_inner" action="analyze_area_result.php" method="get">
      <h2>広告掲載エリア</h2>
      <!--date_left_col-->
      <div class="analyze_form_wrap">
        <!-- 申込日-->
        <div class="white_box MMedium">
          <p>申込日</p>
          <div class="select_arrow select_y">
            <select name="申込年" required>
              <option value="">—</option>
              <?php for ($i=2013; $i < 2025; $i++) : ?>
              <option value="<?php echo $i;?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <span class="select_ymd_txt">年</span>

          <div class="select_arrow select_md">
            <select name="申込月" required>
              <option value="">—</option>
              <?php for ($i=1; $i < 13; $i++) : ?>
              <option value="<?php echo $i;?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <span class="select_ymd_txt">月</span>

          <div class="select_arrow select_md">
            <select name="申込日" required>
              <option value="">—</option>
              <?php for ($i=1; $i < 32; $i++) : ?>
              <option value="<?php echo $i;?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
            </div>
          <span class="select_ymd_txt">日&nbsp;～&nbsp;</span>
          <div class="select_arrow select_y">
            <select name="申込年" required>
              <option value="">—</option>
              <?php for ($i=2013; $i < 2025; $i++) : ?>
              <option value="<?php echo $i;?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <span class="select_ymd_txt">年</span>

          <div class="select_arrow select_md">
            <select name="申込月" required>
              <option value="">—</option>
              <?php for ($i=1; $i < 13; $i++) : ?>
              <option value="<?php echo $i;?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <span class="select_ymd_txt">月</span>

          <div class="select_arrow select_md">
            <select name="申込日" required>
              <option value="">—</option>
              <?php for ($i=1; $i < 32; $i++) : ?>
              <option value="<?php echo $i;?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <span class="select_ymd_txt">日&nbsp;迄</span>
        </div>

        <!--掲載媒体-->
        <div class="white_box clear">
          <p>掲載媒体</p>
          <div class="select_arrow">
            <select name="掲載媒体" id="select_media" style="width: 210px;">
              <optgroup label="全て選択">
                <option value="">Qプリ</option>
                <option value="">ガールズヘブン</option>
                <option value="">ぴゅあじょ</option>
                <option value="">１５なび</option>
                <option value="">バニラ</option>
                <option value="">出稼ぎ.com</option>
              </optgroup>
            </select>
          </div>
        </div>

        <!--検索ボタン-->
        <div class="analyze_btn">
          <a href="analyze_area_result.php"><button type="submit" class="btn_orange" id="anl_btn">検索</button></a>
        </div>
      </div>
    </form>
  </div>
</section>
</article>

<script src="js/jquery.multiple.select.js"></script>
<script>
  $(function() {
    var $selects = $('[id^=select_]');
    $selects.multipleSelect();
  });

  //フォームの必須
  $(function(){
    $('#anl_btn').click(function(){
      if(!$(".placeholder").length) {//チェックがある場合

      }
      else {//チェックがない場合
        alert("項目を選択してください");
        return false;
      }
    });
  });
</script>
<?php include('common/footer.php'); ?>
