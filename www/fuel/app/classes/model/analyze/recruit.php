<?php

namespace Model;
use \Model\Common;
use Fuel\Core\Config;

class Analyze_Recruit extends \Model
{
    public static function get_recruit($search = null)
    {
        $where = "";
        if(!empty($search)) {
            //入店日
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


        //全体
        $sql = "SELECT
interview_main.id,
interview_sub.interview_staff,
interview_sub.interview_result,
SUM(CASE WHEN interview_sub.interview_result > 0 THEN 1 ELSE  0 END) AS interview_count,
SUM(CASE WHEN (interview_sub.interview_result = 2 OR interview_sub.interview_result = 7)  THEN 1 ELSE  0 END) AS enter_count,
SUM(CASE WHEN (interview_sub.interview_result = 3 OR interview_sub.interview_result = 5) THEN 1 ELSE  0 END) AS notadopt,
SUM(CASE WHEN (interview_sub.interview_result = 4 OR interview_sub.interview_result = 6) THEN 1 ELSE  0 END) AS other_notadopt
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE interview_sub.interview_staff > 0 $where
";
//        SUM(CASE WHEN interview_main.status = 2 AND (interview_sub.interview_result = 2 OR interview_sub.interview_result = 7)  THEN 1 ELSE  0 END) AS enter_count,

        $result["total_result"] = Common::get_data( $sql, "row" );
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo $sql;
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($result["total_result"]);

        if( !empty($result["total_result"]["id"]) ){
            if($result["total_result"]["enter_count"]) {
//                $result["total_result"]["total_per"] = $result["total_result"]["enter_count"] / $result["total_result"]["interview_count"] * 100;
                $result["total_result"]["total_per"] = $result["total_result"]["enter_count"] / ( $result["total_result"]["interview_count"] - $result["total_result"]["notadopt"]) * 100;
            }

            $sql = "SELECT
interview_main.id,
interview_sub.belonging_store,
interview_sub.interview_staff,
interview_sub.interview_result,
SUM(CASE WHEN interview_sub.interview_result > 0 THEN 1 ELSE  0 END) AS interview_count,
SUM(CASE WHEN (interview_sub.interview_result = 2 OR interview_sub.interview_result = 7)  THEN 1 ELSE  0 END) AS enter_count,
SUM(CASE WHEN (interview_sub.interview_result = 3 OR interview_sub.interview_result = 5) THEN 1 ELSE  0 END) AS notadopt,
SUM(CASE WHEN (interview_sub.interview_result = 4 OR interview_sub.interview_result = 6) THEN 1 ELSE  0 END) AS other_notadopt
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE interview_sub.interview_staff > 0 $where
GROUP BY belonging_store
";
            //SUM(CASE WHEN interview_main.status = 2 AND (interview_sub.interview_result = 2 OR interview_sub.interview_result = 7)  THEN 1 ELSE  0 END) AS enter_count,

            $result["belonging_store"] = Common::get_data( $sql );

            foreach ($result["belonging_store"] as $key => $value) {
                $result["interview_result"][$value["belonging_store"]] = $value;
                //店ごとの入店率
                if($value["enter_count"] != 0){
                    if($value["enter_count"] > 0) {
//                        $result["interview_result"][$value["belonging_store"]]["total_per"] = $value["enter_count"] / $value["interview_count"] * 100;
                        $result["interview_result"][$value["belonging_store"]]["total_per"] = $value["enter_count"] / ( $value["interview_count"] - $value["notadopt"] ) * 100;
                    }
                }else{
                    $result["interview_result"][$value["belonging_store"]]["total_per"] = 0;
                }
            }

            return $result;
        }
    }
}