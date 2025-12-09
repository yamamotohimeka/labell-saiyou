{include file=$smarty.const.ADMIN_HEADER}


<article>
    <section class="top_content_wrap">
    </section>
    <section class="">
        <div class="container analyze_wrap date_info_col">
            <h1 class="breadcrumb">&gt;&nbsp;集計</h1>
            {include file=$smarty.const.ANALYZE_MENU}

            <div class="analyze_result_inner">
                <header class="analyze_result_header bold">
                    <h2 class="analyze_result_title">出稼ぎ</h2>
                    <time datetime="">【日付】{$smarty.get.interview_year_from|default:"-"}.{$smarty.get.interview_month_from|default:"-"}.{$smarty.get.interview_day_from|default:"-"}～{$smarty.get.interview_year_to|default:"-"}.{$smarty.get.interview_month_to|default:"-"}.{$smarty.get.interview_day_to|default:"-"}</time>
                </header>

                <div class="analyze_table_wrapper table_col_1">
                    <div class="analyze_table_inner">
                        <table class="analyze_table">
                            <thead>
                            <tr>
                                <th class="table_right_db"></th>
                                <th>採用</th>
                                <th>不採用</th>
                                <th class="table_right_db">撃沈</th>
                                <th>合計</th>
                            </tr>
                            </thead>
                            {assign var="interview_result_count_saiyo" value=0}
                            {assign var="interview_result_count_fusaiyo" value=0}
                            {assign var="interview_result_count_gekichin" value=0}
                            {assign var="interview_result_total" value=0}
                            {if !empty($result.detail_result)}
                                {foreach from=$result.detail_result item=value key=key}
                                    {foreach from=$masterData.interview_result item=value2 key=key2}
                                        {if $key2}
                                            {assign var="interview_result_count" value=$result.detail_result[$key][$key2]|default:0}
                                            {if $value2 == "採用(当日入店)" || $value2 == "採用(後日入店)"}
                                                {assign var="interview_result_count_saiyo" value="`$interview_result_count_saiyo+$interview_result_count`"}
                                            {elseif $value2 == "不採用" || $value2 == "不採用(他店紹介)"}
                                                {assign var="interview_result_count_fusaiyo" value="`$interview_result_count_fusaiyo+$interview_result_count`"}
                                            {elseif $value2 == "撃沈" || $value2 == "撃沈(他店紹介)" }
                                                {assign var="interview_result_count_gekichin" value="`$interview_result_count_gekichin+$interview_result_count`"}
                                            {/if}
                                        {/if}
                                    {/foreach}
                                {/foreach}
                                {assign var="interview_result_total" value="`$interview_result_count_saiyo+$interview_result_count_fusaiyo+$interview_result_count_gekichin`"}
                            {/if}

                            <tbody>
                            <tr>
                                <td class="table_right_db">全店</td>
                                <td>{$interview_result_count_saiyo}</td>
                                <td>{$interview_result_count_fusaiyo}</td>
                                <td class="table_right_db">{$interview_result_count_gekichin}</td>
                                <td>{$interview_result_total}</td>
                            </tr>
                            </tbody>
                        </table>

                        {if !empty($result.detail_result)}
{*                        <table class="analyze_table">*}
{*                            <thead>*}
{*                            <tr>*}
{*                                <th class="table_right_db"></th>*}
{*                                <th>採用</th>*}
{*                                <th>不採用</th>*}
{*                                <th class="table_right_db">撃沈</th>*}
{*                                <th>合計</th>*}
{*                            </tr>*}
{*                            </thead>*}

