<?php
use \Model\Inputdata;
//use \Model\Analyze;        // TODO 削除予定
use \Model\Analyze_Monthly;  // TODO Analyze 配下を省略したい(要相談)
use \Model\Analyze_Adopt;
use \Model\Analyze_Media;
use \Model\Analyze_Divide;
use \Model\Analyze_Branch;
use \Model\Analyze_Peas;
use \Model\Analyze_Emigrate;
use \Model\Analyze_Recruit;
use \Model\Analyze_Recruit_Tantou;
use \Model\Analyze_Keep;
use \Model\Analyze_Keep_Tantou;
use \Model\Analyze_Time;
use \Model\Analyze_Area;
use \Model\Analyze_Word;

/**
 * The welcome hello presenter.
 *
 * @package  app
 * @extends  Presenter
 */
class Presenter_Analyze extends Presenter
{
    public function before(){
        $this->setting_data = Config::get('setting', array());
        $this->masterData = Inputdata::get_select_data($this->setting_data);
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($this->masterData);
    }

	public function adopt()
	{
        $this->title = "集計 採用数";

        $fieldset = Fieldsetplus::forge();

//        $fieldset -> add('entershop_year_from', '入店日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));
//
//        $fieldset -> add('entershop_month_from', '入店日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));
//
//        $fieldset -> add('entershop_day_from', '入店日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));
//
//        $fieldset -> add('entershop_year_to', '入店日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));
//
//        $fieldset -> add('entershop_month_to', '入店日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));
//
//        $fieldset -> add('entershop_day_to', '入店日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));

        // 以前あった『入店日』の変わりの『面接予定日』に変更処理　2019.03.11
        $fieldset -> add('interview_year_from', '面接日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_month_from', '面接日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_day_from', '面接日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_year_to', '面接日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_month_to', '面接日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_day_to', '面接日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));

        //店舗
        $shop_select = '<optgroup label="全て選択">';
        foreach ($this->masterData["belonging_store"] as $key => $value) {
            if ($value !== reset($this->masterData["belonging_store"])) {
                $shop_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $shop_select .= '</optgroup>';

        //掲載求人
        $media_select = '<optgroup label="全て選択">';
        foreach ($this->masterData["media"] as $key => $value) {
            if ($value !== reset($this->masterData["media"])) {
                $media_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $media_select .= '</optgroup>';

        if(Input::get('search') === "1"){
            $search = Input::get();
            $result = Analyze_Adopt::get_adopt($search);
            $this->set_safe( "result", $result );
        }

        if(Input::get('select_recruit_hidden')){
            $shop_array = explode(",", Input::get('select_recruit_hidden'));
            foreach ($shop_array as $key => $value) {
                $media_array[$value] = $this->masterData["media"][$value];
            }
            $this->masterData["media"] = $media_array;
        }

        $date = explode('-', date("Y-m-d"));
//        $default["entershop_year_from"] = $date[0];
//        $default["entershop_month_from"] = $date[1];
//        $default["entershop_year_to"] = $date[0];
//        $default["entershop_month_to"] = $date[1];

        // 以前あった『入店日』の変わりの『面接予定日』に変更処理　2019.03.11
        $default["interview_year_from"] = $date[0];
        $default["interview_month_from"] = $date[1];
        $default["interview_year_to"] = $date[0];
        $default["interview_month_to"] = $date[1];

        $fieldset->populate($default);

        $this->set_safe( 'forms', $fieldset->getFormElements() );
        $this->set_safe( "shop_select", $shop_select );
        $this->set_safe( "media_select", $media_select );

	}

    public function monthly()
    {
        $this->title = "集計 月間集計";

        $fieldset = Fieldsetplus::forge();

        $fieldset -> add('interview_year_from', '面接日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_month_from', '面接日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_day_from', '面接日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_year_to', '面接日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_month_to', '面接日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_day_to', '面接日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));

        if(Input::get('search') === "1"){ // TODO マスタのデータがほしいのですが
            $search = Input::get();
            $result = Analyze_Monthly::get_monthly($search);
            $this->set_safe( "result", $result );
        }

        $date = explode('-', date("Y-m-d"));
        $default["interview_year_from"] = $date[0];// TODO 和暦表示
        $default["interview_month_from"] = $date[1];
        $default["interview_day_from"] = $date[2];
        $default["interview_year_to"] = $date[0];// TODO 和暦表示
        $default["interview_month_to"] = $date[1];
        $default["interview_day_to"] = $date[2];

        // TODO 和暦これ使えない？ そのまま西暦で表示されてしまう 要検討
//        setlocale(LC_TIME, "ja_JP.utf8", "Japanese_Japan.932");
//        $wareki = strftime('%EC%Ey年');
//        $default["interview_year_from"] = $wareki;
//        $default["interview_year_to"] = $wareki;

        $fieldset->populate($default);

        $this->set_safe( 'forms', $fieldset->getFormElements() );
    }

    public function media()
    {
        $this->title = "集計 掲載媒体";

        $fieldset = Fieldsetplus::forge();

        $fieldset -> add('submission_year_from', '申込日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_month_from', '申込日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_day_from', '申込日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_year_to', '申込日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_month_to', '申込日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_day_to', '申込日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));

        //掲載媒体
        $publicity_select = '<optgroup label="全て選択">';
        foreach ($this->masterData["publicity"] as $key => $value) {
            if ($value !== reset($this->masterData["publicity"])) {
                $publicity_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $publicity_select .= '</optgroup>';

        //掲載求人
        $media_select = '<optgroup label="全て選択">';
        foreach ($this->masterData["media"] as $key => $value) {
            if ($value !== reset($this->masterData["media"])) {
                $media_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $media_select .= '</optgroup>';

        if(Input::get('search') === "1"){
            $search = Input::get();
            $result = Analyze_Media::get_media($search, Input::get('adjustment'));
            $this->set_safe( "result", $result );
        }

        if(Input::get('recruit_hidden')){
            $this->masterData["media"] = call_user_func(function($media_hidden, $media) {
                $media_array = array();
                foreach ($media_hidden as $key => $value) {
                    $media_array[$value] = $media[$value];
                }
                return $media_array;
            }, explode(",", Input::get('recruit_hidden')), $this->masterData["media"]);
        }

        if(Input::get('media_hidden')){
            $this->masterData["publicity"] = call_user_func(function($publicity_hidden, $media) {
                $publicity_array = array();
                foreach ($publicity_hidden as $key => $value) {
                    $publicity_array[$value] = $media[$value];
                }
                return $publicity_array;
            }, explode(",", Input::get('media_hidden')), $this->masterData["publicity"]);
        }

        $date = explode('-', date("Y-m-d"));
        $default["submission_year_from"] = $date[0];
        $default["submission_month_from"] = $date[1];
        $default["submission_year_to"] = $date[0];
        $default["submission_month_to"] = $date[1];

        $fieldset->populate($default);

        $this->set_safe( 'forms', $fieldset->getFormElements() );
        $this->set_safe( "publicity_select", $publicity_select );
        $this->set_safe( "media_select", $media_select );
    }

    public function divide()
    {
        $this->title = "集計 面接振り件数";

        $fieldset = Fieldsetplus::forge();

//        $fieldset -> add('submission_year_from', '申込日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));
//        $fieldset -> add('submission_month_from', '申込日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));
//        $fieldset -> add('submission_day_from', '申込日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));
//        $fieldset -> add('submission_year_to', '申込日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));
//        $fieldset -> add('submission_month_to', '申込日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));
//        $fieldset -> add('submission_day_to', '申込日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_year_from', '面接日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));
        $fieldset -> add('interview_month_from', '面接日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));
        $fieldset -> add('interview_day_from', '面接日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));
        $fieldset -> add('interview_year_to', '面接日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));
        $fieldset -> add('interview_month_to', '面接日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));
        $fieldset -> add('interview_day_to', '面接日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));

        //店舗
        $shop_select = '<optgroup label="全て選択">';
        foreach ($this->masterData["interviewshop"] as $key => $value) {
            if ($value !== reset($this->masterData["interviewshop"])) {
                $shop_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $shop_select .= '</optgroup>';

        //掲載求人
        $media_select = '<optgroup label="全て選択">';
        foreach ($this->masterData["media"] as $key => $value) {
            if ($value !== reset($this->masterData["media"])) {
                $media_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $media_select .= '</optgroup>';

        if(Input::get('search') === "1"){
            $search = Input::get();
            $result = Analyze_Divide::get_divide($search);
            $this->set_safe( "result", $result );
        }

        if(Input::get('shop_hidden')){
            $shop_array = explode(",", Input::get('shop_hidden'));
            foreach ($shop_array as $key => $value) {
                $select_shop_array[$value] = $this->masterData["interviewshop"][$value];
            }
            $this->masterData["shop"] = $select_shop_array;
        }

        if(Input::get('recruit_hidden')){
            $recruit_array = explode(",", Input::get('recruit_hidden'));
            foreach ($recruit_array as $key => $value) {
                $media_array[$value] = $this->masterData["media"][$value];
            }
            $this->masterData["media"] = $media_array;
        }

        $date = explode('-', date("Y-m-d"));
//        $default["submission_year_from"] = $date[0];
//        $default["submission_month_from"] = $date[1];
//        $default["submission_year_to"] = $date[0];
//        $default["submission_month_to"] = $date[1];
        $default["interview_year_from"] = $date[0];
        $default["interview_month_from"] = $date[1];
        $default["interview_year_to"] = $date[0];
        $default["interview_month_to"] = $date[1];
        
        $fieldset->populate($default);

        $this->set_safe( 'forms', $fieldset->getFormElements() );
        $this->set_safe( "shop_select", $shop_select );
        $this->set_safe( "media_select", $media_select );
        $this->set_safe( "masterData[media]", $this->masterData["media"] );
    }

    public function branch()
    {
        $this->title = "集計 他店紹介";

        $fieldset = Fieldsetplus::forge();

        $fieldset -> add('interview_year_from', '面接日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_month_from', '面接日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_day_from', '面接日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_year_to', '面接日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_month_to', '面接日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_day_to', '面接日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));

        //掲載求人
        $another_shop_select = '<optgroup label="全て選択">';
        foreach ($this->masterData["another_shop"] as $key => $value) {
            if ($value !== reset($this->masterData["another_shop"])) {
                $another_shop_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $another_shop_select .= '</optgroup>';

        if(Input::get('search') === "1"){
            $search = Input::get();
            $result = Analyze_Branch::get_branch($search);
            $this->set_safe( "result", $result );
        }

        $date = explode('-', date("Y-m-d"));
        $default["interview_year_from"] = $date[0];
        $default["interview_month_from"] = $date[1];
        $default["interview_year_to"] = $date[0];
        $default["interview_month_to"] = $date[1];

        $fieldset->populate($default);

        $this->set_safe( 'forms', $fieldset->getFormElements() );
        $this->set_safe( "another_shop_select", $another_shop_select );
    }

    public function peas()
    {
        $this->title = "集計 ニコイチ";

        $fieldset = Fieldsetplus::forge();

        $fieldset -> add('interview_year_from', '面接日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_month_from', '面接日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_day_from', '面接日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_year_to', '面接日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_month_to', '面接日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_day_to', '面接日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));

        if(Input::get('search') === "1"){
            $search = Input::get();
            $result = Analyze_Peas::get_peas($search);
            $this->set_safe( "result", $result );
//            if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($result);
        }

        $date = explode('-', date("Y-m-d"));
        $default["interview_year_from"] = $date[0];
        $default["interview_month_from"] = $date[1];
        $default["interview_year_to"] = $date[0];
        $default["interview_month_to"] = $date[1];

        $fieldset->populate($default);

        $this->set_safe( 'forms', $fieldset->getFormElements() );

    }

    public function emigrate()
    {
        $this->title = "集計 出稼ぎ";

        $fieldset = Fieldsetplus::forge();

        $fieldset -> add('interview_year_from', '面接日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_month_from', '面接日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_day_from', '面接日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_year_to', '面接日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_month_to', '面接日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_day_to', '面接日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));

        if(Input::get('search') === "1"){
            $search = Input::get();
            $result = Analyze_Emigrate::get_emigrate($search);
            $this->set_safe( "result", $result );
        }

        if(Input::get('select_result_hidden')){
            $data_array = explode(",", Input::get('select_result_hidden'));
            foreach ($data_array as $key => $value) {
                $interview_result_array[$value] = $this->setting_data["interview_result"][$value];
            }
            $this->setting_data["interview_result"] = $interview_result_array;
        }

        $date = explode('-', date("Y-m-d"));
        $default["interview_year_from"] = $date[0];
        $default["interview_month_from"] = $date[1];
        $default["interview_year_to"] = $date[0];
        $default["interview_month_to"] = $date[1];

        $fieldset->populate($default);

        $this->set_safe( 'forms', $fieldset->getFormElements() );
    }

    public function recruit()
    {
        $this->title = "集計 入店率";

        $fieldset = Fieldsetplus::forge();

        $fieldset -> add('interview_year_from', '面接日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_month_from', '面接日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_day_from', '面接日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_year_to', '面接日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_month_to', '面接日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_day_to', '面接日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));

        //掲載業種
        $genre_select = '<optgroup label="全て選択">';
        foreach ($this->masterData["genre"] as $key => $value) {
            if ($value !== reset($this->masterData["genre"])) {
                $genre_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $genre_select .= '</optgroup>';

        if(Input::get('search') === "1"){
            $search = Input::get();
            $result = Analyze_Recruit::get_recruit($search);
            $this->set_safe( "result", $result );
        }

        $date = explode('-', date("Y-m-d"));
        $default["interview_year_from"] = $date[0];
        $default["interview_month_from"] = $date[1];
        $default["interview_year_to"] = $date[0];
        $default["interview_month_to"] = $date[1];

        $fieldset->populate($default);

        $this->set_safe( 'forms', $fieldset->getFormElements() );
        $this->set_safe( "genre_select", $genre_select );
//        $this->set_safe( "interview_staff_select", $interview_staff_select );
    }

    public function recruit_tantou()
    {
        $this->title = "集計 入店率";

        $fieldset = Fieldsetplus::forge();

        $fieldset -> add('interview_year_from', '面接日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_month_from', '面接日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_day_from', '面接日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_year_to', '面接日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_month_to', '面接日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_day_to', '面接日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));

        //掲載業種
        $genre_select = '<optgroup label="全て選択">';
        foreach ($this->masterData["genre"] as $key => $value) {
            if ($value !== reset($this->masterData["genre"])) {
                $genre_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $genre_select .= '</optgroup>';

        //面接担当
        $interview_staff_select = '<optgroup label="全て選択">';
        foreach ($this->masterData["staff_print"] as $key => $value) {
            if ($value !== reset($this->masterData["staff_print"])) {
                $interview_staff_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $interview_staff_select .= '</optgroup>';

        if(Input::get('search') === "1"){
            $search = Input::get();
            $result = Analyze_Recruit_Tantou::get_recruit_tantou($search);
            $this->set_safe( "result", $result );

            $select_staff_array = array();
            if($search['select_staff_hidden']) {
                $select_staff_array = explode(',', $search['select_staff_hidden']);
            }

            $this->set_safe( "select_staff_array", $select_staff_array );
        }

        $date = explode('-', date("Y-m-d"));
        $default["interview_year_from"] = $date[0];
        $default["interview_month_from"] = $date[1];
        $default["interview_year_to"] = $date[0];
        $default["interview_month_to"] = $date[1];

        $fieldset->populate($default);

        $this->set_safe( 'forms', $fieldset->getFormElements() );
        $this->set_safe( "genre_select", $genre_select );
        $this->set_safe( "interview_staff_select", $interview_staff_select );
    }

    public function keep()
    {
        $this->title = "集計 継続率";

        $fieldset = Fieldsetplus::forge();

//        $fieldset -> add('entershop_year_from', '入店日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));
//
//        $fieldset -> add('entershop_month_from', '入店日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));
//
//        $fieldset -> add('entershop_day_from', '入店日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));
//
//        $fieldset -> add('entershop_year_to', '入店日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));
//
//        $fieldset -> add('entershop_month_to', '入店日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));
//
//        $fieldset -> add('entershop_day_to', '入店日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));

        // 以前あった『入店日』の変わりの『面接予定日』に変更処理　2019.03.11
        $fieldset -> add('interview_year_from', '面接日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_month_from', '面接日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_day_from', '面接日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_year_to', '面接日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_month_to', '面接日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_day_to', '面接日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));

        //掲載業種
        $genre_select = '<optgroup label="全て選択">';
        foreach ($this->masterData["genre"] as $key => $value) {
            if ($value !== reset($this->masterData["genre"])) {
                $genre_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $genre_select .= '</optgroup>';

        if(Input::get('search') === "1"){
            $search = Input::get();
            $result = Analyze_Keep::get_keep($search);
            $this->set_safe( "result", $result );
        }

        $date = explode('-', date("Y-m-d"));
//        $default["entershop_year_from"] = $date[0];
//        $default["entershop_month_from"] = $date[1];
//        $default["entershop_year_to"] = $date[0];
//        $default["entershop_month_to"] = $date[1];

        // 以前あった『入店日』の変わりの『面接予定日』に変更処理　2019.03.11
        $default["interview_year_from"] = $date[0];
        $default["interview_month_from"] = $date[1];
        $default["interview_year_to"] = $date[0];
        $default["interview_month_to"] = $date[1];

        $fieldset->populate($default);

        $this->set_safe( 'forms', $fieldset->getFormElements() );
        $this->set_safe( "genre_select", $genre_select );
    }

    public function keep_tantou()
    {
        $this->title = "集計 継続率";

        $fieldset = Fieldsetplus::forge();

//        $fieldset -> add('entershop_year_from', '入店日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));
//
//        $fieldset -> add('entershop_month_from', '入店日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));
//
//        $fieldset -> add('entershop_day_from', '入店日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));
//
//        $fieldset -> add('entershop_year_to', '入店日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));
//
//        $fieldset -> add('entershop_month_to', '入店日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));
//
//        $fieldset -> add('entershop_day_to', '入店日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));

        // 以前あった『入店日』の変わりの『面接予定日』に変更処理　2019.03.11
        $fieldset -> add('interview_year_from', '面接日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_month_from', '面接日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_day_from', '面接日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_year_to', '面接日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_month_to', '面接日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_day_to', '面接日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));

        //掲載業種
        $genre_select = '<optgroup label="全て選択">';
        foreach ($this->masterData["genre"] as $key => $value) {
            if ($value !== reset($this->masterData["genre"])) {
                $genre_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $genre_select .= '</optgroup>';

        //面接担当
        $interview_staff_select = '<optgroup label="全て選択">';
        foreach ($this->masterData["staff_print"] as $key => $value) {
            if ($value !== reset($this->masterData["staff_print"])) {
                $interview_staff_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $interview_staff_select .= '</optgroup>';

        if(Input::get('search') === "1"){
            $search = Input::get();
            $result = Analyze_Keep_Tantou::get_keep_tantou($search);
            $this->set_safe( "result", $result );

            $select_staff_array = array();
            if($search['select_staff_hidden']) {
                $select_staff_array = explode(',', $search['select_staff_hidden']);
            }

            $this->set_safe( "select_staff_array", $select_staff_array );
        }

        $date = explode('-', date("Y-m-d"));
//        $default["entershop_year_from"] = $date[0];
//        $default["entershop_month_from"] = $date[1];
//        $default["entershop_year_to"] = $date[0];
//        $default["entershop_month_to"] = $date[1];

        // 以前あった『入店日』の変わりの『面接予定日』に変更処理　2019.03.11
        $default["interview_year_from"] = $date[0];
        $default["interview_month_from"] = $date[1];
        $default["interview_year_to"] = $date[0];
        $default["interview_month_to"] = $date[1];

        $fieldset->populate($default);

        $this->set_safe( 'forms', $fieldset->getFormElements() );
        $this->set_safe( "genre_select", $genre_select );
        $this->set_safe( "interview_staff_select", $interview_staff_select );
    }

    public function time()
    {
        $this->title = "集計 申込時間";

        $fieldset = Fieldsetplus::forge();

        $fieldset -> add('submission_year_from', '申込日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_month_from', '申込日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_day_from', '申込日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_year_to', '申込日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_month_to', '申込日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_day_to', '申込日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));

        //掲載媒体
        $publicity_select = '<optgroup label="全て選択">';
        foreach ($this->masterData["publicity"] as $key => $value) {
            if ($value !== reset($this->masterData["publicity"])) {
                $publicity_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $publicity_select .= '</optgroup>';

        //掲載求人
        $media_select = '<optgroup label="全て選択">';
        foreach ($this->masterData["media"] as $key => $value) {
            if ($value !== reset($this->masterData["media"])) {
                $media_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $media_select .= '</optgroup>';

        if(Input::get('search') === "1"){
            $search = Input::get();
            $result = Analyze_Time::get_time($search);
            $this->set_safe( "result", $result );
        }

        if(Input::get('recruit_hidden')){
            $this->masterData["media"] = call_user_func(function($media_hidden, $media) {
                $media_array = array();
                foreach ($media_hidden as $key => $value) {
                    $media_array[$value] = $media[$value];
                }
                return $media_array;
            }, explode(",", Input::get('recruit_hidden')), $this->masterData["media"]);
        }

        if(Input::get('media_hidden')){
            $this->masterData["publicity"] = call_user_func(function($publicity_hidden, $media) {
                $publicity_array = array();
                foreach ($publicity_hidden as $key => $value) {
                    $publicity_array[$value] = $media[$value];
                }
                return $publicity_array;
            }, explode(",", Input::get('media_hidden')), $this->masterData["publicity"]);
        }

        $date = explode('-', date("Y-m-d"));
        $default["submission_year_from"] = $date[0];
        $default["submission_month_from"] = $date[1];
        $default["submission_year_to"] = $date[0];
        $default["submission_month_to"] = $date[1];

        $fieldset->populate($default);

        $this->set_safe( 'forms', $fieldset->getFormElements() );
        $this->set_safe( "publicity_select", $publicity_select );
        $this->set_safe( "media_select", $media_select );

    }

    public function area()
    {
        $this->title = "集計 広告掲載エリア";

        $fieldset = Fieldsetplus::forge();

        $fieldset -> add('submission_year_from', '申込日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_month_from', '申込日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_day_from', '申込日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_year_to', '申込日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_month_to', '申込日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_day_to', '申込日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));

        //掲載媒体
        $publicity_select = '<optgroup label="全て選択">';
        foreach ($this->masterData["publicity"] as $key => $value) {
            if ($value !== reset($this->masterData["publicity"])) {
                $publicity_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $publicity_select .= '</optgroup>';

        //掲載求人
        $media_select = '<optgroup label="全て選択">';
        foreach ($this->masterData["media"] as $key => $value) {
            if ($value !== reset($this->masterData["media"])) {
                $media_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $media_select .= '</optgroup>';

        if(Input::get('search') === "1"){
            $search = Input::get();
            $result = Analyze_Area::get_area($search);
            $this->set_safe( "result", $result );
        }

        $date = explode('-', date("Y-m-d"));
        $default["submission_year_from"] = $date[0];
        $default["submission_month_from"] = $date[1];
        $default["submission_year_to"] = $date[0];
        $default["submission_month_to"] = $date[1];

        $fieldset->populate($default);

        $this->set_safe( 'forms', $fieldset->getFormElements() );
        $this->set_safe( "publicity_select", $publicity_select );
        $this->set_safe( "media_select", $media_select );

    }

    public function word()
    {
        $this->title = "集計 検索ワード";

        $fieldset = Fieldsetplus::forge();

//        $fieldset -> add('entershop_year_from', '入店日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));
//
//        $fieldset -> add('entershop_month_from', '入店日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));
//
//        $fieldset -> add('entershop_day_from', '入店日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));
//
//        $fieldset -> add('entershop_year_to', '入店日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));
//
//        $fieldset -> add('entershop_month_to', '入店日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));
//
//        $fieldset -> add('entershop_day_to', '入店日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));

        // 以前あった『入店日』の変わりの『面接予定日』に変更処理　2019.03.11
        $fieldset -> add('interview_year_from', '入店日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_month_from', '入店日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_day_from', '入店日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_year_to', '入店日(年)', array('options' => $this->setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_month_to', '入店日(月)', array('options' => $this->setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_day_to', '入店日(日)', array('options' => $this->setting_data["day"], 'type' => 'select', 'value' => ''));

//        //掲載業種
//        $fieldset -> add('genre', '掲載業種', array('options' => $this->masterData["genre"], 'type' => 'select', 'value' => '', 'required' => 'required', 'id' => 'select_genre', 'style' => 'width: 210px'));
        //掲載業種
        $genre_select = '<optgroup label="全て選択">';
        foreach ($this->masterData["genre"] as $key => $value) {
            if ($value !== reset($this->masterData["genre"])) {
                $genre_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $genre_select .= '</optgroup>';


        if(Input::get('search') === "1"){
            $search = Input::get();
            $result = Analyze_Word::get_word($search);
            $this->set_safe( "result", $result );
        }

        $date = explode('-', date("Y-m-d"));
//        $default["entershop_year_from"] = $date[0];
//        $default["entershop_month_from"] = $date[1];
//        $default["entershop_year_to"] = $date[0];
//        $default["entershop_month_to"] = $date[1];

        // 以前あった『入店日』の変わりの『面接予定日』に変更処理　2019.03.11
        $default["interview_year_from"] = $date[0];
        $default["interview_month_from"] = $date[1];
        $default["interview_year_to"] = $date[0];
        $default["interview_month_to"] = $date[1];

        $fieldset->populate($default);

        $this->set_safe( 'forms', $fieldset->getFormElements() );
        $this->set_safe( "genre_select", $genre_select );

    }
}
