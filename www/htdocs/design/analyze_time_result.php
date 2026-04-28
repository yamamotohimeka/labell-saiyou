<?php include('common/resource.php'); ?>
<title>>申込時間｜集計結果</title>
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
          <li class="title">&gt;申込時間</li>
          <li class="day">2018.01〜05</li>
          <li class="num">合計1500件</li>
        </ul>
      </div>

      <div class="analyze_result_contents">
        <ul>
          <li class="analyze_result_block">
            <table>
              <tbody>
                <tr><th><span class="brown_box btm">ヘルス</span></th><td></td></tr>
                <tr><th>9時～</th><td class="number_time">25件</td></tr>
                <tr><th>10時～</th><td class="number_time">45件</td></tr>
                <tr><th>11時～</th><td class="number_time">41件</td></tr>
                <tr><th>12時～</th><td class="number_time">35件</td></tr>
                <tr><th>13時～</th><td class="number_time">20件</td></tr>
                <tr><th>14時～</th><td class="number_time">15件</td></tr>
                <tr><th>15時～</th><td class="number_time">6件</td></tr>
                <tr><th></th><td class="number_time">500件</td></tr>
              </tbody>
            </table>

          </li>
          <li class="analyze_result_block">
            <table>
              <tbody>
                <tr><th><span class="brown_box btm">オナクラ</span></th><td></td></tr>
                <tr><th>9時～</th><td class="number_time">25件</td></tr>
                <tr><th>10時～</th><td class="number_time">45件</td></tr>
                <tr><th>11時～</th><td class="number_time">41件</td></tr>
                <tr><th>12時～</th><td class="number_time">35件</td></tr>
                <tr><th>13時～</th><td class="number_time">20件</td></tr>
                <tr><th>14時～</th><td class="number_time">15件</td></tr>
                <tr><th>15時～</th><td class="number_time">6件</td></tr>
                <tr><th></th><td class="number_time">500件</td></tr>
              </tbody>
            </table>
          </li>
          <li class="analyze_result_block">
            <table>
              <tbody>
                <tr><th><span class="brown_box btm">累計</span></th><td></td></tr>
                <tr><th>9時～</th><td class="number_time">25件</td></tr>
                <tr><th>10時～</th><td class="number_time">45件</td></tr>
                <tr><th>11時～</th><td class="number_time">41件</td></tr>
                <tr><th>12時～</th><td class="number_time">35件</td></tr>
                <tr><th>13時～</th><td class="number_time">20件</td></tr>
                <tr><th>14時～</th><td class="number_time">15件</td></tr>
                <tr><th>15時～</th><td class="number_time">6件</td></tr>
                <tr><th></th><td class="number_time">500件</td></tr>
              </tbody>
            </table>
          </li>

        </ul>

    </div><!-- analyze_result_inner-->
  </div>
</section>
</article>



<?php include('common/footer.php'); ?>
