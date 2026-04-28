<?php
use \Model\Mailtmpl;
/**
 * The welcome hello presenter.
 *
 * @package  app
 * @extends  Presenter
 */
class Presenter_Mailtmpl extends Presenter
{
	/**
	 * Prepare the view data, keeping this in here helps clean up
	 * the controller.
	 *
	 * @return void
	 */
	public function view()
	{
        $this->title = "メールテンプレート登録";

        $fieldset = Fieldsetplus::forge();

        $fieldset -> add( 'template_name', 'テンプレート名', array('name' => 'other','size' => '20', 'class' => 'signup_txt tmpl', 'required' => 'required') );

        $fieldset -> add( 'title', 'タイトル名', array('name' => 'other','size' => '20', 'class' => 'signup_txt tmpl2', 'required' => 'required') );

        $fieldset -> add( 'mail_text', '本文', array('type' => 'textarea', 'size' => 110, 'class' => 'tmpl_txt', 'required' => 'required') );

        if(Request::active()->param('id')){
            $result = Mailtmpl::get_rowdata(Request::active()->param('id'));
            $default = array_shift($result);
            $fieldset->populate( $default );
        }

        $this->set_safe( 'forms', $fieldset->getFormElements() );
	}
}
