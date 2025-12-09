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
                    <h2 class="analyze_result_title">求人採用数</h2>
                    <time datetime="">【日付】{$smarty.get.interview_year_from|default:"-"}.{$smarty.get.interview_month_from|default:"-"}.{$smarty.get.interview_day_from|default:"-"}～{$smarty.get.interview_year_to|default:"-"}.{$smarty.get.interview_month_to|default:"-"}.{$smarty.get.interview_day_to|default:"-"}</time>
                </header>

                {if !empty($result)}
                <div class="analyze_table_wrapper table_col_2">
{*                     全店舗合計(採用/不採用/撃沈/合計)*}
                    {foreach from=$result.total_result item=value key=key}
                        {assign var="saiyou_horyu" value=$result.total_result[2]|default:0}
                        {assign var="saiyou" value=$result.total_result[7]|default:0}
                        {assign var="total_saiyou" value="`$saiyou_horyu + $saiyou`"}

                        {assign var="fusaiyou_taten" value=$result.total_result[5]|default:0}
                        {assign var="fusaiyou" value=$result.total_result[3]|default:0}
                        {assign var="total_fusaiyou" value="`$fusaiyou_taten + $fusaiyou`"}

                        {assign var="gekichin_taten" value=$result.total_result[6]|default:0}
                        {assign var="gekichin" value=$result.total_result[4]|default:0}
                        {assign var="total_gekichin" value="`$gekichin_taten + $gekichin`"}
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
                            <td>{$total_saiyou}</td>
                            <td>{$total_fusaiyou}</td>
                            <td>{$total_gekichin}</td>
                            <td class="table_left_db">{$total_saiyou + $total_fusaiyou + $total_gekichin}</td>
                        </tr>
                        </tbody>
                    </table>

                    {foreach from=$result.total_default_result item=value key=key}
                        {assign var="total_saiyou_horyu" value=$result.total_default_result[2]|default:0}
                        {assign var="total_saiyou" value=$result.total_default_result[7]|default:0}
                        {assign var="total_default_saiyou" value="`$total_saiyou_horyu + $total_saiyou`"}

                        {assign var="total_fusaiyou_taten" value=$result.total_default_result[5]|default:0}
                        {assign var="total_fusaiyou" value=$result.total_default_result[3]|default:0}
                        {assign var="total_default_fusaiyou" value="`$total_fusaiyou_taten + $total_fusaiyou`"}

                        {assign var="total_gekichin_taten" value=$result.total_default_result[6]|default:0}
                        {assign var="total_gekichin" value=$result.total_default_result[4]|default:0}
                        {assign var="total_default_gekichin" value="`$total_gekichin_taten + $total_gekichin`"}
                    {/foreach}
                    {foreach from=$result.total_dekasegi_result item=value key=key}
                        {assign var="total_dekasegi_saiyou_horyu" value=$result.total_dekasegi_result[2]|default:0}
                        {assign var="total_dekasegi_saiyou" value=$result.total_dekasegi_result[7]|default:0}
                        {assign var="total_dekasegi_saiyou_total" value="`$total_dekasegi_saiyou_horyu + $total_dekasegi_saiyou`"}

                        {assign var="total_dekasegi_fusaiyou_taten" value=$result.total_dekasegi_result[5]|default:0}
                        {assign var="total_dekasegi_fusaiyou" value=$result.total_dekasegi_result[3]|default:0}
                        {assign var="total_dekasegi_fusaiyou_total" value="`$total_dekasegi_fusaiyou_taten + $total_dekasegi_fusaiyou`"}

                        {assign var="total_dekasegi_gekichin_taten" value=$result.total_dekasegi_result[6]|default:0}
                        {assign var="total_dekasegi_gekichin" value=$result.total_dekasegi_result[4]|default:0}
                        {assign var="total_dekasegi_gekichin_total" value="`$total_dekasegi_gekichin_taten + $total_dekasegi_gekichin`"}
                    {/foreach}
                    <table class="analyze_table">
                        <thead class="table_row_2">
                        <tr>
                            <th colspan="3" class="table_right_bb">通常</th>
                            <th colspan="3">出稼ぎ</th>
                        </tr>
                        <tr>
                            <th>採用</th>
                            <th>不採用</th>
                            <th class="table_right_bb">撃沈</th>
                            <th>採用</th>
                            <th>不採用</th>
                            <th>撃沈</th>
                        </tr>
                        </thead>
                        <tr>
                            <td>{$total_default_saiyou}</td>
                            <td>{$total_default_fusaiyou}</td>
                            <td class="table_right_bb">{$total_default_gekichin}</td>
                            <td>{$total_dekasegi_saiyou_total}</td>
                            <td>{$total_dekasegi_fusaiyou_total}</td>
                            <td>{$total_dekasegi_gekichin_total}</td>
                        </tr>
                    </table>

