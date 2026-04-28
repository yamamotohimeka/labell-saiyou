<?php

namespace Model;
use \Model\Common;
use Fuel\Core\Config;

class Analyze_Media extends \Model
{
    public static function get_media($search = null, $adjustment = null)
    {

        // 入店（2=>採用(当日入店) or 7=>採用(後日入店)）の帳尻会わせ
        if(!empty($adjustment)) {
            self::_make_media($search);
            self::_make_media2($search);
        }

        $result = array();
        $result['items'] = self::_get_media($search);

        return $result;
    }

    // 入店（2=>採用(当日入店) or 7=>採用(後日入店)）の帳尻会わせ
    private static function _make_media($search = null)
    {
        $where = self::add_where2($search);
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo $where;

        // 現状、入店（2=>採用(当日入店) or 7=>採用(後日入店)）ではないのに履歴に入店が残っていた場合非表示に処理
        $sql = "SELECT interview_history.id
FROM interview_history
WHERE EXISTS (
SELECT interview_history.interview_id FROM (
    SELECT interview_sub.id FROM interview_sub 
    LEFT JOIN interview_main ON interview_main.id = interview_sub.id
    WHERE 1=1 $where AND interview_sub.interview_result != 2 OR interview_sub.interview_result != 7
) sub
WHERE interview_history.interview_id = sub.id AND interview_history.status = 2 AND interview_history.prt_flg = 0
)";
        $result["interview_history"] = Common::get_data( $sql );
        if(!empty($result["interview_history"])){
            $set_data = array('prt_flg' => 1);
            foreach($result["interview_history"] AS $key => $value){
                Common::set_data($set_data, $value['id'], 'interview_history');
            }
        }
    }

        // 入店（2=>採用(当日入店) or 7=>採用(後日入店)）の帳尻会わせ
        private static function _make_media2($search = null)
        {
            $where = self::add_where2($search);
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo $where;

        // 現状、入店（2=>採用(当日入店) or 7=>採用(後日入店)）なのに履歴が入店でない状態で残っていた場合表示に処理
        $sql = "SELECT interview_history.id
FROM interview_history
WHERE EXISTS (
SELECT interview_history.interview_id FROM ( 
    SELECT interview_sub.id FROM interview_sub 
    LEFT JOIN interview_main ON interview_main.id = interview_sub.id
    WHERE 1=1 $where AND interview_sub.interview_result = 2 OR interview_sub.interview_result = 7
) sub
WHERE interview_history.interview_id = sub.id AND interview_history.status = 2 AND interview_history.prt_flg = 1
)";
        $result["interview_history"] = Common::get_data( $sql );
        if(!empty($result["interview_history"])){
            $set_data = array('prt_flg' => 0);
            foreach($result["interview_history"] AS $key => $value){
                Common::set_data($set_data, $value['id'], 'interview_history');
            }
        }


    }


    private static function _get_media($search = null)
    {

        $where = self::add_where($search);
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo $where;

        $sql = "SELECT interview_main.id, interview_main.publicity, interview_sub.belonging_store
FROM interview_history
    LEFT JOIN interview_main ON interview_main.id = interview_history.interview_id
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE 1=1 $where AND interview_history.prt_flg = 0
GROUP BY interview_main.publicity
";

        $result["publicity"] = Common::get_data( $sql );

//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($result["publicity"]);

//        //全店の採用数の id の取得
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ){
//        $sql="SELECT
//interview_main.id
//FROM interview_history
//LEFT JOIN interview_main ON interview_main.id = interview_history.interview_id
//WHERE interview_history.status = 2 $where AND interview_history.prt_flg = 0";
//            echo $sql;
//        }


        foreach ($result["publicity"] as $key => $value) {
            $sql="SELECT
interview_main.id,
interview_main.media,
SUM(CASE WHEN interview_history.status = 0 THEN 1 ELSE  0 END) AS inquiry,
SUM(CASE WHEN interview_history.status = 1 THEN 1 ELSE  0 END) AS interview,
SUM(CASE WHEN interview_history.status = 2 THEN 1 ELSE  0 END) AS adopt
FROM interview_history
    LEFT JOIN interview_main ON interview_main.id = interview_history.interview_id
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE interview_main.publicity = $value[publicity] $where AND interview_history.prt_flg = 0
GROUP BY interview_main.media";
/*
            $sql="SELECT
interview_main.id,
interview_main.media,
SUM(CASE WHEN interview_main.status = 0 THEN 1 ELSE  0 END) AS inquiry,
SUM(CASE WHEN interview_main.status = 1 THEN 1 ELSE  0 END) AS interview,
SUM(CASE WHEN interview_main.status = 2 THEN 1 ELSE  0 END) AS adopt
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE interview_main.publicity = $value[publicity] $where
GROUP BY media";
            */


//            if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo $sql;
            $result["interview_result"][$value["publicity"]] = Common::get_data( $sql );

            foreach ($result["interview_result"][$value["publicity"]] as $key2 => $value2) {
                $result["detail_result"][$value["publicity"]][$value2["media"]]["inquiry"] = $value2["inquiry"];
                $result["detail_result"][$value["publicity"]][$value2["media"]]["interview"] = $value2["interview"];
                $result["detail_result"][$value["publicity"]][$value2["media"]]["adopt"] = $value2["adopt"];
            }
        }

        return $result;
    }
/*
    private static function add_where($search = null)
    {
        $where = "";
        if(!empty($search)) {
            //入店日
            $submission_from =  $search['submission_year_from'] . '-' . $search['submission_month_from'] . '-' . $search['submission_day_from'];

            $submission_from_where = "";
            if(strptime($submission_from, '%Y-%m-%d')) {
                $submission_from_where = "interview_history.submission_date >= '$submission_from'";
            }

            $submission_to =  $search['submission_year_to'] . '-' . $search['submission_month_to'] . '-' . $search['submission_day_to'];

            $submission_to_where = "";
            if(strptime($submission_to, '%Y-%m-%d')) {
                $submission_to_where = "interview_history.submission_date <= '$submission_to'";
            }

            if($submission_from_where AND $submission_to_where) {
                $whereList[] = "($submission_from_where AND $submission_to_where)";
            }elseif(!$submission_from_where AND !$submission_to_where){
                $whereList[] = "";
            }else{
                $whereList[] = "$submission_from_where $submission_to_where";
            }

            //掲載媒体
            if(!empty($search['media_hidden'])){
                $whereList[] = "FIND_IN_SET(interview_main.publicity, '$search[media_hidden]')";
            }

            //掲載求人
            if(!empty($search['recruit_hidden'])){
                $whereList[] = "FIND_IN_SET(interview_main.media, '$search[recruit_hidden]')";
            }

            if(!empty($whereList)){
                $whereList = array_filter($whereList, "strlen");
                foreach ($whereList as $key => $value) {
                    if(isset($where) AND $value !== reset($whereList)){
                        $where .= " AND ";
                    }
                    $where .= $value;
                }
            }

            if($where !== ""){
                $where = " AND (" . $where . ")";
            }
        }

        return $where;
    }
*/

