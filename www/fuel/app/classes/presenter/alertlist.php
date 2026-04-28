<?php
use \Model\Inputdata;
use \Model\Alertlist;
/**
 * The welcome hello presenter.
 *
 * @package  app
 * @extends  Presenter
 */
class Presenter_alertlist extends Presenter
{
	/**
	 * Prepare the view data, keeping this in here helps clean up
	 * the controller.
	 *
	 * @return void
	 */
	public function view()
	{
        $this->title = "アラート";
        $setting_data = Config::get('setting', array());
        $masterData = Inputdata::get_select_data($setting_data);

        $result = Alertlist::get_data();
        unset($result["timer_count"]);

        $fieldset = Fieldsetplus::forge();

//        $masterData["check"] = str_replace('—', 'アラート削除', $masterData["check"]);
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r( $masterData["check"] );
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r( $result );

        $this->set_safe( "Switching_time", $setting_data['Switching_time'] );
        $this->set_safe( "result", $result );
        $this->set_safe( "check", $masterData["check"] );
        $this->set_safe('forms', $fieldset->getFormElements());
	}
}
