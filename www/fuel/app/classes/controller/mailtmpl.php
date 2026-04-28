<?php
use \Model\Mailtmpl;

class Controller_Mailtmpl extends Controller_Frontbase
{
    public function action_index(){
        $title = 'メールテンプレート';

        $result = Mailtmpl::get_data('mail_template');

        $view = View_Smarty::forge( "mailtmpl/list" );
        $prtData = $view->set_safe( "result", $result );
        $presenter = Presenter::forge("mailtmpl", 'view', null, $view);
        $view->set_safe( "userData", $this->userData );

        return Response::forge($presenter);
    }

    public function action_form($id = null){

        $title = 'メールテンプレート';

        $result = '';



        if(Input::post('submit')){

            Mailtmpl::set_data(Input::post(), $id);

            Response::redirect("/mailtmpl");
        }

        $view = View_Smarty::forge( "mailtmpl/form" );
        $prtData = $view->set_safe( "id", $id );
        $prtData = $view->set_safe( "result", $result );
        $presenter = Presenter::forge("mailtmpl", 'view', null, $view);
        $presenter->set('id', $id);

        $view->set_safe( "userData", $this->userData );
        
        return Response::forge($presenter);
    }

    // メールテンプレート削除
    public function action_delete($id = null){
        
        if(Input::post('submit')){

            Mailtmpl::delete(Input::post('id'));

            Response::redirect("/mailtmpl");
        }
    }

}
