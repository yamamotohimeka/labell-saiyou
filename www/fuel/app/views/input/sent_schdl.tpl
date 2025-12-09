{include file=$smarty.const.ADMIN_HEADER}

<main role="main">
    <section class="top_content_wrap">

    </section>
    <section class="container send_mail_col">
        <div class="mail_complete">
            <p>メール送信完了しました。</p>
            <div class="send_col_wrap">
                <div class="info_send inline mail_button">
                    <a href="/interview"><button type="button">面接予定ページへ</button></a>
                </div>
            </div>
        </div>
        </div>
    </section>
</main>

<script type="text/javascript">
    //drawer
    $(function() {
        $('.drawer').drawer();
    });

</script>


{include file=$smarty.const.ADMIN_FOOTER}