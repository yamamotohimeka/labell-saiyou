<?php

namespace Model;
use \Model\Common;
use Fuel\Core\Config;

class Analyze_Emigrate extends \Model
{
    public static function get_emigrate($search = null)
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

//            //所属店舗
//            if(!empty($search['shop_hidden'])){
//                $whereList[] = "FIND_IN_SET(belonging_store, '$search[shop_hidden]')";
//            }
            if(!empty($search['select_shop_hidden'])){
                $whereList[] = "FIND_IN_SET(belonging_store, '$search[select_shop_hidden]')";
            }

            //面接結果
            if(!empty($search['interview_result_hidden'])){
                $whereList[] = "FIND_IN_SET(interview_result, '$search[interview_result_hidden]')";
            }

            if(!empty($whereList)){
                $whereList = array_filter($whereList, "strlen");
                foreach ($whereList as $key => $value) {
                    if(isset($where) AND $value !== reset($whereList)){
                        $where .= " OR ";
                    }
                    $where .= $value;
                }
            }

            if($where !== ""){
                $where = " AND (" . $where . ")";
            }
        }

        $sql = "SELECT count(interview_main.id) AS count
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE working_away_flg = 1 $where
";

        $result["total_result"] = Common::get_data( $sql );

        $sql = "SELECT interview_main.id, interview_sub.belonging_store
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE working_away_flg = 1 $where
GROUP BY belonging_store
";
        $result["belonging_store"] = Common::get_data( $sql );

        foreach ($result["belonging_store"] as $key => $value) {
            $sql="SELECT
interview_main.id,
count(interview_main.id) AS count,
interview_sub.interview_result
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE working_away_flg = 1 AND interview_sub.belonging_store = $value[belonging_store] $where
GROUP BY interview_result";


//            if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo $sql;



            $result["interview_result"][$value["belonging_store"]] = Common::get_data( $sql );

            foreach ($result["interview_result"][$value["belonging_store"]] as $key2 => $value2) {
                $result["detail_result"][$value["belonging_store"]][$value2["interview_result"]] = $value2["count"];
            }
        }

        return $result;
    }
}