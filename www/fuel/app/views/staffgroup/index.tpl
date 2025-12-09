{include file=$smarty.const.ADMIN_HEADER}

<article>
    <section class="top_content_wrap">

    </section>
    <section id="group" class="container interview_wrap">
        <h2 class="breadcrumb">&gt;&nbsp;メール送信&nbsp;グループ登録</h2>

        <form action="/staffgroup/confirm" method="post">
        <div class="group_wrap">
            <!-- グループ名-->
            <div class="white_box">
                <p>グループ名</p>
                <div class="select_arrow">
                    {$forms.groupId.html}
                    {literal}
                        <script>
                            $(function(){
                                $('#staff_group_select').change(function(){
                                   var selectid = $(this).val();
                                   location.href = '/staffgroup/?groupId=' + selectid;
                                });

                                $('.staffgroup_confirm').click(function(){
                                    if(!$('#staff_group_select').val()){
                                        alert("グループ名を選択して下さい");
                                        return false;
                                    }
                                });
                            });
                        </script>
                    {/literal}
                </div>
            </div>

            <!--確定ボタン-->
            <div class="group_btn">
                <a href="/staffgroup/confirm"><button type="submit" class="btn_orange staffgroup_confirm">確定</button></a>
            </div>

            <ul>
                {if !empty($staff)}
                {foreach from=$staff name="staff" item=value key=key}
                    {if !$smarty.foreach.staff.first}
                <li>
                    <label>
                        <input type="checkbox" name="group[]" class="check_group-sqar" value="{$key}" {if !empty($default.group) AND isset($default.group[$key])}checked{/if}>
                        <span class="check_group-txt">{$value}</span>
                    </label>
                </li>
                    {/if}
                {/foreach}
                {/if}
            </ul>
        </div><!--/.group_wrap -->

        </form>
    </section>
</article>

{include file=$smarty.const.ADMIN_FOOTER}