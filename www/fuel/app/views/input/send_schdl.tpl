{include file=$smarty.const.ADMIN_HEADER}

<main role="main">
    <section class="top_content_wrap">

    </section>
    <section class="container send_col">
        <div class="send_col_wrap">
            <h2>面接予定送信 {if !empty($interviewshop)}<br />面接店舗【{$interviewshop}】{/if}</h2>
            {*<form action="/inputdata/mail_schdl/{$id}" method="post">*}
            <form action="/inputdata/send_schdl/{$id}" method="post" class="white_box send">
                <div class="grop_select_wrap">
                <p>グループ名を選択</p>
                <div class="select_arrow select_input_send">
                    {$forms.groupId.html}
                </div>
                </div>
                <button class="btn_orange sentaku" type="submit" name="選択" style="visibility: hidden;">選択</button>
            </form>
            <form action="/inputdata/mail_schdl/{$id}" method="post">
            <div class="input_sender_wrap">
                {*<p>送信先</p>*}
                {*<label for="allcheck" class="btn_wht">*}
                    {*全て選択/解除<input type="checkbox" id="allcheck" style="display: none;">*}
                {*</label>*}

                {*<div style="margin-bottom:15px;">*}
                {*<p style="font-weight:bold;margin-bottom:10px;">■面接店舗</p>*}
                {*<label>*}
                    {*{if !empty($interviewshop)}{$interviewshop}{/if}*}
                {*</label>*}
                {*</div>*}

                <p>■送信先</p>
                <ul class="sender_check" style="padding-top: 0">
                    {if !empty($staff)}
                    {foreach from=$staff name="staff" item=value key=key}
                        {if !$smarty.foreach.staff.first AND !empty($default.group) AND isset($default.group[$key])}
                    <li>
                        <label style="font-weight:normal">
                            {*<input type="checkbox" name="check_sender[]" class="check_sender-sqar" value="{$key}" {if !empty($default.group) AND isset($default.group[$key])}checked{/if}>*}
                            {$value}
                        </label>
                    </li>
                        {/if}
                    {/foreach}
                    {/if}
                    {if !empty($staff_hidden)}
                        {foreach from=$staff_hidden name="staff" item=value key=key}
                            {if !$smarty.foreach.staff_hidden.first AND !empty($default.group) AND isset($default.group[$key])}
                                <li>
                                    <label style="font-weight:normal">
                                        {*<input type="checkbox" name="check_sender[]" class="check_sender-sqar" value="{$key}" {if !empty($default.group) AND isset($default.group[$key])}checked{/if}>*}
                                        {$value}
                                    </label>
                                </li>
                            {/if}
                        {/foreach}
                    {/if}
                </ul>
            </div>

            <div class="send_col_wrap">
                <div class="info_send">
                    <button type="submit" class="send_schdl_btn">送信確認</button>
                    {if isset($smarty.post.groupId)}<input type="hidden" name="groupId" value="{$smarty.post.groupId}" />{/if}
                </div>
                <div class="info_return">
                    <a href="/inputdata/data/{$id}"><button type="button">前のページに戻る <i class="fa fa-undo"></i></button></a>
                </div>
            </div>
            </form>

            {if isset($error) AND $error == 1}
                メールの送信に失敗しました。
            {/if}
        </div>
    </section>

</main>

<script type="text/javascript">
    //一括チェック

    $('#allcheck').on('click', function() {
        $('.check_sender-sqar').prop('checked', this.checked);
    });

    $('#staff_group_select').change(function() {
        $('.sentaku').trigger('click');
    });

    $('.send_schdl_btn').click(function() {
        if(!$('#staff_group_select').val()){
            alert("グループ名を選択して下さい");
            return false;
        }
    });

    //drawer
    $(function() {
        $('.drawer').drawer();
    });

</script>


{include file=$smarty.const.ADMIN_FOOTER}