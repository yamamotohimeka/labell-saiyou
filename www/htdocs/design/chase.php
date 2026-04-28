<?php include('common/resource.php'); ?>
<title>追跡予定情報</title>
<?php include('common/header.php'); ?>
<?php include('common/array.php'); ?>

<article>
  <section class="top_content_wrap">

  </section>
  <section id="chase" class="container interview_wrap">
    <h2 class="breadcrumb">&gt;&nbsp;追跡予定情報</h2>
    <p class="description">追跡予定日が当日のものを表示</p>
    <div class="chase_white_box">
      <!-- 追跡予定日-->
      <div class="white_box chase">
        <p>追跡予定日</p>
        <div class="select_arrow select_y chase">
          <select name="追跡予定年">
            <option value="">—</option>
            <?php for ($i=2013; $i < 2025; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_ymd_txt">年</span>
        <div class="select_arrow select_md chase">
          <select name="追跡予定月">
            <option value="">—</option>
            <?php for ($i=1; $i < 13; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_ymd_txt">月</span>

        <div class="select_arrow select_md chase">
          <select name="追跡予定日">
            <option value="">—</option>
            <?php for ($i=1; $i < 32; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_ymd_txt">日&nbsp;～&nbsp;</span>
        <div class="select_arrow select_y chase">
          <select name="追跡予定年">
            <option value="">—</option>
            <?php for ($i=2013; $i < 2025; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_ymd_txt">年</span>

        <div class="select_arrow select_md chase">
          <select name="追跡予定月">
            <option value="">—</option>
            <?php for ($i=1; $i < 13; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_ymd_txt">月</span>
        <div class="select_arrow select_md chase">
          <select name="追跡予定日">
            <option value="">—</option>
            <?php for ($i=1; $i < 32; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_ymd_txt">日</span>
      </div>
      <!-- 申込日-->
      <div class="white_box Medium clear">
        <p>申込日</p>
        <div class="select_arrow select_y chase">
          <select name="申込年">
            <option value="">—</option>
            <?php for ($i=2013; $i < 2025; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_ymd_txt">年</span>

        <div class="select_arrow select_md chase">
          <select name="申込月">
            <option value="">—</option>
            <?php for ($i=1; $i < 13; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_ymd_txt">月</span>

        <div class="select_arrow select_md chase">
          <select name="申込日">
            <option value="">—</option>
            <?php for ($i=1; $i < 32; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_ymd_txt">日&nbsp;～&nbsp;</span>
        <div class="select_arrow select_y chase">
          <select name="申込年">
            <option value="">—</option>
            <?php for ($i=2013; $i < 2025; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_ymd_txt">年</span>

        <div class="select_arrow select_md chase">
          <select name="申込月">
            <option value="">—</option>
            <?php for ($i=1; $i < 13; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_ymd_txt">月</span>
        <div class="select_arrow select_md chase">
          <select name="申込日">
            <option value="">—</option>
            <?php for ($i=1; $i < 32; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
          </div>
        <span class="select_ymd_txt">日</span>
      </div>
      <!--店舗スタッフ-->
      <div class="white_box">
        <p>店舗スタッフ</p>
        <div class="select_arrow slect_chase">
          <select id="select_cast" name="店舗スタッフ" style="width: 130px;">
            <optgroup label="全て選択">
              <option value="">店舗スタッフ</option>
              <option value="">キャスト</option>
            </optgroup>
          </select>
        </div>
      </div>
      <!--掲載媒体名-->
      <div class="white_box clear">
        <p>掲載媒体</p>
        <div class="select_arrow slect_chase">
          <select id="select_media" name="掲載媒体" style="width: 150px;">
            <optgroup label="全て選択">
              <option value="">Qプリ</option>
              <option value="">ガールズヘブン</option>
              <option value="">ぴゅあじょ</option>
              <option value="">１５なび</option>
              <option value="">バニラ</option>
              <option value="">出稼ぎ.com</option>
            </optgroup>
          </select>
        </div>
      </div>
      <!--掲載求人-->
      <div class="white_box">
        <p>掲載求人</p>
        <div class="select_arrow slect_chase">
          <select id="select_recruit" name="掲載求人" style="width: 150px;">
            <optgroup label="全て選択">
              <?php foreach ($jobshop as $key => $value): ?>
              <option value=""><?php echo $value; ?></option>
              <?php endforeach; ?>
            </optgroup>
          </select>
        </div>
      </div>

      <!--追跡理由-->
      <div class="white_box">
        <p>追跡理由</p>
        <div class="select_arrow slect_chase">
          <select id="select_reason" name="追跡理由" style="width: 150px;">
            <optgroup label="全て選択">
              <option value="">保留</option>
              <option value="">変更中</option>
              <option value="">キャンセル</option>
              <option value="">ブッチ</option>
            </optgroup>
          </select>
        </div>
      </div>
      <button type="submit" class="btn_orange kensaku">
          <a href="#">検索</a>
      </button>
    </div><!-- /.chase_white_box -->

    <div class="table_cmn">
      <table>
        <tr>
          <th class="">追跡予定日</th>
          <th class="">申込日</th>
          <th class="">掲載求人名</th>
          <th class="">掲載媒体</th>
          <th class="">申込名</th>
          <th class="">年齢</th>
          <th class="">追跡理由</th>
          <th class="">連絡方法</th>
        </tr>
        <tr>
          <td>30.0108</td>
          <td>30.0125</td>
          <td>スピード</td>
          <td>ヘブン</td>
          <td><a href="input.php">りかこ</a></td>
          <td>23</td>
          <td>ブッチ</td>
          <td>メール</td>
        </tr>
        <tr>
          <td>30.0108</td>
          <td>30.0125</td>
          <td>カンテサンス</td>
          <td>バニラ</td>
          <td><a href="input.php">西田まき</a></td>
          <td>19</td>
          <td>生理</td>
          <td>TEL</td>
        </tr>
        <tr>
          <td>30.0108</td>
          <td>30.0125</td>
          <td>ティーク</td>
          <td>いちごナビ</td>
          <td><a href="input.php">織田</a></td>
          <td>23</td>
          <td>連絡取れない</td>
          <td>LINE</td>
        </tr>
        <tr>
          <td>30.0108</td>
          <td>30.0125</td>
          <td>エコ</td>
          <td>ぴゅあらば</td>
          <td><a href="input.php">田中まさみ</a></td>
          <td>23</td>
          <td>ブッチ</td>
          <td>ショートメール</td>
        </tr>
        <tr>
          <td>30.0115</td>
          <td>30.0125</td>
          <td>プルミエール</td>
          <td>ヘブン</td>
          <td><a href="input.php">ゆかりん</a></td>
          <td>23</td>
          <td>次回講習予定</td>
          <td>メール</td>
        </tr>
        <tr>
          <td>30.0115</td>
          <td>30.0125</td>
          <td>今日ここ</td>
          <td>バニラ</td>
          <td><a href="input.php">まゆみ</a></td>
          <td>35</td>
          <td>保留</td>
          <td>TEL</td>
        </tr>
      </table>
    </div><!--table_cmn -->

    <h2 class="breadcrumb">&gt;&nbsp;事前連絡日</h2>
    <p class="description">事前連絡日が当日、もしくは当日以前で連絡済みになっていないものを表示</p>
    <div class="intvw_jizen">
      <div class="table_cmn">
        <table>
          <tr>
            <th class="">事前連絡日</th>
            <th class="">面接日</th>
            <th class="">面接時間</th>
            <th class="">面接店舗</th>
            <th class="">申込名</th>
            <th class="">年齢</th>
            <th class="">掲載求人名</th>
            <th class="">連絡方法</th>
            <th class="">申込日</th>
            <th class="">送信日</th>
            <th class="">連絡状況</th>
          </tr>
          <tr>
            <td>30.0108</td>
            <td>30.0108</td>
            <td>13：08</td>
            <td>スピード難波</td>
            <td><a href="input.php">りかこ</a></td>
            <td>23</td>
            <td>キャミソール</td>
            <td>メール</td>
            <td>30.0108</td>
            <td>30.0108</td>
            <td>
              <label>
                <input type="checkbox" class="radio-sqar">
                <span class="radio-txt">連絡済</span>
              </label>
            </td>
          </tr>
          <tr>
            <td>30.0109</td>
            <td>30.0109</td>
            <td>10：08</td>
            <td>スピード梅田</td>
            <td><a href="input.php">西田まき</a></td>
            <td>19</td>
            <td>スピード</td>
            <td>TEL</td>
            <td>30.0108</td>
            <td>30.0109</td>
            <td>
              <label>
                <input type="checkbox" class="radio-sqar">
                <span class="radio-txt">連絡済</span>
              </label>
            </td>
          </tr>
          <tr>
            <td>30.0112</td>
            <td>30.0112</td>
            <td>13：50</td>
            <td>ティーク</td>
            <td><a href="input.php">織田</a></td>
            <td>25</td>
            <td>カンテサンス</td>
            <td>LINE</td>
            <td>30.0112</td>
            <td>30.0112</td>
            <td>
              <label>
                <input type="checkbox" class="radio-sqar">
                <span class="radio-txt">連絡済</span>
              </label>
            </td>
          </tr>
          <tr>
            <td>30.0113</td>
            <td>30.0113</td>
            <td>18：08</td>
            <td>エコ梅田</td>
            <td><a href="input.php">田中まさみ</a></td>
            <td>23</td>
            <td>カンテサンス</td>
            <td>ショートメール</td>
            <td>30.0113</td>
            <td>30.0113</td>
            <td>
              <label>
                <input type="checkbox" class="radio-sqar">
                <span class="radio-txt">連絡済</span>
              </label>
            </td>
          </tr>
        </table>
      </div>
      <button type="submit" class="btn_orange conf">
        連絡済み
      </button>
    </div>
  </section>
</article>
<script src="js/jquery.multiple.select.js"></script>
<script>
  $(function() {
    var $selects = $('[id^=select_]');
    $selects.multipleSelect();
  });
</script>
<?php include('common/footer.php'); ?>
