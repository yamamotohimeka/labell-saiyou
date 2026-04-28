<?php

namespace Model;
use \Model\Common;
use Fuel\Core\Config;

class Analyze_Adopt extends \Model
{
    public static function get_adopt($search = null)
    {

        $where = "";
        if (!empty($search)) {
            //面接日
            $interview_from = $search['interview_year_from'] . '-' . $search['interview_month_from'] . '-' . $search['interview_day_from'];

            $interview_from_where = "";
            if (strptime($interview_from, '%Y-%m')) {
                $interview_from_where = "interview_date >= '$interview_from'";
            }

            $interview_to = $search['interview_year_to'] . '-' . $search['interview_month_to'] . '-' . $search['interview_day_to'];

            $interview_to_where = "";
            if (strptime($interview_to, '%Y-%m')) {
                $interview_to_where = "interview_date <= '$interview_to'";
            }

            if ($interview_from_where and $interview_to_where) {
                $whereList[] = "($interview_from_where AND $interview_to_where)";
            } elseif (!$interview_from_where and !$interview_to_where) {
                $whereList[] = "";
            } else {
                $whereList[] = "$interview_from_where $interview_to_where";
            }

            if (!empty($whereList)) {
                $whereList = array_filter($whereList, "strlen");
                foreach ($whereList as $key => $value) {
                    if (isset($where) and $value !== reset($whereList)) {
                        $where .= " OR ";
                    }
                    $where .= $value;
                }
            }

            if ($where !== "") {
//                $where = " AND (" . $where . ")";
                // 採用情報メール送信済みを必須条件
                $where = " AND interview_main.adopt_send = 1 AND (" . $where . ")";
            }
        }

        //全店の採用結果の取得
        $sql = "SELECT interview_main.id, interview_sub.interview_result, interview_sub.belonging_store, count(interview_main.id) AS count
    FROM interview_main
    LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
    WHERE interview_main.media > 0 AND interview_sub.interview_result > 0 AND interview_sub.belonging_store > 0 $where
    AND FIND_IN_SET(scout, '0')
    AND FIND_IN_SET(move, '0')
    GROUP BY interview_sub.interview_result
    ";
        $total_data = Common::get_data($sql);
        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo $sql;

        foreach ($total_data as $key => $value) {
            $result["total_result"][$value["interview_result"]] = $value["count"];
        }

//        //全店の採用数の id の取得
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ){
//            $sql = "SELECT interview_main.id FROM interview_main
//    LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
//    WHERE interview_main.media > 0 AND ( interview_sub.interview_result = 2 OR interview_sub.interview_result = 7 ) AND interview_sub.belonging_store > 0 $where
//    AND FIND_IN_SET(scout, '0')
//    AND FIND_IN_SET(move, '0')
//    ";
//            echo $sql;
//        }

        //通常（トータル）

        $sql = "SELECT interview_main.id, interview_sub.interview_result, interview_sub.belonging_store, count(interview_main.id) AS count
    FROM interview_main
    LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
    WHERE interview_main.media > 0 AND interview_sub.interview_result > 0 AND interview_sub.belonging_store > 0
    AND working_away_flg = 0
    AND FIND_IN_SET(scout, '0')
    AND FIND_IN_SET(move, '0')
    $where
    GROUP BY interview_sub.interview_result
    ";


        $default_data = Common::get_data($sql);

        foreach ($default_data as $key => $value) {
            $result["total_default_result"][$value["interview_result"]] = $value['count'];
        }

        if($default_data === array()){
            $result["total_default_result"][0] = 0;
        }


        //出稼ぎ（トータル）
        $sql = "SELECT interview_main.id, interview_sub.interview_result, interview_sub.belonging_store, count(interview_main.id) AS count
    FROM interview_main
    LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
    WHERE interview_main.media > 0 AND interview_sub.interview_result > 0 AND interview_sub.belonging_store > 0
    AND working_away_flg = 1
    AND FIND_IN_SET(scout, '0')
    AND FIND_IN_SET(move, '0')
    $where
    GROUP BY interview_sub.interview_result
    ";

        $dekasegi_data = Common::get_data($sql);

        foreach ($dekasegi_data as $key => $value) {
            $result["total_dekasegi_result"][$value["interview_result"]] = $value['count'];
        }

        if($dekasegi_data === array()){
            $result["total_dekasegi_result"][0] = 0;
        }

        //全店のデータ取得
        $sql = "SELECT interview_main.id, interview_sub.interview_result, interview_sub.belonging_store, count(interview_main.id) AS count
    FROM interview_main
    LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
    WHERE interview_main.media > 0 AND interview_sub.interview_result > 0 AND interview_sub.belonging_store > 0
    AND FIND_IN_SET(scout, '0')
    AND FIND_IN_SET(move, '0')
    $where
    GROUP BY interview_sub.belonging_store
    ";

        $result["all_store"] = Common::get_data($sql);


        if (!empty($result["all_store"])) {

            foreach ($result["all_store"] as $key => $value) {
                $sql = "SELECT interview_main.id, interview_sub.interview_result,interview_sub.belonging_store, COUNT( interview_main.id ) AS count
            FROM interview_main
            LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
            WHERE interview_sub.belonging_store = $value[belonging_store] $where 
            AND interview_main.media > 0 
            AND FIND_IN_SET(scout, '0')
            AND FIND_IN_SET(move, '0')
            GROUP BY interview_sub.interview_result
            ";

                //            if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo $sql . "<hr />";

                $result["interview_result"][$value["belonging_store"]] = Common::get_data($sql);

                foreach ($result["interview_result"][$value["belonging_store"]] as $key2 => $value2) {
                    $result["detail_result"][$value["belonging_store"]][$value2["interview_result"]] = $value2["count"];
                }

                $sql = "SELECT count(interview_main.id) AS count
            FROM interview_main
            LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
            WHERE interview_sub.belonging_store = $value[belonging_store] $where 
            AND interview_main.media > 0 
            AND FIND_IN_SET(scout, '0') 
            AND FIND_IN_SET(move, '0')";

                $result["detail_result"][$value["belonging_store"]]["total"] = Common::get_data($sql, "one");


                //通常
                $sql = "SELECT interview_main.id, interview_sub.interview_result,interview_sub.belonging_store, COUNT( interview_main.id ) AS count
            FROM interview_main
            LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
            WHERE interview_sub.belonging_store = $value[belonging_store]
            AND working_away_flg = 0
            AND interview_main.media > 0 
            AND FIND_IN_SET(scout, '0')
            AND FIND_IN_SET(move, '0')
            $where
            GROUP BY interview_sub.interview_result
            ";


                $default_data = Common::get_data($sql);

                foreach ($default_data as $key6 => $value6) {
                    $result["interview_result"][$value["belonging_store"]]["default"][$value6['interview_result']] = $value6['count'];
                }

                if($default_data === array()){
                    $result["interview_result"][$value["belonging_store"]]["default"][] = 0;
                }


                //出稼ぎ
                $sql = "SELECT interview_main.id, interview_sub.interview_result,interview_sub.belonging_store, COUNT( interview_main.id ) AS count
            FROM interview_main
            LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
            WHERE interview_sub.belonging_store = $value[belonging_store]
            AND working_away_flg = 1
            AND interview_main.media > 0 
            AND FIND_IN_SET(scout, '0')
            AND FIND_IN_SET(move, '0')
            $where
            GROUP BY interview_sub.interview_result
            ";

                $dekasegi_data = Common::get_data($sql);

                foreach ($dekasegi_data as $key7 => $value7) {
                    $result["interview_result"][$value["belonging_store"]]["dekasegi"][$value7['interview_result']] = $value7['count'];
                }

                if($dekasegi_data === array()){
                    $result["interview_result"][$value["belonging_store"]]["dekasegi"][] = 0;
                }
            }


//            if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($result);

                return $result;
        }
    }
}