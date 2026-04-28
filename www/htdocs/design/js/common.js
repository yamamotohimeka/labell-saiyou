//ドロワーメニュー
$(function() {
	HS = $('header').height();
	hsize = HS + 15;
	$(".wrapper").css("padding-top", hsize + "px");
	$(".drawer").drawer();//ドロワーメニュー
	$("a[href^= #]").click(function(){
			$(".drawer").drawer('close');
	});//リンクをクリックすると閉じる
});