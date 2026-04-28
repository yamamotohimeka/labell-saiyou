<?php
use \Model\Common;


class Controller_Interview extends Controller_Frontbase
{
    public function action_index(){


        $view = View_Smarty::forge( 'interview' );
        $presenter = Presenter::forge("interview", 'view', null, $view);
        $view->set_safe( "userData", $this->userData );
        
        return Response::forge($presenter);
    }
}
