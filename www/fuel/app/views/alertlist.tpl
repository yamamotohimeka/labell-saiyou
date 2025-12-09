
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--1分に一回ブラウザの自動リロード-->
    <meta http-equiv="refresh" content="60; URL=">

    <!--スタイルシート読み込み-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/css/drawer.min.css">
    <link rel="stylesheet" href="/assets/css/reset.css">
    <!-- <link rel="stylesheet" href="/assets/css/bootstrap.css"> -->
    <link rel="stylesheet" href="/assets/css/base.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/input.css">
    <link rel="stylesheet" href="/assets/css/scout.css">
    <link rel="stylesheet" href="/assets/css/search.css">
    <link rel="stylesheet" href="/assets/css/analyze.css">
    <link rel="stylesheet" href="/assets/css/multiple-select.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"><!--スタイルシート読み込み-->

    <!--JS読み込み-->
    {literal}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://use.typekit.net/xwk7bgv.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.2.0/iscroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/js/drawer.min.js"></script>
    {/literal}
    <!--JS読み込み-->
    <title>面接アラート</title>

<body id="alert_list">
<article>
        <br /><span style="color: red;font-size: small;">* 下記のリストは『面接予定日時』の１時間前から、次の日の朝{$Switching_time}時までのリスト表示となります。</span>
        <br /><span style="color: red;font-size: small;">* 下記のリストは『面接予定時間』から１時間後に非表示となります。</span>
    <section class="alert_list">
        {if !empty($result)}
        {foreach from=$result name="result" item=value key=key}
        <form action="/api/alert_update/" method="post">
        <div {if $value.tentative_reserve_flg == 1}style="color: red;"{/if}>
            {if $value.timer_enable == 1}
            <span class="alert_list_bg blinking"></span>
            {elseif $value.timer_enable == 2}
                <span class="alert_list_over"></span>
            {/if}
            {if empty($value.checkalert)}
                <span class="alert_list_ng"></span>
            {/if}
            <a href="/inputdata/data/{$value.id}" target="_blank">{if $value.nikoiti_flg === "1"}<i class="fa fa-star "></i>{/if}{$value.submission_name}さん</a>の面接<em>{$value.before}分前</em>です<br>
            面接時間:<input type="text" class="input_req input_req2" pattern="^[0-9%-]+$" title="半角数字でご入力ください。" size="4" value="{$value.timer}" id="form_timer" name="timer[{$value.id}]" required="required"><span class="select_ymd_txt">分前</span>
            面接前確認：<div class="select_arrow" style="padding: 0;width: 120px;"><select id="form_check" name="check[{$value.id}]">
                    {foreach from=$check item=value2 key=key2}
                        <option value="{$key2}" {if $key2 == $value.check}selected="selected"{/if}>{$value2}</option>
                    {/foreach}
                </select>
            </div><br />
            面接店舗：<em>{$value.interviewshop|default:""}</em><br>
            面接予定日:<em>{$value.interview_date}</em><br>
            面接予定時間:<em>{$value.interview_hour|string_format:"%02d"}:{$value.interview_time|string_format:"%02d"}</em><br>
            {if !empty($value.media)}掲載求人名:<em>{$value.media}</em><br>{/if}
            連絡方法：<em>{$value.contact|default:""}</em><br>
            {if !empty($value.tel01) AND !empty($value.tel02) AND !empty($value.tel03)}電話番号:<em>{$value.tel01}-{$value.tel02}-{$value.tel03}</em><br>{/if}
            {if !empty($value.place)}待ち合わせ場所:<em>{$value.place}</em><br>{/if}
            {if !empty($value.place_remarks)}待ち合わせ備考:<em>{$value.place_remarks}</em><br>{/if}
            {if $value.nikoiti_flg === "1" && !empty($value.nikoiti)}ニコイチ:<em>{$value.nikoiti}</em><br>{/if}
            {*<form action="/api/alert_change/" method="post">*}
                {*<button type="submit" id="btn_id" class="btn_orange index alert_stop_btn" name="stop_alerm" value="stop_alerm">アラーム{if $value.timer_flg === "1"}開始{else}停止{/if}</button><br>*}
                {*<input type="hidden" name="id" value="{$value.id}" />*}
                {*<input type="hidden" name="timer_flg" value="{if $value.timer_flg === "1"}0{else}1{/if}" />*}
            {*</form>*}

                {*<input type="hidden" name="id" value="{$value.id}" />*}

        <button type="submit" id="btn_id" class="btn_orange index alert_update_btn" type="submit" name="update_form" value="update_form">確定・更新</button>
        </div>
        </form>
        {/foreach}
        {else}
        現在、面接予定はありません。
        {/if}
    </section>
</article>

</div><!--  /wrapper-->

</body>
</html>
</body>