{include file=$smarty.const.ADMIN_HEADER}

<article id="search" class="container">
    <section class="top_content_wrap">

    </section>
    {*<form action="/search/result/" method="get">*}
    <form action="/search/result/" method="post">
    <section class="search_info_col">
        <h1 class="breadcrumb">&gt;&nbsp;検索条件</h1>
        <!--検索ボタン-->
        <div class="search_btn">
            <button type="submit" class="btn_orange" name="search" value="1">検索</button>
        </div>
        <!-- ID -->
        <div class="white_search_box">
            <p>ID</p>
            {$forms.search_id.html}
        </div>
        <div class="grid__wrapper">
        <!-- 申込日-->
        <div class="white_search_box">
            <p>申込日</p>
            <div class="select_arrow select_y">
                {$forms.submission_year_from.html}
            </div>
            <span class="select_ymd_txt">年</span>

            <div class="select_arrow select_md">
                {$forms.submission_month_from.html}
            </div>
            <span class="select_ymd_txt">月</span>

            <div class="select_arrow select_md">
                {$forms.submission_day_from.html}
            </div>
            <span class="select_ymd_txt">日&nbsp;～&nbsp;</span>
            <div class="select_arrow select_y">
                {$forms.submission_year_to.html}
            </div>
            <span class="select_ymd_txt">年</span>

            <div class="select_arrow select_md">
                {$forms.submission_month_to.html}
            </div>
            <span class="select_ymd_txt">月</span>

            <div class="select_arrow select_md">
                {$forms.submission_day_to.html}
            </div>
            <span class="select_ymd_txt">日&nbsp;迄</span>
        </div>
        <!-- 申込時間-->
        <div class="white_search_box">
            <p>申込時間</p>
            <div class="select_arrow select_h">
                {$forms.submission_hour_from.html}
            </div>
            <span class="select_ymd_txt">時&nbsp;～&nbsp;</span>
            <div class="select_arrow select_h">
                {$forms.submission_hour_to.html}
            </div>
            <span class="select_ymd_txt">時&nbsp;迄</span>
        </div>
        <!-- 申込名-->
        <div class="white_search_box">
            <p>申込名</p>
            {$forms.submission_name.html}
        </div>
        <!-- 面接日-->
        <div class="white_search_box">
            <p>面接日</p>
            <div class="select_arrow select_y">
                {$forms.interview_year_from.html}
            </div>
            <span class="select_ymd_txt">年</span>
            <div class="select_arrow select_md">
                {$forms.interview_month_from.html}
            </div>
            <span class="select_ymd_txt">月</span>
            <div class="select_arrow select_md">
                {$forms.interview_day_from.html}
            </div>
            <span class="select_ymd_txt">日&nbsp;～&nbsp;</span>
            <div class="select_arrow select_y">
                {$forms.interview_year_to.html}
            </div>
            <span class="select_ymd_txt">年</span>
            <div class="select_arrow select_md">
                {$forms.interview_month_to.html}
            </div>
            <span class="select_ymd_txt">月</span>
            <div class="select_arrow select_md">
                {$forms.interview_day_to.html}
            </div>
            <span class="select_ymd_txt">日&nbsp;迄</span>
        </div>

        <!--面接店舗-->
        <div class="white_search_box">
            <p>面接店舗</p>
            <div class="select_arrow">
                <select id="select_interviewshop" name="面接店舗" style="width:195px;">
                    {$shop_select}
                </select>
                <input type="hidden" id="interviewshop_hidden" name="interviewshop_hidden" value="" />
            </div>
        </div>
        <!--所属店舗-->
        <div class="white_search_box">
            <p>所属店舗</p>
            <div class="select_arrow">
                <select id="select_belonging_store" name="所属店舗" style="width:195px;">
                    {$belonging_store_select}
                </select>
                <input type="hidden" id="belonging_store_hidden" name="belonging_store_hidden" value="" />
            </div>
        </div>
        <!-- 源氏名-->
        <div class="white_search_box">
            <p>源氏名</p>
            {$forms.genji_name.html}
        </div>
        <!-- 源氏名（ふりがな）-->
        <div class="white_search_box ">
            <p>源氏名（ふりがな）</p>
            {$forms.genji_namekana.html}
        </div>
        <!-- 名前-->
        <div class="white_search_box">
            <p>名前</p>
            <span class="search_select_txt">姓</span>{$forms.surname.html}
            <span class="search_select_txt space">名</span>{$forms.name.html}
        </div>
        <!-- 名前（ふりがな）-->
        <div class="white_search_box">
            <p>名前（ふりがな）</p>
            <span class="search_select_txt">姓</span>{$forms.surnamekana.html}
            <span class="search_select_txt space">名</span>{$forms.namekana.html}
        </div>
        <!--年齢-->
        <div class="white_search_box">
            <p>年齢</p>
            <div class="select_arrow select_other">
                {$forms.age_from.html}
            </div>
            <span class="select_other_txt">歳&nbsp;～</span>
            <div class="select_arrow select_other">
                {$forms.age_to.html}
            </div>
            <span class="select_other_txt">歳</span>
        </div>
        <!--身長-->
        <div class="white_search_box">
            <p>身長</p>
            <div class="select_arrow select_other">
                {$forms.tall_from.html}
            </div>
            <span class="select_other_txt">cm&nbsp;～</span>
            <div class="select_arrow select_other">
                {$forms.tall_to.html}
            </div>
            <span class="select_other_txt">cm</span>
        </div>
        <!--体重-->
        <div class="white_search_box ">
            <p>体重</p>
            <div class="select_arrow select_other">
                {$forms.weight_from.html}
            </div>
            <span class="select_other_txt">kg&nbsp;～</span>
            <div class="select_arrow select_other">
                {$forms.weight_to.html}
            </div>
            <span class="select_other_txt">kg</span>
        </div>
        <!--カップ数-->
        <div class="white_search_box">
            <p>カップ数</p>
            <div class="select_arrow">
                <select id="select_cup" name="カップ数" style="width:150px;">
                    {$cup_select}
                </select>
                <input type="hidden" id="cup_hidden" name="cup_hidden" value="" />
            </div>
            {*<div class="select_arrow select_other">*}
                {*{$forms.cup_from.html}*}
            {*</div>*}
            {*<span class="select_other_txt">cup&nbsp;～</span>*}
            {*<div class="select_arrow select_other">*}
                {*{$forms.cup_to.html}*}
            {*</div>*}
            {*<span class="select_other_txt">cup</span>*}
        </div>
        <!--経験-->
        <div class="white_search_box">
            <p>経験</p>
            <div class="select_arrow">
                <select id="select_experience" name="経験" style="width:150px;">
                    {$experience_select}
                </select>
                <input type="hidden" id="experience_hidden" name="experience_hidden" value="" />
            </div>
        </div>
        <!--都道府県-->
        <div class="white_search_box">
        <p>都道府県</p>
        <div class="select_arrow select_pref">
        <select id="select_pref" name="住所" style="width:160px;">
        {$pref_select}
        </select>
        <input type="hidden" id="pref_hidden" name="pref_hidden" value="" />
        </div>
        </div>
        <!--面接前確認-->
        <div class="white_search_box">
            <p>面接前確認</p>
            <div class="select_arrow select_check">
                <select id="select_check" name="面接前確認" style="width:160px;">
                    {$check_select}
                </select>
                <input type="hidden" id="check_hidden" name="check_hidden" value="" />
            </div>
        </div>

        {*<!--住所-->*}
        {*<div class="white_search_box  LLarge">*}
            {*<p>住所</p>*}
            {*<div class="select_arrow select_address">*}
                {*<select id="select_address" name="住所" style="width:160px;">*}
                    {*{$pref_select}*}
                {*</select>*}
                {*<input type="hidden" id="address_hidden" name="address_hidden" value="" />*}
            {*</div>*}
            {*<span class="select_other_txt">都道府県</span>*}
            {*{$forms.address.html}*}
        {*</div>*}
        <!--身分証-->
        <div class="white_search_box ">
            <p>身分証</p>
            <div class="select_arrow">
                <select id="select_identity_card_select" name="身分証" style="width:210px;">
                    {$person_select}
                </select>
                <input type="hidden" id="identity_card_select_hidden" name="identity_card_select_hidden" value="" />
            </div>
        </div>
        <!--TEL-->
        <div class="white_search_box ">
            <p>TEL</p>
            {$forms.tel01.html}<span class="hyphen">-</span>{$forms.tel02.html}<span class="hyphen">-</span>{$forms.tel03.html}
        </div>
        <!--Mail-->
        <div class="white_search_box  XMedium">
            <p>Mail</p>
            {$forms.mail01.html}<span class="at">＠</span>
            <div class="select_arrow select_mail">
                {$forms.maildomain.html}
            </div>
        </div>
        <!--面接結果-->
        <div class="white_search_box  XSmall">
            <p>面接結果</p>
            <div class="select_arrow">
                <select id="select_interview_result" name="interview_result" style="width:110px;">
                    {$interview_result_select}
                </select>
                <input type="hidden" id="interview_result_hidden" name="interview_result_hidden" value="" />
            </div>
        </div>
        <!--面接担当-->
        <div class="white_search_box  XSmall">
            <p>面接担当</p>
            <div class="select_arrow">
                <select id="select_interview_staff" name="interview_staff" style="width:120px;">
                    {$interview_staff_select}
                </select>
                <input type="hidden" id="interview_staff_hidden" name="interview_staff_hidden" value="" />
            </div>
        </div>
        <!--KS担当-->
        <div class="white_search_box  XSmall">
            <p>KS担当</p>
            <div class="select_arrow">
                <select id="select_ks_staff" name="ks_staff" style="width:120px;">
                    {$interview_staff_select}
                </select>
                <input type="hidden" id="ks_staff_hidden" name="ks_staff_hidden" value="" />
            </div>
        </div>
        <!--勤務形態-->
        <div class="white_search_box  XSmall">
            <p>勤務形態</p>
            <div class="select_arrow">
                <select id="select_work" name="work" style="width:110px;">
                    {$work_select}
                </select>
                <input type="hidden" id="work_hidden" name="work_hidden" value="" />
            </div>
        </div>
        <!--給料-->
        <div class="white_search_box">
            <p>給料</p>
            <div class="select_arrow select_yen">
                {$forms.salary_from.html}
            </div>
            <span class="select_ymd_txt">円&nbsp;～&nbsp;</span>
            <div class="select_arrow select_yen">
                {$forms.salary_to.html}
            </div>
            <span class="select_ymd_txt">円</span>
        </div>
        <!--特別指名料-->
        <div class="white_search_box">
            <p>特別指名料</p>
            <div class="select_arrow select_yen">
                {$forms.nomination_fee_from.html}
            </div>
            <span class="select_ymd_txt">円&nbsp;～&nbsp;</span>
            <div class="select_arrow select_yen">
                {$forms.nomination_fee_to.html}
            </div>
            <span class="select_ymd_txt">円</span>
        </div>
        <!-- 退店 -->
        <div class="white_search_box  search3">
            <div class="checkbox_serch">
                <label>
                    <input type="hidden" name="leaving_check" value="0" />
                    <input type="checkbox" name="leaving_check" class="checkbox_serch-sqar" value="1">
                    <span class="checkbox_serch-txt">退店</span>
                </label>
            </div>
        </div>
        <!-- 退店日 -->
        <div class="white_search_box">
            <p>退店日</p>
            <div class="select_arrow select_y">
                {$forms.leaving_year_from.html}
            </div>
            <span class="select_ymd_txt">年</span>

            <div class="select_arrow select_md">
                {$forms.leaving_month_from.html}
            </div>
            <span class="select_ymd_txt">月</span>

            <div class="select_arrow select_md">
                {$forms.leaving_day_from.html}
            </div>
            <span class="select_ymd_txt">日&nbsp;～&nbsp;</span>
            <div class="select_arrow select_y">
                {$forms.leaving_year_to.html}
            </div>
            <span class="select_ymd_txt">年</span>

            <div class="select_arrow select_md">
                {$forms.leaving_month_to.html}
            </div>
            <span class="select_ymd_txt">月</span>

            <div class="select_arrow select_md">
                {$forms.leaving_day_to.html}
            </div>
            <span class="select_ymd_txt">日&nbsp;迄</span>
        </div>
        <!--退店理由-->
        <div class="white_search_box ">
            <p>退店理由</p>
            <div class="select_arrow">
                <select id="select_leaving_reason" name="leaving_reason" style="width:210px;">
                    {$leaving_reason_select}
                </select>
                <input type="hidden" id="leaving_reason_hidden" name="leaving_reason_hidden" value="" />
            </div>
        </div>
        <!--掲載媒体-->
        <div class="white_search_box ">
            <p>掲載媒体</p>
            <div class="select_arrow">
                <select id="select_publicity" name="publicity" style="width: 190px;">
                    {$publicity_select}
                </select>
                <input type="hidden" id="publicity_hidden" name="publicity_hidden" value="" />
            </div>
        </div>
        <!--検索エリア-->
        <div class="white_search_box ">
            <p>検索エリア</p>
            <div class="select_arrow">
                <select id="select_area" name="area" style="width:150px;">
                    {$area_select}
                </select>
                <input type="hidden" id="area_hidden" name="area_hidden" value="" />
            </div>
        </div>
        <!--掲載求人-->
        <div class="white_search_box ">
            <p>掲載求人</p>
            <div class="select_arrow">
                <select id="select_media" name="media" style="width: 190px;">
                    {$media_select}
                </select>
                <input type="hidden" id="media_hidden" name="media_hidden" value="" />
            </div>
        </div>
        <!--掲載業種-->
        <div class="white_search_box ">
            <p>掲載業種</p>
            <div class="select_arrow">
                <select id="select_genre" name="genre" style="width: 190px;">
                    {$genre_select}
                </select>
                <input type="hidden" id="genre_hidden" name="genre_hidden" value="" />
            </div>
        </div>
        <!--SC-->
        <div class="white_search_box ">
            <p>SC</p>
            <div class="select_arrow select_medium">
                <select id="select_scout" name="scout" style="width: 190px;">
                    {$scout_select}
                </select>
                <input type="hidden" id="scout_hidden" name="scout_hidden" value="" />
            </div>
        </div>
        <!--出戻り・移籍・紹介-->
        <div class="white_search_box ">
            <p>出戻り・移籍・紹介</p>
            <div class="select_arrow">
                <select id="select_move" name="move" style="width:150px;">
                    {$move_select}
                </select>
                <input type="hidden" id="move_hidden" name="move_hidden" value="" />
            </div>
        </div>
        {*<!--他店紹介-->*}
        <div class="white_search_box  XMedium">
            <p>他店紹介</p>
            <div class="select_arrow select_yen">
                <select id="select_another_shop" name="another_shop" style="width:170px;">
                    {$another_shop_select}
                </select>
                <input type="hidden" id="another_shop_hidden" name="another_shop_hidden" value="" />
            </div>
            <span class="select_other_txt2">備考</span>{$forms.another_shop_remarks.html}
        </div>
        <!--検索ワード-->
        <div class="white_search_box ">
            <p>検索ワード</p>
            <div class="select_arrow select_word">
                <select id="select_word" name="word" style="width:150px;">
                    {$word_select}
                </select>
                <input type="hidden" id="word_hidden" name="word_hidden" value="" />
            </div>
        </div>
        <!--チェック-->
        <div class="white_search_box  search4">
            <div class="checkbox_serch">
                <label>
                    <input type="hidden" name="working_away_flg" value="0" />
                    <input type="checkbox" name="working_away_flg" class="checkbox_serch-sqar" value="1">
                    <span class="checkbox_serch-txt">出稼ぎ</span>
                </label>
            </div>
        </div>
        <div class="white_search_box  search">
            <div class="checkbox_serch">
                <label>
                    <input type="hidden" name="nikoiti_flg" value="0" />
                    <input type="checkbox" name="nikoiti_flg" class="checkbox_serch-sqar" value="1">
                    <span class="checkbox_serch-txt">ニコイチ</span>
                </label>
            </div>
        </div>
        <div class="white_search_box  search2">
            <div class="checkbox_serch">
                <label>
                    <input type="hidden" name="scout_mail_flg" value="0" />
                    <input type="checkbox" name="scout_mail_flg" class="checkbox_serch-sqar" value="1">
                    <span class="checkbox_serch-txt">オファーメールからの申し込み</span>
                </label>
            </div>
        </div>
        <!--店舗スタッフ-->
        <div class="white_box  clear">
            <label for="staff_flg" class="tenpo_radio">
                <input type="hidden" name="staff_flg" value="0" />
                <input id="staff_flg" name="staff_flg" type="radio" value="1">
                <span class="tenpo_label">店舗スタッフ</span>
            </label>
            {*<label class="tenpo_radio">*}
                {*<input type="hidden" name="staff_flg" value="0" />*}
                {*<input type="checkbox" name="staff_flg" class="checkbox_serch-sqar" value="1">*}
                {*<span class="checkbox_serch-txt">店舗スタッフ</span>*}
            {*</label>*}
        </div>
        </div>
    </section>
    </form>
