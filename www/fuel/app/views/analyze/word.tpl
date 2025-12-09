{include file=$smarty.const.ADMIN_HEADER}


<article>
    <section class="top_content_wrap">
    </section>
    <section class="">
        <div class="container analyze_wrap date_info_col">
            <h1 class="breadcrumb">&gt;&nbsp;集計</h1>
            {include file=$smarty.const.ANALYZE_MENU}
            <form class="analyze_info_inner" action="/analyze/word" method="get">
                <h2 class="analyze_info_title">検索ワード</h2>
                <span class="required">★ 『SC』『出戻り』『紹介』『移籍』『オファーメールからの申し込み』は検索対象から除外となります。</span>
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
                    <!--掲載業種-->
                    <div class="white_box clear">
                        <p>掲載業種</p>
                        <div class="select_arrow select_long">
                            <select name="掲載業種" id="select_genre" style="width: 210px;">
                                {$genre_select}
                            </select>
                            {*{$forms.genre.html}*}
                            <input type="hidden" id="genre_hidden" name="select_genre_hidden" value="" />
                        </div>
                    </div>
                    <!--検索ボタン-->
                    <div class="analyze_btn">
                        <a href="/analyze/word"><button type="submit" class="btn_orange" id="anl_btn" name="search" value="1">検索</button></a>
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

                // var select_genre = $('#form_genre').multipleSelect('getSelects');
                var select_genre = $('#select_genre').multipleSelect('getSelects');
                // console.log(select_genre);
                $('#genre_hidden').val(select_genre);
            });
        });
    </script>
{/literal}

{include file=$smarty.const.ADMIN_FOOTER}