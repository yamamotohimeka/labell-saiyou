<?php
use \Model\Common;
use \Model\Inputdata;
use \Model\Interviewhistory;

class Controller_Inputdata extends Controller_Frontbase
{
    public function action_index()
    {
        Response::redirect("/inputdata/data/");
    }

    public function action_data($id = null){

//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ){
//            $fp = fopen('/var/www/re.sp-labelle.com/www/htdocs/uploader.txt','a');
//            foreach (Input::post() AS $key => $value){
//                fputs($fp, $key . " => " . $value . "\n");
//            }
//            fclose($fp);
//        }
            $addjs = "";

        if(Input::post('update_form') === "update_form" OR Input::post('complete_form') === "complete_form" OR Input::post('update_ajax') === "update_ajax"){
            $validation_errors = $this->data_validation_errors();
            if(!empty($validation_errors)) {
                if(Input::post('update_ajax') === "update_ajax"){
                    return json_encode(array('result' => 'fail', 'message' => $validation_errors));
                }
                return Response::forge($this->data_default_presenter($id, "", $validation_errors));
            }

            $update_id = $id;
            $id = Inputdata::set_data(Input::post(), $id);

            //ステータスを履歴テーブルに保存
            $history_submission_date = Input::post('submission_year') . '-' . Input::post('submission_month'). '-' . Input::post('submission_day');
            $history_interview_date = Input::post('interview_year') . '-' . Input::post('interview_month'). '-' . Input::post('interview_day');

            $interview_result = Input::post('interview_result', 0);
            Interviewhistory::history_save($id, $interview_result, $history_submission_date, $history_interview_date);

            if(isset($_POST['img_del'])){
                foreach($_POST['img_del'] AS $key=>$value){

                    $sql = "SELECT file FROM girl_image WHERE img_id = $key LIMIT 1";
                    $imgData = Common::get_data( $sql, "one" );

                    Imgset::userImgFileDel("girl_image", $imgData, NULL, $id, "girl");
                    Common::del_data_col($key, "girl_image", "img_id", NULL);
                }
            }

            foreach ($_FILES as $key => $value) {
                if($value['name']){
                    $i = mb_substr($key, -1);

                    //imgIdをチェック
                    if(!empty($id)){
                        $sql = "SELECT img_id FROM girl_image WHERE from_id = $id AND no = $i LIMIT 1";

                        $imgId = Common::get_data( $sql, "one" );
                    }

                    if( isset($imgId) AND $imgId !=="" ){
                        $fileName = Imgset::set_image( $i, $value, "girl_image", $imgId, NULL, $id, $i, NULL, 390 );
                        $set_data_array[$key] = $fileName;

                    }else{
                        //メインテーブル更新
                        $fileName = Imgset::set_image( $i, $value, "girl_image", NULL, NULL, $id, $i, NULL,390 );
                        $set_data_array[$key] = $fileName;
                    }
                }
            }

            $basePath = \Uri::base(false);

            if(Input::post('complete_form') === "complete_form") {

                $addjs = <<<EOD
window.open().location.href="{$basePath}inputdata/sendmail/$id"
location.href="{$basePath}interview"
EOD;
                // 確定後は面接予定情報へ（新規データ入力 inputdata/data/ へは送らない）
//                Response::redirect("/inputdata/sendmail/$id");
            }elseif(Input::post('update_ajax') === "update_ajax"){
                return json_encode(array('result' => 'success', 'id' => $id ));
            }else{
//                Response::redirect("/datalist");
                Response::redirect($basePath . "interview");
            }
        }

        //右上×ボタン押下時(編集中解除)
        if(Input::get('del_edit')){
            Inputdata::edit_delete(Input::get('del_edit'));

            Response::redirect("/");
        }

        return Response::forge($this->data_default_presenter($id, $addjs));
    }

    private function data_default_presenter($id, $add_javascript= "", $validate_errors = array()) {
        $view = View_Smarty::forge( "input/index" );
        $view->set_safe( "id", $id );
        $view->set_safe( "addjs", $add_javascript );
        $view->set_safe( "userId", $this->userId[1] );
        $view->set_safe( "userData", $this->userData );
        $view->set_safe( "validate", $validate_errors);
        return Presenter::forge("inputdata", 'view', null, $view);
    }

