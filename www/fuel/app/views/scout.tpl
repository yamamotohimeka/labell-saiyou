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
                <div class="note">
                    <p>※採用情報から検索</p>
                </div>
                <!--所属店舗-->
                <div class="white_box" style="width:auto;">
                    <p>所属店舗</p>
                    <div class="select_arrow">
                        <select id="select_belong" name="select_belong" style="min-width:200px;">
                            {$shopentry_select}
                        </select>
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
                        <select id="select_ad" name="住所" style="width:160px;">
                            {$pref_select}
                        </select>
                    </div>
                    <span class="select_other_txt">都道府県</span>
                    {$forms.address.html}
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

                <!--経験-->
                <div class="white_box SSmall clear">
                    <p>経験</p>
                    <div class="select_arrow">
                        <select id="select_exp" name="経験" style="width:150px;">
                            {$experience_select}
                        </select>
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
                <div class="white_box LLarge clear">
                    <p>住所</p>
                    <div class="select_arrow select_address">
                        <select id="select_ad" name="住所" style="width:160px;">
                            {$pref_select}
                        </select>
                    </div>
                    <span class="select_other_txt">都道府県</span>
                    {$forms.address.html}
                </div>
                <!--検索ボタン-->
                <div class="scout_btn clear">
                    <a href="scout-srch2.php"><button type="button" class="btn_orange">検索</button></a>
                </div>
            </div><!-- 掲載求人名タブend -->

        </div>
    </section>
</article>

{literal}
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

    </script>
    {/literal}

{include file=$smarty.const.ADMIN_FOOTER}