<?php
use \Model\Common;
use \Model\Analyze;

class Controller_Analyze extends Controller_Frontbase
{
    //採用数
    public function action_index(){

        if(Input::get("search") == 1){
            $view = View_Smarty::forge( "analyze/adopt_result" );
        }else{
            $view = View_Smarty::forge( "analyze/adopt" );
        }

        $presenter = Presenter::forge("analyze", 'adopt', null, $view);

        $view->set_safe( "userData", $this->userData );

        return Response::forge($presenter);
    }

    //月間集計
    public function action_monthly(){

        if(Input::get("search") == 1){
            $view = View_Smarty::forge( "analyze/monthly_result" );
        }else{
            $view = View_Smarty::forge( "analyze/monthly" );
        }

        $presenter = Presenter::forge("analyze", 'monthly', null, $view);

        $view->set_safe( "userData", $this->userData );

        return Response::forge($presenter);
    }

    //掲載媒体
    public function action_media(){

        if(Input::get("search") == 1){
            $view = View_Smarty::forge( "analyze/media_result" );
        }else{
            $view = View_Smarty::forge( "analyze/media" );
        }

        $presenter = Presenter::forge("analyze", 'media', null, $view);

        $view->set_safe( "userData", $this->userData );

        return Response::forge($presenter);
    }

    //面接振り件数
    public function action_divide(){

        if(Input::get("search") == 1){
            $view = View_Smarty::forge( "analyze/divide_result" );
        }else{
            $view = View_Smarty::forge( "analyze/divide" );
        }

        $presenter = Presenter::forge("analyze", 'divide', null, $view);

        $view->set_safe( "userData", $this->userData );

        return Response::forge($presenter);
    }

    //他店紹介
    public function action_branch(){

        if(Input::get("search") == 1){
            $view = View_Smarty::forge( "analyze/branch_result" );
        }else{
            $view = View_Smarty::forge( "analyze/branch" );
        }

        $presenter = Presenter::forge("analyze", 'branch', null, $view);

        $view->set_safe( "userData", $this->userData );

        return Response::forge($presenter);
    }

    //ニコイチ
    public function action_peas(){

        if(Input::get("search") == 1){
            $view = View_Smarty::forge( "analyze/peas_result" );
        }else{
            $view = View_Smarty::forge( "analyze/peas" );
        }

        $presenter = Presenter::forge("analyze", 'peas', null, $view);

        $view->set_safe( "userData", $this->userData );

        return Response::forge($presenter);
    }

    //出稼ぎ
    public function action_emigrate(){

        if(Input::get("search") == 1){
            $view = View_Smarty::forge( "analyze/emigrate_result" );
        }else{
            $view = View_Smarty::forge( "analyze/emigrate" );
        }

        $presenter = Presenter::forge("analyze", 'emigrate', null, $view);

        $view->set_safe( "userData", $this->userData );

        return Response::forge($presenter);
    }

    //入店率（店舗）
    public function action_recruit(){

        if(Input::get("search") == 1){
            $view = View_Smarty::forge( "analyze/recruit_result" );
        }else{
            $view = View_Smarty::forge( "analyze/recruit" );
        }

        $presenter = Presenter::forge("analyze", 'recruit', null, $view);

        $view->set_safe( "userData", $this->userData );

        return Response::forge($presenter);
    }

    //入店率（担当）
    public function action_recruit_tantou(){

        if(Input::get("search") == 1){
            $view = View_Smarty::forge( "analyze/recruit_tantou_result" );
        }else{
            $view = View_Smarty::forge( "analyze/recruit_tantou" );
        }

        $presenter = Presenter::forge("analyze", 'recruit_tantou', null, $view);

        $view->set_safe( "userData", $this->userData );

        return Response::forge($presenter);
    }

    //継続率
    public function action_keep(){

        if(Input::get("search") == 1){
            $view = View_Smarty::forge( "analyze/keep_result" );
        }else{
            $view = View_Smarty::forge( "analyze/keep" );
        }

        $presenter = Presenter::forge("analyze", 'keep', null, $view);

        $view->set_safe( "userData", $this->userData );

        return Response::forge($presenter);
    }

    //継続率（担当）
    public function action_keep_tantou(){

        if(Input::get("search") == 1){
            $view = View_Smarty::forge( "analyze/keep_tantou_result" );
        }else{
            $view = View_Smarty::forge( "analyze/keep_tantou" );
        }

        $presenter = Presenter::forge("analyze", 'keep_tantou', null, $view);

        $view->set_safe( "userData", $this->userData );

        return Response::forge($presenter);
    }

    //申込時間
    public function action_time(){

        if(Input::get("search") == 1){
            $view = View_Smarty::forge( "analyze/time_result" );
        }else{
            $view = View_Smarty::forge( "analyze/time" );
        }

        $presenter = Presenter::forge("analyze", 'time', null, $view);

        $view->set_safe( "userData", $this->userData );

        return Response::forge($presenter);
    }

    //広告掲載エリア
    public function action_area(){

        if(Input::get("search") == 1){
            $view = View_Smarty::forge( "analyze/area_result" );
        }else{
            $view = View_Smarty::forge( "analyze/area" );
        }

        $presenter = Presenter::forge("analyze", 'area', null, $view);

        $view->set_safe( "userData", $this->userData );

        return Response::forge($presenter);
    }

    //検索ワード
    public function action_word(){

        if(Input::get("search") == 1){
            $view = View_Smarty::forge( "analyze/word_result" );
        }else{
            $view = View_Smarty::forge( "analyze/word" );
        }

        $presenter = Presenter::forge("analyze", 'word', null, $view);

        $view->set_safe( "userData", $this->userData );
        
        return Response::forge($presenter);
    }
}
