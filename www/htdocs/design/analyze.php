<?php include('common/resource.php'); ?>
<title>採用数｜集計</title>
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
    <form class="analyze_info_inner" action="analyze_result.php" method="get">
      <h2>採用数</h2>
      <!--date_left_col-->
      <div class="analyze_form_wrap">
        <!-- 入店日-->
        <div class="white_box MMedium">
          <p>入店日</p>
          <div class="select_arrow select_y">
            <select name="入店年" required>
              <option value="">—</option>
              <?php for ($i=2013; $i < 2025; $i++) : ?>
              <option value="<?php echo $i;?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <span class="select_ymd_txt">年</span>

          <div class="select_arrow select_md">
            <select name="入店月" required>
              <option value="">—</option>
              <?php for ($i=1; $i < 13; $i++) : ?>
              <option value="<?php echo $i;?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <span class="select_ymd_txt">月</span>

          <div class="select_arrow select_md">
            <select name="入店日" required>
              <option value="">—</option>
              <?php for ($i=1; $i < 32; $i++) : ?>
              <option value="<?php echo $i;?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <span class="select_ymd_txt">日&nbsp;～&nbsp;</span>
          <div class="select_arrow select_y">
            <select name="入店年" required>
              <option value="">—</option>
              <?php for ($i=2013; $i < 2025; $i++) : ?>
              <option value="<?php echo $i;?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <span class="select_ymd_txt">年</span>

          <div class="select_arrow select_md">
            <select name="入店月" required >
              <option value="">—</option>
              <?php for ($i=1; $i < 13; $i++) : ?>
              <option value="<?php echo $i;?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <span class="select_ymd_txt">月</span>

          <div class="select_arrow select_md">
            <select name="入店日" required>
              <option value="">—</option>
              <?php for ($i=1; $i < 32; $i++) : ?>
              <option value="<?php echo $i;?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <span class="select_ymd_txt">日&nbsp;迄</span>
        </div>
        <!--店舗-->
        <div class="white_box clear">
          <p>店舗</p>
          <div class="select_arrow select_long">
            <select id="select_shop" class="req01" style="width: 210px;">
              <optgroup label="全て選択">
                <?php foreach ($workshop as $key => $value): ?>
                <option value=""><?php echo $value; ?></option>
                <?php endforeach; ?>
              </optgroup>
            </select>
          </div>
        </div>
        <!-- 掲載求人 -->
        <div class="white_box clear">
          <p>掲載求人</p>
          <div class="select_arrow select_medium">
            <select id="select_recruit" class="req02" name="掲載求人" style="width: 210px;">
              <optgroup label="全て選択">
                <?php foreach ($jobshop as $key => $value): ?>
                <option value=""><?php echo $value; ?></option>
                <?php endforeach; ?>
              </optgroup>
            </select>
          </div>
        </div>
        <!--検索ボタン-->
        <div class="analyze_btn">
          <a href="analyze_result.php"><button id="anl_btn" type="submit" class="btn_orange">検索</button></a>
        </div>
      </div>
    </form>
  </div>
</section>
</article>



<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
