{include file=$smarty.const.ADMIN_HEADER}

<article>
    <section class="top_content_wrap">

    </section>
    <section>
        <form action="/master/form/genre/{$id}" method="post" id="login" accept-charset="utf-8">
        <div class="container table_cmn">
            <h1 class="breadcrumb"><span>掲載業種の追加</span></h1>
            <div class="mstr_signup">
                <div class="mstr_signup_box">
                    <p>掲載業種</p>
                    <input type="text" name="name" value="{$masterData.name|default:""}" size="68" class="signup_txt group">
                    {if isset($smarty.get.error) AND $smarty.get.error}
                        <div class="master_error_attention">{$smarty.get.error}</div>
                    {/if}
                </div>
            </div>
            <div class="mstr_signup_btn">
                <input type="submit" class="btn_orange" value="登録" name="submit">
            </div>
        </div>
        </form>
    </section>
</article>

{include file=$smarty.const.ADMIN_FOOTER}