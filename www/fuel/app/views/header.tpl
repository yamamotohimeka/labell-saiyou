
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" id="favicon" href="/assets/img/logo_fav.png">
    <!--スタイルシート読み込み-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/css/drawer.min.css">
    <link rel="stylesheet" href="/assets/css/reset.css?{$smarty.now}">
    <!-- <link rel="stylesheet" href="/assets/css/bootstrap.css"> -->
    <link rel="stylesheet" href="/assets/css/base.css?{$smarty.now}">
    <link rel="stylesheet" href="/assets/css/add.css?{$smarty.now}">
    <link rel="stylesheet" href="/assets/css/style.css?{$smarty.now}">
    <link rel="stylesheet" href="/assets/css/input.css?{$smarty.now}">
    <link rel="stylesheet" href="/assets/css/scout.css?{$smarty.now}">
    <link rel="stylesheet" href="/assets/css/search.css?{$smarty.now}">
    <link rel="stylesheet" href="/assets/css/analyze.css?{$smarty.now}">
    <link rel="stylesheet" href="/assets/css/analyze2020.css?{$smarty.now}"><!-- TODO あとで入れ替える -->
    <link rel="stylesheet" href="/assets/css/multiple-select.css?{$smarty.now}">
    <link rel="stylesheet" href="/assets/css/farbtastic.css?{$smarty.now}" />
    {*<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">*}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <!--スタイルシート読み込み-->

    <!--JS読み込み-->
    {literal}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://use.typekit.net/xwk7bgv.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>
    {/literal}
    {if isset($userData.group) && $userData.group == 1}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.2.0/iscroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/js/drawer.min.js"></script>
    {/if}
    <script type="text/javascript" src="/assets/js/farbtastic.js"></script>
    <!--JS読み込み-->
    <title class="blinking">{if isset($default.tab_name)}{$default.tab_name|default:""} {/if}{$title|default:"HeadOffice"}</title>
</head>
<body class="drawer drawer--right">

<div class="wrapper">

    <header>
        {if isset($userData.group) && $userData.group == 1}
            <!-- alert -->
            <div class="alert_btn">
                <img src="/assets/img/alert.gif" onclick="winCenter()">
            </div>
        {/if}
        <div class="inner">
            <div class="container">
                <h1><img src="/assets/img/logo.png" width="53"><span>HeadOffice</span></h1>
                <div class="logout"><a href="/login/logout">LOGOUT</a></div>
                <div class="username">担当：　　　</div>
                {if isset($userData.group) && $userData.group == 1}
                    <div class="edit">
                        <input type="submit" class="btn_orange edit2" onclick="winCenter2()" value="編集中リスト">
                    </div>
                    <div class="input btn_orange">
                        <a href="/inputdata/data/">データ入力</a>
                    </div>
                {/if}
                {*<div class="searchbox">*}
                    {*<form method="get" action="http://www.google.co.jp/search" target="_blank">*}
                        {*<input name="q" size="31" maxlength="255" type="text" class="search_form" placeholder="おなまえ検索">*}
                        {*<input name="btng" value="検索" type="image" class="search_btn" src="/assets/img/btn_search.png" width="38" height="30">*}
                        {*<input name="hl" value="ja" type="hidden">*}
                        {*<input name="sitesearch" value="web-officer.com" type="hidden">*}
                    {*</form>*}
                {*</div>*}
                <div class="print">
                    <a href="javascript:void(0)" onclick="window.print();return false;">
                        <img src="/assets/img/icon_print.png" width="30">
                        <span>PRINT OUT</span>
                    </a>
                </div>
            </div>
        </div>



        <!-- header nav -->
        <nav>
            <div class="container">
                <ul class="nav">
                    <li><a href="/index">採用情報</a></li>
                    <li><a href="/interview">面接予定情報</a></li>
                    {if isset($userData.group) && $userData.group == 1}
                        <li><a href="/search">検索条件</a></li>
                        <li><a href="/chase">追跡・連絡予定情報</a></li>
                        <li><a href="/datalist">問合せリスト</a></li>
                        <li><a href="/scout">オファーメール</a></li>
                        <li><a href="/master">マスタ登録</a></li>
                        <li><a href="/staffgroup">グループ</a></li>
                        <li><a href="/mailtmpl">メールテンプレート登録</a></li>
                        <li><a href="/analyze">集計</a></li>
                    {/if}
                </ul>
            </div>
        </nav>





        {if isset($userData.group) && $userData.group == 1}
        {literal}
        <!-- /header nav -->
        <script type="text/javascript">
            var alert_timer;
            var stop_flg;
            var audioElem = new Audio();

            $(function(){
                setInterval(function(){
                    $.ajax({
                        url:'/api/alert'
                    }).done(function(data) {
                        if(data > 0){
                            if(stop_flg != 1){
                                setTimeout("playSound('play');", 10);

                                blinkFavicon();
                                stop_flg = 1;
                            }
                        }else{
                            setTimeout("playSound('stop');", 10);
                            clearInterval(alert_timer);
                            stop_flg = 0;

                            $('#favicon').attr('href', '/assets/img/logo_fav.png');
                        }
                    }).fail(function(data) {

                    });
                }, 10000);

                $('.nav li a').each(function(){
                    var $href = $(this).attr('href');
                    var parser = document.createElement('a');
                    parser.href = location.href;

                    if(parser.pathname.indexOf($href) === 0) {
                        $(this).parent().addClass('active');
                    } else {
                        $(this).parent().removeClass('active');
                    }
                });
            });

            function winCenter(){
                clearInterval(alert_timer);
                stop_flg = 0;
                $('#favicon').attr('href', '/assets/img/logo_fav.png');

                var w = ( screen.width-640 ) / 2;
                var h = ( screen.height-520 ) / 2;

                window.open("/alertlist","alertWindow","width=640,height=520"
                +",left="+w+",top="+h);
            }

            function winCenter2(){

                var w = ( screen.width-840 ) / 2;
                var h = ( screen.height-520 ) / 2;

                window.open("/editlist","editWindow","width=840,height=520"
                +",left="+w+",top="+h);
            }

            function blinkFavicon(blinkTime){

                if(blinkTime === undefined) blinkTime = 500;
                var blink = false;
                alert_timer = setInterval(function(){
                    $('#favicon').remove();
                    if (blink){
                        blink = false;
                        $('meta:last').after($(document.createElement('link')).attr('id', 'favicon').attr('rel', 'shortcut icon').attr('href', '/assets/img/mail_alert1.png'));
                    } else {
                        blink = true;
                        $('meta:last').after($(document.createElement('link')).attr('id', 'favicon').attr('rel', 'shortcut icon').attr('href', '/assets/img/mail_alert2.png'));
                    }
                }, blinkTime);
            }



            function playSound(flg = "stop"){
                if(!audioElem){
                    audioElem = new Audio();
                }
                
                if(flg === "play"){
                    audioElem.src = "/data/Warning-Alarm02-1L.mp3";
                    audioElem.loop = true;
                    audioElem.play();
                }

                if(flg === "stop"){
                    audioElem.pause();
                    audioElem.currentTime = 0;
                    audioElem = null;
                }
            }
            {/literal}
            </script>
            {/if}

        <script src="/assets/js/jquery.multiple.select.js"></script>
        {*<script src="/assets/js/audio.js"></script>*}
        <script>
            $(function() {
                var $selects = $('[id^=select_]');
                $selects.multipleSelect();
            });
        </script>
    </header>
    <!--header-->