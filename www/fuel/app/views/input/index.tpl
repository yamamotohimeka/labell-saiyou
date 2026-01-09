{include file=$smarty.const.ADMIN_HEADER}
{if isset($userData.group) && $userData.group == 1}
    <div role="banner">
        <div class="interview_modal">
            <button type="button" class="drawer-toggle drawer-hamburger button">
                面接予定は<br>こちら
            </button>
            <nav class="drawer-nav" role="navigation">
                <div class="drawer-menu">
                    <div class="drawer-menu_search">
                        <iframe src="/interviewlist" width="830px" height="600px"></iframe>
                    </div>
                </div>
            </nav>
        </div>
    </div>
{/if}
<main role="main">
    <section class="top_content_wrap">
    </section>
    <section class="container date_info_col">
        <h1 class="breadcrumb date_info_breadcrumb inline">
            &gt;&nbsp;データ入力{if isset($id)}【ID. {$id}】{/if}
            {if isset($id) AND $authority === 0}
                <button id="edit" type="button" class="btn_orange index no_copy" value="{$id}" style="display:{if empty($editing)}inline{else}none{/if};">編集中にする</button>
                <button id="noedit" type="button" class="btn_orange index no_copy" value="{$id}" style="display:{if !empty($editing)}inline{else}none{/if};">編集中解除</button>
            {/if}
        </h1>
        {if isset($editing) AND $authority === 1}
            <div class="input_alert">
                <p>{$editing} さんが入力中です。現在編集はできません。</p>
            </div>
        {/if}
        {$editing} ☆ {$authority}
        <div class="form_wrap">
            <form id="form" class="data_form" action="/inputdata/data/{$id}" method="post" enctype="multipart/form-data">
                <div{if isset($id) AND $authority === 0} class="layer"{/if}></div>
                <!-- date_info_inner-->
                <div class="date_info_inner">
                    <div class="input_top_line">
                        <div class="officer">
                            担当：{if isset($staff_name)}{$staff_name|default:"不明"}{else}{/if}
                        </div>
                        {if isset($id)}
                            {if isset($default.status) AND $default.status == 2}
                                <div class="input_show_index">
                                    <a href="/index/?dataId={$id}"><button type="button" class="btn_orange index no_copy">採用情報を見る</button></a>
                                </div>
                            {/if}
                            {if isset($userData.group) && $userData.group == 1}
                                <div class="input_show_index">
                                    <button id="btn_id" form="form" class="btn_orange index sameperson no_copy" type="button" name="sameperson_form" value="sameperson_form">同一人物を探す</button>
                                </div>
                            {/if}
                        {/if}

                    </div>
                    <!--左サイドここから-->
                    <div class="date_left_col">

                        <!--★-->
                        {*                    {if $smarty.server.REMOTE_ADDR == '221.113.41.190'}*}
                        <!-- 申込日-->
                        <div class="white_box input_left">
                            <p>申込日時<span class="required2">※必須</span></p>
                            <div class="select_arrow select_input_half">
                                {$forms.submission_date.html}
                            </div>
                        </div>
                        {*                    {/if}*}
                        <!-- 申込日-->
                        {*                    <div class="white_box input_left">*}
                        {*                        <p>申込日<span class="required2">※必須</span></p>*}
                        {*                        <div class="select_arrow select_input_y">*}
                        {*                            {$forms.submission_year.html}*}
                        {*                        </div>*}
                        {*                        <span class="select_input_ymd_txt">年</span>*}
                        {*                        <div class="select_arrow select_input_md">*}
                        {*                            {$forms.submission_month.html}*}
                        {*                        </div>*}
                        {*                        <span class="select_input_ymd_txt">月</span>*}
                        {*                        <div class="select_arrow select_input_md">*}
                        {*                            {$forms.submission_day.html}*}
                        {*                        </div>*}
                        {*                        <span class="select_input_ymd_txt">日</span>*}
                        {*                    </div>*}
                        {*                    <!-- 申込時間-->*}
                        {*                    <div class="white_box input_left">*}
                        {*                        <p>申込時間</p>*}
                        {*                        <div class="select_arrow select_input_h">*}
                        {*                            {$forms.submission_hour.html}*}
                        {*                        </div>*}
                        {*                        <span class="select_ymd_txt">時</span>*}
                        {*                        <div class="select_arrow select_input_h">*}
                        {*                            {$forms.submission_time.html}*}
                        {*                        </div>*}
                        {*                        <span class="select_ymd_txt">分</span>*}
                        {*                    </div>*}
                        <!-- 申し込み方法-->
                        <div class="white_box input_left">
                            <p>申し込み方法<span class="required2">※必須</span></p>
                            <div class="select_arrow select_input_half">
                                {$forms.apply.html}
                            </div>
                        </div>

                        <!-- 他のやりとり手段-->
                        <div class="white_box input_left">
                            <p>他のやりとり手段</p>
                            <div class="select_arrow select_input_half">
                                {foreach from=$other_means_data item=value3 key=key3 name=means}
                                    <input type="text" size="20" class="responsible" id="form_means_data" value="{$value3.means|default:""}" name="means_data[{$smarty.foreach.means.index}][means]">
                                    <br /><br />
                                {/foreach}
                            </div>
                        </div>

                        <!-- 申込名-->
                        <div class="white_box input_left">
                            <p>申込名<span class="required">※必須</span></p>
                            {$forms.submission_name.html}
                            <p class="description">※全角、半角のスペースの入力があった場合は自動で除去されます<br />※旧字を使用するとエラーになり入力した内容がなくなりますので注意してください</p>
                        </div>
                        <!-- 店舗スタッフ-->
                        <div class="white_box input_left bottom20">
                            <div class="tenpostaff">
                                <label>
                                    <input type="hidden" name="staff_flg" value="0" />
                                    {$forms.staff_flg.html}
                                    <span class="checkbox-txt text_right">店舗スタッフ希望</span>
                                </label>
                            </div>
                        </div>

                        <!-- 面接予定日-->
                        <!--★-->
                        {*                    {if $smarty.server.REMOTE_ADDR == '221.113.41.190'}*}
                        <!-- 面接予定日時-->
                        <div class="white_box input_left">
                            <p>面接予定日時<span class="required">※必須</span></p>
                            <div class="select_arrow select_input_half">
                                {$forms.interview_date.html}
                            </div>
                        </div>
                        {*                    {/if}*}
                        {*                    <div class="white_box input_left">*}
                        {*                        <p>面接予定日<span class="required">※必須</span></p>*}
                        {*                        <div class="select_arrow select_input_y">*}
                        {*                            {$forms.interview_year.html}*}
                        {*                        </div>*}
                        {*                        <span class="select_input_ymd_txt">年</span>*}
                        {*                        <div class="select_arrow select_input_md">*}
                        {*                            {$forms.interview_month.html}*}
                        {*                        </div>*}
                        {*                        <span class="select_input_ymd_txt">月</span>*}
                        {*                        <div class="select_arrow select_input_md">*}
                        {*                            {$forms.interview_day.html}*}
                        {*                        </div>*}
                        {*                        <span class="select_input_ymd_txt">日</span>*}
                        {*                    </div>*}
                        {*                    <!-- 面接予定時間-->*}
                        <div class="white_box input_left relative">
                            {*                        <p>面接予定時間<span class="required">※必須</span></p>*}
                            {*                        <div class="select_arrow select_input_h">*}
                            {*                            {$forms.interview_hour.html}*}
                            {*                        </div>*}
                            {*                        <span class="select_ymd_txt">時</span>*}
                            {*                        <div class="select_arrow select_input_h">*}
                            {*                            {$forms.interview_time.html}*}
                            {*                        </div>*}
                            {*                        <span class="select_ymd_txt">分</span>*}
                            <div class="tbd">
                                <label>
                                    <input type="hidden" name="tentative_reserve_flg" value="0" />
                                    {$forms.tentative_reserve_flg.html}
                                    <span class="checkbox-txt text_right">仮予約</span>
                                </label>
                            </div>
                            <p class="description">仮予約の場合は面接予定メールは送信しない</p>
                        </div>
                        <!-- 連絡方法 -->
                        <div class="white_box input_left">
                            <p>連絡方法</p>
                            <div class="select_arrow select_input_half">
                                {$forms.contact.html}
                            </div>
                        </div>
                        <!-- タイマー-->
                        <div class="white_box input_left">
                            <p>タイマー</p>
                            <div class="timer">
                                <label>
                                    <input type="hidden" name="timer_flg" value="" />
                                    {$forms.timer_flg.html}
                                    <span class="checkbox-txt text_right">不要</span>
                                </label>
                            </div>
                        </div>
                        <!-- 面接前確認 -->
                        <div class="white_box input_left ">
                            <p>面接前確認</p>
                            <div class="select_arrow select_input_half">
                                {$forms.check.html}
                            </div>
                        </div>
                        <!-- 面接時間-->
                        <div class="white_box input_left relative">
                            <p class="inline">面接時間</p>
                            {$forms.timer.html}
                            <span class="select_ymd_txt">分前</span><span class="required">※必須</span>
                            {if isset($validate.timer)}
                                <span class="input_error">{$validate.timer}</span>
                            {/if}

                        </div>

                        <!-- 事前連絡日-->
                        <div class="white_box input_left">
                            <p>事前連絡日
                                <label>
                                    <input type="hidden" name="contact_flg" value="0" />
                                    {$forms.contact_flg.html}
                                    <span class="checkbox-txt text_right">連絡済</span>
                                </label>
                            </p>
                            <!--★-->
                            {*                        {if $smarty.server.REMOTE_ADDR == '221.113.41.190'}*}
                            <div class="select_arrow select_input_half">
                                {$forms.advance_contact_date.html}
                            </div>
                            {*                        {/if}*}
                            {*                        <input type="hidden" name="advance_contact_date_year" value="{$default.advance_contact_date_year|default:'0000'}" />*}
                            {*                        <input type="hidden" name="advance_contact_date_month" value="{$default.advance_contact_date_month|default:'00'}" />*}
                            {*                        <input type="hidden" name="advance_contact_date_day" value="{$default.advance_contact_date_day|default:'00'}" />*}
                            {*                        <div class="select_arrow select_input_y">*}
                            {*                            {$forms.advance_contact_date_year.html}*}
                            {*                        </div>*}
                            {*                        <span class="select_input_ymd_txt">年</span>*}
                            {*                        <div class="select_arrow select_input_md">*}
                            {*                            {$forms.advance_contact_date_month.html}*}
                            {*                        </div>*}
                            {*                        <span class="select_input_ymd_txt">月</span>*}
                            {*                        <div class="select_arrow select_input_md">*}
                            {*                            {$forms.advance_contact_date_day.html}*}
                            {*                        </div>*}
                            <span class="select_input_ymd_txt">日</span>
                            <p class="description">事前連絡日を変更する場合は連絡済チェックを外して下さい</p>
                        </div>

                        <!-- 面接店舗-->
                        <div class="white_box input_left">
                            <p>面接店舗</p>
                            <div class="select_arrow select_input_half">
                                {$forms.interviewshop.html}
                            </div>
                        </div>
                        <!-- 待ち合わせ場所-->
                        <div class="white_box input_left">
                            <p>待ち合わせ場所</p>
                            <div class="select_arrow select_input_half">
                                {$forms.place.html}
                            </div>
                        </div>
                        <!-- 待ち合わせ備考-->
                        <div class="white_box input_left">
                            <p>待ち合わせ備考</p>
                            {$forms.place_remarks.html}
                        </div>

                        <!-- 画像参照-->
                        <div class="white_box input_img">
                            <div class="imgInput">
                                <p>写真１</p>
                                <label for="filephoto_1" name="file1" class="photo_input">
                                    画像参照
                                    <input type="file" id="filephoto_1" class="photodata_input" name="filephoto_1" style="display:none;">
                                </label><br>
                                {if isset($default.image[1].img_id)}
                                    <a href="/img/girl_image/{$default.image[1].img_id}/{$default.image[1].img_id}.{$default.image[1].ext}">
                                        <img class="imgView" src="/img/girl_image/{$default.image[1].img_id}/{$default.image[1].img_id}.{$default.image[1].ext}?{$smarty.now}" alt=""/>
                                    </a>
                                    <div class="del_photo_wrap">
                                        <label for="img_del1">
                                            <input type="checkbox" id="img_del1" name="img_del[{$default.image[1].img_id}]" value="1"/>削除
                                        </label>
                                    </div>
                                    <input type="hidden" class="copy_imgId" name="copy_imgId[1]" value="{$default.image[1].img_id}" />
                                {/if}
                            </div><!--/.imgInput-->
                        </div>
                        <div class="white_box input_img">
                            <div class="imgInput">
                                <p>写真２</p>
                                <label for="filephoto_2" name="file2" class="photo_input">
                                    画像参照
                                    <input type="file" id="filephoto_2" class="photodata_input" name="filephoto_2" style="display:none;">
                                </label><br>
                                {if isset($default.image[2].img_id)}
                                    <a href="/img/girl_image/{$default.image[2].img_id}/{$default.image[2].img_id}.{$default.image[2].ext}">
                                        <img class="imgView" src="/img/girl_image/{$default.image[2].img_id}/{$default.image[2].img_id}.{$default.image[2].ext}?{$smarty.now}" alt=""/>
                                    </a>
                                    <div class="del_photo_wrap">
                                        <label for="img_del2">
                                            <input type="checkbox" id="img_del2" name="img_del[{$default.image[2].img_id}]" value="1"/>削除
                                        </label>
                                    </div>
                                    <input type="hidden" class="copy_imgId" name="copy_imgId[2]" value="{$default.image[2].img_id}" />
                                {/if}
                            </div><!--/.imgInput-->
                        </div>
                        <div class="white_box input_img">
                            <div class="imgInput">
                                <p>写真３</p>
                                <label for="filephoto_3" name="file3" class="photo_input">
                                    画像参照
                                    <input type="file" id="filephoto_3" class="photodata_input" name="filephoto_3" style="display:none;">
                                </label><br>
                                {if isset($default.image[3].img_id)}
                                    <a href="/img/girl_image/{$default.image[3].img_id}/{$default.image[3].img_id}.{$default.image[3].ext}">
                                        <img class="imgView" src="/img/girl_image/{$default.image[3].img_id}/{$default.image[3].img_id}.{$default.image[3].ext}?{$smarty.now}" alt=""/>
                                    </a>
                                    <div class="del_photo_wrap">
                                        <label for="img_del3">
                                            <input type="checkbox" id="img_del3" name="img_del[{$default.image[3].img_id}]" value="1"/>削除
                                        </label>
                                    </div>
                                    <input type="hidden" class="copy_imgId" name="copy_imgId[3]" value="{$default.image[3].img_id}" />
                                {/if}
                            </div><!--/.imgInput-->
                        </div>
                        {literal}
                            <script>
                              $(function(){
                                $(document).on('change', '.photodata_input', function() {

                                  var file = $(this).prop('files')[0],
                                    fileRdr = new FileReader(),
                                    selfFile = $(this).parents(".imgInput"),
                                    selfImg = selfFile.find('.imgView');

                                  if(!this.files.length){
                                    if(0 < selfImg.size()){
                                      selfImg.remove();
                                      return;
                                    }
                                  } else {
                                    if(file.type.match('image.*')){
                                      if(!(0 < selfImg.size())){
                                        selfFile.append('<a><img alt="" class="imgView"></a>');
                                      }
                                      var prevElm = selfFile.find('.imgView');
                                      var prevElm2 = selfFile.find('a');
                                      fileRdr.onload = function() {
                                        prevElm.attr('src', fileRdr.result);
                                        prevElm2.attr('href', fileRdr.result);
                                      }
                                      fileRdr.readAsDataURL(file);
                                    } else {
                                      if(0 < selfImg.size()){
                                        selfImg.remove();
                                        return;
                                      }
                                    }
                                  }
                                });


//                            var setFileInput = $('.imgInput');
//                            setFileInput.each(function(){
//                                var selfFile = $(this),
//                                        selfInput = $(this).find('input[type=file]');
//
//                                selfInput.change(function(){
//                                    var file = $(this).prop('files')[0],
//                                            fileRdr = new FileReader(),
//                                            selfImg = selfFile.find('.imgView');
//
//                                    if(!this.files.length){
//                                        if(0 < selfImg.size()){
//                                            selfImg.remove();
//                                            return;
//                                        }
//                                    } else {
//                                        if(file.type.match('image.*')){
//                                            if(!(0 < selfImg.size())){
//                                                selfFile.append('<a><img alt="" class="imgView"></a>');
//                                            }
//                                            var prevElm = selfFile.find('.imgView');
//                                            var prevElm2 = selfFile.find('a');
//                                            fileRdr.onload = function() {
//                                                prevElm.attr('src', fileRdr.result);
//                                                prevElm2.attr('href', fileRdr.result);
//                                            }
//                                            fileRdr.readAsDataURL(file);
//                                        } else {
//                                            if(0 < selfImg.size()){
//                                                selfImg.remove();
//                                                return;
//                                            }
//                                        }
//                                    }
//                                });
//                            });
                              });
                            </script>
                        {/literal}
                    </div><!--/date_left_col-->

                    <!--右サイドここから-->
                    <div class="date_right_col">
                        <!--ボタン-->
                        <div class="date_right_x" data-id="" style="display: none">
                            <img src="/assets/img/icon_x.png">
                        </div>
                        <div class="date_right_koshin">
                            <button id="btn_id" form="form" class="btn_orange update_form" type="submit" name="update_form" value="update_form" style="{if isset($id)}display:{if !empty($editing)}inline{else}none{/if};{/if}{if isset($editingId) AND $editingId != $userId}background:#CCC;" disabled="disabled{/if}">更新</button>
                        </div>
                        {if isset($id)}
                            {if isset($userData.group) && $userData.group == 1}
                                <div class="date_right_hukusei">
                                    <button class="btn_orange hukusei copy_form no_copy" type="button" style="display:{if !empty($editing)}inline{else}none{/if};">複製</button>
                                </div>
                                <div class="date_right_delete">
                                    <button id="button" class="btn_orange delete no_copy" type="button" style="display:{if !empty($editing)}inline{else}none{/if};">データ消去</button>
                                </div>
                            {/if}
                        {/if}
                        <!--掲載求人-->
                        <div class="white_box input_right SSSmall">
                            <p>掲載求人<span class="required2">※必須</span></p>
                            <div class="select_arrow">
                                {$forms.media.html}
                            </div>
                        </div>
                        <!--掲載業種-->
                        <div class="white_box input_right SSmall">
                            <p>掲載業種</p>
                            <div class="select_arrow genre_data">
                                {*{$forms.genre.html}*}
                                {$default.genre|default:""}
                                <input type="hidden" name="genre" value="{$default.genreId|default:""}" />
                            </div>
                        </div>
                        <!--掲載媒体-->
                        <div class="white_box input_right XSMedium" id="publicityBox" {if empty($default.publicity)}style="display:none;"{/if}>
                            <p>掲載媒体<span class="required2">※必須</span></p>
                            <div class="select_arrow">
                                {$forms.publicity.html}
                            </div>
                            <p class="description">面接で媒体を正確に聞き取れた場合は変更</p>
                        </div>
                        <!-- 検索エリア-->
                        <div class="white_box input_right SSmall" id="areaBox" {if empty($default.area)}style="display:none;"{/if}>
                            <p>検索エリア</p>
                            <div class="select_arrow">
                                {$forms.area.html}
                            </div>
                        </div>

                        <div class="white_box XSMedium clear" style="padding:0px;">
                            <div class="select_arrow">
                                {$forms.scout_mail_flg.html}
                            </div>
                        </div>

                        <!--SC-->
                        <div class="white_box input_right XSmall {if $userData.group === "2"}clear{/if}">
                            <p>SC<br><span class="required2">※必須</span></p>
                            <div class="select_arrow select_scout">
                                {$forms.scout.html}
                            </div>
                        </div>
                        <!--出戻り・移籍・紹介-->
                        <div class="white_box input_right">
                            <p>出戻り・移籍・紹介<br><span class="required2">※必須</span></p>
                            <div class="select_arrow">
                                {$forms.move.html}
                            </div>
                        </div>
                        {if $userData.group === "2"}
                            <!--面接予定日-->
                            {*                    <div class="white_box input_right XMedium shop_interview_date_select">*}
                            {*                        <p>面接予定日(店舗入力用)</p>*}
                            {*                        <div class="select_arrow select_input_y">*}
                            {*                            {$forms.interview_year_shopuser.html}*}
                            {*                        </div>*}
                            {*                        <span class="select_input_ymd_txt">年</span>*}
                            {*                        <div class="select_arrow select_input_md">*}
                            {*                            {$forms.interview_month_shopuser.html}*}
                            {*                        </div>*}
                            {*                        <span class="select_input_ymd_txt">月</span>*}
                            {*                        <div class="select_arrow select_input_md">*}
                            {*                            {$forms.interview_day_shopuser.html}*}
                            {*                        </div>*}
                            {*                        <span class="select_input_ymd_txt">日</span>*}
                            {*                    </div>*}
                            {*                        <input type="hidden" name="interview_date" value="{$default_interview_date}" />*}
                            {*                        <input type="hidden" name="interview_year" value="{$default_interview_year}" />*}
                            {*                        <input type="hidden" name="interview_month" value="{$default_interview_month}" />*}
                            {*                        <input type="hidden" name="interview_day" value="{$default_interview_day}" />*}
                        {/if}

                        <!--チェック-->
                        <div class="white_box input_check clear">
                            <p>面接希望条件欄</p>
                            <div class="checkbox">
                                {*<span class="text_ide">希望勤務地</span>*}
                                {*{$forms.hope_workplace.html}*}
                                <span class="text_ide">希望勤務地</span>
                                <select id="select_hope_workplace" name="hope_workplace" class="atleast">
                                    <optgroup label="全て選択">
                                        {$setting_data_select}
                                    </optgroup>
                                </select>
                                <input type="hidden" name="hope_workplace_hidden" id="hope_workplace_hidden" value="" />

                                <span class="text_ide">身分証</span>
                                <select id="select_apply_identity_card" name="apply_identity_card" class="atleast">
                                    <optgroup label="全て選択">
                                        {$person_select}
                                    </optgroup>
                                </select>
                                <input type="hidden" name="apply_identity_card_hidden" id="apply_identity_card_hidden" value="" />

                                <span class="text_ide">身分証備考</span>
                                {$forms.apply_identity_card_remark.html}

                                <br>
                                <label>
                                    <input type="hidden" name="residence_flg" value="0" />
                                    {$forms.residence_flg.html}
                                    <span class="checkbox-txt">居住地</span>
                                </label>
                                {$forms.residence.html}

                                <span class="select_other_txt">　</span>
                                <label>
                                    <input type="hidden" name="experience_possible_flg" value="0" />
                                    {$forms.experience_possible_flg.html}
                                    <span class="checkbox-txt text_right">体験可能</span>
                                </label>

                                <label class="without_prior_flg_1" {if empty($default.without_prior_flg)}style="opacity: 0.3;"{/if}>
                                    <input type="hidden" name="without_prior_flg" value="0" />
                                    {$forms.without_prior_flg.html}
                                    <span class="checkbox-txt text_right">面接のみ</span>
                                </label>
                                <br/>

                                <label class="hope_back_flg_1" {if empty($default.hope_back_flg)}style="opacity: 0.3;"{/if}>
                                    <input type="hidden" name="hope_back_flg" value="0" />
                                    {$forms.hope_back_flg.html}
                                    <span class="checkbox-txt">希望バック</span>
                                </label>
                                <label class="hope_back_flg_1" {if empty($default.hope_back_flg)}style="opacity: 0.3;"{/if}>
                                    {$forms.hope_back_price.html}
                                    <span class="select_other_txt text_right">円</span>
                                    {if isset($validate.hope_back_price)}
                                        <span class="input_error">{$validate.hope_back_price}</span>
                                    {/if}
                                </label>

                                <label class="warranty_flg_1" {if empty($default.warranty_flg)}style="opacity: 0.3;"{/if}>
                                    <input type="hidden" name="warranty_flg" value="0" />
                                    {$forms.warranty_flg.html}
                                    <span class="checkbox-txt">希望保証</span>
                                </label>
                                <label class="warranty_flg_1" {if empty($default.warranty_flg)}style="opacity: 0.3;"{/if}>
                                    {$forms.warranty_time.html}
                                    <span class="select_other_txt">時間</span>
                                    {if isset($validate.warranty_time)}
                                        <span class="input_error">{$validate.warranty_time}</span>
                                    {/if}

                                    {$forms.warranty_price.html}
                                    <span class="select_other_txt text_right">円</span>
                                    {if isset($validate.warranty_price)}
                                        <span class="input_error">{$validate.warranty_price}</span>
                                    {/if}
                                </label>
                                <label class="celebration_flg_1" {if empty($default.celebration_flg)}style="opacity: 0.3;"{/if}>
                                    <input type="hidden" name="celebration_flg" value="0" />
                                    {$forms.celebration_flg.html}
                                    <span class="checkbox-txt">入店祝い金</span>
                                </label>
                                {*{$forms.celebration_time.html}*}
                                {*<span class="select_other_txt">時間</span>*}
                                <label class="celebration_flg_1" {if empty($default.celebration_flg)}style="opacity: 0.3;"{/if}>
                                    {$forms.celebration_price.html}
                                    <span class="select_other_txt">円</span>

                                    {if isset($validate.celebration_price)}
                                        <span class="input_error">{$validate.celebration_price}</span>
                                    {/if}
                                </label>
                                <br>
                                <label class="transportation_expenses_flg_1" {if empty($default.transportation_expenses_flg)}style="opacity: 0.3;"{/if}>
                                    <input type="hidden" name="transportation_expenses_flg" value="0" />
                                    {$forms.transportation_expenses_flg.html}
                                    <span class="checkbox-txt text_right">交通費</span>
                                </label>


                                {*<label>*}
                                {*<input type="hidden" name="pick_up_flg" value="0" />*}
                                {*{$forms.pick_up_flg.html}*}
                                {*<span class="checkbox-txt text_right">送迎</span>*}
                                {*</label>*}
                                {*送迎を送り、迎えに分割*}
                                <label class="send_to_home_flg_1" {if empty($default.send_to_home_flg)}style="opacity: 0.3;"{/if}>
                                    <input type="hidden" name="send_to_home_flg" value="0" />
                                    {$forms.send_to_home_flg.html}
                                    <span class="checkbox-txt text_right">送り</span>
                                </label>
                                <label class="send_to_shop_flg_1" {if empty($default.send_to_shop_flg)}style="opacity: 0.3;"{/if}>
                                    <input type="hidden" name="send_to_shop_flg" value="0" />
                                    {$forms.send_to_shop_flg.html}
                                    <span class="checkbox-txt text_right">迎え</span>
                                </label>


                                <label class="single_room_wait_flg_1" {if empty($default.single_room_wait_flg)}style="opacity: 0.3;"{/if}>
                                    <input type="hidden" name="single_room_wait_flg" value="0" />
                                    {$forms.single_room_wait_flg.html}
                                    <span class="checkbox-txt text_right">個室待機</span>
                                </label>
                                <label class="dorm_flg_1" {if empty($default.dorm_flg)}style="opacity: 0.3;"{/if}>
                                    <input type="hidden" name="dorm_flg" value="0" />
                                    {$forms.dorm_flg.html}
                                    <span class="checkbox-txt text_right">寮</span>
                                </label>
                                <label class="nursery_flg_1" {if empty($default.nursery_flg)}style="opacity: 0.3;"{/if}>
                                    <input type="hidden" name="nursery_flg" value="0" />
                                    {$forms.nursery_flg.html}
                                    <span class="checkbox-txt text_right">託児所</span>
                                </label>
                                <label class="advance_salary_flg_1" {if empty($default.advance_salary_flg)}style="opacity: 0.3;"{/if}>
                                    <input type="hidden" name="advance_salary_flg" value="0" />
                                    {$forms.advance_salary_flg.html}
                                    <span class="checkbox-txt text_right">バンス</span>
                                </label>
                                <label class="working_away_flg_1" {if empty($default.working_away_flg)}style="opacity: 0.3;"{/if}>
                                    <input type="hidden" name="working_away_flg" value="0" />
                                    {$forms.working_away_flg.html}
                                    <span class="checkbox-txt">出稼ぎ</span>
                                    <div class="select_arrow" style="width: 60px;">
                                        {$forms.days_to_work_num.html}
                                    </div>
                                    <span class="select_other_txt">日間</span>
                                </label>

                                <br>
                                <label class="tatoo_flg_1" {if empty($default.tatoo_flg)}style="opacity: 0.3;"{/if}>
                                    <input type="hidden" name="tatoo_flg" value="0" />
                                    {$forms.tatoo_flg.html}
                                    <span class="checkbox-txt text_right">タトゥーや傷痕あり</span>
                                </label>
                                <label class="menses_flg_1" {if empty($default.menses_flg)}style="opacity: 0.3;"{/if}>
                                    <input type="hidden" name="menses_flg" value="0" />
                                    {$forms.menses_flg.html}
                                    <span class="checkbox-txt text_right">生理中</span>
                                </label>
                                <label class="same_person_flg_1" {if empty($default.same_person_flg)}style="opacity: 0.3;"{/if}>
                                    <input type="hidden" name="same_person_flg" value="0" />
                                    {$forms.same_person_flg.html}
                                    <span class="checkbox-txt text_right">同一人物あり</span>
                                </label>
                                <br />

                                {*<label>*}
                                {*<input type="hidden" name="identity_card_flg" value="0" />*}
                                {*{$forms.introduction_listening_flg.html}*}
                                {*<span class="checkbox-txt">紹介聞き取り</span>*}
                                {*</label>*}
                                {*<br />*}


                                {*{$forms.identity_card.html}<br>*}
                                {*<label>*}
                                {*<input type="hidden" name="residence_flg" value="0" />*}
                                {*{$forms.residence_flg.html}*}
                                {*<span class="checkbox-txt">居住地</span>*}
                                {*</label>*}
                                {*{$forms.residence.html}*}
                                {*<label>*}
                                {*<input type="hidden" name="confirmed_flg" value="0" />*}
                                {*{$forms.confirmed_flg.html}*}
                                {*<span class="checkbox-txt text_right">確認あり</span>*}
                                {*</label>*}

                                <label class="nikoiti_flg_1" {if empty($default.nikoiti_flg)}style="opacity: 0.3;"{/if}>
                                    <input type="hidden" name="nikoiti_flg" value="0" />
                                    {$forms.nikoiti_flg.html}
                                    <span class="checkbox-txt">ニコイチ</span>
                                </label>
                                <label class="nikoiti_flg_1" {if empty($default.nikoiti_flg)}style="opacity: 0.3;"{/if}>
                                    {$forms.nikoiti.html}<p class="description">ニコイチは面接予定情報で★マークがつく</p>
                                </label>

                                <br />
                                <label class="other_flg_1" {if empty($default.other_flg)}style="opacity: 0.3;"{/if}>
                                    <input type="hidden" name="other_flg" value="0" />
                                    {$forms.other_flg.html}
                                    <span class="checkbox-txt">その他</span>
                                </label>
                                {*{$forms.other.html}*}
                                <div style="width: 800px;">
                                    <textarea name="other" id="form_other" class="input_memo other_flg_1" {if empty($default.other_flg)}style="opacity: 0.3;"{/if}>{$default.other|nl2br|strip_tags:false|escape|default:""}</textarea>

                                    <span class="select_other_txt">　</span>
                                </div>
                            </div>
                            <div {if isset($userData.group) && $userData.group == 2}style="display: none;"{/if}>
                                <div style="display: flex;"><h5>求人センターメモ　</h5>
                                    <label>
                                        {$forms.confirm_introduction.html}
                                        <span class="checkbox-txt required">紹介確認</span>
                                    </label>
                                </div>
                                {*                            <div class="upper_memo">*}
                                {*                                勤務地候補:*}
                                {*                                {foreach  from=$setting_data.work_location key="key" item="work_location"}*}
                                {*                                    <label>{$forms.work_location[$key].html}<span class="checkbox-txt">{$work_location}</span></label>*}
                                {*                                {/foreach}*}

                                {*                                    <div id="slectReset" class="select_arrow">*}
                                {*                                        {$forms.confirmation_chk.html}*}
                                {*                                    </div><p id="confirmation_date_print" class="confirmation_date_print_1">{if !empty($default.confirmation_date)}{$default.confirmation_date|date_format:"%Y年%m月%d日(%a) %H:%M"}{/if}</p><input type="hidden" id="from_confirmation_date" class="confirmation_date_1" name="confirmation_date" value="{if !empty($default.confirmation_date)}{$default.confirmation_date}{/if}">*}
                                {*                            </div>*}
                                <div style="display: flex;">
                                    <textarea name="memo" class="input_memo">{$default.memo|nl2br|strip_tags:false|escape|default:""}</textarea>
                                </div>

                                <div style="display: flex;">
                                    <p class="description">※旧字を使用するとエラーになり入力した内容がなくなりますので注意してください<br /></p>
                                </div>

                                <div class="white_box input_left" style="margin-top: 20px;">
                                    <label>
                                        <input type="hidden" name="confirmation_chk_1" value="0" />
                                        {$forms.confirmation_chk_1.html}
                                        <span>社員確認済：</span>
                                        <p style="display: inline;" id="confirmation-date-print-1" class="confirmation-date-print-1">{if !empty($default.confirmation_date_1)}{$default.confirmation_date_1|date_format:"%Y年%m月%d日(%a) %H:%M"}{/if}</p><input type="hidden" id="from_confirmation_date_1" class="confirmation-date-1" name="confirmation_date_1" value="{if !empty($default.confirmation_date_1)}{$default.confirmation_date_1}{/if}">
                                    </label>
                                </div>
                                <div class="white_box input_left">
                                    <label>
                                        <input type="hidden" name="confirmation_chk_2" value="0" />
                                        {$forms.confirmation_chk_2.html}
                                        <span>深夜判断：</span>
                                        <p style="display: inline;" id="confirmation-date-print-2" class="confirmation-date-print-2">{if !empty($default.confirmation_date_2)}{$default.confirmation_date_2|date_format:"%Y年%m月%d日(%a) %H:%M"}{/if}</p><input type="hidden" id="from_confirmation_date_2" class="confirmation-date-2" name="confirmation_date_2" value="{if !empty($default.confirmation_date_2)}{$default.confirmation_date_2}{/if}">
                                    </label>
                                </div>
                                <div class="white_box input_left">
                                    <label>
                                        <input type="hidden" name="confirmation_chk_3" value="0" />
                                        {$forms.confirmation_chk_3.html}
                                        <span>不採用履歴確認済：</span>
                                        <p style="display: inline;" id="confirmation-date-print-3" class="confirmation-date-print-3">{if !empty($default.confirmation_date_3)}{$default.confirmation_date_3|date_format:"%Y年%m月%d日(%a) %H:%M"}{/if}</p><input type="hidden" id="from_confirmation_date_3" class="confirmation-date-3" name="confirmation_date_3" value="{if !empty($default.confirmation_date_3)}{$default.confirmation_date_3}{/if}">
                                    </label>
                                </div>
                                <div class="white_box input_left">
                                    <label>
                                        <input type="hidden" name="confirmation_chk_4" value="0" />
                                        {$forms.confirmation_chk_4.html}
                                        <span>採用通知確認済：</span>
                                        <p style="display: inline;" id="confirmation-date-print-4" class="confirmation-date-print-4">{if !empty($default.confirmation_date_4)}{$default.confirmation_date_4|date_format:"%Y年%m月%d日(%a) %H:%M"}{/if}</p><input type="hidden" id="from_confirmation_date_4" class="confirmation-date-4" name="confirmation_date_4" value="{if !empty($default.confirmation_date_4)}{$default.confirmation_date_4}{/if}">
                                    </label>
                                </div>

                            </div>

                            <!--右下サイドここから-->
                            <div class="date_right_btm_col_layer_yellow1">

                                <!--TEL-->
                                <div class="white_box yellow_box input_right XSMedium clear">
                                    <p>TEL</p>
                                    {$forms.tel01.html}
                                    <span class="hyphen">-</span>
                                    {$forms.tel02.html}
                                    <span class="hyphen">-</span>
                                    {$forms.tel03.html}
                                </div>
                                <!--Mail-->
                                <div class="white_box yellow_box input_right Mail">
                                    <p>Mail</p>
                                    {$forms.mail01.html}<span class="at">＠</span>
                                    <div class="select_arrow select_mail">
                                        {$forms.maildomain.html}
                                    </div>
                                </div>
                                <div class="white_box yellow_box input_right XSMedium" style="margin-top:-10px;padding:0px;">
                                    <p class="description" style="padding:0px;">相違がないか確認</p>
                                </div>
                                <div class="white_box yellow_box input_right XSMedium" style="margin-top:-10px;padding:0px;">
                                    <p class="description" style="padding:0px;">空欄の場合は面接で聞き取り記入する</p>
                                </div>
                                <!--年齢-->
                                <div class="white_box yellow_box input_right SSmall clear">
                                    <p>年齢</p>
                                    {$forms.age.html}
                                    <span class="select_other_txt">歳</span>
                                    {if isset($validate.age)}
                                        <span class="input_error">{$validate.age}</span>
                                    {/if}
                                </div>
                                <!--経験-->
                                <div class="white_box yellow_box input_right Small">
                                    <p>経験</p>
                                    <div class="select_arrow">
                                        <div class="select_arrow">
                                            <select id="select_experience" name="experience" class="atleast">
                                                <optgroup label="全て選択">
                                                    {$experience_select}
                                                </optgroup>
                                            </select>
                                            <input type="hidden" name="experience_hidden" id="experience_hidden" value="" />
                                        </div>
                                    </div>
                                </div>
                                <!--経験備考-->
                                <div class="white_box yellow_box input_right">
                                    <p>経験備考</p>
                                    {$forms.experience_remarks.html}
                                </div>
                                <div class="white_box yellow_box input_right XSMedium clear" style="margin-top:-10px;padding:0px;">
                                    <p class="description" style="padding:0px;">年齢・経験の相違があれば変更する</p>
                                </div>
                                <!--身長-->
                                <div class="white_box yellow_box input_right SSmall clear">
                                    <p>身長</p>
                                    {$forms.tall.html}
                                    <span class="select_other_txt">cm</span>
                                </div>
                                <!--体重-->
                                <div class="white_box yellow_box input_right SSmall">
                                    <p>体重</p>
                                    {$forms.weight.html}
                                    <span class="select_other_txt">kg</span>
                                </div>
                                <!--BMI-->
                                <div class="white_box input_right XSmall">
                                    <p>BMI</p>
                                    {$forms.bmi.html}
                                </div>
                                <!--バスト-->
                                <div class="white_box yellow_box input_right XSmall">
                                    <p>バスト</p>
                                    {$forms.bust.html}
                                    <span class="select_other_txt">cm</span>
                                </div>
                                <!--カップ数-->
                                <div class="white_box yellow_box input_right XSmall">
                                    <p>カップ数</p>
                                    <div class="select_arrow slect_input_cup">
                                        {$forms.cup.html}
                                    </div>
                                    <span class="select_other_txt">cup</span>
                                </div>
                                <!--ウエスト-->
                                <div class="white_box yellow_box input_right XSmall">
                                    <p>ウエスト</p>
                                    {$forms.waist.html}
                                    <span class="select_other_txt">cm</span>
                                </div>
                                <!--ヒップ-->
                                <div class="white_box yellow_box input_right XSmall">
                                    <p>ヒップ</p>
                                    {$forms.hip.html}
                                    <span class="select_other_txt">cm</span>
                                </div>
                                <div class="white_box yellow_box input_right Medium" style="margin-top:-10px;padding:0px;">
                                    <p class="description" style="padding:0px;">身長・体重の相違があれば変更する</p>
                                </div>
                                <div class="white_box yellow_box input_right XSMedium" style="margin-top:-10px;padding:0px;">
                                    <p class="description" style="padding:0px;">３サイズ・カップ数は面接で聞き取り記入する</p>
                                </div>
                                <br style="clear: both">
                            </div>


                            <div class="date_right_btm_col_layer_yellow2">

                                <!--所属店舗-->
                                <div class="white_box yellow_box input_right SSmall">
                                    <p>店舗</p>
                                    <div class="select_arrow">
                                        {$forms.belonging_store.html}
                                    </div>
                                </div>
                                <!--源氏名-->
                                <div class="white_box yellow_box input_right">
                                    <p>源氏名</p>
                                    {$forms.genji_name.html}
                                </div>
                                <!--源氏名(ふりがな)-->
                                <div class="white_box yellow_box input_right">
                                    <p>源氏名(ふりがな)</p>
                                    {$forms.genji_namekana.html}
                                    {if isset($validate.genji_namekana)}
                                        <span class="input_error">{$validate.genji_namekana}</span>
                                    {/if}
                                </div>
                                <!--画像アップロード-->
                                <div class="white_box yellow_box input_right">
                                    <div id="img_selectFile">
                                        <input id="img_upload" name="filephoto_4" type="file" style="display:none">
                                        <button class="photo_input_img">画像アップロード</button>

                                        {if isset($default.image[4].img_id)}
                                            <br />
                                            <a href="/img/girl_image/{$default.image[4].img_id}/{$default.image[4].img_id}.{$default.image[4].ext}">
                                                <img class="imgView" src="/img/girl_image/{$default.image[4].img_id}/{$default.image[4].img_id}.{$default.image[4].ext}?{$smarty.now}" alt=""/>
                                            </a>
                                            <br />
                                            <div class="del_photo_wrap" style="display: inline-block;margin: 0;">
                                                <label for="img_del4">
                                                    <input type="checkbox" id="img_del4" name="img_del[{$default.image[4].img_id}]" value="1"/>削除
                                                </label>
                                            </div>
                                            <input type="hidden" class="copy_imgId" name="copy_imgId[4]" value="{$default.image[4].img_id}" />
                                        {/if}
                                    </div>
                                </div>
                                <!--姓名-->
                                <div class="white_box yellow_box input_right SSSmall clear">
                                    <p>姓</p>
                                    {$forms.surname.html}
                                    <p class="description">※旧字を使用するとエラーになり入力した内容がなくなりますので注意してください</p>
                                </div>
                                <div class="white_box yellow_box input_right SSSmall">
                                    <p>名</p>
                                    {$forms.name.html}
                                    <p class="description">※旧字を使用するとエラーになり入力した内容がなくなりますので注意してください</p>
                                </div>
                                <!--ふりがな-->
                                <div class="white_box yellow_box input_right SSSmall">
                                    <p>姓（ふりがな）</p>
                                    {$forms.surnamekana.html}
                                    {if isset($validate.surnamekana)}
                                        <span class="input_error">{$validate.surnamekana}</span>
                                    {/if}

                                </div>
                                <div class="white_box yellow_box input_right SSSmall">
                                    <p>名（ふりがな）</p>
                                    {$forms.namekana.html}
                                    {if isset($validate.namekana)}
                                        <span class="input_error">{$validate.namekana}</span>
                                    {/if}

                                </div>
                                <!--住所-->
                                <div class="white_box yellow_box input_right LLarge clear">
                                    <p>住所</p>
                                    <div class="select_arrow select_address">

                                        <select name="pref">
                                            <option value="">—</option>
                                            {$pref_select}
                                        </select>
                                    </div>
                                    <span class="select_other_txt">都道府県</span>
                                    {$forms.address.html}
                                </div>
                                <!--面接結果-->
                                <div class="white_box yellow_box input_right SSSmall clear">
                                    <p>面接結果</p>
                                    <div class="select_arrow">
                                        {$forms.interview_result.html}
                                    </div>
                                </div>
                                <!--面接担当-->
                                <div class="white_box yellow_box input_right SSmall">
                                    <p>面接担当</p>
                                    <div class="select_arrow">
                                        {$forms.interview_staff.html}
                                    </div>

                                    {*                            <div class="select_arrow">*}
                                    {*                            <select id="form_interview_staff" name="interview_staff">*}
                                    {*                                {$interview_staff_select}*}
                                    {*                            </select>*}
                                    {*                            </div>*}

                                </div>
                                <!--面接担当（サブ）-->
                                <div class="white_box yellow_box input_right SSmall">
                                    <p>面接担当（サブ）</p>
                                    <div class="select_arrow">
                                        {$forms.interview_staff_sub.html}
                                    </div>

                                    {*                            <div class="select_arrow">*}
                                    {*                                <select id="form_interview_staff_sub" name="interview_staff_sub">*}
                                    {*                                    {$interview_staff_sub_select}*}
                                    {*                                </select>*}
                                    {*                            </div>*}

                                </div>
                                <!--KS担当-->
                                <div class="white_box yellow_box input_right SSmall">
                                    <p>KS担当</p>
                                    <div class="select_arrow">
                                        {$forms.ks_staff.html}
                                    </div>
                                </div>
                                <!-- 退店日-->
                                <!--★-->
                                {*                        {if $smarty.server.REMOTE_ADDR == '221.113.41.190'}*}
                                <div class="white_box yellow_box input_right Small clear">
                                    <p>退店日<span class="required3">※必須</span></p>
                                    <div class="select_arrow select_input_half" style="">
                                        {$forms.leaving_date.html}
                                    </div>
                                </div>
                                {*                        {/if}*}
                                {*                        <div class="white_box input_right XMedium clear">*}
                                {*                            <p>退店日<span class="required3">※必須</span></p>*}
                                {*                            <div class="select_arrow select_input_y">*}
                                {*                                {$forms.leaving_year.html}*}
                                {*                            </div>*}
                                {*                            <span class="select_ymd_txt">年</span>*}
                                {*                            <div class="select_arrow select_input_md">*}
                                {*                                {$forms.leaving_month.html}*}
                                {*                            </div>*}
                                {*                            <span class="select_ymd_txt">月</span>*}
                                {*                            <div class="select_arrow select_input_md">*}
                                {*                                {$forms.leaving_day.html}*}
                                {*                            </div>*}
                                {*                            <span class="select_ymd_txt">日</span>*}
                                {*                        </div>*}
                                <!--退店理由-->
                                <div class="white_box yellow_box input_right SSSmall">
                                    <p>退店理由</p>
                                    <div id="closed_reason" class="select_arrow">
                                        {$forms.leaving_reason.html}
                                    </div>
                                </div>
                                <!--勤務形態-->
                                <div class="white_box yellow_box input_right SSmall clear">
                                    <p>勤務形態</p>
                                    <div class="select_arrow">
                                        {$forms.work.html}
                                    </div>
                                </div>
                                <!--本人確認-->
                                <div class="white_box yellow_box input_right SSmall">
                                    <p>身分証</p>
                                    <div class="select_arrow">
                                        <select id="select_identity_card" name="identity_card_select">
                                            <optgroup label="全て選択">
                                                {$person_select}
                                            </optgroup>
                                        </select>
                                        <input type="hidden" name="identity_card_select_hidden" id="identity_card_select_hidden" value="" />
                                    </div>
                                </div>
                                <!--備考欄（本人確認用）-->
                                <div class="white_box yellow_box input_right Small">
                                    <p>身分証備考</p>
                                    {$forms.identity_card_remarks.html}
                                </div>
                                <!--給料-->
                                <div class="white_box yellow_box input_right SSmall clear">
                                    <p>給料</p>
                                    {$forms.salary.html}
                                    <span class="select_other_txt">円</span>
                                    {if isset($validate.salary)}
                                        <span class="input_error">{$validate.salary}</span>
                                    {/if}

                                </div>
                                <!--特別指名料-->
                                <div class="white_box yellow_box input_right SSmall">
                                    <p>特別指名料</p>
                                    {$forms.nomination_fee.html}
                                    <span class="select_other_txt">円</span>
                                    {if isset($validate.nomination_fee)}
                                        <span class="input_error">{$validate.nomination_fee}</span>
                                    {/if}
                                </div>
                                <!--他店紹介-->
                                <div class="white_box yellow_box input_right">
                                    <p>他店グループ紹介</p>
                                    {*                            <p>他店紹介</p>*}
                                    <div class="select_arrow">
                                        {$forms.another_shop.html}
                                    </div>
                                </div>
                                <!--備考（他店紹介用）-->
                                <div class="white_box yellow_box input_right XSMedium">
                                    <p>他店グループ紹介備考</p>
                                    {*                            <p>他店紹介備考</p>*}
                                    {$forms.another_shop_remarks.html}
                                </div>
                                <!--検索ワード-->
                                <div class="input_right clear">
                                    <p>検索ワード</p>

                                    {*<div class="word_col">*}
                                    {*<div class="word_number">1</div>*}
                                    {*<div class="select_arrow select_word">*}
                                    {*{$forms.word1.html}*}
                                    {*</div>*}
                                    {*</div>*}

                                    {*<div class="word_col">*}
                                    {*<div class="word_number">2</div>*}
                                    {*<div class="select_arrow select_word">*}
                                    {*{$forms.word2.html}*}
                                    {*</div>*}
                                    {*</div>*}

                                    <div class="word_col">
                                        <div class="word_number">1.大阪　</div>
                                    </div>
                                    <div class="word_col">
                                        <div class="word_number">2.風俗　</div>
                                    </div>

                                    <div class="word_col">
                                        <div class="word_number">3</div>
                                        <div class="select_arrow select_word">
                                            {$forms.word3.html}
                                        </div>
                                    </div>

                                    <div class="word_col">
                                        <div class="word_number">4</div>
                                        <div class="select_arrow select_word">
                                            {$forms.word4.html}
                                        </div>
                                    </div>

                                    <div class="word_col">
                                        <div class="word_number">5</div>
                                        <div class="select_arrow select_word">
                                            {$forms.word5.html}
                                        </div>
                                    </div>

                                    <div class="word_col">
                                        <div class="word_number">6</div>
                                        <div class="select_arrow select_word">
                                            {$forms.word6.html}
                                        </div>
                                    </div>
                                </div>

                                <!--備考（検索ワード）-->
                                <div class="white_box yellow_box input_right XSMedium">
                                    <p>検索ワード備考</p>
                                    {$forms.word_remarks.html}
                                </div>


                                <!--備考-->
                                <div class="white_box yellow_box input_left">
                                    <div class="right_absl" style="top:-30px;right:-200px;">
                                        <!--初回出勤日-->
                                        <!--★-->
                                        {*                                    {if $smarty.server.REMOTE_ADDR == '221.113.41.190'}*}
                                        <div class="white_box yellow_box input_absl" style="width: 40%;">
                                            <p class="inline">初回出勤日</p>
                                            <div class="select_arrow select_input_half">
                                                {$forms.working_day_date.html}
                                            </div>
                                        </div>
                                        {*                                    {/if}*}
                                        {*                                    <div class="white_box input_absl">*}
                                        {*                                        <p class="inline">初回出勤日</p>*}
                                        {*                                        <div class="select_arrow select_absl_y">*}
                                        {*                                            {$forms.working_day_year.html}*}
                                        {*                                        </div>*}
                                        {*                                        <span class="select_ymd_txt">年</span>*}
                                        {*                                        <div class="select_arrow select_absl_md">*}
                                        {*                                            {$forms.working_day_month.html}*}
                                        {*                                        </div>*}
                                        {*                                        <span class="select_ymd_txt">月</span>*}
                                        {*                                        <div class="select_arrow select_absl_md">*}
                                        {*                                            {$forms.working_day_day.html}*}
                                        {*                                        </div>*}
                                        {*                                        <span class="select_ymd_txt">日</span>*}
                                        {*                                    </div>*}
                                        <div class="checkbox3">
                                            <label>
                                                <input type="hidden" name="working_day_undecided_flg" value="0" />
                                                {$forms.working_day_undecided_flg.html}
                                                <span class="checkbox-txt text_right">未定</span>
                                            </label>
                                        </div>
                                    </div><!--/right_absl-->
                                    <p>備考</p>
                                    {$forms.remarks.html}
                                    <p class="description">※旧字を使用するとエラーになり入力した内容がなくなりますので注意してください</p>
                                </div>
                                <!--追跡理由-->
                                <div class="white_box yellow_box input_right SSSmall clear" {if isset($userData.group) && $userData.group == 2}style="display: none;"{/if}>
                                    <p>追跡理由</p>
                                    <div id="slectReset" class="select_arrow">
                                        {$forms.reason.html}
                                    </div>
                                </div>
                                <!-- 追跡予定日-->
                                <div class="white_box yellow_box input_right Small" {if isset($userData.group) && $userData.group == 2}style="display: none;"{/if}>
                                    <!--★-->
                                    {*                                {if $smarty.server.REMOTE_ADDR == '221.113.41.190'}*}
                                    <p>追跡予定日時</p>
                                    <div class="select_arrow select_input_half">
                                        {$forms.scheduled_date.html}
                                    </div>
                                    {*                                {/if}*}
                                    {*                                <p>追跡予定日</p>*}
                                    {*                                <div id="slectReset" class="select_arrow select_input_y">*}
                                    {*                                    {$forms.scheduled_date_year.html}*}
                                    {*                                </div>*}
                                    {*                                <span class="select_ymd_txt">年</span>*}
                                    {*                                <div id="slectReset" class="select_arrow select_input_md">*}
                                    {*                                    {$forms.scheduled_date_month.html}*}
                                    {*                                </div>*}
                                    {*                                <span class="select_ymd_txt">月</span>*}
                                    {*                                <div id="slectReset" class="select_arrow select_input_md">*}
                                    {*                                    {$forms.scheduled_date_day.html}*}
                                    {*                                </div>*}
                                    {*                                <span class="select_ymd_txt">日</span>*}
                                </div>
                                <div class="white_box yellow_box input_right XMedium input_flex" style="{if isset($userData.group) && $userData.group == 2}display: none;{/if}">
                                    <p></p>
                                    <div id="slectReset" class="select_arrow select_input_md">
                                        {$forms.scheduled_date_hour.html}
                                    </div>
                                    <span class="select_ymd_txt">時</span>
                                    <!--追跡中止-->
                                    <div class="white_box yellow_box input_how" style="float:right;margin-top:10px;margin-left:10px;{if isset($userData.group) && $userData.group == 2}display: none;{/if}">
                                        <div class="">
                                            <label>
                                                <input type="hidden" name="stop_tracking_flg" value="1" />
                                                {$forms.stop_tracking_flg.html}
                                                <span class="checkbox-txt text_right">追跡中止</span>
                                            </label>
                                        </div>
                                    </div>
                                    {if isset($id)}
                                        <div class="no_copy">
                                            <button type="button" class="tracking_remarks_update">追跡振り分け更新</button>
                                        </div>
                                    {/if}
                                </div>
                                <!--追跡備考-->
                                <div class="white_box yellow_box input_left" {if isset($userData.group) && $userData.group == 2}style="display: none;"{/if}>
                                    <p>追跡備考</p>
                                    {foreach from=$tracking_remarks_data item=value2 key=key2 name=tracking}
                                        <div class="remark_box">
                                            <span class="select_ymd_txt">日付</span>
                                            <!--★-->
                                            {*                                    {if $smarty.server.REMOTE_ADDR == '221.113.41.190'}*}
                                            <div class="select_arrow select_input_half" style="width: 22%;">
                                                <input type="text" class="date_time2" id="form_scheduled_date_remarks" name="tracking_data[{$smarty.foreach.tracking.index}][scheduled_date_remarks]" value="{if isset($value2.scheduled_date)}{$value2.scheduled_date}{/if}" />
                                            </div>
                                            {*                                    {/if}*}
                                            {*                                    <div class="select_arrow select_remark_y">*}
                                            {*                                        <select class="scheduled_date_remarks_year" name="tracking_data[{$smarty.foreach.tracking.index}][scheduled_date_remarks_year]">*}
                                            {*                                            {foreach from=$setting_data.year item=value key=key}*}
                                            {*                                                <option value="{$key}" {if isset($value2.scheduled_date_year) AND $value2.scheduled_date_year == $key}selected{/if}>{$value}</option>*}
                                            {*                                            {/foreach}*}
                                            {*                                        </select>*}
                                            {*                                    </div>*}
                                            {*                                    <span class="select_ymd_txt">年</span>*}
                                            {*                                    <div class="select_arrow select_remark_md">*}
                                            {*                                        <select class="scheduled_date_remarks_month" name="tracking_data[{$smarty.foreach.tracking.index}][scheduled_date_remarks_month]">*}
                                            {*                                            {foreach from=$setting_data.month item=value key=key}*}
                                            {*                                                <option value="{$key}" {if isset($value2.scheduled_date_month) AND $value2.scheduled_date_month == $key}selected{/if}>{$value}</option>*}
                                            {*                                            {/foreach}*}
                                            {*                                        </select>*}
                                            {*                                    </div>*}
                                            {*                                    <span class="select_ymd_txt">月</span>*}
                                            {*                                    <div class="select_arrow select_remark_md">*}
                                            {*                                        <select class="scheduled_date_remarks_day" name="tracking_data[{$smarty.foreach.tracking.index}][scheduled_date_remarks_day]">*}
                                            {*                                            {foreach from=$setting_data.day item=value key=key}*}
                                            {*                                                <option value="{$key}" {if isset($value2.scheduled_date_day) AND $value2.scheduled_date_day == $key}selected{/if}>{$value}</option>*}
                                            {*                                            {/foreach}*}
                                            {*                                        </select>*}
                                            {*                                    </div>*}
                                            {*                                    <span class="select_ymd_txt">日</span>*}
                                            <span class="select_other_txt">担当</span>
                                            <input type="text" size="10" class="responsible" value="{$value2.responsible|default:""}" name="tracking_data[{$smarty.foreach.tracking.index}][responsible]">
                                            <span class="select_other_txt">経過</span>
                                            <input type="text" size="35" class="passage" value="{$value2.passage|default:""}" name="tracking_data[{$smarty.foreach.tracking.index}][passage]">
                                        </div>
                                    {/foreach}
                                </div>
                                <br style="clear: both">
                            </div>

                            <div class="date_right_btm_col">
                                <div class="confirm_btn">
                                    <button id="btn_id2" form="form" type="submit" class="btn_orange complete_form" name="complete_form" value="complete_form" style="{if isset($id)}display:{if !empty($editing)}inline{else}none{/if};{/if}{if isset($editingId) AND $editingId != $userId}background:#CCC;" disabled="disabled{/if}">確定</button>
                                </div>
                            </div><!--/date_right_btm_col-->
                            <!--確定ボタン-->

                        </div><!--/date_right_col-->
                    </div><!-- /date_info_inner-->

                    <input type="hidden" name="usergroup" value="{$userData.group}" />
                </div>
            </form><!-- /data_form -->
    </section>

