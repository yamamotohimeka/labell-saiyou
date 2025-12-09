{include file=$smarty.const.ADMIN_HEADER}


<article>
    <section class="top_content_wrap">
    </section>
    <section class="">
        <div class="container analyze_wrap date_info_col">
            <h1 class="breadcrumb">&gt;&nbsp;集計</h1>
            {include file=$smarty.const.ANALYZE_MENU}
            <form class="analyze_info_inner" action="/analyze/divide" method="get">
                <h2 class="analyze_info_title">面接振り件数</h2>
                <!--date_left_col-->
                <div class="analyze_form_wrap">
                    <!-- 面接日-->
                    <div class="white_box MMedium">
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
                    <div class="white_box clear">
                        <p>面接店舗</p>
                        <div class="select_arrow select_long">
                            <select id="select_shop" class="req01" name="select_shop" style="width: 210px;">
                                {$shop_select}
                            </select>
                        </div>
                        <input type="hidden" id="shop_hidden" name="shop_hidden" value=""/>
                    </div>

                    <!--掲載求人-->
                    <div class="white_box clear">
                        <p>掲載求人</p>
                        <div class="select_arrow select_long">
                            <select name="掲載求人" id="select_recruit" style="width: 210px;">
                                {$media_select}
                            </select>
                            <input type="hidden" id="recruit_hidden" name="recruit_hidden" value="" />
                        </div>
                    </div>

                    <!--検索ボタン-->
                    <div class="analyze_btn">
                        <a href="/analyze/divide"><button id="anl_btn" type="submit" class="btn_orange" name="search" value="1">検索</button></a>
                    </div>
            </form>
        </div>
        </div>
    </section>
</article>

{literal}
    <script>
        //フォームの必須
        $(function(){
            $('#anl_btn').click(function(){
                if($("#form_submission_year_from").val() == "" || $("#form_submission_month_from").val() == "" || $("#form_submission_day_from").val() == "" || $("#form_submission_year_to").val() == "" || $("#form_submission_month_to").val() == "" || $("#form_submission_day_to").val() == "" ){
                    alert("申込日を選択してください");
                    return false;
                }

                if(!$(".placeholder").length) {

                }else {
                    alert("項目を選択してください");
                    return false;
                }

                var select_shop = $('#select_shop').multipleSelect('getSelects');
                $('#shop_hidden').val(select_shop);

                var select_recruit = $('#select_recruit').multipleSelect('getSelects');
                $('#recruit_hidden').val(select_recruit);
            });
        });
    </script>
{/literal}

{include file=$smarty.const.ADMIN_FOOTER}