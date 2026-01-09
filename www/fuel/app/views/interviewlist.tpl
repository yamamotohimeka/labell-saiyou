<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
<title>面接予定一覧</title>
    <link rel="stylesheet" href="/assets/css/base.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/input.css">
    <link rel="stylesheet" href="/assets/css/scout.css">
    <link rel="stylesheet" href="/assets/css/multiple-select.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body id="intv_list">

<form>
    <!-- 面接日-->
    <div class="white_box SLarge">
        <p>面接日</p>
        <div class="select_arrow select_y">
            {$forms.interview_date_year_from.html}
        </div>
        <span class="select_ymd_txt">年</span>
        <div class="select_arrow select_md">
            {$forms.interview_date_month_from.html}
        </div>
        <span class="select_ymd_txt">月</span>
        <div class="select_arrow select_md">
            {$forms.interview_date_day_from.html}
        </div>
        <span class="select_ymd_txt">日&nbsp;～&nbsp;</span>
        <div class="select_arrow select_y">
            {$forms.interview_date_year_to.html}
        </div>
        <span class="select_ymd_txt">年</span>
        <div class="select_arrow select_md">
            {$forms.interview_date_month_to.html}
        </div>
        <span class="select_ymd_txt">月</span>
        <div class="select_arrow select_md">
            {$forms.interview_date_day_to.html}
        </div>
        <span class="select_ymd_txt">日</span>
    </div>
    <!--面接店舗-->

    <div class="white_box">
        <p class="select_other_txt">面接店舗</p>
        <div class="select_arrow select_intvw select_medium">
            <select id="select_tenpo" name="面接店舗" style="width: 160px; display: none;">
                {$interviewshop_select}
            </select>
            <input type="hidden" name="tenpo_hidden" id="tenpo_hidden" value="" />
        </div>
    </div>
    <div class="intv_list_btn">
        <input type="submit" value="検索" class="btn_orange" name="search">
    </div>
</form>
<table class="intrv_sch">
    <thead>
    <tr>
        <th>面接日</th>
        <th>面接時間</th>
        <th>面接店舗</th>
        <th>申込名</th>
        <th>年齢</th>
        <th>経験</th>
        <th>掲載求人名</th>
    </tr>
    </thead>
    <tbody>
    {foreach from=$result name="result" item=value key=key}
    <tr>
        <td><a href="/inputdata/data/{$value.id}" target="_blank">{$value.interview_date|date_format:"%y.%m.%d"}</a></td>
        <td>{$value.interview_hour|string_format:"%02d"}:{$value.interview_time|string_format:"%02d"}</td>
        <td>{$value.interviewshop|default:""}</td>
        <td>{if $value.nikoiti_flg != 0}<i class="fa fa-star "></i>{/if}{$value.submission_name|default:""}</td>
        <td>{$value.age}</td>
        <td>{$value.experience}</td>
        <td>{$value.media}</td>
    </tr>
    {/foreach}

    </tbody></table>


<script src="/assets/js/jquery.multiple.select.js"></script>
{literal}
<script>
    //セレクト複数選択
    $(function() {
        var $selects = $('[id^=select_]');
        $selects.multipleSelect();

        $('.btn_orange').click(function(){
            var select_tenpo = $('#select_tenpo').multipleSelect('getSelects');

            $('#tenpo_hidden').val(select_tenpo);

            var select_check = $('#select_check').multipleSelect('getSelects');
            $('#check_hidden').val(select_check);
        });


          $('#select_tenpo').multipleSelect(
            'setSelects',
            ('{/literal}{$search.tenpo_hidden|default:""}{literal}' ? '{/literal}{$search.tenpo_hidden|default:""}{literal}'.split(',') : [])
          );

          $('#select_check').multipleSelect(
            'setSelects',
            ('{/literal}{$search.check_hidden|default:""}{literal}' ? '{/literal}{$search.check_hidden|default:""}{literal}'.split(',') : [])
          );
    });
</script>
{/literal}
</body></html>
