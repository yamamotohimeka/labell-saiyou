<?php
use \Model\Inputdata;
use \Model\Interview;
use \Model\Master;
/**
 * The welcome hello presenter.
 *
 * @package  app
 * @extends  Presenter
 */
class Presenter_Interview extends Presenter
{
	/**
	 * Prepare the view data, keeping this in here helps clean up
	 * the controller.
	 *
	 * @return void
	 */
	public function view()
	{
        $this->title = "面接予定情報";

        $setting_data = Config::get('setting', array());
        $masterData = Inputdata::get_select_data($setting_data);

        $fieldset = Fieldsetplus::forge();

        $fieldset -> add('interview_date_year_from', '面接予定from(年)', array('options' => $setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_date_month_from', '面接予定from(月)', array('options' => $setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_date_day_from', '面接予定from(日)', array('options' => $setting_data["day"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_date_year_to', '面接予定to(年)', array('options' => $setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_date_month_to', '面接予定to(月)', array('options' => $setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_date_day_to', '面接予定to(日)', array('options' => $setting_data["day"], 'type' => 'select', 'value' => ''));

        $shop_select = '<optgroup label="全て選択">';
        foreach ($masterData["interviewshop"] as $key => $value) {
            if ($value !== reset($masterData["interviewshop"])) {
                $shop_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $shop_select .= '</optgroup>';


        $check_select = '<optgroup label="全て選択">';
        foreach ($masterData["check"] as $key => $value) {
                $check_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
        }
        $check_select .= '</optgroup>';


        $search = "";
        if(Input::get('search') === "1"){
            $search = Input::get();
            $fieldset->populate( $search );
        }

        $check_master = Master::get_data("master_check");

        foreach ($check_master as $key => $value) {
            $check_color_array[$value["id"]] = $value["color"];
        }

        $interview_data = Interview::get_data($search, $this->userData["group"]);

//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($interview_data);

        if(!empty($interview_data)){
            foreach ($interview_data as $key => $value) {
                if(isset($masterData['interviewshop'][$value['interviewshop']])){
                    $interview_data[$key]['interviewshop'] = $masterData['interviewshop'][$value['interviewshop']];
                }else{
                    $interview_data[$key]['interviewshop'] = "";
                }


                if(!empty($value['experience'])){
                    if ( preg_match('/,/', $value['experience']) ) {
                        $experienceArray = explode(',', $value['experience']);
                        $interview_data[$key]['experience'] = '';
                        foreach ($experienceArray as $key2 => $value2){
                            $interview_data[$key]['experience'] .= $masterData['experience'][$value2] . '/';
                        }
                    }else{
                        $interview_data[$key]['experience'] = $masterData['experience'][$value['experience']];
                    }
                }else{
                    $interview_data[$key]['experience'] = ' - ';
                }


//                if(isset($masterData['experience'][$value['experience']])){
////                    $interview_data[$key]['experience'] = 'あり';
//                    $interview_data[$key]['experience'] = $masterData['experience'][$value['experience']];
//                }else{
//                    $interview_data[$key]['experience'] = 'なし';
//                }

                if(isset($masterData['media'][$value['media']])){
                    $interview_data[$key]['media'] = $masterData['media'][$value['media']];
                }else{
                    $interview_data[$key]['media'] = "";
                }

                if(isset($masterData['contact'][$value['contact']])){
                    $interview_data[$key]['contact'] = $masterData['contact'][$value['contact']];
                }else{
                    $interview_data[$key]['contact'] = "";
                }

                if(isset($masterData['check'][$value['check']])){
                    $interview_data[$key]['check_color'] = $check_color_array[$value['check']];
                    $interview_data[$key]['check'] = $masterData['check'][$value['check']];
                }else{
                    $interview_data[$key]['check'] = "未確認";
                }


            }
        }
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo $this->userData["group"];

        if(!empty($search)){
            if(!empty($search['interview_date_year_from'])) $default["interview_date_year_from"] = $search['interview_date_year_from'];
            if(!empty($search['interview_date_month_from'])) $default["interview_date_month_from"] = $search['interview_date_month_from'];
            if(!empty($search['interview_date_year_to'])) $default["interview_date_year_to"] = $search['interview_date_year_to'];
            if(!empty($search['interview_date_month_to'])) $default["interview_date_month_to"] = $search['interview_date_month_to'];
        }else{
            $interview_date = explode('-', date("Y-m-d"));
            $default["interview_date_year_from"] = $interview_date[0];
            $default["interview_date_month_from"] = $interview_date[1];
            $default["interview_date_year_to"] = $interview_date[0];
            $default["interview_date_month_to"] = $interview_date[1];
        }


        $fieldset->populate($default);

        $this->set_safe( 'forms', $fieldset->getFormElements() );
        $this->set_safe( "shop_select", $shop_select );
        $this->set_safe( "check_select", $check_select );
        $this->set_safe( "interview_data", $interview_data );
        $this->set_safe( "search", $search );
        $this->set_safe( "check_master", $check_master );
	}
}
