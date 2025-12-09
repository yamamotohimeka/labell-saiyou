{include file=$smarty.const.ADMIN_HEADER}

<article>
    <section class="top_content_wrap">

    </section>
    <section>
        <div class="container table_cmn shop_wrap master_cmn_wrap">
            <h1 class="breadcrumb">
                <div class="btn_orange"><a href="/master/form/publicity">新規登録</a></div>
                <span>掲載媒体の追加</span></h1>
            <table>
                <thead>
                <tr>
                    <th class="master_cmn_nm">掲載媒体名</th>
                    {*<th class="master_cmn_nm">カテゴリ</th>*}
                    <th class="xs" colspan="2">処理</th>
                </tr>
                </thead>
                <tbody>
                {foreach from=$masterData name="masterData" item=value key=key}
                    <tr>
                        <td class="master_cmn_name">{$value.name}</td>
                        {*<td class="master_cmn_name">{if $value.category === "0"}ネット{elseif $value.category === "1"}雑誌{/if}</td>*}
                        <td class="edit"><a href="/master/form/publicity/{$value.id}">編集</a></td>
                        <td class="delete">
                            <form action="/master/list/publicity" method="post" id="master_delete_form" accept-charset="utf-8">
                                <input type="submit" name="submit" value="削除" class="master_delete_btn" />
                                <input type="hidden" name="id" value="{$value.id}" />
                            </form
                        </td>
                    </tr>
                {/foreach}
                </tbody>
            </table>
        </div>
    </section>
</article>

{include file=$smarty.const.MASTER_LIST_FOOTER}