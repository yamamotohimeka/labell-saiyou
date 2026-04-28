<?php
use \Model\Common;

class Controller_Chase extends Controller_Frontbase
{
    public function action_index(){

        if(Input::post('contact_submit')){
            if(Input::post("contact_flg")){
                foreach (Input::post("contact_flg") as $key => $value) {
                    Common::set_data(array("contact_flg" => 1), $key, "interview_main");
                }
            }
        }

        $view = View_Smarty::forge( "chase" );
        $presenter = Presenter::forge("chase", 'view', null, $view);
        $view->set_safe( "userData", $this->userData );
        
        return Response::forge($presenter);
    }

}
