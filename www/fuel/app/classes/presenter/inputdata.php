<?php
use \Model\Inputdata;
use \Model\Common;
use \Model\Staffgroup;
use \Model\Master;
/**
 * The welcome hello presenter.
 *
 * @package  app
 * @extends  Presenter
 */
class Presenter_Inputdata extends Presenter
{

    /**
     * Prepare the view data, keeping this in here helps clean up
     * the controller.
     *
     * @return void
     */
    public function view()
    {
        $this->title = "データ入力";

        $setting_data = Config::get('setting', array());
        $masterData = Inputdata::get_select_data($setting_data);
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($setting_data);
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($masterData);


        //編集中の人
        $editing = "";
        //編集権
        $authority = 0;

        $tracking_remarks_data[] = array(
            'scheduled_date' => '',
            'responsible' => '',
            'passage' => '',
        );

        $other_means_data[] = array('means' => '');

        // 既にあるデータを変更の場合
        if (Request::active()->param('id')) {
            $data_id = Request::active()->param('id');

            $result = Inputdata::get_rowdata($data_id);

            $sql = "SELECT scheduled_date, responsible, passage FROM tracking_remarks WHERE interview_id = $data_id";
            $tracking_remarks_data = Common::get_data($sql);
            foreach ($tracking_remarks_data as $key => $value) {
                if(!empty($value["scheduled_date"])) list($tracking_remarks_data[$key]["scheduled_date_year"], $tracking_remarks_data[$key]["scheduled_date_month"], $tracking_remarks_data[$key]["scheduled_date_day"]) = explode("-", $value["scheduled_date"]);
            }
            //追跡備考は入力分＋１つ
            $tracking_remarks_data[] = array(
                'scheduled_date' => '',
                'responsible' => '',
                'passage' => '',
            );


            $sql = "SELECT means FROM other_means WHERE interview_id = $data_id";
            $other_means_data = Common::get_data($sql);
//            foreach ($other_means_data as $key => $value) {
//                if(!empty($value["means"])) list($tracking_remarks_data[$key]["scheduled_date_year"], $tracking_remarks_data[$key]["scheduled_date_month"], $tracking_remarks_data[$key]["scheduled_date_day"]) = explode("-", $value["scheduled_date"]);
//            }
            //他のやりとり手段は入力分＋１つ
            $other_means_data[] = array('means' => '');


            if (!$result) {
                Response::redirect("/inputdata/data/");
            }

            $user_id = Auth::get_user_id();
//            $date = time();

            $sql = "SELECT id, user_id FROM editlist WHERE data_id = $data_id LIMIT 1";
            $user_data = Common::get_data($sql);

            if (!empty($user_data)) {
                if (isset($masterData["staff"][$user_data[0]["user_id"]])) {
                    $editing = $masterData["staff"][$user_data[0]["user_id"]];
                } else {
                    $editing = "";
                }

                if ($user_id[1] != $user_data[0]["user_id"]) {
                    $authority = 1;
                }

                $this->set_safe("editingId", $user_data[0]["user_id"]);
            }



//            if (empty($user_data)) {
//                $insertArray = array(
//                    "user_id" => $user_id[1],
//                    "data_id" => $data_id,
//                    "updated_at" => $date
//                );
//
//                Common::set_data($insertArray, null, 'editlist');
//            } else {
//                if (isset($masterData["staff"][$user_data[0]["user_id"]])) {
//                    $editing = $masterData["staff"][$user_data[0]["user_id"]];
//                } else {
//                    $editing = "";
//                }
//
//                if ($user_id[1] != $user_data[0]["user_id"]) {
//                    $authority = 1;
//                }
//
//                $this->set_safe("editingId", $user_data[0]["user_id"]);
//            }



        }

//        $fieldset = Fieldsetplus::forge();
        $fieldset = Fieldsetplus::forge('input_data_action');

        // ★
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ){
            $fieldset->add('submission_date', '申込日時', array('class' => 'reqSelect reqSelect1 atleast date_time'));
//        }
//        $fieldset->add('submission_year', '申込日(年)', array(
//            'options' => $setting_data["year"],
//            'type' => 'select',
//            'value' => '',
//            'class' => 'reqSelect reqSelect4 atleast'
//        ));
//        $fieldset->add('submission_month', '申込日(月)', array(
//            'options' => $setting_data["month"],
//            'type' => 'select',
//            'value' => '',
//            'class' => 'reqSelect2 reqSelect5 atleast'
//        ));
//        $fieldset->add('submission_day', '申込日(日)', array(
//            'options' => $setting_data["day"],
//            'type' => 'select',
//            'value' => '',
//            'class' => 'reqSelect3 reqSelect6 atleast'
//        ));
//        $fieldset->add('submission_hour', '申込時間(時)',
//            array('options' => $setting_data["hour"], 'type' => 'select', 'value' => '', 'class' => 'atleast'));
//        $fieldset->add('submission_time', '申込時間(分)',
//            array('options' => $setting_data["Minutes"], 'type' => 'select', 'value' => '', 'class' => 'atleast'));

        $fieldset->add('apply', '申し込み方法',
            array('options' => $setting_data["apply"], 'type' => 'select', 'value' => '', 'class' => 'input_req input_req2 atleast'))->add_rule('required');

        $fieldset->add('submission_name', '申込名', array('class' => 'input_req3 atleast'));



        //求人センターグループの時

        // ★
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ){
            $fieldset->add('interview_date', '面接予定日時', array('class' => 'reqSelect reqSelect1 atleast date_time'));
//        }
//        $fieldset->add('interview_year', '面接予定日(年)',
//                array('options' => $setting_data["year"], 'type' => 'select', 'value' => '', 'class' => 'reqSelect7 atleast'));
//        $fieldset->add('interview_month', '面接予定日(月)',
//                array('options' => $setting_data["month"], 'type' => 'select', 'value' => '', 'class' => 'reqSelect8 atleast'));
//        $fieldset->add('interview_day', '面接予定日(日)',
//                array('options' => $setting_data["day"], 'type' => 'select', 'value' => '', 'class' => 'reqSelect9 atleast'));

        //20220704 非表示 hidden に変更
//        //店舗グループの時
//        if($this->userData["group"] == 2){
//            $fieldset->add('interview_year_shopuser', '面接予定日(年)',
//                array('options' => $setting_data["year"], 'type' => 'select', 'value' => '', 'class' => 'reqSelect7 atleast'));
//
//            $fieldset->add('interview_month_shopuser', '面接予定日(月)',
//                array('options' => $setting_data["month"], 'type' => 'select', 'value' => '', 'class' => 'reqSelect8 atleast'));
//
//            $fieldset->add('interview_day_shopuser', '面接予定日(日)',
//                array('options' => $setting_data["day"], 'type' => 'select', 'value' => '', 'class' => 'reqSelect9 atleast'));
//        }


//        $fieldset->add('interview_hour', '面接予定日時間(時)',
//            array('options' => $setting_data["hour"], 'type' => 'select', 'value' => '', 'class' => 'reqSelect10 atleast'));
//        $fieldset->add('interview_time', '面接予定日時間(分)',
//            array('options' => $setting_data["interview_time_minutes"], 'type' => 'select', 'value' => '', 'class' => 'reqSelect11 atleast'));

        $fieldset->add("tentative_reserve_flg", '',
            array('type' => 'checkbox', 'class' => 'checkbox-sqar', 'value' => '1'));

        $fieldset->add('contact', '連絡方法',
            array('options' => $masterData["contact"], 'type' => 'select', 'value' => '', 'class' => 'atleast'));

        $fieldset->add('check', '面接前確認', array('options' => $masterData["check"], 'type' => 'select', 'value' => '', 'class' => 'atleast'));

        $fieldset->add("timer_flg", '', array('type' => 'checkbox', 'class' => 'checkbox-sqar', 'value' => '1'));

        $fieldset->add('timer', '面接時間', array(
            'class' => 'input_req input_req4 atleast',
            'pattern' => '^[0-9%-]+$',
            'title' => '半角数字でご入力ください。',
            'name' => '面接時間',
            'size' => '4',
            'maxlength' => 3
        ));

        $fieldset->add("contact_flg", '', array('type' => 'checkbox', 'class' => 'checkbox-sqar', 'value' => '1'));

        // ★
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ){
            $fieldset->add('advance_contact_date', '事前連絡日', array('class' => 'date_time2'));
//        }
//        $fieldset->add('advance_contact_date_year', '事前連絡日(年)',
//            array('options' => $setting_data["year"], 'type' => 'select', 'value' => ''));
//        $fieldset->add('advance_contact_date_month', '事前連絡日(月)',
//            array('options' => $setting_data["month"], 'type' => 'select', 'value' => ''));
//        $fieldset->add('advance_contact_date_day', '事前連絡日(日)',
//            array('options' => $setting_data["day"], 'type' => 'select', 'value' => ''));

        $fieldset->add("staff_flg", '', array('type' => 'checkbox', 'class' => 'checkbox-sqar', 'value' => '1'));

        $fieldset->add('interviewshop', '面接店舗',
            array('options' => $masterData["interviewshop"], 'type' => 'select', 'value' => '', 'class' => 'atleast'));

        $fieldset->add('place', '待ち合わせ場所', array('options' => $masterData["place"], 'type' => 'select', 'value' => '', 'class' => 'atleast'));

        $fieldset->add('place_remarks', '待ち合わせ備考', array('size' => '25'));

        $fieldset->add('area', '掲載エリア', array('options' => $masterData["area"], 'type' => 'select', 'value' => '', 'class' => 'keiarea atleast'));

        $fieldset->add('publicity', '掲載媒体',
            array('options' => $masterData["publicity"], 'type' => 'select', 'value' => '', 'class' => 'baitai atleast', 'id' => 'changeSelect2', 'onchange' => 'publicityChange();'));

        $fieldset->add('media', '掲載求人', array('options' => $masterData["media"], 'type' => 'select', 'value' => '', 'class' => 'keikyu atleast', 'id' => 'changeSelect', 'onchange' => 'mediaChange();'));

        $fieldset->add('genre', '掲載業種', array('options' => $masterData["genre"], 'type' => 'select', 'value' => '', 'class' => 'keigyo'));

        $fieldset->add('scout', 'SC', array('options' => $setting_data["scout"], 'type' => 'select', 'value' => '', 'class' => 'scout'));

        $fieldset->add('move', '出戻・移籍 etc', array('options' => $masterData["move"], 'type' => 'select', 'value' => '', 'class' => 'demodori'));

        $fieldset->add("confirm_introduction", '', array('type' => 'checkbox', 'class' => 'checkbox-sqar', 'value' => '1'));

        $fieldset->add('tel01', 'TEL',
            array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'tel01', 'size' => '5', 'maxlength' => 4, 'class' => 'atleast'))
            ->add_rule('max_length', 4);

