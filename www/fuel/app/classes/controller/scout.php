<?php
use \Model\Common;

class Controller_Scout extends Controller_Frontbase
{
    /**
     * オファーメール 検索
     */
    public function action_index(){
        $view = View_Smarty::forge( "scout/index" );
        $presenter = Presenter::forge("scout", 'view', null, $view);
        $view->set_safe( "userData", $this->userData );

        return Response::forge($presenter);
    }

    /**
     * オファーメール 所属店舗 検索結果
     */
    public function action_search_shop(){
        $view = View_Smarty::forge( "scout/search-result-shop" );
        $presenter = Presenter::forge("scout", 'search_shop', null, $view);
        $view->set_safe( "userData", $this->userData );

        return Response::forge($presenter);
    }

    /**
     * オファーメール 掲載求人 検索結果
     */
    public function action_search_recruit(){
        $view = View_Smarty::forge( "scout/search-result-recruit" );
        $presenter = Presenter::forge("scout", 'search_recruit', null, $view);
        $view->set_safe( "userData", $this->userData );

        return Response::forge($presenter);
    }

    /**
     * メール送信(店舗)
     */
    public function action_mail_send_shop(){
        $view = View_Smarty::forge( "scout/mail-send-shop" );
        $presenter = Presenter::forge("scout", 'mail_send_shop', null, $view);
        $view->set_safe( "userData", $this->userData );

        return Response::forge($presenter);
    }

    /**
     * メール送信(求人)
     */
    public function action_mail_send_recruit(){
        $view = View_Smarty::forge( "scout/mail-send-recruit" );
        $presenter = Presenter::forge("scout", 'mail_send_recruit', null, $view);
        $view->set_safe( "userData", $this->userData );

        return Response::forge($presenter);
    }

    /**
     * メールテンプレート取得
     */
    public function action_get_mailtmpl()
    {
        Common::del_data(Input::post("dataid"), "interview_main");
        Common::del_data(Input::post("dataid"), "interview_sub");
    }

    public function action_send_mail()
    {
        $from = "info@re.sp-labelle.com";
        $title = Input::post("mail_title");
        $plainmail = strip_tags(Input::post("mail_text"));
        $returnmail = "log@execute.jp";

        $mail_list = implode(",", Input::post("send_id"));

        $sql = "
SELECT id, mail01, maildomain
FROM interview_main
WHERE id IN($mail_list)
";

        $mail_list = Common::get_data( $sql );

        foreach ($mail_list as $key => $value) {
        $mailto = $value["mail01"] . "@" . $value["maildomain"];

            if(preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/iD', $mailto)){
                $email = \Email::forge();
                $email->from($from, '');
                $email->to($mailto, '');
                $email->subject($title);
                $email->return_path($returnmail);
                $email->body($plainmail);

                try
                {
                    $email->send();
                }
                catch(\EmailValidationFailedException $e)
                {
                    // バリデーションが失敗したとき
                }
                catch(\EmailSendingFailedException $e)
                {
                    // ドライバがメールを送信できなかったとき
                }
            }
        }


    }
}
