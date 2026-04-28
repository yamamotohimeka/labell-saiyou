<?php
use \Model\Common;

class Controller_Alertlist extends Controller_Frontbase
{
    public function action_index(){
        $view = View_Smarty::forge( "alertlist" );
        $presenter = Presenter::forge("alertlist", 'view', null, $view);

        return Response::forge($presenter);
    }
}
