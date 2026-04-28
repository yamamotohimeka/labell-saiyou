<?php

namespace Model;
use \Model\Common;
use Fuel\Core\Config;

class Analyze_Peas extends \Model
{
    public static function get_peas($search = null)
    {
        $result = array();
        $result['items'] = self::_get_peas($search);


        return $result;
    }

    private static function _get_peas($search = null)
    {
        $where = self::add_where($search);

        // SC 除外
        // 紹介 除外
        // 2023.01.10 ↓ 削除
//        $where = $where . ' AND interview_sub.scout_mail_flg = 0 AND interview_main.scout = 0 AND interview_main.move != 2';



        $sql = "SELECT count(interview_main.id) AS count
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE nikoiti_flg = 1 $where
";
        $result["total_result"] = Common::get_data( $sql );

        $sql = "SELECT interview_main.id, interview_sub.belonging_store
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE nikoiti_flg = 1 $where
GROUP BY belonging_store
";
        $result["belonging_store"] = Common::get_data( $sql );
        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo $sql;

        foreach ($result["belonging_store"] as $key => $value) {
            $sql="SELECT
interview_result,
count(interview_main.id) AS count
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE nikoiti_flg = 1 AND interview_sub.belonging_store = $value[belonging_store] $where
GROUP BY interview_result";

//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo $sql;

            $result["interview_result"][$value["belonging_store"]] = Common::get_data( $sql );

            foreach ($result["interview_result"][$value["belonging_store"]] as $key2 => $value2) {
                /*$status = call_user_func(function($result) {
                    switch($result) {
                        case 1: // 採用
                            return 1;
                        case 2: // 不採用
                        case 4: // 他店紹介不採用
                            return 2;
                        case 3: // 撃沈
                        case 5: // 他店紹介撃沈
                            return 3;
                    }

                    return $result;
                }, $value2["interview_result"]);
                */
                $status = $value2["interview_result"];
                if(!isset($result["detail_result"][$value["belonging_store"]][$status])) {
                    $result["detail_result"][$value["belonging_store"]][$status] = 0;
                }
                $result["detail_result"][$value["belonging_store"]][$status] += $value2["count"];
            }

        }
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($result["detail_result"]);

        return $result;
    }

    private static function _old_get_peas($search = null)
    {
        $where = self::add_where($search);

        $sql = "SELECT count(interview_main.id) AS count
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE nikoiti_flg = 1 $where
";
        $result["total_result"] = Common::get_data( $sql );

        $sql = "SELECT interview_main.id, interview_sub.belonging_store
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE nikoiti_flg = 1 $where
GROUP BY belonging_store
";
        $result["belonging_store"] = Common::get_data( $sql );

        foreach ($result["belonging_store"] as $key => $value) {
            $sql="SELECT
interview_result,
count(interview_main.id) AS count
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE nikoiti_flg = 1 AND interview_sub.belonging_store = $value[belonging_store] $where
GROUP BY interview_result";

            $result["interview_result"][$value["belonging_store"]] = Common::get_data( $sql );

            foreach ($result["interview_result"][$value["belonging_store"]] as $key2 => $value2) {
                $result["detail_result"][$value["belonging_store"]][$value2["interview_result"]] = $value2["count"];
            }

        }

        return $result;
    }

    private static function add_where($search = null)
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
