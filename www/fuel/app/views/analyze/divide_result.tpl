{include file=$smarty.const.ADMIN_HEADER}


<article>
    <section class="top_content_wrap">
    </section>
    <section class="">
        <div class="container analyze_wrap date_info_col">
            <h1 class="breadcrumb">&gt;&nbsp;集計</h1>
            {include file=$smarty.const.ANALYZE_MENU}

            {* TODO after *}
            {* TODO analyze_wrap がなぜか効いてしまって申込時間が右上に *}
            {* TODO 和暦表示？ *}
            <div class="analyze_result_inner">
                <header class="analyze_result_header bold">
                    <h2 class="analyze_result_title">面接振り件数</h2>
                    <time datetime="">【面接日】{$smarty.get.interview_year_from|default:"-"}.{$smarty.get.interview_month_from|default:"-"}.{$smarty.get.interview_day_from|default:"-"}～{$smarty.get.interview_year_to|default:"-"}.{$smarty.get.interview_month_to|default:"-"}.{$smarty.get.interview_day_to|default:"-"}</time>
                </header>

                <div class="analyze_table_wrapper table_scrollable divide">
                    {if !empty($result.detail_result)}
                    <table class="analyze_table">
                        <thead>
                            <tr>
                                <td rowspan="2" class="split_cell"> - </td>
                                {assign var="total" value=0}
                                {foreach from=$masterData["media"] item=value2 key=key2}
                                    {if $key2}
                                        <th class="table_right_sb row_fixed1">{$value2|default:""}</th>
                                    {/if}
                                {/foreach}
                                <th class="row_fixed1 table_left_sb table_right_bb">合計</th>
                            </tr>

                            <tr>
                                {assign var="total_all" value=0}
                                {foreach from=$masterData["media"] item=value2 key=key2}
                                    {if $key2}
                                        {assign var="total" value=0}
                                        {foreach from=$result.detail_result item=value key=key}
                                            {assign var="total_count" value=$result.detail_result[$key][$key2]|default:0}
                                            {assign var="total" value="`$total+$total_count`"}
                                        {/foreach}
                                        <td class="row_fixed2">{$total}</td>
                                        {assign var="total_all" value="`$total_all+$total`"}{* 各列(縦軸)の合計 *}
                                    {/if}
                                {/foreach}
                                <td class="row_fixed2 table_left_sb table_right_bb">{$total_all}</td>{* 各列(縦軸)の合計 全体 *}
                            </tr>
                        </thead>

                        <tbody>

                        {foreach from=$result.detail_result item=value key=key}
                            <tr>
                                <th class="col_fixed">{$masterData.interviewshop[$key]|default:"不明"}</th>
                                {assign var="total" value=0}
                                {foreach from=$masterData["media"] item=value2 key=key2}
                                    {assign var="total_count" value=$result.detail_result[$key][$key2]|default:0}
                                    {if $key2}
                                        {assign var="total_count" value=$result.detail_result[$key][$key2]|default:0}
                                        {assign var="total" value="`$total+$total_count`"}
                                        <td>{$total_count|default:"0"}</td>
                                    {/if}
                                {/foreach}
                                <td class="table_left_sb table_right_bb">{$total}</td>{* 各行(横軸)の合計 *}
                            </tr>
                        {/foreach}
                        </tbody>
                    </table>
                    {/if}
                </div>
            </div><!-- analyze_result_inner-->

        </div>
    </section>
</article>

{include file=$smarty.const.ADMIN_FOOTER}