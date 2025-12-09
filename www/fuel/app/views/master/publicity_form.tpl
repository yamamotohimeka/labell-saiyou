{include file=$smarty.const.ADMIN_HEADER}

<article>
    <section class="top_content_wrap">

    </section>
    <section>
        <form action="/master/form/publicity/{$id}" method="post" id="login" accept-charset="utf-8">
        <div class="container table_cmn">
            <h1 class="breadcrumb"><span>掲載媒体の追加</span></h1>
            <div class="mstr_signup">
                <div class="mstr_signup_box">
                    <p>掲載媒体名</p>
                    <input type="text" name="name" value="{$masterData.name|default:""}" size="68" class="signup_txt group">
                    {if isset($smarty.get.error) AND $smarty.get.error}
                        <div class="master_error_attention">{$smarty.get.error}</div>
                    {/if}
                </div>
                <div class="mstr_signup_box">
                    <p>掲載広告名<br />(ふりがな)</p>
                    <input type="text" name="namekana" value="{$masterData.namekana|default:""}" size="68" class="signup_txt group">
                </div>
                <br>
                {*<div class="mstr_signup_box radio">*}
                    {*<p>カテゴリ</p>*}
                    {*<label><input type="radio" name="category" value="0" {if $masterData.category|default:"" === "0"}checked{/if}>ネット</label>*}
                    {*<label><input type="radio" name="category" value="1" {if $masterData.category|default:"" === "1"}checked{/if}>雑誌</label>*}
                {*</div>*}
            </div>
            <div class="mstr_signup_btn">
                <input type="submit" class="btn_orange" name="submit" value="登録">
            </div>
        </div>
        </form>
    </section>
</article>

{include file=$smarty.const.ADMIN_FOOTER}