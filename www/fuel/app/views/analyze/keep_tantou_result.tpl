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
                    <h2 class="analyze_result_title">担当別継続率</h2>
                    <time datetime="">【日付】{$smarty.get.interview_year_from|default:"-"}.{$smarty.get.interview_month_from|default:"-"}.{$smarty.get.interview_day_from|default:"-"}～{$smarty.get.interview_year_to|default:"-"}.{$smarty.get.interview_month_to|default:"-"}.{$smarty.get.interview_day_to|default:"-"}</time>
                </header>

                <div class="analyze_table_wrapper table_col_1">
                    <div class="analyze_table_inner">
                        <table class="analyze_table">
                            <thead>
                            <tr>
                                <th></th>
                                <th class="table_right_db">採用</th>
                                <th>在籍</th>
                                <th class="table_right_db">退店</th>
                                <th>継続率</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>全担当</td>
                                <td class="table_right_db">{$result.total_result.enter_count|default:"0"}</td>
                                <td>{$result.total_result.enrolled_count|default:"0"}</td>
                                <td class="table_right_db">{$result.total_result.leaving_count|default:"0"}</td>
                                <td>{$result.total_result.total_per|round:1|default:"0"}%</td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="analyze_table">
                            <thead>
                            <tr>
                                <td></td>
                                <th class="table_right_db">採用</th>
                                <th>在籍</th>
                                <th class="table_right_db">退店</th>
                                <th>継続率</th>
                            </tr>
                            </thead>
                            <tbody>
                            {foreach from=$select_staff_array item=value key=key}
                            <tr>
                                <th>{$masterData.staff[$value]|default:"不明"}</th>
                                <td class="table_right_db">{$result.interview_result[$value]['enter_count']|default:"0"}</td>
                                <td>{$result.interview_result[$value]['enrolled_count']|default:"0"}</td>
                                <td class="table_right_db">{$result.interview_result[$value]['leaving_count']|default:"0"}</td>
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