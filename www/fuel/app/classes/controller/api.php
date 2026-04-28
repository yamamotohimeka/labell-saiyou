<?php
use \Model\Common;
use \Model\Alertlist;
use \Model\Mailtmpl;
use \Model\Master;
use \Model\Inputdata;

class Controller_Api extends Controller_Frontbase
{
    /**
     * 面接データ消去
     */
    public function action_del_input_data()
    {
        if(Input::post("dataid")) {
            //面接データ(メイン)
            Common::del_data(Input::post("dataid"), "interview_main");
            //面接データ(サブ)
            Common::del_data(Input::post("dataid"), "interview_sub");
            //画像データ
            Common::del_data_col(Input::post("dataid"), "girl_image", "from_id");
            //面接履歴
            Common::del_data_col(Input::post("dataid"), "interview_history", "interview_id");
            //追跡備考
            Common::del_data_col(Input::post("dataid"), "tracking_remarks", "interview_id");
            //他のやり取り手段
            Common::del_data_col(Input::post("dataid"), "other_means", "interview_id");
        }
    }

    /**
     * 採用情報からの削除
     */
    public function action_del_careers_data()
    {
        if(Input::post("dataid")){
            Common::set_data(array("status" => 0) , Input::post("dataid") , "interview_main");
        }
    }

    /**
     * 並び替え
     */
    public function action_sort_master_data()
    {
        if(Input::post("dataid")){
            Common::set_data(array("status" => 0) , Input::post("dataid") , "interview_main");
        }
    }

    /**
     * 面接アラート
     */
    public function action_alert()
    {
        $result = Alertlist::get_data();

        echo $result["timer_count"];
    }

    /**
     * 面接アラート切替
     */
    public function action_alert_change()
    {
        Common::set_data(array("timer_flg" => Input::post("timer_flg")) , Input::post("id") , "interview_main");

        Response::redirect("/alertlist");
    }

    /**
     * 面接アラート情報更新
     */
    public function action_alert_update()
    {
        $check = Input::post("check");
        $timer = Input::post("timer");


//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ){
//            if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r( $check );
//            if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r( $timer );
//            exit;
//        }


        foreach ($check as $key => $value) {
            
            if(empty($value) OR $value == 1 OR $value == 6 OR $value == 7 OR $value == 8){
                $timer_flg = 1;
            }elseif($value == 2 OR $value == 3 OR $value == 4 OR $value == 5 OR $value == 9){
                $timer_flg = 0;
            }

//            $timer_flg = 1;
//            if($value == 6){
//                $timer = '';
//            }elseif($value == 2 OR $value == 3 OR $value == 4 OR $value == 5){
//                $timer_flg = 0;
//            }

            $updData = array(
                "timer" => $timer[$key],
                "check" => $value,
                "timer_flg" => $timer_flg
            );

            Common::set_data($updData , $key, "interview_main");
        }

        Response::redirect("/alertlist");
    }

    /**
     * 面接アラート情報更新 TEST
     */
//    public function action_alert_update_test()
//    {
//        $check = Input::post("check");
//        $timer = Input::post("timer");
//
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ){
//            if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r( $check );
//            if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r( $timer );
//            exit;
//        }
//
//        foreach ($check as $key => $value) {
//
//            if(empty($value) OR $value == 1 OR $value == 6 OR $value == 7 OR $value == 8){
//                $timer_flg = 1;
//            }elseif($value == 2 OR $value == 3 OR $value == 4 OR $value == 5 OR $value == 9){
//                $timer_flg = 0;
//            }
//
////            $timer_flg = 1;
////            if($value == 6){
////                $timer = '';
////            }elseif($value == 2 OR $value == 3 OR $value == 4 OR $value == 5){
////                $timer_flg = 0;
////            }
//
//            $updData = array(
//                "timer" => $timer[$key],
//                "check" => $value,
//                "timer_flg" => $timer_flg
//            );
//
////            Common::set_data($updData , $key, "interview_main");
//        }
//
//        Response::redirect("/alertlist");
//    }

    /**
     * 面接アラート情報更新
     */
    public function action_mailtmpl_select()
    {
        $result = Mailtmpl::get_rowdata(Input::post("mail_id"));

        $result[0]['mail_text'] = nl2br($result[0]['mail_text']);

        echo json_encode($result[0]);
    }

    /**
     * 掲載媒体取得
     */
    public function action_genre()
    {

        $setting_data = Config::get('setting', array());
        $masterData = Inputdata::get_select_data($setting_data);

        $result = Master::get_media_data(Input::post("mediaId"));

        if(isset($masterData['genre'][$result[0]['genre']])){
            $result[0]['genreId'] = $result[0]['genre'];
            $result[0]['genre'] = $masterData['genre'][$result[0]['genre']];
        }else{
            $result[0]['genreId'] = '';
            $result[0]['genre'] = '';
        }

        echo json_encode($result[0]);
    }


    /**
     * 編集中にする
     */
    public function action_insert_edit()
    {
        $dataid = Input::post("dataid");

        $user_id = Auth::get_user_id();
        $date = time();

        $sql = "SELECT id, user_id FROM editlist WHERE data_id = $dataid LIMIT 1";

        $user_data = Common::get_data($sql);

        if (empty($user_data)) {
            $insertArray = array(
                "user_id" => $user_id[1],
                "data_id" => $dataid,
                "updated_at" => $date
            );

            Common::set_data($insertArray, null, 'editlist');
        }

    }


    /**
     * 編集中解除にする
     */
    public function action_del_edit()
    {
        $dataid = Input::post("dataid");

        Common::del_data_col($dataid, 'editlist', 'data_id');
    }


  /**
   * 追跡振り分け更新
   */
  public function action_tracking_remarks_update()
  {
    $post = Input::post();

    $sub_data = Inputdata::generate_sub_tracking_remarks_data($post, $post['dataid']);
    Common::set_data($sub_data, $post['dataid'], 'interview_sub');

    Inputdata::set_tracking_data($post['tracking_data'], $post['dataid']);

  }

}