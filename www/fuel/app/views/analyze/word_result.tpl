{include file=$smarty.const.ADMIN_HEADER}


<article>
    <section class="top_content_wrap">
    </section>
    <section id="analyze_word">
        <div class="container analyze_wrap date_info_col">
            <h1 class="breadcrumb">&gt;&nbsp;集計</h1>
            {include file=$smarty.const.ANALYZE_MENU}

            {* TODO after *}
            <div class="analyze_result_inner">
                <header class="analyze_result_header bold">
                    <h2 class="analyze_result_title">検索ワード</h2>
                    <time datetime="">【日付】{$smarty.get.interview_year_from|default:"-"}.{$smarty.get.interview_month_from|default:"-"}.{$smarty.get.interview_day_from|default:"-"}～{$smarty.get.interview_year_to|default:"-"}.{$smarty.get.interview_month_to|default:"-"}.{$smarty.get.interview_day_to|default:"-"}</time>
                </header>

                <div class="analyze_table_wrapper table_col_1">
                    <p class="analyze_table_annotation">★『大阪』『風俗』『求人』のワードは検索対象から除外となります。 </p>
                    <p class="analyze_table_annotation">★『SC』『出戻り』『紹介』『移籍』『オファーメールからの申し込み』は検索対象から除外となります。</p>

                    <div class="analyze_table_inner">
                        <table class="analyze_table">
{*                            <thead>*}
{*                            <tr>*}
{*                                <th colspan="3" class="ranking_head">総合　ベスト10</th>*}
{*                            </tr>*}
{*                            </thead>*}
                            <tbody>
                            {foreach from=$result.all_data item=value key=key name="all_rank_loop"}
                            <tr>
                                <td>{$smarty.foreach.all_rank_loop.index+1} 位</td>
                                <td>{$masterData["word"][$key]}</td>
                                <td>{$value}</td>
                            </tr>
                            {/foreach}

                            </tbody>
                        </table>

{*                        <table class="analyze_table">*}
{*                            <thead>*}
{*                            <tr>*}
{*                                <th colspan="3" class="ranking_head">エリア　ベスト10</th>*}
{*                            </tr>*}
{*                            </thead>*}
{*                            <tbody>*}
{*                            {foreach from=$result.area_data item=value key=key name="area_rank_loop"}*}
{*                                <tr>*}
{*                                    <td>{$smarty.foreach.area_rank_loop.index+1}</td>*}
{*                                    <td>{$masterData["word"][$key]}</td>*}
{*                                    <td>{$value}</td>*}
{*                                </tr>*}
{*                            {/foreach}*}
{*                            </tbody>*}
{*                        </table>*}

{*                        <table class="analyze_table">*}
{*                            <thead>*}
{*                            <tr>*}
{*                                <th colspan="3" class="ranking_head">業種　ベスト10</th>*}
{*                            </tr>*}
{*                            </thead>*}
{*                            <tbody>*}
{*                            {foreach from=$result.industry_data item=value key=key name="industry_rank_loop"}*}
{*                                <tr>*}
{*                                    <td>{$smarty.foreach.industry_rank_loop.index+1}</td>*}
{*                                    <td>{$masterData["word"][$key]}</td>*}
{*                                    <td>{$value}</td>*}
{*                                </tr>*}
{*                            {/foreach}*}
{*                            </tbody>*}
{*                        </table>*}

{*                        <table class="analyze_table">*}
{*                            <thead>*}
{*                            <tr>*}
{*                                <th colspan="3" class="ranking_head">待遇　ベスト10</th>*}
{*                            </tr>*}
{*                            </thead>*}
{*                            <tbody>*}
{*                            {foreach from=$result.treatment_data item=value key=key name="treatment_rank_loop"}*}
{*                                <tr>*}
{*                                    <td>{$smarty.foreach.treatment_rank_loop.index+1}</td>*}
{*                                    <td>{$masterData["word"][$key]}</td>*}
{*                                    <td>{$value}</td>*}
{*                                </tr>*}
{*                            {/foreach}*}
{*                            </tbody>*}
{*                        </table>*}

{*                        <table class="analyze_table">*}
{*                            <thead>*}
{*                            <tr>*}
{*                                <th colspan="3" class="ranking_head">その他　ベスト10</th>*}
{*                            </tr>*}
{*                            </thead>*}
{*                            <tbody>*}
{*                            {foreach from=$result.other_data item=value key=key name="other_rank_loop"}*}
{*                                <tr>*}
{*                                    <td>{$smarty.foreach.other_rank_loop.index+1}</td>*}
{*                                    <td>{$masterData["word"][$key]}</td>*}
{*                                    <td>{$value}</td>*}
{*                                </tr>*}
{*                            {/foreach}*}
{*                            </tbody>*}
{*                        </table>*}
                    </div>
                </div>
            </div><!-- analyze_result_inner-->

        </div>
    </section>
</article>


{include file=$smarty.const.ADMIN_FOOTER}