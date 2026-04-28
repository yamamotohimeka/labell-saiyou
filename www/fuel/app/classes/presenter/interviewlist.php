<?php
use \Model\Inputdata;
use \Model\Interviewlist;
/**
 * The welcome hello presenter.
 *
 * @package  app
 * @extends  Presenter
 */
class Presenter_Interviewlist extends Presenter
{
	/**
	 * Prepare the view data, keeping this in here helps clean up
	 * the controller.
	 *
	 * @return void
	 */
	public function view()
	{
        $this->title = "面接予定リスト";

        $fieldset = Fieldsetplus::forge();
        $setting_data = Config::get('setting', array());
        $masterData = Inputdata::get_select_data($setting_data);

        $fieldset -> add('interview_date_year_from', '面接日from(年)', array('options' => $setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_date_month_from', '面接日from(月)', array('options' => $setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_date_day_from', '面接日from(日)', array('options' => $setting_data["day"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_date_year_to', '面接日to(年)', array('options' => $setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_date_month_to', '面接日to(月)', array('options' => $setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_date_day_to', '面接日to(日)', array('options' => $setting_data["day"], 'type' => 'select', 'value' => ''));

        $interviewshop_select = '<optgroup label="全て選択">';
        foreach ($masterData["interviewshop"] as $key => $value) {
            if ($value !== reset($masterData["interviewshop"])) {
                $interviewshop_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $interviewshop_select .= '</optgroup>';

        $search = "";
        if(Input::get('search') === "検索"){
            $search = Input::get();
            $fieldset->populate( $search );
        }

        $result = Interviewlist::get_data($search);
//print_r($result);
        if(!empty($result)){
            foreach ($result as $key => $value) {
                if(isset($masterData['interviewshop'][$value['interviewshop']])){
                    $result[$key]['interviewshop'] = $masterData['interviewshop'][$value['interviewshop']];
                }else{
                    $result[$key]['interviewshop'] = "";
                }

                if(!empty($value['experience'])){
                    if ( preg_match('/,/', $value['experience']) ) {
                        $experienceArray = explode(',', $value['experience']);
                        $result[$key]['experience'] = '';
                        foreach ($experienceArray as $key2 => $value2){
                            $result[$key]['experience'] .= $masterData['experience'][$value2] . '/';
                        }
                    }else{
                        $result[$key]['experience'] = $masterData['experience'][$value['experience']];
                    }
                }else{
                    $result[$key]['experience'] = 'なし';
                }

//                if(isset($masterData['experience'][$value['experience']])){
//                    $result[$key]['experience'] = 'あり';
//                }else{
//                    $result[$key]['experience'] = 'なし';
//                }

                if($value['age'] == 0){
                    $result[$key]['age'] = '';
                }

                if(isset($masterData['media'][$value['media']])){
                    $result[$key]['media'] = $masterData['media'][$value['media']];
                }else{
                    $result[$key]['media'] = '';
                }

            }
        }else{
            $submission_date = explode('-', date("Y-m-d"));
            $default["interview_date_year_from"] = $submission_date[0];
            $default["interview_date_month_from"] = $submission_date[1];
            $default["interview_date_day_from"] = $submission_date[2];
            $default["interview_date_year_to"] = $submission_date[0];
            $default["interview_date_month_to"] = $submission_date[1];
            $default["interview_date_day_to"] = $submission_date[2];

            $fieldset->populate($default);
        }

        $this->set_safe( 'forms', $fieldset->getFormElements() );
        $this->set_safe( "interviewshop_select", $interviewshop_select );
        $this->set_safe( "search", $search );
        $this->set_safe( "result", $result );
	}
}
