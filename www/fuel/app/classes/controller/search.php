<?php
use \Model\Common;
use \Model\Search;

class Controller_Search extends Controller_Frontbase
{
    public function action_index(){
        $view = View_Smarty::forge( "search" );
        $presenter = Presenter::forge("search/index", 'view', null, $view);
        $view->set_safe( "userData", $this->userData );

        return Response::forge($presenter);
    }

    public function action_result(){
        $view = View_Smarty::forge( "search-result" );
        $presenter = Presenter::forge("search/result", 'view', null, $view);
        $view->set_safe( "userData", $this->userData );

        return Response::forge($presenter);
    }

}