        $fieldset->add('tel02', 'TEL',
            array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'tel02', 'size' => '5', 'maxlength' => 4, 'class' => 'atleast'))
            ->add_rule('max_length', 4);

        $fieldset->add('tel03', 'TEL',
            array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'tel03', 'size' => '5', 'maxlength' => 4, 'class' => 'atleast'))
            ->add_rule('max_length', 4);

        $fieldset->add('mail01', 'Mail',
            array('pattern' => '^[a-z0-9._%+-]+$', 'title' => 'メールアドレスに入力可能な文字をご入力ください。', 'name' => 'mail01', 'size' => '18', 'class' => 'atleast'));

        $fieldset->add('maildomain', 'メールドメイン',
            array('options' => $masterData["maildomain"], 'type' => 'select', 'value' => '', 'class' => 'atleast'));

        $fieldset->add('age', '年齢',
            array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'age', 'size' => '5', 'maxlength' => 2, 'class' => 'atleast'))
            ->add_rule('max_length', 3);

//        $fieldset -> add('experience', '経験', array('options' => $masterData["experience"], 'type' => 'select', 'value' => ''));


        $experience_select = '';
        foreach ($masterData["experience"] as $key => $value) {
            if ($key != "") {
                $experience_select .= "<option value=\"{$key}\">{$value}</option>";
            }
        }

        $fieldset->add('experience_remarks', '経験備考', array('name' => 'experience_remarks', 'size' => '25'));

        $fieldset->add('tall', '身長',
            array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'tall', 'class' => 'tall tall_set_1', 'data-id' => '1', 'size' => '4', 'maxlength' => 3))
            ->add_rule('max_length', 3);

        $fieldset->add('weight', '体重',
            array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'weight', 'class' => 'weight weight_set_1', 'data-id' => '1', 'size' => '4', 'maxlength' => 3))
            ->add_rule('max_length', 3);

        $fieldset->add('bmi', 'BMI',
            array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'bmi', 'class' => 'bmi_1', 'size' => '4', 'maxlength' => 3))
            ->add_rule('max_length', 3);

        $fieldset->add('bust', 'バスト',
            array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'bust', 'size' => '4', 'maxlength' => 3))
            ->add_rule('max_length', 3);

        $fieldset->add('cup', 'カップ数', array('options' => $setting_data["cup_data"], 'type' => 'select', 'value' => ''));

        $fieldset->add('waist', 'ウエスト',
            array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'waist', 'size' => '4', 'maxlength' => 3))
            ->add_rule('max_length', 3);

        $fieldset->add('hip', 'ヒップ',
            array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'hip', 'size' => '4', 'maxlength' => 3))
            ->add_rule('max_length', 3);

        $fieldset->add("hope_back_flg", '', array('type' => 'checkbox', 'class' => 'checkbox-sqar checkbox-check hope_back_flg_1', 'id' => 'form_hope_back_flg', 'value' => '1'));

        $fieldset->add('hope_back_price', '希望バック',
            array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'hip', 'size' => '4', 'maxlength' => 5, 'class' => 'hope_back_flg_1', ));

        $fieldset->add("warranty_flg", '', array('type' => 'checkbox', 'class' => 'checkbox-sqar checkbox-check warranty_flg_1', 'id' => 'form_warranty_flg','value' => '1'));

        $fieldset->add('warranty_time', '希望保証(時間)',
            array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'hip', 'size' => '2', 'maxlength' => 2, 'class' => 'warranty_flg_1'));

        $fieldset->add('warranty_price', '希望保証(円)',
            array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'hip', 'size' => '4', 'maxlength' => 6, 'class' => 'warranty_flg_1'));

        $fieldset->add("celebration_flg", '', array('type' => 'checkbox', 'class' => 'checkbox-sqar checkbox-check celebration_flg_1', 'id' => 'form_celebration_flg','value' => '1'));

        $fieldset->add('celebration_time', '入店祝い金(時間)',
            array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'hip', 'size' => '2'));

        $fieldset->add('celebration_price', '入店祝い金(円)',
            array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'hip', 'size' => '4', 'maxlength' => 6, 'class' => 'celebration_flg_1'));

