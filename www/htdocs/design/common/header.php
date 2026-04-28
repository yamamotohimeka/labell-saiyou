</head>
<body class="drawer drawer--right">

<div class="wrapper">

  <header>
    <!-- alert -->
    <div class="alert_btn">
      <img src="img/alert.gif" onclick="winCenter()">
    </div>
    <div class="inner">
      <div class="container">
        <h1><img src="img/logo.png" width="53"><span>HeadOffice</span></h1>
        <div class="logout"><a href="#">LOGOUT</a></div>
        <div class="edit">
          <input type="submit" class="btn_orange edit2" onclick="winCenter2()" value="編集中リスト">
        </div>
        <div class="input btn_orange">
          <a href="input.php">データ入力</a>
        </div>
        <div class="searchbox">
          <form method="get" action="http://www.google.co.jp/search" target="_blank">
            <input name="q" size="31" maxlength="255" type="text" class="search_form" placeholder="おなまえ検索">
            <input name="btng" value="検索" type="image" class="search_btn" src="img/btn_search.png" width="38" height="30">
            <input name="hl" value="ja" type="hidden">
            <input name="sitesearch" value="web-officer.com" type="hidden">
          </form>
        </div>
        <div class="print">
          <a href="javascript:void(0)" onclick="window.print();return false;">
            <img src="img/icon_print.png" width="30">
            <span>PRINT OUT</span>
          </a>
        </div>
      </div>
    </div>



    <!-- header nav -->
    <nav>
      <div class="container">
        <ul class="nav">
            <li><a href="index.php">採用情報</a></li><!--
          --><li><a href="interview.php">面接予定情報</a></li><!--
          --><li><a href="search.php">検索条件</a></li><!--            
          --><li><a href="chase.php">追跡・連絡予定情報</a></li><!--
          --><li><a href="datalist.php">問合せリスト</a></li><!--      
          --><li><a href="scout.php">スカウトメール</a></li><!--
          --><li><a href="master.php">マスタ登録</a></li><!--          
          --><li><a href="staffs_name.php">グループ</a></li><!--
          --><li><a href="master_tmpl.php">メールテンプレート登録</a></li><!--
          --><li><a href="analyze.php">集計</a></li>
        </ul>
      </div>
    </nav>
    <!-- /header nav -->
    <script type="text/javascript">
      $(function(){
        $('.nav li a').each(function(){
        var $href = $(this).attr('href');
        if(location.href.match($href)) {
          $(this).parent().addClass('active');
          } else {
          $(this).parent().removeClass('active');
          }
        });
      });

      function winCenter(){

        var w = ( screen.width-640 ) / 2;
        var h = ( screen.height-520 ) / 2;

        window.open("alert_list.php","","width=640,height=520"
                    +",left="+w+",top="+h);
      }

      function winCenter2(){

        var w = ( screen.width-640 ) / 2;
        var h = ( screen.height-520 ) / 2;

        window.open("edit_list.php","","width=640,height=520"
                    +",left="+w+",top="+h);
      }


      
    </script>
  </header>
  <!--header-->
