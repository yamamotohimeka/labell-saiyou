<?php include('common/resource.php'); ?>
<title>確認状況｜マスター登録</title>
<?php include('common/header.php'); ?>


  <article>
    <section class="top_content_wrap">

    </section>
    <section>
      <div class="container table_cmn place_wrap master_cmn_wrap">
        <h1 class="breadcrumb"><div class="btn_orange"><a href="master_check_new.php">新規登録</a></div><span>確認状況の追加</span></h1>
        <table>
          <tr>
            <th class="master_cmn_nm">確認状況</th>
            <th class="xs" colspan="2">処理</th>
          </tr>
          <tr>
            <td class="master_cmn_name">キャンセル</td>
            <td class="edit"><a href="master_result_new.php">編集</a></td>
            <td class="delete"><a href="#">削除</a></td>
          </tr>
          <tr>
            <td class="master_cmn_name">変更中</td>
            <td class="edit"><a href="master_result_new.php">編集</a></td>
            <td class="delete"><a href="#">削除</a></td>
          </tr>
          <tr>
            <td class="master_cmn_name">ブッチ</td>
            <td class="edit"><a href="master_result_new.php">編集</a></td>
            <td class="delete"><a href="#">削除</a></td>
          </tr>
          <tr>
            <td class="master_cmn_name">到着</td>
            <td class="edit"><a href="master_result_new.php">編集</a></td>
            <td class="delete"><a href="#">削除</a></td>
          </tr>
          <tr>
            <td class="master_cmn_name">確認済み</td>
            <td class="edit"><a href="master_result_new.php">編集</a></td>
            <td class="delete"><a href="#">削除</a></td>
          </tr>
          <tr>
            <td class="master_cmn_name">第一確認中</td>
            <td class="edit"><a href="master_result_new.php">編集</a></td>
            <td class="delete"><a href="#">削除</a></td>
          </tr>
          <tr>
            <td class="master_cmn_name">第二確認中</td>
            <td class="edit"><a href="master_result_new.php">編集</a></td>
            <td class="delete"><a href="#">削除</a></td>
          </tr>
        </table>
      </div>
    </section>
  </article>



<?php include('common/footer.php'); ?>
