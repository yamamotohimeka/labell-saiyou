<?php
use \Model\Common;

class Controller_Login extends Controller
{

    public function before()
    {

        // IP 制限（ローカル Docker 等では SP_LABELLE_SKIP_ADMIN_IP_CHECK でスキップ）
        $setting_data = Config::get('setting', array());
        $allow_list = isset($setting_data['ipSetArrowList']) ? $setting_data['ipSetArrowList'] : array();
        $skip_ip_check = (bool) getenv('SP_LABELLE_SKIP_ADMIN_IP_CHECK');
        if ( ! $skip_ip_check && ! in_array(Input::ip(), $allow_list, true)) {
            header('Location:https://www.google.com/');
            exit();
        }

    }


    /**
	 * 管理システムログインController
	 * @access public
	 * @return Response
	*/
	public function action_index()
	{
		if( !Auth::check() ){

			$fieldset = Fieldsetplus::forge();

			$fieldset	->add( 'loginId', 'ID', array('class' => 'login-inp') )
						->add_rule( 'required' );

			$fieldset	->add( 'password', 'PassWord', array('type' => 'password', 'class' => 'login-inp') )
						->add_rule( 'required' );

			$fieldset	->add('submit', '', array( 'type' => 'submit', 'value' => 'ログイン', 'class' => 'submit-login', 'id' => 'form_submits' ));

			$view = View_Smarty::forge( 'login' );
			$view->set_safe( 'base_url', \Uri::base() );

			$prtData = $view->set_safe( 'forms', $fieldset->getFormElements('login/login') );

			//$form = $this->action_create( 'login' );
			return Response::forge($prtData);
		}else{
			Response::redirect('index');

		}
	}

	public function action_login()
	{
		$data = array();
		if ($_POST){
			// Authのインスタンス化
			$auth = Auth::instance();

			// 資格情報の確認
			if ($auth->login($_POST['loginId'],$_POST['password'])){

				// 認証OKならトップページへ
				Response::redirect('index');
			}else{
				//認証が失敗したときの処理
				$data['username'] = $_POST['loginId'];
				$data['login_error'] = 'ユーザー名かパスワードが違います。再入力して下さい。';
				Response::redirect('login');
				return;
			}
		}
	}

    public function action_logout(){
        $auth = Auth::instance();

        $this->userId = Auth::get_user_id();
        $id = $this->userId[1];

        Common::del_data_col($id, 'editlist', 'user_id');

        $auth->logout();
        Response::redirect('login');
    }

	/**
	 * ローカル開発用: login_users が空のとき一度だけ実行（development のみ）
	 * URL: /login/create_user
	 * 既定 ID/パスワード: localdev / localdev
	 */
	public function action_create_user()
	{
		if (\Fuel::$env !== \Fuel::DEVELOPMENT) {
			throw new \HttpNotFoundException();
		}
		try {
			$user_id = Auth::create_user(
				'localdev',
				'localdev',
				'localdev@example.invalid',
				1,
				array(
					'name' => 'ローカル開発',
					'namekana' => 'ローカルカイハツ',
					'sender' => 'local',
				)
			);
			if ($user_id) {
				Common::set_data(array('sort' => 0, 'hidden' => 0, 'namekana' => 'ローカルカイハツ'), $user_id, 'login_users');
			}
			$body = "OK. ログイン ID: localdev / パスワード: localdev\n"
				."既に存在する場合は SimpleUserUpdateException になります。その場合はこのアカウントでログインしてください。\n";
			return \Response::forge($body, 200, array('Content-Type' => 'text/plain; charset=UTF-8'));
		} catch (\Exception $e) {
			$body = 'エラー: '.$e->getMessage()."\nlogin_users テーブルがあるか、docker/mysql/init の SQL を確認してください。\n";
			return \Response::forge($body, 500, array('Content-Type' => 'text/plain; charset=UTF-8'));
		}
	}


}