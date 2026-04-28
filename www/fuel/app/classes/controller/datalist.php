<?php
use \Model\Common;

class Controller_Datalist extends Controller_Frontbase
{
    public function action_index(){
        $view = View_Smarty::forge( "datalist" );
        $presenter = Presenter::forge("datalist", 'view', null, $view);
        $view->set_safe( "userData", $this->userData );
        
        return Response::forge($presenter);
    }

}
