{include file=$smarty.const.ADMIN_HEADER}
<main role="main">
    <section class="top_content_wrap">

    </section>
    <article id="scout" class="container">
        <h1 class="breadcrumb">&gt;&nbsp;オファーメール(所属店舗)</h1>
        <ul class="scout_searc_btn">
            <li>
                <label for="all" class="btn_orange all_btn">
                    全て選択
                    <input type="checkbox" id="all" style="display: none;">
                </label>
            </li>
            <li><a href="scout-mail-site.php"><input class="btn_orange" type="button" value="メール送信"></a></li>
        </ul>
        <section class="table_cmn">
            <table class="scout_check">
                <tr>
                    <th class="scout_day">面接日</th>
                    <th class="">所属店舗</th>
                    <th class="">源氏名</th>
                    <th class="scout_name">申込名</th>
                    <th class="">年齢</th>
                    <th class="">身長</th>
                    <th class="">体重</th>
                    <th class="">面接結果</th>
                    <th class="">退店日</th>
                    <th class="">退店理由</th>
                    <th class="scout_mail">オファーメール</th>
                </tr>
                {foreach from=$scout_data item=value key=key}
                <tr>
                    <td class="">30.0108</td>
                    <td class="">スピード日本橋</td>
                    <td class="">りかこ</td>
                    <td class=""><a href="index.php">りかこ</a></td>
                    <td class="">23</td>
                    <td class="">155</td>
                    <td class="">80</td>
                    <td class="">採用</td>
                    <td class="">30.0108</td>
                    <td class="">クビ</td>
                    <td class="">
                        <label>
                            <input type="checkbox" name="check" class="radio-sqar">
                            <span class="radio-txt">追加</span>
                        </label>
                    </td>
                </tr>
                {/foreach}
            </table>
        </section>



    </article>
</main>

{literal}
<script>

    //一括チェック

    $('#all').on('click', function() {
        $('input[name=check]').prop('checked', this.checked);
    });

    $('#all2').on('click', function() {
        $('input[name=check2]').prop('checked', this.checked);
    });


    //drawer
    $(function() {
        $('.drawer').drawer();
    });

</script>
{/literal}

{include file=$smarty.const.ADMIN_FOOTER}