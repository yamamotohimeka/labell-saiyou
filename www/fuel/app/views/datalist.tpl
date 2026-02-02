{include file=$smarty.const.ADMIN_HEADER}

<article>
    <section class="top_content_wrap">

    </section>
    <section id="datalist" class="container interview_wrap">
        <h2 class="breadcrumb">&gt;&nbsp;問い合わせリスト</h2>

        <form action="/datalist" method="get">
        <div class="datalist_white_box">
            <!-- ID -->
            <div class="white_box" style="width: 10%;">
                <p>ID</p>
                {$forms.search_id.html}
            </div>
            <!-- 申込日-->
            <div class="white_box Medium">
                <p>申込日</p>
                <div class="select_arrow select_y chase">
                    {$forms.submission_year_from.html}
                </div>
                <span class="select_ymd_txt">年</span>

                <div class="select_arrow select_md chase">
                    {$forms.submission_month_from.html}
                </div>
                <span class="select_ymd_txt">月</span>

                <div class="select_arrow select_md chase">
                    {$forms.submission_day_from.html}
                </div>
                <span class="select_ymd_txt">日&nbsp;～&nbsp;</span>
                <div class="select_arrow select_y chase">
                    {$forms.submission_year_to.html}
                </div>
                <span class="select_ymd_txt">年</span>

                <div class="select_arrow select_md chase">
                    {$forms.submission_month_to.html}
                </div>
                <span class="select_ymd_txt">月</span>
                <div class="select_arrow select_md chase">
                    {$forms.submission_day_to.html}
                </div>
                <span class="select_ymd_txt">日</span>
            </div>
            <!--追跡状況-->
            <div class="white_box">
                <p>追跡状況</p>
                <div class="select_arrow slect_chase">
                    <select id="select_chase" name="追跡状況" style="width:150px;">
                        <optgroup label="全て選択">
                            <option value="1">追跡中</option>
                            <option value="2">追跡中止</option>
                        </optgroup>
                    </select>

                    <input type="hidden" name="stop_tracking_flg_hidden" id="stop_tracking_flg_hidden" value="" />
                </div>
            </div>
            <!--掲載求人-->
            <div class="white_box clear datatel">
                <p>掲載求人</p>
                <div class="select_arrow slect_recruit">
                    <select id="select_media" name="media" style="width:170px;">
                        {$media_select}
                    </select>

                    <input type="hidden" name="media_hidden" id="media_hidden" value="" />
                </div>
            </div>
            <!--申込名-->
            <div class="white_box">
                <p>申込名</p>
                {$forms.submission_name.html}
            </div>
            <!--申し込み方法-->
            <div class="white_box datatel">
                <p>申込方法</p>
                <div class="select_arrow slect_recruit">
                    <select id="select_apply" name="apply" style="width:170px;">
                        {$apply_select}
                    </select>

                    <input type="hidden" name="apply_hidden" id="apply_hidden" value="" />
                </div>
            </div>
            <!--TEL-->
            <div class="white_box datatel">
                <p>TEL</p>
                {$forms.tel01.html}<span class="hyphen">-</span>{$forms.tel02.html}<span class="hyphen">-</span>{$forms.tel03.html}
            </div>
            <!--メール-->
            <div class="white_box datatel">
                <p>メール</p>
                {$forms.mail.html}
            </div>
            <!-- 名前-->
            <div class="white_box XMedium">
                <p>名前</p>
                <p class="txt">姓</p>{$forms.surname.html}
                <p class="txt">名</p>{$forms.name.html}
            </div>
            <!-- 名前(ふりがな)-->
            <div class="white_box XMedium clear">
                <p>名前(ふりがな)</p>
                <p class="txt">姓</p>{$forms.surnamekana.html}
                <p class="txt">名</p>{$forms.namekana.html}
            </div>
            <!--面接結果-->
            <div class="white_box">
                <p>面接結果</p>
                <div class="select_arrow slect_chase">
                    <select id="select_result" name="select_result" style="width:110px;">
                        {$interview_result_select}
                    </select>

                    <input type="hidden" name="interview_result_hidden" id="interview_result_hidden" value="" />
                </div>
            </div>
            <button type="submit" name="search" value="1" class="btn_orange kensaku">検索
            </button>
        </div><!-- /.datalist_white_box -->
        </form>


        <div class="datalist_sort">
        <a href="{$smarty.server.REQUEST_URI}{if $smarty.server.QUERY_STRING != '/datalist'}&sort=submission_date{else}?sort=submission_date{/if}">申し込み日順▼</a>
        |
        <a href="{$smarty.server.REQUEST_URI}{if $smarty.server.QUERY_STRING != '/datalist'}&sort=updated_at{else}?sort=updated_at{/if}">更新順▼</a>　
            <span class="required">※背景色が黄色の女の子は面接予定情報がある女の子です。</span>
        </div>

        <div class="table_cmn">
            <table>
                <colgroup>
                    <col>
                    <col>
                    <col>
                    <col>
                    <col>
                    <col>
                    <col>
                    <col>
                    <col>
                    <col>
                    <col>
                    <col>
                    <col>
                </colgroup>
                <thead>
                <tr>
                    <th>申込日</th>
                    <th>ID</th>
                    <th >掲載求人</th>
                    <th>掲載媒体</th>
                    <th>申込名</th>
                    <th>申込方法</th>
                    <th>名前</th>
                    <th>年齢</th>
                    <th>TEL</th>
                    <th>MAIL</th>
                    <th>進捗</th>
                    <th>面接結果</th>
                    <th>追跡状況</th>
                </tr>
                </thead>
                {foreach from=$result item=value key=key}
                <tr{if $value.interview_send == 1 AND $value.status <= 1 } style="background-color: #F6DFA4;"{/if}>
                    <td><a href="/inputdata/data/{$value.id}">{$value.submission_date|date_format:"%y.%m.%d"}</a></td>
                    <td>{$value.id}</td>
                    <td>{$value.media|truncate:13:'...':true}</td>
                    <td>{$value.publicity|truncate:7:"..."}</td>
                    <td>{if $value.nikoiti_flg === "1"}<i class="fa fa-star "></i>{/if}{$value.submission_name|default:""|truncate:8:"..."}</td>
                    <td>{$value.apply|default:""}</td>
                    <td>{$value.surname|default:""}{$value.name|default:""}</td>
                    <td>{$value.age|default:""}</td>
                    <td>{$value.tel01|default:""}-{$value.tel02|default:""}-{$value.tel03|default:""}</td>
                    <td>
                        {if $value.mail01|default:"" !== "" AND $value.maildomain|default:"" !== ""}
                        {$value.mail01|default:""}@{$value.maildomain|default:""|truncate:5:"..."}
                        {/if}
                    </td>
                    <td>{$value.check|truncate:5:"..."}</td>
                    <td{if !empty($value.interview_result) } style="background-color: #DB1817cc;color: #fff;"{/if}>{$value.interview_result|truncate:6:"..."}</td>
                    <td {if $value.stop_tracking_flg === "1"}class="chase_yellow"{/if}>{if $value.stop_tracking_flg === "1"}追跡中{/if}</td>
                </tr>
                {/foreach}
            </table>

            {$pager}
        </div><!--table_cmn -->

    </section>
</article>

<script>
    $(function(){
        $('.btn_orange').click(function(){
            var select_chase = $('#select_chase').multipleSelect('getSelects');
            $('#stop_tracking_flg_hidden').val(select_chase);

            var select_media = $('#select_media').multipleSelect('getSelects');
            $('#media_hidden').val(select_media);

            var select_apply = $('#select_apply').multipleSelect('getSelects');
            $('#apply_hidden').val(select_apply);

            var select_result = $('#select_result').multipleSelect('getSelects');
            $('#interview_result_hidden').val(select_result);
        });

        $('#select_chase').multipleSelect('setSelects', [{$search.stop_tracking_flg_hidden|default:""}]);

        $('#select_media').multipleSelect('setSelects', [{$search.media_hidden|default:""}]);

        $('#select_apply').multipleSelect('setSelects', [{$search.apply_hidden|default:""}]);

        $('#select_result').multipleSelect('setSelects', [{$search.interview_result_hidden|default:""}]);
    });
</script>


{include file=$smarty.const.ADMIN_FOOTER}