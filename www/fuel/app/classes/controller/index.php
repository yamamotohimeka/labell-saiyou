<?php
use \Model\Common;
use \Model\Top;

class Controller_Index extends Controller_Frontbase
{
    public function action_index($id = null){

        $view = View_Smarty::forge( "top" );
        $presenter = Presenter::forge("top", 'view', null, $view);

        $view->set_safe( "userData", $this->userData );
        return Response::forge($presenter);
    }

    /**
     * 404 not found
     * @access public
     * @return Response
     */
    public function action_404()
    {
        $data["title"] = "404";
        $data["pankuzu"][] = array( 'name' => $data["title"], 'url' => "");
        $view = View_Smarty::forge( '404' );

        return Response::forge($view, 404);
    }
    
}
