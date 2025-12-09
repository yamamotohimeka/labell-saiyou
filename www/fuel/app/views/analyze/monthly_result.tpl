{include file=$smarty.const.ADMIN_HEADER}


<article>
    <section class="top_content_wrap">
    </section>
    <section id="analyze_monthly">
        <div class="container analyze_wrap date_info_col">
            <h1 class="breadcrumb">&gt;&nbsp;集計</h1>
            {include file=$smarty.const.ANALYZE_MENU}

            {* TODO after *}
            <div class="analyze_result_inner">
                <header class="analyze_result_header bold">
                    <h2 class="analyze_result_title">月間集計</h2>
                    <time datetime="">【日付】{$smarty.get.interview_year_from|default:"-"}.{$smarty.get.interview_month_from|default:"-"}.{$smarty.get.interview_day_from|default:"-"}～{$smarty.get.interview_year_to|default:"-"}.{$smarty.get.interview_month_to|default:"-"}.{$smarty.get.interview_day_to|default:"-"}</time>
                </header>

                <div class="analyze_table_wrapper table_col_2">
                    {* 全店舗合計(採用/不採用/撃沈/合計) *}
                    {assign var="interview_result_saiyou_total" value=0}
                    {assign var="interview_result_fusaiyou_total" value=0}
                    {assign var="interview_result_gekichin_total" value=0}
                    {foreach from=$result.detail_result item=value key=key}
                        {foreach from=$masterData.interview_result item=value2 key=key2}
                            {assign var="saiyou" value=0}
                            {assign var="fusaiyou" value=0}
                            {assign var="gekichin" value=0}
                            {if     $masterData.interview_result[$key2] == "採用(当日入店)" || $masterData.interview_result[$key2] == "採用(後日入店)"}
                                {assign var="saiyou" value=$result.detail_result[$key][$key2]|default:0}
                                {assign var="interview_result_saiyou_total" value="`$interview_result_saiyou_total + $saiyou`"}
                            {elseif $masterData.interview_result[$key2] == "不採用" || $masterData.interview_result[$key2] == "不採用(他店グループ紹介)"}
                                {assign var="fusaiyou" value=$result.detail_result[$key][$key2]|default:0}
                                {assign var="interview_result_fusaiyou_total" value="`$interview_result_fusaiyou_total + $fusaiyou`"}
                            {elseif $masterData.interview_result[$key2] == "撃沈" || $masterData.interview_result[$key2] == "撃沈(他店グループ紹介)"}
                                {assign var="gekichin" value=$result.detail_result[$key][$key2]|default:0}
                                {assign var="interview_result_gekichin_total" value="`$interview_result_gekichin_total + $gekichin`"}
                            {/if}
                        {/foreach}
                    {/foreach}

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
                        <tr>
                            <th class="table_right_db">全店</th>
                            <td>{$interview_result_saiyou_total}</td>
                            <td>{$interview_result_fusaiyou_total}</td>
                            <td>{$interview_result_gekichin_total}</td>
                            <td class="table_left_db">{$interview_result_saiyou_total + $interview_result_fusaiyou_total + $interview_result_gekichin_total}</td>
                        </tr>
                        </tbody>
                    </table>

                    {* 全店舗合計(求人/SC/出戻り/紹介/移籍) *}
                    <table class="analyze_table">
                        <thead class="table_row_2">
                        <tr>
                            <th colspan="5">採用</th>
                        </tr>
                        <tr>
                            <th>求人</th>
                            <th>SC</th>
                            <th>出戻り</th>
                            <th>紹介</th>
                            <th>移籍</th>
                        </tr>
                        </thead>

                        {assign var="count_total_media" value=0}
                        {assign var="count_total_scout" value=0}
                        {assign var="count_total_demodori" value=0}
                        {assign var="count_total_syoukai" value=0}
                        {assign var="count_total_iseki" value=0}
                        {foreach from=$result.detail_result item=value key=key}

                             {*media : 求人*}
                            {assign var="count_media" value=$result.media[$key]|default:0}
                            {assign var="count_total_media" value="`$count_total_media + $count_media`"}

                             {*scout : SC*}
                            {assign var="count_scout" value=$result.scout[$key]|default:0}
                            {assign var="count_total_scout" value="`$count_total_scout + $count_scout`"}

                             {*move : 出戻り/紹介/移籍*}
                            {if !empty($result.move[$key])}
                            {foreach from=$result.move[$key] item=value2 key=key2}
                                {assign var="count_demodori" value=0}
                                {assign var="count_syoukai" value=0}
                                {assign var="count_iseki" value=0}
                                {if $result.move[$key][$key2]["move"] > 0}
                                    {assign var="move"  value=$masterData.move[$result.move[$key][$key2]["move"]]|default:"不明"}
                                    {if     $move == "出戻り"}
                                        {assign var="count_demodori" value=$result.move[$key][$key2]["count"]|default:0}
                                        {assign var="count_total_demodori" value="`$count_total_demodori + $count_demodori`"}
                                    {elseif $move == "紹介"}
                                        {assign var="count_syoukai" value=$result.move[$key][$key2]["count"]|default:0}
                                        {assign var="count_total_syoukai" value="`$count_total_syoukai + $count_syoukai`"}
                                    {elseif $move == "移籍"}
                                        {assign var="count_iseki" value=$result.move[$key][$key2]["count"]|default:0}
                                        {assign var="count_total_iseki" value="`$count_total_iseki + $count_iseki`"}
                                    {/if}
                                {/if}
                            {/foreach}
                            {/if}
                        {/foreach}

                        <tr>
                            <td>{$count_total_media}</td>
                            <td>{$count_total_scout}</td>
                            <td>{$count_total_demodori}</td>
                            <td>{$count_total_syoukai}</td>
                            <td>{$count_total_iseki}</td>
                        </tr>
                    </table>

                     {*各店舗詳細(採用/不採用/撃沈/合計)*}
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

                        {foreach from=$result.detail_result item=value key=key}
                            {assign var="interview_result_total" value=0}
                            <tr>
                                <th class="table_right_db">{$masterData.belonging_store[$key]|default:"不明"}</th>
                                {assign var="saiyou" value=0}
                                {assign var="fusaiyou" value=0}
                                {assign var="gekichin" value=0}
                                {foreach from=$masterData.interview_result item=value2 key=key2}
                                    {assign var="count" value=$result.detail_result[$key][$key2]|default:0}
                                    {if     $masterData.interview_result[$key2] == "採用(当日入店)" || $masterData.interview_result[$key2] == "採用(後日入店)"}
                                        {assign var="saiyou" value="`$saiyou + $count`"}
                                    {elseif $masterData.interview_result[$key2] == "不採用" || $masterData.interview_result[$key2] == "不採用(他店グループ紹介)"}
                                        {assign var="fusaiyou" value="`$fusaiyou + $count`"}
                                    {elseif $masterData.interview_result[$key2] == "撃沈" || $masterData.interview_result[$key2] == "撃沈(他店グループ紹介)"}
                                        {assign var="gekichin" value="`$gekichin + $count`"}
                                    {/if}
                                    {assign var="interview_result_total" value="`$saiyou + $fusaiyou + $gekichin`"}
                                {/foreach}
                                <td>{$saiyou}</td>
                                <td>{$fusaiyou}</td>
                                <td>{$gekichin}</td>
                                <td class="table_left_db">{$interview_result_total}</td>
                            </tr>
                        {/foreach}
                    </table>

                    {* 各店舗詳細(求人/SC/出戻り/紹介/移籍) *}
                    <table class="analyze_table">
                        <thead class="table_row_2">
                        <tr>
                            <th colspan="5">採用</th>
                        </tr>
                        <tr>
                            <th>求人</th>
                            <th>SC</th>
                            <th>出戻り</th>
                            <th>紹介</th>
                            <th>移籍</th>
                        </tr>
                        </thead>

                        {foreach from=$result.detail_result item=value key=key}
                            <tr>
{*                                 media : 求人*}
                                {assign var="count_media" value=0}
                                {assign var="count_media" value=$result.media[$key]|default:0}

