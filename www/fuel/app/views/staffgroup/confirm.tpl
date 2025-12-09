{include file=$smarty.const.ADMIN_HEADER}
<article>
    <section id="group" class="container interview_wrap">

        <div class="group_conf_wrap">
            <h3>&gt;&nbsp;{$masterData.group[$post_data.groupId]|default:"-"}</h3>
            <ul>
                {if !empty($post_data.group)}
                {foreach from=$post_data.group name="staff" item=value key=key}
                <li>{$masterData.staff[$value]|default:"-"}</li>
                {/foreach}
                {/if}
            </ul>
        </div>
        <div class="group_conf_btn">
        <form action="/staffgroup/add" method="post">
            <div class="group_conf_enter">
                <button type="submit">登録</button>
                <input type="hidden" name="groupId" value="{$post_data.groupId|default:"0"}" />
                <input type="hidden" name="group" value="{$group_list|default:""}" />
            </div>
        </form>
            <div class="group_conf_return">
                <a href="/staffgroup"><button type="submit">前のページに戻る <i class="fa fa-undo"></i></button></a>
            </div>
        </div>

    </section>
</article>

{include file=$smarty.const.ADMIN_FOOTER}