    private function data_validation_errors() {
        if (\Fuel::$env === \Fuel::DEVELOPMENT && \Config::get('input_relax_required_validation', false)) {
            return array();
        }

        $validation = \Fuel\Core\Validation::forge('input_data_validate_data');
        $validation->add_callable('Validation_Japanese');

        $validation->add('age', '年齢')->add_rule('max_length', 2);
        $validation->add('hope_back_price', '希望バック')->add_rule('max_length', 5);
        $validation->add('warranty_time', '希望保障時間')->add_rule('max_length', 2);
        $validation->add('warranty_price', '希望保障金額')->add_rule('max_length', 6);

        $validation->add('celebration_price', '入店祝い')->add_rule('max_length', 6);
        $validation->add('salary', '給料')->add_rule('max_length', 5);
        $validation->add('nomination_fee', '特別指名料')->add_rule('max_length', 5);
        $validation->add('timer', '面接前タイマー')->add_rule('max_length', 3);

        $validation->add('genji_namekana', '源氏名(ふりがな)')->add_rule('hiragana');
        $validation->add('surnamekana', '姓(ふりがな)')->add_rule('hiragana');
        $validation->add('namekana', '名(ふりがな)')->add_rule('hiragana');





        $message = array();
        if($validation->run()) {
        } else {
            $errors = $validation->error();
            foreach( $errors as $field => $error )
            {
                $message[$field] = $error->get_message();
            }
        }
        return $message;
    }



    public function action_sameperson($id = null){

        $view = View_Smarty::forge( "input/sameperson");

//        $presenter = Presenter::forge("inputdata", 'sameperson', null, $view);
//        var_dump($view); exit();
//        var_dump($presenter); exit();

        $viewHtml = Presenter::forge("inputdata", 'sameperson', null, $view)->render();

        echo $viewHtml;
    }

    public function action_sendmail($id = null){
        $view = View_Smarty::forge( "input/sendmail" );
        $result = Inputdata::get_Inputdata_join_master($id);

//        $sql = "SELECT tentative_reserve_flg FROM interview_main WHERE id = $id";
//        $tentative_reserve_flg = Common::get_data( $sql, "one" );

        $view->set_safe( "id", $id );
        $view->set_safe( "result", $result );
//        $view->set_safe( "tentative_reserve_flg", $tentative_reserve_flg );
        $view->set_safe( "userData", $this->userData );

        $presenter = Presenter::forge("inputdata", 'sendmail', null, $view);

        return Response::forge($presenter);
    }

    public function action_send_schdl($id = null){
        $view = View_Smarty::forge( "input/send_schdl" );
        $view->set_safe( "id", $id );
        $view->set_safe( "userData", $this->userData );
        $presenter = Presenter::forge("inputdata", 'send_schdl', null, $view);

        return Response::forge($presenter);
    }

    public function action_send_rcrt($id = null){
        $view = View_Smarty::forge( "input/send_rcrt" );
        $view->set_safe( "id", $id );
        $view->set_safe( "userData", $this->userData );
        $presenter = Presenter::forge("inputdata", 'send_rcrt', null, $view);

        return Response::forge($presenter);
    }

