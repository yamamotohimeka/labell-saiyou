{include file=$smarty.const.ADMIN_HEADER}

<article>
    <section class="top_content_wrap">

    </section>
    <section id="chase" class="container interview_wrap">
        <h2 class="breadcrumb">&gt;&nbsp;追跡予定情報</h2>
        <p class="description">本日までの追跡予定情報を表示しています</p>
        <form action="{$base_url|default:'/'}chase" method="get">
        <div class="chase_white_box">
            <!-- ID -->
            <div class="white_box" style="width: 10%;">
                <p>ID</p>
                {$forms.search_id.html}
            </div>
            <!-- 追跡予定日-->
            <div class="white_box chase">
                <p>追跡予定日</p>
                <div class="select_arrow select_y chase">
                    {$forms.scheduled_date_year_from.html}
                </div>
                <span class="select_ymd_txt">年</span>
                <div class="select_arrow select_md chase">
                    {$forms.scheduled_date_month_from.html}
                </div>
                <span class="select_ymd_txt">月</span>

                <div class="select_arrow select_md chase">
                    {$forms.scheduled_date_day_from.html}
                </div>
                <span class="select_ymd_txt">日&nbsp;～&nbsp;</span>
                <div class="select_arrow select_y chase">
                    {$forms.scheduled_date_year_to.html}
                </div>
                <span class="select_ymd_txt">年</span>

                <div class="select_arrow select_md chase">
                    {$forms.scheduled_date_month_to.html}
                </div>
                <span class="select_ymd_txt">月</span>
                <div class="select_arrow select_md chase">
                    {$forms.scheduled_date_day_to.html}
                </div>
                <span class="select_ymd_txt">日</span>
            </div>
            <!-- 申込日-->
            <div class="white_box Medium clear">
                <p>申込日</p>
                <div class="select_arrow select_y chase">
                    {$forms.submission_year_from.html}
                </div>
                <span class="select_ymd_txt">年</span>

                <div class="select_arrow select_md chase">
                    {$forms.submission_month_from.html}
                </div>
                <span class="select_ymd_txt">月</span>

                <div class="select_arrow select_md chase">
                    {$forms.submission_day_from.html}
                </div>
                <span class="select_ymd_txt">日&nbsp;～&nbsp;</span>
                <div class="select_arrow select_y chase">
                    {$forms.submission_year_to.html}
                </div>
                <span class="select_ymd_txt">年</span>

                <div class="select_arrow select_md chase">
                    {$forms.submission_month_to.html}
                </div>
                <span class="select_ymd_txt">月</span>
                <div class="select_arrow select_md chase">
                    {$forms.submission_day_to.html}
                </div>
                <span class="select_ymd_txt">日</span>
            </div>
            <!--店舗スタッフ-->
            <div class="white_box">
                <p>店舗スタッフ</p>
                <div class="select_arrow slect_chase">
                    <select id="select_staff" name="店舗スタッフ" style="width: 130px;">
                        <optgroup label="全て選択">
                            <option value="1">店舗スタッフ</option>
                            <option value="0">キャスト</option>
                        </optgroup>
                    </select>
                    <input type="hidden" name="staff_hidden" id="staff_hidden" value=""/>
                </div>
            </div>
            <!--掲載媒体名-->
            <div class="white_box clear">
                <p>掲載媒体</p>
                <div class="select_arrow slect_chase">
                    <select id="select_publicity" name="掲載媒体" style="width: 150px;">
                        {$publicity_select}
                    </select>
                    <input type="hidden" name="publicity_hidden" id="publicity_hidden" value=""/>
                </div>
            </div>
            <!--掲載求人-->
            <div class="white_box">
                <p>掲載求人</p>
                <div class="select_arrow slect_chase">
                    <select id="select_recruit" name="掲載求人" style="width: 150px;">
                        {$recruit_select}
                    </select>
                    <input type="hidden" name="recruit_hidden" id="recruit_hidden" value=""/>
                </div>
            </div>

            <!--追跡理由-->
            <div class="white_box">
                <p>追跡理由</p>
                <div class="select_arrow slect_chase">
                    <select id="select_reason" name="追跡理由" style="width: 150px;">
                        {$reason_select}
                    </select>
                    <input type="hidden" name="reason_hidden" id="reason_hidden" value=""/>
                </div>
            </div>
            <button type="submit" class="btn_orange kensaku" name="search" value="1">検索</button>
            </form>
        </div><!-- /.chase_white_box -->

