<?php include('common/resource.php'); ?>
<title>他店紹介｜集計結果</title>
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

    <div class="analyze_result_inner">
      <!-- <div class="btn_export"><a href="#"><img src="img/btn_export.png" width="200"></a></div> -->
      <div class="analyze_result_header bold">
        <ul>
          <li class="title">&gt;他店紹介店舗</li>
          <li class="day">2018.01〜05</li>
          <li class="num">TOTAL　紹介数88名</li>
        </ul>
      </div>

      <div class="analyze_result_contents">
        <table class="analyze_list">
          <tr><th><span class="brown_box">スパーク</span></th><td>5名</td></tr>
          <tr><th><span class="brown_box">大奥</span></th><td>8名</td></tr>
          <tr><th><span class="brown_box">激安商事</span></th><td>8名</td></tr>
          <tr><th><span class="brown_box">ぷるるん小町</span></th><td>8名</td></tr>
          <tr><th><span class="brown_box">NHB92</span></th><td>8名</td></tr>
          <tr><th><span class="brown_box">サラリーマン珍太郎</span></th><td>8名</td></tr>
        </ul>


      </div><!-- analyze_result_inner-->
  </div>
</section>
</article>



<?php include('common/footer.php'); ?>
