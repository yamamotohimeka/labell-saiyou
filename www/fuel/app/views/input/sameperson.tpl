{foreach from=$result item=value key=key name="sameperson"}
    <div class="data_form data_sameperson_form">
        <div class="date_info_inner">
            <div class="input_top_line">
                <div class="officer">
                    担当：{$value.staff_name|default:""}
                </div>
                <div class="input_show_index">
                    <a href="/inputdata/data/{$value.id}"><div class="btn_orange index">採用情報を見る</div></a>
                </div>
            </div>
            <!--左サイドここから-->
            <div class="date_left_col">
                <!-- 申込日-->
                <div class="white_box input_left">
                    <p>申込日</p>
                    <p class="input_return">{$value.submission_date|date_format:"%Y年%m月%d日"}</p>
                </div>
                <!-- 申込時間-->
                <div class="white_box input_left">
                    <p>申込時間</p>
                    <p class="input_return">{$value.submission_hour|default:""}時{$value.submission_time|default:""}分</p>
                </div>
                <!-- 申込名-->
                <div class="white_box input_left">
                    <p>申込名</p>
                    <p class="input_return">{$value.submission_name|default:""}</p>
                </div>
                <!-- 面接予定日-->
                <div class="white_box input_left">
                    <p>面接予定日</p>
                    <p class="input_return">{$value.interview_date|date_format:"%Y年%m月%d日"}</p>
                </div>
                <!-- 面接予定時間-->
                <div class="white_box input_left">
                    <p>面接予定時間</p>
                    <p class="input_return">{$value.interview_hour|default:"-"}時{$value.interview_time|default:"-"}分</p>
                    {if $value.tentative_reserve_flg == 1}
                    <div class="tbd2 term_on">
                        <p><span>仮予約</span></p>
                    </div>
                    {/if}
                </div>
            </div><!--/date_left_col-->
            <!--右サイドここから-->
            <div class="date_right_col bordernone">
                <!--掲載媒体-->
                <div class="white_box input_right SSmall">
                    <p>掲載媒体</p>
                    <p class="input_return">{$value.publicity|default:""}</p>
                </div>
                <!--掲載求人-->
                <div class="white_box input_right SSSmall">
                    <p>掲載求人</p>
                    <p class="input_return">{$value.media|default:""}</p>
                </div>
                <!--掲載業種-->
                <div class="white_box input_right SSmall">
                    <p>掲載業種</p>
                    <p class="input_return">{$value.genre|default:""}</p>
                </div>

                <!--SC-->
                <div class="white_box input_right XSmall">
                    <p>SC</p>
                    <p class="input_return">{$value.scout|default:""}</p>
                </div>
                <!--出戻り・移籍・紹介-->
                <div class="white_box input_right">
                    <p>出戻り・移籍・紹介</p>
                    <p class="input_return">{$value.move|default:""}</p>
                </div>
                <!--TEL-->
                <div class="white_box input_right XSMedium clear">
                    <p>TEL</p>
                    <p class="input_return">{$value.tel01|default:""}-{$value.tel02|default:""}-{$value.tel03|default:""}</p>
                </div>
                <!--Mail-->
                <div class="white_box input_right Medium">
                    <p>Mail</p>
                    <p class="input_return">{$value.mail01|default:""}@{$value.maildomain|default:""}</p>
                </div>
                <!--年齢-->
                <div class="white_box input_right XSmall">
                    <p>年齢</p>
                    <p class="input_return">{$value.age|default:""}</p><span class="select_other_txt">歳</span>
                </div>
                <!--経験-->
                <div class="white_box input_right SSmall">
                    <p>経験</p>
                    <p class="input_return">
                        {foreach from=$value.experienceArray item=value2 key=key2 name="experience"}
                            {$value2}
                        {/foreach}
                        </p>
                </div>
                <!--経験備考-->
                <div class="white_box input_right">
                    <p>備考</p>
                    <p class="input_return">{$value.experience_remarks|default:""}</p>
                </div>
                <!--身長-->
                <div class="white_box input_right XSmall clear">
                    <p>身長</p>
                    <p class="input_return">{$value.tall|default:""}</p>
                    <span class="select_other_txt">cm</span>
                </div>
                <!--体重-->
                <div class="white_box input_right XSmall">
                    <p>体重</p>
                    <p class="input_return">{$value.weight|default:""}</p>
                    <span class="select_other_txt">kg</span>
                </div>
                <!--バスト-->
                <div class="white_box input_right XSmall">
                    <p>バスト</p>
                    <p class="input_return">{$value.bust|default:""}</p>
                    <span class="select_other_txt">cm</span>
                </div>
                <!--カップ数-->
                <div class="white_box input_right SSmall">
                    <p>カップ数</p>
                    <p class="input_return">{$value.cup|default:""}</p>
                    <span class="select_other_txt">cup</span>
                </div>
                <!--ウエスト-->
                <div class="white_box input_right XSmall">
                    <p>ウエスト</p>
                    <p class="input_return">{$value.waist|default:""}</p>
                    <span class="select_other_txt">cm</span>
                </div>
                <!--ヒップ-->
                <div class="white_box input_right XSmall">
                    <p>ヒップ</p>
                    <p class="input_return">{$value.hip|default:""}</p>
                    <span class="select_other_txt">cm</span>
                </div>
            </div><!--/date_right_col-->

            <!--下半分ここから-->
            <div id="PlagOpen{$smarty.foreach.sameperson.index+1}">
                <a href="#" title="続きを読む" onclick="showPlagin({$smarty.foreach.sameperson.index+1});return false;"><p class="triangle"></p></a>
            </div>
            <div id="PlagClose{$smarty.foreach.sameperson.index+1}" style="display: none">
                <a href="#" title="折りたたむ" onclick="showPlagin({$smarty.foreach.sameperson.index+1});return false;"><p class="triangle2"></p></a>
                <!-- date_info_pust_inner-->
                <div class="date_info_pust_inner">
                    <!--下左サイドここから-->
                    <div class="date_left_col past">
                        <!-- 連絡方法-->
                        <div class="white_box input_left">
                            <p>連絡方法</p>
                            <p class="input_return">{$value.contact|default:""}</p>
                        </div>
                        <!-- 面接前確認-->
                        <div class="white_box input_left">
                            <p>面接前確認</p>
                            <p class="input_return">{$value.check|default:""}</p>
                        </div>
                        <!-- タイマー-->
                        <div class="white_box input_left">
                            <p>タイマー</p>
                            {if $value.timer_flg == 1}
                            <div class="tbd2 timer term_off">
                                <p><span>不要</span></p>
                            </div>
                            {/if}
                        </div>
                        <!-- 面接時間 -->
                        <div class="white_box input_left">
                            <p>面接時間</p>
                            <div class="timer">
                                <span class="timer_estab">{$value.timer|default:""}</span>分前
                            </div>
                        </div>
                        <!-- 事前連絡日-->
                        <div class="white_box input_left">
                            <p>事前連絡日</p>
                            <p class="input_return">{$value.advance_contact_date|date_format:"%Y年%m月%d日"}</p>
                        </div>
                        <!-- 店舗スタッフ-->
                        <div class="white_box input_left">
                            {if $value.staff_flg == 1}
                            <div class="tbd2 tbd_staff term_off">
                                <p><span>店舗スタッフ</span></p>
                            </div>
                            {/if}
                        </div>
                        <!--面接店舗-->
                        <div class="white_box input_left">
                            <p>面接店舗</p>
                            <p class="input_return">{$value.interviewshop|default:""}</p>
                        </div>
                        <!--待ち合わせ場所-->
                        <div class="white_box input_left">
                            <p>待ち合わせ場所</p>
                            <p class="input_return">{$value.place|default:""}</p>
                        </div>
                        <!--待ち合わせ備考-->
                        <div class="white_box input_left">
                            <p>待ち合わせ備考</p>
                            <p class="input_return">{$value.place_remarks|default:""}</p>
                        </div>
                        <!--掲載エリア-->
                        <div class="white_box input_left">
                            <p>掲載エリア</p>
                            <p class="input_return">{$value.area|default:""}</p>
                        </div>
                        <!--写真１-->
                        <div class="white_box input_left">
                            <p>写真１</p>
                            {if isset($value.image[1].img_id)}
                                <img class="imgView" src="/img/girl_image/{$value.image[1].img_id}/{$value.image[1].img_id}.{$value.image[1].ext}?{$smarty.now}" alt=""/>
                            {/if}
                        </div>
                        <!--写真２-->
                        <div class="white_box input_left">
                            <p>写真２</p>
                            {if isset($value.image[2].img_id)}
                                <img class="imgView" src="/img/girl_image/{$value.image[2].img_id}/{$value.image[2].img_id}.{$value.image[2].ext}?{$smarty.now}" alt=""/>
                            {/if}
                        </div>
                        <!--写真３-->
                        <div class="white_box input_left">
                            <p>写真３</p>
                            {if isset($value.image[3].img_id)}
                                <img class="imgView" src="/img/girl_image/{$value.image[3].img_id}/{$value.image[3].img_id}.{$value.image[3].ext}?{$smarty.now}" alt=""/>
                            {/if}
                        </div>
                    </div><!--/date_left_col-->
                    <!--下右サイドここから-->
                    <div class="date_right_col past bordernone">
                        <!--面接希望条件欄-->
                        <div class="white_box input_left Large">
                            <p>面接希望条件欄</p>
                            <div class="input_terms">
                                <p class="term_{if $value.hope_back_flg == 0}off{else}on{/if}">希望バック：<span>{$value.hope_back_price}</span></p>
                                <p class="term_{if $value.warranty_flg == 0}off{else}on{/if}">希望保証：<span>{$value.warranty_time}時間{$value.warranty_price}円</span></p>
                                <p class="term_{if $value.celebration_flg == 0}off{else}on{/if}">入店祝い金：<span>{$value.celebration_time}時間{$value.celebration_price}円</span><br>
                                <p class="term_{if $value.send_to_home_flg == 0}off{else}on{/if}"><span>送り</span></p>
                                <p class="term_{if $value.send_to_shop_flg == 0}off{else}on{/if}"><span>迎え</span></p>
                                <p class="term_{if $value.dorm_flg == 0}off{else}on{/if}"><span>寮</span></p>
                                <p class="term_{if $value.tatoo_flg == 0}off{else}on{/if}"><span>タトゥーや傷跡あり</span></p>
                                <p class="term_{if $value.nursery_flg == 0}off{else}on{/if}"><span>託児所</span></p>
                                <p class="term_{if $value.experience_possible_flg == 0}off{else}on{/if}"><span>体験可能</span></p>
                                <p class="term_{if $value.residence_flg == 0}off{else}on{/if}">居住地<span>なし</span></p>
                                <p class="term_{if $value.apply_identity_card == 0}off{else}on{/if}"><span>身分証</span></p><br>
                                <p class="term_{if $value.confirmed_flg == 0}off{else}on{/if}"><span>確認あり</span></p>
                                <p class="term_{if $value.same_person_flg == 0}off{else}on{/if}"><span>同一人物あり</span></p>
                                <p class="term_{if $value.other_flg == 0}off{else}on{/if}">その他：<span>{$value.other|default:""}</span></p>
                            </div>
                        </div>
                        <!--所属店舗-->
                        <div class="white_box input_right SSmall">
                            <p>所属店舗</p>
                            <p class="input_return">{$value.belonging_store|default:""}</p>
                        </div>
                        <!--源氏名-->
                        <div class="white_box input_right">
                            <p>源氏名</p>
                            <p class="input_return">{$value.genji_name|default:""}</p>
                        </div>
                        <!--採用情報用写真-->
                        <div class="white_box input_right">
                            <p>採用情報用写真</p>
                            <div id="btn_pop" class="photo_input_img photo_preview">プレビュー</div>
                            <a id="sample01" href="#close" class="lb">
                                {if isset($value.image[4].img_id)}
                                    <img class="imgView" src="/img/girl_image/{$value.image[4].img_id}/{$value.image[4].img_id}.{$value.image[4].ext}?{$smarty.now}" alt=""/>
                                {/if}
                            </a>
                        </div>

                        <!-- 退店日-->
                        <div class="white_box input_right XMedium clear">
                            <p>退店日</p>
                            <p class="input_return">{$value.leaving_date|date_format:"%Y年%m月%d日"}</p>
                        </div>
                        <!--退店理由-->
                        <div class="white_box input_right SSSmall">
                            <p>退店理由</p>
                            <p class="input_return">{$value.leaving_reason|default:""}</p>
                        </div>
                        <!--姓名-->
                        <div class="white_box input_right SSSmall clear">
                            <p>姓</p>
                            <p class="input_return">{$value.surname|default:""}</p>
                        </div>
                        <div class="white_box input_right SSSmall">
                            <p>名</p>
                            <p class="input_return">{$value.name|default:""}</p>
                        </div>
                        <!--ふりがな-->
                        <div class="white_box input_right SSSmall">
                            <p>姓（ふりがな）</p>
                            <p class="input_return">{$value.surnamekana|default:""}</p>
                        </div>
                        <div class="white_box input_right SSSmall">
                            <p>名（ふりがな）</p>
                            <p class="input_return">{$value.namekana|default:""}</p>
                        </div>
                        <!--住所-->
                        <div class="white_box input_right LLarge clear">
                            <p>住所</p>
                            <p class="input_return">{$value.pref|default:""}{$value.address|default:""}</p>
                        </div>
                        <!--面接結果-->
                        <div class="white_box input_right SSmall clear">
                            <p>面接結果</p>
                            <p class="input_return">{$value.interview_result|default:""}</p>
                        </div>
                        <!--面接担当-->
                        <div class="white_box input_right SSmall">
                            <p>面接担当</p>
                            <p class="input_return">{$value.interview_staff|default:""}</p>
                        </div>
                        <!--面接担当（サブ）-->
                        <div class="white_box input_right SSmall">
                            <p>面接担当（サブ）</p>
                            <p class="input_return">{$value.interview_staff_sub|default:""}</p>
                        </div>
                        <!--KS担当-->
                        <div class="white_box input_right SSmall">
                            <p>KS担当</p>
                            <p class="input_return">{$value.ks_staff|default:""}</p>
                        </div>
                        <!--勤務形態-->
                        <div class="white_box input_right SSmall clear">
                            <p>勤務形態</p>
                            <p class="input_return">{$value.work|default:""}</p>
                        </div>
                        <!--本人確認-->
                        <div class="white_box input_right SSmall">
                            <p>本人確認</p>
                            <p class="input_return">{$value.identity_card_select|default:""}</p>
                        </div>
                        <!--備考欄（本人確認用）-->
                        <div class="white_box input_right Small">
                            <p>備考欄（本人確認用）</p>
                            <p class="input_return">{$value.identity_card_remarks|default:""}</p>
                        </div>
                        <!--給料-->
                        <div class="white_box input_right SSmall clear">
                            <p>給料</p>
                            <p class="input_return">{$value.salary|default:""}</p>
                            <span class="select_other_txt">円</span>
                        </div>
                        <!--特別指名料-->
                        <div class="white_box input_right SSmall">
                            <p>特別指名料</p>
                            <p class="input_return">{$value.nomination_fee|default:""}</p>
                            <span class="select_other_txt">円</span>
                        </div>
                        <!--他店紹介-->
                        <div class="white_box input_right">
                            <p>他店紹介</p>
                            <p class="input_return">{$value.another_shop|default:""}</p>
                        </div>
                        <!--備考（他店紹介用）-->
                        <div class="white_box input_right XSMedium">
                            <p>備考</p>
                            <p class="input_return">{$value.another_shop_remarks|default:""}</p>
                        </div>
                        <!--検索ワード-->
                        <div class="white_box input_right LLarge clear">
                            <p>検索ワード</p>
                            <div class="word_col">
                                <div class="word_number">1</div>
                                <p class="input_return">{$value.word1|default:""}</p>
                            </div>
                            <div class="word_col">
                                <div class="word_number">2</div>
                                <p class="input_return">{$value.word2|default:""}</p>
                            </div>
                            <div class="word_col">
                                <div class="word_number">3</div>
                                <p class="input_return">{$value.word3|default:""}</p>
                            </div>
                            <div class="word_col">
                                <div class="word_number">4</div>
                                <p class="input_return">{$value.word4|default:""}</p>
                            </div>
                            <div class="word_col">
                                <div class="word_number">5</div>
                                <p class="input_return">{$value.word5|default:""}</p>
                            </div>
                            <div class="word_col">
                                <div class="word_number">6</div>
                                <p class="input_return">{$value.word6|default:""}</p>
                            </div>
                        </div>
                        <!--備考（検索ワード）-->
                        <div class="white_box input_right XSMedium">
                            <p>備考</p>
                            <p class="input_return">{$value.word_remarks|default:""}</p>
                        </div>
                        <!--チェック欄-->
                        <div class="white_box input_left">
                            <div class="input_terms">
                                <p class="term_{if $value.nikoiti_flg == 0}off{else}on{/if}"><span>ニコイチ</span></p>
                                <p class="term_{if $value.working_away_flg == 0}off{else}on{/if}"><span>出稼ぎ</span></p>
                                <p class="term_{if $value.scout_mail_flg == 0}off{else}on{/if}"><span>オファーメールからの申込</span></p>
                            </div>
                        </div>
                        {if isset($userData.group) && $userData.group == 1}
                            <!-- 初回出勤日-->
                            <div class="white_box input_right XMedium clear">
                                <p>初回出勤日</p>
                                <p class="input_return">{$value.working_day_date|date_format:"%Y年%m月%d日"}</p>
                                {if $value.working_day_undecided_flg == 1}
                                <div class="tbd2 undecided term_off">
                                    <p><span>未定</span></p>
                                </div>
                                {/if}
                            </div>
                            <!-- 備考-->
                            <div class="white_box input_left">
                                <p>備考</p>
                                <p class="input_return">{$value.remarks|default:""}</p>
                            </div>
                            <!--追跡理由-->
                            <div class="white_box input_right SSmall clear">
                                <p>追跡理由</p>
                                <p class="input_return">{$value.reason|default:""}</p>
                            </div>
                            <!-- 追跡予定日-->
                            <div class="white_box input_right Small">
                                <p>追跡予定日</p>
                                <p class="input_return">{$value.scheduled_date|date_format:"%Y年%m月%d日"}</p>
                            </div>
                            <div class="white_box input_right Small">
                                <div class="tbd2 chaise term_off">
                                    {if $value.stop_tracking_flg == 1}
                                    <p><span>追跡中止</span></p>
                                    {/if}
                                </div>
                            </div>
                            <!--追跡備考-->
                            <div class="white_box input_left clear">
                                <p>追跡備考</p>
                                <div class="remark_box">
                                    <span class="input_past_txt">日付</span>
                                    <p class="input_return">2018年1月10日</p>
                                    <span class="input_past_txt">担当</span>
                                    <p class="input_return">藤村</p>
                                    <span class="select_other_txt">経過</span>
                                    <p class="input_past_txt"></p>
                                </div>
                                <div class="remark_box">
                                    <span class="input_past_txt">日付</span>
                                    <p class="input_return">2018年2月15日</p>
                                    <span class="input_past_txt">担当</span>
                                    <p class="input_return">藤村</p>
                                    <span class="select_other_txt">経過</span>
                                    <p class="input_past_txt"></p>
                                </div>
                            </div>
                        {/if}
                    </div><!--/date_right_col-->
                </div><!-- /date_info_pust_inner-->
            </div><!-- /PlagClose1-->
        </div><!-- /date_info_inner-->
    </div>
{/foreach}

<script>
    //更新開閉
    function showPlagin(idno){
        pc = ('PlagClose' + (idno));
        po = ('PlagOpen' + (idno));
        if( document.getElementById(pc).style.display == "none" ) {
            document.getElementById(pc).style.display = "block";
            document.getElementById(po).style.display = "none";
        }
        else {
            document.getElementById(pc).style.display = "none";
            document.getElementById(po).style.display = "block";
        }
    }

    $(".photo_preview").click(function(){
        $(this).next().addClass("lb_target");
    });

    $(".lb").click(function(){
        $(this).removeClass("lb_target");
    });
</script>