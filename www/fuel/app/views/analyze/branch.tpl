{include file=$smarty.const.ADMIN_HEADER}


<article>
    <section class="top_content_wrap">
    </section>
    <section class="">
        <div class="container analyze_wrap date_info_col">
            <h1 class="breadcrumb">&gt;&nbsp;集計</h1>
            {include file=$smarty.const.ANALYZE_MENU}
            <form class="analyze_info_inner" action="/analyze/branch" method="get">
                <h2 class="analyze_info_title">他店紹介</h2>
                <!--date_left_col-->
                <div class="analyze_form_wrap">
                    <!-- 申込日-->
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
                    <!--他店紹介-->
                    <div class="white_box clear slect_short">
                        <p>他店紹介</p>
                        <div class="select_arrow">
                            <select name="another_shop" id="select_another_shop" style="width: 210px;">
                                {$another_shop_select}
                            </select>
                            <input type="hidden" id="another_shop_hidden" name="another_shop_hidden" value="" />
                        </div>
                    </div>
                    <!--検索ボタン-->
                    <div class="analyze_btn">
                        <a href="/analyze/branch"><button type="submit" class="btn_orange" id="anl_btn" name="search" value="1">検索</button></a>
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
                if($("#form_interview_year_from").val() == "" || $("#form_interview_month_from").val() == "" || $("#form_interview_day_from").val() == "" || $("#form_interview_year_to").val() == "" || $("#form_interview_month_to").val() == "" || $("#form_interview_day_to").val() == "" ){
                    alert("面接日を選択してください");
                    return false;
                }

                if(!$(".placeholder").length) {

                }else {
                    alert("項目を選択してください");
                    return false;
                }

                var select_another_shop = $('#select_another_shop').multipleSelect('getSelects');
                $('#another_shop_hidden').val(select_another_shop);
            });
        });
    </script>
{/literal}

{include file=$smarty.const.ADMIN_FOOTER}