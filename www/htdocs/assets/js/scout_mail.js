$(function() {
    $(".form_mailtmpl").change(function(){
        var mail_id = $(this).val();
        var section_id = $(this).parents("section").attr("data-id");

        if(mail_id){
            $.ajax({
                type:"POST",
                url:"/api/mailtmpl_select",
                cache: false,
                data:{
                    'mail_id': mail_id
                },
                timeout: 10000
            }).done(function(data) {
                var mailtmpl = JSON.parse(data);

                $('.scout_mail_title' + section_id).text(mailtmpl.title);
                $('.scout_mail_body' + section_id).html(mailtmpl.mail_text);
            });
        }
    });

    $(".mail_send_btn").click(function(){
        event.preventDefault();

        var section_id = $(this).attr("data-id");

        if($(".mailtmpl_select" + section_id + " select").val() == 0){
            alert("メールテンプレートが選択されていません");
            return false;
        }

        var mail_title = $('.scout_mail_title' + section_id).text();
        var mail_text = $('.scout_mail_body' + section_id).text();
        var formdata = new FormData($('#send_mail_form' + section_id).get(0));
        formdata.append("mail_title", mail_title);
        formdata.append("mail_text", mail_text);

        $.ajax({
            url  : "/scout/send_mail",
            type : "POST",
            data : formdata,
            cache       : false,
            contentType : false,
            processData : false,
            dataType    : "html",
            timeout: 10000
        }).done(function(data) {
            swal('メールを送信しました');
        });

        return false;
    });
});

