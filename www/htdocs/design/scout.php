<?php include('common/resource.php'); ?>
<title>スカウトメール</title>
<?php include('common/header.php'); ?>
<?php include('common/array.php'); ?>

<main role="main">
  <section class="top_content_wrap">

  </section>
<article id="scout" class="container">

<h1 class="breadcrumb">&gt;&nbsp;スカウトメール</h1>

<section>
  <ul class="tab">
    <li><h2>所属店舗</h2></li>
    <li><h2>掲載求人</h2></li>
  </ul>
  <div class="scout_contents">
    <!-- 店舗タブ -->
    <div class="scout_content">
      <div class="note">
        <p>※採用情報から検索</p>
      </div>
      <!--所属店舗-->
      <div class="white_box">
        <p>所属店舗</p>
        <div class="select_arrow">
          <select id="select_belong" name="所属店舗" style="width:220px;">
            <optgroup label="全て選択">
              <?php foreach ($workshop as $key => $value): ?>
              <option value=""><?php echo $value; ?></option>
              <?php endforeach; ?>
            </optgroup>
          </select>
        </div>
      </div>
      
      <!-- 面接日-->
      <div class="white_box Medium clear">
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
        <span class="select_ymd_txt">日&nbsp;迄</span>
      </div>
      <!--面接結果-->
      <div class="white_box SSmall">
        <p>面接結果</p>
        <div class="select_arrow">
            <select id="select_result" name="面接結果" style="width:150px;">
              <optgroup label="全て選択">
                <option value="">採用</option>
                <option value="">不採用</option>
                <option value="">撃沈</option>
              </optgroup>
            </select>
        </div>
      </div>
      <!--年齢-->
      <div class="white_box clear">
        <p>年齢</p>
        <div class="select_arrow select_other">
          <select name="age">
            <option value="">—</option>
            <?php for ($i=16; $i < 60; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_other_txt">歳&nbsp;～</span>
        <div class="select_arrow select_other">
          <select name="age">
            <option value="">—</option>
            <?php for ($i=16; $i < 60; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_other_txt">歳</span>
      </div>
      <!--身長-->
      <div class="white_box">
        <p>身長</p>
        <div class="select_arrow select_other">
          <select name="age">
            <option value="">—</option>
            <?php for ($i=135; $i < 180; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_other_txt">cm&nbsp;～</span>
        <div class="select_arrow select_other">
          <select name="age">
            <option value="">—</option>
            <?php for ($i=135; $i < 180; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_other_txt">cm</span>
      </div>
      <!--体重-->
      <div class="white_box">
        <p>体重</p>
        <div class="select_arrow select_other">
          <select name="age">
            <option value="">—</option>
            <?php for ($i=40; $i < 100; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_other_txt">kg&nbsp;～</span>
        <div class="select_arrow select_other">
          <select name="age">
            <option value="">—</option>
            <?php for ($i=40; $i < 100; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_other_txt">kg</span>
      </div>
      <!--住所-->
      <div class="white_box LLarge clear">
        <p>住所</p>
        <div class="select_arrow select_address">
          <select id="select_ad" name="住所" style="width:160px;">
            <optgroup label="">
              <option value="北海道">北海道</option>
            </optgroup>
            <optgroup label="東北">
              <option value="青森県">青森県</option>
              <option value="岩手県">岩手県</option>
              <option value="宮城県">宮城県</option>
              <option value="秋田県">秋田県</option>
              <option value="山形県">山形県</option>
              <option value="福島県">福島県</option>
            </optgroup>
            <optgroup label="関東">
              <option value="東京都">東京都</option>
              <option value="茨城県">茨城県</option>
              <option value="栃木県">栃木県</option>
              <option value="群馬県">群馬県</option>
              <option value="埼玉県">埼玉県</option>
              <option value="千葉県">千葉県</option>
              <option value="神奈川県">神奈川県</option>
            </optgroup>
          </select>
        </div>
        <span class="select_other_txt">都道府県</span>
        <input type="text" name="住所" value="" size="75" class="address_txt">
      </div>
      <!-- 退店日-->
      <div class="white_box MMedium">
        <p>退店日</p>
        <div class="select_arrow select_y">
          <select name="退店年">
            <option value="">—</option>
            <?php for ($i=2013; $i < 2025; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_ymd_txt">年</span>

        <div class="select_arrow select_md">
          <select name="退店月">
            <option value="">—</option>
            <?php for ($i=1; $i < 13; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_ymd_txt">月</span>

        <div class="select_arrow select_md">
          <select name="退店日">
            <option value="">—</option>
            <?php for ($i=1; $i < 32; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
          </div>
        <span class="select_ymd_txt">日&nbsp;～&nbsp;</span>
        <div class="select_arrow select_y">
          <select name="退店年">
            <option value="">—</option>
            <?php for ($i=2013; $i < 2025; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_ymd_txt">年</span>

        <div class="select_arrow select_md">
          <select name="退店月">
            <option value="">—</option>
            <?php for ($i=1; $i < 13; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_ymd_txt">月</span>

        <div class="select_arrow select_md">
          <select name="退店日">
            <option value="">—</option>
            <?php for ($i=1; $i < 32; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_ymd_txt">日&nbsp;迄</span>
      </div>
      <!--検索ボタン-->
      <div class="scout_btn clear">
        <a href="scout-srch.php"><button type="button" class="btn_orange">検索</button></a>
      </div>
    </div><!-- 店舗タブend -->

    <!-- 掲載求人名タブ -->
    <div class="scout_content">
      <div class="note">
        <p>※問い合わせリスト（採用情報アップ分は省く）から検索</p>
      </div>
      <div class="white_box">
        <p>掲載求人</p>
        <div class="select_arrow">
          <select name="掲載求人">
            <option value="">—</option>
            <?php foreach ($jobshop as $key => $value): ?>
            <option value=""><?php echo $value; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <!-- 申込日-->
      <div class="white_box Medium clear">
        <p>申込日</p>
        <div class="select_arrow select_y">
          <select name="申込年">
            <option value="">—</option>
            <?php for ($i=2013; $i < 2025; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_ymd_txt">年</span>

        <div class="select_arrow select_md">
          <select name="申込月">
            <option value="">—</option>
            <?php for ($i=1; $i < 13; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_ymd_txt">月</span>

        <div class="select_arrow select_md">
          <select name="申込日">
            <option value="">—</option>
            <?php for ($i=1; $i < 32; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_ymd_txt">日&nbsp;～&nbsp;</span>
        <div class="select_arrow select_y">
          <select name="申込年">
            <option value="">—</option>
            <?php for ($i=2013; $i < 2025; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_ymd_txt">年</span>

        <div class="select_arrow select_md">
          <select name="申込月">
            <option value="">—</option>
            <?php for ($i=1; $i < 13; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_ymd_txt">月</span>

        <div class="select_arrow select_md">
          <select name="申込日">
            <option value="">—</option>
            <?php for ($i=1; $i < 32; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
          </div>
        <span class="select_ymd_txt">日&nbsp;迄</span>
      </div>
      
      <!--経験-->
      <div class="white_box SSmall clear">
        <p>経験</p>
        <div class="select_arrow">
          <select id="select_exp" name="経験" style="width:150px;">
            <optgroup label="全て選択">
              <option value="未経験">未経験</option>
              <option value="ソープ">ソープ</option>
              <option value="性感エステ">性感エステ</option>
            </optgroup>
          </select>
        </div>
      </div>
      
      <!--年齢-->
      <div class="white_box">
        <p>年齢</p>
        <div class="select_arrow select_other">
          <select name="age">
            <option value="">—</option>
            <?php for ($i=16; $i < 60; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_other_txt">歳&nbsp;～</span>
        <div class="select_arrow select_other">
          <select name="age">
            <option value="">—</option>
            <?php for ($i=16; $i < 60; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_other_txt">歳</span>
      </div>
      <!--身長-->
      <div class="white_box">
        <p>身長</p>
        <div class="select_arrow select_other">
          <select name="age">
            <option value="">—</option>
            <?php for ($i=135; $i < 180; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_other_txt">cm&nbsp;～</span>
        <div class="select_arrow select_other">
          <select name="age">
            <option value="">—</option>
            <?php for ($i=135; $i < 180; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_other_txt">cm</span>
      </div>
      <!--体重-->
      <div class="white_box">
        <p>体重</p>
        <div class="select_arrow select_other">
          <select name="age">
            <option value="">—</option>
            <?php for ($i=40; $i < 100; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_other_txt">kg&nbsp;～</span>
        <div class="select_arrow select_other">
          <select name="age">
            <option value="">—</option>
            <?php for ($i=40; $i < 100; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <span class="select_other_txt">kg</span>
      </div>
      <!--住所-->
      <div class="white_box LLarge clear">
        <p>住所</p>
        <div class="select_arrow select_address">
          <select id="select_ad" name="住所" style="width:160px;">
            <optgroup label="">
              <option value="北海道">北海道</option>
            </optgroup>
            <optgroup label="東北">
              <option value="青森県">青森県</option>
              <option value="岩手県">岩手県</option>
              <option value="宮城県">宮城県</option>
              <option value="秋田県">秋田県</option>
              <option value="山形県">山形県</option>
              <option value="福島県">福島県</option>
            </optgroup>
            <optgroup label="関東">
              <option value="東京都">東京都</option>
              <option value="茨城県">茨城県</option>
              <option value="栃木県">栃木県</option>
              <option value="群馬県">群馬県</option>
              <option value="埼玉県">埼玉県</option>
              <option value="千葉県">千葉県</option>
              <option value="神奈川県">神奈川県</option>
            </optgroup>
          </select>
        </div>
        <span class="select_other_txt">都道府県</span>
        <input type="text" name="住所" value="" size="75" class="address_txt">
      </div>
      <!--検索ボタン-->
      <div class="scout_btn clear">
        <a href="scout-srch2.php"><button type="button" class="btn_orange">検索</button></a>
      </div>
    </div><!-- 掲載求人名タブend -->
    
  </div>
</section>



</article>
</main>

<script src="js/jquery.multiple.select.js"></script>
<script>
//tab
$(function() {
  $('.tab li:nth-child(1)').addClass('current');
  $('.tab li').click(function() {
    var num = $(this).parent().children('li').index(this);
    $(this).parent('.tab').each(function(){
      $('>li',this).removeClass('current').eq(num).addClass('current');
    });
    $(this).parent().next().children('.scout_content').hide().eq(num).show();
  }).first().click();
});


//multipleSelect
$(function() {
  var $selects = $('[id^=select_]');
  $selects.multipleSelect();
});

</script>

<?php include('common/footer.php'); ?>
