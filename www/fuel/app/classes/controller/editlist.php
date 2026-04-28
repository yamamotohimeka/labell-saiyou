<?php
use \Model\Common;

class Controller_Editlist extends Controller_Frontbase
{
    public function action_index(){

        if(Input::post("edit_id")){
            Common::del_data(Input::post("edit_id"), 'editlist');

            Response::redirect("/editlist");
        }

        $view = View_Smarty::forge( "editlist" );
        $presenter = Presenter::forge("editlist", 'view', null, $view);

        return Response::forge($presenter);
    }
}
