<?php
use \Model\Common;
use \Model\Rank;
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.7
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2013 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * The Welcome Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Frontbase extends Controller
{
    public $usertData;
    public $userId;

	public function before(){

        // IP 制限（ローカル Docker 等では SP_LABELLE_SKIP_ADMIN_IP_CHECK でスキップ）
        $setting_data = Config::get('setting', array());
        $allow_list = isset($setting_data['ipSetArrowList']) ? $setting_data['ipSetArrowList'] : array();
        $skip_ip_check = (bool) getenv('SP_LABELLE_SKIP_ADMIN_IP_CHECK');
        if ( ! $skip_ip_check && ! in_array(Input::ip(), $allow_list, true)) {
            header('Location:https://www.google.com/');
            exit();
        }

        $auth = Auth::instance();


        //ログイン状態の確認
        if( !$auth->check() ){
            if(
                 Uri::segment(2) !== "lostpassword"
             AND Uri::segment(2) !== "newpassword"
            ) {
                //URLリダイレクト
                Response::redirect('/login');
            }
        }

        $this->userId = Auth::get_user_id();
        $id = $this->userId[1];

        $result = Common::get_data("SELECT username, `group`, email, profile_fields FROM login_users WHERE id = $id", "row");

//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) var_dump($result);
        $this->userData["profile_fields"] = unserialize($result["profile_fields"]);
        $this->userData["name"] = $result["profile_fields"]["name"];
        $this->userData["namekana"] = $result["profile_fields"]["namekana"];
        $this->userData["group"] = $result["group"];
    }

}
