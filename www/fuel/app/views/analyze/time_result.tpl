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
                    <h2 class="analyze_result_title">申込時間</h2><br />
                    <time datetime="">【日付】{$smarty.get.submission_year_from|default:"-"}.{$smarty.get.submission_month_from|default:"-"}.{$smarty.get.submission_day_from|default:"-"}～{$smarty.get.submission_year_to|default:"-"}.{$smarty.get.submission_month_to|default:"-"}.{$smarty.get.submission_day_to|default:"-"}</time>
                </header>
                <span class="required">★ 『SC』『出戻り』『紹介』『移籍』『オファーメールからの申し込み』は検索対象から除外となります。</span>
                <br /><br />
                <div class="analyze_table_wrapper table_col_1">
                    <div class="analyze_table_inner">


                        <table class="analyze_table">
                            <thead>
                            <tr>
                                <th>掲載媒体</th>
                                <th datetime="">
                                {foreach from=$masterData["publicity"] item=value2 key=key2}
                                    {if $key2}{$value2|default:""}、{/if}
                                {/foreach}
                                </th>
                            </tr>
                            <tr>
                                <th>掲載求人</th>
                                <th datetime="">
                                    {foreach from=$masterData["media"] item=value2 key=key2}
                                        {if $key2}{$value2|default:""}、{/if}
                                    {/foreach}
                                </th>
                            </tr>
                            </thead>
                        </table>

                        {if !empty($result.detail_result)}
                        <table class="analyze_table">
                            <thead>
                            <tr>
                                <th></th>
                                {foreach from=$result.detail_result item=value key=key}
                                    <th>{$masterData.genre[$key]|default:"不明"}</th>
                                {/foreach}
                                <th class="table_left_db">合計</th>
                            </tr>
                            </thead>

                            <tbody>
                            {assign var="alltotal" value=0}
                            {foreach from=$setting_data["hour"] item=value2 key=key2}
                                <tr>
                                {if (is_numeric($key2))}
                                    <td>{$value2}時</td>
                                    {assign var="total" value=0}
                                    {foreach from=$result.detail_result item=value key=key}
                                        {assign var="count" value=$result.detail_result[$key][$key2]|default:0}
                                        {assign var="total" value="`$total+$count`"}
                                        <td>{$count|default:"0"}</td>
                                    {/foreach}
                                    <td class="table_left_db">{$total}</td>
                                    {assign var="alltotal" value="`$total+$alltotal`"}
                                {/if}
                                </tr>
                            {/foreach}
                            </tbody>
                        </table>
                            {if (!empty($key2))}
                                <table>
                                    <tbody>
                                    <tr>
                                        <th style="text-align: right;">総合計：{$alltotal}</th>
                                    </tr>
                                    </tbody>
                                </table>
                            {/if}
                        {/if}

                    </div>
                </div>
            </div><!-- analyze_result_inner-->

        </div>
    </section>
</article>


{include file=$smarty.const.ADMIN_FOOTER}