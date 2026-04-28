<?php include('common/resource.php'); ?>
<title>継続率｜集計結果</title>
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
          <li class="title">&gt;継続率</li>
          <li class="day">2018.01〜05</li>
          <li class="rate">継続率 50%</li>
          <li class="rate">退店数 50名</li>
          <li class="rate">入店数100名</li>

        </ul>
      </div>

      <div class="analyze_result_contents">
        <ul>
          <li class="analyze_result_block">
            <table>
              <tbody>
                <tr><th><span class="brown_box btm">日置</span></th><td></td><td></td></tr>
                <tr class="first"><th>スタッフ名</th><td>入店数</td><td>退店数</td><td>継続率</td></tr>
                <tr><th>スピード梅田</th><td>25名</td><td>10名</td><td>45%</td></tr>
                <tr><th>スピード京橋</th><td>25名</td><td>6名</td><td>25%</td></tr>
                <tr><th>スピード難波</th><td>25名</td><td>6名</td><td>25%</td></tr>
                <tr><th>TOTAL</th><td>50名</td><td>16名</td><td>70%</td></tr>
              </tbody>
            </table>

          </li>
          <li class="analyze_result_block">
            <table>
              <tbody>
                <tr><th><span class="brown_box btm">藤村</span></th><td></td><td></td></tr>
                 <tr class="first"><th>スタッフ名</th><td>入店数</td><td>退店数</td><td>継続率</td></tr>
                <tr><th>スピード梅田</th><td>25名</td><td>10名</td><td>45%</td></tr>
                <tr><th>スピード京橋</th><td>25名</td><td>6名</td><td>25%</td></tr>
                <tr><th>スピード難波</th><td>25名</td><td>6名</td><td>25%</td></tr>
                <tr><th>TOTAL</th><td>50名</td><td>16名</td><td>70%</td></tr>
              </tbody>
            </table>
          </li>
          <li class="analyze_result_block">
            <table>
              <tbody>
                <tr><th><span class="brown_box btm">キー坊</span></th><td></td><td></td></tr>
                 <tr class="first"><th>スタッフ名</th><td>入店数</td><td>退店数</td><td>継続率</td></tr>
                <tr><th>スピード梅田</th><td>25名</td><td>10名</td><td>45%</td></tr>
                <tr><th>スピード京橋</th><td>25名</td><td>6名</td><td>25%</td></tr>
                <tr><th>スピード難波</th><td>25名</td><td>6名</td><td>25%</td></tr>
                <tr><th>TOTAL</th><td>50名</td><td>16名</td><td>70%</td></tr>
              </tbody>
            </table>
          </li>

        </ul>

    </div><!-- analyze_result_inner-->
  </div>
</section>
</article>



<?php include('common/footer.php'); ?>