{* 追跡予定情報テーブルのヘッダー部分を修正 *}
<div class="table_cmn">
    <table>
        <thead>
        <tr>
            <th class="sortable" data-column="scheduled_date">
                追跡予定日（時）
                <span class="sort-icon" data-sort="asc">▲</span>
                <span class="sort-icon" data-sort="desc">▼</span>
            </th>
            <th class="sortable" data-column="submission_date">
                申込日
                <span class="sort-icon" data-sort="asc">▲</span>
                <span class="sort-icon" data-sort="desc">▼</span>
            </th>
            <th class="sortable" data-column="id">
                ID
                <span class="sort-icon" data-sort="asc">▲</span>
                <span class="sort-icon" data-sort="desc">▼</span>
            </th>
            <th class="sortable" data-column="media">
                掲載求人名
                <span class="sort-icon" data-sort="asc">▲</span>
                <span class="sort-icon" data-sort="desc">▼</span>
            </th>
            <th class="sortable" data-column="publicity">
                掲載媒体
                <span class="sort-icon" data-sort="asc">▲</span>
                <span class="sort-icon" data-sort="desc">▼</span>
            </th>
            <th class="sortable" data-column="submission_name">
                申込名
                <span class="sort-icon" data-sort="asc">▲</span>
                <span class="sort-icon" data-sort="desc">▼</span>
            </th>
            <th class="sortable" data-column="age">
                年齢
                <span class="sort-icon" data-sort="asc">▲</span>
                <span class="sort-icon" data-sort="desc">▼</span>
            </th>
            <th class="sortable" data-column="reason">
                追跡理由
                <span class="sort-icon" data-sort="asc">▲</span>
                <span class="sort-icon" data-sort="desc">▼</span>
            </th>
            <th class="sortable" data-column="contact">
                連絡方法
                <span class="sort-icon" data-sort="asc">▲</span>
                <span class="sort-icon" data-sort="desc">▼</span>
            </th>
        </tr>
        </thead>
        <tbody id="tracking-table-body">
        {foreach from=$tracking_data name="tracking_data" item=value key=key}
        <tr>
            <td data-sort-value="{$value.scheduled_date}">{$value.scheduled_date|date_format:"%y.%m%d"}{if isset($value.scheduled_date_hour)}（{if $value.scheduled_date_hour == 0}深夜{/if}{$value.scheduled_date_hour}時）{/if}</td>
            <td data-sort-value="{$value.submission_date}"><a href="{$base_url|default:'/'}inputdata/data/{$value.id}">{$value.submission_date|date_format:"%y.%m%d"}</a></td>
            <td data-sort-value="{$value.id}">{$value.id}</td>
            <td data-sort-value="{$value.media|default:""}">{$value.media|default:""}</td>
            <td data-sort-value="{$value.publicity|default:""}">{$value.publicity|default:""}</td>
            <td data-sort-value="{$value.submission_name|default:""}">{if $value.nikoiti_flg === "1"}<i class="fa fa-star "></i>{/if}{$value.submission_name|default:""}</td>
            <td data-sort-value="{$value.age|default:0}">{$value.age|default:""}</td>
            <td data-sort-value="{$value.reason|default:""}">{$value.reason|default:""}</td>
            <td data-sort-value="{$value.contact|default:""}">{$value.contact|default:""}</td>
        </tr>
        {/foreach}
        </tbody>
    </table>
