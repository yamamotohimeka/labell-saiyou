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
                    <h2 class="analyze_result_title">担当別入店率</h2>
                    <time datetime="">【日付】{$smarty.get.interview_year_from|default:"-"}.{$smarty.get.interview_month_from|default:"-"}.{$smarty.get.interview_day_from|default:"-"}～{$smarty.get.interview_year_to|default:"-"}.{$smarty.get.interview_month_to|default:"-"}.{$smarty.get.interview_day_to|default:"-"}</time>
                </header>

                <div class="analyze_table_wrapper table_col_1">
                    <div class="analyze_table_inner">
                        <table class="analyze_table">
                            <thead>
                            <tr>
                                <th></th>
                                <th class="table_right_db">面接</th>
                                <th>採用</th>
                                <th>不採用</th>
                                <th class="table_right_db">撃沈</th>
                                <th>入店率</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>全担当</td>
                                <td class="table_right_db">{$result.total_result.interview_count|default:"0"}</td>
                                <td>{$result.total_result.enter_count|default:"0"}</td>
                                <td>{$result.total_result.notadopt|default:"0"}</td>
                                <td class="table_right_db">{$result.total_result.other_notadopt|default:"0"}</td>
                                <td>{$result.total_result.total_per|round:1|default:"0"}%</td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="analyze_table">
                            <thead>
                            <tr>
                                <td></td>
                                <th class="table_right_db">面接</th>
                                <th>採用</th>
                                <th>不採用</th>
                                <th class="table_right_db">撃沈</th>
                                <th>入店率</th>
                            </tr>
                            </thead>
                            <tbody>
                            {foreach from=$select_staff_array item=value key=key}
                            <tr>
                                <th>{$masterData.staff[$value]|default:"不明"}</th>
                                <td class="table_right_db">{$result.interview_result[$value]['interview_count']|default:"0"}</td>
                                <td class="table_right_db">{$result.interview_result[$value]['enter_count']|default:"0"}</td>
                                <td>{$result.interview_result[$value]['notadopt']|default:"0"}</td>
                                <td class="table_right_db">{$result.interview_result[$value]['other_notadopt']|default:"0"}</td>
                                <td>{$result.detail_result[$value]["total_per"]|round:1|default:"0"}%</td>
                            </tr>
                            {/foreach}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- analyze_result_inner-->

        </div>
    </section>
</article>

{include file=$smarty.const.ADMIN_FOOTER}