<?php

namespace Model;
use \Model\Common;
use Fuel\Core\Config;

class Analyze_Word extends \Model
{
    public static function get_word($search = null)
    {
        $where = "";
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

            //掲載業種
            if(!empty($search['select_genre_hidden'])){
//                $whereList[] = "genre = $search[select_genre_hidden]";
                $whereList[] = "FIND_IN_SET(genre, '$search[select_genre_hidden]')";
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

        $all_array = array();

        //総合
        $sql="SELECT count(interview_main.id) AS count, interview_sub.word3
            FROM interview_main
            LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
        WHERE
        interview_main.scout = 0 AND interview_main.move = 0 AND interview_sub.scout_mail_flg = 0 AND
interview_sub.word3 <> 0 AND interview_sub.word3 <> 2
$where
GROUP BY word3";

        $word3_data = Common::get_data( $sql );

        foreach ($word3_data as $key => $value) {
            $all_array[$value["word3"]] = $value["count"];
        }

        $sql="SELECT count(interview_main.id) AS count, interview_sub.word4
                    FROM interview_main
            LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
        WHERE
        interview_main.scout = 0 AND interview_main.move = 0 AND interview_sub.scout_mail_flg = 0 AND
interview_sub.word4 <> 0 AND interview_sub.word4 <> 2
$where
GROUP BY interview_sub.word4";

        $word4_data = Common::get_data( $sql );

        foreach ($word4_data as $key => $value) {
            if(array_key_exists($value["word4"], $all_array)){
                $all_array[$value["word4"]] = $value["count"] + $all_array[$value["word4"]];
            }else{
                $all_array[$value["word4"]] = $value["count"];
            }
        }

        $sql="SELECT count(interview_main.id) AS count, interview_sub.word5
                    FROM interview_main
            LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
        WHERE
        interview_main.scout = 0 AND interview_main.move = 0 AND interview_sub.scout_mail_flg = 0 AND
interview_sub.word5 <> 0 AND interview_sub.word5 <> 2
$where
GROUP BY interview_sub.word5";

        $word5_data = Common::get_data( $sql );

        foreach ($word5_data as $key => $value) {
            if(array_key_exists($value["word5"], $all_array)){
                $all_array[$value["word5"]] = $value["count"] + $all_array[$value["word5"]];
            }else{
                $all_array[$value["word5"]] = $value["count"];
            }
        }

        $sql="SELECT count(interview_main.id) AS count, interview_sub.word6
                    FROM interview_main
            LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
        WHERE
        interview_main.scout = 0 AND interview_main.move = 0 AND interview_sub.scout_mail_flg = 0 AND
interview_sub.word6 <> 0 AND interview_sub.word6 <> 2
$where
GROUP BY interview_sub.word6";

        $word6_data = Common::get_data( $sql );

        foreach ($word6_data as $key => $value) {
            if(array_key_exists($value["word6"], $all_array)){
                $all_array[$value["word6"]] = $value["count"] + $all_array[$value["word6"]];
            }else{
                $all_array[$value["word6"]] = $value["count"];
            }
        }

        arsort($all_array);
        $result["all_data"] = $all_array;
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($all_array);
//        $result["all_data"] = array_slice($all_array, 0, 10, true);







//        //エリア
//        $sql="SELECT count(interview_main.id) AS count, interview_sub.word3
//                    FROM interview_main
//            LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
//        WHERE
//interview_sub.word3 <> 0
//GROUP BY interview_sub.word3
//LIMIT 10";
//
//        $word3_data = Common::get_data( $sql );
//        foreach ($word3_data as $key => $value) {
//            $result["area_data"][$value["word3"]] = $value["count"];
//        }
//        arsort($result["area_data"]);
//
//        //業種
//        $sql="SELECT count(interview_main.id) AS count, interview_sub.word4
//                    FROM interview_main
//            LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
//        WHERE
//interview_sub.word4 <> 0
//GROUP BY interview_sub.word4
//LIMIT 10";
//
//        $word4_data = Common::get_data( $sql );
//        foreach ($word4_data as $key => $value) {
//            $result["industry_data"][$value["word4"]] = $value["count"];
//        }
//        arsort($result["industry_data"]);
//
//        //待遇
//        $sql="SELECT count(interview_main.id) AS count, interview_sub.word5
//                    FROM interview_main
//            LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
//        WHERE
//interview_sub.word5 <> 0
//GROUP BY interview_sub.word5
//LIMIT 10";
//
//        $word5_data = Common::get_data( $sql );
//        foreach ($word5_data as $key => $value) {
//            $result["treatment_data"][$value["word5"]] = $value["count"];
//        }
//        arsort($result["treatment_data"]);
//
//        //その他
//        $sql="SELECT count(interview_main.id) AS count, interview_sub.word6
//                    FROM interview_main
//            LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
//        WHERE
//interview_sub.word6 <> 0
//GROUP BY interview_sub.word6
//LIMIT 10";
//
//        $word6_data = Common::get_data( $sql );
//        foreach ($word6_data as $key => $value) {
//            $result["other_data"][$value["word6"]] = $value["count"];
//        }
//        arsort($result["other_data"]);

        return $result;
    }
}