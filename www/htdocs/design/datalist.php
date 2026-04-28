<?php include('common/resource.php'); ?>
<title>問い合わせリスト</title>
<?php include('common/header.php'); ?>
<?php include('common/array.php'); ?>


<article>
  <section class="top_content_wrap">

  </section>
  <section id="datalist" class="container interview_wrap">
    <h2 class="breadcrumb">&gt;&nbsp;問い合わせリスト</h2>
    <div class="datalist_white_box">

      <!-- 申込日-->
      <div class="white_box datalist">
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
      <!--追跡状況-->
      <div class="white_box">
        <p>追跡状況</p>
        <div class="select_arrow slect_chase">
          <select id="select_chase" name="追跡状況" style="width:150px;">
            <optgroup label="全て選択">
              <option value="">追跡中</option>
              <option value="">追跡中止</option>
            </optgroup>
          </select>
        </div>
      </div>
      <!--掲載求人-->
      <div class="white_box clear datatel">
        <p>掲載求人</p>
        <div class="select_arrow slect_recruit">
          <select id="select_recruit" name="掲載求人" style="width:170px;">
            <optgroup label="全て選択">
              <?php foreach ($jobshop as $key => $value): ?>
              <option value=""><?php echo $value; ?></option>
              <?php endforeach; ?>
            </optgroup>
          </select>
        </div>
      </div>
      <!--申込名-->
      <div class="white_box">
        <p>申込名</p>
        <input type="text" name="申込名" value="" size="15">
      </div>
      <!--TEL-->
      <div class="white_box datatel">
        <p>TEL</p>
        <input type="text" name="TEL1" value="" size="4"><span class="hyphen">-</span><input type="text" name="TEL2" value="" size="4"><span class="hyphen">-</span><input type="text" name="TEL3" value="" size="4">
      </div>
      <!--メール-->
      <div class="white_box datatel">
        <p>メール</p>
        <input type="text" name="メール" value="" size="24">
      </div>
      <!-- 名前-->
      <div class="white_box XMedium clear">
        <p>名前</p>
        <p class="txt">姓</p><input type="text" name="名前姓" value="" size="18">
        <p class="txt">名</p><input type="text" name="名前名" value="" size="18">
      </div>
      <!--面接結果-->
      <div class="white_box">
        <p>面接結果</p>
        <div class="select_arrow slect_chase">
          <select id="select_result" name="面接結果" style="width:110px;">
            <optgroup label="全て選択">
              <option value="">採用</option>
              <option value="">不採用</option>
              <option value="">撃沈</option>
              <option value="">他店紹介</option>
            </optgroup>
          </select>
        </div>
      </div>
      <button type="button" class="btn_orange kensaku">
          <a href="#">検索</a>
      </button>
    </div><!-- /.datalist_white_box -->

    <div class="table_cmn">
      <table>
        <tr>
          <th class="">申込日</th>
          <th class="">掲載求人名</th>
          <th class="">掲載媒体</th>
          <th class="">申込名</th>
          <th class="">名前</th>
          <th class="">年齢</th>
          <th class="">TEL</th>
          <th class="">メールアドレス</th>
          <th class="">面接結果</th>
          <th class="">追跡状況</th>
        </tr>
        <tr>
          <td>30.0108</td>
          <td>キャミソール</td>
          <td>15ナビ</td>
          <td><a href="index.php">りかこ</a></td>
          <td>鈴木かな</td>
          <td>23</td>
          <td>090-1155-9898</td>
          <td>kivyfyd11258</td>
          <td>採用</td>
          <td></td>
        </tr>
        <tr>
          <td>30.0108</td>

          <td>スピード</td>
          <td>高収入.COM</td>
          <td><a href="index.php">西田まき</a></td>
          <td>鈴木かな</td>
          <td></td>
          <td></td>
          <td></td>
          <td>撃沈</td>
          <td><span class="chase_yellow">追跡中</span></td>
        </tr>
        <tr>
          <td>30.0108</td>

          <td>カンテサンス</td>
          <td>バニラ</td>
          <td><a href="index.php">織田</a></td>
          <td>鈴木かな</td>
          <td>25</td>
          <td></td>
          <td></td>
          <td></td>
          <td><span class="chase_yellow">追跡中</span></td>
        </tr>
        <tr>
          <td>30.0108</td>

          <td>カンテサンス</td>
          <td></td>
          <td><a href="index.php">たなか</a></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </table>
    </div><!--table_cmn -->

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
