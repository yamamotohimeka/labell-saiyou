{include file=$smarty.const.ADMIN_HEADER}

<article>
    <section class="top_content_wrap">

    </section>

    <section>
        <form action="/master/staffform/staff/{$id}" method="post" id="login" accept-charset="utf-8">
        <div class="container table_cmn">
            <h1 class="breadcrumb"><span>スタッフ＋メールアドレスの追加</span></h1>
            <div class="mstr_signup">
                <div class="mstr_signup_box">
                    <p>名前</p>
                    <input type="text" name="name" value="{$staffData.name|default:""}" size="30" class="master_name_txt" required>
                    <p>ふりがな</p>
                    <input type="text" name="nameKana" value="{$staffData.namekana|default:""}" size="30" class="master_name_txt" required>
                </div>
                <div class="mstr_signup_box">
                    <p>種別　</p>
                    <label for="group_radio1">
                    <input type="radio" id="group_radio1" name="group" value="1" {if $staffData.group|default:"" == 1 OR !isset($id)}checked="checked"{/if} />求人センター
                    </label>

                    <label for="group_radio2">
                        <input type="radio" id="group_radio2" name="group" value="2" {if $staffData.group|default:"" == 2}checked="checked"{/if} />店舗
                    </label>
                </div>
                {assign var="mail" value="@"|explode:$staffData.email|default:""}
                <div class="mstr_signup_box">
                    <p>メールアドレス</p>
                    <input type="text" name="mailaddress" value="{$mail.0|default:""}" size="30" class="master_name_txt mail">
                    <p>＠</p>
                    <div class="select_arrow select_mstr_mail">
                        {$forms.maildomain.html}
                    </div>
                </div>
                <div class="mstr_signup_box">
                    <p>パスワード</p>
                    {if isset($id)}
                        <a href="/master/reminder?mail={$staffData.email|default:""}" class="password_reset_link">パスワードをリセットする</a>
                    {else}
                        <input type="password" name="password" value="{$staffData.password|default:""}" size="20" class="master_name_txt" required>
                    {/if}
                </div>

                <div class="mstr_signup_box">
                    <p>表示/非表示　</p>
                    <label for="hidden_radio1">
                        <input type="radio" id="hidden_radio1" name="hidden" value="0" {if $staffData.hidden|default:"" === "0" OR !isset($id)}checked="checked"{/if} />表示
                    </label>

                    <label for="hidden_radio2">
                        <input type="radio" id="hidden_radio2" name="hidden" value="1" {if $staffData.hidden|default:"" === "1"}checked="checked"{/if} />非表示
                    </label>
                </div>

                <div class="checkbx mstr_sender">
                    <label>
                        <input type="hidden" name="sender" value="0" />
                        <input type="checkbox" name="sender" class="checkbx_sqar mstr_sender" value="1" {if $staffData.sender|default:"0" === "1"}checked{/if}>
                        <span class="checkbx_txt mstr_sender">採用情報送信者</span>

                    </label>
                </div>
            </div>

            <div class="mstr_signup_btn">
                {if isset($message) AND $message}
                <div class="error_msg">{$message}</div><br />
                {/if}
                <input type="submit" class="btn_orange" name="submit" value="登録">
            </div>

        </div>
            </form>
    </section>
</article>

{include file=$smarty.const.ADMIN_FOOTER}