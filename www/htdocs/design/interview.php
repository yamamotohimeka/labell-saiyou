<?php include('common/resource.php'); ?>
<title>面接予定情報</title>
<?php include('common/header.php'); ?>
<?php include('common/array.php'); ?>

<article id="interview">
  <section class="top_content_wrap">

  </section>
  <section class="container interview_wrap">
    <h2 class="breadcrumb">&gt;&nbsp;面接予定情報</h2>
    <div class="interview_whitebox">
      <!-- 面接日-->
      <div class="white_box Medium">
        <div class="select_arrow select_y">
          <select name="面接年">
            <option value="">—</option>
            <?php for ($i=2013; $i < 2025; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_ymd_txt">年</span>
        <div class="select_arrow select_md">
          <select name="面接月">
            <option value="">—</option>
            <?php for ($i=1; $i < 13; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_ymd_txt">月</span>
        <div class="select_arrow select_md">
          <select name="面接日">
            <option value="">—</option>
            <?php for ($i=1; $i < 32; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_ymd_txt">日&nbsp;～&nbsp;</span>
        <div class="select_arrow select_y">
          <select name="面接年">
            <option value="">—</option>
            <?php for ($i=2013; $i < 2025; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_ymd_txt">年</span>
        <div class="select_arrow select_md">
          <select name="面接月">
            <option value="">—</option>
            <?php for ($i=1; $i < 13; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_ymd_txt">月</span>
        <div class="select_arrow select_md">
          <select name="面接日">
            <option value="">—</option>
            <?php for ($i=1; $i < 32; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
          </div>
        <span class="select_ymd_txt">日</span>
      </div>
      <!--面接店舗-->
      <div class="white_box space">
        <p class="select_other_txt">面接店舗</p>
        <div class="select_arrow select_intvw select_medium">
          <select id="select_tenpo" name="面接店舗" style="width:160px;">
            <optgroup label="全て選択">
              <?php foreach ($workshop as $key => $value): ?>
              <option value=""><?php echo $value; ?></option>
              <?php endforeach; ?>
            </optgroup>
          </select>
        </div>
      </div>
      <button type="submit" class="btn_orange kensaku">
          <a href="#">検索</a>
      </button>
    </div><!-- /.interview_whitebox -->
    <div class="table_cmn intvw">
      <table>
        <tr>
          <th class="">面接日</th>
          <th class="">面接時間</th>
          <th class="">面接店舗</th>
          <th class="">申込名</th>
          <th class="">年齢</th>
          <th class="">経験</th>
          <th class="">掲載求人</th>
          <th class="">申込日</th>
          <th class="">送信日</th>
          <th class="">連絡方法</th>
          <th class="none">タイマー設定時間</th>
          <th class="intvw_conf">確認状況</th>
        </tr>
        <tr>
          <td class="red">30.0108</td>
          <td class="red">13:00</td>
          <td class="red">スピード梅田</td>
          <td class="red"abbr=""><a href="input.php"><i class="fa fa-star "></i>りかこ</a></td>
          <td class="red">23</a></td>
          <td class="red"abbr="">なし</td>
          <td class="red">キャミソール</td>
          <td class="red">30.0108</td>
          <td class="red">30.0108</td>
          <td class="red">メール</td>
          <td class="red">120分前</td>
          <td>未確認</td>
        </tr>
        <tr>
          <td>30.0108</td>
          <td>13:00</td>
          <td>スピード難波</td>
          <td><a href="input.php"><i class="fa fa-star"></i> 西田まき</a></td>
          <td>19</td>
          <td>あり</td>
          <td>スピード</td>
          <td>30.0108</td>
          <td>30.0108</td>
          <td>TEL</td>
          <td>60分前</td>
          <td class="color color-1">第一確認中</td>
        </tr>
        <tr>
          <td>30.0108</td>
          <td>13:30</td>
          <td>スピード梅田</td>
          <td><a href="input.php">織田</a></td>
          <td>25</td>
          <td>あり</td>
          <td>カンテサンス</td>
          <td>30.0108</td>
          <td>30.0108</td>
          <td>LINE</td>
          <td>120分前</td>
          <td class="color color-2">確認済み</td>
        </tr>
        <tr>
          <td>30.0108</td>
          <td>13:30</td>
          <td>ティーク</td>
          <td><a href="input.php">織田</a></td>
          <td>25</td>
          <td>あり</td>
          <td>カンテサンス</td>
          <td>30.0108</td>
          <td>30.0108</td>
          <td>ショートメール</td>
          <td>60分前</td>
          <td class="color color-3">到着</td>
        </tr>
        <tr>
          <td>30.0109</td>
          <td>16:00</td>
          <td>スピード日本橋</td>
          <td><a href="input.php">まゆみ</a></td>
          <td>25</td>
          <td>あり</td>
          <td>今日ここ</td>
          <td>30.0108</td>
          <td>30.0109</td>
          <td>TEL</td>
          <td>60分前</td>
          <td class="color color-4">ブッチ</td>
        </tr>
        <tr>
          <td>30.0109</td>
          <td>16:00</td>
          <td>エコ梅田</td>
          <td><a href="input.php">太田みや</a></td>
          <td>23</td>
          <td>あり</td>
          <td>スピード</td>
          <td>30.0109</td>
          <td>30.0109</td>
          <td>LINE</td>
          <td>120分前</td>
          <td class="color color-5">変更中</td>
        </tr>
        <tr>
          <td>30.0109</td>
          <td>16:00</td>
          <td>エコ天王寺</td>
          <td><a href="input.php">ここみん</a></td>
          <td>24</td>
          <td>あり</td>
          <td>キャミソール</td>
          <td>30.0108</td>
          <td>30.0109</td>
          <td>ショートメール</td>
          <td>60分前</td>
          <td class="color color-6">キャンセル</td>
        </tr>
      </table>
    </div>
  </section>

<script src="js/jquery.multiple.select.js"></script>
<script>
  //セレクト複数選択
  $(function() {
    var $selects = $('[id^=select_]');
    $selects.multipleSelect();
  });

  //横からアラート
  $(function() {
   $('#sidealert').hover(
    function(){
      $(this).find('p').stop().animate({'marginLeft':'240px'},500);
    },
    function () {
      $(this).find('p').stop().animate({'marginLeft':'0px'},300);
    }
  );
});
</script>

<?php include('common/footer.php'); ?>
