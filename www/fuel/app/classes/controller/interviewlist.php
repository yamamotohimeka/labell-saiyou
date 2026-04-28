<?php
use \Model\Common;

class Controller_Interviewlist extends Controller_Frontbase
{
    public function action_index(){
        $view = View_Smarty::forge( "interviewlist" );
        $presenter = Presenter::forge("interviewlist", 'view', null, $view);

        return Response::forge($presenter);
    }

}
