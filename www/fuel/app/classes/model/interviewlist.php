<?php
namespace Model;
use \Model\Common;

class Interviewlist extends \Model
{
    public static function get_data($search = null)
    {
        $interview_date = date("Y-m-d");

        $where = "";

        if(!empty($search)){
            $interview_date_from =  $search['interview_date_year_from'] . '-' . $search['interview_date_month_from'] . '-' . $search['interview_date_day_from'];

            if(strptime($interview_date_from, '%Y-%m-%d')) {
                $whereList[] = "interview_date >= '$interview_date_from'";
            }

            $interview_date_to =  $search['interview_date_year_to'] . '-' . $search['interview_date_month_to'] . '-' . $search['interview_date_day_to'];

            if(strptime($interview_date_to, '%Y-%m-%d')) {
                $whereList[] = "interview_date <= '$interview_date_to'";
            }

            if(!empty($search['tenpo_hidden'])){
                $whereList[] = "FIND_IN_SET(interviewshop, '$search[tenpo_hidden]')";
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

        if($where === "") $where = "AND interview_date = '$interview_date'";

        $sql = "
SELECT *
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE status = 1 $where
ORDER BY interview_main.interview_date ASC
";

//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo $sql;

        $interview_data = Common::get_data( $sql );

        foreach ($interview_data as $key => $value){
            $interviewDateArray = explode('-', $value['interview_date']);
            $interview_data[$key]['interview_mktime'] = mktime(sprintf("%02d", $value['interview_hour']), sprintf("%02d", $value['interview_time']), 00, $interviewDateArray[1], $interviewDateArray[2], $interviewDateArray[0]);
            $interview_data[$key]['interview_time_set'] = date("Y-m-d H:i:s", $interview_data[$key]['interview_mktime']);
        }

//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($interview_data);

        // interview_mktime 順にソートし直し
        foreach ($interview_data as $key => $value){
            $key_id[$key] = $value['interview_mktime'];
        }
        array_multisort ( $key_id , SORT_ASC , $interview_data);
        
        return $interview_data;
    }
}