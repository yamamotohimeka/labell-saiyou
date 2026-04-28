<?php
use \Model\Staffgroup;

class Controller_Staffgroup extends Controller_Frontbase
{
    public function action_index(){
        $view = View_Smarty::forge( "staffgroup/index" );
        $presenter = Presenter::forge("staffgroup", 'view', null, $view);
        $view->set_safe( "userData", $this->userData );

        return Response::forge($presenter);
    }

    public function action_confirm(){
        $view = View_Smarty::forge( "staffgroup/confirm" );
        $presenter = Presenter::forge("staffgroup", 'confirm', null, $view);
        $view->set_safe( "userData", $this->userData );
        
        return Response::forge($presenter);
    }

    public function action_add(){
        $dataArray = array(
          'id' => Input::post('groupId'),
          'group' => Input::post('group'),
        );

        Staffgroup::set_data($dataArray, Input::post('groupId'));

        Response::redirect("/staffgroup");
    }
}
