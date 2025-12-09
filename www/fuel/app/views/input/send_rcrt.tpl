{include file=$smarty.const.ADMIN_HEADER}

<main role="main" xmlns="http://www.w3.org/1999/html">
    <section class="top_content_wrap">

    </section>
    <section class="container send_col">
        <h2>採用情報送信</h2>
        <div class="input_sender_wrap">
            <p>送信先</p>
            <label for="allcheck" class="btn_wht">
                全て選択/解除<input type="checkbox" id="allcheck" style="display: none;">
            </label>
            <form action="/inputdata/mail_rcrt/{$id}" method="post">
            <ul class="sender_check">
                {if !empty($staff) AND !empty($sender)}
                    {foreach from=$staff name="staff" item=value key=key}
                        {if !$smarty.foreach.staff.first}
                        {if !empty($sender.$key)}
                            <li>
                                <label>
                                    {*<input type="checkbox" name="check_sender[]" class="check_sender-sqar" value="{$key}" {if !empty($default.group) AND isset($default.group[$key])}checked{/if}>*}
                                    <input type="checkbox" name="check_sender[]" class="check_sender-sqar" value="{$key}" checked>
                                    <span class="check_sender-txt">{$value}</span>
                                </label>
                            </li>
                        {/if}
                        {/if}
                    {/foreach}
                {/if}

            </ul>
        </div>
        <div class="send_col_wrap">
            <div class="info_send">
                <button type="submit" class="send_schdl_btn">送信確認</button>
            </div>
            <div class="info_return">
                <a href="/inputdata/data/{$id}"><button type="button">前のページに戻る <i class="fa fa-undo"></i></button></a>
            </div>
        </div>
        </form>
    </section>

</main>

<script>
    //一括チェック

    $('#allcheck').on('click', function() {
        $('.check_sender-sqar').prop('checked', this.checked);
    });

    $('.send_schdl_btn').on('click', function() {
        var chk = false;
        $('.check_sender-sqar').each(function() {
            if($(this).prop('checked') === true){
                chk = true;
            }
        });

        if(chk === false){
            alert("送信先を選択してください");
            return false;
        }
    });

    //drawer
    $(function() {
        $('.drawer').drawer();

        $(".send_schdl_btn").click(function() {



        });
    });

</script>


{include file=$smarty.const.ADMIN_FOOTER}