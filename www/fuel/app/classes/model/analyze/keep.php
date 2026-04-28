<?php

namespace Model;
use \Model\Common;
use Fuel\Core\Config;

class Analyze_Keep extends \Model
{
    public static function get_keep($search = null)
    {
        $where = "";
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($search);
        if(!empty($search)) {
            //面接日
            $interview_from =  $search['interview_year_from'] . '-' . $search['interview_month_from'] . '-' . $search['interview_day_from'];

            $interview_from_where = "";
            if(strptime($interview_from, '%Y-%m-%d')) {
                $interview_from_where = "interview_date >= '$interview_from'";
            }

            $interview_to =  $search['interview_year_to'] . '-' . $search['interview_month_to'] . '-' . $search['interview_day_to'];

            $interview_to_where = "";
            if(strptime($interview_to, '%Y-%m-%d')) {
                $interview_to_where = "interview_date <= '$interview_to'";
            }

            if($interview_from_where AND $interview_to_where) {
                $whereList[] = "($interview_from_where AND $interview_to_where)";
            }elseif(!$interview_from_where AND !$interview_to_where){
                $whereList[] = "";
            }else{
                $whereList[] = "$interview_from_where $interview_to_where";
            }

//            //所属店舗
//            if(!empty($search['select_shop_hidden'])){
//                $whereList[] = "FIND_IN_SET(belonging_store, '$search[select_shop_hidden]')";
//            }

            //掲載業種
            if(!empty($search['select_genre_hidden'])){
                $whereList[] = "FIND_IN_SET(genre, '$search[select_genre_hidden]')";
            }

            if(!empty($search['select_target_hidden'])){
                $target_array = explode(",", $search['select_target_hidden']);

                $target_data_array = array();
                foreach ($target_array as $key => $value) {
                    if($value == 1){
                        $target_data_array[] = "media > 0";
                    }

                    if($value == 2){
                        $target_data_array[] = "scout > 0";
                    }

                    if($value == 3){
                        $target_data_array[] = "move > 0";
                    }
                }

                $target_where = "";
                foreach ($target_data_array as $key => $value) {
                    if(isset($target_where) AND $value !== reset($target_data_array)){
                        $target_where .= " OR ";
                    }

                    $target_where .= $value;
                }

                $whereList[] = "(" . $target_where . ")";
            }

            if(!empty($whereList)){
                $whereList = array_filter($whereList, "strlen");
                foreach ($whereList as $key => $value) {
                    if(isset($where) AND $value !== reset($whereList)){
//                        $where .= " OR ";
                        $where .= " AND ";
                    }
                    $where .= $value;
                }
            }

            if($where !== ""){
                $where = " AND (" . $where . ")";
            }
        }


        $sql = "SELECT
interview_main.id,
interview_sub.belonging_store,
interview_sub.interview_staff,
interview_sub.interview_result,
SUM(CASE WHEN interview_sub.leaving_date = 0 AND (interview_sub.interview_result = 2 OR interview_sub.interview_result = 7) THEN 1 ELSE  0 END) AS enrolled_count,
SUM(CASE WHEN interview_sub.leaving_date > 0 AND (interview_sub.interview_result = 2 OR interview_sub.interview_result = 7) THEN 1 ELSE  0 END) AS leaving_count,
SUM(CASE WHEN (interview_sub.interview_result = 2 OR interview_sub.interview_result = 7)  THEN 1 ELSE  0 END) AS enter_count
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE 1=1 $where
";
        $result["total_result"] = Common::get_data( $sql, "row" );
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo $sql;
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($result["total_result"]);

        // 継続率
        if(!empty($result["total_result"]["enrolled_count"]) AND !empty($result["total_result"]["enter_count"])) $result["total_result"]["total_per"] = $result["total_result"]["enrolled_count"] / $result["total_result"]["enter_count"] * 100;
//        if(($result["total_result"]["enter_count"] - $result["total_result"]["leaving_count"]) > 0) {
//            $result["total_result"]["total_per"] = ($result["total_result"]["enter_count"] - $result["total_result"]["leaving_count"]) / $result["total_result"]["enter_count"] * 100;
//        }

        // 在籍数
//        $result["total_result"]["enrolled_count"] = $result["total_result"]["enter_count"] - $result["total_result"]["leaving_count"];

        $sql = "SELECT
interview_main.id,
interview_sub.belonging_store,
interview_sub.interview_staff,
interview_sub.interview_result,
SUM(CASE WHEN interview_sub.leaving_date = 0 AND (interview_sub.interview_result = 2 OR interview_sub.interview_result = 7) THEN 1 ELSE  0 END) AS enrolled_count,
SUM(CASE WHEN interview_sub.leaving_date > 0 AND (interview_sub.interview_result = 2 OR interview_sub.interview_result = 7) THEN 1 ELSE  0 END) AS leaving_count,
SUM(CASE WHEN (interview_sub.interview_result = 2 OR interview_sub.interview_result = 7)  THEN 1 ELSE  0 END) AS enter_count
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE 1=1 $where
GROUP BY belonging_store
";

        $result["belonging_store"] = Common::get_data( $sql );

        foreach ($result["belonging_store"] as $key => $value) {
            $result["interview_result"][$value["belonging_store"]] = $value;

            $result["interview_result"][$value["belonging_store"]]["enrolled_count"] = $value["enter_count"] - $value["leaving_count"];

            // 店ごとの継続率
            if($value["enter_count"] != 0){
                if(($value["enter_count"] - $value["leaving_count"]) > 0) {
//                    $result["interview_result"][$value["belonging_store"]]["total_per"] = ($value["enter_count"] - $value["leaving_count"]) / $value["enter_count"] * 100;
                    $result["interview_result"][$value["belonging_store"]]["total_per"] = $value["enrolled_count"] / $value["enter_count"] * 100;
                }
            }else{
                $result["interview_result"][$value["belonging_store"]]["total_per"] = 0;
            }

        }

        return $result;
    }
}