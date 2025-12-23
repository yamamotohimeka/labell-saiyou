{literal}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://use.typekit.net/xwk7bgv.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.2.0/iscroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/js/drawer.min.js"></script>
    <!--JS読み込み-->
    <title>編集中リスト</title>
{/literal}
<body id="edit_list">
<article>
    <section class="edit_list">
        <table>

            <thead>
            <tr>
                <th>日時</th>
                <th>掲載求人名</th>
                <th>申込名</th>
                <th>名前</th>
                <th>編集者</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            {foreach from=$result name="result" item=value key=key}
            <tr>
                <td>{$value.updated_at|date_format:"%m/%d %H:%M"}</td>
                <td>{$value.media}</td>
                <td><a href="/inputdata/data/{$value.id}" target="_blank"><i class="fa fa-star "></i>{$value.submission_name|default:""}</a></td>
                <td>{$value.surname|default:""}{$value.name|default:""}</td>
                <td>{$value.user_name}</td>
                <td class="edit_btn">
                    <form action="/editlist" method="post">
                        <input type="submit" class="btn_orange edit2" value="編集完了">
                        <input type="hidden" name="edit_id" value="{$value.edit_id}" />
                    </form>
                </td>
            </tr>
            {/foreach}
            </tbody>
        </table>
    </section>
</article>

</div><!--  /wrapper-->

</body>
</html>