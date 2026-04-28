<?php

namespace Model;
use \Model\Common;
use Fuel\Core\Config;

class Analyze_Time extends \Model
{

    public static function get_time($search = null)
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
count(interview_main.id) AS count
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE interview_main.scout = 0 AND interview_main.move = 0 AND interview_sub.scout_mail_flg = 0 AND 
interview_main.submission_hour > 0 $where
";
        $result["total_result"] = Common::get_data( $sql, "row" );


        $sql = "SELECT count(interview_main.id), interview_sub.belonging_store, interview_main.genre
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE interview_main.scout = 0 AND interview_main.move = 0 AND interview_sub.scout_mail_flg = 0 AND 
interview_main.submission_hour > 0 $where
GROUP BY genre
";
        $result["genre"] = Common::get_data( $sql );
        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo $sql;

        foreach ($result["genre"] as $key => $value) {
            $sql="SELECT
interview_main.id,
count(interview_main.id) AS count,
interview_main.submission_hour
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE interview_main.scout = 0 AND interview_main.move = 0 AND interview_sub.scout_mail_flg = 0 AND 
interview_main.genre = $value[genre] $where
GROUP BY submission_hour";

            $result["interview_result"][$value["genre"]] = Common::get_data( $sql );

            foreach ($result["interview_result"][$value["genre"]] as $key2 => $value2) {
                if(preg_match('/^([0-9]{1})$/', $value2['submission_hour'])) $value2['submission_hour'] = sprintf("%02d", $value2['submission_hour']);
                $result["detail_result"][$value["genre"]][$value2["submission_hour"]] = $value2["count"];
            }
        }
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($result["detail_result"]);
        
        return $result;


    }
}