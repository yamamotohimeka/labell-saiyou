<?php include('common/resource.php'); ?>
<title>月間集計｜集計</title>
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
    <form class="analyze_info_inner" action="analyze_monthly_result.php" method="get">
      <h2>月間集計</h2>
      <!--date_left_col-->
      <div class="analyze_form_wrap">
        <!-- 申込日-->
        <div class="white_box Medium">
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
          <span class="select_ymd_txt">月&nbsp;～&nbsp;</span>

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
          <span class="select_ymd_txt">月&nbsp;迄</span>
        </div>

        <!--検索ボタン-->
        <div class="analyze_btn">
          <a href="analyze_monthly_result.php"><button type="submit" class="btn_orange">検索</button></a>
        </div>
      </div>
    </form>
  </div>
</section>
</article>



<?php include('common/footer.php'); ?>
