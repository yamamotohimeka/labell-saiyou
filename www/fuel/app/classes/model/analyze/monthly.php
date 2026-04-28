<?php

namespace Model;
use \Model\Common;
use Fuel\Core\Config;

class Analyze_Monthly extends \Model
{
    public static function get_monthly($search = null)
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
                $where = " AND (" . $where . ")";
            }
        }

        //        $sql = "SELECT interview_main.id, interview_sub.interview_result, interview_sub.belonging_store, count(interview_main.id) AS count
        //FROM interview_main
        //LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
        //WHERE interview_sub.interview_result > 0 $where
        //GROUP BY interview_sub.interview_result
        //";
        $sql = "SELECT interview_main.id, interview_sub.interview_result, interview_sub.belonging_store, count(interview_main.id) AS count
    FROM interview_main
    LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
    WHERE interview_sub.interview_result > 0 AND interview_sub.belonging_store > 0 $where
    GROUP BY interview_sub.belonging_store
    ";

//                if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ){
//                    print_r($search);
//                    echo $sql;
//                }

        $result["total_result"] = Common::get_data($sql);

//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($result["total_result"]);

        if (!empty($result["total_result"])) {

            foreach ($result["total_result"] as $key => $value) {
                $sql = "SELECT interview_main.id, interview_sub.interview_result,interview_sub.belonging_store, COUNT( interview_main.id ) AS count
            FROM interview_main
            LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
            WHERE interview_sub.belonging_store = $value[belonging_store] $where
            GROUP BY interview_sub.interview_result
            ";

//                if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo $sql . "<hr />";

                $result["interview_result"][$value["belonging_store"]] = Common::get_data($sql);
//                if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($result["interview_result"]) . "<hr />";

                foreach ($result["interview_result"][$value["belonging_store"]] as $key2 => $value2) {
                    $result["detail_result"][$value["belonging_store"]][$value2["interview_result"]] = $value2["count"];
                }
//                if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($result["detail_result"]) . "<hr />";

                $sql = "SELECT count(interview_main.id) AS count
            FROM interview_main
            LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
            WHERE interview_sub.belonging_store = $value[belonging_store] $where";
//                if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($sql);

                $result["detail_result"][$value["belonging_store"]]["total"] = Common::get_data($sql, "one");

//                if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($result["detail_result"][$value["belonging_store"]]);

                //-----------------------------------
                // 求人/SC/出戻り/紹介/移籍 情報取得
                //-----------------------------------
                // 求人      : media 値が1以上の件数をカウント(要確認)
                // SC　 : scout 値が1以上の件数をカウント(要確認)
                // 出戻り    : move 値でグルーピングし、値毎の件数をカウント
                // 紹介      : move 値でグルーピングし、値毎の件数をカウント
                // 移籍      : move 値でグルーピングし、値毎の件数をカウント

                // belonging_store(店舗)毎の求人(media)を集計　　　 ：　値が1以上の件数をカウント
                $sql = "SELECT count(interview_main.id) AS count
                        FROM interview_main
                        LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
                        WHERE ( interview_sub.interview_result = 2 OR interview_sub.interview_result = 7 ) AND 
                        interview_sub.belonging_store = $value[belonging_store] AND interview_main.media > 0 $where";
                $media = Common::get_data($sql);
                if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($sql);
                foreach ($media as $key3 => $value3) {
                    $result["media"][$value["belonging_store"]] = $value3["count"];
                }
//                if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($result["media"]);

                // belonging_store(店舗)毎のSC(scout)を集計　 ：　値が1以上の件数をカウント
                $sql = "SELECT count(interview_main.id) AS count
                        FROM interview_main
                        LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
                        WHERE ( interview_sub.interview_result = 2 OR interview_sub.interview_result = 7 ) AND 
                        interview_sub.belonging_store = $value[belonging_store] AND 
                        interview_main.scout > 0 $where";
                $scout = Common::get_data($sql);
//                if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($sql);
                    foreach ($scout as $key4 => $value4) {
                    $result["scout"][$value["belonging_store"]] = $value4["count"];
                }

                // belonging_store(店舗)毎の出戻り・紹介・移籍(move)を集計　：値でグルーピングし、値毎の件数をカウント
                $sql = "SELECT interview_main.move, count(interview_main.id) AS count
                        FROM interview_main
                        LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
                        WHERE ( interview_sub.interview_result = 2 OR interview_sub.interview_result = 7 ) AND  
                        interview_sub.belonging_store = $value[belonging_store] AND
                        interview_main.move > 0 $where
                        GROUP BY interview_main.move";
//                if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo $sql;

                $move = Common::get_data($sql);
//                if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo $sql;
//                if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($move);

                if(empty($move)) {
                    $result["move"][$value["belonging_store"]][] = array(
                        "move"  => 0,
                        "count" => 0
                    );
                }else{
                    foreach ($move as $key5 => $value5) {
                        $result["move"][$value["belonging_store"]][] = array(
                            "move"  => $value5["move"],
                            "count" => $value5["count"]
                        );
                    }
                }

//                if(!empty($move)){
//                    foreach ($move as $key5 => $value5) {
//                        $result["move"][$value["belonging_store"]][] = array(
//                            "move"  => $value5["move"],
//                            "count" => $value5["count"]
//                        );
//                    }
//                }

            }

//            if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($result);
//            if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($result["detail_result"]);
//            if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($result["move"]);


            return $result;
        }
    }
}