</article>

{literal}
    <script>
        $(function() {
            $(".btn_orange").click(function(){
                //面接店舗
                $('#interviewshop_hidden').val($('#select_interviewshop').multipleSelect('getSelects'));

                //所属店舗
                $('#belonging_store_hidden').val($('#select_belonging_store').multipleSelect('getSelects'));

                //カップ数
                $('#cup_hidden').val($('#select_cup').multipleSelect('getSelects'));

                //経験
                $('#experience_hidden').val($('#select_experience').multipleSelect('getSelects'));

                //都道府県
                $('#pref_hidden').val($('#select_pref').multipleSelect('getSelects'));

                //面接前確認
                $('#check_hidden').val($('#select_check').multipleSelect('getSelects'));

                //住所
                // $('#address_hidden').val($('#select_address').multipleSelect('getSelects'));

                //身分証
                $('#identity_card_select_hidden').val($('#select_identity_card_select').multipleSelect('getSelects'));

                //面接結果
                $('#interview_result_hidden').val($('#select_interview_result').multipleSelect('getSelects'));

                //面接担当
                $('#interview_staff_hidden').val($('#select_interview_staff').multipleSelect('getSelects'));

                //KS担当
                $('#ks_staff_hidden').val($('#select_ks_staff').multipleSelect('getSelects'));

                //勤務形態
                $('#work_hidden').val($('#select_work').multipleSelect('getSelects'));

                //退店理由
                $('#leaving_reason_hidden').val($('#select_leaving_reason').multipleSelect('getSelects'));

                //掲載媒体
                $('#publicity_hidden').val($('#select_publicity').multipleSelect('getSelects'));

                //掲載エリア
                $('#area_hidden').val($('#select_area').multipleSelect('getSelects'));

                //掲載求人
                $('#media_hidden').val($('#select_media').multipleSelect('getSelects'));

                //掲載業種
                $('#genre_hidden').val($('#select_genre').multipleSelect('getSelects'));

                //SC
                $('#scout_hidden').val($('#select_scout').multipleSelect('getSelects'));

                //出戻り・移籍・紹介
                $('#move_hidden').val($('#select_move').multipleSelect('getSelects'));

                //他店紹介
                $('#another_shop_hidden').val($('#select_another_shop').multipleSelect('getSelects'));

                //検索ワード
                $('#word_hidden').val($('#select_word').multipleSelect('getSelects'));
            });
        });
    </script>
{/literal}

{include file=$smarty.const.ADMIN_FOOTER}