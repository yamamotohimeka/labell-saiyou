{include file=$smarty.const.ADMIN_HEADER}
<section class="top_content_wrap">

</section>
<article id="scout" class="container">

    <h1 class="breadcrumb">&gt;&nbsp;オファーメール</h1>

    <section>
        <ul class="tab">
            <li class="current"><h2>所属店舗</h2></li>
            <li><h2>掲載求人</h2></li>
        </ul>
        <div class="scout_contents">
            <!-- 店舗タブ -->
            <div class="scout_content">
                <form action="/scout/search_shop" method="get">
                <div class="note">
                    <p>※採用情報から検索</p>
                </div>
                <!--所属店舗-->
                <div class="white_box" style="width:auto;">
                    <p>所属店舗</p>
                    <div class="select_arrow">
                        <select id="select_belong" name="select_belong" style="min-width:200px;">
                            {$belonging_store_select}
                        </select>
                        <input type="hidden" id="belonging_store_hidden" name="belonging_store_hidden" value="" />
                    </div>
                </div>

                <!-- 面接日-->
                <div class="white_box Medium clear">
                    <p>面接日</p>
                    <div class="select_arrow select_y">
                        {$forms.interview_date_year_from.html}
                    </div>
                    <span class="select_ymd_txt">年</span>

                    <div class="select_arrow select_md">
                        {$forms.interview_date_month_from.html}
                    </div>
                    <span class="select_ymd_txt">月</span>

                    <div class="select_arrow select_md">
                        {$forms.interview_date_day_from.html}
                    </div>
                    <span class="select_ymd_txt">日&nbsp;～&nbsp;</span>
                    <div class="select_arrow select_y">
                        {$forms.interview_date_year_to.html}
                    </div>
                    <span class="select_ymd_txt">年</span>

                    <div class="select_arrow select_md">
                        {$forms.interview_date_month_to.html}
                    </div>
                    <span class="select_ymd_txt">月</span>

                    <div class="select_arrow select_md">
                        {$forms.interview_date_day_to.html}
                    </div>
                    <span class="select_ymd_txt">日&nbsp;迄</span>
                </div>
                <!--面接結果-->
                <div class="white_box" style="width:auto;">
                    <p>面接結果</p>
                    <div class="select_arrow">
                        <select id="select_result" name="select_result" style="min-width:150px;">
                        {$interview_result_select}
                        </select>
                        <input type="hidden" id="result_hidden" name="result_hidden" value="" />
                    </div>
                </div>
                <!--年齢-->
                <div class="white_box clear">
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
                <div class="white_box">
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
                <div class="white_box">
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
                <!--住所-->
                <div class="white_box LLarge clear">
                    <p>住所</p>
                    <div class="select_arrow select_address">
                        <select id="select_shop_ad" name="住所" style="width:160px;">
                            {$pref_select}
                        </select>
                        <input type="hidden" id="shop_pref_hidden" name="shop_pref_hidden" value="" />
                    </div>
                    {*<span class="select_other_txt">都道府県</span>*}
                    {*{$forms.address.html}*}
                </div>
                <!-- 退店日-->
                <div class="white_box MMedium">
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
                <!--検索ボタン-->
                <div class="scout_btn clear">
                    {*<button type="button" class="btn_orange">検索</button>*}
                        <input type="submit" class="btn_orange submit_btn shop_search_btn" value="検索"/>
                    <input type="hidden" name="search" value="1" />
                    <input type="hidden" name="search_type" value="shop" />
                </div>
                </form>
            </div><!-- 店舗タブend -->

            <!-- 掲載求人名タブ -->

            <div class="scout_content">
                <form action="/scout/search_recruit" method="get">
                <div class="note">
                    <p>※問い合わせリスト（採用情報アップ分は省く）から検索</p>
                </div>
                <div class="white_box">
                    <p>掲載求人</p>
                    <div class="select_arrow">
                        {$forms.media.html}
                    </div>
                </div>
                <!-- 申込日-->
                <div class="white_box Medium clear">
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
                    <div class="white_box search4">
                        <div class="checkbox_serch">
                            <label>
                                <input type="hidden" name="working_away_flg" value="0" />
                                <input type="checkbox" name="working_away_flg" class="checkbox_serch-sqar" value="1">
                                <span class="checkbox_serch-txt select_ymd_txt">出稼ぎ</span>
                            </label>
                        </div>
                    </div>
                <!--経験-->
                <div class="white_box SSmall clear">
                    <p>経験</p>
                    <div class="select_arrow">
                        <select id="select_exp" name="経験" style="width:150px;">
                            {$experience_select}
                        </select>
                        <input type="hidden" id="experience_hidden" name="experience_hidden" value="" />
                    </div>
                </div>

                <!--年齢-->
                <div class="white_box">
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
                <div class="white_box">
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
                <div class="white_box">
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
                <!--住所-->
{*                <div class="white_box LLarge clear">*}
{*                    <p>住所</p>*}
{*                    <div class="select_arrow select_address">*}
{*                        <select id="select_recruit_ad" name="住所" style="width:160px;">*}
{*                            {$pref_select}*}
{*                        </select>*}
{*                        <input type="hidden" id="recruit_pref_hidden" name="recruit_pref_hidden" value="" />*}
{*                    </div>*}
{*                    *}{*<span class="select_other_txt">都道府県</span>*}
{*                    *}{*{$forms.address.html}*}
{*                </div>*}
                <!--検索ボタン-->
                <div class="scout_btn clear">
                    {*<a href="scout-srch2.php"><button type="button" class="btn_orange">検索</button></a>*}
                    <input type="submit" class="btn_orange submit_btn recruit_search_btn" value="検索"/>
                    <input type="hidden" name="search" value="1" />
                    <input type="hidden" name="search_type" value="recruit" />
                </div>
                </form>
            </div><!-- 掲載求人名タブend -->
        </div>
    </section>
</article>


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

        $('.shop_search_btn').click(function(){
            var select_belong = $('#select_belong').multipleSelect('getSelects');
            var select_result = $('#select_result').multipleSelect('getSelects');
            var select_shop_ad = $('#select_shop_ad').multipleSelect('getSelects');

            $('#belonging_store_hidden').val(select_belong);
            $('#result_hidden').val(select_result);
            $('#shop_pref_hidden').val(select_shop_ad);
        });

        $('.recruit_search_btn').click(function(){
            var select_exp = $('#select_exp').multipleSelect('getSelects');
            var select_recruit_ad = $('#select_recruit_ad').multipleSelect('getSelects');

            $('#experience_hidden').val(select_exp);
            $('#recruit_pref_hidden').val(select_recruit_ad);
        });

    });

    </script>


{include file=$smarty.const.ADMIN_FOOTER}