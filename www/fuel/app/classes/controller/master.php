<?php
use \Model\Common;
use \Model\Master;
use \Model\Inputdata;

class Controller_Master extends Controller_Frontbase
{
    public function action_index(){
        $title = 'マスタ登録';

        $view = View_Smarty::forge( 'master/master_list' );
        $prtData = $view->set_safe( "title", $title );
        $view->set_safe( "userData", $this->userData );
        return Response::forge($view);
    }

    public function action_list($page){

        $setting_data = Config::get('setting', array());
        $master = Inputdata::get_select_data($setting_data);

//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) var_dump($master);

        $filters = array('strip_tags', 'htmlentities', 'urlencode');
        $page = Security::clean($page, $filters);

        $title = $this->get_master_title($page);

        $table = 'master_' . $page;

        $addjs = "";

        //確認状況マスタは廃止
        if($page === "check"){
            Response::redirect("/master");
        }

        if($page === "staff"){
            $where = "WHERE hidden = 0";
            if(Input::get("display")){
                $where = "WHERE hidden = " . Input::get("display");
            }

            $masterData = Common::get_data("SELECT id, username, `group`, password, email, profile_fields FROM login_users $where ORDER BY namekana ASC, username ASC");

//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($masterData);

            foreach ($masterData as $key => $value) {
                $masterData[$key]["profile_fields"] = unserialize($value["profile_fields"]);
            }

        }else{
            $masterData = Master::get_data($table);
        }

        if(Input::post('submit')){

            $id = Input::post('id');

            $check_result = Master::check_delete($page, $id);

            if($page === "staff"){
                $username = Common::get_data("SELECT username FROM login_users WHERE id = $id", "one");
                Auth::delete_user($username);

                Response::redirect("/master/list/$page");
            }else{

                if($check_result === 0){
                    Master::delete($table, $id);
                    Response::redirect("/master/list/$page");
                }else{
                    $addjs =<<<EOD
        var options = {
            title: "選択したデータが使われている為、削除出来ません"
        };

        swal(options)
            .then(function(val){
                    if(val === true){
                    location.href = "";
                    }
                    });
EOD;

                }

            }
        }

        if(Input::post('submit_sort') AND Input::post('sort')){
            $sort_data = explode(",", Input::post('sort'));

            foreach ($sort_data as $key => $value) {
                Common::set_data(array("sort" => $key + 1), $value, Input::post('sort_master'));
            }

            Response::redirect("/master/list/$page");
        }

        $view = View_Smarty::forge( "master/{$page}_list" );
        $prtData = $view->set_safe( "title", $title );
        $prtData = $view->set_safe( "masterData", $masterData );
        $prtData = $view->set_safe( "master", $master );
        $prtData = $view->set_safe( "addjs", $addjs );
        $view->set_safe( "userData", $this->userData );

        return Response::forge($view);
    }

    public function action_form($page ,  $id = null){

        $setting_data = Config::get('setting', array());
        $master = Inputdata::get_select_data($setting_data);

        $filters = array('strip_tags', 'htmlentities', 'urlencode');
        $page = Security::clean($page, $filters);

        $title = $this->get_master_title($page);

        $table = 'master_' . $page;
        $masterData = '';

        $fieldset = Fieldsetplus::forge();

        if(isset($id)){
            $result = Master::get_rowdata($table, $id);
            $masterData = array_shift($result);
        }

        $config= array('action' => "", 'enctype' => 'multipart/form-data');

        if(Input::post('submit')){
            $result = Master::set_data(Input::post(), $id, $table);

            if($result == "error"){
                Response::redirect("/master/form/$page/$id?error=名前が重複しています");
            }else{
                Response::redirect("/master/list/$page");
            }
        }

        $view = View_Smarty::forge( "master/{$page}_form" );
        $prtData = $view->set_safe( "title", $title );
        $prtData = $view->set_safe( "id", $id );
        $prtData = $view->set_safe( "masterData", $masterData );
        $prtData = $view->set_safe( "master", $master );
        $prtData = $view->set_safe( 'forms', $fieldset->getFormElements($config) );
        $view->set_safe( "userData", $this->userData );

        return Response::forge($view);
    }

