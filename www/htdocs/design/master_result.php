<?php include('common/resource.php'); ?>
<title>面接結果｜マスター登録</title>
<?php include('common/header.php'); ?>


  <article>
    <section class="top_content_wrap">

    </section>
    <section>
      <div class="container table_cmn place_wrap master_cmn_wrap">
        <h1 class="breadcrumb"><div class="btn_orange"><a href="master_result_new.php">新規登録</a></div><span>面接結果の追加</span></h1>
        <table>
          <tr>
            <th class="master_cmn_nm">面接結果</th>
            <th class="xs" colspan="2">処理</th>
          </tr>
          <tr>
            <td class="master_cmn_name">採用</td>
            <td class="edit"><a href="master_result_new.php">編集</a></td>
            <td class="delete"><a href="#">削除</a></td>
          </tr>
          <tr>
            <td class="master_cmn_name">不採用</td>
            <td class="edit"><a href="master_result_new.php">編集</a></td>
            <td class="delete"><a href="#">削除</a></td>
          </tr>
          <tr>
            <td class="master_cmn_name">撃沈</td>
            <td class="edit"><a href="master_result_new.php">編集</a></td>
            <td class="delete"><a href="#">削除</a></td>
          </tr>
        </table>
      </div>
    </section>
  </article>



<?php include('common/footer.php'); ?>
