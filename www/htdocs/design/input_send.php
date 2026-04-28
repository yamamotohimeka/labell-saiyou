<?php include('common/resource.php'); ?>
<title>データ入力</title>
<?php include('common/header.php'); ?>
<?php include('common/array.php'); ?>

<?php include('common/drawer.php'); ?>

<main role="main">
<section class="top_content_wrap">

</section>
<section class="container date_info_col">
  <h1 class="breadcrumb date_info_breadcrumb">&gt;&nbsp;データ入力</h1>
    <div class="send_wrap">
    	<div class="info_send">
			<a href="input_send_schdl.php"><button type="submit">面接予定送信</button></a>
		</div>
		<div class="info_send">
        	<a href="input_send_rcrt.php"><button type="submit">採用情報送信</button></a>
      	</div>
		<div class="info_return">
			<a href="input.php"><button type="submit">前のページに戻る <i class="fa fa-undo"></i></button></a>
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
