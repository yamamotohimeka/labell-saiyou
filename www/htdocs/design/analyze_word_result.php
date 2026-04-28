<?php include('common/resource.php'); ?>
<title>検索ワード｜集計結果</title>
<?php include('common/header.php'); ?>
<?php include('common/array.php'); ?>


<article>
<section class="top_content_wrap">
</section>
<section id="analyze_word">
  <div class="container analyze_wrap date_info_col">
    <h1 class="breadcrumb">&gt;&nbsp;集計</h1>
    <?php include('common/analyze_navi.php'); ?>
    <!-- date_info_inner-->

    <div class="analyze_result_inner">
      <!-- <div class="btn_export"><a href="#"><img src="img/btn_export.png" width="200"></a></div> -->
      <div class="analyze_result_header bold">
        <ul>
          <li class="title">&gt;検索ワード</li>
        </ul>
      </div>

      <div class="analyze_result_contents">
        <p class="brown_box word">オナクラ</p>
        <div class="analyze_result_block">
          <table>
            <tbody>
              <tr><th>単体ワードBEST10</th></tr>
              <tr><th>大阪</th><td class="number">25</td></tr>
              <tr><th>風俗</th><td class="number">10</td></tr>
              <tr><th>バイト</th><td class="number">8</td></tr>
              <tr><th>求人</th><td class="number">3</td></tr>
            </tbody>
          </table>
        </div>
        <div class="analyze_result_block clear">
          <table>
            <tbody>
              <tr><th>複数ワードBEST10（2点）</th></tr>
              <tr><th>大阪　風俗</th><td class="number">25</td></tr>
              <tr><th>バイト　求人</th><td class="number">10</td></tr>
              <tr><th>大阪　風俗</th><td class="number">8</td></tr>
              <tr><th>バイト　求人</th><td class="number">10</td></tr>
              <tr><th>大阪　風俗</th><td class="number">8</td></tr>
              <tr><th>バイト　求人</th><td class="number">3</td></tr>
            </tbody>
          </table>
        </div>
        <div class="analyze_result_block">
          <table>
            <tbody>
              <tr><th>複数ワードBEST10（3点）</th></tr>
              <tr><th>大阪　風俗　高収入</th><td class="number">25</td></tr>
              <tr><th>バイト　求人　高収入</th><td class="number">10</td></tr>
              <tr><th>大阪　風俗　高収入</th><td class="number">8</td></tr>
              <tr><th>バイト　求人　高収入</th><td class="number">10</td></tr>
              <tr><th>大阪　風俗　高収入</th><td class="number">8</td></tr>
              <tr><th>バイト　求人　高収入</th><td class="number">3</td></tr>
            </tbody>
          </table>
        </div>
      </div><!-- analyze_result_contents-->

    </div><!-- analyze_result_inner-->
  </div>
</section>
</article>



<?php include('common/footer.php'); ?>
