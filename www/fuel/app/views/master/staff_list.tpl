{include file=$smarty.const.ADMIN_HEADER}

<article>
    <section class="top_content_wrap">

    </section>
    <section>
        <div class="container table_cmn shop_wrap master_cmn_wrap">
            <h1 class="breadcrumb">
                <div class="btn_orange"><a href="/master/staffform/staff">新規登録</a></div>
                <span>スタッフ＋メールアドレスの追加</span></h1>

            <ul class="display_menu">
                <li><a href="?display=0">表示のみ</a></li>
                <li><a href="?display=1">非表示のみ</a></li>
            </ul>
            <table>
                <tr>
                    <th class="nm">名前</th>
                    <th class="">種別</th>
                    <th class="sender">採用情報送信者</th>
                    <th class="adrs">メールアドレス</th>
                    <th class="xs" colspan="2">処理</th>
                </tr>
                <tbody>
                {foreach from=$masterData name="master_staff" item=value key=key}
                    {if $value.username !== "kouji"}
                    <tr>
                        <td class="name">{$value.profile_fields.name|default:""}</td>
                        <td class="">{if $value.group === "1"}求人センター{else}店舗{/if}</td>
                        <td class="sender">{if $value.profile_fields.sender|default:"0" === "1"}✓{/if}</td>
                        <td class="address">{$value.email|default:""}</td>
                        <td class="edit"><a href="/master/staffform/staff/{$value.id}">編集</a></td>
                        <td class="delete">
                            <form action="/master/list/staff/" method="post" id="master_delete_form" accept-charset="utf-8">
                                <input type="submit" name="submit" value="削除" class="master_delete_btn" />
                                <input type="hidden" name="id" value="{$value.id}" />
                            </form
                        </td>
                    </tr>
                    {/if}
                {/foreach}
                </tbody>
            </table>
        </div>
    </section>


</article>

{include file=$smarty.const.MASTER_LIST_FOOTER}