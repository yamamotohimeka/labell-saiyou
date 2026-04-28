<?php
use \Model\Inputdata;
use \Model\Search;
/**
 * The welcome hello presenter.
 *
 * @package  app
 * @extends  Presenter
 */
class Presenter_Search_Result extends Presenter
{
    /**
     * Prepare the view data, keeping this in here helps clean up
     * the controller.
     *
     * @return void
     */
    public function view()
    {
        $this->title = "検索条件";

        $setting_data = Config::get('setting', array());
        $masterData = Inputdata::get_select_data($setting_data);

//        $search = Input::get();
        $search = Input::post();
        $result = Search::get_data($search);
        $setData = $this->set_data($search);
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($setData);

        if(!empty($result)){
            foreach ($result as $key => $value) {
                if(isset($masterData['publicity'][$value['publicity']])){
                    $result[$key]['publicity'] = $masterData['publicity'][$value['publicity']];
                }else{
                    $result[$key]['publicity'] = "";
                }

                if(isset($masterData['experience'][$value['experience']])){
                    $result[$key]['experience'] = 'あり';
                }else{
                    $result[$key]['experience'] = 'なし';
                }

                if(isset($masterData['media'][$value['media']])){
                    $result[$key]['media'] = $masterData['media'][$value['media']];
                }else{
                    $result[$key]['media'] = "";
                }

                if(isset($masterData['interview_result'][$value['interview_result']])){
                    $result[$key]['interview_result'] = $masterData['interview_result'][$value['interview_result']];
                }else{
                    $result[$key]['interview_result'] = "";
                }
//                if(isset($setting_data['interview_result'][$value['interview_result']])){
//                    $result[$key]['interview_result'] = $setting_data['interview_result'][$value['interview_result']];
//                }else{
//                    $result[$key]['interview_result'] = "";
//                }

                if(isset($masterData['contact'][$value['contact']])){
                    $result[$key]['contact'] = $masterData['contact'][$value['contact']];
                }else{
                    $result[$key]['contact'] = "";
                }

            }
        }

        $param = strstr($_SERVER["REQUEST_URI"], '?');

        $this->set_safe( "result", $result );
        $this->set_safe( "setData", $setData );
        $this->set_safe( "param", $param );

    }







