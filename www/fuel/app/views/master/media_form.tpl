{include file=$smarty.const.ADMIN_HEADER}

<article>
    <section class="top_content_wrap">

    </section>
    <section>
        <form action="/master/form/media/{$id}" method="post" id="login" accept-charset="utf-8">
        <div class="container table_cmn">
            <h1 class="breadcrumb"><span>掲載求人名の追加</span></h1>
            <div class="mstr_signup">
                <div class="mstr_signup_box">
                    <p>掲載求人名</p>
                    <input type="text" name="name" value="{$masterData.name|default:""}" size="30" class="signup_txt group">
                    {if isset($smarty.get.error) AND $smarty.get.error}
                        <div class="master_error_attention">{$smarty.get.error}</div>
                    {/if}
                </div>
                <div class="mstr_signup_box">
                    <p>掲載求人名<br />(ふりがな)</p>
                    <input type="text" name="namekana" value="{$masterData.namekana|default:""}" size="30" class="signup_txt group">
                </div>
                <div class="mstr_signup_box">
                    <p>掲載業種</p>
                    <div class="select_arrow select_mstr_mail" style="margin-left: 115px;">
                    <select class="keigyo" id="form_genre" name="genre" class="signup_txt group">
                        {foreach from=$master.genre item=value key=key}
                            <option value="{$key}" {if isset($masterData.genre) AND $masterData.genre == $key}selected{/if}>{$value}</option>
                        {/foreach}
                    </select>
                    </div>
                </div>
                {assign var="mail" value="@"|explode:$masterData.mailaddress|default:""}
                <div class="mstr_signup_box">
                    <p>メールアドレス</p>
                    <input type="text" name="mailaddress" value="{$mail.0|default:""}" size="30" class="master_name_txt mail">
                    <p>＠</p>
                    <div class="select_arrow select_mstr_mail">
                        <select name="maildomain">
                            {foreach $master.maildomain AS $key => $value}
                                <option value="{$value}" {if $mail.1 == $value}selected{/if}>{$value}</option>
                            {/foreach}
                            {*<option value="">—</option>*}
                            {*<option value="softbank.ne.jp" {if $mail.1|default:"" === "softbank.ne.jp"}selected{/if}>softbank.ne.jp</option>*}
                            {*<option value="docomo.ne.jp" {if $mail.1|default:"" === "docomo.ne.jp"}selected{/if}>docomo.ne.jp</option>*}
                            {*<option value="i.softbank.jp" {if $mail.1|default:"" === "i.softbank.jp"}selected{/if}>i.softbank.jp</option>*}
                            {*<option value="icloud.com" {if $mail.1|default:"" === "icloud.com"}selected{/if}>icloud.com</option>*}
                            {*<option value="ezweb.ne.jp" {if $mail.1|default:"" === "ezweb.ne.jp"}selected{/if}>ezweb.ne.jp</option>*}
                        </select>
                    </div>
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