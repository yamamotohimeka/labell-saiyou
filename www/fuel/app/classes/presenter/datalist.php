<?php
use \Model\Inputdata;
use \Model\Datalist;

/**
 * The welcome hello presenter.
 *
 * @package  app
 * @extends  Presenter
 */
class Presenter_Datalist extends Presenter
{
	/**
	 * Prepare the view data, keeping this in here helps clean up
	 * the controller.
	 *
	 * @return void
	 */
	public function view()
	{
        $this->title = "問合せリスト";
        $setting_data = Config::get('setting', array());
        $masterData = Inputdata::get_select_data($setting_data);

        $fieldset = Fieldsetplus::forge();

        $fieldset -> add( 'search_id', 'ID', array('name' => 'other','size' => '3') );
        
        $fieldset -> add('submission_year_from', '申込日(年)', array('options' => $setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_month_from', '申込日(月)', array('options' => $setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_day_from', '申込日(日)', array('options' => $setting_data["day"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_year_to', '申込日(年)', array('options' => $setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_month_to', '申込日(月)', array('options' => $setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_day_to', '申込日(日)', array('options' => $setting_data["day"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_hour_from', '申込時間(時)', array('options' => $setting_data["hour"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_hour_to', '申込時間(時)', array('options' => $setting_data["hour"], 'type' => 'select', 'value' => ''));

        $fieldset -> add( 'submission_name', '申込名', array('class' => 'input_name') );

        $apply_select = '<optgroup label="全て選択">';
        foreach ($setting_data["apply"] as $key => $value) {
            if ($value !== reset($setting_data["apply"])) {
                $apply_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $apply_select .= '</optgroup>';

        $fieldset -> add( 'tel01', 'TEL', array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'tel01', 'size' => '2') );

        $fieldset -> add( 'tel02', 'TEL', array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'tel02', 'size' => '2') );

        $fieldset -> add( 'tel03', 'TEL', array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'tel03', 'size' => '2') );

        $fieldset -> add( 'mail', 'Mail', array('pattern' => '^[a-z0-9._%@+-]+$', 'title' => '半角数字でご入力ください。', 'name' => 'mail01', 'size' => '18') );

        $media_select = '<optgroup label="全て選択">';
        foreach ($masterData["media"] as $key => $value) {
            if ($value !== reset($masterData["media"])) {
                $media_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $media_select .= '</optgroup>';

        $fieldset -> add( 'surname', '姓', array('name' => 'other','size' => '13') );

        $fieldset -> add( 'name', '名', array('name' => 'other','size' => '13') );

        $fieldset -> add( 'surnamekana', '姓(ふりがな)', array('name' => 'other','size' => '13') );

        $fieldset -> add( 'namekana', '名(ふりがな)', array('name' => 'other','size' => '13') );

        $interview_result_select = '<optgroup label="全て選択">';
        foreach ($masterData["interview_result"] as $key => $value) {
            if ($value !== reset($masterData["interview_result"])) {
                $interview_result_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $interview_result_select .= '</optgroup>';
//        $interview_result_select = '<optgroup label="全て選択">';
//        foreach ($setting_data["interview_result"] as $key => $value) {
//            if ($value !== reset($setting_data["interview_result"])) {
//                $interview_result_select .=<<<EOD
//<option value="{$key}">{$value}</option>
//EOD;
//            }
//        }
//        $interview_result_select .= '</optgroup>';

        $search = "";
        if(Input::get('search') === "1"){
            $search = Input::get();
            $fieldset->populate( $search );
        }


        if(Input::get('sort')){
            $sort = 'interview_main.' . Input::get('sort');
        }else{
            $sort = 'interview_main.updated_at';
        }


        $result = Datalist::get_data($search, $sort);

        $pager = $result["pager"];
        unset($result["pager"]);

        if(!empty($result)){
            foreach ($result as $key => $value) {
                if(isset($masterData['publicity'][$value['publicity']])){
                    $result[$key]['publicity'] = $masterData['publicity'][$value['publicity']];
                }else{
                    $result[$key]['publicity'] = "";
                }

                if(isset($masterData['media'][$value['media']])){
                    $result[$key]['media'] = $masterData['media'][$value['media']];
                }else{
                    $result[$key]['media'] = "";
                }

                if(isset($setting_data['apply'][$value['apply']])){
                    $result[$key]['apply'] = $setting_data['apply'][$value['apply']];
                }else{
                    $result[$key]['apply'] = "";
                }

                if(isset($masterData['interview_result'][$value['interview_result']])){
                    $result[$key]['interview_result'] = $masterData['interview_result'][$value['interview_result']];
                }else{
                    $result[$key]['interview_result'] = "";
                }
//                if(isset($setting_data['interview_result'][$value['interview_result']])){$result[$key]['interview_result'] = $masterData['interview_result'][$value['interview_result']];
//                    $result[$key]['interview_result'] = $setting_data['interview_result'][$value['interview_result']];
//                }else{
//                    $result[$key]['interview_result'] = "";
//                }

                if(isset($masterData['check'][$value['check']])){
                    $result[$key]['check'] = $masterData['check'][$value['check']];
                }else{
                    $result[$key]['check'] = "";
                }

            }
        }

        $date = explode('-', date("Y-m-d"));

        // デフォルト値を『2019年1月1日』に変更
        $default["submission_year_from"] = "2019";
        $default["submission_month_from"] = "01";
        $default["submission_day_from"] = "01";
//        $default["submission_year_from"] = $date[0];
//        $default["submission_month_from"] = $date[1];
//        $default["submission_day_from"] = "01";
        $default["submission_year_to"] = $date[0];
        $default["submission_month_to"] = $date[1];
        $default["submission_day_to"] = "31";

        $fieldset->populate($default);

        $this->set_safe( 'forms', $fieldset->getFormElements() );
        $this->set_safe( "result", $result );
        $this->set_safe( "media_select", $media_select );
        $this->set_safe( "apply_select", $apply_select );
        $this->set_safe( "interview_result_select", $interview_result_select );
        $this->set_safe( "search", $search );
        $this->set_safe( "pager", $pager );

	}
}
