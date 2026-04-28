<?php include('common/resource.php'); ?>
<title>スカウトメール検索結果</title>
<?php include('common/header.php'); ?>
<?php include('common/array.php'); ?>

<main role="main">
<section class="top_content_wrap">

</section>
<article id="scout" class="container">
<h1 class="breadcrumb">&gt;&nbsp;スカウトメール(所属店舗)</h1>
  <ul class="scout_searc_btn">
    <li>
      <label for="all" class="btn_orange all_btn">
        全て選択
        <input type="checkbox" id="all" style="display: none;">
      </label>
    </li>
    <li><a href="scout-mail-site.php"><input class="btn_orange" type="button" value="メール送信"></a></li>
  </ul>
  <section class="table_cmn">
    <table class="scout_check">
      <tr>
        <th class="scout_day">面接日</th>
        <th class="">所属店舗</th>
        <th class="">源氏名</th>
        <th class="scout_name">申込名</th>
        <th class="">年齢</th>
        <th class="">身長</th>
        <th class="">体重</th>
        <th class="">面接結果</th>
        <th class="">退店日</th>
        <th class="">退店理由</th>
        <th class="scout_mail">スカウトメール</th>
      </tr>
      <tr>
        <td class="">30.0108</td>
        <td class="">スピード日本橋</td>
        <td class="">りかこ</td>
        <td class=""><a href="index.php">りかこ</a></td>
        <td class="">23</td>
        <td class="">155</td>
        <td class="">80</td>
        <td class="">採用</td>
        <td class="">30.0108</td>
        <td class="">クビ</td>
        <td class="">
          <label>
            <input type="checkbox" name="check" class="radio-sqar">
            <span class="radio-txt">追加</span>
          </label>
        </td>
      </tr>
      <tr>
        <td class="">30.0109</td>
        <td class="">スピード難波</td>
        <td class="">西田まき</td>
        <td class=""><a href="index.php">西田まき</a></td>
        <td class=""></td>
        <td class=""></td>
        <td class=""></td>
        <td class="">不採用</td>
        <td class="">30.0109</td>
        <td class=""></td>
        <td class="">
          <label>
            <input type="checkbox" name="check" class="radio-sqar">
            <span class="radio-txt">追加</span>
          </label>
        </td>
      </tr>
      <tr>
        <td class="">30.0112</td>
        <td class="">スピード梅田</td>
        <td class="">織田</td>
        <td class=""><a href="index.php">織田</a></td>
        <td class="">25</td>
        <td class="">162</td>
        <td class="">56</td>
        <td class="">撃沈</td>
        <td class="">30.0112</td>
        <td class="">引っ越し</td>
        <td class="">
          <label>
            <input type="checkbox" name="check" class="radio-sqar">
            <span class="radio-txt">追加</span>
          </label>
        </td>
      </tr>
      <tr>
        <td class="">30.0112</td>
        <td class="">スピード難波</td>
        <td class="">田中まさみ</td>
        <td class=""><a href="index.php">田中まさみ</a></td>
        <td class="">23</td>
        <td class="">157</td>
        <td class="">60</td>
        <td class="">他店紹介</td>
        <td class="">30.0113</td>
        <td class="">稼げない</td>
        <td class="">
          <label>
            <input type="checkbox" name="check" class="radio-sqar">
            <span class="radio-txt">追加</span>
          </label>
        </td>
      </tr>
      <tr>
        <td class="">30.0115</td>
        <td class="">スピード日本橋</td>
        <td class="">ゆかりん</td>
        <td class=""><a href="index.php">ゆかりん</a></td>
        <td class="">23</td>
        <td class="">150</td>
        <td class="">48</td>
        <td class="">不採用</td>
        <td class="">30.0115</td>
        <td class="">うつ</td>
        <td class="">
          <label>
            <input type="checkbox" name="check" class="radio-sqar">
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
