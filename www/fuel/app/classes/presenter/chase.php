<?php
use \Model\Inputdata;
use \Model\Chase;

/**
 * The welcome hello presenter.
 *
 * @package  app
 * @extends  Presenter
 */
class Presenter_Chase extends Presenter
{
	/**
	 * Prepare the view data, keeping this in here helps clean up
	 * the controller.
	 *
	 * @return void
	 */
	public function view()
	{
        $this->title = "追跡・連絡予定情報";

        $setting_data = Config::get('setting', array());
        $masterData = Inputdata::get_select_data($setting_data);

        $fieldset = Fieldsetplus::forge();

        $fieldset -> add( 'search_id', 'ID', array('name' => 'other','size' => '3') );

        $fieldset -> add('scheduled_date_year_from', '追跡予定日from(年)', array('options' => $setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('scheduled_date_month_from', '追跡予定日from(月)', array('options' => $setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('scheduled_date_day_from', '追跡予定日from(日)', array('options' => $setting_data["day"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('scheduled_date_year_to', '追跡予定日to(年)', array('options' => $setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('scheduled_date_month_to', '追跡予定日to(月)', array('options' => $setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('scheduled_date_day_to', '追跡予定日to(日)', array('options' => $setting_data["day"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_year_from', '申込日from(年)', array('options' => $setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_month_from', '申込日from(月)', array('options' => $setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_day_from', '申込日from(日)', array('options' => $setting_data["day"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_year_to', '申込日to(年)', array('options' => $setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_month_to', '申込日to(月)', array('options' => $setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_day_to', '申込日to(日)', array('options' => $setting_data["day"], 'type' => 'select', 'value' => ''));

        $publicity_select = '<optgroup label="全て選択">';
        foreach ($masterData["publicity"] as $key => $value) {
            if ($value !== reset($masterData["publicity"])) {
                $publicity_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $publicity_select .= '</optgroup>';

        $recruit_select = '<optgroup label="全て選択">';
        foreach ($masterData["media"] as $key => $value) {
            if ($value !== reset($masterData["media"])) {
                $recruit_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $recruit_select .= '</optgroup>';

        $reason_select = '<optgroup label="全て選択">';
        foreach ($masterData["reason"] as $key => $value) {
            if ($value !== reset($masterData["reason"])) {
                $reason_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $reason_select .= '</optgroup>';

        $search = "";
        if(Input::get('search') === "1"){
            $search = Input::get();
            $fieldset->populate( $search );
        }

        $tracking_data = Chase::get_tracking_data($search);

        if(!empty($tracking_data)){
            foreach ($tracking_data as $key => $value) {
                if(isset($masterData['publicity'][$value['publicity']])){
                    $tracking_data[$key]['publicity'] = $masterData['publicity'][$value['publicity']];
                }else{
                    $tracking_data[$key]['publicity'] = "";
                }

                if(isset($masterData['experience'][$value['experience']])){
                    $tracking_data[$key]['experience'] = 'あり';
                }else{
                    $tracking_data[$key]['experience'] = 'なし';
                }

                if(isset($masterData['media'][$value['media']])){
                    $tracking_data[$key]['media'] = $masterData['media'][$value['media']];
                }else{
                    $tracking_data[$key]['media'] = "";
                }

                if(isset($masterData['reason'][$value['reason']])){
                    $tracking_data[$key]['reason'] = $masterData['reason'][$value['reason']];
                }else{
                    $tracking_data[$key]['reason'] = "";
                }

                if(isset($masterData['contact'][$value['contact']])){
                    $tracking_data[$key]['contact'] = $masterData['contact'][$value['contact']];
                }else{
                    $tracking_data[$key]['contact'] = "";
                }

            }
        }

        //事前連絡日取得
        $advance_contact_data = Chase::get_advance_contact_data();

        if(!empty($advance_contact_data)){
            foreach ($advance_contact_data as $key => $value) {
                if(isset($masterData['interviewshop'][$value['interviewshop']])){
                    $advance_contact_data[$key]['interviewshop'] = $masterData['interviewshop'][$value['interviewshop']];
                }

                if(isset($masterData['experience'][$value['experience']])){
                    $advance_contact_data[$key]['experience'] = 'あり';
                }else{
                    $advance_contact_data[$key]['experience'] = 'なし';
                }

                if(isset($masterData['media'][$value['media']])){
                    $advance_contact_data[$key]['media'] = $masterData['media'][$value['media']];
                }

                if(isset($masterData['contact'][$value['contact']])){
                    $advance_contact_data[$key]['contact'] = $masterData['contact'][$value['contact']];
                }

            }
        }


        if(!empty($search)){
            if(!empty($search['scheduled_date_year_from'])){
                $default["scheduled_date_year_from"] = $search['scheduled_date_year_from'];
                $default["submission_year_from"] = $search['scheduled_date_year_from'];
            }
            if(!empty($search['scheduled_date_month_from'])){
                $default["scheduled_date_month_from"] = $search['scheduled_date_month_from'];
                $default["submission_month_from"] = $search['scheduled_date_month_from'];
            }
            if(!empty($search['scheduled_date_year_to'])){
                $default["scheduled_date_year_to"] = $search['scheduled_date_year_to'];
                $default["submission_year_to"] = $search['scheduled_date_year_to'];
            }
            if(!empty($search['scheduled_date_month_to'])){
                $default["scheduled_date_month_to"] = $search['scheduled_date_month_to'];
                $default["submission_month_to"] = $search['scheduled_date_month_to'];
            }
        }else{
            $date = explode('-', date("Y-m-d"));
            $default["scheduled_date_year_from"] = '2019';
            $default["scheduled_date_month_from"] = '01';
            $default["scheduled_date_day_from"] = '01';
            $default["scheduled_date_year_to"] = $date[0];
            $default["scheduled_date_month_to"] = $date[1];
            $default["scheduled_date_day_to"] = $date[2];
            $default["submission_year_from"] = $date[0];
            $default["submission_month_from"] = $date[1];
            $default["submission_year_to"] = $date[0];
            $default["submission_month_to"] = $date[1];
        }

        $fieldset->populate($default);

        $this->set_safe( 'forms', $fieldset->getFormElements() );
        $this->set_safe( "publicity_select", $publicity_select );
        $this->set_safe( "recruit_select", $recruit_select );
        $this->set_safe( "reason_select", $reason_select );
        $this->set_safe( "advance_contact_data", $advance_contact_data );
        $this->set_safe( "tracking_data", $tracking_data );
        $this->set_safe( "search", $search );
	}
}
