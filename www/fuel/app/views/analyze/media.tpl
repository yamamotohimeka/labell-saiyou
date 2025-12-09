{include file=$smarty.const.ADMIN_HEADER}


<article>
    <section class="top_content_wrap">
    </section>
    <section class="">
        <div class="container analyze_wrap date_info_col">
            <h1 class="breadcrumb">&gt;&nbsp;集計</h1>
            {include file=$smarty.const.ANALYZE_MENU}
            <form class="analyze_info_inner" action="/analyze/media" method="get">
                <h2 class="analyze_info_title">掲載媒体</h2>
                <!--date_left_col-->
                    <span class="required">
                        ★ 掲載媒体の集計のみ他の集計と違い、ログを残す集計となっております<br />
                        ★ 日付の検索は【問い】の集計は『申込日』、【面接】と【入店】の集計は『面接日』で行います
                    </span>
                <div class="analyze_form_wrap">
                    <!-- 申込日-->
                    <div class="white_box MMedium">
                        <p>申込日 or 面接日</p>
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
                    <!--掲載媒体-->
                    <div class="white_box clear">
                        <p>掲載媒体</p>
                        <div class="select_arrow">
                            <select name="掲載媒体" id="select_media" style="width: 210px;">
                                {$publicity_select}
                            </select>
                            <input type="hidden" id="media_hidden" name="media_hidden" value="" />
                        </div>
                    </div>
                    <!--掲載求人-->
                    <div class="white_box clear">
                        <p>掲載求人</p>
                        <div class="select_arrow select_medium">
                            <select name="掲載求人" id="select_recruit" style="width: 210px;">
                                {$media_select}
                            </select>
                            <input type="hidden" id="recruit_hidden" name="recruit_hidden" value="" />
                        </div>
                    </div>
                    <!--掲載求人-->
                    <div class="white_box clear">
                        <p>入店データ調整</p>
                        <label>
                            <input type="hidden" name="adjustment" value="0">
                            <input type="checkbox" value="1" class="checkbox-sqar" id="form_adjustment" name="adjustment">
                            <span class="checkbox-txt">調整を行う<br /><span class="required">（* 処理が発生する為、ページ遷移が重くなるか、Errorとなる場合があります）</span></span>
                        </label>
                    </div>
                    <!--検索ボタン-->
                    <div class="analyze_btn">
                        <a href="/analyze/media"><button id="anl_btn" type="submit" class="btn_orange" name="search" value="1">検索</button></a>
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
                if($("#form_submission_year_from").val() == "" || $("#form_submission_month_from").val() == "" || $("#form_submission_day_from").val() == "" || $("#form_submission_year_to").val() == "" || $("#form_submission_month_to").val() == "" || $("#form_submission_day_to").val() == "" ){
                    alert("申込日を選択してください");
                    return false;
                }

                if(!$(".placeholder").length) {

                }else {
                    alert("項目を選択してください");
                    return false;
                }

                var select_media = $('#select_media').multipleSelect('getSelects');
                $('#media_hidden').val(select_media);

                var select_recruit = $('#select_recruit').multipleSelect('getSelects');
                $('#recruit_hidden').val(select_recruit);
            });
        });
    </script>
{/literal}

{include file=$smarty.const.ADMIN_FOOTER}