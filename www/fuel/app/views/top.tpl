{include file=$smarty.const.ADMIN_HEADER}

<article>
    <section class="top_content_wrap">

    </section>
    
    <form method="get" action="/index">
        <div class="girl_search_col container">
            <!-- 面接日-->
            <div class="white_box MMedium col_border mg_bottom10">
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
            <div class="white_box XSmall col_border mg_bottom10">
                <p>面接結果</p>

                <div class="select_arrow">
                    <select id="select_result" name="select_result" style="width:110px;">
                        {$interview_result_select}
                    </select>
                    <input type="hidden" name="result_hidden" value="" id="result_hidden"/>
                </div>
            </div>
            <!--面接担当-->
            <div class="white_box SSmall col_border mg_bottom10">
                <p>面接担当</p>

                <div class="select_arrow select_staff">
                    <select id="select_staff" name="select_staff" style="width:150px;">
                        {$interview_staff_select}
                    </select>
                    <input type="hidden" name="interview_staff_hidden" value="" id="interview_staff_hidden"/>
                </div>
            </div>
            <!-- ID-->
            <div class="white_box SSSmall clear col_border mg_bottom10" style="width: 8%;">
                <p>ID</p>
                {$forms.search_id.html}
            </div>
            <!-- 源氏名-->
            <div class="white_box SSSmall col_border mg_bottom10">
                <p>源氏名</p>
                {$forms.genji_name.html}
            </div>
            <!-- 源氏名（ふりがな）-->
            <div class="white_box SSSmall col_border mg_bottom10">
                <p>源氏名（ふりがな）</p>
                {$forms.genji_namekana.html}
            </div>
            <!--所属店舗-->
            <div class="white_box SSSmall col_border mg_bottom10">
                <p>所属店舗</p>

                <div class="select_arrow select_medium">
                    <select id="select_belonging_store" name="select_belonging_store" style="width:200px;">
                        {$belonging_store_select}
                    </select>
                    <input type="hidden" name="belonging_store_hidden" value="" id="belonging_store_hidden"/>
                </div>
            </div>
            <!--掲載求人-->
            <div class="white_box SSSmall col_border mg_bottom10">
                <p>掲載求人</p>
                <div class="select_arrow">
                    <select id="select_media" name="select_media" style="width: 190px;">
                        {$media_select}
                    </select>
                    <input type="hidden" id="media_hidden" name="media_hidden" value="" />
                </div>
            </div>
            <!-- 名前-->
            <div class="white_box indexname col_border mg_bottom10 clear">
                <p>名前</p>
                <span class="search_select_txt">姓</span>{$forms.surname.html}
                <span class="search_select_txt space">名</span>{$forms.name.html}
            </div>
            <div class="white_box indexname col_border mg_bottom10">
                <p>名前（ふりがな）</p>
                <span class="search_select_txt">姓</span>{$forms.surnamekana.html}
                <span class="search_select_txt space">名</span>{$forms.namekana.html}
            </div>
            <!--店舗スタッフ-->
            <div class="white_box SSSmall col_border mg_bottom10">
                <div class="checkbox_serch">
                    <label>
                        <input type="hidden" name="emigrate" value="0"/>
                        <input type="checkbox" name="emigrate" value="1" class="checkbox_serch-sqar"
                               {if $search.emigrate|default:"0" === "1"}checked{/if}>
                        <span class="checkbox_serch-txt">出稼ぎ</span>
                    </label>
                    <label>
                        <input type="hidden" name="peas" value="0"/>
                        <input type="checkbox" name="peas" value="1" class="checkbox_serch-sqar"
                               {if $search.peas|default:"0" === "1"}checked{/if}>
                        <span class="checkbox_serch-txt">ニコイチ</span>
                    </label>
                </div>
            </div>
            <!-- 退店日-->
            <div class="white_box MMedium col_border mg_bottom10">
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
            <!--SC-->
            <div class="white_box SSmall col_border mg_bottom10">
                <p>SC</p>

                <div class="select_arrow select_scout">
                    <select id="select_scout" name="select_scout" style="width: 140px;">
                        {$scout_select}
                    </select>
                    <input type="hidden" name="scout_hidden" value="" id="scout_hidden"/>
                </div>
            </div>
            <!--出戻り・移籍・紹介-->
            <div class="white_box SSSmall col_border mg_bottom10">
                <p>出戻り・移籍・紹介</p>

                <div class="select_arrow select_move">
                    <select id="select_move" name="select_move" style="width:190px;">
                        {$move_select}
                    </select>
                    <input type="hidden" name="move_hidden" value="" id="move_hidden"/>
                </div>
            </div>
            <button type="submit" class="btn_orange kensaku" value="1" name="search">
                検索
            </button>
        </div>
    </form>
    </section>
    {foreach from=$result name="result" item=value key=key}
        <section>
            <div class="girl_info_col container">
{*                {assign var="count" value=$smarty.foreach.result.index}*}
{*                {assign var="total" value=$smarty.foreach.result.total}*}
{*                {assign var="no" value=$total-$count}*}
                <h1>No.{$value.number}</h1>

                <div class="left_col">
                    <ul class="btn_list_1">
                        <li><a href="/inputdata/data/{$value.id}" style="display: block;">編集</a></li>
                        <!-- <li><a href="#">採用情報に送信</a></li> -->
                        {if isset($userData.group) && $userData.group == 1}
                            <li><a class="delete_btn" data-id="{$value.id}" style="display: block;">採用情報からの削除</a></li>
                        {/if}
                    </ul>
                    {if isset($userData.group) && $userData.group == 1}
                    <ul class="btn_list_2">
                        <li>
                            <form action="/scout/mail_send_shop" method="post">
                                {*<button type="submit" name="search" style="font-size: 13px;color: #FFF;border: 0;width: 100%;height: 100%;background: transparent;">*}
                                    {*オファーメールに追加する*}
                                {*</button>*}

                                <input type="submit" value="オファーメールに追加する" name="submit"  style="font-size: 13px;color: #FFF;border: 0;width: 100%;height: 100%;background: transparent;"/>
                                <input type="hidden" name="check_id[{$masterData["belonging_store"][$value.belonging_store]|default:"不明"}][]" value="{$value.id}">
                            </form>
                        </li>
                        <!-- <li><a href="#">追跡日時設定</a></li>-->
                    </ul>
                    {/if}
                    <div class="girls_info_img">
                        {if isset($value.image[0].img_id)}
                            <img src="/img/girl_image/{$value.image[0].img_id}/{$value.image[0].img_id}.{$value.image[0].ext}?{$smarty.now}"
                                 alt=""/>
                        {/if}
                    </div>

                </div>

                <div class="right_col">

                    <div class="girl_info_item_wrap">
                        <div class="girl_info_item_1">ID.<span>{$value.id}</span>
                        </div>
                        <div class="girl_info_item_1">申込日<span>{$value.submission_date|date_format:"%Y年%m月%d日"}</span>
                        </div>
                        <div class="girl_info_item_1">申込時間<span>{$value.submission_hour}:{$value.submission_time|default:"—"}</span>
                        </div>
                        <div class="girl_info_item_1">申込名<span>{$value.submission_name|default:"—"}</span></div>
                    </div>

                    <div class="girl_info_item_wrap mg_bottom50">
                        <div class="girl_info_item_1">面接予定時間<span>{$value.interview_hour|default:"—"}
                                :{$value.interview_time|default:"—"}</span></div>
                        <div class="girl_info_item_1">
                            面接店舗<span>{$masterData.interviewshop[$value.interviewshop]|default:"—"}</span></div>
                        <div class="girl_info_item_1">待ち合わせ場所<span>{$masterData.place[$value.place]|default:"—"}</span>
                        </div>
                    </div>

                    <div class="girl_info_item_wrap">
                        <div class="girl_info_item_1">
                            面接日<span>{$value.interview_date|date_format:"%Y年%m月%d日"|default:"—"}</span></div>
                        <div class="girl_info_item_1">
                            面接結果<span>{$masterData.interview_result[$value.interview_result]|default:"—"}</span></div>
                        <div class="girl_info_item_1">
                            面接担当<span>{$masterData.staff[$value.interview_staff]|default:"—"}</span></div>
                        <div class="girl_info_item_1">
                            面接サブ<span>{$masterData.staff[$value.interview_staff_sub]|default:"—"}</span></div>
                        <div class="girl_info_item_1">KS担当<span>{$masterData.staff[$value.ks_staff]|default:"—"}</span>
                        </div>
                    </div>

                    <div class="girl_info_item_wrap">
                        <div class="girl_info_item_1">
                            所属店舗<span>{$masterData.belonging_store[$value.belonging_store]|default:"—"}</span></div>
                        <div class="girl_info_item_1">源氏名<span>{$value.genji_name|default:"—"}</span></div>
                        <div class="girl_info_item_1">給料<span>{$value.salary|default:"—"}</span>円</div>
                        <div class="girl_info_item_1">特別指名<span>{$value.nomination_fee|default:"—"}</span>円</div>
                        <div class="girl_info_item_1">勤務形態<span>{$masterData.work[$value.work]|default:"—"}</span>
                        </div>
                    </div>

                    <div class="girl_info_item_wrap">
                        <div class="girl_info_item_1">名前<span>{$value.surname|default:"—"}　{$value.name|default:"—"}
                                （{$value.surnamekana|default:"—"}　{$value.namekana|default:"—"}）</span></div>
                        <div class="girl_info_item_1">年齢<span>{$value.age|default:"—"}</span></div>
                        <div class="girl_info_item_1">住所<span>{$setting_data["pref_name"][$value.pref]|default:"—"} {$value.address|default:"—"}</span></div>
                    </div>

                    <div class="girl_info_item_wrap">

                        <div class="girl_info_item_1">身長<span>{$value.tall|default:"—"}</span>cm</div>
                        <div class="girl_info_item_1">体重<span>{$value.weight|default:"—"}</span>kg</div>
                        <div class="girl_info_item_1">
                            バスト<span>{$value.bust|default:"—"}</span>cm<span>{$setting_data.cup_data[$value.cup]|default:"—"}</span>cup
                        </div>
                        <div class="girl_info_item_1">ウエスト<span>{$value.waist|default:"—"}</span>cm</div>
                        <div class="girl_info_item_1">ヒップ<span>{$value.hip|default:"—"}</span>cm</div>
                    </div>

                    <div class="girl_info_item_wrap">
                        <div class="girl_info_item_1">TEL<span>{$value.tel01}</span><span>{$value.tel02}</span><span>{$value.tel03}</span></div>
                        <div class="girl_info_item_1">
                            Mail<span>{$value.mail01|default:"—"}</span>@<span>{$value.maildomain|default:"—"}</span>
                        </div>
                    </div>
                    <div class="girl_info_item_wrap">
                        <div class="girl_info_item_1">経験
                            {foreach from=","|explode:$value.experience item="experience"}
                            <span>{$masterData.experience[$experience]|default:""}</span>
                            {/foreach}
                        </div>
                        <div class="girl_info_item_1">経験備考<span>{$value.experience_remarks|default:"—"}</span></div>
                    </div>

                    <div class="girl_info_item_wrap">
                        <div class="girl_info_item_1">身分証
                            {foreach from=","|explode:$value.identity_card_select item="identity_card_select"}
                                <span>{$masterData.person[$identity_card_select]|default:""}</span>
                            {/foreach}
                        </div>
                        <div class="girl_info_item_1">身分証備考<span>{$value.identity_card_remarks|default:"—"}</span></div>
                    </div>

                    <div class="girl_info_item_wrap">
                        <div class="girl_info_item_1">
                            掲載媒体<span>{$masterData.publicity[$value.publicity]|default:"—"}</span></div>
                        <div class="girl_info_item_1">掲載求人<span>{$masterData.media[$value.media]|default:"—"}</span>
                        </div>
                        <div class="girl_info_item_1">掲載業種<span>{$masterData.genre[$value.genre]|default:"—"}</span>
                        </div>
                    </div>

                    <div class="girl_info_item_wrap">
                        <div class="girl_info_item_1">SC<span>{$value.scout|default:"—"}</span></div>
                        <div class="girl_info_item_1">出戻り・移籍<span>{$masterData.move[$value.move]|default:"—"}</span>
                        </div>
                    </div>

                    <div class="girl_info_item_wrap">
                        <div class="girl_info_item_1">検索ワード
                            {if isset($masterData.word[$value.word1])}
                                <span>{$masterData.word[$value.word1]}</span>
                            {/if}
                            {if isset($masterData.word[$value.word2])}
                                <span>{$masterData.word[$value.word2]}</span>
                            {/if}
                            {if isset($masterData.word[$value.word3])}
                                <span>{$masterData.word[$value.word3]}</span>
                            {/if}
                            {if isset($masterData.word[$value.word4])}
                                <span>{$masterData.word[$value.word4]}</span>
                            {/if}
                            {if isset($masterData.word[$value.word5])}
                                <span>{$masterData.word[$value.word5]}</span>
                            {/if}
                            {if isset($masterData.word[$value.word6])}
                                <span>{$masterData.word[$value.word6]}</span>
                            {/if}
                        </div>
                        <div class="girl_info_item_1">検索ワード備考<span>{$value.word_remarks|default:"—"}</span></div>
                    </div>

                    <div class="girl_info_item_wrap">
                        <div class="girl_info_item_1 radio_item"><img
                                    src="/assets/img/btn_radio{if $value.working_away_flg === "1"}_active{/if}.png"
                                    width="18"><span>出稼ぎ</span></div>
                        <div class="girl_info_item_1 radio_item"><img
                                    src="/assets/img/btn_radio{if $value.nikoiti_flg === "1"}_active{/if}.png"
                                    width="18"><span>ニコイチ</span></div>
                        <div class="girl_info_item_1 radio_item"><img
                                    src="/assets/img/btn_radio{if $value.scout_mail_flg === "1"}_active{/if}.png"
                                    width="18"><span>オファーメールからの申込</span></div>
                    </div>

                    <div class="girl_info_item_wrap">
                        <div class="girl_info_item_1">
                            他店紹介<span>{$masterData.another_shop[$value.another_shop]|default:"—"}</span></div>
                        <div class="girl_info_item_1">他店紹介備考<span>{$value.another_shop_remarks|default:"—"}</span></div>
                    </div>

                    <div class="girl_info_item_wrap">
                        <div class="girl_info_item_1">退店日<span>{$value.leaving_date|date_format:"%Y年%m月%d日"|default:"—"}</span>
                        </div>
                        <div class="girl_info_item_1">
                            退店理由<span>{$masterData.leaving_reason[$value.leaving_reason]|default:"—"}</span></div>
                    </div>


                </div>
                <!-- /right_col -->

                <div class="bottom_col">
                    <div class="girl_info_item_wrap">
                        <div class="girl_info_day">初回出勤日　<span>{$value.working_day_date|date_format:"%Y年%m月%d日"|default:"—"}</span>
                        </div>
                    </div>
                    <div class="girl_info_item_2">備考</div>
                    <div class="girl_info_item_3">
                        {$value.remarks|default:"—"|nl2br}
                    </div>

                    <!-- <div class="girl_info_item_5"></div> -->
                </div>

            </div>
        </section>
    {/foreach}

    {$pager}
