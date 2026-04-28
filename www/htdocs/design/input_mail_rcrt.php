<?php include('common/resource.php'); ?>
<title>採用情報送信メール｜データ入力</title>
<?php include('common/header.php'); ?>
<?php include('common/array.php'); ?>
<?php include('common/drawer.php'); ?>


<main role="main">
<section class="top_content_wrap">

</section>
<section class="container send_mail_col">
	<h2>採用情報送信</h2>
	<form class="send_mail_wrap">
		<div class="send_mail_line">
		  	<p class="send_mail_tl inline">送信先</p>
		  	<input type="text" class="send_mail_txt">
		</div>
		<div class="send_mail_line">
			<p class="send_mail_tl inline">タイトル</p>
		  	<input type="text" class="send_mail_txt">
		</div>
		<textarea name="" rows="30" cols="95" class="send_mail_contents" placeholder="採用情報送信メールの内容が入ります"></textarea>
	</form>
	<div class="send_col_wrap">
		<div class="info_return inline mail_button">
	      <a href="input_send_rcrt.php"><button type="button">前のページに戻る <i class="fa fa-undo"></i></button></a>
	    </div>	
	    <div class="info_send inline mail_button">
	      <a href="input_sent_rcrt.php"><button type="button">メール送信</button></a>
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
