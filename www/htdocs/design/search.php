<?php include('common/resource.php'); ?>
<title>検索条件</title>
<?php include('common/header.php'); ?>
<?php include('common/array.php'); ?>

<article id="search" class="container">
  <section class="top_content_wrap">

  </section>
  <section class="search_info_col">
    <h1 class="breadcrumb">&gt;&nbsp;検索条件</h1>
    <!--検索ボタン-->
    <div class="search_btn">
      <button type="submit" class="btn_orange"><a href="search-result.php">検索</a></button>
    </div>
    <!-- 申込日-->
    <div class="white_box MMedium">
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
    <!-- 申込時間-->
    <div class="white_box Small">
      <p>申込時間</p>
      <div class="select_arrow select_h">
        <select name="申込時間/時">
          <option value="">—</option>
          <?php for ($i=0; $i < 24; $i++) : ?>
          <option value="<?php echo $i;?>"><?php echo $i; ?></option>
          <?php endfor; ?>
        </select>
      </div>
      <span class="select_ymd_txt">時&nbsp;～&nbsp;</span>
      <div class="select_arrow select_h">
        <select name="申込時間/時２">
          <option value="">—</option>
          <?php for ($i=0; $i < 24; $i++) : ?>
          <option value="<?php echo $i;?>"><?php echo $i; ?></option>
          <?php endfor; ?>
        </select>
      </div>
      <span class="select_ymd_txt">時&nbsp;迄</span>
    </div>
    <!-- 申込名-->
    <div class="white_box SSmall">
      <p>申込名</p>
      <input type="text" class="input_name" name="申込姓" value="">
    </div>
    <!-- 面接日-->
    <div class="white_box MMedium">
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
    
    <!--面接店舗-->
    <div class="white_box SSSmall">
      <p>面接店舗</p>
      <div class="select_arrow">
        <select id="select_intshop" name="面接店舗" style="width:195px;">
          <optgroup label="全て選択">
            <?php foreach ($workshop as $key => $value): ?>
            <option value=""><?php echo $value; ?></option>
            <?php endforeach; ?>
          </optgroup>
        </select>
      </div>
    </div>
    <!--所属店舗-->
    <div class="white_box SSSmall">
      <p>所属店舗</p>
      <div class="select_arrow">
        <select id="select_shop" name="所属店舗" style="width:195px;">
          <optgroup label="全て選択">
            <?php foreach ($workshop as $key => $value): ?>
            <option value=""><?php echo $value; ?></option>
            <?php endforeach; ?>
          </optgroup>
        </select>
      </div>
    </div>
    <!-- 源氏名-->
    <div class="white_box SSmall clear">
      <p>源氏名</p>
      <input type="text" name="源氏名" value="" size="14">
    </div>
    <!-- 源氏名（ふりがな）-->
    <div class="white_box SSmall">
      <p>源氏名（ふりがな）</p>
      <input type="text" name="源氏名（ふりがな）" value="" size="14">
    </div>
    <!-- 名前-->
    <div class="white_box XSMedium">
      <p>名前</p>
      <span class="search_select_txt">姓</span><input type="text" name="名前姓" value="" size="14">
      <span class="search_select_txt space">名</span><input type="text" name="名前名" value="" size="14">
    </div>
    <!-- 名前（ふりがな）-->
    <div class="white_box XSMedium">
      <p>名前（ふりがな）</p>
      <span class="search_select_txt">姓</span><input type="text" name="なまえ姓" value="" size="14">
      <span class="search_select_txt space">名</span><input type="text" name="なまえ名" value="" size="14">
    </div>
    <!--年齢-->
    <div class="white_box clear">
      <p>年齢</p>
      <div class="select_arrow select_other">
        <select name="age">
          <option value="">—</option>
          <?php for ($i=14; $i < 70; $i++) : ?>
          <option value="<?php echo $i;?>"><?php echo $i; ?></option>
          <?php endfor; ?>
        </select>
      </div>
      <span class="select_other_txt">歳&nbsp;～</span>
      <div class="select_arrow select_other">
        <select name="age">
          <option value="">—</option>
          <?php for ($i=14; $i < 70; $i++) : ?>
          <option value="<?php echo $i;?>"><?php echo $i; ?></option>
          <?php endfor; ?>
        </select>
      </div>
      <span class="select_other_txt">歳</span>
    </div>
    <!--身長-->
    <div class="white_box Small">
      <p>身長</p>
      <div class="select_arrow select_other">
        <select name="身長">
          <option value="">—</option>
          <?php for ($i=135; $i < 180; $i+=1) : ?>
          <option value="<?php echo $i;?>"><?php echo $i; ?></option>
          <?php endfor; ?>
        </select>
      </div>
      <span class="select_other_txt">cm&nbsp;～</span>
      <div class="select_arrow select_other">
        <select name="身長">
          <option value="">—</option>
          <?php for ($i=135; $i < 180; $i+=1) : ?>
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
        <select name="体重">
          <option value="">—</option>
          <?php for ($i=40; $i < 100; $i+=1) : ?>
          <option value="<?php echo $i;?>"><?php echo $i; ?></option>
          <?php endfor; ?>
        </select>
      </div>
      <span class="select_other_txt">kg&nbsp;～</span>
      <div class="select_arrow select_other">
        <select name="体重">
          <option value="">—</option>
          <?php for ($i=40; $i < 100; $i+=1) : ?>
          <option value="<?php echo $i;?>"><?php echo $i; ?></option>
          <?php endfor; ?>
        </select>
      </div>
      <span class="select_other_txt">kg</span>
    </div>
    <!--カップ数-->
    <div class="white_box Small">
      <p>カップ数</p>
      <div class="select_arrow select_other">
        <select name="カップ数">
          <option value="">—</option>
          <option value="A">A</option>
          <option value="B">B</option>
          <option value="C">C</option>
          <option value="D">D</option>
          <option value="E">E</option>
          <option value="F">F</option>
          <option value="G">G</option>
        </select>
      </div>
      <span class="select_other_txt">cup&nbsp;～</span>
      <div class="select_arrow select_other">
        <select name="カップ数">
          <option value="">—</option>
          <option value="A">A</option>
          <option value="B">B</option>
          <option value="C">C</option>
          <option value="D">D</option>
          <option value="E">E</option>
          <option value="F">F</option>
          <option value="G">G</option>
        </select>
      </div>
      <span class="select_other_txt">cup</span>
    </div>
    <!--経験-->
    <div class="white_box SSmall">
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
    <!--住所-->
    <div class="white_box LLarge">
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
    <!--身分証-->
    <div class="white_box clear">
      <p>身分証</p>
      <div class="select_arrow">
        <select id="select_id" name="身分証" style="width:210px;">
          <optgroup label="全て選択">
            <option value="免許証">免許証</option>
            <option value="パスポート">パスポート</option>
            <option value="マイナンバー">マイナンバー</option>
            <option value="住基カード">住基カード</option>
            <option value="在留カード">在留カード</option>
            <option value="保険証">保険証</option>
            <option value="学生証">学生証</option>
            <option value="療育手帳">療育手帳</option>
            <option value="年金手帳">年金手帳</option>
            <option value="住民票">住民票</option>
            <option value="戸籍謄本">戸籍謄本</option>
          </optgroup>
        </select>
      </div>
    </div>
    <!--TEL-->
    <div class="white_box">
      <p>TEL</p>
      <input type="tel" name="tel01" value="" size="3"><span class="hyphen">-</span><input type="tel" name="tel02" value="" size="3"><span class="hyphen">-</span><input type="tel" name="tel03" value="" size="3">
    </div>
    <!--Mail-->
    <div class="white_box XMedium">
      <p>Mail</p>
      <input type="mail" name="maill01" value="" size="20"><span class="at">＠</span>
      <div class="select_arrow select_mail">
        <select name="Mail">
          <option value="">—</option>
          <option value="softbank.ne.jp">softbank.ne.jp</option>
          <option value="i.softbank.jp">i.softbank.jp</option>
          <option value="docomo.ne.jp">docomo.ne.jp</option>
          <option value="gmail.com">gmail.com</option>
          <option value="yahoo.co.jp">yahoo.co.jp</option>          
        </select>
      </div>
    </div>
    <!--面接結果-->
    <div class="white_box XSmall clear">
      <p>面接結果</p>
      <div class="select_arrow">
        <select id="select_result" name="面接結果" style="width:110px;">
          <optgroup label="全て選択">
            <option value="採用">採用</option>
            <option value="不採用">不採用</option>
            <option value="撃沈">撃沈</option>
            <option value="他店紹介">他店紹介</option>
          </optgroup>
        </select>
      </div>
    </div>   
    <!--面接担当-->
    <div class="white_box XSmall">
      <p>面接担当</p>
      <div class="select_arrow">
        <select id="select_staff" name="面接担当" style="width:120px;">
          <optgroup label="全て選択">
            <?php foreach ($staffname as $key => $value): ?>
              <option value=""><?php echo $value; ?></option>
            <?php endforeach; ?>
          </optgroup>
        </select>
      </div>
    </div>
    <!--KS担当-->
    <div class="white_box XSmall">
      <p>KS担当</p>
      <div class="select_arrow">
        <select id="select_ksstaff" name="KS担当" style="width:120px;">
          <optgroup label="全て選択">
            <?php foreach ($staffname as $key => $value): ?>
              <option value=""><?php echo $value; ?></option>
            <?php endforeach; ?>
          </optgroup>
        </select>
      </div>
    </div>
    <!--勤務形態-->
    <div class="white_box XSmall clear">
      <p>勤務形態</p>
      <div class="select_arrow">
        <select id="select_workform" name="勤務形態" style="width:110px;">
          <optgroup label="全て選択">
            <option value="早番">早番</option>
            <option value="中番">中番</option>
            <option value="遅番">遅番</option>
            <option value="深夜">深夜</option>
          </optgroup>
        </select>
      </div>
    </div>
    <!--給料-->
    <div class="white_box Small">
      <p>給料</p>
      <div class="select_arrow select_yen">
        <input type="text" class="input_saraly">
      </div>
      <span class="select_ymd_txt">円&nbsp;～&nbsp;</span>
      <div class="select_arrow select_yen">
        <input type="text" class="input_saraly">
      </div>
      <span class="select_ymd_txt">円</span>
    </div>
    <!--特別指名料-->
    <div class="white_box Small">
      <p>特別指名料</p>
      <div class="select_arrow select_yen">
        <input type="text" class="input_saraly">
      </div>
      <span class="select_ymd_txt">円&nbsp;～&nbsp;</span>
      <div class="select_arrow select_yen">
        <input type="text" class="input_saraly">
      </div>
      <span class="select_ymd_txt">円</span>
    </div>
    <!-- 退店 -->
    <div class="white_box search3 clear">
      <div class="checkbox_serch">
        <label>
          <input type="checkbox" name="checkbox[]" class="checkbox_serch-sqar">
          <span class="checkbox_serch-txt">退店</span>
        </label>
      </div>
    </div>
    <!-- 退店日 -->
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
        <select name="退店日年">
          <option value="">—</option>
          <?php for ($i=2013; $i < 2025; $i++) : ?>
          <option value="<?php echo $i;?>"><?php echo $i; ?></option>
          <?php endfor; ?>
        </select>
      </div>
      <span class="select_ymd_txt">年</span>

      <div class="select_arrow select_md">
        <select name="退店日年月">
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
    <!--退店理由-->
    <div class="white_box">
      <p>退店理由</p>
      <div class="select_arrow">
        <select id="select_reason" name="退店理由" style="width:210px;">
          <optgroup label="全て選択">
            <option value="1">音信不通</option>
            <option value="2">目標達成</option>
            <option value="3">就職</option>
            <option value="4">結婚</option>
            <option value="5">稼げない</option>
            <option value="6">身バレ</option>
          </optgroup>
        </select>
      </div>
    </div>   
    <!--掲載媒体-->
    <div class="white_box clear">
      <p>掲載媒体</p>
      <div class="select_arrow">
        <select id="select_media" name="掲載媒体" style="width: 190px;">
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
    <!--掲載エリア-->
    <div class="white_box SSmall">
      <p>掲載エリア</p>
      <div class="select_arrow">
        <select id="select_area" name="掲載エリア" style="width:150px;">
          <optgroup label="全て選択">
            <option value="梅田">梅田</option>
            <option value="京橋">京橋</option>
            <option value="難波">難波</option>
            <option value="日本橋">日本橋</option>
            <option value="谷９">谷９</option>
            <option value="キタ">キタ</option>
            <option value="ミナミ">ミナミ</option>
          </optgroup>
        </select>
      </div>
    </div>
    <!--掲載求人-->
    <div class="white_box">
      <p>掲載求人</p>
      <div class="select_arrow">
        <select id="select_recruit" name="掲載求人" style="width: 190px;">
          <optgroup label="全て選択">
            <?php foreach ($jobshop as $key => $value): ?>
            <option value=""><?php echo $value; ?></option>
            <?php endforeach; ?>
          </optgroup>
        </select>
      </div>
    </div>
    <!--掲載業種-->
    <div class="white_box">
      <p>掲載業種</p>
      <div class="select_arrow">
        <select id="select_type" name="掲載業種" style="width: 190px;">
          <optgroup label="全て選択">
            <option value="ヘルス">ヘルス</option>
            <option value="オナクラ">オナクラ</option>
            <option value="性感エステ">性感エステ</option>
            <option value="ホテヘル">ホテヘル</option>
            <option value="デリヘル">デリヘル</option>
            <option value="ソープ">ソープ</option>
          </optgroup>
        </select>
      </div>
    </div>
    <!--スカウト-->
    <div class="white_box">
      <p>スカウト</p>
      <div class="select_arrow select_medium">
        <select id="select_scout" name="スカウト" style="width: 190px;">
          <optgroup label="全て選択">
            <?php for ($i=0; $i <= 100; $i++) : ?>
            <option value="<?php echo $i;?>"><?php echo $i; ?></option>
            <?php endfor; ?>
          </optgroup>
        </select>
      </div>
    </div>    
    <!--出戻り・移籍・紹介-->
    <div class="white_box SSmall">
      <p>出戻り・移籍・紹介</p>
      <div class="select_arrow">
        <select id="select_kinds" name="出戻り" style="width:150px;">
          <optgroup label="全て選択">
            <option value="出戻り">出戻り</option>
            <option value="移籍">移籍</option>
            <option value="紹介">紹介</option>
          </optgroup>
        </select>
      </div>
    </div>
    <!--他店紹介-->
    <div class="white_box XMedium">
      <p>他店紹介</p>
      <div class="select_arrow select_yen">
        <select id="select_shops" name="他店紹介" style="width:170px;">
          <optgroup label="全て選択">
            <option value="激安グループ">激安グループ</option>
            <option value="スパークグループ">スパークグループ</option>
            <option value="珍太郎">珍太郎</option>
            <option value="奥様日記">奥様日記</option>
            <option value="センスプロモーション">センスプロモーション</option>
          </optgroup>
        </select>
      </div>
      <span class="select_other_txt2">備考</span><input type="text" name="taten_bikou" class="search_bikou">
    </div>
    <!--検索ワード-->
    <div class="white_box SSmall clear">
      <p>検索ワード</p>
      <div class="select_arrow select_word">
        <select id="select_word" name="検索ワード" style="width:150px;">
          <optgroup label="全て選択">
            <option value="未経験">未経験</option>
            <option value="デリヘル">デリヘル</option>
            <option value="オナクラ">オナクラ</option>
            <option value="大阪">大阪</option>
            <option value="風俗">風俗</option>
            <option value="高収入">高収入</option>
            <option value="アルバイト">アルバイト</option>
          </optgroup>
        </select>
      </div>
    </div>
    <!--チェック-->
    <div class="white_box search4">
      <div class="checkbox_serch">
        <label>
          <input type="checkbox" name="checkbox[]" class="checkbox_serch-sqar">
          <span class="checkbox_serch-txt">出稼ぎ</span>
        </label>
      </div>
    </div>
    <div class="white_box search">
      <div class="checkbox_serch">
        <label>
          <input type="checkbox" name="checkbox[]" class="checkbox_serch-sqar">
          <span class="checkbox_serch-txt">ニコイチ</span>
        </label>
      </div>
    </div>   
    <div class="white_box search2">
      <div class="checkbox_serch">
        <label>
          <input type="checkbox" name="checkbox[]" class="checkbox_serch-sqar">
          <span class="checkbox_serch-txt">スカウトメールからの申し込み</span>
        </label>
      </div>
    </div>   
    <!--店舗スタッフ-->
    <div class="white_box SSmall clear">
      <label for="tenpo" class="tenpo_radio">
        <input name="tenpo" type="radio">
        <span class="tenpo_label">店舗スタッフ</span>
      </label>
    </div>

  </section>
</article>
</main>


<script src="js/jquery.multiple.select.js"></script>
<script>
  $(function() {
    var $selects = $('[id^=select_]');
    $selects.multipleSelect();
  });
</script>

<?php include('common/footer.php'); ?>