    public function action_mail_schdl($id = null){


        $image_list = array();

        if(Input::post("sendmail", "") !== "sendmail"){

            $result = Inputdata::get_Inputdata_join_master($id);
            $data_array = (COUNT($result) > 0) ? array_shift($result) : false;
            if( $data_array ){
                //$flg_array = array(0 => "なし", 1 => "希望する");
                //$flg_array2 = array(0 => "なし", 1 => "あり");

                $setting_data = Config::get('setting', array());
                $masterData = Inputdata::get_select_data($setting_data);

                $cup_data = $setting_data['cup_data'];
                $cup_data[""] = "";
                $hope_workplace = $setting_data['hope_workplace'];
                $hope_workplace[""] = "";
                $apply_identity_card = $masterData['person'];
                $apply_identity_card[""] = "";

                $apply_identity_card_array = explode(",", $data_array["apply_identity_card"]);
                $body_text_apply_identity_card = "";
                $hope_workplace_array = explode(",", $data_array["hope_workplace"]);
                $body_text_hope_workplace = "";

                $body_text = "\n\n\n\n\n\n\n";
                $body_text .= Inputdata::set_mail_body(date('Y年n月j日', strtotime($data_array["interview_date"])), '【面接予定日】');
                $body_text .= Inputdata::set_mail_body("{$data_array["interview_hour"]}時{$data_array["interview_time"]}分", '【面接予定時間】');
                $body_text .= Inputdata::set_mail_body($data_array["interviewshop_name"], '【面接店舗】');
                $body_text .= Inputdata::set_mail_body($data_array["place_name"], '【待ち合わせ場所】','','', '', '');
                $body_text .= Inputdata::set_mail_body($data_array["place_remarks"],'','', '', '()');
                $body_text .= "\n";
                $body_text .= Inputdata::set_mail_body($data_array["media_name"], '【掲載求人】');
                $body_text .= Inputdata::set_mail_body($data_array["genre_name"], '【掲載業種】');
                $body_text .= Inputdata::set_mail_body($data_array["publicity_name"], '【掲載媒体】');
                $body_text .= "\n";
                $body_text .= Inputdata::set_mail_body($data_array["submission_name"], '【申込名】');
                $body_text .= Inputdata::set_mail_body($data_array["age"], '【年齢】', '歳');
                $body_text .= Inputdata::set_mail_body($data_array["experience_name"], '【経験】','','', ' ');
                $body_text .= Inputdata::set_mail_body($data_array["experience_remarks"], '','',"\n", "()");
                $body_text .= Inputdata::set_mail_body($data_array["tall"], '(身長)', 'cm');
                $body_text .= Inputdata::set_mail_body($data_array["weight"], '(体重)', 'kg');
                $body_text .= Inputdata::set_mail_body($data_array["bust"], '(バスト)', 'cm');
                $body_text .= Inputdata::set_mail_body($cup_data[$data_array["cup"]], '(カップ)', 'カップ');
                $body_text .= Inputdata::set_mail_body($data_array["waist"], '(ウエスト)', 'cm');
                $body_text .= Inputdata::set_mail_body($data_array["hip"], '(ヒップ)', 'cm');
//                $body_text .= Inputdata::set_mail_body($data_array["identity_card_name"], '【身分証】','','', ' ');
//                $body_text .= Inputdata::set_mail_body($data_array["identity_card_remarks"], '','',"\n", "()","\n");
                $tel_number = ( !empty($data_array["tel01"]) && !empty($data_array["tel02"]) && !empty($data_array["tel03"]) ) ? "{$data_array["tel01"]}-{$data_array["tel02"]}-{$data_array["tel03"]}" : "";
                $body_text .= Inputdata::set_mail_body( $tel_number, '【連絡先】');
                foreach($hope_workplace_array AS $key => $value){
                    if(!empty($hope_workplace[$value])) $body_text_hope_workplace .= $hope_workplace[$value] . ',';
                }
                $body_text .= Inputdata::set_mail_body($body_text_hope_workplace, '【希望勤務地】');

                foreach($apply_identity_card_array AS $key => $value){
                    if(!empty($apply_identity_card[$value])) $body_text_apply_identity_card .= $apply_identity_card[$value] . ',';
                }
                $body_text .= Inputdata::set_mail_body($body_text_apply_identity_card, '【身分証】');
                $body_text .= Inputdata::set_mail_body($data_array["apply_identity_card_remark"], '','',"\n", "()","\n");

                $body_text .= Inputdata::set_mail_body((empty($data_array["without_prior_flg"])) ? null : "面接のみ", '','',"\n", "()");
                $body_text .= "\n【備考】\n";
                $residence = Inputdata::set_mail_body((!empty($data_array["residence_flg"]) ? '(居住地)':"") , '','',"");
                $residence .= Inputdata::set_mail_body((!empty($data_array["residence_flg"]) ? $data_array["residence"] :"") , '','',"");
                $body_text .= Inputdata::set_mail_body($residence);

                $body_text .= Inputdata::set_mail_body((!empty($data_array["experience_possible_flg"]) ? '(体験可能)':""));

                $hope_back_price = Inputdata::set_mail_body((!empty($data_array["hope_back_flg"]) ? '(希望バック)':"") , '','',"");
                $hope_back_price .= Inputdata::set_mail_body((!empty($data_array["hope_back_flg"]) ? $data_array["hope_back_price"] :"") , '','円',"");
                $body_text .= Inputdata::set_mail_body($hope_back_price);

                $warranty = Inputdata::set_mail_body((!empty($data_array["warranty_flg"]) ? '(希望保証)':"") , '','',"");
                $warranty .= Inputdata::set_mail_body((!empty($data_array["warranty_flg"]) ? $data_array["warranty_time"] :"") , '','時間');
                $warranty .= Inputdata::set_mail_body((!empty($data_array["warranty_flg"]) ? $data_array["warranty_price"] :"") , '','円');
                $body_text .= Inputdata::set_mail_body($warranty);

                $celebration_price = Inputdata::set_mail_body((!empty($data_array["celebration_flg"]) ? '(入店祝い金)':"") , '','',"");
                $celebration_price .= Inputdata::set_mail_body((!empty($data_array["celebration_flg"]) ? $data_array["celebration_price"] :"") , '','円');
                $body_text .= Inputdata::set_mail_body($celebration_price);

                $body_text .= Inputdata::set_mail_body((!empty($data_array["transportation_expenses_flg"]) ? '(交通費)':""));
                $body_text .= Inputdata::set_mail_body((!empty($data_array["send_to_home_flg"]) ? '(送り)':""));
                $body_text .= Inputdata::set_mail_body((!empty($data_array["send_to_shop_flg"]) ? '(迎え)':""));
                $body_text .= Inputdata::set_mail_body((!empty($data_array["single_room_wait_flg"]) ? '(個室待機)':""));
                $body_text .= Inputdata::set_mail_body((!empty($data_array["dorm_flg"]) ? '(寮)':""));
                $body_text .= Inputdata::set_mail_body((!empty($data_array["nursery_flg"]) ? '(託児所)':""));
                $body_text .= Inputdata::set_mail_body((!empty($data_array["advance_salary_flg"]) ? '(バンス)':""));
                $body_text .= Inputdata::set_mail_body((!empty($data_array["tatoo_flg"]) ? '(タトゥーや傷)':""));
                $body_text .= Inputdata::set_mail_body((!empty($data_array["menses_flg"]) ? '(生理中)':""));
                $body_text .= Inputdata::set_mail_body((!empty($data_array["same_person_flg"]) ? '(同一人物)':""));

                $nikoiti = Inputdata::set_mail_body((!empty($data_array["nikoiti_flg"]) ? '(ニコイチ)':"") , '','',"");
                $nikoiti .= Inputdata::set_mail_body((!empty($data_array["nikoiti_flg"]) ? $data_array["nikoiti"] :"") , '','',"");
                $body_text .= Inputdata::set_mail_body($nikoiti);

                $working_away = Inputdata::set_mail_body((!empty($data_array["working_away_flg"]) ? '(出稼ぎ)':"") , '','',"");
                $working_away .= Inputdata::set_mail_body((!empty($data_array["working_away_flg"]) ? $data_array["days_to_work_num"] :"") , '','日');
                $body_text .= Inputdata::set_mail_body($working_away);

                $other = Inputdata::set_mail_body((!empty($data_array["other_flg"]) ? '(その他)':"") , '','',"");
                $other .= Inputdata::set_mail_body((!empty($data_array["other_flg"]) ? $data_array["other"] :"") , '','');
                $body_text .= Inputdata::set_mail_body($other);

                $body_text .= "\n\n";
                $body_text .= "店舗のみなさま\nよろしくお願いいたします。";









//                if(COUNT( $data_array["image"] ) > 0){
                if( !empty($data_array["image"]) and COUNT( $data_array["image"] ) > 0){
                    foreach($data_array["image"] as $key => $value){
                        if($key < 4){
                            $image_list[$key]["img_id"] = $value["img_id"];
                            $image_list[$key]["ext"] = $value["ext"];
                        }
                    }
                }
            }else{
                $body_text = "";
            }

        }
        if(Input::post("sendmail") === "sendmail"){
            $basePath = \Uri::base(false);
            $sender_list = Input::post("sender_list");

            if(!$sender_list){
                Response::redirect($basePath . "inputdata/send_schdl/{$id}");
            }

            $staffData = Inputdata::get_staff_mail();

            $image_path = Input::post('image_list', array());

            $from = "info@re.sp-labelle.com";
            $title = strip_tags(Input::post("mail_title"));
            $plainmail = strip_tags(Input::post("mail_text"));
//            $returnmail = "return@exe.193-123.execute.jp";
            $returnmail = "info@re.sp-labelle.com";
            $had_send_error = false;
            $send_succeeded = false;
            foreach ($sender_list as $key => $value) {
                if(isset($staffData[$value])){
                    $mailto = $staffData[$value];
                    if($_SERVER["REMOTE_ADDR"] == "118.12.249.89"){
                        unset($mailto);
                        $mailto = 'nakai@execute.jp';
                    }elseif($_SERVER["REMOTE_ADDR"] == "221.113.41.190"){
                        unset($mailto);
                        $mailto = 'log@execute.jp';
//                        $mailto = 'nozomu4545@gmail.com';
                    }
                    $email = \Email::forge(array('force_mixed' => true));
                    $email->from($from, 'HeadOffice');
                    $email->to($mailto, '');
                    $email->subject($title);
                    $email->body($plainmail);
                    $email->return_path($returnmail);
                    foreach( $image_path as $img_k => $img_v ){
                        $email->attach(DOCROOT.$img_v);
                    }
                    try
                    {
                        $email->send();
                        $send_succeeded = true;
                    }
                    catch(\EmailValidationFailedException $e)
                    {
                        $had_send_error = true;
                    }
                    catch(\EmailSendingFailedException $e)
                    {
                        $had_send_error = true;
                    }
                }
            }

            $result = Inputdata::get_rowdata($id);
            if($result[0]["interview_send_date"] === NULL){
                $date = date("Y-m-d H:i:s");
                Common::set_data(array("interview_send_date" => $date), $id, "interview_main");
            }

            Common::set_data(array("status" => 1, "interview_send" => 1), $id, "interview_main");
            Common::set_data(array("interview_send_date" => date("Y-m-d H:i:s")), $id, "interview_main"); // 送信日 の更新
            Common::set_data(array("scheduled_date" => '', "stop_tracking_flg" => 2), $id, "interview_sub");

            $submission_date = !empty($result[0]["submission_date"]) ? $result[0]["submission_date"] : date('Y-m-d');
            $interview_date = !empty($result[0]["interview_date"]) ? $result[0]["interview_date"] : date('Y-m-d');
            Interviewhistory::history_save($id, 1, $submission_date, $interview_date);

            //ステータスを履歴テーブルに保存
            //$history_id = Interviewhistory::get_id($id, 1);
            //Common::set_data(array("interview_id" => $id, "status" => 1, 'submission_date' => date('Y-m-d'), 'created_at' => date('Y-m-d H:i:s')), $history_id, "interview_history");

            // 一部宛先で失敗しても、1件以上送信できていれば完了画面へ進める
            if($send_succeeded || !$had_send_error){
                Response::redirect($basePath . "inputdata/sent_schdl/{$id}");
            }else{
                Response::redirect($basePath . "inputdata/send_schdl/{$id}?error=1");
            }

        }

        $view = View_Smarty::forge( "input/mail_schdl" );
        $view->set_safe( "id", $id );
        $view->set_safe( "body_text", $body_text );
        $view->set_safe( "image_list", $image_list );
        $view->set_safe( "userData", $this->userData );
        $presenter = Presenter::forge("inputdata", 'mail_schdl', null, $view);

        return Response::forge($presenter);
    }