    public function action_staffform($page ,  $id = null){
        $setting_data = Config::get('setting', array());
        $masterData = Inputdata::get_select_data($setting_data);

        $filters = array('strip_tags', 'htmlentities', 'urlencode');
        $page = Security::clean($page, $filters);

        $title = $this->get_master_title($page);

        $table = 'master_' . $page;
        $staffData = '';

        $fieldset = Fieldsetplus::forge();

        $fieldset->add('maildomain', 'メールドメイン',
            array('options' => $masterData["maildomain"], 'type' => 'select', 'value' => ''));

        if(isset($id)){
            $result = Common::get_data("SELECT username, password, `group`, hidden, email, profile_fields FROM login_users WHERE id = $id");

            $staffData = array_shift($result);

            if(isset($staffData["profile_fields"])){
                $staffData["profile_fields"] = unserialize($staffData["profile_fields"]);
            }

            if(isset($staffData["profile_fields"]["name"])) {
                $staffData["name"] = $staffData["profile_fields"]["name"];
            }

            if(isset($staffData["profile_fields"]["namekana"])) {
                $staffData["namekana"] = $staffData["profile_fields"]["namekana"];
            }

            if(isset($staffData["profile_fields"]["sender"])) {
                $staffData["sender"] = $staffData["profile_fields"]["sender"];
            }

            $email = explode("@", $staffData["email"]);

            if(isset($staffData)){
                $fieldset->populate( array('maildomain' => $email[1] ));
            }
        }

        $config= array('action' => "", 'enctype' => 'multipart/form-data');

        $message = "";
        if(Input::post('submit')){
            if($page === "staff") {

                $emailAddress = Input::post("mailaddress") . "@" . Input::post("maildomain");

                $userData = array(
                    'name' => Input::post("name"),
                    'namekana' => Input::post("nameKana"),
                    'sender' => Input::post('sender')
                );

                if(!isset($id)) {
                    try {
                        $username = Input::post("name");
                        $password = Input::post('password');

                        $res = Auth::create_user(
                            $username,
                            $password,
                            $emailAddress,
                            Input::post('group'),
                            $userData
                        );

                        $sort = Common::get_data("SELECT count(id) FROM login_users LIMIT 1", "one");
                        Common::set_data( array("sort" => $sort, "hidden" => Input::post('hidden'), 'namekana' => Input::post("nameKana")), $res, "login_users" );

                        Response::redirect("/master/list/$page");

                    } catch (Exception $e) {
                        if ($e->getMessage() === "Email address already exists") {
                            $message = "入力されたEメールは既に登録されています。";
                        } else {
                            $message = $e->getMessage();
                        }
                    }
                }else{
                    try {
                        $userData = serialize($userData);

                        $data_array = array(
                            'namekana' => Input::post("nameKana"),
                            'email' => $emailAddress,
                            'group' => Input::post('group'),
                            'hidden' => Input::post('hidden'),
                            'profile_fields' => $userData
                        );

                        Common::set_data( $data_array, $id, "login_users" );

                        Response::redirect("/master/list/$page");

                    } catch (Exception $e) {
                        if ($e->getMessage() === "Email address already exists") {
                            $message = "入力されたEメールは既に登録されています。";
                        } else {
                            $message = $e->getMessage();
                        }
                    }
                }
            }
        }

        $view = View_Smarty::forge( "master/{$page}_form" );
        $prtData = $view->set_safe( "title", $title );
        $prtData = $view->set_safe( "id", $id );
        $prtData = $view->set_safe( "staffData", $staffData );
        $prtData = $view->set_safe( 'forms', $fieldset->getFormElements($config) );
        $prtData = $view->set_safe( "message", $message );
        $view->set_safe( "userData", $this->userData );

        return Response::forge($view);
    }

    public function get_master_title($page){
        $setting_data = Config::get('setting', array());

        if(!empty($setting_data['master_page'][$page])){
            $title = $setting_data['master_page'][$page] . '｜マスター登録';
        }else{
            Response::redirect("/master/");
        }

        return $title;
    }

    public function action_reminder($mail = null){

        $fieldset = Fieldsetplus::forge();

//        $fieldset->add( 'email', 'メールアドレス', array('class' => 'login-inp', 'size' => '50') )->add_rule( 'required' );

        $fieldset->add('submit', '', array( 'type' => 'submit', 'value' => '送信', 'class' => 'submit-login btn_orange btn_normal', 'id' => 'form_submits' ));

//        if(Input::get("mail")){
//            $fieldset->populate( array('email' => Input::get("mail")) );
//        }
        if(Input::get("mail")){
            $email = Input::get("mail");
            $sql = "SELECT * FROM login_users WHERE email = '$email' LIMIT 1";
            $user = Common::get_data( $sql );
//            if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($user);
        }


        $view = View_Smarty::forge( 'master/staffform/reminder' );

        $prtData = $view->set_safe( 'forms', $fieldset->getFormElements('master/lostpassword') );

        $setting_data = Config::get('setting', array());
        $view->set_safe( "master_mail", $setting_data['master_mail'] );
        $view->set_safe( "email", $email );
        $view->set_safe( "username", $user[0]['username'] );
        $view->set_safe( "userData", $this->userData );

        return Response::forge($prtData);
    }


