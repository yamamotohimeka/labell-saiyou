<?php include('common/resource.php'); ?>
<title>入店率｜集計</title>
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
    <form class="analyze_info_inner" action="analyze_recruit_result.php" method="get">
      <h2>入店率</h2>
      <!--date_left_col-->
      <div class="analyze_form_wrap">
        <!-- 申込日-->
        <div class="white_box MMedium">
          <p>申込日</p>
          <div class="select_arrow select_y">
            <select name="申込年" required>
              <option value="">—</option>
              <?php for ($i=2013; $i < 2025; $i++) : ?>
              <option value="<?php echo $i;?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <span class="select_ymd_txt">年</span>

          <div class="select_arrow select_md">
            <select name="申込月" required>
              <option value="">—</option>
              <?php for ($i=1; $i < 13; $i++) : ?>
              <option value="<?php echo $i;?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <span class="select_ymd_txt">月</span>

          <div class="select_arrow select_md">
            <select name="申込日" required>
              <option value="">—</option>
              <?php for ($i=1; $i < 32; $i++) : ?>
              <option value="<?php echo $i;?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
            </div>
          <span class="select_ymd_txt">日&nbsp;～&nbsp;</span>
          <div class="select_arrow select_y">
            <select name="申込年" required>
              <option value="">—</option>
              <?php for ($i=2013; $i < 2025; $i++) : ?>
              <option value="<?php echo $i;?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <span class="select_ymd_txt">年</span>

          <div class="select_arrow select_md">
            <select name="申込月" required>
              <option value="">—</option>
              <?php for ($i=1; $i < 13; $i++) : ?>
              <option value="<?php echo $i;?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <span class="select_ymd_txt">月</span>

          <div class="select_arrow select_md">
            <select name="申込日" required>
              <option value="">—</option>
              <?php for ($i=1; $i < 32; $i++) : ?>
              <option value="<?php echo $i;?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <span class="select_ymd_txt">日&nbsp;迄</span>
        </div>
        <!--店舗-->
        <div class="white_box clear">
          <p>店舗</p>
          <div class="select_arrow select_long branch_shop">
            <select id="select_shop" name="店舗" style="width: 210px;">
              <optgroup label="全て選択">
                <?php foreach ($workshop as $key => $value): ?>
                <option value=""><?php echo $value; ?></option>
                <?php endforeach; ?>
              </optgroup>
            </select>
          </div>
        </div>
        <!--面接担当-->
        <div class="white_box clear">
          <p>面接担当</p>
          <div class="select_arrow slect_long branch_person">
            <select name="面接担当" id="select_staff" style="width: 210px;">
              <optgroup label="全て選択">
                <?php foreach ($staffname as $key => $value): ?>
                  <option value=""><?php echo $value; ?></option>
                <?php endforeach; ?>
              </optgroup>
            </select>
          </div>
        </div>

        <div class="clear analyze_alert">
          <span>入店率＝入店数÷（面接件数-不採用-他店紹介不採用）×100<br>入店数は採用情報に上がっている中で面接結果が「採用」のデータをカウント</span>
        </div>
        <!--検索ボタン-->
        <div class="analyze_btn">
          <a href="analyze_recruit_result.php"><button type="submit" class="btn_orange" id="anl_btn">検索</button></a>
        </div>
      </div>
    </form>
  </div>
</section>
</article>

<script src="js/jquery.multiple.select.js"></script>
<script>
  $(function() {
    var $selects = $('[id^=select_]');
    $selects.multipleSelect();
  });

  //フォームの必須
  $(function(){
    $('#anl_btn').click(function(){
      if(!$(".placeholder").length) {//チェックがある場合
      }
      else {//チェックがない場合
        alert("項目を選択してください");
        return false;
      }
    });
  });

  //店舗・面接担当条件分岐
  $(function(){
    $(".branch_shop").bind("change keyup ",function(){
      var count = $('.branch_person .placeholder').length;
        if($('.branch_shop .placeholder').length) {
          $('.branch_person .ms-drop ul').show();
          $('.branch_person input').prop('checked', false);
          $('.branch_person .ms-choice > span').text('');
          $('.branch_person .ms-choice > span').addClass('placeholder');
        } else {

          $('.branch_person .ms-drop ul').hide();
          $('.branch_person .ms-drop input').prop('checked', true);
          $('.branch_person .ms-choice > span').removeClass('placeholder');
        }
    });
    $(".branch_person").bind("change keyup",function(){
        if($('.branch_person .placeholder').length) {
          $('.branch_shop .ms-drop ul').show();
          $('.branch_shop input').prop('checked', false);
          $('.branch_shop .ms-choice > span').addClass('placeholder');
        } else {

          $('.branch_shop .ms-drop ul').hide();
          $('.branch_shop input').prop('checked', true);
          $('.branch_shop .ms-choice > span').removeClass('placeholder');
        }
    });
  });
</script>

<?php include('common/footer.php'); ?>
