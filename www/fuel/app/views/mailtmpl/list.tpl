{include file=$smarty.const.ADMIN_HEADER}

<article>
    <section class="top_content_wrap">

    </section>
    <section>
        <div class="container table_cmn place_wrap master_cmn_wrap">
            <h1 class="breadcrumb"><div class="btn_orange"><a href="/mailtmpl/form">新規登録</a></div><span>メールテンプレートの追加</span></h1>
            <table>
                <tr>
                    <th class="master_cmn_nm">メールテンプレート</th>
                    <th class="xs" colspan="2">処理</th>
                </tr>
                {foreach from=$result name="result" item=value key=key}
                <tr>
                    <td class="master_cmn_name">{$value.template_name}</td>
                    <td class="edit"><a href="/mailtmpl/form/{$value.id}">編集</a></td>
                    <td class="delete">
                        <form action="/mailtmpl/delete" method="post" id="master_delete_form" accept-charset="utf-8">
                            <input type="submit" name="submit" value="削除" class="master_delete_btn" />
                            <input type="hidden" name="id" value="{$value.id}" />
                        </form>
                    </td>
                </tr>
                {/foreach}
            </table>
        </div>
    </section>
</article>

{include file=$smarty.const.ADMIN_FOOTER}