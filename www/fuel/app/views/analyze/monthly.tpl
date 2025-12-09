{include file=$smarty.const.ADMIN_HEADER}


<article>
    <section class="top_content_wrap">

    </section>
    <section class="">
        <div class="container analyze_wrap date_info_col">
            <h1 class="breadcrumb">&gt;&nbsp;集計</h1>
            {include file=$smarty.const.ANALYZE_MENU}
            <form class="analyze_info_inner" action="/analyze/monthly" method="get">
                <h2 class="analyze_info_title">月間集計</h2>
                <!--date_left_col-->
                <div class="analyze_form_wrap">
                    <!-- 申込日-->
                    <div class="white_box Medium">
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
                    <!--検索ボタン-->
                    <div class="analyze_btn">
                        <a href="/analyze/monthly"><button id="anl_btn" type="submit" class="btn_orange" name="search" value="1">検索</button></a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</article>

{literal}
    <script>
        //フォームの必須
        $(function(){
            $('#anl_btn').click(function(){
                if($("#form_interview_year_from").val() == "" || $("#form_interview_month_from").val() == "" || $("#form_interview_year_to").val() == "" || $("#form_interview_month_to").val() == ""){
                    alert("面接日を選択してください");
                    return false;
                }
            });
        });
    </script>
{/literal}


{include file=$smarty.const.ADMIN_FOOTER}