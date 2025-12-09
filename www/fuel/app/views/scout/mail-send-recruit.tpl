{include file=$smarty.const.ADMIN_HEADER}
<main role="main">
    <section class="top_content_wrap">

    </section>
    <article id="scout" class="container">

        {foreach from=$check_id item=value key=key name=check}
        <section class="scout_mail_wrap" data-id="{$smarty.foreach.check.index}">
            <h2>{$key}</h2>
            <div class="scout_mail_inner">
                <p>メールテンプレート</p>
                <div class="select_arrow select_tmpl mailtmpl_select{$smarty.foreach.check.index}">
                    {$forms.mailtmpl.html}
                </div><br>
                <div class="scout_mail_ttl speed scout_mail_title{$smarty.foreach.check.index}"></div>
                <div class="scout_mail_tmplt speed scout_mail_body{$smarty.foreach.check.index}"></div>
            </div>
        </section>
        <div class="scout_mail_btn">
            <form id="send_mail_form{$smarty.foreach.check.index}" action="">
            <input class="btn_orange mail_send_btn" type="submit" value="送信" data-id="{$smarty.foreach.check.index}">
            {foreach from=$value item=value2 key=key2}
            <input type="hidden" value="{$value2}" name="send_id[]" />
            {/foreach}
            </form>
        </div>
        {/foreach}

    </article>
</main>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="/assets/js/scout_mail.js?{$smarty.now}"></script>
<script>
    //drawer
//    $(function() {
//        $('.drawer').drawer();
//    });
</script>

{include file=$smarty.const.ADMIN_FOOTER}