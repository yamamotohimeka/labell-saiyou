{*{include file=$smarty.const.ADMIN_HEADER}*}

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8" />
    <title>ログイン</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="" />
    <link rel="stylesheet" href="/assets/css/reset.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/base.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/js/common.js"></script>
</head>

<body>
<div id="container">

<article>
    <section class="top_content_wrap">

    <div class="container table_cmn" style="width: 100%;">
        {$forms.form_open}
        <!--  start login-inner -->
        <div id="login-inner">
            <div class="login_title">パスワード再設定</div>
            <table border="0" cellpadding="0" cellspacing="0" style="width: 95%;">
                <tr>
                    <td style="line-height: 25px;padding-bottom: 40px;">現在のパスワードをリセットし、新パスワードを設定します。</td>
                </tr>
                <tr>
                    <th>新パスワード</th>
                </tr>
                <tr>
                    <td>{$forms.password.html}</td>
                </tr>
                <tr>
                    <td valign="top">
                        {$forms.submit.html}
                    </td>
                </tr>

            </table>
        </div>
        <!--  end login-inner -->
        <div class="clear"></div>
    </div>

{$forms.form_close}

</article>

{include file=$smarty.const.ADMIN_FOOTER}