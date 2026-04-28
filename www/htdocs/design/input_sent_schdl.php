<?php include('common/resource.php'); ?>
<title>面接予定送信完了｜データ入力</title>
<?php include('common/header.php'); ?>
<?php include('common/array.php'); ?>
<?php include('common/drawer.php'); ?>


<main role="main">
<section class="top_content_wrap">

</section>
<section class="container send_mail_col">
	<div class="mail_complete">
		<p>メール送信完了しました。</p>	
		<div class="send_col_wrap">		
		    <div class="info_send inline mail_button">
		      <a href="interview.php"><button type="button">面接予定ページへ</button></a>
		    </div>
	    </div>
    </div>
  </div>
</section>
</main>

<script type="text/javascript">
//drawer
$(function() {
  $('.drawer').drawer();
});

</script>

<?php include('common/footer.php'); ?>
