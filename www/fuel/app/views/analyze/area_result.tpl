{include file=$smarty.const.ADMIN_HEADER}


<article>
    <section class="top_content_wrap">

    </section>
    <section class="">
        <div class="container analyze_wrap date_info_col">
            <h1 class="breadcrumb">&gt;&nbsp;集計</h1>
            {include file=$smarty.const.ANALYZE_MENU}

            {* TODO after *}
            <div class="analyze_result_inner">
                <header class="analyze_result_header bold">
                    <h2 class="analyze_result_title">広告検索エリア</h2>
                    <time datetime="">【日付】{$smarty.get.submission_year_from|default:"-"}.{$smarty.get.submission_month_from|default:"-"}〜{$smarty.get.submission_year_to|default:"-"}.{$smarty.get.submission_month_to|default:"-"}</time>
                </header>

                <div class="analyze_table_wrapper table_col_1">
                    <div class="analyze_table_inner">
                        {if !empty($result.detail_result)}
                        {foreach from=$result.detail_result item=value key=key}
                        <h3 class="analyze_table_caption">{$masterData.media[$key]|default:"不明"}</h3>
                        <table class="analyze_table">
                            <thead>
                            <tr>
                                <th></th>
                                {assign var="loop_count" value=0}
                                {foreach from=$masterData["area"] item=value2 key=key2 name="arealoop"}
                                {if $key2}
                                <th {if $smarty.foreach.arealoop.iteration == 2} class="table_left_bb"{/if}>{$value2|default:"不明"}</th>
                                {/if}
                                {/foreach}
                                <th class="table_left_db">合計</th>
                            </tr>
                            </thead>
                            <tbody>

                            {foreach from=$value item=value3 key=key3}
                                {assign var="total" value=0}

                            <tr>
                                <td>{$masterData.publicity[$key3]|default:"不明"}</td>
                                {foreach from=$masterData["area"] item=value2 key=key2 name="arealoop"}
                                    {if $key2}
                                    {assign var="area_key" value=$key2|default:0}
                                        <td {if $smarty.foreach.arealoop.iteration == 2} class="table_left_bb"{/if}>
                                            {assign var="count" value=$value3[$area_key]|default:0}
                                            {$count|default:0}
                                        </td>
                                        {assign var="total" value="`$total+$count`"}
                                    {/if}
                                {/foreach}
                                <td class="table_left_db">{$total}</td>
                            </tr>
                            {/foreach}
                            </tbody>
                        </table>
                        {/foreach}
                        {/if}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- analyze_result_inner-->

        </div>
    </section>
</article>

{include file=$smarty.const.ADMIN_FOOTER}