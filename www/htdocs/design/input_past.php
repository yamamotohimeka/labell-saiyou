<?php include('common/resource.php'); ?>
<title>データ入力</title>
<?php include('common/header.php'); ?>
<?php include('common/array.php'); ?>

<?php include('common/drawer.php'); ?>

<main role="main">
<section class="top_content_wrap">
</section>
<section class="container date_info_col">
  <h1 class="breadcrumb date_info_breadcrumb inline">&gt;&nbsp;データ入力</h1>
  <div class="input_alert">
    <p>藤村さんが入力中です。現在編集はできません。</p>
  </div>
  <form id="form" class="data_form" action="input.php" method="post">
    <!-- date_info_inner-->
    <div class="date_info_inner">
      <div class="input_top_line">
        <div class="officer">
          担当：藤村
        </div>
         <div class="input_show_index">
          <a href="index.php"><button type="button" class="btn_orange index">採用情報を見る</button></a>
        </div>
        <div class="input_show_index">
          <a href="input_past.php"><button type="button" class="btn_orange index">同一人物を探す</button></a>
        </div>

      </div>
      <!--左サイドここから-->
      <div class="date_left_col">
        <!-- 申込日-->
        <div class="white_box input_left">
          <p>申込日<span class="required2">※必須</span></p>
          <div class="select_arrow select_input_y">
            <select name="申込年" class="reqSelect reqSelect4">
              <option value="0">—</option>
              <?php for ($i=2013; $i < 2025; $i++) : ?>
              <option value="<?php echo $i;?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <span class="select_input_ymd_txt">年</span>
          <div class="select_arrow select_input_md">
            <select name="申込月" class="reqSelect2 reqSelect5">
              <option value="0">—</option>
              <?php for ($i=1; $i < 13; $i++) : ?>
              <option value="<?php echo $i;?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <span class="select_input_ymd_txt">月</span>
          <div class="select_arrow select_input_md">
            <select name="申込日" class="reqSelect3 reqSelect6">
              <option value="0">—</option>
              <?php for ($i=1; $i < 32; $i++) : ?>
              <option value="<?php echo $i;?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <span class="select_input_ymd_txt">日</span>
        </div>
        <!-- 申込時間-->
        <div class="white_box input_left">
          <p>申込時間</p>
          <div class="select_arrow select_input_h">
            <select name="申込時間/時">
              <option value="">—</option>
              <?php for ($i=0; $i <= 24; $i++) : ?>
              <option value="<?php echo $i;?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <span class="select_ymd_txt">時</span>
          <div class="select_arrow select_input_h">
            <select name="申込時間/分">
              <option value="">—</option>
              <?php for ($i=0; $i <= 31; $i++) : ?>
              <option value="<?php echo $i;?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <span class="select_ymd_txt">分</span>
        </div>
        <!-- 申込名-->
        <div class="white_box input_left">
          <p>申込名<span class="required2">※必須</span></p>
          <input type="text" name="申込名" class="input_req input_req2">
        </div>
        <!-- 面接予定日-->
        <div class="white_box input_left">
          <p>面接予定日<span class="required">※必須</span></p>
          <div class="select_arrow select_input_y">
            <select name="面接予定年" class="reqSelect7">
              <option value="">—</option>
              <?php for ($i=2013; $i < 2025; $i++) : ?>
              <option value="<?php echo $i;?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <span class="select_input_ymd_txt">年</span>
          <div class="select_arrow select_input_md">
            <select name="面接予定月" class="reqSelect8">
              <option value="">—</option>
              <?php for ($i=1; $i < 13; $i++) : ?>
              <option value="<?php echo $i;?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <span class="select_input_ymd_txt">月</span>
          <div class="select_arrow select_input_md">
            <select name="面接予定日" class="reqSelect9">
              <option value="">—</option>
              <?php for ($i=1; $i < 32; $i++) : ?>
              <option value="<?php echo $i;?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <span class="select_input_ymd_txt">日</span>
        </div>
        <!-- 面接予定時間-->
        <div class="white_box input_left relative">
          <p>面接予定時間<span class="required">※必須</span></p>
          <div class="select_arrow select_input_h">
            <select name="面接予定時間/時" class="reqSelect10">
              <option value="">—</option>
              <?php for ($i=0; $i <= 24; $i++) : ?>
              <option value="<?php echo $i;?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <span class="select_ymd_txt">時</span>
          <div class="select_arrow select_input_h">
            <select name="面接予定時間/分" class="reqSelect11">
              <option value="">—</option>
              <?php for ($i=0; $i <= 31; $i++) : ?>
              <option value="<?php echo $i;?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <span class="select_ymd_txt">分</span>
          <div class="tbd">
            <label>
              <input type="checkbox" name="checkbox2[]" class="checkbox-sqar">
              <span class="checkbox-txt text_right">仮予約</span>
            </label>
          </div>
          <p class="description">仮予約の場合は面接予定メールは送信しない</p>
        </div>
        <!-- 連絡方法-->
        <div class="white_box input_left">
          <p>連絡方法</p>
          <div class="select_arrow select_input_half">
            <select name="面接前確認">
              <option value="">—</option>
              <option value="">LINE</option>
              <option value="">TEL</option>
              <option value="">MAIL</option>
            </select>
          </div>
        </div>
        <!-- 面接前確認-->
        <div class="white_box input_left">
          <p>面接前確認</p>
          <div class="select_arrow select_input_half">
            <select name="面接前確認">
              <option value="">—</option>
              <option value="">第一確認中</option>
              <option value="">第二確認中</option>
              <option value="">確認済み</option>
              <option value="">到着</option>
              <option value="">ブッチ</option>
              <option value="">変更中</option>
              <option value="">キャンセル</option>
            </select>
          </div>
        </div>
        <!-- タイマー-->
        <div class="white_box input_left">
          <p>タイマー</p>
          <div class="timer">
            <label>
              <input type="radio" name="rb2"　value="">不要
            </label>
          </div>
        </div>
        <!-- 面接時間-->
        <div class="white_box input_left relative">
          <p class="inline">面接時間</p>
          <input type="text" pattern="^¥d+$" title="半角数字でご入力ください。" name="面接時間" size="4">
          <span class="select_ymd_txt">分前</span>
        </div>
        <!-- 事前連絡日-->
        <div class="white_box input_left">
          <p>事前連絡日</p>
          <div class="select_arrow select_input_y">
            <select name="事前連絡年">
              <option value="">—</option>
              <?php for ($i=2013; $i < 2025; $i++) : ?>
              <option value="<?php echo $i;?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <span class="select_input_ymd_txt">年</span>
          <div class="select_arrow select_input_md">
            <select name="事前連絡月">
              <option value="">—</option>
              <?php for ($i=1; $i < 13; $i++) : ?>
              <option value="<?php echo $i;?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <span class="select_input_ymd_txt">月</span>
          <div class="select_arrow select_input_md">
            <select name="事前連絡日">
              <option value="">—</option>
              <?php for ($i=1; $i < 32; $i++) : ?>
              <option value="<?php echo $i;?>"><?php echo $i; ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <span class="select_input_ymd_txt">日</span>
        </div>
        <!-- 店舗スタッフ-->
        <div class="white_box input_left bottom20">
          <div class="tenpostaff">
            <label>
              <input type="checkbox" name="checkbox2[]" class="checkbox-sqar">
              <span class="checkbox-txt text_right">店舗スタッフ</span>
            </label>
          </div>
        </div>
        <!-- 面接店舗-->
        <div class="white_box input_left">
          <p>面接店舗</p>
          <div class="select_arrow select_input_half">
            <select name="面接店舗">
              <option value="">—</option>
              <?php foreach ($workshop as $key => $value): ?>
              <option value=""><?php echo $value; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <!-- 待ち合わせ場所-->
        <div class="white_box input_left">
          <p>待ち合わせ場所</p>
          <div class="select_arrow select_input_half">
            <select name="待ち合わせ場所">
              <option value="">—</option>
              <option value="">泉の広場</option>
              <option value="">日本橋１０号出入り口</option>
            </select>
          </div>
        </div>
        <!-- 待ち合わせ備考-->
        <div class="white_box input_left">
          <p>待ち合わせ備考</p>
          <input type="text" name="待ち合わせ備考" size="25">
        </div>
        <!-- 掲載エリア-->
        <div class="white_box input_left">
          <p>掲載エリア</p>
          <div class="select_arrow select_input_half">
            <select name="掲載エリア">
              <option value="">—</option>
              <option value="梅田">梅田</option>
              <option value="京橋">京橋</option>
              <option value="難波">難波</option>
              <option value="日本橋">日本橋</option>
              <option value="谷９">谷９</option>
              <option value="キタ">キタ</option>
              <option value="ミナミ">ミナミ</option>
            </select>
          </div>
        </div>
        <!-- 画像参照-->
        <div class="white_box input_img">
          <div class="imgInput">
            <p>写真１</p>
            <label for="file_photo" name="file1" class="photo_input">
              画像参照
              <input type="file" id="file_photo" style="display:none;">
            </label>
          </div><!--/.imgInput-->
        </div>
        <div class="white_box input_img">
          <div class="imgInput">
            <p>写真２</p>
            <label for="file_photo2" name="file2" class="photo_input">
              画像参照
              <input type="file" id="file_photo2" style="display:none;">
            </label><br>
          </div><!--/.imgInput-->
        </div>
        <div class="white_box input_img">
          <div class="imgInput">
            <p>写真３</p>
            <label for="file_photo3" name="file3" class="photo_input">
              画像参照
              <input type="file" id="file_photo3" style="display:none;">
            </label><br>
          </div><!--/.imgInput-->
        </div>
        <script>
          $(function(){
              var setFileInput = $('.imgInput');
              setFileInput.each(function(){
                  var selfFile = $(this),
                  selfInput = $(this).find('input[type=file]');

                  selfInput.change(function(){
                      var file = $(this).prop('files')[0],
                      fileRdr = new FileReader(),
                      selfImg = selfFile.find('.imgView');

                      if(!this.files.length){
                          if(0 < selfImg.size()){
                              selfImg.remove();
                              return;
                          }
                      } else {
                          if(file.type.match('image.*')){
                              if(!(0 < selfImg.size())){
                                  selfFile.append('<a><img alt="" class="imgView"></a>');
                              }
                              var prevElm = selfFile.find('.imgView');
                              var prevElm2 = selfFile.find('a');
                              fileRdr.onload = function() {
                                  prevElm.attr('src', fileRdr.result);
                                  prevElm2.attr('href', fileRdr.result);
                              }
                              fileRdr.readAsDataURL(file);
                          } else {
                              if(0 < selfImg.size()){
                                  selfImg.remove();
                                  return;
                              }
                          }
                      }
                  });
              });
            });
          </script>
      </div><!--/date_left_col-->

      <!--右サイドここから-->
      <div class="date_right_col">
        <!--ボタン-->
        <div class="date_right_x">
          <a href="input_top.php"><input type="button"><img src="img/icon_x.png"></a>
        </div>
        <div class="date_right_koshin">
          <button id="btn_id" form="form" class="btn_orange" type="submit" name="更新">更新</button>
        </div>
        <div class="date_right_hukusei">
          <a href="input_copy.php"><button class="btn_orange hukusei" type="button">複製</button></a>
        </div>
        <div class="date_right_delete">
          <button id="button" class="btn_orange delete" type="button">データ消去</button>
        </div>

        <!--掲載媒体-->
        <div class="white_box input_right SSmall">
          <p>掲載媒体</p>
          <div class="select_arrow">
            <select name="掲載媒体">
              <option value="">—</option>
              <option value="">Qプリ</option>
              <option value="">ガールズヘブン</option>
              <option value="">ぴゅあじょ</option>
              <option value="">１５なび</option>
              <option value="">バニラ</option>
              <option value="">出稼ぎ.com</option>
            </select>
          </div>
        </div>
        <!--掲載求人-->
        <div class="white_box input_right SSSmall">
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
        <!--掲載業種-->
        <div class="white_box input_right SSmall">
          <p>掲載業種</p>
          <div class="select_arrow">
            <select name="掲載業種">
              <option value="">—</option>
              <option value="ヘルス">ヘルス</option>
              <option value="オナクラ">オナクラ</option>
              <option value="性感エステ">性感エステ</option>
              <option value="ホテヘル">ホテヘル</option>
              <option value="デリヘル">デリヘル</option>
              <option value="ソープ">ソープ</option>
            </select>
          </div>
        </div>
        <!--スカウト-->
        <div class="white_box input_right XSmall">
          <p>スカウト</p>
          <div class="select_arrow select_scout">
            <select id="select_scout" name="スカウト">
              <optgroup label="全て選択">
                <option value="">—</option>
                <?php for ($i=0; $i <= 100; $i++) : ?>
                <option value="<?php echo $i;?>"><?php echo $i; ?></option>
                <?php endfor; ?>
              </optgroup>
            </select>
          </div>
        </div>
        <!--出戻り・移籍・紹介-->
        <div class="white_box input_right">
          <p>出戻り・移籍・紹介</p>
          <div class="select_arrow">
            <select name="出戻り" style="width:150px;">
              <option value="">—</option>
              <option value="出戻り">出戻り</option>
              <option value="移籍">移籍</option>
              <option value="紹介">紹介</option>
            </select>
          </div>
        </div>
        <!--TEL-->
        <div class="white_box input_right XSMedium">
          <p>TEL</p>
          <input type="tel" pattern="^¥d+$" title="半角数字でご入力ください。" name="tel01" value="" size="5">
          <span class="hyphen">-</span>
          <input type="tel" pattern="^¥d+$" title="半角数字でご入力ください。" name="tel02" value="" size="5">
          <span class="hyphen">-</span>
          <input type="tel" pattern="^¥d+$" title="半角数字でご入力ください。" name="tel03" value="" size="5">
        </div>
        <!--Mail-->
        <div class="white_box input_right Mail">
          <p>Mail</p>
          <input type="mail" pattern="^[0-9A-Za-z]+$" title="半角英数字でご入力ください。" name="maill01" value="" size="18"><span class="at">＠</span>
          <div class="select_arrow select_mail">
            <select name="Mail" style="size:150px;">
              <option value="">—</option>
              <option value="softbank.ne.jp">softbank.ne.jp</option>
              <option value="i.softbank.jp">i.softbank.jp</option>
              <option value="docomo.ne.jp">docomo.ne.jp</option>
              <option value="gmail.com">gmail.com</option>
              <option value="yahoo.co.jp">yahoo.co.jp</option>
            </select>
          </div>
        </div>
        <!--年齢-->
        <div class="white_box input_right XSmall clear">
          <p>年齢</p>
          <input type="text" pattern="^¥d+$" title="半角数字でご入力ください。" name="年齢" value="" size="5">
          <span class="select_other_txt">歳</span>
        </div>
        <!--経験-->
        <div class="white_box input_right SSmall">
          <p>経験</p>
          <div class="select_arrow">
            <select name="経験" id="select_exp">
              <optgroup label="全て選択">
                <option value="未経験">未経験</option>
                <option value="ソープ">ソープ</option>
                <option value="性感エステ">性感エステ</option>
              </optgroup>
            </select>
          </div>
        </div>
        <!--経験備考-->
        <div class="white_box input_right">
          <p>経験備考</p>
          <input type="text" name="経験備考" value="" size="25">
        </div>
        <!--身長-->
        <div class="white_box input_right XSmall clear">
          <p>身長</p>
          <input type="text" pattern="^¥d+$" title="半角数字でご入力ください。" name="身長" value="" size="4">
          <span class="select_other_txt">cm</span>
        </div>
        <!--体重-->
        <div class="white_box input_right XSmall">
          <p>体重</p>
          <input type="text" pattern="^¥d+$" title="半角数字でご入力ください。" name="体重" value="" size="4">
          <span class="select_other_txt">kg</span>
        </div>
        <!--バスト-->
        <div class="white_box input_right XSmall">
          <p>バスト</p>
          <input type="text" pattern="^¥d+$" title="半角数字でご入力ください。" name="バスト" value="" size="4">
          <span class="select_other_txt">cm</span>
        </div>
        <!--カップ数-->
        <div class="white_box input_right XSmall">
          <p>カップ数</p>
          <div class="select_arrow slect_input_cup">
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
        <!--ウエスト-->
        <div class="white_box input_right XSmall">
          <p>ウエスト</p>
          <input type="text" pattern="^¥d+$" title="半角数字でご入力ください。" name="ウエスト" value="" size="4">
          <span class="select_other_txt">cm</span>
        </div>
        <!--ヒップ-->
        <div class="white_box input_right XSmall">
          <p>ヒップ</p>
          <input type="text" pattern="^¥d+$" title="半角数字でご入力ください。" name="ヒップ" value="" size="4">
          <span class="select_other_txt">cm</span>
        </div>
        <!--チェック-->
        <div class="white_box input_check clear">
          <p>面接希望条件欄</p>
          <div class="checkbox">
            <label>
              <input type="checkbox" name="checkbox[]" class="checkbox-sqar">
              <span class="checkbox-txt">希望バック</span>
            </label>
            <input type="text" pattern="^¥d+$" title="半角数字でご入力ください。" name="希望バック" value="" size="4">
            <span class="select_other_txt text_right">円</span>
            <label>
              <input type="checkbox" name="checkbox[]" class="checkbox-sqar">
              <span class="checkbox-txt">希望保証</span>
            </label>
            <input type="text" pattern="^¥d+$" title="半角数字でご入力ください。" name="希望保証時間" value="" size="2">
            <span class="select_other_txt">時間</span>
            <input type="text" pattern="^¥d+$" title="半角数字でご入力ください。" name="希望保証円" value="" size="4">
            <span class="select_other_txt text_right">円</span>
            <label>
              <input type="checkbox" name="checkbox[]" class="checkbox-sqar">
              <span class="checkbox-txt">入店祝い金</span>
            </label>
            <input type="text" pattern="^¥d+$" title="半角数字でご入力ください。" name="入店祝い金時間" value="" size="2">
            <span class="select_other_txt">時間</span>
            <input type="text" pattern="^¥d+$" title="半角数字でご入力ください。" name="入店祝い金円" value="" size="4">
            <span class="select_other_txt">円</span><br>
            <label>
              <input type="checkbox" name="checkbox[]" class="checkbox-sqar">
              <span class="checkbox-txt text_right">送迎</span>
            </label>
            <label>
              <input type="checkbox" name="checkbox[]" class="checkbox-sqar">
              <span class="checkbox-txt text_right">寮</span>
            </label>
            <label>
              <input type="checkbox" name="checkbox[]" class="checkbox-sqar">
              <span class="checkbox-txt text_right">タトゥーや傷痕</span>
            </label>
            <label>
              <input type="checkbox" name="checkbox[]" class="checkbox-sqar">
              <span class="checkbox-txt text_right">託児所</span>
            </label>
            <label>
              <input type="checkbox" name="checkbox[]" class="checkbox-sqar">
              <span class="checkbox-txt text_right">体験可能</span>
            </label>
            <label>
              <input type="checkbox" name="checkbox[]" class="checkbox-sqar">
              <span class="checkbox-txt">身分証</span>
            </label>
            <input type="text" name="身分証" value="" size="20"><br>
            <label>
              <input type="checkbox" name="checkbox[]" class="checkbox-sqar">
              <span class="checkbox-txt">居住地</span>
            </label>
            <input type="text" name="居住地" value="" size="8">
            <label>
              <input type="checkbox" name="checkbox[]" class="checkbox-sqar">
              <span class="checkbox-txt text_right">確認あり</span>
            </label>
            <label>
              <input type="checkbox" name="checkbox[]" class="checkbox-sqar">
              <span class="checkbox-txt text_right">同一人物あり</span>
            </label>
            <label>
              <input type="checkbox" name="checkbox[]" class="checkbox-sqar">
              <span class="checkbox-txt">その他</span>
            </label>
            <input type="text" name="その他" value="" size="20"><br>
          </div>
        </div>

        <!--右下サイドここから-->
        <div class="date_right_btm_col">
          <!--所属店舗-->
          <div class="white_box input_right SSmall">
            <p>所属店舗</p>
            <div class="select_arrow">
              <select name="所属店舗">
                <option value="">—</option>
                <?php foreach ($workshop as $key => $value): ?>
                <option value=""><?php echo $value; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <!--源氏名-->
          <div class="white_box input_right">
            <p>源氏名</p>
            <input type="text" name="源氏名" value="" size="20">
          </div>
          <!--画像アップロード-->
          <div class="white_box input_right">
            <div id="img_selectFile">
              <input id="img_upload" type="file" style="display:none">
              <button class="photo_input_img">画像アップロード</button>
            </div>
          </div>
          <!-- 退店日-->
          <div class="white_box input_right XMedium clear">
            <p>退店日<span class="required3">※必須</span></p>
            <div class="select_arrow select_input_y">
              <select id="required3" name="退店年" class="">
                <option value="0">—</option>
                <?php for ($i=2013; $i < 2025; $i++) : ?>
                <option value="<?php echo $i;?>"><?php echo $i; ?></option>
                <?php endfor; ?>
              </select>
            </div>
            <span class="select_ymd_txt">年</span>
            <div class="select_arrow select_input_md">
              <select name="退店月">
                <option value="">—</option>
                <?php for ($i=1; $i <= 12; $i++) : ?>
                <option value="<?php echo $i;?>"><?php echo $i; ?></option>
                <?php endfor; ?>
              </select>
            </div>
            <span class="select_ymd_txt">月</span>
            <div class="select_arrow select_input_md">
              <select name="退店日">
                <option value="">—</option>
                <?php for ($i=1; $i <= 31; $i++) : ?>
                <option value="<?php echo $i;?>"><?php echo $i; ?></option>
                <?php endfor; ?>
              </select>
            </div>
            <span class="select_ymd_txt">日</span>
          </div>
          <!--退店理由-->
          <div class="white_box input_right SSSmall">
            <p>退店理由</p>
            <div id="closed_reason" class="select_arrow">
              <select name="closed_reason">
                <option value="0">—</option>
                <option value="1">音信不通</option>
                <option value="2">目標達成</option>
                <option value="3">就職</option>
                <option value="4">結婚</option>
                <option value="5">稼げない</option>
                <option value="6">身バレ</option>
              </select>
            </div>
          </div>
          <!--姓名-->
          <div class="white_box input_right SSSmall clear">
            <p>姓</p>
            <input type="text" name="姓" size="16">
          </div>
          <div class="white_box input_right SSSmall">
            <p>名</p>
            <input type="text" name="名" size="16">
          </div>
          <!--ふりがな-->
          <div class="white_box input_right SSSmall">
            <p>姓（ふりがな）</p>
            <input type="text" pattern="^[ぁ-ん]+$" title="全角ひらがなでご入力ください。" name="姓（ふりがな）" size="16">
          </div>
          <div class="white_box input_right SSSmall">
            <p>名（ふりがな）</p>
            <input type="text" pattern="^[ぁ-ん]+$" title="全角ひらがなでご入力ください。" name="名（ふりがな）" size="16">
          </div>
          <!--住所-->
          <div class="white_box input_right LLarge clear">
            <p>住所</p>
            <div class="select_arrow select_address">
              <select name="住所">
                <option value="">—</option>
                <optgroup label="北海道">
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
            <input type="text" name="住所" value="" size="60">
          </div>
          <!--面接結果-->
          <div class="white_box input_right SSSmall clear">
            <p>面接結果</p>
            <div class="select_arrow">
              <select name="面接結果">
                <option value="">—</option>
                <option value="採用">採用</option>
                <option value="不採用">不採用</option>
                <option value="撃沈">撃沈</option>
                <option value="他店紹介不採用">他店紹介（不採用）</option>
                <option value="他店紹介撃沈">他店紹介（撃沈）</option>
              </select>
            </div>
          </div>
          <!--面接担当-->
          <div class="white_box input_right SSmall">
            <p>面接担当</p>
            <div class="select_arrow">
              <select name="面接担当">
                <option value="">—</option>
                <?php foreach ($staffname as $key => $value): ?>
                <option value=""><?php echo $value; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <!--面接担当（サブ）-->
          <div class="white_box input_right SSmall">
            <p>面接担当（サブ）</p>
            <div class="select_arrow">
              <select name="面接担当（サブ）">
                <option value="">—</option>
                <?php foreach ($staffname as $key => $value): ?>
                <option value=""><?php echo $value; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <!--KS担当-->
          <div class="white_box input_right SSmall">
            <p>KS担当</p>
            <div class="select_arrow">
              <select name="KS担当">
                <option value="">—</option>
                <?php foreach ($staffname as $key => $value): ?>
                <option value=""><?php echo $value; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <!--勤務形態-->
          <div class="white_box input_right SSmall clear">
            <p>勤務形態</p>
            <div class="select_arrow">
              <select name="勤務形態">
                <option value="">—</option>
                <option value="早番">早番</option>
                <option value="中番">中番</option>
                <option value="遅番">遅番</option>
                <option value="深夜">深夜</option>
              </select>
            </div>
          </div>
          <!--本人確認-->
          <div class="white_box input_right SSmall">
            <p>身分証</p>
            <div class="select_arrow">
              <select name="身分証">
                <option value="">—</option>
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
              </select>
            </div>
          </div>
          <!--備考欄（本人確認用）-->
          <div class="white_box input_right Small">
            <p>身分証備考</p>
            <input type="text" name="身分証備考" size="24">
          </div>
          <!--給料-->
          <div class="white_box input_right SSmall clear">
            <p>給料</p>
            <input type="text" pattern="^¥d+$" title="半角数字でご入力ください。" name="給料" size="8">
            <span class="select_other_txt">円</span>
          </div>
          <!--特別指名料-->
          <div class="white_box input_right SSmall">
            <p>特別指名料</p>
            <input type="text" pattern="^¥d+$" title="半角数字でご入力ください。" name="特別指名料" size="8">
            <span class="select_other_txt">円</span>
          </div>
          <!--他店紹介-->
          <div class="white_box input_right">
            <p>他店紹介</p>
            <div class="select_arrow">
              <select name="他店紹介">
                <option value="">—</option>
                <option value="激安グループ">激安グループ</option>
                <option value="スパークグループ">スパークグループ</option>
                <option value="珍太郎">珍太郎</option>
                <option value="奥様日記">奥様日記</option>
                <option value="センスプロモーション">センスプロモーション</option>
              </select>
            </div>
          </div>
          <!--備考（他店紹介用）-->
          <div class="white_box input_right XSMedium">
            <p>他店紹介備考</p>
            <input type="text" name="他店紹介備考" size="36">
          </div>
          <!--検索ワード-->
          <div class="input_right clear">
            <p>検索ワード</p>

            <div class="word_col">
              <div class="word_number">1</div>
              <div class="select_arrow select_word">
                <select name="検索ワード" style="width:150px;">
                  <option value="">—</option>
                  <option value="未経験">未経験</option>
                  <option value="デリヘル">デリヘル</option>
                  <option value="オナクラ">オナクラ</option>
                  <option value="大阪">大阪</option>
                  <option value="風俗">風俗</option>
                  <option value="高収入">高収入</option>
                  <option value="アルバイト">アルバイト</option>
                </select>
              </div>
            </div>

            <div class="word_col">
              <div class="word_number">2</div>
              <div class="select_arrow select_word">
                <select name="検索ワード" style="width:150px;">
                  <option value="">—</option>
                  <option value="未経験">未経験</option>
                  <option value="デリヘル">デリヘル</option>
                  <option value="オナクラ">オナクラ</option>
                  <option value="大阪">大阪</option>
                  <option value="風俗">風俗</option>
                  <option value="高収入">高収入</option>
                  <option value="アルバイト">アルバイト</option>
                </select>
              </div>
            </div>

            <div class="word_col">
              <div class="word_number">3</div>
              <div class="select_arrow select_word">
                <select name="検索ワード" style="width:150px;">
                  <option value="">—</option>
                  <option value="未経験">未経験</option>
                  <option value="デリヘル">デリヘル</option>
                  <option value="オナクラ">オナクラ</option>
                  <option value="大阪">大阪</option>
                  <option value="風俗">風俗</option>
                  <option value="高収入">高収入</option>
                  <option value="アルバイト">アルバイト</option>
                </select>
              </div>
            </div>

            <div class="word_col">
              <div class="word_number">4</div>
              <div class="select_arrow select_word">
                <select name="検索ワード" style="width:150px;">
                  <option value="">—</option>
                  <option value="未経験">未経験</option>
                  <option value="デリヘル">デリヘル</option>
                  <option value="オナクラ">オナクラ</option>
                  <option value="大阪">大阪</option>
                  <option value="風俗">風俗</option>
                  <option value="高収入">高収入</option>
                  <option value="アルバイト">アルバイト</option>
                </select>
              </div>
            </div>

            <div class="word_col">
              <div class="word_number">5</div>
              <div class="select_arrow select_word">
                <select name="検索ワード" style="width:150px;">
                  <option value="">—</option>
                  <option value="未経験">未経験</option>
                  <option value="デリヘル">デリヘル</option>
                  <option value="オナクラ">オナクラ</option>
                  <option value="大阪">大阪</option>
                  <option value="風俗">風俗</option>
                  <option value="高収入">高収入</option>
                  <option value="アルバイト">アルバイト</option>
                </select>
              </div>
            </div>
          </div>

          <!--備考（検索ワード）-->
          <div class="white_box input_right XSMedium">
            <p>検索ワード備考</p>
            <input type="text" name="検索ワード備考" size="30">
          </div>
          <!--チェック-->
          <div class="white_box input_check2 clear">
            <div class="checkbox2">
              <label>
                <input type="checkbox" name="checkbox2[]" class="checkbox-sqar">
                <span class="checkbox-txt text_right">ニコイチ</span>
              </label>
              <label>
                <input type="checkbox" name="checkbox2[]" class="checkbox-sqar">
                <span class="checkbox-txt text_right">出稼ぎ</span>
              </label>
              <label>
                <input type="checkbox" name="checkbox2[]" class="checkbox-sqar">
                <span class="checkbox-txt">スカウトメールからの申し込み</span>
              </label>
            </div>
          </div>
          <!--備考-->
          <div class="white_box input_left">
            <div class="right_absl">
              <!--初回出勤日-->
              <div class="white_box input_absl">
                <p class="inline">初回出勤日</p>
                <div class="select_arrow select_absl_y">
                  <select name="初回出勤年">
                    <option value="">—</option>
                    <?php for ($i=2013; $i < 2025; $i++) : ?>
                    <option value="<?php echo $i;?>"><?php echo $i; ?></option>
                    <?php endfor; ?>
                  </select>
                </div>
                <span class="select_ymd_txt">年</span>
                <div class="select_arrow select_absl_md">
                  <select name="初回出勤月">
                    <option value="">—</option>
                    <?php for ($i=1; $i <= 12; $i++) : ?>
                    <option value="<?php echo $i;?>"><?php echo $i; ?></option>
                    <?php endfor; ?>
                  </select>
                </div>
                <span class="select_ymd_txt">月</span>
                <div class="select_arrow select_absl_md">
                  <select name="初回出勤日">
                    <option value="">—</option>
                    <?php for ($i=1; $i <= 31; $i++) : ?>
                    <option value="<?php echo $i;?>"><?php echo $i; ?></option>
                    <?php endfor; ?>
                  </select>
                </div>
                <span class="select_ymd_txt">日</span>
              </div>
              <div class="checkbox3">
                <label>
                  <input type="checkbox" name="checkbox3" class="checkbox-sqar">
                  <span class="checkbox-txt text_right">未定</span>
                </label>
              </div>
            </div><!--/right_absl-->
            <p>備考</p>
            <textarea type="text" name="備考" rows="10" class="input_bikou"></textarea>
          </div>
          <!--追跡理由-->
          <div class="white_box input_right SSmall clear">
            <p>追跡理由</p>
            <div id="slectReset" class="select_arrow">
              <select name="追跡理由">
                <option value="0">—</option>
                <option value="保留">保留</option>
                <option value="変更中">変更中</option>
                <option value="キャンセル">キャンセル</option>
                <option value="ブッチ">ブッチ</option>
                <option value="2日前確認">2日前確認</option>
              </select>
            </div>
          </div>
          <!-- 追跡予定日-->
          <div class="white_box input_right XMedium">
            <p>追跡予定日</p>
            <div id="slectReset" class="select_arrow select_input_y">
              <select name="追跡予定年">
                <option value="0">—</option>
                <?php for ($i=2013; $i < 2025; $i++) : ?>
                <option value="<?php echo $i;?>"><?php echo $i; ?></option>
                <?php endfor; ?>
              </select>
            </div>
            <span class="select_ymd_txt">年</span>
            <div id="slectReset" class="select_arrow select_input_md">
              <select name="追跡予定月">
                <option value="0">—</option>
                <?php for ($i=1; $i <= 12; $i++) : ?>
                <option value="<?php echo $i;?>"><?php echo $i; ?></option>
                <?php endfor; ?>
              </select>
            </div>
            <span class="select_ymd_txt">月</span>
            <div id="slectReset" class="select_arrow select_input_md">
              <select name="追跡予定日">
                <option value="0">—</option>
                <?php for ($i=1; $i <= 31; $i++) : ?>
                <option value="<?php echo $i;?>"><?php echo $i; ?></option>
                <?php endfor; ?>
              </select>
            </div>
            <span class="select_ymd_txt">日</span>
          </div>
          <!--追跡中止-->
          <div class="white_box input_how">
            <div class="checkbox4">
              <label>
                <input id="checkReset" type="checkbox" name="checkbox4" class="checkbox-sqar">
                <span class="checkbox-txt text_right">追跡中止</span>
              </label>
            </div>
          </div>
          <!--追跡備考-->
          <div class="white_box input_left">
            <p>追跡備考</p>
            <div class="remark_box">
              <span class="select_ymd_txt">日付</span>
              <div class="select_arrow select_remark_y">
                <select name="追跡備考年">
                  <option value="">—</option>
                  <?php for ($i=2013; $i < 2025; $i++) : ?>
                  <option value="<?php echo $i;?>"><?php echo $i; ?></option>
                  <?php endfor; ?>
                </select>
              </div>
              <span class="select_ymd_txt">年</span>
              <div class="select_arrow select_remark_md">
                <select name="追跡備考月">
                  <option value="">—</option>
                  <?php for ($i=1; $i <= 12; $i++) : ?>
                  <option value="<?php echo $i;?>"><?php echo $i; ?></option>
                  <?php endfor; ?>
                </select>
              </div>
              <span class="select_ymd_txt">月</span>
              <div class="select_arrow select_remark_md">
                <select name="追跡備考日">
                  <option value="">—</option>
                  <?php for ($i=1; $i <= 31; $i++) : ?>
                  <option value="<?php echo $i;?>"><?php echo $i; ?></option>
                  <?php endfor; ?>
                </select>
              </div>
              <span class="select_ymd_txt">日</span>
              <span class="select_other_txt">担当</span>
              <input type="text" name="担当" size="10">
              <span class="select_other_txt">経過</span>
              <input type="text" name="経過" size="35">
            </div>
            <div class="remark_box">
              <span class="select_ymd_txt">日付</span>
              <div class="select_arrow select_remark_y">
                <select name="追跡備考年">
                  <option value="">—</option>
                  <?php for ($i=2013; $i < 2025; $i++) : ?>
                  <option value="<?php echo $i;?>"><?php echo $i; ?></option>
                  <?php endfor; ?>
                </select>
              </div>
              <span class="select_ymd_txt">年</span>
              <div class="select_arrow select_remark_md">
                <select name="追跡備考月">
                  <option value="">—</option>
                  <?php for ($i=1; $i <= 12; $i++) : ?>
                  <option value="<?php echo $i;?>"><?php echo $i; ?></option>
                  <?php endfor; ?>
                </select>
              </div>
              <span class="select_ymd_txt">月</span>
              <div class="select_arrow select_remark_md">
                <select name="追跡備考日">
                  <option value="">—</option>
                  <?php for ($i=1; $i <= 31; $i++) : ?>
                  <option value="<?php echo $i;?>"><?php echo $i; ?></option>
                  <?php endfor; ?>
                </select>
              </div>
              <span class="select_ymd_txt">日</span>
              <span class="select_other_txt">担当</span>
              <input type="text" name="担当" size="10">
              <span class="select_other_txt">経過</span>
              <input type="text" name="経過" size="35">
            </div>
          </div>
          <div class="confirm_btn">
            <button id="btn_id2" form="form" type="submit" class="btn_orange">確定</button>
          </div>
        </div><!--/date_right_btm_col-->
        <!--確定ボタン-->

      </div><!--/date_right_col-->
    </div><!-- /date_info_inner-->
  </form><!-- /data_form -->

  <!-- /履歴部分 -->
  <?php include('common/history.php'); ?>
  <!-- /履歴部分 -->
  <?php include('common/history2.php'); ?>

