{include file=$smarty.const.ADMIN_HEADER}

<article>
    <section class="top_content_wrap">

    </section>
    <section id="group" class="container interview_wrap">
        <h2 class="breadcrumb">&gt;&nbsp;マスター登録</h2>
        <div class="master_list">
            <ul>
                <li><a href="/master/list/belonging_store">店舗</a></li>
                <li><a href="/master/list/staff">スタッフ＋メールアドレス</a></li>
                <li><a href="/master/list/group">グループ名</a></li>
                <li><a href="/master/list/publicity">掲載媒体</a></li>
                <li><a href="/master/list/genre">掲載業種</a></li>
                <li><a href="/master/list/media">掲載求人</a></li>
                <li><a href="/master/list/area">広告検索エリア</a></li>
                {*<li><a href="/master/list/check">確認状況</a></li>*}
                <li><a href="/master/list/place">待ち合わせ場所</a></li>
                <li><a href="/master/list/word">検索ワード</a></li>
                <li><a href="/master/list/person">身分証</a></li>
                <li><a href="/master/list/experience">経験</a></li>
                <li><a href="/master/list/work">勤務形態</a></li>
                <li><a href="/master/list/interviewshop">面接店舗</a></li>
                <li><a href="/master/list/maildomain">メールドメインの登録</a></li>
                <li><a href="/master/list/another_shop">他店紹介</a></li>
                <li><a href="/master/list/reason">追跡理由</a></li>
                <li><a href="/master/list/contact">連絡方法</a></li>

                {* 2022.01.14 非表示に変更：集計の View に関係してくるので編集不可に*}
                {*<li><a href="/master/list/interview_result">面接結果</a></li>*}
                
                <li><a href="/master/list/leaving_reason">退店理由</a></li>
                <li><a href="/master/list/move">出戻・移籍 etc</a></li>
            </ul>
        </div>
    </section>
</article>

{include file=$smarty.const.ADMIN_FOOTER}