//        $fieldset->add("pick_up_flg", '', array('type' => 'checkbox', 'class' => 'checkbox-sqar', 'value' => '1'));
        //↓送迎を[送り、迎え]に分割
        $fieldset->add("send_to_home_flg", '', array('type' => 'checkbox', 'class' => 'checkbox-sqar checkbox-check', 'id' => 'form_send_to_home_flg','value' => '1'));
        $fieldset->add("send_to_shop_flg", '', array('type' => 'checkbox', 'class' => 'checkbox-sqar checkbox-check', 'id' => 'form_send_to_shop_flg', 'value' => '1'));

        //
        $fieldset->add("advance_salary_flg", '', array('type' => 'checkbox', 'class' => 'checkbox-sqar checkbox-check', 'id' => 'form_advance_salary_flg','value' => '1'));
        $fieldset->add("menses_flg", '', array('type' => 'checkbox', 'class' => 'checkbox-sqar checkbox-check', 'id' => 'form_menses_flg', 'value' => '1'));
        $fieldset->add("transportation_expenses_flg", '', array('type' => 'checkbox', 'class' => 'checkbox-sqar checkbox-check', 'id' => 'form_transportation_expenses_flg','value' => '1'));


        $fieldset->add("dorm_flg", '', array('type' => 'checkbox', 'class' => 'checkbox-sqar checkbox-check', 'id' => 'form_dorm_flg','value' => '1'));

        $fieldset->add("tatoo_flg", '', array('type' => 'checkbox', 'class' => 'checkbox-sqar checkbox-check', 'id' => 'form_tatoo_flg','value' => '1'));

        $fieldset->add("nursery_flg", '', array('type' => 'checkbox', 'class' => 'checkbox-sqar checkbox-check', 'id' => 'form_nursery_flg', 'value' => '1'));

        $fieldset->add("identity_card_flg", '',
            array('type' => 'checkbox', 'class' => 'checkbox-sqar', 'value' => '1'));

        $fieldset->add("experience_possible_flg", '',
            array('type' => 'checkbox', 'class' => 'checkbox-sqar atleast', 'value' => '1'));

        $fieldset->add("without_prior_flg", '',
            array('type' => 'checkbox', 'class' => 'checkbox-sqar checkbox-check', 'id' => 'form_without_prior_flg', 'value' => '1'));

        $fieldset->add("single_room_wait_flg", '',
            array('type' => 'checkbox', 'class' => 'checkbox-sqar checkbox-check', 'id' => 'form_single_room_wait_flg','value' => '1'));

        $fieldset->add("residence_flg", '', array('type' => 'checkbox', 'class' => 'checkbox-sqar atleast', 'value' => '1'));

        $fieldset->add("confirmed_flg", '', array('type' => 'checkbox', 'class' => 'checkbox-sqar', 'value' => '1'));

        $fieldset->add("same_person_flg", '', array('type' => 'checkbox', 'class' => 'checkbox-sqar checkbox-check', 'id' => 'form_same_person_flg', 'value' => '1'));


        $setting_data_select = '';
        foreach ($setting_data["hope_workplace"] as $key => $value) {
            if ($key != "") {
                $setting_data_select .= "<option value=\"{$key}\">{$value}</option>";
            }

        }
//        $fieldset->add('hope_workplace', '希望勤務地', array('name' => 'hip', 'size' => '20', 'class' => 'atleast'));

        $fieldset->add("introduction_listening_flg", '', array('type' => 'checkbox', 'class' => 'checkbox-sqar', 'value' => '1'));

        $fieldset->add("other_flg", '', array('type' => 'checkbox', 'class' => 'checkbox-sqar checkbox-check other_flg_1', 'id' => 'form_other_flg','value' => '1'));

        $fieldset->add("nikoiti_flg", '', array('type' => 'checkbox', 'class' => 'checkbox-sqar checkbox-check nikoiti_flg_1', 'id' => 'form_nikoiti_flg','value' => '1'));

        $fieldset->add('nikoiti', 'ニコイチ', array('name' => 'nikoiti', 'size' => '30', 'class' => 'nikoiti_flg_1'));

        $fieldset->add("working_away_flg", '', array('type' => 'checkbox', 'class' => 'checkbox-sqar checkbox-check working_away_flg_1', 'id' => 'form_working_away_flg','value' => '1'));

//        $fieldset->add('days_to_work_num', '出稼ぎ日数', array('options' => $setting_data["day_year"], 'type' => 'select', 'value' => ''));
        $fieldset->add('days_to_work_num', '出稼ぎ日数',
            array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'hip', 'size' => '4', 'maxlength' => 3, 'class' => 'working_away_flg_1' ));

        //勤務地候補
        foreach($setting_data["work_location"] as $key => $work_location) {
            $fieldset->add("work_location[{$key}]", '', array('type' => 'checkbox', 'class' => 'checkbox-sqar', 'value' => '1'));
        }

        $ops = array(1 => "オファーメールからの申し込み", 0 => "それ以外");
