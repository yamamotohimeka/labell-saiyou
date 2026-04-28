<?php
use \Model\Top;
use \Model\Inputdata;

/**
 * The welcome hello presenter.
 *
 * @package  app
 * @extends  Presenter
 */
class Presenter_Top extends Presenter
{
	/**
	 * Prepare the view data, keeping this in here helps clean up
	 * the controller.
	 *
	 * @return void
	 */
	public function view()
	{
        $this->title = "トップ";
        $fieldset = Fieldsetplus::forge();

        $setting_data = Config::get('setting', array());
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($setting_data);
            $masterData = Inputdata::get_select_data($setting_data);
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($masterData);

        $fieldset -> add('interview_date_year_from', '面接日(年)', array('options' => $setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_date_month_from', '面接日(月)', array('options' => $setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_date_day_from', '面接日(日)', array('options' => $setting_data["day"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_date_year_to', '面接日(年)', array('options' => $setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_date_month_to', '面接日(月)', array('options' => $setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_date_day_to', '面接日(日)', array('options' => $setting_data["day"], 'type' => 'select', 'value' => ''));

        //面接結果
        $interview_result_select = '<optgroup label="全て選択">';
        foreach ($masterData["interview_result"] as $key => $value) {
            if ($value !== reset($masterData["interview_result"])) {
                $interview_result_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
//        $interview_result_select .= '</optgroup>';
//        $interview_result_select = '<optgroup label="全て選択">';
//        foreach ($setting_data["interview_result"] as $key => $value) {
//            if ($value !== reset($setting_data["interview_result"])) {
//                $interview_result_select .=<<<EOD
//<option value="{$key}">{$value}</option>
//EOD;
//            }
//        }
//        $interview_result_select .= '</optgroup>';

        //面接担当
        $interview_staff_select = '<optgroup label="全て選択">';
        foreach ($masterData["staff_print"] as $key => $value) {
            if ($value !== reset($masterData["staff_print"])) {
                $interview_staff_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $interview_staff_select .= '</optgroup>';

        $fieldset -> add( 'genji_name', '源氏名', array('name' => 'other','size' => '22') );

        $fieldset -> add( 'genji_namekana', '源氏名（ふりがな）', array('name' => 'other','size' => '22') );

        $fieldset -> add( 'search_id', 'ID', array('name' => 'other','size' => '3') );

        //所属店舗
        $belonging_store_select = '<optgroup label="全て選択">';
        foreach ($masterData["belonging_store"] as $key => $value) {
            if ($value !== reset($masterData["belonging_store"])) {
                $belonging_store_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $belonging_store_select .= '</optgroup>';

        $fieldset -> add( 'surname', '姓', array('name' => 'other','size' => '18') );

        $fieldset -> add( 'name', '名', array('name' => 'other','size' => '18') );

        $fieldset -> add( 'surnamekana', '姓（ふりがな）', array('name' => 'other','size' => '18') );

        $fieldset -> add( 'namekana', '名（ふりがな）', array('name' => 'other','size' => '18') );

        $fieldset -> add('leaving_year_from', '退店日(年)', array('options' => $setting_data["year"], 'type' => 'select', 'value' => '', 'class' => ''));

        $fieldset -> add('leaving_month_from', '退店日(月)', array('options' => $setting_data["month"], 'type' => 'select', 'value' => '', 'class' => ''));

        $fieldset -> add('leaving_day_from', '退店日(日)', array('options' => $setting_data["day"], 'type' => 'select', 'value' => '', 'class' => ''));

        $fieldset -> add('leaving_year_to', '退店日(年)', array('options' => $setting_data["year"], 'type' => 'select', 'value' => '', 'class' => ''));

        $fieldset -> add('leaving_month_to', '退店日(月)', array('options' => $setting_data["month"], 'type' => 'select', 'value' => '', 'class' => ''));

        $fieldset -> add('leaving_day_to', '退店日(日)', array('options' => $setting_data["day"], 'type' => 'select', 'value' => '', 'class' => ''));

        //SC
        $scout_select = '<optgroup label="全て選択">';
        foreach ($setting_data["scout"] as $key => $value) {
            if ($value !== reset($setting_data["scout"])) {
                $scout_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $scout_select .= '</optgroup>';

        //出戻り・移籍・紹介
        $move_select = '<optgroup label="全て選択">';
        foreach ($masterData["move"] as $key => $value) {
            if ($value !== reset($masterData["move"])) {
                $move_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $move_select .= '</optgroup>';

        // 掲載求人
        $media_select = '<optgroup label="全て選択">';
        foreach ($masterData["media"] as $key => $value) {
            if ($value !== reset($masterData["media"])) {
                $media_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $media_select .= '</optgroup>';

        $search = "";
        if(Input::get('search') === "1"){
            $search = Input::get();
            $fieldset->populate( $search );
        }

        $result = Top::get_rowdata($search, Input::get('dataId'));

        $pager = $result["pager"];
        unset($result["pager"]);

        foreach ($result as $key => $value) {
//            $value["experience"]
//            $value["identity_card_select"]
        }

        if(!empty($search)){
            if(!empty($search['interview_date_year_from'])) $default["interview_date_year_from"] = $search['interview_date_year_from'];
            if(!empty($search['interview_date_month_from'])) $default["interview_date_month_from"] = $search['interview_date_month_from'];
            if(!empty($search['interview_date_day_from'])) $default["interview_date_day_from"] = $search['interview_date_day_from'];
            if(!empty($search['interview_date_year_to'])) $default["interview_date_year_to"] = $search['interview_date_year_to'];
            if(!empty($search['interview_date_month_to'])) $default["interview_date_month_to"] = $search['interview_date_month_to'];
            if(!empty($search['interview_date_day_to'])) $default["interview_date_day_to"] = $search['interview_date_day_to'];
        }else{
            $interview_date = explode('-', date("Y-m-d"));
            $default["interview_date_year_from"] = $interview_date[0];
            $default["interview_date_month_from"] = $interview_date[1];
            $default["interview_date_day_from"] = "01";
            $default["interview_date_year_to"] = $interview_date[0];
            $default["interview_date_month_to"] = $interview_date[1];
            $default["interview_date_day_to"] = "31";
        }

        
        $fieldset->populate($default);

        $this->set_safe( "result", $result );
        $this->set_safe( "search", $search );
        $this->set_safe( "setting_data", $setting_data );
        $this->set_safe( "masterData", $masterData );
        $this->set_safe( "interview_result_select", $interview_result_select );
        $this->set_safe( "interview_staff_select", $interview_staff_select );
        $this->set_safe( "belonging_store_select", $belonging_store_select );
        $this->set_safe( "scout_select", $scout_select );
        $this->set_safe( "move_select", $move_select );
        $this->set_safe( "media_select", $media_select );
        $this->set_safe( 'forms', $fieldset->getFormElements() );
        $this->set_safe( "pager", $pager );

    }
}