<br /><br /><br />
</article>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

{literal}
<script>
    $(function () {
        $('.btn_orange').click(function () {

            var select_result = $('#select_result').multipleSelect('getSelects');
            $('#result_hidden').val(select_result);

            var select_staff = $('#select_staff').multipleSelect('getSelects');
            $('#interview_staff_hidden').val(select_staff);

            var select_belonging_store = $('#select_belonging_store').multipleSelect('getSelects');
            $('#belonging_store_hidden').val(select_belonging_store);

            var select_media = $('#select_media').multipleSelect('getSelects');
            $('#media_hidden').val(select_media);

            var select_scout = $('#select_scout').multipleSelect('getSelects');
            $('#scout_hidden').val(select_scout);

            var select_move = $('#select_move').multipleSelect('getSelects');
            $('#move_hidden').val(select_move);
        });

        $('#select_result').multipleSelect('setSelects', [{/literal}{$search.result_hidden|default:""}{literal}]);
        $('#select_staff').multipleSelect('setSelects', [{/literal}{$search.interview_staff_hidden|default:""}{literal}]);
        $('#select_belonging_store').multipleSelect('setSelects', [{/literal}{$search.belonging_store_hidden|default:""}{literal}]);
        $('#select_media').multipleSelect('setSelects', [{/literal}{$search.media_hidden|default:""}{literal}]);
        $('#select_scout').multipleSelect('setSelects', [{/literal}{$search.scout_hidden|default:""}{literal}]);
        $('#select_move').multipleSelect('setSelects', [{/literal}{$search.move_hidden|default:""}{literal}]);

        //データ消去アラート
        $('.delete_btn').on('click', function () {
            var dataid = $(this).attr("data-id");

            var options = {
                title: 'No.' + dataid + 'のデータを採用情報から削除しますか？'
            };

            swal(options)
                    .then(function (val) {
                        if (val === true) {
                            $.ajax({
                                type: "POST",
                                url: "/api/del_careers_data",
                                cache: false,
                                data: {
                                    'dataid': dataid
                                },
                                timeout: 10000
                            }).done(function (data) {
                                location.href = "/";
                            });
                        }
                    });
        });
    });
</script>
{/literal}

{include file=$smarty.const.ADMIN_FOOTER}