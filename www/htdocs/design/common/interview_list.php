
  <link rel="stylesheet" href="../css/base.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/input.css">
  <link rel="stylesheet" href="../css/scout.css">
  <link rel="stylesheet" href="../css/multiple-select.css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<body id="intv_list">
<?php include('../common/array.php'); ?> 
    <form>
      <!-- 面接日-->
      <div class="white_box SLarge">
      	<p>面接日</p>
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
      <div class="white_box">
        <p class="select_other_txt">面接店舗</p>
        <div class="select_arrow select_intvw select_medium">
          <select id="select_tenpo" name="面接店舗" style="width:160px;">
            <?php foreach ($workshop as $key => $value): ?>
            <option value=""><?php echo $value; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
		  </div>
      <div class="intv_list_btn">
        <input type="submit" value="検索" class="btn_orange">
      </div>
    </form>
			<table class="intrv_sch">
			<thead>
			<tr>
				<th>面接日</th>
				<th>面接時間</th>
				<th>面接店舗</th>
				<th>申込名</th>
				<th>年齢</th>
				<th>経験	</th>
				<th>掲載求人名</th>
			</tr>
			</thead>
			<tr>
				<td>30.0108</td>
				<td>13:08</td>
				<td>スピード難波</td>
				<td><a href="../input.php" target="_blank">りかこ</a></td>
				<td>23</td>
				<td>なし</td>
				<td>キャミソール</td>
			</tr>
			<tr>
				<td>30.0108</td>
				<td>13:08</td>
				<td>スピード難波</td>
				<td><a href="../input.php">りかこ</a></td>
				<td>23</td>
				<td>なし</td>
				<td>キャミソール</td>
			</tr>
			<tr>
				<td>30.0108</td>
				<td>13:08</td>
				<td>スピード難波</td>
				<td><a href="../input.php">りかこ</a></td>
				<td>23</td>
				<td>なし</td>
				<td>キャミソール</td>
			</tr>
			<tr>
				<td>30.0108</td>
				<td>13:08</td>
				<td>スピード難波</td>
				<td><a href="../input.php">りかこ</a></td>
				<td>23</td>
				<td>なし</td>
				<td>キャミソール</td>
			</tr>
			</table>

<script src="../js/jquery.multiple.select.js"></script>
<script>
  //セレクト複数選択
  $(function() {
    var $selects = $('[id^=select_]');
    $selects.multipleSelect();
  });
</script>
</body>