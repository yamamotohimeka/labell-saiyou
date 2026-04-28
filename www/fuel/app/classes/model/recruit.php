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
            $submission_from =  $search['submission_year_from'] . '-' . $search['submission_month_from'] . '-' . $search['submission_day_from'];

            $submission_from_where = "";
            if(strptime($submission_from, '%Y-%m-%d')) {
                $submission_from_where = "submission_date >= '$submission_from'";
            }

            $submission_to =  $search['submission_year_to'] . '-' . $search['submission_month_to'] . '-' . $search['submission_day_to'];

            $submission_to_where = "";
            if(strptime($submission_to, '%Y-%m-%d')) {
                $submission_to_where = "submission_date <= '$submission_to'";
            }

            if($submission_from_where AND $submission_to_where) {
                $whereList[] = "($submission_from_where AND $submission_to_where)";
            }elseif(!$submission_from_where AND !$submission_to_where){
                $whereList[] = "";
            }else{
                $whereList[] = "$submission_from_where $submission_to_where";
            }

            //所属店舗
            if(!empty($search['select_shop_hidden'])){
                $whereList[] = "FIND_IN_SET(belonging_store, '$search[select_shop_hidden]')";
            }

            //面接担当
//            if(!empty($search['interview_staff_hidden'])){
//                $whereList[] = "FIND_IN_SET(interview_staff, '$search[interview_staff_hidden]')";
//            }

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

//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo $where;


        $sql = "SELECT
interview_main.id,
interview_sub.interview_staff,
interview_sub.interview_result,
SUM(CASE WHEN interview_sub.interview_result > 0 THEN 1 ELSE  0 END) AS interview_count,
SUM(CASE WHEN interview_main.status = 2 AND interview_sub.interview_result = 1 THEN 1 ELSE  0 END) AS enter_count,
SUM(CASE WHEN interview_sub.interview_result = 2 THEN 1 ELSE  0 END) AS notadopt,
SUM(CASE WHEN interview_sub.interview_result = 4 THEN 1 ELSE  0 END) AS other_notadopt
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE interview_sub.interview_staff > 0 $where
";


        $result["total_result"] = Common::get_data( $sql, "row" );

//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($result["total_result"]);

        if( !empty($result["total_result"]["id"]) ){

            $result_set = ($result["total_result"]["interview_count"]-$result["total_result"]["notadopt"]-$result["total_result"]["other_notadopt"])*100;
            if($result_set == 0){
                $result["total_result"]["total_per"] = 0;
            }else{
                $result["total_result"]["total_per"] = $result["total_result"]["enter_count"] / $result_set;
            }

            $sql = "SELECT
interview_main.id,
interview_sub.belonging_store,
interview_sub.interview_staff,
interview_sub.interview_result,
SUM(CASE WHEN interview_sub.interview_result > 0 THEN 1 ELSE  0 END) AS interview_count,
SUM(CASE WHEN interview_main.status = 2 AND interview_sub.interview_result = 1 THEN 1 ELSE  0 END) AS enter_count,
SUM(CASE WHEN interview_sub.interview_result = 2 THEN 1 ELSE  0 END) AS notadopt,
SUM(CASE WHEN interview_sub.interview_result = 4 THEN 1 ELSE  0 END) AS other_notadopt
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE 1=1 $where
GROUP BY belonging_store
";

            $result["belonging_store"] = Common::get_data( $sql );

            foreach ($result["belonging_store"] as $key => $value) {
                $sql="SELECT
interview_main.id,
interview_sub.interview_staff,
interview_sub.interview_result,
SUM(CASE WHEN interview_sub.interview_result > 0 THEN 1 ELSE  0 END) AS interview_count,
SUM(CASE WHEN interview_main.status = 2 AND interview_sub.interview_result = 1 THEN 1 ELSE  0 END) AS enter_count,
SUM(CASE WHEN interview_sub.interview_result = 2 THEN 1 ELSE  0 END) AS notadopt,
SUM(CASE WHEN interview_sub.interview_result = 4 THEN 1 ELSE  0 END) AS other_notadopt
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE interview_sub.belonging_store = $value[belonging_store] $where
GROUP BY interview_staff";

                $result["interview_result"][$value["belonging_store"]] = Common::get_data( $sql );

                //店ごとの入店率
                if($value["enter_count"] != 0){
                    $result["detail_result"][$value["belonging_store"]]["total_per"] = $value["enter_count"] /($value["interview_count"]-$value["notadopt"]-$value["other_notadopt"])*100;
                }else{
                    $result["detail_result"][$value["belonging_store"]]["total_per"] = 0;
                }

                //担当単位の入店率
                foreach ($result["interview_result"][$value["belonging_store"]] as $key2 => $value2) {
                    $result["detail_result"][$value["belonging_store"]][$value2["interview_staff"]]["interview_count"] = $value2["interview_count"];

                    $result["detail_result"][$value["belonging_store"]][$value2["interview_staff"]]["enter_count"] = $value2["enter_count"];

                    if($value2["enter_count"] != 0){
                        $entrance_rate = $value2["enter_count"] /($value2["interview_count"]-$value2["notadopt"]-$value2["other_notadopt"])*100;
                    }else{
                        $entrance_rate = 0;
                    }

                    $result["detail_result"][$value["belonging_store"]][$value2["interview_staff"]]["entrance_rate"] = $entrance_rate;
                }
            }

            return $result;
        }
    }
}