{*                                <tbody>*}
{*                                {foreach from=$result.detail_result item=value key=key}*}
{*                                    <tr>*}
{*                                        <th class="table_right_db">{$masterData.belonging_store[$key]|default:"不明"}</th>*}
{*                                        {assign var="interview_result_count_saiyo" value=0}*}
{*                                        {assign var="interview_result_count_fusaiyo" value=0}*}
{*                                        {assign var="interview_result_count_gekichin" value=0}*}
{*                                        {assign var="interview_result_total" value=0}*}
{*                                        {foreach from=$masterData.interview_result item=value2 key=key2}*}
{*                                            {if $key2}*}
{*                                                {assign var="interview_result_count" value=$result.detail_result[$key][$key2]|default:0}*}
{*                                                {if $value2 == "採用(当日入店)" || $value2 == "採用(後日入店)"}*}
{*                                                    {assign var="interview_result_count_saiyo" value="`$interview_result_count_saiyo+$interview_result_count`"}*}
{*                                                {elseif $value2 == "不採用" || $value2 == "不採用(他店紹介)"}*}
{*                                                    {assign var="interview_result_count_fusaiyo" value="`$interview_result_count_fusaiyo+$interview_result_count`"}*}
{*                                                {elseif $value2 == "撃沈" || $value2 == "撃沈(他店紹介)" }*}
{*                                                    {assign var="interview_result_count_gekichin" value="`$interview_result_count_gekichin+$interview_result_count`"}*}
{*                                                {/if}*}
{*                                            {/if}*}
{*                                        {/foreach}*}

{*                                        {assign var="interview_result_total" value="`$interview_result_count_saiyo+$interview_result_count_fusaiyo+$interview_result_count_gekichin`"}*}
{*                                        <td>{$interview_result_count_saiyo}</td>*}
{*                                        <td>{$interview_result_count_fusaiyo}</td>*}
{*                                        <td class="table_right_db">{$interview_result_count_gekichin}</td>*}
{*                                        <td>{$interview_result_total}</td>*}
{*                                    </tr>*}
{*                                {/foreach}*}
{*                                </tbody>*}
{*                        </table>*}

                            <table class="analyze_table">
                                <thead>
                                <tr>
                                    <th class="table_right_db">&nbsp;</th>
                                    <th>採用</th>
                                    <th>不採用</th>
                                    <th>撃沈</th>
                                    <th class="table_left_db">合計</th>
                                </tr>
                                </thead>
                                <tbody>
                                {foreach from=$result.detail_result item=value key=key}
                                    {assign var="interview_result_saiyou_total" value=0}
                                    {assign var="interview_result_fusaiyou_total" value=0}
                                    {assign var="interview_result_gekichin_total" value=0}
                                    {foreach from=$masterData.interview_result item=value2 key=key2}
                                        {assign var="saiyou" value=0}
                                        {assign var="fusaiyou" value=0}
                                        {assign var="gekichin" value=0}
                                        {if     $masterData.interview_result[$key2] == "採用(当日入店)" || $masterData.interview_result[$key2] == "採用(後日入店)"}
                                            {assign var="saiyou" value=$result.detail_result[$key][$key2]|default:0}
                                            {assign var="interview_result_saiyou_total" value="`$interview_result_saiyou_total + $saiyou`"}
                                        {elseif $masterData.interview_result[$key2] == "不採用" || $masterData.interview_result[$key2] == "不採用(他店紹介)"}
                                            {assign var="fusaiyou" value=$result.detail_result[$key][$key2]|default:0}
                                            {assign var="interview_result_fusaiyou_total" value="`$interview_result_fusaiyou_total + $fusaiyou`"}
                                        {elseif $masterData.interview_result[$key2] == "撃沈" || $masterData.interview_result[$key2] == "撃沈(他店紹介)"}
                                            {assign var="gekichin" value=$result.detail_result[$key][$key2]|default:0}
                                            {assign var="interview_result_gekichin_total" value="`$interview_result_gekichin_total + $gekichin`"}
                                        {/if}
                                    {/foreach}
                                    <tr>
                                        <th class="table_right_db">{$masterData.belonging_store[$key]|default:"不明"}</th>
                                        <td>{$interview_result_saiyou_total}</td>
                                        <td>{$interview_result_fusaiyou_total}</td>
                                        <td>{$interview_result_gekichin_total}</td>
                                        <td class="table_left_db">{$interview_result_saiyou_total + $interview_result_fusaiyou_total + $interview_result_gekichin_total}</td>
                                    </tr>
                                {/foreach}
                                </tbody>
                            </table>
                        {/if}
                    </div>
                </div>
            </div><!-- analyze_result_inner-->

        </div>
    </section>
</article>

{include file=$smarty.const.ADMIN_FOOTER}