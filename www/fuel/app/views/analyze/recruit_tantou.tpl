{include file=$smarty.const.ADMIN_HEADER}

<article>
    <section class="top_content_wrap">
    </section>
    <section class="">
        <div class="container analyze_wrap date_info_col">
            <h1 class="breadcrumb">&gt;&nbsp;集計</h1>
            {include file=$smarty.const.ANALYZE_MENU}
            <form class="analyze_info_inner" action="/analyze/recruit_tantou" method="get">
                <h2 class="analyze_info_title">入店率</h2>
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
                    <div class="white_box clear">
                        <p>掲載業種</p>
                        <div class="select_arrow select_long">
                            <div class="select_arrow select_long">
                                <select name="掲載業種" id="select_genre" style="width: 210px;">
                                    {$genre_select}
                                </select>
                                <input type="hidden" id="genre_hidden" name="select_genre_hidden" value="" />
                            </div>
                        </div>
                    </div>
                    <!--面接担当-->
                    <div class="white_box">
                        <p>面接担当</p>
                        <div class="select_arrow slect_long">
                            <select name="面接担当" id="select_staff" style="width: 210px;">
                                {$interview_staff_select}
                            </select>
                            <input type="hidden" id="staff_hidden" name="select_staff_hidden" value="" />
                        </div>
                    </div>

                    <div class="white_box">
                        <p>検索対象</p>
                        <div class="select_arrow select_long">
                            <select name="検索対象" id="select_target" style="width: 210px; display: none;">
                                <optgroup label="全て選択">
                                    <option value="1">掲載求人</option>
                                    <option value="2">SC</option>
                                    <option value="3">出戻り・移籍・紹介</option>
                                </optgroup>
                            </select>
                            <input type="hidden" id="target_hidden" name="select_target_hidden" value="" />
                        </div>
                    </div>

                    <!--検索ボタン-->
                    <div class="analyze_btn">
                        <a href="/analyze/recruit"><button type="submit" class="btn_orange" id="anl_btn" name="search" value="1">検索</button></a>
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

                var select_genre = $('#select_genre').multipleSelect('getSelects');
                $('#genre_hidden').val(select_genre);

                var select_staff = $('#select_staff').multipleSelect('getSelects');
                $('#staff_hidden').val(select_staff);

                var select_target = $('#select_target').multipleSelect('getSelects');
                $('#target_hidden').val(select_target);
            });
        });
    </script>
{/literal}

{include file=$smarty.const.ADMIN_FOOTER}