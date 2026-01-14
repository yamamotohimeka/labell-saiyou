{include file=$smarty.const.ADMIN_HEADER}

<article id="interview">
    <section class="top_content_wrap">

    </section>
    <section class="container interview_wrap">
        <h2 class="breadcrumb">&gt;&nbsp;面接予定情報</h2>
        <form action="/interview" method="get">
        <div class="interview_whitebox">
            <!-- 面接日-->
            <div class="white_box Medium">
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
                <span class="select_ymd_txt">日</span>
            </div>
            <!--面接店舗-->
            <div class="white_box clear">
                <p class="select_other_txt">面接店舗</p>
                <div class="select_arrow select_intvw select_medium">
                    <select id="select_tenpo" name="interviewshop" style="width:160px;">
                            {$shop_select}
                    </select>
                    <input type="hidden" name="interviewshop_hidden" id="interviewshop_hidden" value=""/>
                </div>
            </div>

            <!--面接店舗-->
            <div class="white_box space">
                <p class="select_other_txt">面接前確認</p>
                <div class="select_arrow select_intvw select_medium">
                    <select id="select_check" name="check" style="width:160px;">
                        {$check_select}
                    </select>
                    <input type="hidden" name="check_hidden" id="check_hidden" value=""/>
                </div>
            </div>

            <button type="submit" class="btn_orange kensaku" name="search" value="1">検索</button>
        </div><!-- /.interview_whitebox -->
            </form>
        <div class="table_cmn intvw">
            <table>
                <colgroup>
                    <col class="date-width">
                    <col class="interviewTime-width">
                    <col class="shopname-width">
                    <col class="girlname-width">
                    <col>
                    <col class="experience-width">
                    <col class="baitainame-width">
                    <col class="date-width">
                    <col class="sentdate-width">
                    <col class="">
                    <col>
                    <col>
                    <col class="intvw_conf">
                </colgroup>
                <thead>
                <tr>
                    <th class="date-width">面接日</th>
                    <th class="interviewTime-width">面接</br>時間</th>
                    <th class="shopname-width">面接店舗</th>
                    <th class="girlname-width">申込名</th>
                    <th class="">年齢</th>
                    <th class="experience-width">経験</th>
                    <th class="baitainame-width">掲載求人</th>
                    <th class="date-width">申込日</th>
                    <th class="sentdate-width">送信日</th>
                    <th class="contact-width">連絡方法</th>
                    <th class="">タイマー<br>設定時間</th>
                    <th class="intvw_conf">確認状況</th>
                    {if isset($userData.group) && $userData.group == 1}
                        <th class="intvw_conf" width="80">追跡状況</th>
                    {/if}
                </tr>
                </thead>
                {foreach from=$interview_data name="interview" item=value key=key}
                    {*『面接予定時間』の仮予約にチェックがあるデータは赤字で求人センタースタッフのログインのみ表示*}
                    {if $value.tentative_reserve_flg === "1"}
                        {if isset($userData.group) && $userData.group == 1}
                            <tr>
{                           <td class="red">{$value.interview_date|date_format:"%y.%m.%d"}（{$value.interview_weekday_ja|default:''}）</td>
                            <td class="red">{$value.interview_hour|string_format:"%02d"}:{$value.interview_time|string_format:"%02d"}</td>
                            <td class="red">{$value.interviewshop|default:""}</td>
                            <td abbr="" class="red">{if $value.nikoiti_flg === "1"}<i class="fa fa-star "></i>{/if}{$value.submission_name|default:""|truncate:7:"..."}</td>
                            <td class="red">{$value.age}</a></td>
                            <td abbr="" class="red">{$value.experience|truncate:8:"..."}</td>
                            <td class="red">{$value.media}</td>
                            <td class="red"><a href="/inputdata/data/{$value.id}">{$value.submission_date|date_format:"%y.%m.%d"}</a></td>
                            <td class="red">{$value.interview_send_date|default:""}</td>
                            <td class="red">{$value.contact|truncate:3:"..."}</td>
                            <td class="red">{$value.timer}分前</td>
                            <td style="background:{$value.check_color|default:""};{if $value.check !== "未確認"}color:#000000;{/if}">{$value.check}</td>
                            <td {if $value.stop_tracking_flg === "1"}class="chase_yellow"{/if}>{if $value.stop_tracking_flg === "1"}追跡中{/if}</td>
                            </tr>
                        {/if}
                    {else}
                        <tr>
                            <td>{$value.interview_date|date_format:"%y.%m.%d"}（{$value.interview_weekday_ja|default:''}）</td>
                            <td>{$value.interview_hour|string_format:"%02d"}:{$value.interview_time|string_format:"%02d"}</td>
                            <td>{$value.interviewshop|default:""}</td>
                            <td abbr="" >{if $value.nikoiti_flg === "1"}<i class="fa fa-star "></i>{/if}{$value.submission_name|default:""|truncate:7:"..."}</td>
                            <td>{$value.age}</a></td>
                            <td abbr="">{$value.experience|truncate:8:"..."}</td>
                            <td>{$value.media}</td>
                            <td><a href="/inputdata/data/{$value.id}">{$value.submission_date|date_format:"%y.%m.%d"}</a></td>
                            <td>{$value.interview_send_date|default:""}</td>
                            <td>{$value.contact|truncate:6:"..."}</td>
                            <td>{$value.timer}分前</td>
                            <td style="{if $value.check_color}background:{$value.check_color};{/if}{if $value.check_color && $value.check !== '未確認'}color:#e4e4e4;{/if}">
    {$value.check|truncate:8:"..."}
</td>
                            {if isset($userData.group) && $userData.group == 1}
                                <td {if $value.stop_tracking_flg === "1"}class="chase_yellow"{/if}>{if $value.stop_tracking_flg === "1"}追跡中{/if}</td>
                            {/if}
                        </tr>
                    {/if}



                {*<tr>*}
                    {*<td {if $value.tentative_reserve_flg === "1"}class="red"{/if}>{$value.interview_date|date_format:"%y.%m%d"}</td>*}
                    {*<td {if $value.tentative_reserve_flg === "1"}class="red"{/if}>{$value.interview_hour|string_format:"%02d"}:{$value.interview_time|string_format:"%02d"}</td>*}
                    {*<td {if $value.tentative_reserve_flg === "1"}class="red"{/if}>{$value.interviewshop|default:""}</td>*}
                    {*<td abbr="" {if $value.tentative_reserve_flg === "1"}class="red"{/if}>{if $value.nikoiti_flg === "1"}<i class="fa fa-star "></i>{/if}{$value.submission_name|default:""}</td>*}
                    {*<td {if $value.tentative_reserve_flg === "1"}class="red"{/if}>{$value.age}</a></td>*}
                    {*<td abbr="" {if $value.tentative_reserve_flg === "1"}class="red"{/if}>{$value.experience}</td>*}
                    {*<td {if $value.tentative_reserve_flg === "1"}class="red"{/if}>{$value.media}</td>*}
                    {*<td {if $value.tentative_reserve_flg === "1"}class="red"{/if}><a href="/inputdata/data/{$value.id}">{$value.submission_date|date_format:"%y.%m%d"}</a></td>*}
                    {*<td {if $value.tentative_reserve_flg === "1"}class="red"{/if}>{$value.interview_send_date|default:""}</td>*}
                    {*<td {if $value.tentative_reserve_flg === "1"}class="red"{/if}>{$value.contact}</td>*}
                    {*<td {if $value.tentative_reserve_flg === "1"}class="red"{/if}>{$value.timer}分前</td>*}
                    {*<td style="background:{$value.check_color|default:""};{if $value.check !== "未確認"}color:#333;{/if}">{$value.check}</td>*}
                {*</tr>*}
                {/foreach}
            </table>
        </div>
    </section>
</article>

<script>
    $(function(){
        $('.btn_orange').click(function(){
            var select_interviewshop = $('#select_tenpo').multipleSelect('getSelects');
            $('#interviewshop_hidden').val(select_interviewshop);

            var select_check = $('#select_check').multipleSelect('getSelects');
            $('#check_hidden').val(select_check);
        });

        $('#select_tenpo').multipleSelect('setSelects', [{$search.interviewshop_hidden|default:""}]);

        $('#select_check').multipleSelect('setSelects', [{$search.check_hidden|default:""}]);
    });
</script>

{include file=$smarty.const.ADMIN_FOOTER}