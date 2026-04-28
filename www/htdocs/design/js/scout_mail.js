$(function() {
  $('select[name=mail_tmplt1]').change(function() {
    var val = $(this).val();
    var tmp1 = "＜お礼のビジネスメールの例＞<br>○○会社営業部 部長<br>××様<br>いつも大変お世話になっております。<br>株式会社△△の田中です";
    var tmp2 = "取り急ぎ、ご報告があります。<br>本日、10時からの大和商会との打ち合わせですが、<br>遅刻してしまいました。<br>大事な打ち合わせでしたので、もう少し早く会社を出れば遅刻することはなかったと反省しています。";
    var tmp3 = "お疲れ様です。総務部の山田　太郎です。<br>本社会議室は、模様替え工事のため、下記期間の利用を一時停止いたします。";
    if ( val == 1 ) {
      $('.scout_mail_ttl.speed').text("タイトル1");
      $('.scout_mail_tmplt.speed').html(tmp1);
    }　else if ( val == 2 ) {
      $('.scout_mail_ttl.speed').text("タイトル2");
      $('.scout_mail_tmplt.speed').html(tmp2);
    } else if  ( val == 3 ){
      $('.scout_mail_ttl.speed').text("タイトル3");
      $('.scout_mail_tmplt.speed').html(tmp3);
    } else {
      $('.scout_mail_ttl.speed').text("選択してください");
      $('.scout_mail_tmplt.speed').text("選択してください");
    }
  });
});
$(function() {
  $('select[name=mail_tmplt2]').change(function() {
    var val = $(this).val();
    var tmp1 = "＜お礼のビジネスメールの例＞<br>○○会社営業部 部長<br>××様<br>いつも大変お世話になっております。<br>株式会社△△の田中です";
    var tmp2 = "取り急ぎ、ご報告があります。<br>本日、10時からの大和商会との打ち合わせですが、<br>遅刻してしまいました。<br>大事な打ち合わせでしたので、もう少し早く会社を出れば遅刻することはなかったと反省しています。";
    var tmp3 = "お疲れ様です。総務部の山田　太郎です。<br>本社会議室は、模様替え工事のため、下記期間の利用を一時停止いたします。";
    if ( val == 1 ) {
      $('.scout_mail_ttl.eco').text("タイトル1");
      $('.scout_mail_tmplt.eco').html(tmp1);
    }　else if ( val == 2 ) {
      $('.scout_mail_ttl.eco').text("タイトル2");
      $('.scout_mail_tmplt.eco').html(tmp2);
    } else if  ( val == 3 ){
      $('.scout_mail_ttl.eco').text("タイトル3");
      $('.scout_mail_tmplt.eco').html(tmp3);
    } else {
      $('.scout_mail_ttl.eco').text("選択してください");
      $('.scout_mail_tmplt.eco').text("選択してください");
    }
  });
});

$(function() {
  $('select[name=mail_tmplt3]').change(function() {
    var val = $(this).val();
    var tmp1 = "＜お礼のビジネスメールの例＞<br>○○会社営業部 部長<br>××様<br>いつも大変お世話になっております。<br>株式会社△△の田中です";
    var tmp2 = "取り急ぎ、ご報告があります。<br>本日、10時からの大和商会との打ち合わせですが、<br>遅刻してしまいました。<br>大事な打ち合わせでしたので、もう少し早く会社を出れば遅刻することはなかったと反省しています。";
    var tmp3 = "お疲れ様です。総務部の山田　太郎です。<br>本社会議室は、模様替え工事のため、下記期間の利用を一時停止いたします。";
    if ( val == 1 ) {
      $('.scout_mail_ttl.tique').text("タイトル1");
      $('.scout_mail_tmplt.tique').html(tmp1);
    }　else if ( val == 2 ) {
      $('.scout_mail_ttl.tique').text("タイトル2");
      $('.scout_mail_tmplt.tique').html(tmp2);
    } else if  ( val == 3 ){
      $('.scout_mail_ttl.tique').text("タイトル3");
      $('.scout_mail_tmplt.tique').html(tmp3);
    } else {
      $('.scout_mail_ttl.tique').text("選択してください");
      $('.scout_mail_tmplt.tique').text("選択してください");
    }
  });
});