//        $fieldset -> add('scout_mail_flg', '',
//            array(
//                'options'	=> $ops,
//                'type'		=> 'radio',
//                'value'		=> '',
//            )
//        );
        $fieldset->add('scout_mail_flg', '', array('options' => $ops, 'type' => 'select', 'value' => ''));

        $fieldset->add("working_day_undecided_flg", '',
            array('type' => 'checkbox', 'class' => 'checkbox-sqar', 'value' => '1'));

        $fieldset->add("stop_tracking_flg", '',
            array('type' => 'checkbox', 'class' => 'checkbox-sqar', 'value' => '2'));


        $fieldset->add('identity_card', '身分証', array('name' => 'identity_card', 'size' => '20'));

        $fieldset->add('residence', '居住地', array('name' => 'residence', 'size' => '8', 'class' => 'atleast'));

//        $fieldset->add('other', 'その他', array('name' => 'other', 'size' => '40'));

        $fieldset->add('belonging_store', '所属店舗',
            array('options' => $masterData["belonging_store"], 'type' => 'select', 'value' => ''));

        $fieldset->add('genji_name', '源氏名', array('name' => 'other', 'size' => '20'));

        $fieldset->add('genji_namekana', '源氏名(ふりがな)', array('name' => 'other', 'size' => '20'));


        // ★
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ){
            $fieldset->add('leaving_date', '退店日', array('class' => 'date_time2'));
//        }
//        $fieldset->add('leaving_year', '退店日(年)',
//            array('options' => $setting_data["year"], 'type' => 'select', 'value' => '', 'class' => ''));
//        $fieldset->add('leaving_month', '退店日(月)',
//            array('options' => $setting_data["month"], 'type' => 'select', 'value' => '', 'class' => ''));
//        $fieldset->add('leaving_day', '退店日(日)',
//            array('options' => $setting_data["day"], 'type' => 'select', 'value' => '', 'class' => ''));

//        $fieldset->add('leaving_reason', '退店理由',
//            array('options' => $setting_data["leaving_reason"], 'type' => 'select', 'value' => ''));
        $fieldset->add('leaving_reason', '面接結果', array('options' => $masterData["leaving_reason"], 'type' => 'select', 'value' => ''));

        $fieldset->add('surname', '姓', array('name' => 'other', 'size' => '16'));

        $fieldset->add('name', '名', array('name' => 'other', 'size' => '16'));

        $fieldset->add('surnamekana', '姓（ふりがな）', array('name' => 'other', 'size' => '16', 'pattern' => '^[ぁ-んー]+$'));

        $fieldset->add('namekana', '名（ふりがな）', array('name' => 'other', 'size' => '16', 'pattern' => '^[ぁ-んー]+$'));



        $pref_select = "";
        $selected = "";
        foreach ($setting_data["pref"] as $key => $value) {
            $pref_select .= <<<EOD
            <optgroup label="{$key}">
EOD;

            foreach ($value as $key2 => $value2) {
                if (isset($result[0]["pref"]) AND $result[0]["pref"] == $key2) {
                    $selected = "selected";
                }

                $pref_select .= <<<EOD
                <option value="{$key2}" $selected>{$value2}</option>
EOD;
                $selected = "";
            }
            $pref_select .= <<<EOD
            </optgroup>
EOD;
        }

        $fieldset->add('address', '住所', array('name' => 'other', 'size' => '60'));

//        $fieldset->add('interview_result', '面接結果',
//            array('options' => $setting_data["interview_result"], 'type' => 'select', 'value' => ''));
        $fieldset->add('interview_result', '面接結果', array('options' => $masterData["interview_result"], 'type' => 'select', 'value' => ''));


//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($result[0]);

            // 面接担当
        if (isset($result[0]["interview_staff"])){
            // 非表示スタッフ
            if (isset($masterData["staff_hidden"][$result[0]["interview_staff"]])) {
                $interview_staff_select = "<option value=\"{$result[0]["interview_staff"]}\" selected>【非】{$masterData["staff_hidden"][$result[0]["interview_staff"]]}</option>";
                $interview_staff_select .= "<option value=\"\">—</option>";
                foreach ($masterData["staff_print"] as $key => $value) {
                    if ($key != "") {
                        $interview_staff_select .= "<option value=\"{$key}\">{$value}</option>";
                    }
                }
            // 表示スタッフ
            }else{
                $interview_staff_select = "<option value=\"\">—</option>";
                foreach ($masterData["staff_print"] as $key => $value) {
                    if ($key != "") {
                        if ($result[0]["interview_staff"] == $key) {
                            $selected = "selected";
                        }else{
                            $selected = "";
                        }
                        $interview_staff_select .= "<option value=\"{$key}\" $selected>{$value}</option>";
                    }
                }
            }
        // 新規用
        }else{
            $interview_staff_select = "<option value=\"\">—</option>";
            foreach ($masterData["staff_print"] as $key => $value) {
                if ($key != "") {
                    $interview_staff_select .= "<option value=\"{$key}\">{$value}</option>";
                }
            }
        }

        // 面接担当（サブ）
        if (isset($result[0]["interview_staff_sub"])){
            // 非表示スタッフ
            if (isset($masterData["staff_hidden"][$result[0]["interview_staff_sub"]])) {
                $interview_staff_sub_select = "<option value=\"{$result[0]["interview_staff_sub"]}\" selected>【非】{$masterData["staff_hidden"][$result[0]["interview_staff_sub"]]}</option>";
                $interview_staff_sub_select .= "<option value=\"\">—</option>";
                foreach ($masterData["staff_print"] as $key => $value) {
                    if ($key != "") {
                        $interview_staff_sub_select .= "<option value=\"{$key}\">{$value}</option>";
                    }
                }
                // 表示スタッフ
            }else{
                $interview_staff_sub_select = "<option value=\"\">—</option>";
                foreach ($masterData["staff_print"] as $key => $value) {
                    if ($key != "") {
                        if ($result[0]["interview_staff_sub"] == $key) {
                            $selected = "selected";
                        }else{
                            $selected = "";
                        }
                        $interview_staff_sub_select .= "<option value=\"{$key}\" $selected>{$value}</option>";
                    }
                }
            }
            // 新規用
        }else{
            $interview_staff_sub_select = "<option value=\"\">—</option>";
            foreach ($masterData["staff_print"] as $key => $value) {
                if ($key != "") {
                    $interview_staff_sub_select .= "<option value=\"{$key}\">{$value}</option>";
                }
            }
        }


        $fieldset->add('interview_staff', '面接担当',
            array('options' => $masterData["staff_print"], 'type' => 'select', 'value' => ''));

        $fieldset->add('interview_staff_sub', '面接担当（サブ）',
            array('options' => $masterData["staff_print"], 'type' => 'select', 'value' => ''));

        $fieldset->add('ks_staff', '面接担当（サブ）',
            array('options' => $masterData["staff_print"], 'type' => 'select', 'value' => ''));

        $fieldset->add('work', '勤務形態',
            array('options' => $masterData["work"], 'type' => 'select', 'value' => '', 'class' => ''));

        $person_select = '';

        foreach ($masterData["person"] as $key => $value) {
            if ($key != "") {
                $person_select .= "<option value=\"{$key}\">{$value}</option>";
            }

        }

        $fieldset->add('apply_identity_card_remark', '身分証備考', array('name' => 'other', 'size' => '30'));

        $fieldset->add('identity_card_remarks', '身分証備考', array('name' => 'other', 'size' => '24'));

        $fieldset->add('salary', '給料',
            array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'salary', 'size' => '8', 'maxlength' => 5));

        $fieldset->add('nomination_fee', '特別指名料',
            array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'nomination_fee', 'size' => '8', 'maxlength' => 5));

        $fieldset->add('another_shop', '他店紹介',
            array('options' => $masterData["another_shop"], 'type' => 'select', 'value' => ''));

        $fieldset->add('another_shop_remarks', '他店紹介備考', array('name' => 'other', 'size' => '36'));

        $fieldset->add('word1', '検索ワード',
            array('options' => $masterData["word"], 'type' => 'select', 'value' => '', 'style' => 'width:150px;'));

        $fieldset->add('word2', '検索ワード',
            array('options' => $masterData["word"], 'type' => 'select', 'value' => '', 'style' => 'width:150px;'));

        $fieldset->add('word3', '検索ワード',
            array('options' => $masterData["word"], 'type' => 'select', 'value' => '', 'style' => 'width:150px;'));

        $fieldset->add('word4', '検索ワード',
            array('options' => $masterData["word"], 'type' => 'select', 'value' => '', 'style' => 'width:150px;'));

        $fieldset->add('word5', '検索ワード',
            array('options' => $masterData["word"], 'type' => 'select', 'value' => '', 'style' => 'width:150px;'));

        $fieldset->add('word6', '検索ワード',
            array('options' => $masterData["word"], 'type' => 'select', 'value' => '', 'style' => 'width:150px;'));


        $fieldset->add('word_remarks', '検索ワード備考', array('name' => 'other', 'size' => '30'));

        $fieldset->add('remarks', '備考', array('type' => 'textarea', 'rows' => 10, 'class' => 'input_bikou'));

        // ★
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ){
            $fieldset->add('working_day_date', '初回出勤日', array('class' => 'date_time2'));
//        }
//        $fieldset->add('working_day_year', '初回出勤日(年)',
//            array('options' => $setting_data["year"], 'type' => 'select', 'value' => '', 'class' => ''));
//        $fieldset->add('working_day_month', '初回出勤日(月)',
//            array('options' => $setting_data["month"], 'type' => 'select', 'value' => '', 'class' => ''));
//        $fieldset->add('working_day_day', '初回出勤日(日)',
//            array('options' => $setting_data["day"], 'type' => 'select', 'value' => '', 'class' => ''));

        $fieldset->add('reason', '追跡理由', array('options' => $masterData["reason"], 'type' => 'select', 'value' => ''));

        $fieldset->add('confirmation_chk', '確認 / 判断', array('options' => $setting_data["confirmation_chk"], 'type' => 'select', 'class' => 'confirmation_chk confirmation_chk_1', 'data-id' => '1', 'value' => ''));

        $fieldset->add("confirmation_chk_1", '', array('type' => 'checkbox', 'class' => 'confirmation-chk', 'data-id' => '1', 'value' => '1'));
        $fieldset->add("confirmation_chk_2", '', array('type' => 'checkbox', 'class' => 'confirmation-chk', 'data-id' => '2', 'value' => '1'));
        $fieldset->add("confirmation_chk_3", '', array('type' => 'checkbox', 'class' => 'confirmation-chk', 'data-id' => '3', 'value' => '1'));
        $fieldset->add("confirmation_chk_4", '', array('type' => 'checkbox', 'class' => 'confirmation-chk', 'data-id' => '4', 'value' => '1'));

        // ★
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ){
            $fieldset->add('scheduled_date', '追跡予定日時', array('class' => 'reqSelect reqSelect1 date_time2'));
//        }
//        $fieldset->add('scheduled_date_year', '追跡予定日(年)',
//            array('options' => $setting_data["year"], 'type' => 'select', 'value' => '', 'class' => ''));
//        $fieldset->add('scheduled_date_month', '追跡予定日(月)',
//            array('options' => $setting_data["month"], 'type' => 'select', 'value' => '', 'class' => ''));
//        $fieldset->add('scheduled_date_day', '追跡予定日(日)',
//            array('options' => $setting_data["day"], 'type' => 'select', 'value' => '', 'class' => ''));
        $fieldset->add('scheduled_date_hour', '追跡予定日(時)',
            array('options' => $setting_data["hour"], 'type' => 'select', 'value' => '', 'class' => ''));

        // ★
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ){
//            $fieldset->add('scheduled_date_remarks', '追跡予定日時備考', array('class' => 'date_time2'));
//        }

        $fieldset->add('scheduled_date_remarks_year1', '追跡予定日備考(年)',
            array('options' => $setting_data["year"], 'type' => 'select', 'value' => '', 'class' => ''));

        $fieldset->add('scheduled_date_remarks_month1', '追跡予定日備考(月)',
            array('options' => $setting_data["month"], 'type' => 'select', 'value' => '', 'class' => ''));

        $fieldset->add('scheduled_date_remarks_day1', '追跡予定日備考(日)',
            array('options' => $setting_data["day"], 'type' => 'select', 'value' => '', 'class' => ''));

        $fieldset->add('responsible1', '担当', array('name' => 'other', 'size' => '10'));

        $fieldset->add('passage1', '経過', array('name' => 'other', 'size' => '35'));



        if (isset($result)) {

            $default = array_shift($result);
            $work_locations  = $result['work_location'];
//            if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ){
//                print_r($default);
//            }

            if (isset($default["staff_id"])) {
                $staff_data = Common::get_data("SELECT username, `group`, email, profile_fields FROM login_users WHERE id = $default[staff_id]");

                $staff_data = array_shift($staff_data);

                $staff_data["profile_fields"] = unserialize($staff_data["profile_fields"]);

                if (!empty($staff_data["profile_fields"]["name"])) {
                    $staff_name = $staff_data["profile_fields"]["name"];
                }
            }

//            if(isset($masterData["publicity"][$default["publicity"]])){
            if(isset($masterData["media"][$default["media"]])){
//                $default["tab_name"] = $masterData["publicity"][$default["publicity"]];
                if(!empty($masterData["media"][$default["media"]])) {
                    $default["tab_name"] = $masterData["media"][$default["media"]];
                } else {
                    $default["tab_name"] = "";
                }
            }

            if($default["confirm_introduction"] == 0) $default["confirm_introduction"] = 0;

            if($default["age"] == 0)    $default["age"] = '';
            if($default["tall"] == 0)   $default["tall"] = '';
            if($default["weight"] == 0) $default["weight"] = '';
            if($default["bmi"] == 0) $default["bmi"] = '';
            if($default["bust"] == 0)   $default["bust"] = '';
            if($default["waist"] == 0)  $default["waist"] = '';
            if($default["hip"] == 0)    $default["hip"] = '';
            if($default["hope_back_price"] == 0)   $default["hope_back_price"] = '';
            if($default["warranty_time"] == 0)     $default["warranty_time"] = '';
            if($default["warranty_price"] == 0)    $default["warranty_price"] = '';
            if($default["celebration_price"] == 0) $default["celebration_price"] = '';
            if($default["salary"] == 0) $default["salary"] = '';
            if($default["nomination_fee"] == 0)    $default["nomination_fee"] = '';


//            $submission_date = explode('-', $default["submission_date"]);
//            $default["submission_year"] = $submission_date[0];
//            $default["submission_month"] = $submission_date[1];
//            $default["submission_day"] = $submission_date[2];
//
//            $interview_date = explode('-', $default["interview_date"]);
//            $default["interview_year"] = $interview_date[0];
//            $default["interview_month"] = $interview_date[1];
//            $default["interview_day"] = $interview_date[2];

//            if($this->userData["group"] == 2){
//                $interview_date = explode('-', $default["interview_date"]);
//                $default["interview_year_shopuser"] = $interview_date[0];
//                $default["interview_month_shopuser"] = $interview_date[1];
//                $default["interview_day_shopuser"] = $interview_date[2];
//            }

//            $advance_contact_date = explode('-', $default["advance_contact_date"]);
//            $default["advance_contact_date_year"] = $advance_contact_date[0];
//            $default["advance_contact_date_month"] = $advance_contact_date[1];
//            $default["advance_contact_date_day"] = $advance_contact_date[2];

//            $tel = explode('-', $default["tel"]);
//            $default["tel01"] = $tel[0];
//            $default["tel02"] = $tel[1];
//            $default["tel03"] = $tel[2];
            $default["tel01"] = $default["tel01"];
            $default["tel02"] = $default["tel02"];
            $default["tel03"] = $default["tel03"];

//            $leaving_date = explode('-', $default["leaving_date"]);
//            $default["leaving_year"] = $leaving_date[0];
//            $default["leaving_month"] = $leaving_date[1];
//            $default["leaving_day"] = $leaving_date[2];

//            $working_day_date = explode('-', $default["working_day_date"]);
//            $default["working_day_year"] = $working_day_date[0];
//            $default["working_day_month"] = $working_day_date[1];
//            $default["working_day_day"] = $working_day_date[2];

//            $scheduled_date = explode('-', $default["scheduled_date"]);
//            $default["scheduled_date_year"] = $scheduled_date[0];
//            $default["scheduled_date_month"] = $scheduled_date[1];
//            $default["scheduled_date_day"] = $scheduled_date[2];

            // ★
//            if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ){
                $default["submission_date"] = $default["submission_date"] . ' ' . sprintf("%02d", $default["submission_hour"]) . ':' . sprintf("%02d", $default["submission_time"]);

                if($default["interview_date"] == '0000-00-00'){
                    $default["interview_date"] = '';
                }else{
                    $default["interview_date"] = $default["interview_date"] . ' ' . sprintf("%02d", $default["interview_hour"]) . ':' . sprintf("%02d", $default["interview_time"]);
                }

                if($default["scheduled_date"] == '0000-00-00'){
                    $default["scheduled_date"] = '';
                }else{
                    $default["scheduled_date"] = $default["scheduled_date"];
                }
                
                if(isset($default["scheduled_date_hour"])) $default["scheduled_date_hour"] = sprintf("%02d", $default["scheduled_date_hour"]);

                if($default["advance_contact_date"] == '0000-00-00'){
                    $default["advance_contact_date"] = '';
                }else{
                    $default["advance_contact_date"] = $default["advance_contact_date"];
                }

                if($default["leaving_date"] == '0000-00-00'){
                    $default["leaving_date"] = '';
                }else{
                    $default["leaving_date"] = $default["leaving_date"];
                }

                if($default["working_day_date"] == '0000-00-00'){
                    $default["working_day_date"] = '';
                }else{
                    $default["working_day_date"] = $default["working_day_date"];
                }

//            }


            $result = Master::get_media_data($default['media']);

            if(isset($result[0]['genre']) AND $result[0]['genre'] > 0){
                $default['genreId'] = $result[0]['genre'];
                $default['genre'] = $masterData['genre'][$result[0]['genre']];
            }else{
                $default['genreId'] = '';
                $default['genre'] = '';
            }

            unset($default['work_location']);
            if(isset($work_locations)){
                  foreach($work_locations as $work_location) {
                      $default['work_location'][$work_location['location_id']] = '1';
                  }
            }
//            if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($default);
            if(preg_match('/^([0-9]{1})$/', $default['submission_hour'])) $default['submission_hour'] = sprintf("%02d", $default['submission_hour']);

            $this->set_safe("default", $default);
        } else {

//            $submission_date = explode('-', date("Y-m-d"));
//            $default["submission_year"] = $submission_date[0];
//            $default["submission_month"] = $submission_date[1];
//            $default["submission_day"] = $submission_date[2];
//            $default["submission_hour"] = date("H");
//            $default["submission_time"] = date("i");
//            $default["interview_year"] = $submission_date[0];
//            $default["interview_month"] = $submission_date[1];

            // ★
//            if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ){
                $default["submission_date"] = date("Y-m-d H:i");
//                $default["interview_date"] = date("Y-m-d H:i");
//            }


//            $default["scout_mail_flg"] = 1;
            $default["scout_mail_flg"] = 0;
        }

        //エラー時の入力値を引き継ぐ
        $validate = \Fuel\Core\Validation::instance('input_data_validate_data');
        if($validate !== false){
            $validate_error = $validate->error();
            if (!empty($validate_error)) {
                $default = array_merge($default, Input::post());
            }
        }


        $fieldset->populate($default);
        $this->set_safe("setting_data", $setting_data);

        if (!isset($staff_name)) {
            $staff_name = Auth::get_profile_fields('name');
        }

        if($this->userData["group"] == 2){
//            // 面接日
            if(!empty($default["interview_date"])) $this->set_safe("default_interview_date", $default['interview_date']);
//            $this->set_safe("default_interview_date", $default['interview_date']);
//            $this->set_safe("default_interview_year", $default['interview_year']);
//            $this->set_safe("default_interview_month", $default['interview_month']);
//            $this->set_safe("default_interview_day", $default['interview_day']);
        }

        $this->set_safe("tracking_remarks_data", $tracking_remarks_data);
        $this->set_safe("other_means_data", $other_means_data);
        $this->set_safe("experience_select", $experience_select);
        $this->set_safe("person_select", $person_select);
        $this->set_safe("pref_select", $pref_select);
        $this->set_safe("staff_name", $staff_name);
        $this->set_safe("editing", $editing);
        $this->set_safe("authority", $authority);
        $this->set_safe("setting_data_select", $setting_data_select);
        $this->set_safe("interview_staff_select", $interview_staff_select);
        $this->set_safe("interview_staff_sub_select", $interview_staff_sub_select);

        $this->set_safe('forms', $fieldset->getFormElements());

        $relax_input_required = (\Fuel::$env === \Fuel::DEVELOPMENT && \Config::get('input_relax_required_validation', false));
        $this->set_safe('relax_input_required', $relax_input_required);

    }

    //同一人物を探す
    public function sameperson()
    {
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo 'koko?';
//        $fp = fopen('/var/www/re.sp-labelle.com/www/htdocs/log.txt','a');
//        fputs($fp, Request::active()->param('id'));
//        fputs($fp, Input::post("surnamekana"));
//        fputs($fp, Input::post("namekana"));
//        fputs($fp, Input::post("tel01"));
//        fputs($fp, Input::post("tel02"));
//        fputs($fp, Input::post("tel03"));
//        fclose($fp);

        $setting_data = Config::get('setting', array());
        $masterData = Inputdata::get_select_data($setting_data);
//        $result = Inputdata::get_sameperson_data(Request::active()->param('id'), Input::post("submission_name"), Input::post("tel01"), Input::post("tel02"), Input::post("tel03"));
        $result = Inputdata::get_sameperson_data(Request::active()->param('id'), Input::post("surnamekana"), Input::post("namekana"), Input::post("tel01"), Input::post("tel02"), Input::post("tel03"));

        if(isset($result) AND $result){
            foreach ($result as $key => $value) {
                if (isset($value["staff_id"])) {
                    $staff_data = Common::get_data("SELECT username, `group`, email, profile_fields FROM login_users WHERE id = $value[staff_id]");

                    $staff_data = array_shift($staff_data);

                    $staff_data["profile_fields"] = unserialize($staff_data["profile_fields"]);

                    if (!empty($staff_data["profile_fields"]["name"])) {
                        $result[$key]["staff_name"] = $staff_data["profile_fields"]["name"];
                    }
                }

                if($value["publicity"] != 0){
                    $result[$key]["publicity"] = $masterData["publicity"][$value["publicity"]];
                    if(!isset($this->title)) $this->title = "";
                    $this->title = $masterData["publicity"][$value["publicity"]] . '|' . $this->title;
                }


                if($value["media"] != 0){
                    $result[$key]["media"] = $masterData["media"][$value["media"]];
                }


                if($value["genre"] != 0){
                    $result[$key]["genre"] = $masterData["genre"][$value["genre"]];
                }


                if($value["move"] != 0){
                    $result[$key]["move"] = $masterData["move"][$value["move"]];
                }


                if(!empty($value["experience"])){
                    $experience = explode(",", $value["experience"]);
                    foreach ($experience as $exp_key => $exp_value) {
                        $result[$key]["experienceArray"][$exp_key] = $masterData["experience"][$exp_value["experience"]] . ',';
                    }
                }else{
                    $result[$key]["experienceArray"] = '';
                }



//                if($value["cup"] != 0){
//                    $result[$key]["cup"] = $setting_data["cup_data"][$value["cup"]];
//                }


                if($value["contact"] != 0){
                    $result[$key]["contact"] = $masterData["contact"][$value["contact"]];
                }


                if($value["check"] != 0){
                    $result[$key]["check"] = $masterData["check"][$value["check"]];
                }


                if($value["interviewshop"] != 0) {
                    $result[$key]["interviewshop"] = $masterData["interviewshop"][$value["interviewshop"]];
                }


                if($value["place"] != 0){
                    $result[$key]["place"] = $masterData["place"][$value["place"]];
                }

                if($value["area"] != 0){
                    $result[$key]["area"] = $masterData["area"][$value["area"]];
                }

                if($value["belonging_store"] != 0){
                    $result[$key]["belonging_store"] = $masterData["belonging_store"][$value["belonging_store"]];
                }

//                if($value["pref"] != 0){
//                    $result[$key]["pref"] = $setting_data["pref"][$value["pref"]];
//                }

                if($value["interview_result"] != 0){
//                    $result[$key]["interview_result"] = $setting_data["interview_result"][$value["interview_result"]];
                    $result[$key]["interview_result"] = $masterData["interview_result"][$value["interview_result"]];
                }

                if($value["leaving_reason"] != 0){
                    $result[$key]["leaving_reason"] = $masterData["leaving_reason"][$value["leaving_reason"]];
                }

                if(isset($masterData["staff_print"][$value["interview_staff"]])){
                    $result[$key]["interview_staff"] = $masterData["staff_print"][$value["interview_staff"]];
                }

                if(isset($masterData["staff_print"][$value["interview_staff_sub"]])){
                    $result[$key]["interview_staff_sub"] = $masterData["staff_print"][$value["interview_staff_sub"]];
                }

                if(isset($masterData["staff_print"][$value["ks_staff"]])){
                    $result[$key]["ks_staff"] = $masterData["staff_print"][$value["ks_staff"]];
                }

                if($value["work"] != 0){
//                    $result[$key]["work"] = $setting_data["work"][$value["work"]];
                    $result[$key]["work"] = $masterData["work"][$value["work"]];
                }

                if(isset($setting_data["hope_workplace"][$value["hope_workplace"]])){
                    $result[$key]["hope_workplace"] = $setting_data["hope_workplace"][$value["hope_workplace"]];
                }

                if(isset($masterData["person"][$value["apply_identity_card"]])){
                    $result[$key]["apply_identity_card"] = $masterData["person"][$value["apply_identity_card"]];
                }

                if(isset($masterData["person"][$value["identity_card_select"]])){
                    $result[$key]["identity_card_select"] = $masterData["person"][$value["identity_card_select"]];
                }

                if(isset($masterData["another_shop"][$value["another_shop"]])) {
                    $result[$key]["another_shop"] = $masterData["another_shop"][$value["another_shop"]];
                }

                if(isset($masterData["word"][$value["word1"]])) {
                    $result[$key]["word1"] = $masterData["word"][$value["word1"]];
                }

                if(isset($masterData["word"][$value["word2"]])) {
                    $result[$key]["word2"] = $masterData["word"][$value["word2"]];
                }

                if(isset($masterData["word"][$value["word3"]])) {
                    $result[$key]["word3"] = $masterData["word"][$value["word3"]];
                }

                if(isset($masterData["word"][$value["word4"]])) {
                    $result[$key]["word4"] = $masterData["word"][$value["word4"]];
                }

                if(isset($masterData["word"][$value["word5"]])) {
                    $result[$key]["word5"] = $masterData["word"][$value["word5"]];
                }

                if(isset($masterData["word"][$value["word6"]])) {
                    $result[$key]["word6"] = $masterData["word"][$value["word6"]];
                }

                if(isset($masterData["reason"][$value["reason"]])) {
                    $result[$key]["reason"] = $masterData["reason"][$value["reason"]];
                }

            }
        }

//        foreach($result AS $key => $value){
//            $fp = fopen('/var/www/re.sp-labelle.com/www/htdocs/log.txt','a');
//            fputs($fp, $key . '★');
//            fclose($fp);
//            foreach($value AS $key2 => $value2){
//                $fp = fopen('/var/www/re.sp-labelle.com/www/htdocs/log.txt','a');
//                fputs($fp, $key2 . '=>' . $value2 . ' ');
//                fclose($fp);
//            }
//        }

        $this->set_safe( "result", $result );
    }

    public function sendmail()
    {
        $this->title = "メール送信 | データ入力";
    }

    public function send_schdl()
    {
        $this->title = "面接予定送信 | データ入力";

        $setting_data = Config::get('setting', array());
        $masterData = Inputdata::get_select_data($setting_data);

        $fieldset = Fieldsetplus::forge();

        $fieldset -> add('groupId', 'グループ名', array('options' => $masterData["group"], 'type' => 'select', 'value' => '', 'id' => 'staff_group_select'));

        $data_id = Request::active()->param('id');

        $result = Inputdata::get_rowdata($data_id);

        $posted_group_id = Input::post('groupId');
        if ($posted_group_id !== null && $posted_group_id !== '') {

            $group = Staffgroup::get_rowdata($posted_group_id);

            $default = array(
                'groupId' => $posted_group_id,
            );

            if (!empty($group)) {
                $default['group'] = $group[0]['group_data'];
            }

            $fieldset->populate($default);

            $this->set_safe('group', $group);
            $this->set_safe('default', $default);
        }

        $this->set_safe('forms', $fieldset->getFormElements());

        // 表示中スタッフと非表示中スタッフの結合
        $masterData['staff'] = $masterData['staff'] + $masterData['staff_hidden'];

        $this->set_safe('staff', $masterData['staff']);

        if (isset($masterData['interviewshop'][$result[0]['interviewshop']])) {
            $this->set_safe('interviewshop', $masterData['interviewshop'][$result[0]['interviewshop']]);
        }

    }

    public function send_rcrt()
    {
        $this->title = "採用情報送信 | データ入力";

        $setting_data = Config::get('setting', array());
        $masterData = Inputdata::get_select_data($setting_data);

        $fieldset = Fieldsetplus::forge();

        $fieldset -> add('groupId', 'グループ名', array('options' => $masterData["group"], 'type' => 'select', 'value' => '', 'id' => 'staff_group_select'));

        if(Input::post('groupId')){
            $group = Staffgroup::get_rowdata(Input::post('groupId'));

            $default = array(
                'groupId' => Input::post('groupId')
            );

            if(!empty($group)){
                $default['group'] = $group[0]['group_data'];
            }

            $fieldset->populate( $default );

            $this->set_safe( 'group', $group);
            $this->set_safe( 'default', $default );
        }

        $this->set_safe( 'forms', $fieldset->getFormElements());

//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($masterData);
        $this->set_safe( 'sender', $masterData['sender'] );
        $this->set_safe( 'staff', $masterData['staff'] );

    }

    public function mail_schdl()
    {
        $this->title = "面接予定送信メール | データ入力";

        $data_id = Request::active()->param('id');
        if (empty($data_id)) {
            $data_id = Input::post('id');
        }
        if (empty($data_id)) {
            Response::redirect('/inputdata/data/');
            return;
        }
        $groupId = Input::post('groupId');

        // POST 以外・groupId なし・本番 DB で group 列が NULL 等のときの未定義／explode TypeError を防ぐ
        if ($groupId === null || $groupId === '') {
            Response::redirect('/inputdata/send_schdl/' . $data_id);
            return;
        }

        $setting_data = Config::get('setting', array());
        $masterData = Inputdata::get_select_data($setting_data);

        if (empty($masterData['group']) || !isset($masterData['group'][$groupId])) {
            Response::redirect('/inputdata/send_schdl/' . $data_id);
            return;
        }

        $group_name = $masterData['group'][$groupId];
        $group = Staffgroup::get_rowdata($groupId);
        $sender_list = array();
        if (!empty($group[0]) && array_key_exists('group', $group[0])) {
            $group_csv = $group[0]['group'];
            if ($group_csv === null) {
                $group_csv = '';
            }
            $sender_list = array_values(array_filter(array_map('trim', explode(',', (string) $group_csv)), 'strlen'));
        }

        $this->set_safe('group_name', $group_name);
        $this->set_safe('groupId', $groupId);
        $this->set_safe('sender_list', $sender_list);
    }

    public function mail_rcrt()
    {
        $this->title = "採用情報送信メール | データ入力";

        $setting_data = Config::get('setting', array());
        $masterData = Inputdata::get_select_data($setting_data);

        $sender_list = Input::post("check_sender");

        $send_name = "";
        foreach ($sender_list as $key => $value) {
            $send_name .= $masterData["staff"][$value] . ",";
        }
        $send_name = rtrim($send_name,",");

        $this->set_safe( 'sender_list', $sender_list);
        $this->set_safe( 'send_name', $send_name);
    }

    public function sent_schdl()
    {
        $this->title = "面接予定送信完了 | データ入力";
    }

    public function sent_rcrt()
    {
        $this->title = "採用情報送信完了 | データ入力";
    }
}
