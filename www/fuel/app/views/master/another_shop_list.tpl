{include file=$smarty.const.ADMIN_HEADER}

<article>
    <section class="top_content_wrap">

    </section>
    <section>
        <div class="container table_cmn shop_wrap master_cmn_wrap">
            <h1 class="breadcrumb">
                <div class="btn_orange"><a href="/master/form/another_shop">新規登録</a></div>
                <div class="btn_orange" style="width:auto">
                    <form action="/master/list/another_shop" method="post" accept-charset="utf-8">
                        <input type="submit" name="submit_sort" value="並び替えを反映する" class="master_sort_btn" />
                        <input type="hidden" id="sort_num" name="sort" value="" />
                        <input type="hidden" name="sort_master" value="master_another_shop" />
                    </form>
                </div>
                <span>他店紹介先の追加</span></h1>
            <table class="master_list_table">
                <tr>
                    <th class="sort_th">並び替え</th>
                    <th class="master_cmn_nm">店舗名</th>
                    <th class="xs" colspan="2">処理</th>
                </tr>
                {foreach from=$masterData name="masterData" item=value key=key}
                    <tr>
                        <td><i class="fas fa-sort" data-id="{$value.id}"></i></td>
                        <td class="master_cmn_name">{$value.name}</td>
                        <td class="edit"><a href="/master/form/another_shop/{$value.id}">編集</a></td>
                        <td class="delete">
                            <form action="/master/list/another_shop" method="post" id="master_delete_form" accept-charset="utf-8">
                                <input type="submit" name="submit" value="削除" class="master_delete_btn" />
                                <input type="hidden" name="id" value="{$value.id}" />
                            </form
                        </td>
                    </tr>
                {/foreach}
            </table>
        </div>
    </section>
</article>

{include file=$smarty.const.MASTER_LIST_FOOTER}