</main>
{literal}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="/assets/js/jquery.multiple.select.js"></script>

<link rel="stylesheet" type="text/css" href="/assets/css/flatpickr.css">
<link rel="stylesheet" type="text/css" href="/assets/css/airbnb.min.css">
    <script type="text/javascript" src="/assets/js/flatpickr.min.js"></script>
    <script type="text/javascript" src="/assets/js/ja.min.js"></script>

<script>

  // 連絡済 チェックボックスにチェックがあると事前連絡日は編集不可
  $(function() {
    // ディフォルト判定
    if ( $('#form_contact_flg').prop('checked') == true ) {
      console.log('checked');
      $('#form_advance_contact_date').prop('disabled', true);
      $('#form_advance_contact_date_year').prop('disabled', true);
      $('#form_advance_contact_date_month').prop('disabled', true);
      $('#form_advance_contact_date_day').prop('disabled', true);
    }else{
      console.log('no checked');
      $('#form_advance_contact_date').prop('disabled', false);
      $('#form_advance_contact_date_year').prop('disabled', false);
      $('#form_advance_contact_date_month').prop('disabled', false);
      $('#form_advance_contact_date_day').prop('disabled', false);
    }

    // チェック クリック判定
    $('#form_contact_flg').on('click', function() {
      if ( $(this).prop('checked') == false ) {
        $('#form_advance_contact_date').prop('disabled', false);
        $('#form_advance_contact_date_year').prop('disabled', false);
        $('#form_advance_contact_date_month').prop('disabled', false);
        $('#form_advance_contact_date_day').prop('disabled', false);
      } else {
        $('#form_advance_contact_date').prop('disabled', true);
        $('#form_advance_contact_date_year').prop('disabled', true);
        $('#form_advance_contact_date_month').prop('disabled', true);
        $('#form_advance_contact_date_day').prop('disabled', true);
      }
    });
  });


  //確定・更新ボタンの条件分岐
  $(function(){
      {/literal}{if isset($addjs)}{$addjs}{/if}{literal}

    var check_number = function(value) {

      // 入力されていない場合チェックしない
      if(value == null || value == '') {
        return true;
      }

      if (value.match(/[^0-9]+/)) {
        return false;
      }

      return true;
    };

    var check_email = function(value) {

      // 入力されていない場合チェックしない
      if(value == null || value == '') {
        return true;
      }

      if (!value.match(/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*$/)) {
        return false;
      }

      return true;
    };

      {/literal}{if $userData.group === "2"}{literal}
    $(".date_left_col").find("input").attr("disabled", "disabled");
    $(".date_left_col").find("select").attr("disabled", "disabled");
      {/literal}{/if}{literal}

    // 更新ボタン
    $('.update_form').on('click', function() {

      console.log('★');

      var error_message = "";
      var error_flg = 0;

      // if( ($("#form_media").val() == '' && $("#form_scout").val() == '' && $("#form_move").val() == '')) {
      if( ($("#changeSelect").val() == '' && $("#form_scout").val() == '' && $("#form_move").val() == '')) {
        error_message = "「掲載求人」、「SC」「出戻り・移籍・紹介」のいづれかを入力して下さい。\n";
        error_flg = 1;
      } else {
        //2019/05/09 掲載媒体・掲載エリアの必須削除
        // if ($("#form_media").val() != '') {
        //     if($("#form_publicity").val() == '' || $("#form_area").val() == '') {
        //         error_message = "掲載媒体および掲載エリアを入力してください。\n";
        //         error_flg = 1;
        //     }
        //
        //2022/02/22 掲載求人選択後の掲載媒体の必須追加
        if ($("#changeSelect").val() != '') {
          if($("#changeSelect2").val() == '') {
            error_message = "掲載媒体を選択してください。\n";
            error_flg = 1;
          }
        }
      }

        {/literal}{if $userData.group === "2"}{literal}
      // if(($('.shop_interview_date_select .reqSelect7').val() == 0 || $('.shop_interview_date_select .reqSelect8').val() == 0 || $('.shop_interview_date_select .reqSelect9').val() == 0)){
      //     error_message = error_message + "面接予定日(店舗入力用)を入力して下さい。\n";
      //     error_flg = 1;
      // }
        {/literal}{/if}{literal}

      if(error_flg === 1){
        swal(error_message);
        return false;
      }

      // var val = $('.reqSelect').val(); // 申込日 年
      // var val2 = $('.reqSelect2').val(); // 申込日 月
      // var val3 = $('.reqSelect3').val(); // 申込日 日
      var val4 = $('.input_req').val(); // 申し込み方法
      var val13 = $('.reqSelect12').val(); // 退店日の場合のみ？

      if( val4 == '' || val13 == 0) {
        // if( val == 0 ||  val2 == 0 || val3 == 0 || val4 == '' || val13 == 0) {

        swal('水色の必須部分を入力してください');
        return false;
      }

      var val_age = $('#form_age').val();
      if (!check_number(val_age)) {
        swal('年齢は半角数字しか入力できません。');
        return false;
      }

      var val_tel01 = $('#form_tel01').val();
      var val_tel02 = $('#form_tel02').val();
      var val_tel03 = $('#form_tel03').val();

      if (!check_number(val_tel01) || !check_number(val_tel02) || !check_number(val_tel03)) {
        swal('TELは半角数字しか入力できません。');
        return false;
      }

      var val_mail01 = $('#form_mail01').val();
      if (!check_email(val_mail01)) {
        swal('メールの入力形式を確認してください。');
        return false;
      }

      var select_experience = $('#select_experience').multipleSelect('getSelects');
      $('#experience_hidden').val(select_experience);

      var identity_card_select = $('#select_identity_card').multipleSelect('getSelects');
      $('#identity_card_select_hidden').val(identity_card_select);

      var apply_identity_card = $('#select_apply_identity_card').multipleSelect('getSelects');
      $('#apply_identity_card_hidden').val(apply_identity_card);

      var hope_workplace = $('#select_hope_workplace').multipleSelect('getSelects');
      $('#hope_workplace_hidden').val(hope_workplace);
    });

    // 【確定】ボタン
    $('#btn_id2').click(function(){
      //if( ($("#form_media").val() == '' || $("#form_scout").val() == 0 || $("#form_move").val()) && ($('.reqSelect7').val() == 0 || $('.reqSelect8').val() == 0 || $(".input_req3").val() == '' || $('.reqSelect9').val() == 0)) {
      // if( ($("#form_media").val() == '' || $("#form_scout").val() == 0 || $("#form_move").val()) && $(".input_req3").val() == '' ) {
      //
      //     swal('全ての必須部分を入力してください★');
      //     return false;
      // }


      var val3 = $('.reqSelect1').val();  // 申込日時 or 面接予定日時
      var val12 = $('.input_req2').val();  // 申し込み方法
      var val14 = $('.input_req3').val();  // 申込名
      var val15 = $('.input_req4').val();  //  面接時間 分前
      var val4 = $('#changeSelect').val();  // 掲載求人
      var val5 = $('#form_scout').val();  // SC
      var val7 = $('#form_move').val();  // 出戻り・移籍・紹介
      var val8 = $('#changeSelect2').val();  // 掲載媒体
      // var val6 = $('.reqSelect6').val();
      // // var val8 = $('.reqSelect8').val();
      // // var val9 = $('.reqSelect9').val();
      // var val10 = $('.reqSelect10').val();
      // var val11 = $('.reqSelect11').val();
      // var val13 = $('.reqSelect12').val();

      // if( val4 == 0 || val5 == 0 || val6 == 0 || val7 == 0
      //         || val8 == 0 || val9 == 0  || val10 == ''
      //         || val11 == '' || val12== '' || val13 == 0 || val14 == '' || val15 == '') {
      // if( val6 == 0 || val10 == '' || val11 == '' || val12== '' || val13 == 0 || val14 == '' || val15 == '') {

      // console.log(val4);

      // 掲載求人がない場合はSC、出戻り・移籍・紹介を必須に
      if( val4 == '' || val4 == null ){
        if( val3 == '' || val12 == '' || val14 == '' || val15== '' || ( val5 == null && val7 == null) || ( val5 == '' && val7 == '') ) {
          // console.log(val3);
          // console.log(val12);
          // console.log(val14);
          // console.log(val15);
          // console.log(val5);
          // console.log(val7);

          swal('赤・青 全ての必須部分を入力してください');
          return false;
        }
        // 掲載求人がある場合
      }else{
        if( val3 == '' || val12 == '' || val14 == '' || val15== '' || val4 == '' || val8 == '') {
          // console.log(val3);
          // console.log(val12);
          // console.log(val14);
          // console.log(val15);
          // console.log(val4);
          // console.log(val8);

          swal('赤・青 全ての必須部分を入力してください。');
          return false;
        }
      }



      var val_age = $('#form_age').val();
      if (!check_number(val_age)) {
        swal('年齢は半角数字しか入力できません。');
        return false;
      }

      var val_tel01 = $('#form_tel01').val();
      var val_tel02 = $('#form_tel02').val();
      var val_tel03 = $('#form_tel03').val();

      if (!check_number(val_tel01) || !check_number(val_tel02) || !check_number(val_tel03)) {
        swal('TELは半角数字しか入力できません。');
        return false;
      }

      var val_mail01 = $('#form_mail01').val();
      if (!check_email(val_mail01)) {
        swal('メールの入力形式を確認してください。');
        return false;
      }

      var select_experience = $('#select_experience').multipleSelect('getSelects');
      $('#experience_hidden').val(select_experience);

      var identity_card_select = $('#select_identity_card').multipleSelect('getSelects');
      $('#identity_card_select_hidden').val(identity_card_select);

      var apply_identity_card = $('#select_apply_identity_card').multipleSelect('getSelects');
      $('#apply_identity_card_hidden').val(apply_identity_card);

      var hope_workplace = $('#select_hope_workplace').multipleSelect('getSelects');
      $('#hope_workplace_hidden').val(hope_workplace);
    });
  });

  //退店日必須
  $(function() {
    $('#closed_reason select').change(function(){
      var closedReason = $(this).val();
      if (closedReason == 0) {
        $('.required3').hide();
        $('select#required3').removeClass("reqSelect12");
      } else {
        $('.required3').show();
        $('select#required3').attr("class", "reqSelect12");
      }
    });
  });

  //データ消去アラート
  $('#button').on('click', function() {
    var options = {
      title: "本当に消去しますか？"
    };

    swal(options)
      .then(function(val){
        if(val === true){
          $.ajax({
            type:"POST",
            url:"/api/del_input_data",
            cache: false,
            data:{
              'dataid':{/literal}{if isset($id)}{$id}{else}''{/if}{literal}
            },
            timeout: 10000
          }).done(function(data) {
            location.href = "/";
          });
        }
      });
  });

  //編集中ボタン
  $('#edit').on('click', function() {

    var data_id = $("#edit").val();
    console.log(data_id);

    $.ajax({
      type:"POST",
      url:"/api/insert_edit",
      cache: false,
      data:{
        'dataid':data_id
      },
      timeout: 10000
    }).done(function(data) {
      // location.href = "/";
    });

    $('#edit').css('display','none');
    $('.update_form').css('display','block');
    $('.hukusei').css('display','block');
    $('.delete').css('display','block');
    $('.complete_form').css('display','block');
    $('#noedit').css('display','inline');

    $('.layer').css('position','relative');

  });
  //編集中解除ボタン
  $('#noedit').on('click', function() {

    var data_id = $("#edit").val();
    console.log(data_id);

    $.ajax({
      type:"POST",
      url:"/api/del_edit",
      cache: false,
      data:{
        'dataid':data_id
      },
      timeout: 10000
    }).done(function(data) {
      // location.href = "/inputdata/data/".data_id;
    });

    $('#edit').css('display','inline');
    $('.update_form').css('display','none');
    $('.hukusei').css('display','none');
    $('.delete').css('display','none');
    $('.complete_form').css('display','none');
    $('#noedit').css('display','none');

    $('.layer').css('position','absolute');

  });

  //同一人物を探す
  $('.sameperson').on('click', function() {
    // //申込名
    // if($("#form_submission_name").val() != ''){
    //     var submission_name = $("#form_submission_name").val();
    // }
    // if(!submission_name){
    //     swal('申込名を入力して下さい');
    //     return false;
    // }
    //TEL
    // if($("#form_tel01").val() != '' && $("#form_tel02").val() != '' && $("#form_tel03").val() != ''){
    //     var tel = $("#form_tel01").val() + "-" + $("#form_tel02").val() + "-" + $("#form_tel03").val();
    // }


    //姓（ふりがな）
    if($("#form_surnamekana").val() != ''){
      var surnamekana = $("#form_surnamekana").val();
    }
    //名（ふりがな）
    if($("#form_namekana").val() != ''){
      var namekana = $("#form_namekana").val();
    }
    if($("#form_tel01").val() != ''){
      var tel01 = $("#form_tel01").val();
    }
    if($("#form_tel02").val() != ''){
      var tel02 = $("#form_tel02").val();
    }
    if($("#form_tel03").val() != ''){
      var tel03 = $("#form_tel03").val();
    }


    console.log(surnamekana);
    console.log(namekana);
    console.log(tel01);
    console.log(tel02);
    console.log(tel03);


    if(!surnamekana && !namekana && !tel01 && !tel02 && !tel03){

      swal( 'TELもしくはふりがなを入力してください。' );
      return false;

      // var swal_chk = new String();
      //     if(!surnamekana){
      //         swal_chk += '姓（ふりがな）を入力して下さい\n';
      //     }
      //     if(!namekana){
      //         swal_chk += '名（ふりがな）を入力して下さい\n';
      //     }
      //     if(!tel01){
      //         swal_chk += 'TELを入力して下さい\n';
      //     }
      //     if(!tel02){
      //         swal_chk += 'TELを入力して下さい\n';
      //     }
      //     if(!tel03){
      //         swal_chk += 'TELを入力して下さい\n';
      //     }
      // swal( swal_chk );
      // return false;
    }


    $.ajax({
      type:"POST",
      url:"/inputdata/sameperson/" + {/literal}{if isset($id)}{$id}{else}''{/if}{literal},
      cache: false,
      data:{
        // 'submission_name': submission_name,
        'surnamekana': surnamekana,
        'namekana': namekana,
        'tel01': tel01,
        'tel02': tel02,
        'tel03': tel03
      },
      timeout: 10000
    }).done(function(data) {
      $(".data_sameperson_form").remove();
      $("#form").append(data);
    });
  });

  //select 複数選択
  $(function() {
    var $selects = $('[id=select_word]');
    $selects.multipleSelect();
  });

  //select 追跡中止
  $('#checkReset').click(function() {
    if ( $(this).prop('checked') == true ) {
      $("#slectReset select").val(0);
    }
  });

  //画像アップロード
  $('#img_selectFile').on('click', 'button', function () {
    $('#img_upload').click();
    return false;
  });

  $('#img_upload').on('change', function() {
    var file = $(this).prop('files')[0];
    if(!($('.filename').length)){
      $('#img_selectFile').append('<div class="filename"></div>');
    };
    $('.filename').html('ファイル名：' + file.name);
  });

  // // 確認 / 判断
  // $( document ).on('change', '.confirmation_chk', function(){
  //     var data_id = $(this).attr('data-id');
  //     var val = $(this).val();
  //     console.log(data_id);
  //     var y = new Date().getFullYear();
  //     var m = new Date().getMonth() + 1;
  //     var d = new Date().getDate();
  //     var w = new Date().getDay();
  //     var wd = ["日","月","火","水","木","金","土"];
  //     var youbi = wd[w];
  //     var h = new Date().getHours();
  //     var min = new Date().getMinutes();
  //     var confirmation_date_print = y + '年' + m + '月' + d + '日（' + youbi + '）' + h + ':' + min;
  //     var confirmation_date = y + '-' + m + '-' + d + ' ' + h + ':' + min + ':00';
  //     $('.confirmation_date_print_' + data_id).text(confirmation_date_print);
  //     $('.confirmation_date_' + data_id).val(confirmation_date);
  // });

  // 確認 / 判断
  $( document ).on('change', '.confirmation-chk', function(){
    var data_id = $(this).attr('data-id');
    var val = $(this).val();
    var chk = $(this).prop('checked');
    console.log(data_id);
    console.log(val);
    console.log(chk);
    if(chk === true){
      console.log("OK");
      var y = new Date().getFullYear();
      var m = new Date().getMonth() + 1;
      var d = new Date().getDate();
      var w = new Date().getDay();
      var wd = ["日","月","火","水","木","金","土"];
      var youbi = wd[w];
      var h = new Date().getHours();
      var min = new Date().getMinutes();
      var confirmation_date_print = y + '年' + m + '月' + d + '日（' + youbi + '）' + h + ':' + min;
      var confirmation_date = y + '-' + m + '-' + d + ' ' + h + ':' + min + ':00';
      $('.confirmation-date-print-' + data_id).text(confirmation_date_print);
      $('.confirmation-date-' + data_id).val(confirmation_date);
    }else{
      console.log("NG");
      $('.confirmation-date-print-' + data_id).text('');
      $('.confirmation-date-' + data_id).val('');
    }
  });

  // 右上の×ボタン
  $(document).on('click', '.date_right_x', function () {
    // console.log($(this).attr('data-id'));
    var data_id = $(this).attr('data-id');
    $("#form" + data_id).remove();
  });

  // BMI（体重）
  $( document ).on('change', '.weight', function(){
    // 体重
    var weight = $( this ).val();
    var data_id = $(this).attr('data-id');
    // 身長
    var tall = $(".tall_set_" + data_id).val();
    // BMI 計算
    if(tall){
      // $(".bmi_" + data_id).removeClass("bmi_1");
      // BMI＝ 体重(kg) ÷ {身長(m) Ｘ 身長(m)} (小数点第2位を四捨五入)
      var bmi = Math.round(weight / ((tall / 100) * (tall / 100)), 1);
      $(".bmi_" + data_id).val(bmi);
      // console.log(weight);
      // console.log(data_id);
      // console.log(tall);
    };
  });
  // BMI（身長）
  $( document ).on('change', '.tall', function(){
    // 身長
    var tall = $( this ).val();
    var data_id = $(this).attr('data-id');
    // 体重
    var weight = $(".weight_set_" + data_id).val();
    // BMI 計算
    if(weight){
      // BMI＝ 体重(kg) ÷ {身長(m) Ｘ 身長(m)} (小数点第2位を四捨五入)
      var bmi = Math.round(weight / ((tall / 100) * (tall / 100)), 1);
      $(".bmi_" + data_id).val(bmi);
      // console.log(weight);
      // console.log(data_id);
      // console.log(tall);
    };
  });



  // $(function() {
  //
  //     $(".date_time2").val('');
  //
  // });


  // チェックがないと半透明に（チェック状態を正しく確認）
  // 修正: opacityを直接targetに適用し、.checkをトグル。解除時に点滅クラスも削除
  // 追加: 親要素に .check クラスをトグルし、点滅アニメーションを同期
  $(document).on('change', '.checkbox-check', function() {
    var target = $(this).parent();

    // 不透明度の制御（チェック状態に基づく）
    if ($(this).is(':checked')) {
      target.css({'opacity': '1'});  // チェックあり: 不透明
      target.removeClass('check-blink-on check-blink-off'); // 念のため点滅クラスをクリア
      target.addClass('check');     // 点滅対象に追加
    } else {
      target.css({'opacity': '0.3'}); // チェックなし: 半透明
      target.removeClass('check check-blink-on check-blink-off'); // 点滅対象とクラスを削除（背景リセット）
    }

    // 追加: 点滅アニメーションを更新（同期のため）
    updateBlinkAnimation();
  });

  // 追加: グローバルタイマー変数
  let blinkTimer = null;

  // 追加: 点滅アニメーションを更新する関数（同期のため）
  function updateBlinkAnimation() {
    // 既存のタイマーをクリア
    if (blinkTimer) clearInterval(blinkTimer);

    // .check 要素が存在する場合のみタイマーを開始
    if ($('.check').length > 0) {
      let isOn = false; // 点滅状態のトラッキング
      blinkTimer = setInterval(() => {
        // すべての .check 要素のクラスをトグル（同期）
        $('.check').toggleClass('check-blink-on', isOn).toggleClass('check-blink-off', !isOn);
        isOn = !isOn; // 状態反転
      }, 500); // 500msごとにトグル（調整可能）
    }
  }

  // 追加: 初期化（ページロード時に既に .check がある場合）
  $(document).ready(function() {
    updateBlinkAnimation();
  });

  // 申込名フィールドのセレクタを指定（name属性で特定）
  let isComposing = false;

  function normalizeSubmissionName($input) {
    const value = $input.val();

    // 全角英数字がなければ何もしない
    if (!/[Ａ-Ｚａ-ｚ０-９]/.test(value)) return;

    const converted = value.replace(/[Ａ-Ｚａ-ｚ０-９]/g, s =>
      String.fromCharCode(s.charCodeAt(0) - 0xFEE0)
    );

    if (value !== converted) {
      $input.val(converted);
    }
  }

  // IME変換開始
  $(document).on('compositionstart', '[name="submission_name"]', function () {
    isComposing = true;
  });

  // IME変換確定
  $(document).on('compositionend', '[name="submission_name"]', function () {
    isComposing = false;

    // ★ 変換確定時に必ず正規化する
    normalizeSubmissionName($(this));
  });

  // 通常入力・delete・paste など
  $(document).on('input', '[name="submission_name"]', function () {
    if (isComposing) return;

    normalizeSubmissionName($(this));
  });






  // 希望バック の 円 に入力があったら
  $( document ).on('change', '#form_hope_back_price', function(){
    // class 名取得
    var set_class = $(this).attr('class');
    // console.log(set_class);
    // 入力値
    var set_val = $( this ).val();
    // console.log(set_val);
    // 値が入力されていたら
    if(set_val){
      // 強制的に半透明 解除
      $('.' + set_class).css({'opacity':'1'});
      // 強制的にチェック
      $('.' + set_class).prop('checked', true);
    }else{
      // 強制的に半透明
      $('.' + set_class).css({'opacity':'0.3'});
      // チェック 解除
      $('.' + set_class).prop('checked', false);
    }
  });

  // 希望保証 の 時間 に入力があったら
  $( document ).on('change', '#form_warranty_time', function(){
    // class 名取得
    var set_class = $(this).attr('class');
    // console.log(set_class);
    // 入力値
    var set_val = $( this ).val();
    // console.log(set_val);
    // 値が入力されていたら
    if(set_val){
      // 強制的に半透明 解除
      $('.' + set_class).css({'opacity':'1'});
      // 強制的にチェック
      $('.' + set_class).prop('checked', true);
    }else{
      // 強制的に半透明
      $('.' + set_class).css({'opacity':'0.3'});
      // チェック 解除
      $('.' + set_class).prop('checked', false);
    }
  });

  // 希望保証 の 円 に入力があったら
  $( document ).on('change', '#form_warranty_price', function(){
    // class 名取得
    var set_class = $(this).attr('class');
    // console.log(set_class);
    // 入力値
    var set_val = $( this ).val();
    // console.log(set_val);
    // 値が入力されていたら
    if(set_val){
      // 強制的に半透明 解除
      $('.' + set_class).css({'opacity':'1'});
      // 強制的にチェック
      $('.' + set_class).prop('checked', true);
    }else{
      // 強制的に半透明
      $('.' + set_class).css({'opacity':'0.3'});
      // チェック 解除
      $('.' + set_class).prop('checked', false);
    }
  });

  // 入店祝い金 の 円 に入力があったら
  $( document ).on('change', '#form_celebration_price', function(){
    // class 名取得
    var set_class = $(this).attr('class');
    // console.log(set_class);
    // 入力値
    var set_val = $( this ).val();
    // console.log(set_val);
    // 値が入力されていたら
    if(set_val){
      // 強制的に半透明 解除
      $('.' + set_class).css({'opacity':'1'});
      // 強制的にチェック
      $('.' + set_class).prop('checked', true);
    }else{
      // 強制的に半透明
      $('.' + set_class).css({'opacity':'0.3'});
      // チェック 解除
      $('.' + set_class).prop('checked', false);
    }
  });

  // 出稼ぎ の 日間 に入力があったら
  $( document ).on('change', '#form_days_to_work_num', function(){
    // class 名取得
    var set_class = $(this).attr('class');
    // console.log(set_class);
    // 入力値
    var set_val = $( this ).val();
    // console.log(set_val);
    // 値が入力されていたら
    if(set_val){
      if(set_val == 0){
        // 強制的に半透明
        $('.' + set_class).css({'opacity':'0.3'});
        // チェック 解除
        $('.' + set_class).prop('checked', false);
      }else{
        // 強制的に半透明 解除
        $('.' + set_class).css({'opacity':'1'});
        // 強制的にチェック
        $('.' + set_class).prop('checked', true);
      }
    }else{
      // 強制的に半透明
      $('.' + set_class).css({'opacity':'0.3'});
      // チェック 解除
      $('.' + set_class).prop('checked', false);
    }
  });

  // ニコイチ に入力があったら
  $( document ).on('change', '#form_nikoiti', function(){
    // class 名取得
    var set_class = $(this).attr('class');
    // console.log(set_class);
    // 入力値
    var set_val = $( this ).val();
    // console.log(set_val);
    // 値が入力されていたら
    if(set_val){
      // 強制的に半透明 解除
      $('.' + set_class).css({'opacity':'1'});
      // 強制的にチェック
      $('.' + set_class).prop('checked', true);
    }else{
      // 強制的に半透明
      $('.' + set_class).css({'opacity':'0.3'});
      // チェック 解除
      $('.' + set_class).prop('checked', false);
    }
  });

  // その他 に入力があったら
  $( document ).on('change', '#form_other', function(){
    // class 名取得
    var set_class = $(this).attr('class').split(' ');
    // console.log(set_class[1]);
    // 入力値
    var set_val = $( this ).val();
    // console.log(set_val);
    // 値が入力されていたら
    if(set_val){
      // 強制的に半透明 解除
      $('.' + set_class[1]).css({'opacity':'1'});
      // 強制的にチェック
      $('.' + set_class[1]).prop('checked', true);
    }else{
      // 強制的に半透明
      $('.' + set_class[1]).css({'opacity':'0.3'});
      // チェック 解除
      $('.' + set_class[1]).prop('checked', false);
    }
  });

  // 日時カレンダーの設定
  $( document ).on('focus', '.date_time', function(){
    // console.log("★1");
    flatpickr(
      ".date_time", {
        locale: "ja", // 日本語を適応
        dateFormat: "Y-m-d H:i", // 時間のフォーマット
        enableTime: true, // タイムピッカーを有効

        // 日付を選択し終えた時の処理
        onClose: function(selectedDates, dateStr) {
          //正規表現パターン（『0000-00-00 00:00』に一致）
          var regex = new RegExp( /^[0-9]{4}\-[0-9]{2}\-[0-9]{2}\s[0-9]{2}:[0-9]{2}$/ );
          console.log(dateStr);

          //判定
          if (regex.test(dateStr)) {
            console.log("正規表現パターンに一致しています。");
          }else{
            alert("期間の項目が正しく選択されておりませんのでご確認ください。");
          }
        }
      });
  });

  // 日付けカレンダーの設定
  $( document ).on('focus', '.date_time2', function(){
    // console.log("★2");
    flatpickr(
      ".date_time2", {
        locale: "ja", // 日本語を適応
        dateFormat: "Y-m-d", // 時間のフォーマット
        defaultDate: null,
        enableTime: false, // タイムピッカーを有効

        // 日付を選択し終えた時の処理
        onClose: function(selectedDates, dateStr) {
          //正規表現パターン（『0000-00-00』に一致）
          var regex = new RegExp( /^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/ );
          console.log(dateStr);

          //判定
          if (regex.test(dateStr)) {
            console.log("正規表現パターンに一致しています。");
          }else{
            alert("期間の項目が正しく選択されておりませんのでご確認ください。");
          }
        }
      });
  });


  // 追跡振り分け更新ボタン
  // 新規データ入力は不可
  {/literal}
  {if isset($id) && $id}
  $('.tracking_remarks_update').on('click', function() {

    var id = '{$id}';

    // 親の form の内容のみ（＊複製されたデータの追跡振り分け更新は不可）
    var $form = $('#form');

    // 追跡理由
    var reason = '';
    if ($form.find('#form_reason').val() !== '') {
      reason = $form.find('#form_reason').val();
    }

    // 追跡予定日付
    var scheduled_date = '';
    if ($form.find('#form_scheduled_date').val() !== '') {
      scheduled_date = $form.find('#form_scheduled_date').val();
    }

    // 追跡予定時間
    var scheduled_date_hour = '';
    if ($form.find('#form_scheduled_date_hour').val() !== '') {
      scheduled_date_hour = $form.find('#form_scheduled_date_hour').val();
    }

    // 追跡中止フラグ
    var stop_tracking_flg = $form.find('#form_stop_tracking_flg').is(':checked') ? 2 : 1;

    // 追跡備考（tracking_data）
    var trackingData = {};
    $form.find('[name^="tracking_data"]').each(function () {
      var name  = $(this).attr('name');
      var value = $(this).val();

      // tracking_data[0][scheduled_date_remarks]
      var match = name.match(/tracking_data\[(\d+)\]\[(.+?)\]/);
      if (!match) return;

      var index = match[1];
      var key   = match[2];

      if (!trackingData[index]) {
        trackingData[index] = {};
      }

      trackingData[index][key] = value;
    });

    // console.log('id');
    // console.log(id);
    // console.log('reason');
    // console.log(reason);
    // console.log('scheduled_date');
    // console.log(scheduled_date);
    // console.log('scheduled_date_hour');
    // console.log(scheduled_date_hour);
    // console.log('stop_tracking_flg');
    // console.log(stop_tracking_flg);
    // console.log('trackingData');
    // console.log(trackingData);
    // return

    if(id){
      $.ajax({
        type:"POST",
        url:"/api/tracking_remarks_update",
        cache: false,
        data:{
          'dataid':id,
          'reason':reason,
          'scheduled_date':scheduled_date,
          'scheduled_date_hour':scheduled_date_hour,
          'stop_tracking_flg':stop_tracking_flg,
          'tracking_data':trackingData,
        },
        timeout: 10000
      }).done(function(data) {
        var options = {
          title: "追跡振り分け更新 完了"
        };
        swal(options)
        // location.href = "/";
      });
    }

  });
  {/if}
  {literal}

  // 複製ボタン
  $('.copy_form').click(function(){
    var form_count = $(".data_form").length + 1;
    // console.log(form_count);

    $('.update_form').removeClass("update_form").addClass("update_form_ajax").attr("type", "button");
    $('.complete_form').removeClass("complete_form").addClass("complete_form_ajax").attr("type", "button");

    //通常input時のバリデーションエラー表示要素を削除
    $('.input_error').remove();

    var copy_form = $('#form').clone();
    // console.log(copy_form);

    $(copy_form).find(".no_copy").remove();
    $(copy_form).attr("id", "form" + form_count);

    // 右上の×ボタン
    $(copy_form).find(".date_right_x").css("display", "block");
    $(copy_form).find(".date_right_x").attr("data-id", form_count);

    //  BMI の用意
    $(copy_form).find(".tall").removeClass("tall_set_1").addClass("tall_set_" + form_count).attr("data-id", form_count);
    $(copy_form).find(".weight").removeClass("weight_set_1").addClass("weight_set_" + form_count).attr("data-id", form_count);
    $(copy_form).find(".bmi_1").removeClass("bmi_1").addClass("bmi_" + form_count);

    // 確認 / 判断 の用意
    // $(copy_form).find(".confirmation_chk_1").removeClass("confirmation_chk_1").addClass("confirmation_chk_" + form_count).attr("data-id", form_count);
    // $(copy_form).find(".confirmation_date_print_1").removeClass("confirmation_date_print_1").addClass("confirmation_date_print_" + form_count).attr("data-id", form_count);
    // $(copy_form).find(".confirmation_date_1").removeClass("confirmation_date_1").addClass("confirmation_date_" + form_count).attr("data-id", form_count);

    // チェック前の半透明の用意
    $(copy_form).find(".without_prior_flg_1").removeClass("without_prior_flg_1").addClass("without_prior_flg_" + form_count);
    $(copy_form).find(".hope_back_flg_1").removeClass("hope_back_flg_1").addClass("hope_back_flg_" + form_count);
    $(copy_form).find(".warranty_flg_1").removeClass("warranty_flg_1").addClass("warranty_flg_" + form_count);
    $(copy_form).find(".celebration_flg_1").removeClass("celebration_flg_1").addClass("celebration_flg_" + form_count);
    $(copy_form).find(".transportation_expenses_flg_1").removeClass("transportation_expenses_flg_1").addClass("transportation_expenses_flg_" + form_count);
    $(copy_form).find(".send_to_home_flg_1").removeClass("send_to_home_flg_1").addClass("send_to_home_flg_" + form_count);
    $(copy_form).find(".send_to_shop_flg_1").removeClass("send_to_shop_flg_1").addClass("send_to_shop_flg_" + form_count);
    $(copy_form).find(".single_room_wait_flg_1").removeClass("single_room_wait_flg_1").addClass("single_room_wait_flg_" + form_count);
    $(copy_form).find(".dorm_flg_1").removeClass("dorm_flg_1").addClass("dorm_flg_" + form_count);
    $(copy_form).find(".nursery_flg_1").removeClass("nursery_flg_1").addClass("nursery_flg_" + form_count);
    $(copy_form).find(".advance_salary_flg_1").removeClass("advance_salary_flg_1").addClass("advance_salary_flg_" + form_count);
    $(copy_form).find(".tatoo_flg_1").removeClass("tatoo_flg_1").addClass("tatoo_flg_" + form_count);
    $(copy_form).find(".menses_flg_1").removeClass("menses_flg_1").addClass("menses_flg_" + form_count);
    $(copy_form).find(".same_person_flg_1").removeClass("same_person_flg_1").addClass("same_person_flg_" + form_count);
    $(copy_form).find(".nikoiti_flg_1").removeClass("nikoiti_flg_1").addClass("nikoiti_flg_" + form_count);
    $(copy_form).find(".other_flg_1").removeClass("other_flg_1").addClass("other_flg_" + form_count);
    $(copy_form).find(".working_away_flg_1").removeClass("working_away_flg_1").addClass("working_away_flg_" + form_count);


    var select_experience = $('#form #select_experience').multipleSelect('getSelects');
    var identity_card_select = $('#form #select_identity_card').multipleSelect('getSelects');
    var apply_identity_card = $('#form #select_apply_identity_card').multipleSelect('getSelects');
    var hope_workplace = $('#form #select_hope_workplace').multipleSelect('getSelects');

    $(copy_form).find(".ms-parent").remove();
    var $selects = $(copy_form).find('[id^=select_]');
    $($selects).css("display", "block");


    $(copy_form).find(".photodata_input").each(function(){
      var photo_input = $(this).attr("id") + "_" + form_count;
      $(this).attr("id", photo_input);
      $(this).parent("label").attr("for", photo_input);
    });

    // console.log(copy_form);
    $('.form_wrap').append(copy_form);

    $('#form' + form_count).prepend('<h1 class="breadcrumb date_info_breadcrumb inline" id="copy_title_form' + form_count + '"></h1>');

    $selects.multipleSelect();

    //ペースト側フォームの操作
    var $pasteForm = $("#form" + form_count);
    $('#select_experience', $pasteForm).multipleSelect('setSelects', select_experience);
    $('#select_identity_card', $pasteForm).multipleSelect('setSelects', identity_card_select);
    $('#select_apply_identity_card', $pasteForm).multipleSelect('setSelects', apply_identity_card);
    $('#select_hope_workplace', $pasteForm).multipleSelect('setSelects', hope_workplace);

    visitorMediaDisibleControll(null, $pasteForm);
    ajaxGenreApi($('.keikyu', $pasteForm)  ,$pasteForm);
  });

  $(document).on('click', '.update_form_ajax, .complete_form_ajax', function() {
    event.preventDefault();

    var class_name = $(this).attr('class');

    var formId = $(this).parents(".data_form").attr("id");
    var formdata = new FormData($('#' + formId).get(0));

    var select_experience = $('#' + formId + ' #select_experience').multipleSelect('getSelects');
    var identity_card_select = $('#' + formId + ' #select_identity_card').multipleSelect('getSelects');
    var apply_identity_card = $('#' + formId + ' #select_apply_identity_card').multipleSelect('getSelects');
    var hope_workplace = $('#' + formId + ' #select_hope_workplace').multipleSelect('getSelects');

    formdata.append("experience_hidden", select_experience);
    formdata.append("identity_card_select_hidden", identity_card_select);
    formdata.append("apply_identity_card_hidden", apply_identity_card);
    formdata.append("hope_workplace_hidden", hope_workplace);
    formdata.append("update_ajax", "update_ajax");

    if(formId === "form"){
      var url = "/inputdata/data/" + {/literal}{if isset($id)}{$id}{else}''{/if}{literal};
    }else{
      var url = "/inputdata/data";
    }

    $.ajax({
      url  : url,
      type : "POST",
      data : formdata,
      cache       : false,
      contentType : false,
      processData : false,
      dataType    : "json",
      timeout: 10000
    }).done(function(data) {
      // var result = JSON.parse(data);

      if(data.result === "success") {
        // console.log('copy_title_' + formId);
        var id = data.id;
        if(class_name === "btn_orange complete_form_ajax"){
          window.open('/inputdata/sendmail/' + id);
        }
        swal('ID:' + id + 'のデータの登録を完了しました');

        $("#copy_title_" + formId).append("&gt;&nbsp;データ入力【ID. " + id + "】");

      }
      if(data.result === "fail") {
        var error = "[入力エラー]\n以下の理由でデータの登録が行えませんでした\n";
        Object.keys(data.message).forEach(function(k){
          error += data.message[k] + "\n";
        });
        swal(error);
      }
    });

    return false;
  });


  $("input[id*='namekana']").keyup(function(){
    var text = $(this).val();
    if(!text.match(/^[ぁ-んー　]*$/)) {
      $(this).addClass("invalid");
    } else {
      $(this).removeClass("invalid");
    }
  });

  {/literal}{if isset($userData.group) && $userData.group == 1}{literal}
  //drawer
  $(function() {
    $('.drawer').drawer();
  });
  {/literal}{/if}{literal}

  $(function() {
    $('#select_experience').multipleSelect('setSelects', [{/literal}{$default.experience|default:""}{literal}]);

    $('#select_identity_card').multipleSelect('setSelects', [{/literal}{$default.identity_card_select|default:""}{literal}]);

    $('#select_apply_identity_card').multipleSelect('setSelects', [{/literal}{$default.apply_identity_card|default:""}{literal}]);

    $('#select_hope_workplace').multipleSelect('setSelects', [{/literal}{$default.hope_workplace|default:""}{literal}]);
  });


  // enter キーを押しても【更新】ボタンが反応しないように
  $(function() {
    $(document).on("keypress", "input:not(.btn_orange update_form)", function(event) {
      return event.which !== 13;
    });
  });


  // 更新起動時の入力制御処理を行う
  $(function() {
    //開始時
    visitorMediaDisibleControll(undefined);

    //選択(媒体・SC・出戻り)
    $(document).on("change", ".keikyu, .scout, .demodori", function () {
      visitorMediaDisibleControll($(this));
    });
    $(document).on("change", ".keikyu", function () {
      ajaxGenreApi($(this));
    });
  });

  /**
   * 掲載・SC・出戻りの入力制御
   * @param $element  //変更中のInputエレメント。　新規・複製時はなし。
   * @param $argForm  //対象フォーム。指定がなくても$elementの親のみに限定される。
   */
  var visitorMediaDisibleControll = function($element, $argForm)
  {
    //対象フォーム限定処理
    var $form = getTargetForm($element, $argForm);

    var scout = $('.scout', $form),
      demodori = $('.demodori', $form),
      baitai = $('.baitai', $form),
      keiarea = $('.keiarea', $form),
      keikyu = $('.keikyu', $form),
      keigyo = $('.genre_data', $form);

    var scoutOptions = $('option', scout),
      demodoriOptions = $('option', demodori),
      baitaiOptions = $('option', baitai),
      keiareaOptions = $('option', keiarea),
      keikyuOptions = $('option', keikyu);

    var selectedScout = function() {
      scoutOptions.removeAttr("disabled");
      demodoriOptions.attr("disabled","disabled");
      baitaiOptions.attr("disabled","disabled");
      keiareaOptions.attr("disabled","disabled");
      keikyuOptions.attr("disabled","disabled");
      keikyu.val("");
      keigyo.text("");
      baitai.val("");
      keiarea.val("");
    };

    var unSelectedScout = function() {
      demodoriOptions.removeAttr("disabled");
      baitaiOptions.removeAttr("disabled");
      keiareaOptions.removeAttr("disabled");
      keikyuOptions.removeAttr("disabled");
    };

    var selectedDemodori = function() {
      demodoriOptions.removeAttr("disabled");
      scoutOptions.attr("disabled","disabled");
      baitaiOptions.attr("disabled","disabled");
      keiareaOptions.attr("disabled","disabled");
      keikyuOptions.attr("disabled","disabled");
      // $('.keiarea ,.keikyu  ,.keigyo').val(0);
      keikyu.val("");
      keigyo.text("");
      baitai.val("");
      keiarea.val("");
    };

    var unSelectedDemodori = function() {
      scoutOptions.removeAttr("disabled");
      baitaiOptions.removeAttr("disabled");
      keiareaOptions.removeAttr("disabled");
      keikyuOptions.removeAttr("disabled");
    };


    var selectedKeikyu = function() {
      keikyuOptions.removeAttr("disabled");
      baitaiOptions.removeAttr("disabled");
      keiareaOptions.removeAttr("disabled");

      scoutOptions.attr("disabled","disabled");
      demodoriOptions.attr("disabled","disabled");
      scout.val("");
      demodori.val("");
    };

    var unSelectedKeikyu = function() {
      scoutOptions.removeAttr("disabled");
      demodoriOptions.removeAttr("disabled");
    };

    //画面表示時・複製時
    if($element === null || $element === undefined) {
      var keikyuVal = $('option:selected',keikyu).val();
      var scoutVal = $('option:selected',scout).val();
      var demodoriVal = $('option:selected',demodori).val();
      if (keikyuVal !== "" && keikyuVal !== undefined) {
        selectedKeikyu();
      } else if (scoutVal !== "" && scoutVal !== undefined) {
        selectedScout();
      } else if (demodoriVal !== "" && demodoriVal !== undefined) {
        selectedDemodori();
      }
      return;
    }

    //掲載求人変更時
    if($element.hasClass('keikyu'))
    {
      if ($element.val() === 0 || $element.val() === "") {
        unSelectedKeikyu();
      } else {
        selectedKeikyu();
      }
      return;
    }

    //SC変更時
    if($element.hasClass('scout'))
    {
      if ($element.val() === 0 || $element.val() === "") {
        unSelectedScout();
      } else {
        selectedScout();
      }
      return;
    }

    //出戻り変更時
    if($element.hasClass('demodori'))
    {
      if ($element.val() === 0 || $element.val() === "") {
        unSelectedDemodori();
      } else {
        selectedDemodori();
      }
    }
  };

  function getTargetForm($element, $form) {
    //対象フォーム限定処理
    if($form !== null && $form !== undefined ) {
      if($form.hasClass('data_form')) {
        return $form;
      }
    }
    if($element === null || $element === undefined) {
      //新規・編集時
      return $('form.data_form');
    } else {
      //要素操作時。自分が所属するフォームでのみ実行。
      return $element.parents('form.data_form');
    }
  }

  function ajaxGenreApi($element, $argForm) {
    var $form = getTargetForm($element, $argForm);

    var mediaId = $element.val();
    $.ajax({
      url:'/api/genre',
      type:'POST',
      data: {
        "mediaId" : mediaId
      }
    }).done(function(data) {
      var genre_data = JSON.parse(data);

      if(genre_data.genre){
        $(".genre_data", $form).text(genre_data.genre);
        $(".genre_data", $form).append('<input type="hidden" id="genre" name="genre" value="' + genre_data.genreId + '" />');
      }
    }).fail(function(data) {

    });
  }


  // 掲載求人 → 掲載媒体 → 掲載エリアの順番で表示
  function mediaChange(){
    if(document.getElementById('changeSelect')){
      id = document.getElementById('changeSelect').value;

      // console.log(id);

      // 空の場合
      if(!Object.keys(id).length){
        document.getElementById('publicityBox').style.display = "none";
      }else{
        document.getElementById('publicityBox').style.display = "";
      }
    }
  }
  function publicityChange(){
    if(document.getElementById('changeSelect2')){
      id = document.getElementById('changeSelect2').value;

      // console.log(id);

      // 空の場合
      if(!Object.keys(id).length){
        document.getElementById('areaBox').style.display = "none";
      }else{
        document.getElementById('areaBox').style.display = "";
      }
    }
  }
  //オンロードさせ、リロード時に選択を保持
  function init(){
    mediaChange();
    publicityChange();
  }
  window.onload = init;

</script>
{/literal}


{include file=$smarty.const.ADMIN_FOOTER}