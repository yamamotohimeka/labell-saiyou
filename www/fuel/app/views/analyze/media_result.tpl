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
                    <h2 class="analyze_result_title">掲載媒体</h2>
                    <time datetime="">【日付】{$smarty.get.submission_year_from|default:"-"}.{$smarty.get.submission_month_from|default:"-"}〜{$smarty.get.submission_year_to|default:"-"}.{$smarty.get.submission_month_to|default:"-"}</time>
                </header>

                <div class="analyze_table_wrapper table_scrollable">

                    <!--div class="white_box LLarge" style="width: 95%;">
                    <span class="required">★ 掲載媒体の集計のみ他の集計と違い、ログを残す集計となっております<hr />
                        【問い】の集計タイミング<br />
                        ・新規データ入力後、更新ボタンクリックし問合せリストに登録されたタイミング<br />（＊ログの日付は申込日）<hr />
                        【面接】の集計タイミング<br />
                        ・データ入力後、確定ボタンから採用情報送信を送ったタイミング<br />（＊ログの日付はクリックした日時）<hr />
                        【入店】の集計タイミング<br />
                        ・データ入力後、確定ボタンから採用情報送信を送り、<br />
                        　尚且つ面接結果の項目が「採用（当日入店）」or「採用（後日入店）」で登録されたタイミング<br />（＊ログの日付はクリックした日時）<br />
                    </span>
                    </div-->

                    <div class="white_box LLarge" style="width: 95%;">
                    <span class="required">★ 掲載媒体の集計のみ他の集計と違い、データ入力ページでデータを【更新】か【確定】ボタンを押下したタイミングでログを残す集計となっております<hr />
                        【問い】の集計<br />
                        ・データ入力の『申込日』『掲載媒体』『掲載求人』の項目の登録があるデータ<hr />
                        【面接】の集計<br />
                        ・データ入力の『面接日』『掲載媒体』『掲載求人』『面接結果（「-」と「未選択」以外の登録）』の項目の登録があるデータ<hr />
                        【入店】の集計<br />
                        ・データ入力の『面接日』『掲載媒体』『掲載求人』『面接結果（「採用（当日入店）」と「採用（後日入店）」のどちらかの登録）』の項目の登録があるデータ<hr />
                    </span>
                    </div>

                    <table class="analyze_table">
                        <thead>
                        <tr>
                            <th class="table_split_cell" rowspan="2">
                                <div class="table_split_flex">
                                    <span>掲載媒体</span>
                                    <span>掲載求人</span>
                                </div>
                            </th>
                            {foreach from=$masterData["media"] item=media}
                                <th colspan="3" class="row_fixed1 table_right_bb">{$media|default:""}</th>
                            {/foreach}
                            <th colspan="3" class="row_fixed1 table_right_bb">合計</th>
                        </tr>

                        <tr>
                            {foreach from=$masterData["media"] item=media}
                                <th class="row_fixed2">問い</th>
                                <th class="row_fixed2">面接</th>
                                <th class="table_right_bb row_fixed2">入店</th>
                            {/foreach}
                            <th class="row_fixed2">問い</th>
                            <th class="row_fixed2">面接</th>
                            <th class="table_right_bb row_fixed2">入店</th>
                        </tr>
                        </thead>

                        <tbody>
                        {foreach from=$masterData.publicity item=publicity key=publicity_key}
                            {if $publicity_key !== ''}
                                <tr>
                                    <th class="col_fixed">{$publicity|default:"不明"}</th>

                                    {assign var="data" value=$result.items.detail_result[$publicity_key]|default:null}
                                    {assign var="row_inquiry" value=0}
                                    {assign var="row_interview" value=0}
                                    {assign var="row_adopt" value=0}
                                    {foreach from=$masterData["media"] item=media key=media_key}
                                        {if $data !== null && isset($data[$media_key])}
                                            <td>{$data[$media_key].inquiry}</td>
                                            <td>{$data[$media_key].interview}</td>
                                            <td class="table_right_bb">{$data[$media_key].adopt}</td>

                                            {assign var="inquiry" value=$data[$media_key].inquiry|default:0}
                                            {assign var="interview" value=$data[$media_key].interview|default:0}
                                            {assign var="adopt" value=$data[$media_key].adopt|default:0}
                                            {assign var="row_inquiry" value="`$inquiry+$row_inquiry`"}
                                            {assign var="row_interview" value="`$interview+$row_interview`"}
                                            {assign var="row_adopt" value="`$adopt+$row_adopt`"}
                                        {else}
                                            <td>0</td>
                                            <td>0</td>
                                            <td class="table_right_bb">0</td>
                                        {/if}
                                    {/foreach}
                                    <td>{$row_inquiry|default:"0"}</td>
                                    <td>{$row_interview|default:"0"}</td>
                                    <td class="table_right_bb">{$row_adopt|default:"0"}</td>
                                </tr>
                            {/if}
                        {/foreach}
                        </tbody>

                        <tfoot>
                        <tr>
                            {assign var="row_inquiry" value=0}
                            {assign var="row_interview" value=0}
                            {assign var="row_adopt" value=0}
                            <th class="col_fixed">合計</th>
                            {foreach from=$masterData["media"] item=media key=media_key}
                                {assign var="column_inquiry" value=0}
                                {assign var="column_interview" value=0}
                                {assign var="column_adopt" value=0}
                                {if 'detail_result'|array_key_exists:$result.items}
                                {foreach from=$result.items.detail_result item=value key=key}
                                    {assign var="inquiry" value=$value[$media_key].inquiry|default:0}
                                    {assign var="interview" value=$value[$media_key].interview|default:0}
                                    {assign var="adopt" value=$value[$media_key].adopt|default:0}
                                    {assign var="column_inquiry" value="`$inquiry+$column_inquiry`"}
                                    {assign var="column_interview" value="`$interview+$column_interview`"}
                                    {assign var="column_adopt" value="`$adopt+$column_adopt`"}
                                {/foreach}
                                {/if}
                                <td>{$column_inquiry|default:"0"}</td>
                                <td>{$column_interview|default:"0"}</td>
                                <td class="table_right_bb">{$column_adopt|default:"0"}</td>

                                {assign var="row_inquiry" value="`$row_inquiry+$column_inquiry`"}
                                {assign var="row_interview" value="`$row_interview+$column_interview`"}
                                {assign var="row_adopt" value="`$row_adopt+$column_adopt`"}
                            {/foreach}
                            <td>{$row_inquiry|default:"0"}</td>
                            <td>{$row_interview|default:"0"}</td>
                            <td class="table_right_bb">{$row_adopt|default:"0"}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div><!-- analyze_result_inner-->

        </div>
    </section>
</article>

{include file=$smarty.const.ADMIN_FOOTER}