</section>

</main>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="js/jquery.multiple.select.js"></script>
<script>
  //確定・更新ボタンの条件分岐
  $(function(){
    $('#btn_id').click(function(){
        var val = $('.reqSelect').val();
        var val2 = $('.reqSelect2').val();
        var val3 = $('.reqSelect3').val();
        var val4 = $('.input_req').val();
        var val13 = $('.reqSelect12').val();
      if( val == 0 ||  val2 == 0 || val3 == 0 || val4 == '' || val13 == 0) {

        swal('水色の必須部分を入力してください');
        return false;
      }
    });
  });

$(function(){
    $('#btn_id2').click(function(){
        var val4 = $('.reqSelect4').val();
        var val5 = $('.reqSelect5').val();
        var val6 = $('.reqSelect6').val();
        var val7 = $('.reqSelect7').val();
        var val8 = $('.reqSelect8').val();
        var val9 = $('.reqSelect9').val();
        var val10 = $('.reqSelect10').val();
        var val11 = $('.reqSelect11').val();
        var val12 = $('.input_req2').val();
        var val13 = $('.reqSelect12').val();
      if( val4 == 0 || val5 == 0 || val6 == 0 || val7 == 0
        || val8 == 0 || val9 == 0  || val10 == 0
        || val11 == 0 || val12== '' || val13 == 0) {

        swal('全ての必須部分を入力してください');
        return false;
      }
    });
  });

   //退店日必須
  $(function() {
    $('#closed_reason select').change(function(){
    　　var closedReason = $(this).val();
      if (closedReason == 0) {
          $('.required3').hide();
          $('select#required3').removeClass("reqSelect12");
      } else {
        $('.required3').show();
        $('select#required3').attr("class", "reqSelect12");
      }
    });
  });
  
    //データ消去アラート
  $('#button').on('click', function() {
    swal('本当に消去しますか？');
        return false;
  });

  //select 複数選択
  $(function() {
    var $selects = $('[id=select_word]');
    $selects.multipleSelect();
  });

  //画像アップロード

  $('#img_selectFile').on('click', 'button', function () {
  $('#img_upload').click();
    return false;
  });

  $('#img_upload').on('change', function() {
    var file = $(this).prop('files')[0];
    if(!($('.filename').length)){
        $('#img_selectFile').append('<div class="filename"></div>');
    };
    $('.filename').html('ファイル名：' + file.name);
  });
  //drawer
$(function() {
  $('.drawer').drawer();
});
</script>
<?php include('common/footer.php'); ?>
