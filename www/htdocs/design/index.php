<?php include('common/resource.php'); ?>
<title>採用通知</title>
<?php include('common/header.php'); ?>
<?php include('common/array.php'); ?>


  <article>
    <section class="top_content_wrap">

    </section>
      <div class="girl_search_col container">
        <!-- 面接日-->
        <div class="white_box MMedium col_border mg_bottom10">
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
        <div class="white_box XSmall col_border mg_bottom10">
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
        <div class="white_box SSmall col_border mg_bottom10">
          <p>面接担当</p>
          <div class="select_arrow select_staff">
            <select id="select_staff" name="面接担当" style="width:150px;">
              <optgroup label="全て選択">
                <?php foreach ($staffname as $key => $value): ?>
                  <option value=""><?php echo $value; ?></option>
                <?php endforeach; ?>
              </optgroup>
            </select>
          </div>
        </div>
        <!-- 源氏名-->
        <div class="white_box SSSmall col_border mg_bottom10">
          <p>源氏名</p>
          <input type="text" name="源氏名" value="" size="22">
        </div>
        <!-- 源氏名（ふりがな）-->
        <div class="white_box SSSmall col_border mg_bottom10">
          <p>源氏名（ふりがな）</p>
          <input type="text" name="源氏ふりがな" value="" size="22">
        </div>

        <!--所属店舗-->
        <div class="white_box SSSmall col_border mg_bottom10">
          <p>所属店舗</p>
          <div class="select_arrow select_medium">
            <select  id="select_shozoku" name="所属店舗" style="width:200px;">
              <optgroup label="全て選択">
                <?php foreach ($workshop as $key => $value): ?>
                <option value=""><?php echo $value; ?></option>
                <?php endforeach; ?>
              </select>
            </optgroup>
          </div>
        </div>
        <!-- 名前-->
        <div class="white_box indexname col_border mg_bottom10 clear">
          <p>名前</p>
          <span class="search_select_txt">姓</span><input type="text" name="名前姓" value="" size="18">
          <span class="search_select_txt space">名</span><input type="text" name="名前名" value="" size="18">
        </div>
        <div class="white_box indexname col_border mg_bottom10">
          <p>名前（ふりがな）</p>
          <span class="search_select_txt">姓</span><input type="text" name="名前ふりがな姓" value="" size="18">
          <span class="search_select_txt space">名</span><input type="text" name="名前ふりがな名" value="" size="18">
        </div>
        <!--店舗スタッフ-->
        <div class="white_box SSSmall col_border mg_bottom10">
          <div class="checkbox_serch">
            <label>
              <input type="checkbox" name="checkbox[]" class="checkbox_serch-sqar">
              <span class="checkbox_serch-txt">出稼ぎ</span>
            </label>
            <label>
              <input type="checkbox" name="checkbox[]" class="checkbox_serch-sqar">
              <span class="checkbox_serch-txt">ニコイチ</span>
            </label>
          </div>
        </div>
        <!-- 退店日-->
        <div class="white_box MMedium col_border mg_bottom10">
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
        <!--スカウト-->
        <div class="white_box SSmall col_border mg_bottom10">
          <p>スカウト</p>
          <div class="select_arrow select_scout">
            <select id="select_scout" name="スカウト" style="width: 140px;">
              <optgroup label="全て選択">
                <?php for ($i=0; $i <= 100; $i++) : ?>
                <option value="<?php echo $i;?>"><?php echo $i; ?></option>
                <?php endfor; ?>
              </optgroup>
            </select>
          </div>
        </div>
        <!--出戻り・移籍・紹介-->
        <div class="white_box SSSmall col_border mg_bottom10">
          <p>出戻り・移籍・紹介</p>
          <div class="select_arrow select_move">
            <select id="select_move"　name="出戻り" style="width:190px;">
              <optgroup label="全て選択">
                <option value="出戻り">出戻り</option>
                <option value="移籍">移籍</option>
                <option value="紹介">紹介</option>
              </optgroup>
            </select>
          </div>
        </div>
        <button type="submit" class="btn_orange kensaku">
          <a href="#">検索</a>
        </button>
      </div>
    </section>

    <section>
      <div class="girl_info_col container">
        <h1>No.100</h1>

        <div class="left_col">
          <ul class="btn_list_1">
            <li><a href="input.php">編集</a></li>
            <!-- <li><a href="#">採用情報に送信</a></li> -->
            <li><a href="#">消去</a></li>
          </ul>
          <ul class="btn_list_2">
            <li><a href="#">スカウトメールに追加する</a></li>
            <!-- <li><a href="#">追跡日時設定</a></li>-->
          </ul>

          <div class="girls_info_img">
          <img src="img/pic_girl_sample.jpg">
          </div>

        </div>

        <div class="right_col">

          <div class="girl_info_item_wrap">
            <div class="girl_info_item_1">申込日<span>2018年05月26日</span></div>
            <div class="girl_info_item_1">申込時間<span>21:05</span></div>
            <div class="girl_info_item_1">申込名<span>ゆかりん</span></div>
          </div>

          <div class="girl_info_item_wrap mg_bottom50">
            <div class="girl_info_item_1">面接予定時間<span>21:05</span></div>
            <div class="girl_info_item_1">面接店舗<span>梅田</span></div>
            <div class="girl_info_item_1">待ち合わせ場所<span>泉の広場</span></div>
          </div>

          <div class="girl_info_item_wrap">
            <div class="girl_info_item_1">面接日<span>2018年05月86日</span></div>
            <div class="girl_info_item_1">面接結果<span>採用</span></div>
            <div class="girl_info_item_1">面接担当<span>ニンニン</span></div>
            <div class="girl_info_item_1">面接サブ<span>かまちゃん</span></div>
            <div class="girl_info_item_1">KS担当<span>ゴリさん</span></div>
          </div>

          <div class="girl_info_item_wrap">
            <div class="girl_info_item_1">所属店舗<span>スピード難波</span></div>
            <div class="girl_info_item_1">源氏名<span>ゆかり</span></div>
            <div class="girl_info_item_1">給料<span>10000</span>円</div>
            <div class="girl_info_item_1">特別指名<span>10000</span>円</div>
            <div class="girl_info_item_1">勤務形態<span>深夜</span></div>
          </div>

          <div class="girl_info_item_wrap">
            <div class="girl_info_item_1">名前<span>岡山　由香里（おかやま　ゆかり）</span></div>
            <div class="girl_info_item_1">年齢<span>28</span></div>
            <div class="girl_info_item_1">住所<span>徳島県板野郡上板町神宅字梅ノ木25-3</span></div>
          </div>

          <div class="girl_info_item_wrap">

            <div class="girl_info_item_1">身長<span>000</span>cm</div>
            <div class="girl_info_item_1">体重<span>000</span>kg</div>
            <div class="girl_info_item_1">バスト<span>000</span>cm<span>C</span>cup</div>
            <div class="girl_info_item_1">ウエスト<span>000</span>cm</div>
            <div class="girl_info_item_1">ヒップ<span>000</span>cm</div>
          </div>

          <div class="girl_info_item_wrap">
            <div class="girl_info_item_1">TEL<span>090</span><span>0000</span><span>0000</span></div>
            <div class="girl_info_item_1">Mail<span>iokimnhtlokmo</span>@<span>i.softbank.jp</span></div>
          </div>

          <div class="girl_info_item_wrap">
            <div class="girl_info_item_1">経験<span>ホテヘル</span><span>デリヘル</span><span>オナクラ</span><span>ピンサロ</span><span>性感エステ</span></div>
            <div class="girl_info_item_1">経験備考<span>体験入店のみ</span></div>
          </div>

          <div class="girl_info_item_wrap">
            <div class="girl_info_item_1">身分証<span>免許証</span><span>住民票</span><span>パスポート</span></div>
            <div class="girl_info_item_1">身分証備考<span>学生証がないため</span></div>
          </div>

          <div class="girl_info_item_wrap">
            <div class="girl_info_item_1">掲載媒体<span>ガールズヘブン</span></div>
            <div class="girl_info_item_1">掲載求人<span>キャミソール</span></div>
            <div class="girl_info_item_1">掲載業種<span>オナクラ</span></div>
          </div>

          <div class="girl_info_item_wrap">
            <div class="girl_info_item_1">スカウト<span>4</span></div>
            <div class="girl_info_item_1">出戻り・移籍<span>出戻り</span></div>
          </div>

          <div class="girl_info_item_wrap">
            <div class="girl_info_item_1">検索ワード<span>大阪</span><span>オナクラ</span><span>高収入</span><span>バイト</span><span>風俗</span></div>
            <div class="girl_info_item_1">検索ワード備考<span>姉が働いていた</span></div>
          </div>

          <div class="girl_info_item_wrap">
            <div class="girl_info_item_1 radio_item"><img src="img/btn_radio.png" width="18"><span>出稼ぎ</span></div>
            <div class="girl_info_item_1 radio_item"><img src="img/btn_radio_active.png" width="18"><span>ニコイチ</span></div>
            <div class="girl_info_item_1 radio_item"><img src="img/btn_radio_active.png" width="18"><span>スカウトメールからの申込</span></div>
          </div>

          <div class="girl_info_item_wrap">
            <div class="girl_info_item_1">他店紹介<span>スパークグループ</span></div>
            <div class="girl_info_item_1">他店紹介備考<span>ぷるるん小町梅田</span></div>
          </div>

          <div class="girl_info_item_wrap">
            <div class="girl_info_item_1">退店日<span>2018年12月5日</span></div>
            <div class="girl_info_item_1">退店理由<span>音信不通</span></div>
          </div>


        </div><!-- /right_col -->

        <div class="bottom_col">
          <div class="girl_info_item_wrap">
            <div class="girl_info_day">初回出勤日　<span>2018年2月12日</span></div>
          </div>
          <div class="girl_info_item_2">備考</div>
          <div class="girl_info_item_3">
            出張エステ・デリヘルで数日間だけ経験があります。<br>
            デリヘルで本強があり、ヘルスより安全と思うオナクラで探していたそうです。<br>
            オナクラはダミー求人だと説明し、プレイ内容も問題なく入店となりました。<br>
            さらに受付型の店舗であることや会員証のシステムを説明して、出張型よりも安心して働いてもらえる環境をアピールしました。<br>
            大阪・京都に来ることが多く、近いうちに大阪に住みたいそうなので、継続して働いてもらえるようにします。
          </div>

          <!-- <div class="girl_info_item_5"></div> -->
        </div>

      </div>
    </section>



    <section>
      <div class="girl_info_col container">
        <h1>No.100</h1>

        <div class="left_col">
          <ul class="btn_list_1">
            <li><a href="input.php">編集</a></li>
            <!-- <li><a href="#">採用情報に送信</a></li> -->
            <li><a href="#">消去</a></li>
          </ul>
          <ul class="btn_list_2">
            <li><a href="#">スカウトメールに追加する</a></li>
            <!-- <li><a href="#">追跡日時設定</a></li>-->
          </ul>

          <div class="girls_info_img">
          <img src="img/pic_girl_sample.jpg">
          </div>

        </div>

        <div class="right_col">

          <div class="girl_info_item_wrap">
            <div class="girl_info_item_1">申込日<span>2018年05月26日</span></div>
            <div class="girl_info_item_1">申込時間<span>21:05</span></div>
            <div class="girl_info_item_1">申込名<span>ゆかりん</span></div>
          </div>

          <div class="girl_info_item_wrap mg_bottom50">
            <div class="girl_info_item_1">面接予定時間<span>21:05</span></div>
            <div class="girl_info_item_1">面接店舗<span>梅田</span></div>
            <div class="girl_info_item_1">待ち合わせ場所<span>泉の広場</span></div>
          </div>

          <div class="girl_info_item_wrap">
            <div class="girl_info_item_1">面接日<span>2018年05月86日</span></div>
            <div class="girl_info_item_1">面接結果<span>採用</span></div>
            <div class="girl_info_item_1">面接担当<span>ニンニン</span></div>
            <div class="girl_info_item_1">面接サブ<span>かまちゃん</span></div>
            <div class="girl_info_item_1">KS担当<span>ゴリさん</span></div>
          </div>

          <div class="girl_info_item_wrap">
            <div class="girl_info_item_1">所属店舗<span>スピード難波</span></div>
            <div class="girl_info_item_1">源氏名<span>ゆかり</span></div>
            <div class="girl_info_item_1">給料<span>10000</span>円</div>
            <div class="girl_info_item_1">特別指名<span>10000</span>円</div>
            <div class="girl_info_item_1">勤務形態<span>深夜</span></div>
          </div>

          <div class="girl_info_item_wrap">
            <div class="girl_info_item_1">名前<span>岡山　由香里（おかやま　ゆかり）</span></div>
            <div class="girl_info_item_1">年齢<span>28</span></div>
            <div class="girl_info_item_1">住所<span>徳島県板野郡上板町神宅字梅ノ木25-3</span></div>
          </div>

          <div class="girl_info_item_wrap">

            <div class="girl_info_item_1">身長<span>000</span>cm</div>
            <div class="girl_info_item_1">体重<span>000</span>kg</div>
            <div class="girl_info_item_1">バスト<span>000</span>cm<span>C</span>cup</div>
            <div class="girl_info_item_1">ウエスト<span>000</span>cm</div>
            <div class="girl_info_item_1">ヒップ<span>000</span>cm</div>
          </div>

          <div class="girl_info_item_wrap">
            <div class="girl_info_item_1">TEL<span>090</span><span>0000</span><span>0000</span></div>
            <div class="girl_info_item_1">Mail<span>iokimnhtlokmo</span>@<span>i.softbank.jp</span></div>
          </div>

          <div class="girl_info_item_wrap">
            <div class="girl_info_item_1">経験<span>ホテヘル</span><span>デリヘル</span><span>オナクラ</span><span>ピンサロ</span><span>性感エステ</span></div>
            <div class="girl_info_item_1">経験備考<span>体験入店のみ</span></div>
          </div>

          <div class="girl_info_item_wrap">
            <div class="girl_info_item_1">身分証<span>免許証</span><span>住民票</span><span>パスポート</span></div>
            <div class="girl_info_item_1">身分証備考<span>学生証がないため</span></div>
          </div>

          <div class="girl_info_item_wrap">
            <div class="girl_info_item_1">掲載媒体<span>ガールズヘブン</span></div>
            <div class="girl_info_item_1">掲載求人<span>キャミソール</span></div>
            <div class="girl_info_item_1">掲載業種<span>オナクラ</span></div>
          </div>

          <div class="girl_info_item_wrap">
            <div class="girl_info_item_1">スカウト<span>4</span></div>
            <div class="girl_info_item_1">出戻り・移籍<span>出戻り</span></div>
          </div>

          <div class="girl_info_item_wrap">
            <div class="girl_info_item_1">検索ワード<span>大阪</span><span>オナクラ</span><span>高収入</span><span>バイト</span><span>風俗</span></div>
            <div class="girl_info_item_1">検索ワード備考<span>姉が働いていた</span></div>
          </div>

          <div class="girl_info_item_wrap">
            <div class="girl_info_item_1 radio_item"><img src="img/btn_radio.png" width="18"><span>出稼ぎ</span></div>
            <div class="girl_info_item_1 radio_item"><img src="img/btn_radio_active.png" width="18"><span>ニコイチ</span></div>
            <div class="girl_info_item_1 radio_item"><img src="img/btn_radio_active.png" width="18"><span>スカウトメールからの申込</span></div>
          </div>

          <div class="girl_info_item_wrap">
            <div class="girl_info_item_1">他店紹介<span>スパークグループ</span></div>
            <div class="girl_info_item_1">他店紹介備考<span>ぷるるん小町梅田</span></div>
          </div>

          <div class="girl_info_item_wrap">
            <div class="girl_info_item_1">退店日<span>2018年12月5日</span></div>
            <div class="girl_info_item_1">退店理由<span>音信不通</span></div>
          </div>


        </div><!-- /right_col -->

        <div class="bottom_col">
          <div class="girl_info_item_wrap">
            <div class="girl_info_day">初回出勤日　<span>2018年2月12日</span></div>
          </div>
          <div class="girl_info_item_2">備考</div>
          <div class="girl_info_item_3">
            出張エステ・デリヘルで数日間だけ経験があります。<br>
            デリヘルで本強があり、ヘルスより安全と思うオナクラで探していたそうです。<br>
            オナクラはダミー求人だと説明し、プレイ内容も問題なく入店となりました。<br>
            さらに受付型の店舗であることや会員証のシステムを説明して、出張型よりも安心して働いてもらえる環境をアピールしました。<br>
            大阪・京都に来ることが多く、近いうちに大阪に住みたいそうなので、継続して働いてもらえるようにします。
          </div>

          <!-- <div class="girl_info_item_5"></div> -->
        </div>

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
