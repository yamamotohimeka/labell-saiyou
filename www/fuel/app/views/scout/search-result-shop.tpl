{include file=$smarty.const.ADMIN_HEADER}
<main role="main">
    <section class="top_content_wrap">

    </section>
    <form action="/scout/mail_send_shop" method="post">
    <article id="scout" class="container">
        <h1 class="breadcrumb">&gt;&nbsp;オファーメール(所属店舗)</h1>
        <ul class="scout_searc_btn">
            <li>
                <label for="all" class="btn_orange all_btn">
                    全て選択
                    <input type="checkbox" id="all" style="display: none;">
                </label>
            </li>
            <li><input class="btn_orange" type="submit" value="メール送信"></li>
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
                    <td class=""><a href="/inputdata/data/{$value.id}">{$value.interview_date|date_format:"%y.%m%d"}</a></td>
                    <td class="">{$value.belonging_store}</td>
                    <td class="">{$value.genji_name}</td>
                    <td class="">{$value.submission_name}</td>
                    <td class="">{$value.age}</td>
                    <td class="">{$value.tall}</td>
                    <td class="">{$value.weight}</td>
                    <td class="">{$value.interview_result}</td>
                    <td class="">{$value.leaving_date|date_format:"%y.%m%d"}</td>
                    <td class="">{$value.leaving_reason}</td>
                    <td class="">
                        <label>
                            <input type="checkbox" name="check_id[{$value.belonging_store}][]" value="{$value.id}" class="radio-sqar">

                            <span class="radio-txt">追加</span>
                        </label>
                    </td>
                </tr>
                {/foreach}
            </table>
        </section>
    </article>
    </form>
</main>

{literal}
<script>

    //一括チェック
    $('#all').on('click', function() {
        $('.radio-sqar').prop('checked', this.checked);
    });

</script>
{/literal}

{include file=$smarty.const.ADMIN_FOOTER}