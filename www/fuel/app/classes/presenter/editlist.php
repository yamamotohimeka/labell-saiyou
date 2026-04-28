<?php
use \Model\Inputdata;
use \Model\Editlist;
/**
 * The welcome hello presenter.
 *
 * @package  app
 * @extends  Presenter
 */
class Presenter_Editlist extends Presenter
{
	/**
	 * Prepare the view data, keeping this in here helps clean up
	 * the controller.
	 *
	 * @return void
	 */
	public function view()
	{
        $this->title = "編集中リスト";
        $setting_data = Config::get('setting', array());
        $masterData = Inputdata::get_select_data($setting_data);

        $result = Editlist::get_data();

        foreach ($result as $key => $value) {
            if(isset($masterData['media'][$value['media']])){
                $result[$key]['media'] = $masterData['media'][$value['media']];
            }else{
                $result[$key]['media'] = "";
            }

        }
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r( $result );

        $this->set_safe( "result", $result );
	}
}
