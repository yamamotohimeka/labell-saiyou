{include file=$smarty.const.ADMIN_HEADER}

<article>
    <section class="top_content_wrap">
    </section>
    {*<section class="">*}
        {*<div class="container analyze_wrap date_info_col">*}
            {*<h1 class="breadcrumb">&gt;&nbsp;集計</h1>*}
            {*<ul class="analyze_navi">*}
                {*<li><a href="analyze_monthly.php">月間集計</a></li>*}
                {*<li><a href="analyze.php">採用数</a></li>*}
                {*<li><a href="analyze_media.php">掲載媒体</a></li>*}
                {*<li><a href="analyze_divide.php">面接振り件数</a></li>*}
                {*<li><a href="analyze_branch.php">他店紹介</a></li>*}
                {*<li><a href="analyze_peas.php">ニコイチ</a></li>*}
                {*<li><a href="analyze_emigrate.php">出稼ぎ</a></li>*}
                {*<li><a href="analyze_recruit.php">入店率</a></li>*}
                {*<li><a href="analyze_keep.php">継続率</a></li>*}
                {*<li><a href="analyze_time.php">申込時間</a></li>*}
                {*<li><a href="analyze_area.php">広告掲載エリア</a></li>*}
                {*<li><a href="analyze_word.php">検索ワード</a></li>*}
            {*</ul>    <!-- date_info_inner-->*}
            {*<form class="analyze_info_inner" action="analyze_result.php" method="get">*}
                {*<h2>採用数</h2>*}
                {*<!--date_left_col-->*}
                {*<div class="analyze_form_wrap">*}
                    {*<!-- 入店日-->*}
                    {*<div class="white_box MMedium">*}
                        {*<p>入店日</p>*}
                        {*<div class="select_arrow select_y">*}
                            {*<select name="入店年" required>*}
                                {*<option value="">—</option>*}
                                {*<option value="2013">2013</option>*}
                                {*<option value="2014">2014</option>*}
                                {*<option value="2015">2015</option>*}
                                {*<option value="2016">2016</option>*}
                                {*<option value="2017">2017</option>*}
                                {*<option value="2018">2018</option>*}
                                {*<option value="2019">2019</option>*}
                                {*<option value="2020">2020</option>*}
                                {*<option value="2021">2021</option>*}
                                {*<option value="2022">2022</option>*}
                                {*<option value="2023">2023</option>*}
                                {*<option value="2024">2024</option>*}
                            {*</select>*}
                        {*</div>*}
                        {*<span class="select_ymd_txt">年</span>*}

                        {*<div class="select_arrow select_md">*}
                            {*<select name="入店月" required>*}
                                {*<option value="">—</option>*}
                                {*<option value="1">1</option>*}
                                {*<option value="2">2</option>*}
                                {*<option value="3">3</option>*}
                                {*<option value="4">4</option>*}
                                {*<option value="5">5</option>*}
                                {*<option value="6">6</option>*}
                                {*<option value="7">7</option>*}
                                {*<option value="8">8</option>*}
                                {*<option value="9">9</option>*}
                                {*<option value="10">10</option>*}
                                {*<option value="11">11</option>*}
                                {*<option value="12">12</option>*}
                            {*</select>*}
                        {*</div>*}
                        {*<span class="select_ymd_txt">月</span>*}

                        {*<div class="select_arrow select_md">*}
                            {*<select name="入店日" required>*}
                                {*<option value="">—</option>*}
                                {*<option value="1">1</option>*}
                                {*<option value="2">2</option>*}
                                {*<option value="3">3</option>*}
                                {*<option value="4">4</option>*}
                                {*<option value="5">5</option>*}
                                {*<option value="6">6</option>*}
                                {*<option value="7">7</option>*}
                                {*<option value="8">8</option>*}
                                {*<option value="9">9</option>*}
                                {*<option value="10">10</option>*}
                                {*<option value="11">11</option>*}
                                {*<option value="12">12</option>*}
                                {*<option value="13">13</option>*}
                                {*<option value="14">14</option>*}
                                {*<option value="15">15</option>*}
                                {*<option value="16">16</option>*}
                                {*<option value="17">17</option>*}
                                {*<option value="18">18</option>*}
                                {*<option value="19">19</option>*}
                                {*<option value="20">20</option>*}
                                {*<option value="21">21</option>*}
                                {*<option value="22">22</option>*}
                                {*<option value="23">23</option>*}
                                {*<option value="24">24</option>*}
                                {*<option value="25">25</option>*}
                                {*<option value="26">26</option>*}
                                {*<option value="27">27</option>*}
                                {*<option value="28">28</option>*}
                                {*<option value="29">29</option>*}
                                {*<option value="30">30</option>*}
                                {*<option value="31">31</option>*}
                            {*</select>*}
                        {*</div>*}
                        {*<span class="select_ymd_txt">日&nbsp;～&nbsp;</span>*}
                        {*<div class="select_arrow select_y">*}
                            {*<select name="入店年" required>*}
                                {*<option value="">—</option>*}
                                {*<option value="2013">2013</option>*}
                                {*<option value="2014">2014</option>*}
                                {*<option value="2015">2015</option>*}
                                {*<option value="2016">2016</option>*}
                                {*<option value="2017">2017</option>*}
                                {*<option value="2018">2018</option>*}
                                {*<option value="2019">2019</option>*}
                                {*<option value="2020">2020</option>*}
                                {*<option value="2021">2021</option>*}
                                {*<option value="2022">2022</option>*}
                                {*<option value="2023">2023</option>*}
                                {*<option value="2024">2024</option>*}
                            {*</select>*}
                        {*</div>*}
                        {*<span class="select_ymd_txt">年</span>*}

                        {*<div class="select_arrow select_md">*}
                            {*<select name="入店月" required >*}
                                {*<option value="">—</option>*}
                                {*<option value="1">1</option>*}
                                {*<option value="2">2</option>*}
                                {*<option value="3">3</option>*}
                                {*<option value="4">4</option>*}
                                {*<option value="5">5</option>*}
                                {*<option value="6">6</option>*}
                                {*<option value="7">7</option>*}
                                {*<option value="8">8</option>*}
                                {*<option value="9">9</option>*}
                                {*<option value="10">10</option>*}
                                {*<option value="11">11</option>*}
                                {*<option value="12">12</option>*}
                            {*</select>*}
                        {*</div>*}
                        {*<span class="select_ymd_txt">月</span>*}

                        {*<div class="select_arrow select_md">*}
                            {*<select name="入店日" required>*}
                                {*<option value="">—</option>*}
                                {*<option value="1">1</option>*}
                                {*<option value="2">2</option>*}
                                {*<option value="3">3</option>*}
                                {*<option value="4">4</option>*}
                                {*<option value="5">5</option>*}
                                {*<option value="6">6</option>*}
                                {*<option value="7">7</option>*}
                                {*<option value="8">8</option>*}
                                {*<option value="9">9</option>*}
                                {*<option value="10">10</option>*}
                                {*<option value="11">11</option>*}
                                {*<option value="12">12</option>*}
                                {*<option value="13">13</option>*}
                                {*<option value="14">14</option>*}
                                {*<option value="15">15</option>*}
                                {*<option value="16">16</option>*}
                                {*<option value="17">17</option>*}
                                {*<option value="18">18</option>*}
                                {*<option value="19">19</option>*}
                                {*<option value="20">20</option>*}
                                {*<option value="21">21</option>*}
                                {*<option value="22">22</option>*}
                                {*<option value="23">23</option>*}
                                {*<option value="24">24</option>*}
                                {*<option value="25">25</option>*}
                                {*<option value="26">26</option>*}
                                {*<option value="27">27</option>*}
                                {*<option value="28">28</option>*}
                                {*<option value="29">29</option>*}
                                {*<option value="30">30</option>*}
                                {*<option value="31">31</option>*}
                            {*</select>*}
                        {*</div>*}
                        {*<span class="select_ymd_txt">日&nbsp;迄</span>*}
                    {*</div>*}
                    {*<!--店舗-->*}
                    {*<div class="white_box clear">*}
                        {*<p>店舗</p>*}
                        {*<div class="select_arrow select_long">*}
                            {*<select id="select_shop" class="req01" style="width: 210px;">*}
                                {*<optgroup label="全て選択">*}
                                    {*<option value="">スピード梅田</option>*}
                                    {*<option value="">スピード京橋</option>*}
                                    {*<option value="">スピード難波</option>*}
                                    {*<option value="">スピード日本橋</option>*}
                                    {*<option value="">エコ梅田</option>*}
                                    {*<option value="">エコ京橋</option>*}
                                    {*<option value="">エコ難波</option>*}
                                    {*<option value="">エコ日本橋</option>*}
                                    {*<option value="">エコ天王寺</option>*}
                                    {*<option value="">ティーク谷九</option>*}
                                    {*<option value="">本部</option>*}
                                {*</optgroup>*}
                            {*</select>*}
                        {*</div>*}
                    {*</div>*}
                    {*<!-- 掲載求人 -->*}
                    {*<div class="white_box clear">*}
                        {*<p>掲載求人</p>*}
                        {*<div class="select_arrow select_medium">*}
                            {*<select id="select_recruit" class="req02" name="掲載求人" style="width: 210px;">*}
                                {*<optgroup label="全て選択">*}
                                    {*<option value="">スピード</option>*}
                                    {*<option value="">エコ</option>*}
                                    {*<option value="">ティーク</option>*}
                                    {*<option value="">プルミエール</option>*}
                                    {*<option value="">エデン</option>*}
                                    {*<option value="">関西セレクション</option>*}
                                    {*<option value="">プレミアムリゾート</option>*}
                                    {*<option value="">ハート</option>*}
                                    {*<option value="">KIREI</option>*}
                                    {*<option value="">カンテサンス</option>*}
                                    {*<option value="">今日はココマデ</option>*}
                                {*</optgroup>*}
                            {*</select>*}
                        {*</div>*}
                    {*</div>*}
                    {*<!--検索ボタン-->*}
                    {*<div class="analyze_btn">*}
                        {*<a href="analyze_result.php"><button id="anl_btn" type="submit" class="btn_orange">検索</button></a>*}
                    {*</div>*}
                {*</div>*}
            {*</form>*}
        {*</div>*}
    {*</section>*}
</article>

{include file=$smarty.const.ADMIN_FOOTER}