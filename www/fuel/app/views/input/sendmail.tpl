{include file=$smarty.const.ADMIN_HEADER}

<main role="main">
    <section class="top_content_wrap">

    </section>
    <section class="container date_info_col">
        <h1 class="breadcrumb date_info_breadcrumb">&gt;&nbsp;データ入力</h1>
        <div class="send_wrap">
            {if isset($userData.group) && $userData.group == 1}
                <div class="{if $result.0.tentative_reserve_flg == 1}info_return{else}info_send{/if}">
                    <a href="/inputdata/send_schdl/{$id}"><button type="submit"{if $result.0.tentative_reserve_flg == 1} disabled="disabled"{/if}>面接予定送信</button></a>
                </div>
            {/if}
            <div class="info_send">
{*                <a href="/inputdata/send_rcrt/{$id}"><button type="submit">採用情報送信</button></a>*}
{*                {if $smarty.server.REMOTE_ADDR == '221.113.41.190'}*}
{*                    {print_r($result.0)}*}
{*                    {$result.0.check}*}
{*                {/if}*}
                    {if !empty($result.0.belonging_store) AND !empty($result.0.interview_result) AND !empty($result.0.interview_staff) AND $result.0.check == 1 }
                        <a href="/inputdata/send_rcrt/{$id}"><button type="submit">採用情報送信</button></a>
                    {else}
                        <button type="submit" disabled style="opacity:0.5;">採用情報送信</button><br />
                        <span class="required">
                            ＊ 『店舗』『面接結果』『面接担当』の項目全て登録があるのと『面接前確認』が【到着（off）】の場合のみ採用情報が送信出来ます<br /><br />
                        </span>
                    {/if}
            </div>
            <div class="info_return">
                <a href="/inputdata/data/{$id}"><button type="submit">前のページに戻る <i class="fa fa-undo"></i></button></a>
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