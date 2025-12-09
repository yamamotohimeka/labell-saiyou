{include file=$smarty.const.ADMIN_HEADER}

<article>
    <section class="top_content_wrap">

    </section>
    <section>
        <form action="/mailtmpl/form/{$id}" method="post" id="login" accept-charset="utf-8">
        <div class="container table_cmn">
            <h1 class="breadcrumb"><span>メールテンプレートの追加</span></h1>
            <div class="mstr_signup">
                <div class="mstr_signup_box">
                    <p>テンプレート名</p>
                    {$forms.template_name.html}<br>
                    <p>タイトル名</p>
                    {$forms.title.html}<br>
                    <p>本文</p><br>
                    {$forms.mail_text.html}
                </div>
            </div>

            <div class="mstr_signup_btn">
                <input type="submit" class="btn_orange" name="submit" value="登録">
            </div>
        </div>
        </form>
    </section>
</article>

{include file=$smarty.const.ADMIN_FOOTER}