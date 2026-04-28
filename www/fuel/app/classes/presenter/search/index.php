<?php
use \Model\Inputdata;
use \Model\Search;
/**
 * The welcome hello presenter.
 *
 * @package  app
 * @extends  Presenter
 */
class Presenter_Search_Index extends Presenter
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

//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($masterData);

        $fieldset = Fieldsetplus::forge();

        $fieldset -> add('submission_year_from', '申込日(年)', array('options' => $setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_month_from', '申込日(月)', array('options' => $setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_day_from', '申込日(日)', array('options' => $setting_data["day"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_year_to', '申込日(年)', array('options' => $setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_month_to', '申込日(月)', array('options' => $setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_day_to', '申込日(日)', array('options' => $setting_data["day"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_hour_from', '申込時間(時)', array('options' => $setting_data["hour"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('submission_hour_to', '申込時間(時)', array('options' => $setting_data["hour"], 'type' => 'select', 'value' => ''));

        $fieldset -> add( 'submission_name', '申込名', array('class' => 'input_name') );

        $fieldset -> add('interview_year_from', '面接予定日(年)', array('options' => $setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_month_from', '面接予定日(月)', array('options' => $setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_day_from', '面接予定日(日)', array('options' => $setting_data["day"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_year_to', '面接予定日(年)', array('options' => $setting_data["year"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_month_to', '面接予定日(月)', array('options' => $setting_data["month"], 'type' => 'select', 'value' => ''));

        $fieldset -> add('interview_day_to', '面接予定日(日)', array('options' => $setting_data["day"], 'type' => 'select', 'value' => ''));

        // 面接店舗
        $shop_select = '<optgroup label="全て選択">';
        foreach ($masterData["interviewshop"] as $key => $value) {
            if ($value !== reset($masterData["interviewshop"])) {
                $shop_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $shop_select .= '</optgroup>';

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


        $fieldset -> add( 'genji_name', '源氏名', array('name' => 'other','size' => '14') );

        $fieldset -> add( 'genji_namekana', '源氏名（かな）', array('name' => 'other','size' => '14') );

        $fieldset -> add( 'search_id', 'ID', array('name' => 'other','size' => '3') );

        $fieldset -> add( 'surname', '姓', array('name' => 'other','size' => '13') );

        $fieldset -> add( 'name', '名', array('name' => 'other','size' => '13') );

        $fieldset -> add( 'surnamekana', '姓（ふりがな）', array('name' => 'other','size' => '13') );

        $fieldset -> add( 'namekana', '名（ふりがな）', array('name' => 'other','size' => '13') );

        $fieldset -> add( 'age_from', '年齢', array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'age', 'size' => '3') );

        $fieldset -> add( 'age_to', '年齢', array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'age', 'size' => '3') );

        $fieldset -> add( 'tall_from', '身長', array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'tall', 'size' => '4') );

        $fieldset -> add( 'tall_to', '身長', array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'tall', 'size' => '4') );

        $fieldset -> add( 'weight_from', '体重', array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'weight', 'size' => '4') );

        $fieldset -> add( 'weight_to', '体重', array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'weight', 'size' => '4') );

        $fieldset -> add( 'bust_from', 'バスト', array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'bust', 'size' => '4') );

        $fieldset -> add( 'bust_to', 'バスト', array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'bust', 'size' => '4') );

//        $fieldset -> add('cup_from', 'カップ数', array('options' => $setting_data["cup_data"], 'type' => 'select', 'value' => ''));
//
//        $fieldset -> add('cup_to', 'カップ数', array('options' => $setting_data["cup_data"], 'type' => 'select', 'value' => ''));

        $cup_select = '<optgroup label="全て選択">';
        foreach ($setting_data["cup_data"] as $key => $value) {
            if ($value !== reset($setting_data["cup_data"])) {
                $cup_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $cup_select .= '</optgroup>';


        $experience_select = '';
        foreach ($masterData["experience"] as $key => $value) {
            if($key != ""){
                $experience_select .= "<option value=\"{$key}\">{$value}</option>";
            }
        }

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

        // 面接前確認
        $check_select = '<optgroup label="全て選択">';
        foreach ($masterData["check"] as $key => $value) {
            if ($value !== reset($masterData["check"])) {
                $check_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $check_select .= '</optgroup>';


        $fieldset -> add( 'address', '住所', array('name' => 'other','size' => '75') );

        $person_select = '';

        foreach ($masterData["person"] as $key => $value) {
            if($key != ""){
                $person_select .= "<option value=\"{$key}\">{$value}</option>";
            }

        }

        $fieldset -> add( 'tel01', 'TEL', array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'tel01', 'size' => '2') );

        $fieldset -> add( 'tel02', 'TEL', array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'tel02', 'size' => '2') );

        $fieldset -> add( 'tel03', 'TEL', array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'tel03', 'size' => '2') );

        $fieldset -> add( 'mail01', 'Mail', array('pattern' => '^[a-z0-9._%+-]+$', 'title' => '半角数字でご入力ください。', 'name' => 'mail01', 'size' => '18') );

        $fieldset -> add('maildomain', 'メールドメイン', array('options' => $masterData["maildomain"], 'type' => 'select', 'value' => ''));

        //掲載求人
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

//        $fieldset -> add('interview_staff_sub', '面接担当（サブ）', array('options' => $masterData["staff"], 'type' => 'select', 'value' => ''));

//        $fieldset -> add('ks_staff', '面接担当（サブ）', array('options' => $masterData["staff"], 'type' => 'select', 'value' => ''));


//        $fieldset -> add('work', '勤務形態', array('options' => $setting_data["work"], 'type' => 'select', 'value' => '', 'class' => ''));

        $work_select = '<optgroup label="全て選択">';
        foreach ($setting_data["work"] as $key => $value) {
            if ($value !== reset($setting_data["work"])) {
                $work_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $work_select .= '</optgroup>';


        $fieldset -> add( 'salary_from', '給料', array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'salary', 'class' => 'input_saraly') );

        $fieldset -> add( 'salary_to', '給料', array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'salary', 'class' => 'input_saraly') );

        $fieldset -> add( 'nomination_fee_from', '特別指名料', array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'nomination_fee', 'class' => 'input_saraly') );

        $fieldset -> add( 'nomination_fee_to', '特別指名料', array('pattern' => '^[0-9]+$', 'title' => '半角数字でご入力ください。', 'name' => 'nomination_fee', 'class' => 'input_saraly') );

        $fieldset -> add('leaving_year_from', '退店日(年)', array('options' => $setting_data["year"], 'type' => 'select', 'value' => '', 'class' => ''));

        $fieldset -> add('leaving_month_from', '退店日(月)', array('options' => $setting_data["month"], 'type' => 'select', 'value' => '', 'class' => ''));

        $fieldset -> add('leaving_day_from', '退店日(日)', array('options' => $setting_data["day"], 'type' => 'select', 'value' => '', 'class' => ''));

        $fieldset -> add('leaving_year_to', '退店日(年)', array('options' => $setting_data["year"], 'type' => 'select', 'value' => '', 'class' => ''));

        $fieldset -> add('leaving_month_to', '退店日(月)', array('options' => $setting_data["month"], 'type' => 'select', 'value' => '', 'class' => ''));

        $fieldset -> add('leaving_day_to', '退店日(日)', array('options' => $setting_data["day"], 'type' => 'select', 'value' => '', 'class' => ''));

//        $fieldset -> add('leaving_reason', '退店理由', array('options' => $setting_data["leaving_reason"], 'type' => 'select', 'value' => ''));

        $leaving_reason_select = '<optgroup label="全て選択">';
        foreach ($masterData["leaving_reason"] as $key => $value) {
            if ($value !== reset($masterData["leaving_reason"])) {
                $leaving_reason_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $leaving_reason_select .= '</optgroup>';

//        $fieldset -> add('area', '掲載エリア', array('options' => $masterData["area"], 'type' => 'select', 'value' => ''));

        $area_select = '<optgroup label="全て選択">';
        foreach ($masterData["area"] as $key => $value) {
            if ($value !== reset($masterData["area"])) {
                $area_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $area_select .= '</optgroup>';

//        $fieldset -> add('publicity', '掲載媒体', array('options' => $masterData["publicity"], 'type' => 'select', 'value' => ''));

        $publicity_select = '<optgroup label="全て選択">';
        foreach ($masterData["publicity"] as $key => $value) {
            if ($value !== reset($masterData["publicity"])) {
                $publicity_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $publicity_select .= '</optgroup>';

//        $fieldset -> add('media', '掲載求人', array('options' => $masterData["media"], 'type' => 'select', 'value' => ''));

        $media_select = '<optgroup label="全て選択">';
        foreach ($masterData["media"] as $key => $value) {
            if ($value !== reset($masterData["media"])) {
                $media_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $media_select .= '</optgroup>';

//        $fieldset -> add('genre', '掲載業種', array('options' => $masterData["genre"], 'type' => 'select', 'value' => ''));

        $genre_select = '<optgroup label="全て選択">';
        foreach ($masterData["genre"] as $key => $value) {
            if ($value !== reset($masterData["genre"])) {
                $genre_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $genre_select .= '</optgroup>';

//        $fieldset -> add('scout', 'SC', array('options' => $setting_data["scout"], 'type' => 'select', 'value' => ''));

        $scout_select = '<optgroup label="全て選択">';
        foreach ($setting_data["scout"] as $key => $value) {
            if ($value !== reset($setting_data["scout"])) {
                $scout_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $scout_select .= '</optgroup>';

//        $fieldset -> add('move', '出戻・移籍 etc', array('options' => $masterData["move"], 'type' => 'select', 'value' => ''));

        $move_select = '<optgroup label="全て選択">';
        foreach ($masterData["move"] as $key => $value) {
            if ($value !== reset($masterData["move"])) {
                $move_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $move_select .= '</optgroup>';

//        $fieldset -> add('another_shop', '他店紹介', array('options' => $masterData["another_shop"], 'type' => 'select', 'value' => ''));

        $another_shop_select = '<optgroup label="全て選択">';
        foreach ($masterData["another_shop"] as $key => $value) {
            if ($value !== reset($masterData["another_shop"])) {
                $another_shop_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $another_shop_select .= '</optgroup>';

        $fieldset -> add( 'another_shop_remarks', '備考', array() );


//        $fieldset -> add('word1', '検索ワード', array('options' => $masterData["word"], 'type' => 'select', 'value' => '', 'style' => 'width:150px;'));

        $word_select = '<optgroup label="全て選択">';
        foreach ($masterData["word"] as $key => $value) {
            if ($value !== reset($masterData["word"])) {
                $word_select .=<<<EOD
<option value="{$key}">{$value}</option>
EOD;
            }
        }
        $word_select .= '</optgroup>';


        $search = "";
//        if(Input::get('search') === "1"){
//            $search = Input::get();
//            $fieldset->populate( $search );
//        }
        if(Input::post('search') === "1"){
            $search = Input::post();
            $fieldset->populate( $search );
        }
        Search::get_data($search);


        $submission_date = explode('-', date("Y-m-d"));
        $default["submission_year_from"] = $submission_date[0];
        $default["submission_month_from"] = $submission_date[1];
        $default["interview_year_from"] = $submission_date[0];
        $default["interview_month_from"] = $submission_date[1];

        $fieldset->populate($default);


        $this->set_safe( 'forms', $fieldset->getFormElements() );
        $this->set_safe( "shop_select", $shop_select );
        $this->set_safe( "belonging_store_select", $belonging_store_select );
        $this->set_safe( "cup_select", $cup_select );
        $this->set_safe( "experience_select", $experience_select );
        $this->set_safe( "pref_select", $pref_select );
        $this->set_safe( "check_select", $check_select );
        $this->set_safe( "person_select", $person_select );
        $this->set_safe( "interview_result_select", $interview_result_select );
        $this->set_safe( "interview_staff_select", $interview_staff_select );
        $this->set_safe( "work_select", $work_select );
        $this->set_safe( "leaving_reason_select", $leaving_reason_select );
        $this->set_safe( "publicity_select", $publicity_select );
        $this->set_safe( "area_select", $area_select );
        $this->set_safe( "media_select", $media_select );
        $this->set_safe( "genre_select", $genre_select );
        $this->set_safe( "scout_select", $scout_select );
        $this->set_safe( "move_select", $move_select );
        $this->set_safe( "another_shop_select", $another_shop_select );
        $this->set_safe( "word_select", $word_select );
    }
}
