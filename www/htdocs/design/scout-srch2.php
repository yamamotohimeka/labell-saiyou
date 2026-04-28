<?php include('common/resource.php'); ?>
<title>スカウトメール検索結果</title>
<?php include('common/header.php'); ?>
<?php include('common/array.php'); ?>

<main role="main">
<section class="top_content_wrap">

</section>
<article id="scout" class="container">
<h1 class="breadcrumb">&gt;&nbsp;スカウトメール(掲載求人)</h1>

  <ul class="scout_searc_btn">
    <li>
      <label for="all2" class="btn_orange all_btn">
        全て選択
        <input type="checkbox" id="all2" style="display: none;">
      </label>
    </li>
    <li><a href="scout-mail-shop.php"><input class="btn_orange" type="button" value="メール送信"></a></li>
  </ul>
  <section class="table_cmn">
    <table class="scout_check">
      <tr>
        <th class="scout_day">申込日</th>
        <th class="">掲載求人</th>
        <th class="scout_name">申込名</th>
        <th class="">年齢</th>
        <th class="">身長</th>
        <th class="">体重</th>
        <th class="">追跡理由</th>
        <th class="scout_mail">スカウトメール</th>
      </tr>
      <tr>
        <td class="">30.0108</td>
        <td class="">スピード</td>
        <td class=""><a href="index.php">りかこ</a></td>
        <td class="">23</td>
        <td class="">155</td>
        <td class="">80</td>
        <td class="">ブッチ</td>
        <td class="">
          <label>
            <input type="checkbox" name="check2" class="radio-sqar">
            <span class="radio-txt">追加</span>
          </label>
        </td>
      </tr>
      <tr>
        <td class="">30.0108</td>
        <td class="">スピード</td>
        <td class=""><a href="index.php">りかこ</a></td>
        <td class="">23</td>
        <td class="">155</td>
        <td class="">80</td>
        <td class="">ブッチ</td>
        <td class="">
          <label>
            <input type="checkbox" name="check2" class="radio-sqar">
            <span class="radio-txt">追加</span>
          </label>
        </td>
      </tr>
      <tr>
        <td class="">30.0112</td>
        <td class="">スピード</td>
        <td class=""><a href="index.php">まゆみ</a></td>
        <td class="">25</td>
        <td class="">162</td>
        <td class="">50</td>
        <td class="">引っ越し</td>
         <td class="scout_mail">
          <label>
            <input type="checkbox" name="check2" class="radio-sqar">
            <span class="radio-txt">追加</span>
          </label>
        </td>
      </tr>
    </table>
  </section>

</article>
</main>

<script>

//一括チェック

$('#all').on('click', function() {
    $('input[name=check]').prop('checked', this.checked);
});

$('#all2').on('click', function() {
    $('input[name=check2]').prop('checked', this.checked);
});


//drawer
$(function() {
  $('.drawer').drawer();
});

</script>

<?php include('common/footer.php'); ?>
