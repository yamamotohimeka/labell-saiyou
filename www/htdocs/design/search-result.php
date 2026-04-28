<?php include('common/resource.php'); ?>
<title>検索条件</title>
<?php include('common/header.php'); ?>
<?php include('common/array.php'); ?>

<main role="main">
<article id="search" class="container">
  <section class="top_content_wrap">

  </section>
  <section class="search_col">
    <h1>検索結果</h1>
    <h2><span class="num_hit">125</span>件ヒットしました。</h2>
      <!--検索ボタン-->
      <div class="search_btn2">
        <a href="search.php"><button type="submit" class="btn_orange">違う条件で検索</button></a>
      </div>
      <div class="table_cmn">
        <table class="scout_check">
          <tr>
            <th class="">申込日</th>
            <th class="">本名</th>
            <th class="">掲載求人名</th>
            <th class="">掲載媒体</th>
            <th class="">申込名</th>
            <th class="">年齢</th>
            <th class="">TEL</th>
            <th class="">メールアドレス</th>
            <th class="">面接結果</th>
            <th class="">追跡状況</th>
          </tr>
          <tr>
            <td>30.0108</td>
            <td>鈴木かな</td>
            <td>キャミソール</td>
            <td>15ナビ</td>
            <td><a href="index.php">りかこ</a></td>
            <td>23</td>
            <td>090-1155-9898</td>
            <td>kivyfyd11258</td>
            <td>採用</td>
            <td></td>
          </tr>
          <tr>
            <td>30.0109</td>
            <td>鈴木かな</td>
            <td>スピード</td>
            <td>高収入.COM</td>
            <td><a href="index.php">西田まき</a></td>
            <td></td>
            <td></td>
            <td></td>
            <td>撃沈</td>
            <td><span class="yellow">追跡中</span></td>
          </tr>
          <tr>
            <td>30.0109</td>
            <td>鈴木かな</td>
            <td>カンテサンス</td>
            <td>バニラ</td>
            <td><a href="index.php">織田</a></td>
            <td>25</td>
            <td></td>
            <td></td>
            <td>撃沈</td>
            <td><span class="yellow">追跡中</span></td>
          </tr>
        </table>
      </div>
  </section>
</article>
</main>

<script>
//drawer
$(function() {
  $('.drawer').drawer();
});

</script>

<?php include('common/footer.php'); ?>