{*                                 scout : SC*}
                                {assign var="count_scout" value=0}
                                {assign var="count_scout" value=$result.scout[$key]|default:0}

{*                                move : 出戻り/紹介/移籍*}
                                {if !empty($result.move[$key])}
                                    {assign var="count_demodori" value=0}
                                    {assign var="count_syoukai" value=0}
                                    {assign var="count_iseki" value=0}
                                    {foreach from=$result.move[$key] item=value2 key=key2}
                                        {if $result.move[$key][$key2]["move"] > 0}
                                            {assign var="move"  value=$masterData.move[$result.move[$key][$key2]["move"]]|default:"不明"}
                                            {if     $move == "出戻り"}
                                                {assign var="count_demodori" value=$result.move[$key][$key2]["count"]|default:0}
                                            {elseif $move == "紹介"}
                                                {assign var="count_syoukai" value=$result.move[$key][$key2]["count"]|default:0}
                                            {elseif $move == "移籍"}
                                                {assign var="count_iseki" value=$result.move[$key][$key2]["count"]|default:0}
                                            {/if}
                                        {/if}
                                    {/foreach}
                                {/if}
                                <td>{$count_media}</td>
                                <td>{$count_scout}</td>
                                <td>{$count_demodori|default:0}</td>
                                <td>{$count_syoukai}</td>
                                <td>{$count_iseki|default:0}</td>
                            </tr>
                        {/foreach}

                    </table>
                </div>
            </div><!-- analyze_result_inner-->

        </div>
    </section>
</article>

{literal}
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.14.0/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.3/FileSaver.min.js"></script>
<script>
    $('#dl-excel').click(function () {
        var wopts = {
            bookType: 'xlsx',
            bookSST: false,
            type: 'binary'
        };

        var workbook = {SheetNames: [], Sheets: {}};

        document.querySelectorAll('table.table-to-export').forEach(function (currentValue, index) {
            var n = currentValue.getAttribute('data-sheet-name');
            if (!n) {
                n = 'Sheet' + index;
            }
            workbook.SheetNames.push(n);
            workbook.Sheets[n] = XLSX.utils.table_to_sheet(currentValue, wopts);
        });

        var wbout = XLSX.write(workbook, wopts);

        function s2ab(s) {
            var buf = new ArrayBuffer(s.length);
            var view = new Uint8Array(buf);
            for (var i = 0; i != s.length; ++i) {
                view[i] = s.charCodeAt(i) & 0xFF;
            }
            return buf;
        }

        var workbookname = $(".table.table-to-export").attr('data-sheet-name');

        workbookname = workbookname + '{/literal}{$smarty.get.submission_year_from|default:"-"}.{$smarty.get.submission_month_from|default:"-"}〜{$smarty.get.submission_month_to|default:"-"}{literal}';
        saveAs(new Blob([s2ab(wbout)], {type: 'application/octet-stream'}), workbookname + '.xlsx');
    });
</script>
{/literal}

{include file=$smarty.const.ADMIN_FOOTER}