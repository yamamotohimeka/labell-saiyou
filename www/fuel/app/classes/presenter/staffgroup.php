<?php
use \Model\Inputdata;
use \Model\Staffgroup;
/**
 * The welcome hello presenter.
 *
 * @package  app
 * @extends  Presenter
 */
class Presenter_Staffgroup extends Presenter
{
	/**
	 * Prepare the view data, keeping this in here helps clean up
	 * the controller.
	 *
	 * @return void
	 */
	public function view()
	{
        $this->title = "グループ";

        $setting_data = Config::get('setting', array());
        $masterData = Inputdata::get_select_data($setting_data);

        // 表示中スタッフと非表示中スタッフの結合
        $masterData['staff'] = $masterData['staff'] + $masterData['staff_hidden'];
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($masterData['staff']);

        $fieldset = Fieldsetplus::forge();

        $fieldset -> add('groupId', 'グループ名', array('options' => $masterData["group"], 'type' => 'select', 'value' => '', 'id' => 'staff_group_select'));

        $default = "";
        if(Input::get('groupId')){
            $result = Staffgroup::get_rowdata(Input::get('groupId'));

            $default = array(
                'groupId' => Input::get('groupId')
            );

            if(!empty($result)){
                $default['group'] = $result[0]['group_data'];
            }

            $fieldset->populate( $default );
        }

        $this->set_safe( 'forms', $fieldset->getFormElements() );
        $this->set_safe( 'staff', $masterData['staff'] );
        $this->set_safe( 'default', $default );
	}

    public function confirm()
    {
        $this->title = "グループ 確認";
        $setting_data = Config::get('setting', array());
        $masterData = Inputdata::get_select_data($setting_data);

        // 表示中スタッフと非表示中スタッフの結合
        $masterData['staff'] = $masterData['staff'] + $masterData['staff_hidden'];

        $group_array = Input::post('group');
        if(!empty($group_array)){
            $group_list = implode(",", $group_array);
            $this->set_safe( 'group_list', $group_list );
        }

        $this->set_safe( 'post_data', Input::post() );
        $this->set_safe( 'masterData', $masterData );
    }
}