    private static function add_where($search = null)
    {
        $where = "";
        if(!empty($search)) {
            //入店日
            $submission_from =  $search['submission_year_from'] . '-' . $search['submission_month_from'] . '-' . $search['submission_day_from'];

            $submission_from_where = "";
            if(strptime($submission_from, '%Y-%m-%d')) {
                $submission_from_where = "(CASE WHEN interview_history.status = 0 THEN interview_main.submission_date ELSE interview_main.interview_date END) >= '$submission_from'";
            }

            $submission_to =  $search['submission_year_to'] . '-' . $search['submission_month_to'] . '-' . $search['submission_day_to'];

            $submission_to_where = "";
            if(strptime($submission_to, '%Y-%m-%d')) {
                $submission_to_where = "(CASE WHEN interview_history.status = 0 THEN interview_main.submission_date ELSE interview_main.interview_date END) <= '$submission_to'";
            }

            if($submission_from_where AND $submission_to_where) {
                $whereList[] = "($submission_from_where AND $submission_to_where)";
            }elseif(!$submission_from_where AND !$submission_to_where){
                $whereList[] = "";
            }else{
                $whereList[] = "$submission_from_where $submission_to_where";
            }

            //掲載媒体
            if(!empty($search['media_hidden'])){
                $whereList[] = "FIND_IN_SET(interview_main.publicity, '$search[media_hidden]')";
            }

            //掲載求人
            if(!empty($search['recruit_hidden'])){
                $whereList[] = "FIND_IN_SET(interview_main.media, '$search[recruit_hidden]')";
            }

            if(!empty($whereList)){
                $whereList = array_filter($whereList, "strlen");
                foreach ($whereList as $key => $value) {
                    if(isset($where) AND $value !== reset($whereList)){
                        $where .= " AND ";
                    }
                    $where .= $value;
                }
            }

            if($where !== ""){
                $where = " AND (" . $where . ")";
            }
        }

        return $where;
    }

    private static function add_where2($search = null)
    {
        $where = "";
        if(!empty($search)) {
            //入店日
            $submission_from =  $search['submission_year_from'] . '-' . $search['submission_month_from'] . '-' . $search['submission_day_from'];

            $submission_from_where = "";
            if(strptime($submission_from, '%Y-%m-%d')) {
                $submission_from_where = "interview_main.interview_date >= '$submission_from'";
            }

            $submission_to =  $search['submission_year_to'] . '-' . $search['submission_month_to'] . '-' . $search['submission_day_to'];

            $submission_to_where = "";
            if(strptime($submission_to, '%Y-%m-%d')) {
                $submission_to_where = "interview_main.interview_date <= '$submission_to'";
            }

            if($submission_from_where AND $submission_to_where) {
                $whereList[] = "($submission_from_where AND $submission_to_where)";
            }elseif(!$submission_from_where AND !$submission_to_where){
                $whereList[] = "";
            }else{
                $whereList[] = "$submission_from_where $submission_to_where";
            }

            //掲載媒体
            if(!empty($search['media_hidden'])){
                $whereList[] = "FIND_IN_SET(interview_main.publicity, '$search[media_hidden]')";
            }

            //掲載求人
            if(!empty($search['recruit_hidden'])){
                $whereList[] = "FIND_IN_SET(interview_main.media, '$search[recruit_hidden]')";
            }

            if(!empty($whereList)){
                $whereList = array_filter($whereList, "strlen");
                foreach ($whereList as $key => $value) {
                    if(isset($where) AND $value !== reset($whereList)){
                        $where .= " AND ";
                    }
                    $where .= $value;
                }
            }

            if($where !== ""){
                $where = " AND (" . $where . ")";
            }
        }

        return $where;
    }

}