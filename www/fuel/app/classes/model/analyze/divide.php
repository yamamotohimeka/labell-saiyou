<?php

namespace Model;
use \Model\Common;
use Fuel\Core\Config;

class Analyze_Divide extends \Model
{
    public static function get_divide($search = null)
    {
        $where = "";
        if(!empty($search)) {
//            //入店日
//            $submission_from =  $search['submission_year_from'] . '-' . $search['submission_month_from'] . '-' . $search['submission_day_from'];
//
//            $submission_from_where = "";
//            if(strptime($submission_from, '%Y-%m-%d')) {
//                $submission_from_where = "submission_date >= '$submission_from'";
//            }
//
//            $submission_to =  $search['submission_year_to'] . '-' . $search['submission_month_to'] . '-' . $search['submission_day_to'];
//
//            $submission_to_where = "";
//            if(strptime($submission_to, '%Y-%m-%d')) {
//                $submission_to_where = "submission_date <= '$submission_to'";
//            }
//
//            if($submission_from_where AND $submission_to_where) {
//                $whereList[] = "($submission_from_where AND $submission_to_where)";
//            }elseif(!$submission_from_where AND !$submission_to_where){
//                $whereList[] = "";
//            }else{
//                $whereList[] = "$submission_from_where $submission_to_where";
//            }

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

            //面接店舗
            if(!empty($search['shop_hidden'])){
                $whereList[] = "FIND_IN_SET(interview_main.interviewshop, '$search[shop_hidden]')";
            }

            //掲載求人
            if(!empty($search['recruit_hidden'])){
                $whereList[] = "FIND_IN_SET(interview_main.media, '$search[recruit_hidden]')";
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

        $sql = "SELECT count(interview_main.id) AS count
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE interview_send = 1 $where
";
        $result["total_result"] = Common::get_data( $sql );


        $sql = "SELECT interview_main.id, interview_main.publicity, interview_main.interviewshop
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE 1=1 $where
GROUP BY interview_main.interviewshop
";
        $result["interviewshop"] = Common::get_data( $sql );

//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo $sql;
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($result["interviewshop"]);
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ){
//            $setting_data = Config::get('setting', array());
//            $masterData = Inputdata::get_select_data($setting_data);
//            if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($masterData);
//        }



        foreach ($result["interviewshop"] as $key => $value) {
            $sql="SELECT
interview_main.id,
interview_main.media,
count(interview_main.id) AS count
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE interview_main.interviewshop = $value[interviewshop] $where
GROUP BY interview_main.media";

//            if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($sql);

                $result["interview_result"][$value["interviewshop"]] = Common::get_data( $sql );

//                if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($result["interview_result"]);

            foreach ($result["interview_result"][$value["interviewshop"]] as $key2 => $value2) {
                $result["detail_result"][$value["interviewshop"]][$value2["media"]] = $value2["count"];
            }
        }

        return $result;
    }
}