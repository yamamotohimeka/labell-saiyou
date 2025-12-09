{include file=$smarty.const.ADMIN_HEADER}

<article>
    <section class="top_content_wrap">

        <div class="container table_cmn">
        {$forms.form_open}
            <h1 class="breadcrumb">パスワードをお忘れの場合</h1>

            <div class="reminder_attention">
                パスワードをお忘れの場合、下記のマスターメールに変更URLを送信致しますので、「送信」ボタンを押して下さい。
            </div>
            <table border="0" cellpadding="0" cellspacing="0" style="width:50%;margin: 0 auto;">
                <tr>
                    <th>変更するユーザー名</th>
                    <td>{$username}</td>
                </tr>
                <tr>
                    <th>マスターメール</th>
                    <td>{$master_mail}</td>
                </tr>
                <tr>
                    <td valign="top" colspan="2">
                        <input type="hidden" name="email" value="{$email}" />
                        {$forms.submit.html}
                    </td>
                </tr>

            </table>
        <div class="clear"></div>
    </div>

{$forms.form_close}
    </section>
</article>

{include file=$smarty.const.ADMIN_FOOTER}