</div><!--table_cmn -->

        <h2 class="breadcrumb">&gt;&nbsp;事前連絡日</h2>
        <p class="description">事前連絡日が当日、もしくは当日以前で連絡済みになっていないものを表示</p>
        <div class="intvw_jizen">
            <form action="{$base_url|default:'/'}chase" method="post">
            <div class="table_cmn">
                <table>
                    <tr>
                        <th class="">事前連絡日</th>
                        <th class="">面接日</th>
                        <th class="">面接時間</th>
                        <th class="">面接店舗</th>
                        <th class="">申込名</th>
                        <th class="">年齢</th>
                        <th class="">掲載求人名</th>
                        <th class="">連絡方法</th>
                        <th class="">申込日</th>
                        <th class="">送信日</th>
                        <th class="">連絡状況</th>
                    </tr>
                    {foreach from=$advance_contact_data name="advance_contact_data" item=value key=key}
                    <tr>
                        <td>{$value.advance_contact_date|date_format:"%y.%m%d"}</td>
                        <td>{$value.interview_date|date_format:"%y.%m%d"}</td>
                        <td>{$value.interview_hour|string_format:"%02d"}:{$value.interview_time|string_format:"%02d"}</td>
                        <td>{$value.interviewshop|default:""}</td>
                        <td><a href="{$base_url|default:'/'}inputdata/data/{$value.id}">{if $value.nikoiti_flg === "1"}<i class="fa fa-star "></i>{/if}{$value.submission_name|default:""}</a></td>
                        <td>{$value.age}</td>
                        <td>{$value.media}</td>
                        <td>{$value.contact}</td>
                        <td>{$value.submission_date|date_format:"%y.%m%d"}</td>
                        <td>30.0108</td>
                        <td>
                            <label>
                                <input type="checkbox" class="radio-sqar" name="contact_flg[{$value.id}]" value="1">
                                <span class="radio-txt">連絡済</span>
                            </label>
                        </td>
                    </tr>
                    {/foreach}
                </table>
            </div>
            <input type="submit" class="btn_orange conf" name="contact_submit" value="連絡済み" />

            </form>
        </div>
    </section>
</article>

<script>
    $(function(){
        $('.btn_orange').click(function(){

            var select_staff = $('#select_staff').multipleSelect('getSelects');
            $('#staff_hidden').val(select_staff);

            var select_publicity = $('#select_publicity').multipleSelect('getSelects');
            $('#publicity_hidden').val(select_publicity);

            var select_recruit = $('#select_recruit').multipleSelect('getSelects');
            $('#recruit_hidden').val(select_recruit);

            var select_reason = $('#select_reason').multipleSelect('getSelects');
            $('#reason_hidden').val(select_reason);
        });

        $('#select_staff').multipleSelect('setSelects', [{$search.staff_hidden|default:""}]);
        $('#select_publicity').multipleSelect('setSelects', [{$search.publicity_hidden|default:""}]);
        $('#select_recruit').multipleSelect('setSelects', [{$search.recruit_hidden|default:""}]);
        $('#select_reason').multipleSelect('setSelects', [{$search.reason_hidden|default:""}]);
    });
</script>

{* ソート用 JS は Smarty と波括弧が衝突するため literal。スタイルは style.css の #chase .sortable *}
{literal}
<script>
$(function(){
    var currentSort = { column: null, direction: 'asc' };

    $('.sortable').click(function() {
        var column = $(this).data('column');
        var colIndex = $(this).index();
        var tbody = $('#tracking-table-body');
        var rows = tbody.find('tr').toArray();

        if (currentSort.column === column) {
            currentSort.direction = currentSort.direction === 'asc' ? 'desc' : 'asc';
        } else {
            currentSort.direction = 'asc';
        }
        currentSort.column = column;

        $('.sortable .sort-icon').removeClass('active');
        $(this).find('[data-sort="' + currentSort.direction + '"]').addClass('active');

        rows.sort(function(a, b) {
            var aValue = $(a).children('td').eq(colIndex).attr('data-sort-value') || '';
            var bValue = $(b).children('td').eq(colIndex).attr('data-sort-value') || '';

            if (column === 'id' || column === 'age') {
                aValue = parseInt(aValue, 10) || 0;
                bValue = parseInt(bValue, 10) || 0;
                return currentSort.direction === 'asc' ? aValue - bValue : bValue - aValue;
            }

            aValue = aValue.toString().toLowerCase();
            bValue = bValue.toString().toLowerCase();

            if (currentSort.direction === 'asc') {
                return aValue < bValue ? -1 : (aValue > bValue ? 1 : 0);
            }
            return aValue > bValue ? -1 : (aValue < bValue ? 1 : 0);
        });

        tbody.empty().append(rows);
    });
});
</script>
{/literal}

{include file=$smarty.const.ADMIN_FOOTER}