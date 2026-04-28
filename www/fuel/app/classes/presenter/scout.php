<?php
use \Model\Inputdata;
use \Model\Scout;
use \Model\Mailtmpl;

/**
 * The welcome hello presenter.
 *
 * @package  app
 * @extends  Presenter
 */
class Presenter_Scout extends Presenter
{
    /**
     * Prepare the view data, keeping this in here helps clean up
     * the controller.
     *
     * @return void
     */
    public function view()
    {
        $this->title = "オファーメール";
        $setting_data = Config::get('setting', array());
        $masterData = Inputdata::get_select_data($setting_data);

        $fieldset = Fieldsetplus::forge();

        $belonging_store_select = '<optgroup label="全て選択">';
        foreach ($masterData["belonging_store"] as $key => $value) {
            if ($value !== reset($masterData["belonging_store"])) {
                $belonging_store_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $belonging_store_select .= '</optgroup>';

        $fieldset -> add('interview_date_year_from', '面接日from(年)', array('options' => $setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_date_month_from', '面接日from(月)', array('options' => $setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_date_day_from', '面接日from(日)', array('options' => $setting_data["day"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_date_year_to', '面接日to(年)', array('options' => $setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_date_month_to', '面接日to(月)', array('options' => $setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_date_day_to', '面接日to(日)', array('options' => $setting_data["day"], 'type' => 'select', 'value' => ''));

        $interview_result_select = '<optgroup label="全て選択">';
        foreach ($setting_data["interview_result"] as $key => $value) {
            if ($value !== reset($setting_data["interview_result"])) {
                $interview_result_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $interview_result_select .= '</optgroup>';

        $fieldset -> add( 'age_from', '年齢', array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'age', 'size' => '3') );

        $fieldset -> add( 'age_to', '年齢', array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'age', 'size' => '3') );

        $fieldset -> add( 'tall_from', '身長', array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'tall', 'size' => '4') );

        $fieldset -> add( 'tall_to', '身長', array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'tall', 'size' => '4') );

        $fieldset -> add( 'weight_from', '体重', array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'weight', 'size' => '4') );

        $fieldset -> add( 'weight_to', '体重', array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'weight', 'size' => '4') );

        $pref_select = "";
        $selected = "";
        foreach ($setting_data["pref"] as $key => $value) {
            $pref_select .=<<<EOD
            <optgroup label="{$key}">
EOD;

            foreach ($value as $key2 => $value2) {
                if(isset($result[0]["pref"]) AND $result[0]["pref"] == $key2){
                    $selected = "selected";
                }

                $pref_select .=<<<EOD
                <option value="{$key2}" $selected>{$value2}</option>
EOD;
                $selected = "";
            }
            $pref_select .=<<<EOD
            </optgroup>
EOD;
        }

        $fieldset -> add( 'address', '住所', array('name' => 'other','size' => '75') );

        $fieldset -> add('leaving_year_from', '退店日(年)', array('options' => $setting_data["year"], 'type' => 'select', 'value' => '', 'class' => ''));

        $fieldset -> add('leaving_month_from', '退店日(月)', array('options' => $setting_data["month"], 'type' => 'select', 'value' => '', 'class' => ''));

        $fieldset -> add('leaving_day_from', '退店日(日)', array('options' => $setting_data["day"], 'type' => 'select', 'value' => '', 'class' => ''));

        $fieldset -> add('leaving_year_to', '退店日(年)', array('options' => $setting_data["year"], 'type' => 'select', 'value' => '', 'class' => ''));

        $fieldset -> add('leaving_month_to', '退店日(月)', array('options' => $setting_data["month"], 'type' => 'select', 'value' => '', 'class' => ''));

        $fieldset -> add('leaving_day_to', '退店日(日)', array('options' => $setting_data["day"], 'type' => 'select', 'value' => '', 'class' => ''));


        $fieldset -> add('media', '掲載求人', array('options' => $masterData["media"], 'type' => 'select', 'value' => ''));


        $fieldset -> add('submission_year_from', '申込日(年)', array('options' => $setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_month_from', '申込日(月)', array('options' => $setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_day_from', '申込日(日)', array('options' => $setting_data["day"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_year_to', '申込日(年)', array('options' => $setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_month_to', '申込日(月)', array('options' => $setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_day_to', '申込日(日)', array('options' => $setting_data["day"], 'type' => 'select', 'value' => ''));

        $experience_select = '';
        foreach ($masterData["experience"] as $key => $value) {
            if($key != ""){
                $experience_select .= "<option value=\"{$key}\">{$value}</option>";
            }
        }

        $date = explode('-', date("Y-m-d"));
        $default["interview_date_year_from"] = $date[0];
        $default["interview_date_month_from"] = $date[1];
        $default["interview_date_year_to"] = $date[0];
        $default["interview_date_month_to"] = $date[1];

        $default["leaving_year_from"] = $date[0];
        $default["leaving_month_from"] = $date[1];
        $default["leaving_year_to"] = $date[0];
        $default["leaving_month_to"] = $date[1];

        $default["submission_year_from"] = $date[0];
        $default["submission_month_from"] = $date[1];
        $default["submission_year_to"] = $date[0];
        $default["submission_month_to"] = $date[1];

        $fieldset->populate($default);

        $this->set_safe( 'forms', $fieldset->getFormElements() );
        $this->set_safe( "interview_result_select", $interview_result_select );
        $this->set_safe( "belonging_store_select", $belonging_store_select );
        $this->set_safe( "experience_select", $experience_select );
        $this->set_safe( "pref_select", $pref_select );
    }

    public function search_shop()
    {
        $this->title = "オファーメール";
        $setting_data = Config::get('setting', array());
        $masterData = Inputdata::get_select_data($setting_data);

        $fieldset = Fieldsetplus::forge();

        $search = "";
        if(Input::get('search') === "1"){
            $search = Input::get();
            $fieldset->populate( $search );
        }

        $scout_data = Scout::get_shop_data($search);

        if(!empty($scout_data)){
            foreach ($scout_data as $key => $value) {
                if(isset($masterData['belonging_store'][$value['belonging_store']])){
                    $scout_data[$key]['belonging_store'] = $masterData['belonging_store'][$value['belonging_store']];
                }else{
                    $scout_data[$key]['belonging_store'] = "";
                }

                if(isset($setting_data['interview_result'][$value['interview_result']])){
                    $scout_data[$key]['interview_result'] = $setting_data['interview_result'][$value['interview_result']];
                }else{
                    $scout_data[$key]['interview_result'] = "";
                }

                if(isset($setting_data['leaving_reason'][$value['leaving_reason']])){
                    $scout_data[$key]['leaving_reason'] = $setting_data['leaving_reason'][$value['leaving_reason']];
                }else{
                    $scout_data[$key]['leaving_reason'] = "";
                }

                if(isset($masterData['check'][$value['check']])){
                    $scout_data[$key]['check'] = $masterData['check'][$value['check']];
                }else{
                    $scout_data[$key]['check'] = "";
                }
            }
        }

        $this->set_safe( 'forms', $fieldset->getFormElements() );
        $this->set_safe( "scout_data", $scout_data );
    }

    public function search_recruit()
    {
        $this->title = "オファーメール";
        $setting_data = Config::get('setting', array());
        $masterData = Inputdata::get_select_data($setting_data);

        $fieldset = Fieldsetplus::forge();

        $search = "";
        if(Input::get('search') === "1"){
            $search = Input::get();
            $fieldset->populate( $search );
        }

        $scout_data = Scout::get_recruit_data($search);

        if(!empty($scout_data)){
            foreach ($scout_data as $key => $value) {
                if(isset($masterData['media'][$value['media']])){
                    $scout_data[$key]['media'] = $masterData['media'][$value['media']];
                }else{
                    $scout_data[$key]['media'] = "";
                }

                if(isset($masterData['reason'][$value['reason']])){
                    $scout_data[$key]['reason'] = $masterData['reason'][$value['reason']];
                }else{
                    $scout_data[$key]['reason'] = "";
                }
            }
        }

        $this->set_safe( 'forms', $fieldset->getFormElements() );
        $this->set_safe( "scout_data", $scout_data );
    }

    public function mail_send_shop()
    {
        $this->title = "メール送信";
        $setting_data = Config::get('setting', array());
        $masterData = Inputdata::get_select_data($setting_data);

        $fieldset = Fieldsetplus::forge();

        $mailtmpl = Mailtmpl::get_data();
        $mailtmpl_select[""] = "—";
        foreach ($mailtmpl as $key => $value) {
            $mailtmpl_select[$value['id']] = $value["template_name"];
        }

        $fieldset -> add('mailtmpl', 'メールテンプレート', array('options' => $mailtmpl_select, 'type' => 'select', 'value' => '', 'class' => 'form_mailtmpl'));


//        $search = "";
//        if(Input::get('search') === "1"){
//            $search = Input::get();
//            $fieldset->populate( $search );
//        }
//
//        $scout_data = Scout::get_recruit_data($search);


        $this->set_safe( 'forms', $fieldset->getFormElements() );
//        $this->set_safe( "scout_data", $scout_data );
        $this->set_safe( "check_id", Input::post("check_id") );
        $this->set_safe( "mailtmpl", $mailtmpl );

    }

    public function mail_send_recruit()
    {
        $this->title = "メール送信";
        $setting_data = Config::get('setting', array());
        $masterData = Inputdata::get_select_data($setting_data);

        $fieldset = Fieldsetplus::forge();

        $mailtmpl = Mailtmpl::get_data();
        $mailtmpl_select[""] = "—";
        foreach ($mailtmpl as $key => $value) {
            $mailtmpl_select[$value['id']] = $value["template_name"];
        }

        $fieldset -> add('mailtmpl', 'メールテンプレート', array('options' => $mailtmpl_select, 'type' => 'select', 'value' => '', 'class' => 'form_mailtmpl'));

//        $search = "";
//        if(Input::get('search') === "1"){
//            $search = Input::get();
//            $fieldset->populate( $search );
//        }

//        $scout_data = Scout::get_recruit_data($search);


        $this->set_safe( 'forms', $fieldset->getFormElements() );
//        $this->set_safe( "scout_data", $scout_data );
        $this->set_safe( "check_id", Input::post("check_id") );
        $this->set_safe( "mailtmpl", $mailtmpl );

    }
}
