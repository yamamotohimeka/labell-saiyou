{include file=$smarty.const.ADMIN_HEADER}

<article id="search" class="container">
    <section class="top_content_wrap">

    </section>
        <section class="search_info_col">
            <h1 class="breadcrumb">&gt;&nbsp;検索条件</h1>
            <!-- ID -->
            <div class="white_box SSmall" style="width: 8%;">
                <p>ID</p>
                {$setData.search_id}
            </div>
            <!-- 申込日-->
            <div class="white_box MMedium clear">
                <p>申込日</p>
                {$setData.submission_day}
            </div>
            <!-- 申込時間-->
            <div class="white_box Small">
                <p>申込時間</p>
                {$setData.submission_time}
            </div>
            <!-- 申込名-->
            <div class="white_box SSmall">
                <p>申込名</p>
                {$setData.submission_name}
            </div>
            <!-- 面接日-->
            <div class="white_box MMedium">
                <p>面接日</p>
                {$setData.interview}
            </div>

            <!--面接店舗-->
            <div class="white_box SSSmall">
                <p>面接店舗</p>
                <div class="set_print">{$setData.interviewshop_hidden}</div>
            </div>
            <!--所属店舗-->
            <div class="white_box SSSmall">
                <p>所属店舗</p>
                <div class="set_print">{$setData.belonging_store_hidden}</div>
            </div>
            <!-- 源氏名-->
            <div class="white_box SSmall clear">
                <p>源氏名</p>
                {$setData.genji_name}
            </div>
            <!-- 源氏名（ふりがな）-->
            <div class="white_box SSmall">
                <p>源氏名（ふりがな）</p>
                {$setData.genji_namekana}
            </div>
            <!-- 名前-->
            <div class="white_box XSMedium">
                <p>名前</p>
                {$setData.surname}{$setData.name}
            </div>
            <!-- 名前（ふりがな）-->
            <div class="white_box XSMedium">
                <p>名前（ふりがな）</p>
                {$setData.surnamekana}{$setData.namekana}
            </div>
            <!--年齢-->
            <div class="white_box clear">
                <p>年齢</p>
                {$setData.age_from} 歳&nbsp;～ {$setData.age_to} 歳
            </div>
            <!--身長-->
            <div class="white_box Small">
                <p>身長</p>
                {$setData.tall_from} cm&nbsp;～ {$setData.tall_to} cm
            </div>
            <!--体重-->
            <div class="white_box">
                <p>体重</p>
                {$setData.weight_from} kg&nbsp;～ {$setData.weight_to} kg
            </div>
            <!--カップ数-->
            <div class="white_box Small">
                <p>カップ数</p>
                {$setData.cup_hidden}
            </div>
            <!--経験-->
            <div class="white_box Small">
                <p>経験</p>
                <div class="set_print">{$setData.experience_hidden}</div>
            </div>
            <!--都道府県-->
            <div class="white_box Small">
                <p>都道府県</p>
                <div class="set_print">{$setData.pref_hidden}</div>
            </div>
            <!--面接前確認-->
            <div class="white_box Small">
                <p>面接前確認</p>
                <div class="set_print">{$setData.check_hidden}</div>
            </div>
            <!--身分証-->
            <div class="white_box clear">
                <p>身分証</p>
                <div class="set_print">{$setData.identity_card_select_hidden}</div>
            </div>
            <!--TEL-->
            <div class="white_box">
                <p>TEL</p>
                {$setData.tel01}<span class="hyphen">-</span>{$setData.tel02}<span class="hyphen">-</span>{$setData.tel03}
            </div>
            <!--Mail-->
            <div class="white_box XMedium">
                <p>Mail</p>
                {$setData.mail01}<span class="at">＠</span>{$setData.maildomain}
            </div>
            <!--面接結果-->
            <div class="white_box XSmall clear">
                <p>面接結果</p>
                <div class="set_print">{$setData.interview_result_hidden}</div>
            </div>
            <!--面接担当-->
            <div class="white_box XSmall">
                <p>面接担当</p>
                <div class="set_print">{$setData.interview_staff_hidden}</div>
            </div>
            <!--KS担当-->
            <div class="white_box XSmall">
                <p>KS担当</p>
                <div class="set_print">{$setData.ks_staff_hidden}</div>
            </div>
            <!--勤務形態-->
            <div class="white_box XSmall clear">
                <p>勤務形態</p>
                <div class="set_print">{$setData.work_hidden}</div>
            </div>
            <!--給料-->
            <div class="white_box Small">
                <p>給料</p>
                {$setData.salary_from} 円&nbsp;～&nbsp;{$setData.salary_to} 円
            </div>
            <!--特別指名料-->
            <div class="white_box Small">
                <p>特別指名料</p>
                {$setData.nomination_fee_from} 円&nbsp;～&nbsp;{$setData.nomination_fee_to} 円
            </div>
            <!-- 退店 -->
            <div class="white_box search3 clear">
                <p>退店</p>
                {$setData.leaving_check}
            </div>
            <!-- 退店日 -->
            <div class="white_box MMedium">
                <p>退店日</p>
                {$setData.leaving_day}
            </div>
            <!--退店理由-->
            <div class="white_box">
                <p>退店理由</p>
                <div class="set_print">{$setData.leaving_reason_hidden}</div>
            </div>
            <!--掲載媒体-->
            <div class="white_box clear">
                <p>掲載媒体</p>
                <div class="set_print">{$setData.publicity_hidden}</div>
            </div>
            <!--掲載エリア-->
            <div class="white_box SSmall">
                <p>掲載エリア</p>
                <div class="set_print">{$setData.area_hidden}</div>
            </div>
            <!--掲載求人-->
            <div class="white_box">
                <p>掲載求人</p>
                <div class="set_print">{$setData.media_hidden}</div>
            </div>
            <!--掲載業種-->
            <div class="white_box">
                <p>掲載業種</p>
                <div class="set_print">{$setData.genre_hidden}</div>
            </div>
            <!--SC-->
            <div class="white_box">
                <p>SC</p>
                <div class="set_print">{$setData.scout_hidden}</div>
            </div>
            <!--出戻り・移籍・紹介-->
            <div class="white_box SSmall">
                <p>出戻り・移籍・紹介</p>
                <div class="set_print">{$setData.move_hidden}</div>
            </div>
            <!--他店紹介-->
            <div class="white_box XMedium">
                <p>他店紹介</p>
                <div class="set_print">{$setData.another_shop_hidden}</div>
                <p>備考</p>
                {$setData.another_shop_remarks}
            </div>
            <!--検索ワード-->
            <div class="white_box SSmall clear">
                <p>検索ワード</p>
                <div class="set_print">{$setData.word_hidden}</div>
            </div>
            <!--チェック-->
            <div class="white_box search4">
                <p>出稼ぎ</p>
                {$setData.working_away_flg}
            </div>
            <div class="white_box search">
                <p>ニコイチ</p>
                {$setData.working_away_flg}
            </div>
            <div class="white_box search2">
                <p>オファーメールからの申し込み</p>
                {$setData.scout_mail_flg}
            </div>
            <!--店舗スタッフ-->
            <div class="white_box SSmall clear">
                <p>店舗スタッフ</p>
                {$setData.staff_flg}
            </div>

        </section>
    

    <section class="search_col">
        <h1>検索結果</h1>
        <h2><span class="num_hit">{$result|count}</span>件ヒットしました。</h2>
        <!--検索ボタン-->
        <div class="search_btn2">
            <a href="/search"><button type="submit" class="btn_orange">違う条件で検索</button></a>
        </div>
        <div class="table_cmn">
            <table class="scout_check">
                <colgroup>
                    <col class="date-width">
                    <col>
                    <col>
                    <col>
                    <col class="baitainame-width">
                    <col class="girlname-width">
                    <col>
                    <col>
                    <col class="mail-width">
                    <col class="result-width">
                    <col class="intvw_conf">
                </colgroup>
                <thead>
                <tr>
                    <th class="date-width">申込日</th>
                    <th class="">ID</th>
                    <th class="">本名</th>
                    <th class="">掲載求人名</th>
                    <th class="baitainame-width">掲載媒体</th>
                    <th class="girlname-width">申込名</th>
                    <th class="">年齢</th>
                    <th class="tel-width">TEL</th>
                    <th class="mail-width">メールアドレス</th>
                    <th class="result-width">面接結果</th>
                    <th class="intvw_conf">追跡状況</th>
                </tr>
                </thead>
                {foreach from=$result name="search" item=value key=key}
                <tr>
                    <td><a href="/inputdata/data/{$value.id}">{$value.submission_date|date_format:"%y.%m%d"}</a></td>
                    <td>{$value.id}</td>
                    <td>{$value.surname|default:""} {$value.name|default:""}</td>
                    <td>{$value.publicity}</td>
                    <td>{$value.media}</td>
                    <td>{if $value.nikoiti_flg === "1"}<i class="fa fa-star "></i>{/if}{$value.submission_name|default:""}</td>
                    <td>{$value.age|default:""}</td>
                    <td>{$value.tel01|default:""}-{$value.tel02|default:""}-{$value.tel03|default:""}</td>
                    <td>
                        {if $value.mail01|default:"" !== "" AND $value.maildomain|default:"" !== ""}
                            {$value.mail01|default:""}@{$value.maildomain|default:""}
                        {/if}
                    </td>
                    <td>{$value.interview_result|default:""}</td>
                    <td>{if $value.stop_tracking_flg === "1"}<span class="yellow">追跡中</span>{else}追跡中止{/if}</td>
                </tr>
                {/foreach}
            </table>
        </div>
    </section>
</article>

{include file=$smarty.const.ADMIN_FOOTER}