    public function action_lostpassword($hash = null){

        // was the lostpassword form posted?
        if (\Input::method() == 'POST')
        {


            // do we have a posted email address?
            if ($email = \Input::post('email'))
            {
                $sql = "SELECT * FROM login_users WHERE email = '$email' LIMIT 1";

                $user = Common::get_data( $sql );

                // do we know this user?
                if (isset($user))
                {

                    $auth = Auth::instance();

                    // generate a recovery hash
                    $hash = $auth->instance()->hash_password(\Str::random()).$user[0]["id"];


                    // and store it in the user profile
                    $auth->update_user(
                        array(
                            'lostpassword_hash' => $hash,
                            'lostpassword_created' => time()
                        ),
                        $user[0]["username"]
                    );

                    // send an email out with a reset link
                    \Package::load('email');
                    $email = \Email::forge();

                    $email->html_body(View_Smarty::forge('master/staffform/lostpassword.tpl', array('url' => \Uri::create('master/lostpassword/' . base64_encode($hash) . '/'), 'user' => $user), false));

                    // give it a subject
                    $email->subject('【HeadOffice】パスワード再設定のご案内');

                    $email->from('info@re.sp-labelle.com', 'HeadOffice');
//                    $email->to($user[0]["email"], $user[0]["username"]);

                    // マスターメールへ送信
                    $setting_data = Config::get('setting', array());
                    $email->to($setting_data['master_mail'], $user[0]["username"]);


                    // and off it goes (if all goes well)!
                    try
                    {
                        // send the email
                        $email->send();
                    }

                        // this should never happen, a users email was validated, right?
                    catch(\EmailValidationFailedException $e)
                    {
//                        \Messages::error(__('login.invalid-email-address'));
                        \Response::redirect_back();
                    }

                        // what went wrong now?
                    catch(\Exception $e)
                    {
                        // log the error so an administrator can have a look
                        logger(\Fuel::L_ERROR, '*** Error sending email ('.__FILE__.'#'.__LINE__.'): '.$e->getMessage());

//                        \Messages::error(__('login.error-sending-email'));
                        \Response::redirect_back();
                    }
                }
            }

            // posted form, but email address posted?
            else
            {
                // inform the user and fall through to the form
//                \Messages::error(__('login.error-missing-email'));
            }

            // inform the user an email is on the way (or not ;-))
//            \Messages::info(__('login.recovery-email-send'));
            \Response::redirect_back();
        }

        // no form posted, do we have a hash passed in the URL?
        elseif ($hash !== null)
        {

            $hash = base64_decode($hash);
            // get the userid from the hash
            $user = substr($hash, 44);

            if(isset($user)){
                $sql = "SELECT * FROM login_users WHERE id = $user LIMIT 1";
                $userdata = Common::get_data( $sql );
            }


            $profile = unserialize($userdata[0]['profile_fields']);

            if (isset($userdata))
            {
                if (isset($profile['lostpassword_hash']) and $profile['lostpassword_hash'] == $hash and time() - $profile['lostpassword_created'] < 86400)
                {



                    $fieldset = Fieldsetplus::forge();

                    $fieldset->add( 'password', '新パスワード', array('class' => 'login-inp') )->add_rule( 'required' );

                    $fieldset->add('submit', '', array( 'type' => 'submit', 'value' => '送信', 'class' => 'submit-login btn_orange btn_normal', 'id' => 'form_submits' ));

                    $view = View_Smarty::forge( 'master/staffform/newpassword' );

                    $prtData = $view->set_safe( 'forms', $fieldset->getFormElements("master/newpassword/" . base64_encode($hash)) );

                    return Response::forge($prtData);
                }
            }


        }

        else
        {
            \Response::redirect_back();
        }
    }

    public function action_newpassword($hash = null){

        if (\Input::method() == 'POST')
        {
            $hash = base64_decode($hash);
            // get the userid from the hash
            $user = substr($hash, 44);

            if(isset($user)){
                $sql = "SELECT * FROM login_users WHERE id = $user LIMIT 1";

                $userdata = Common::get_data( $sql );

                $auth = Auth::instance();

                $old_password = $auth->reset_password($userdata[0]['username']);

                $new_password = \Input::post('password');

                $result = $auth->update_user(
                    array(
                        'password'     => $new_password,
                        'old_password' => $old_password,
                        'lostpassword_hash' => null,
                        'lostpassword_created' => null
                    ),
                    $userdata[0]["username"]
                );

            }

//            Response::redirect('/master/staffform/staff/');
            Response::redirect('/login/logout/');
        }

    }
}
