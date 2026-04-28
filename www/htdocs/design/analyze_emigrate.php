<?php include('common/resource.php'); ?>
<title>出稼ぎ｜集計</title>
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
    <form class="analyze_info_inner" action="analyze_emigrate_result.php" method="get">
      <h2>出稼ぎ</h2>
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

        <!--店舗名-->
        <div class="white_box clear">
          <p>店舗</p>
          <div class="select_arrow select_long">
            <select id="select_shop" name="店舗" style="width: 210px;">
              <optgroup label="全て選択">
                <?php foreach ($workshop as $key => $value): ?>
                <option value=""><?php echo $value; ?></option>
                <?php endforeach; ?>
              </optgroup>
            </select>
          </div>
        </div>
        <!--面接結果-->
        <div class="white_box clear">
          <p>面接結果</p>
          <div class="select_arrow">
            <select id="select_result" name="面接結果" style="width:210px;">
              <optgroup label="全て選択">
                <option value="採用">採用</option>
                <option value="不採用">不採用</option>
                <option value="撃沈">撃沈</option>
                <option value="他店紹介">他店紹介</option>
              </optgroup>
            </select>
          </div>
        </div>


        <!--検索ボタン-->
        <div class="analyze_btn">
          <a href="analyze_emigrate_result.php"><button type="submit" class="btn_orange" id="anl_btn">検索</button></a>
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
