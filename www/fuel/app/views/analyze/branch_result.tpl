{include file=$smarty.const.ADMIN_HEADER}


<article>
    <section class="top_content_wrap">
    </section>
    <section class="">
        <div class="container analyze_wrap date_info_col">
            <h1 class="breadcrumb">&gt;&nbsp;集計</h1>
            {include file=$smarty.const.ANALYZE_MENU}

            {* TODO after *}
            {* TODO analyze_wrap がなぜか効いてしまって他店紹介が右上に *}
            {* TODO 和暦表示？ *}
            <div class="analyze_result_inner">
                <header class="analyze_result_header bold">
                    <h2 class="analyze_result_title">他店紹介</h2>
                    <time datetime="">【日付】{$smarty.get.interview_year_from|default:"-"}.{$smarty.get.interview_month_from|default:"-"}.{$smarty.get.interview_day_from|default:"-"}～{$smarty.get.interview_year_to|default:"-"}.{$smarty.get.interview_month_to|default:"-"}.{$smarty.get.interview_day_to|default:"-"}</time>
                </header>

                <div class="analyze_table_wrapper table_col_1">
                    <table class="analyze_table">
                        <thead>
                        <tr>
                            <th>紹介先</th>
                            <th>人数</th>
                        </tr>
                        </thead>
                        <tbody>

                        {assign var="branch_result_total" value=0}
                        {foreach from=$result.detail_result item=value key=key}
                        <tr>
                            <td>{$masterData.another_shop[$value.another_shop]|default:"不明"}</td>
                            <td>{$value.count}</td>
                            {assign var="branch_result_total" value="`$branch_result_total + $value.count`"}
                        </tr>
                        {/foreach}

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>合計</th>
                            <td>{$branch_result_total}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div><!-- analyze_result_inner-->

        </div>
    </section>
</article>

{include file=$smarty.const.ADMIN_FOOTER}