{*                     各店舗詳細(採用/不採用/撃沈/合計)*}
                    {if !empty($result.detail_result)}
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
                                {assign var="saiyou_horyu" value=$value[2]|default:0}
                                {assign var="saiyou" value=$value[7]|default:0}
                                {assign var="total_saiyou" value="`$saiyou_horyu + $saiyou`"}

                                {assign var="fusaiyou_taten" value=$value[5]|default:0}
                                {assign var="fusaiyou" value=$value[3]|default:0}
                                {assign var="total_fusaiyou" value="`$fusaiyou_taten + $fusaiyou`"}

                                {assign var="gekichin_taten" value=$value[6]|default:0}
                                {assign var="gekichin" value=$value[4]|default:0}
                                {assign var="total_gekichin" value="`$gekichin_taten + $gekichin`"}

                                <td>{$total_saiyou}</td>
                                <td>{$total_fusaiyou}</td>
                                <td>{$total_gekichin}</td>
                                <td class="table_left_db">{$total_saiyou + $total_fusaiyou + $total_gekichin}</td>
                            </tr>
                        {/foreach}
                    </table>
                    {/if}

                    <table class="analyze_table">
                        <thead class="table_row_2">
                        <tr>
                            <th colspan="3" class="table_right_bb">通常</th>
                            <th colspan="3">出稼ぎ</th>
                        </tr>
                        <tr>
                            <th>採用</th>
                            <th>不採用</th>
                            <th class="table_right_bb">撃沈</th>
                            <th>採用</th>
                            <th>不採用</th>
                            <th>撃沈</th>
                        </tr>
                        </thead>
{*                         TODO そのまま全行貼り付けるとphpエラーになるため1行のみとしています start*}
                        {foreach from=$result.detail_result item=value key=key}
                            {assign var="saiyou_horyu" value=$result["interview_result"][$key]["default"][2]|default:0}
                            {assign var="saiyou" value=$result["interview_result"][$key]["default"][7]|default:0}
                            {assign var="default_saiyou" value="`$saiyou_horyu + $saiyou`"}

                            {assign var="fusaiyou_taten" value=$result["interview_result"][$key]["default"][5]|default:0}
                            {assign var="fusaiyou" value=$result["interview_result"][$key]["default"][3]|default:0}
                            {assign var="default_fusaiyou" value="`$fusaiyou_taten + $fusaiyou`"}

                            {assign var="gekichin_taten" value=$result["interview_result"][$key]["default"][6]|default:0}
                            {assign var="gekichin" value=$result["interview_result"][$key]["default"][4]|default:0}
                            {assign var="default_gekichin" value="`$gekichin_taten + $gekichin`"}


                            {assign var="dekasegi_saiyou_horyu" value=$result["interview_result"][$key]["dekasegi"][2]|default:0}
                            {assign var="dekasegi_saiyou" value=$result["interview_result"][$key]["dekasegi"][7]|default:0}
                            {assign var="dekasegi_saiyou_total" value="`$dekasegi_saiyou_horyu + $dekasegi_saiyou`"}

                            {assign var="dekasegi_fusaiyou_taten" value=$result["interview_result"][$key]["dekasegi"][5]|default:0}
                            {assign var="dekasegi_fusaiyou" value=$result["interview_result"][$key]["dekasegi"][3]|default:0}
                            {assign var="dekasegi_fusaiyou_total" value="`$dekasegi_fusaiyou_taten + $dekasegi_fusaiyou`"}

                            {assign var="dekasegi_gekichin_taten" value=$result["interview_result"][$key]["dekasegi"][6]|default:0}
                            {assign var="dekasegi_gekichin" value=$result["interview_result"][$key]["dekasegi"][4]|default:0}
                            {assign var="dekasegi_gekichin_total" value="`$dekasegi_gekichin_taten + $dekasegi_gekichin`"}
                        <tr>
                            <td>{$default_saiyou|default:0}</td>
                            <td>{$default_fusaiyou|default:0}</td>
                            <td class="table_right_bb">{$default_gekichin|default:0}</td>
                            <td>{$dekasegi_saiyou_total|default:0}</td>
                            <td>{$dekasegi_fusaiyou_total|default:0}</td>
                            <td>{$dekasegi_gekichin_total|default:0}</td>
                        </tr>
                        {/foreach}
{*                         TODO そのまま全行貼り付けるとphpエラーになるため1行のみとしています end*}
                    </table>

                </div>
                {/if}
            </div><!-- analyze_result_inner-->
        </div>
    </section>
</article>

{include file=$smarty.const.ADMIN_FOOTER}