<?php

namespace Model;
use \Model\Common;
use Fuel\Core\Config;

class Analyze_Branch extends \Model
{
    public static function get_branch($search = null)
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

            //他店紹介
            if(!empty($search['another_shop_hidden'])){
                $whereList[] = "FIND_IN_SET(another_shop, '$search[another_shop_hidden]')";
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

        $sql = "SELECT count(interview_main.id) AS count
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE interview_sub.another_shop > 0 $where
";
        $result["total_result"] = Common::get_data( $sql );

        $sql = "SELECT interview_main.id, interview_sub.another_shop, count(interview_main.id) AS count
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE interview_sub.another_shop > 0 $where
GROUP BY interview_sub.another_shop
";

//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo $sql;

        $result["detail_result"] = Common::get_data( $sql );
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($result["detail_result"]);

        return $result;
    }
}