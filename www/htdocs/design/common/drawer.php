
<div role="banner">
  <div class="interview_modal">
    <button type="button" class="drawer-toggle drawer-hamburger button">
    面接予定は<br>こちら
    </button>
    <nav class="drawer-nav" role="navigation">
		<div class="drawer-menu">
			<div class="drawer-menu_search">
				<iframe src="common/interview_list.php" width="830px" height="600px"></iframe>
			</div>
		</div>
    </nav>
  </div>
</div>
<script src="js/jquery.multiple.select.js"></script>
<script>
  //セレクト複数選択
  $(function() {
    var $selects = $('[id^=select_]');
    $selects.multipleSelect();
  });
</script>