    // 検索した内容を表示する為のデータ形成
    public function set_data($search = null)
    {

        $tracking_date = date("Y-m-d");

        $setting_data = Config::get('setting', array());
        $masterData = Inputdata::get_select_data($setting_data);

//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($search);

        if(!empty($search)){

            // 申込日
            $search['submission_day'] =  $search['submission_year_from'] . '年' . $search['submission_month_from'] . '月' . $search['submission_day_from'] . '日 ～ ' . $search['submission_year_to'] . '年' . $search['submission_month_to'] . '月' . $search['submission_day_to'] . '日 迄';

            // 申込時間
            $search['submission_time'] =  $search['submission_hour_from'] . '時 ～ ' . $search['submission_hour_to'] . '時 迄';

            // 面接日
            $search['interview'] =  $search['interview_year_from'] . '年' . $search['interview_month_from'] . '月' . $search['interview_day_from'] . '日～' . $search['interview_year_to'] . '年' . $search['interview_month_to'] . '月' . $search['interview_day_to'] . '日 迄';

            // 面接店舗
            if(!empty($search['interviewshop_hidden'])){
                $interviewshopHiddenArray = explode(",", $search['interviewshop_hidden']);
                $search['interviewshop_hidden'] = '';
                foreach ($interviewshopHiddenArray as $key => $value) {
                    $search['interviewshop_hidden'] .= '・' . $masterData["interviewshop"][$value] . '<br />';
                }
            }

            // 所属店舗
            if(!empty($search['belonging_store_hidden'])){
                $belongingStoreHiddenArray = explode(",", $search['belonging_store_hidden']);
                $search['belonging_store_hidden'] = '';
                foreach ($belongingStoreHiddenArray as $key => $value) {
                    $search['belonging_store_hidden'] .= '・' . $masterData["belonging_store"][$value] . '<br />';
                }
            }

            //経験
            if(!empty($search['experience_hidden'])){
                $experienceHiddenArray = explode(",", $search['experience_hidden']);
                $search['experience_hidden'] = '';
                foreach ($experienceHiddenArray as $key => $value) {
                    $search['experience_hidden'] .= '・' . $masterData["experience"][$value] . '<br />';
                }
            }

            //都道府県
            if(!empty($search['pref_hidden'])){
                $prefHiddenArray = explode(",", $search['pref_hidden']);
                $search['pref_hidden'] = '';
                foreach ($prefHiddenArray as $key => $value) {
                    foreach ($setting_data["pref"] as $key2 => $value2) {
                        foreach ($value2 as $key3 => $value3) {
                            if($value == $key3) $search['pref_hidden'] .= '・' . $value3 . '<br />';
                        }
                    }
                }
            }

            //面接前確認
            if(!empty($search['check_hidden'])){
                $checkHiddenArray = explode(",", $search['check_hidden']);
                $search['check_hidden'] = '';
                foreach ($checkHiddenArray as $key => $value) {
                    $search['check_hidden'] .= '・' . $masterData["check"][$value] . '<br />';
                }
            }

            //身分証
            if(!empty($search['identity_card_select_hidden'])){
                $identityCardSelectHiddenArray = explode(",", $search['identity_card_select_hidden']);
                $search['identity_card_select_hidden'] = '';
                foreach ($identityCardSelectHiddenArray as $key => $value) {
                    $search['identity_card_select_hidden'] .= '・' . $masterData["person"][$value] . '<br />';
                }
            }

            // MAIL
            if($search['mail01'] AND $search['maildomain']){
                $search['mail'] = $search['mail01'] . '@' . $search['maildomain'];
            }

            //面接結果
            if(!empty($search['interview_result_hidden'])){
                $interviewResultHiddenArray = explode(",", $search['interview_result_hidden']);
                $search['interview_result_hidden'] = '';
                foreach ($interviewResultHiddenArray as $key => $value) {
                    $search['interview_result_hidden'] .= '・' . $masterData["interview_result"][$value] . '<br />';
                }
            }

            //面接担当
            if(!empty($search['interview_staff_hidden'])){
                $interviewStaffHiddenArray = explode(",", $search['interview_staff_hidden']);
                $search['interview_staff_hidden'] = '';
                foreach ($interviewStaffHiddenArray as $key => $value) {
                    $search['interview_staff_hidden'] .= '・' . $masterData["staff"][$value] . '<br />';
                }
            }

            //KS担当
            if(!empty($search['ks_staff_hidden'])){
                $ksStaffHiddenArray = explode(",", $search['ks_staff_hidden']);
                $search['ks_staff_hidden'] = '';
                foreach ($ksStaffHiddenArray as $key => $value) {
                    $search['ks_staff_hidden'] .= '・' . $masterData["staff"][$value] . '<br />';
                }
            }

            //勤務形態
            if(!empty($search['work_hidden'])){
                $workHiddenArray = explode(",", $search['work_hidden']);
                $search['work_hidden'] = '';
                foreach ($workHiddenArray as $key => $value) {
                    $search['work_hidden'] .= '・' . $setting_data["work"][$value] . '<br />';
                }
            }

            // 退店
            if($search['leaving_check']){
                $search['leaving_check'] = "●";
            }else{
                $search['leaving_check'] = "";
            }

            // 退店日
            $search['leaving_day'] =  $search['leaving_year_from'] . '年' . $search['leaving_month_from'] . '月' . $search['leaving_day_from'] . '日 ～ ' . $search['leaving_year_to'] . '年' . $search['leaving_month_to'] . '月' . $search['leaving_day_to'] . '日迄';

            // 退店理由
            if(!empty($search['leaving_reason_hidden'])){
                $leavingReasonHiddenArray = explode(",", $search['leaving_reason_hidden']);
                $search['leaving_reason_hidden'] = '';
                foreach ($leavingReasonHiddenArray as $key => $value) {
                    $search['leaving_reason_hidden'] .= '・' . $masterData["leaving_reason"][$value] . '<br />';
                }
            }

            // 掲載媒体
            if(!empty($search['publicity_hidden'])){
                $publicityHiddenArray = explode(",", $search['publicity_hidden']);
                $search['publicity_hidden'] = '';
                foreach ($publicityHiddenArray as $key => $value) {
                    $search['publicity_hidden'] .= '・' . $masterData["publicity"][$value] . '<br />';
                }
            }

            // 掲載エリア
            if(!empty($search['area_hidden'])){
                $areaHiddenArray = explode(",", $search['area_hidden']);
                $search['area_hidden'] = '';
                foreach ($areaHiddenArray as $key => $value) {
                    $search['area_hidden'] .= '・' . $masterData["area"][$value] . '<br />';
                }
            }

            // 掲載求人
            if(!empty($search['media_hidden'])){
                $mediaHiddenArray = explode(",", $search['media_hidden']);
                $search['media_hidden'] = '';
                foreach ($mediaHiddenArray as $key => $value) {
                    $search['media_hidden'] .= '・' . $masterData["media"][$value] . '<br />';
                }
            }

            // 掲載業種
            if(!empty($search['genre_hidden'])){
                $genreHiddenArray = explode(",", $search['genre_hidden']);
                $search['genre_hidden'] = '';
                foreach ($genreHiddenArray as $key => $value) {
                    $search['genre_hidden'] .= '・' . $masterData["genre"][$value] . '<br />';
                }
            }

            // SC
            if(!empty($search['scout_hidden'])){
                $scoutHiddenArray = explode(",", $search['scout_hidden']);
                $search['scout_hidden'] = '';
                foreach ($scoutHiddenArray as $key => $value) {
                    $search['scout_hidden'] .= '・' . $value . '<br />';
                }
            }

            //出戻り・移籍・紹介
            if(!empty($search['move_hidden'])){
                $moveHiddenArray = explode(",", $search['move_hidden']);
                $search['move_hidden'] = '';
                foreach ($moveHiddenArray as $key => $value) {
                    $search['move_hidden'] .= '・' . $masterData["move"][$value] . '<br />';
                }
            }

            //他店紹介
            if(!empty($search['another_shop_hidden'])){
                $anotherShopHiddenArray = explode(",", $search['another_shop_hidden']);
                $search['another_shop_hidden'] = '';
                foreach ($anotherShopHiddenArray as $key => $value) {
                    $search['another_shop_hidden'] .= '・' . $masterData["another_shop"][$value] . '<br />';
                }
            }

            //検索ワード
            if(!empty($search['word_hidden'])){
                $wordHiddenArray = explode(",", $search['word_hidden']);
                $search['word_hidden'] = '';
                foreach ($wordHiddenArray as $key => $value) {
                    $search['word_hidden'] .= '・' . $masterData["word"][$value] . '<br />';
                }
            }

            // 出稼ぎ
            if($search['working_away_flg']){
                $search['working_away_flg'] = "●";
            }else{
                $search['working_away_flg'] = "";
            }

            // ニコイチ
            if($search['nikoiti_flg']){
                $search['nikoiti_flg'] = "●";
            }else{
                $search['nikoiti_flg'] = "";
            }

            // オファーメールからの申し込み
            if($search['scout_mail_flg']){
                $search['scout_mail_flg'] = "●";
            }else{
                $search['scout_mail_flg'] = "";
            }

            // 店舗スタッフ
            if($search['staff_flg']){
                $search['staff_flg'] = "●";
            }else{
                $search['staff_flg'] = "";
            }

        }

        return $search;
    }




}
