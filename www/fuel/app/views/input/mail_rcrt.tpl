{include file=$smarty.const.ADMIN_HEADER}

<main role="main">
    <section class="top_content_wrap">

    </section>
    <section class="container send_mail_col">
        <h2>採用情報送信</h2>
        <form class="send_mail_wrap" action="/inputdata/mail_rcrt/{$id}" method="post">
            <div class="send_mail_line">
                <p class="send_mail_tl inline">送信先</p>
                <input type="text" class="send_mail_txt" value="{$send_name|default:""}">
            </div>
            <div class="send_mail_line">
                <p class="send_mail_tl inline">タイトル</p>
                <input type="text" class="send_mail_txt" name="mail_title" value="採用情報">
            </div>

            <textarea name="mail_text" rows="30" cols="95" class="send_mail_contents" placeholder="採用情報送信メールの内容が入ります">{if isset($body_text)}{$body_text}{/if}</textarea>
            <div class="send_mail_image">
                {foreach from=$image_list key=key item=value}
                    <div class="girls_info_img">
                        <img src="/img/girl_image/{$value.img_id}/{$value.img_id}.{$value.ext}" alt="{$key}枚目" width="100%;">
                    </div>
                    <input type="hidden" name="image_list[]" value="img/girl_image/{$value.img_id}/{$value.img_id}.{$value.ext}">
                {/foreach}
            </div>
        <div class="send_col_wrap">
            <div class="info_return inline mail_button">
                <a href="/inputdata/send_rcrt/{$id}"><button type="button">前のページに戻る <i class="fa fa-undo"></i></button></a>
            </div>
            <div class="info_send inline mail_button">
                <a href="/inputdata/mail_rcrt/{$id}"><button type="submit" name="sendmail" value="sendmail" class="sendmail">メール送信</button></a>
            </div>
        </div>
        </div>

        {foreach from=$sender_list item=value key=key}
            <input type="hidden" name="sender_list[]" value="{$value}" />
        {/foreach}
        </form>
    </section>
</main>

<script type="text/javascript">
    //drawer
    $(function() {
        $('.drawer').drawer();
    });

</script>

{include file=$smarty.const.ADMIN_FOOTER}