    public function action_mail_rcrt($id = null){

        if(Input::post("sendmail") === "sendmail"){
            $sender_list = Input::post("sender_list");


            if(!$sender_list){
                Response::redirect("/inputdata/send_rcrt/{$id}");
            }

            $staffData = Inputdata::get_staff_mail();
            $image_path = Input::post('image_list', array());

            $from = "info@re.sp-labelle.com";
            $title = strip_tags(Input::post("mail_title"));
            $plainmail = strip_tags(Input::post("mail_text"));
//            $returnmail = "return@exe.193-123.execute.jp";
            $returnmail = "info@re.sp-labelle.com";
            $error = 0;
            foreach ($sender_list as $key => $value) {
                if(isset($staffData[$value])){
                    $mailto = $staffData[$value];
                    if($_SERVER["REMOTE_ADDR"] == "118.12.249.89"){
                        unset($mailto);
                        $mailto = 'nakai@execute.jp';
                    }elseif($_SERVER["REMOTE_ADDR"] == "221.113.41.190"){
                        unset($mailto);
                        $mailto = 'log@execute.jp';
//                        $mailto = 'nozomu4545@gmail.com';
                    }
                    $email = \Email::forge(array('force_mixed' => true));
                    $email->from($from, 'HeadOffice');
                    $email->to($mailto, '');
                    $email->subject($title);
                    $email->body($plainmail);
                    $email->return_path($returnmail);
                    foreach( $image_path as $img_k => $img_v ){
                        $email->attach(DOCROOT.$img_v);
                    }
                    try
                    {
                        $email->send();
                    }
                    catch(\EmailValidationFailedException $e)
                    {
                        $error = 1;
                    }
                    catch(\EmailSendingFailedException $e)
                    {
                        $error = 1;
                    }
                }
            }
            $result = Inputdata::get_rowdata($id);

            // ｢採用済み｣以外は送信する度に日付けを更新
//            if($result[0]["adopt_send_date"] === NULL){
            if($result[0]["status"] != 2){
                $date = date("Y-m-d H:i:s");
                Common::set_data(array("adopt_send_date" => $date), $id, "interview_main");
            }

            Common::set_data(array("status" => 2, "adopt_send" => 1), $id, "interview_main");
            Common::set_data(array("scheduled_date" => '', "stop_tracking_flg" => 2), $id, "interview_sub");

            $submission_date = !empty($result[0]["submission_date"]) ? $result[0]["submission_date"] : date('Y-m-d');
            $interview_date = !empty($result[0]["interview_date"]) ? $result[0]["interview_date"] : date('Y-m-d');
            Interviewhistory::history_save($id, 2, $submission_date, $interview_date);

            /*
            //ステータスを履歴テーブルに保存
            if($result[0]['interview_result'] == '2' || $result[0]['interview_result'] == '7' ){

                $status = 1;
                $history_id = Interviewhistory::get_id($id, $status);
                Common::set_data(array("interview_id" => $id, "status" => $status, 'submission_date' => date('Y-m-d'), 'created_at' => date('Y-m-d H:i:s')), $history_id, "interview_history");

                $status = 2;
                $history_id = Interviewhistory::get_id($id, $status);
                Common::set_data(array("interview_id" => $id, "status" => $status, 'submission_date' => date('Y-m-d'), 'created_at' => date('Y-m-d H:i:s')), $history_id, "interview_history");
            }else{
                $status = 1;
                $history_id = Interviewhistory::get_id($id, $status);
                Common::set_data(array("interview_id" => $id, "status" => $status, 'submission_date' => date('Y-m-d'), 'created_at' => date('Y-m-d H:i:s')), $history_id, "interview_history");
            }
            */
            if($error === 0){
                Response::redirect("/inputdata/sent_rcrt/{$id}");
            }else{
                Response::redirect("/inputdata/send_rcrt/{$id}?error=1");
            }

        }else{
            // 採用情報
            $result = Inputdata::get_Inputdata_join_master($id);
            $data_array = (COUNT($result) > 0) ? array_shift($result) : false;
            if( $data_array ){
                $setting_data = Config::get('setting', array());
                $masterData = Inputdata::get_select_data($setting_data);
                $data_array["interview_staff_name"] = ( !empty($masterData["staff"][$data_array["interview_staff"]]) ) ? $masterData["staff"][$data_array["interview_staff"]] : '未選択';
                $data_array["interview_staff_name_sub"] = ( !empty($masterData["staff"][$data_array["interview_staff_sub"]]) ) ? $masterData["staff"][$data_array["interview_staff_sub"]] : '';
                $data_array["ks_staff_name"] = ( !empty($masterData["staff"][$data_array["ks_staff"]]) ) ? $masterData["staff"][$data_array["ks_staff"]] : '未選択';
                $word_array = array();
                if ( !empty($masterData["word"][$data_array["word1"]]) ) {
                    $word_array[] = $masterData["word"][$data_array["word1"]];
                }
                if ( !empty($masterData["word"][$data_array["word2"]]) ) {
                    $word_array[] = $masterData["word"][$data_array["word2"]];
                }
                if ( !empty($masterData["word"][$data_array["word3"]]) ) {
                    $word_array[] = $masterData["word"][$data_array["word3"]];
                }
                if ( !empty($masterData["word"][$data_array["word4"]]) ) {
                    $word_array[] = $masterData["word"][$data_array["word4"]];
                }
                if ( !empty($masterData["word"][$data_array["word5"]]) ) {
                    $word_array[] = $masterData["word"][$data_array["word5"]];
                }
                if ( !empty($masterData["word"][$data_array["word6"]]) ) {
                    $word_array[] = $masterData["word"][$data_array["word6"]];
                }
                $data_array["search_word"] = implode(',', $word_array);
//                $data_array["interview_result"] = ( !empty($setting_data["interview_result"][$data_array["interview_result"]]) ) ? $setting_data["interview_result"][$data_array["interview_result"]] : '---';
                $data_array["interview_result"] = ( !empty($masterData["interview_result"][$data_array["interview_result"]]) ) ? $masterData["interview_result"][$data_array["interview_result"]] : '---';

                $cup_data = Config::get('setting.cup_data', array());
                $body_text = "No.{$id}";
                $body_text .= "\n\n\n\n\n";

                $body_text .= Inputdata::set_mail_body($data_array["belonging_store_name"], '【店舗】');
                $body_text .= Inputdata::set_mail_body($data_array["genji_name"], '【源氏名】','','', '', '');
                $body_text .= Inputdata::set_mail_body($data_array["genji_namekana"],'','', '', '()');
                $body_text .= "\n";

                $data_array["interview_date"] = ($data_array["interview_date"] === "0000-00-00") ? NULL : date('Y年n月j日', strtotime($data_array["interview_date"]));
                $body_text .= Inputdata::set_mail_body($data_array["interview_date"], '【面接日】');
                $data_array["working_day_date"] = ($data_array["working_day_date"] === "0000-00-00") ? NULL : date('Y年n月j日', strtotime($data_array["working_day_date"]));
                $body_text .= Inputdata::set_mail_body($data_array["working_day_date"], '【入店日】');
                $body_text .= "\n";

                $body_text .= Inputdata::set_mail_body($data_array["surname"]." ".$data_array["name"], '【名前】');
                $body_text .= Inputdata::set_mail_body($data_array["surnamekana"]." ".$data_array["namekana"],'','', '', '()');
                $body_text .= Inputdata::set_mail_body($data_array["age"], '【年齢】');
                $size = Inputdata::set_mail_body($data_array["tall"], 'T.','/','', '', '');
                $cup = ( empty($data_array["cup"]) ) ? NULL : $cup_data[$data_array["cup"]];
                $size .= Inputdata::set_mail_body($data_array["bust"].Inputdata::set_mail_body($cup, '','','', '()'), 'B.','/','', '', '');
                $size .= Inputdata::set_mail_body($data_array["waist"], 'W.','/','', '', '');
                $size .= Inputdata::set_mail_body($data_array["hip"], 'H.','/','', '', '');
                $size = rtrim($size, '/');
                $body_text .= Inputdata::set_mail_body($size, '【サイズ】');
                $body_text .= "\n";
                foreach( $setting_data["pref"] as $key => $value ){
                    foreach( $value as $k => $v){
                        $pref_array[$k] = $v;
                    }
                }
                $body_text .= Inputdata::set_mail_body( (!empty($pref_array[$data_array["pref"]])) ? $pref_array[$data_array["pref"]] : NULL , '【住所】');
                $body_text .= Inputdata::set_mail_body($data_array["experience_name"], '【経験】');
                $body_text .= "\n";

                $body_text .= Inputdata::set_mail_body($data_array["salary"], '【給料】', '円');
                $body_text .= Inputdata::set_mail_body($data_array["nomination_fee"], '【特別指名】', '円');
                $body_text .= Inputdata::set_mail_body( (!empty($masterData["work"][$data_array["work"]])) ? $masterData["work"][$data_array["work"]] : NULL , '【勤務形態】');
                $body_text .= "\n";

                $body_text .= Inputdata::set_mail_body( (!empty($data_array["identity_card_name"]) ) ? $data_array["identity_card_name"] : "未選択", '【本人確認】');
                $body_text .= Inputdata::set_mail_body($data_array["identity_card_remarks"], '','',"\n", "()","\n");
                $body_text .= "\n";

                $body_text .= Inputdata::set_mail_body($data_array["interview_staff_name"], '【面接担当】','','', '', '');
                $body_text .= Inputdata::set_mail_body($data_array["interview_staff_name_sub"],'','', "\n", '()');
                $body_text .= Inputdata::set_mail_body($data_array["ks_staff_name"], '【ＫＳ担当】');
                $body_text .= "\n";

                $body_text .= Inputdata::set_mail_body($data_array["publicity_name"], '【掲載媒体】');
                $body_text .= Inputdata::set_mail_body($data_array["media_name"], '【掲載求人】');
                $body_text .= "\n";

                if ( !empty($data_array["scout"]) ){
                    $body_text .= Inputdata::set_mail_body($data_array["scout"], '【SC】');
                    $body_text .= "\n";
                }
                if ( !empty($masterData["move"][$data_array["move"]]) ){
                    $body_text .= Inputdata::set_mail_body($masterData["move"][$data_array["move"]], '【出戻り・移籍・紹介】');
                    $body_text .= "\n";
                }

                $body_text .= Inputdata::set_mail_body($data_array["interview_result"], '【面接結果】');
                $body_text .= "\n";

                $body_text .= Inputdata::set_mail_body($data_array["remarks"], '【備考】');

                //4枚目だけ
                $image_list = array();
                if(!empty( $data_array["image"][4]["img_id"] ) ){
                    $image_list[4]["img_id"] = $data_array["image"][4]["img_id"];
                    $image_list[4]["ext"] = $data_array["image"][4]["ext"];
                }
            }else{
                $body_text = "";
            }


        }


        $view = View_Smarty::forge( "input/mail_rcrt" );
        $view->set_safe( "id", $id );
        $view->set_safe( "body_text", $body_text );
        $view->set_safe( "image_list", $image_list );
        $view->set_safe( "userData", $this->userData );
        $presenter = Presenter::forge("inputdata", 'mail_rcrt', null, $view);

        return Response::forge($presenter);
    }

    public function action_sent_schdl($id = null){

        // 編集中の解除（失敗しても完了画面は表示する）
        try {
            Common::del_data_col($id, 'editlist', 'data_id');
        } catch (\Exception $e) {
            // noop
        }

        $view = View_Smarty::forge( "input/sent_schdl" );
        $view->set_safe( "id", $id );
        $view->set_safe( "userData", $this->userData );
        $presenter = Presenter::forge("inputdata", 'sent_schdl', null, $view);

        return Response::forge($presenter);
    }

    public function action_sent_rcrt($id = null){

        // 編集中の解除（失敗しても完了画面は表示する）
        try {
            Common::del_data_col($id, 'editlist', 'data_id');
        } catch (\Exception $e) {
            // noop
        }

        $view = View_Smarty::forge( "input/sent_rcrt" );
        $view->set_safe( "id", $id );
        $view->set_safe( "userData", $this->userData );
        $presenter = Presenter::forge("inputdata", 'sent_rcrt', null, $view);

        return Response::forge($presenter);
    }

    public function action_get_group($id = null){

    }
}
