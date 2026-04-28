<?php
namespace Model;
use \Model\Common;

class Chase extends \Model
{
    public static function get_tracking_data($search = null)
    {
        $tracking_date = date("Y-m-d");

        $where = "";
        if(!empty($search)){
            //追跡予定日
            $scheduled_date_from =  $search['scheduled_date_year_from'] . '-' . $search['scheduled_date_month_from'] . '-' . $search['scheduled_date_day_from'];

            $scheduled_date_from_where = "";
            if(strptime($scheduled_date_from, '%Y-%m-%d')) {
                $scheduled_date_from_where = "interview_sub.scheduled_date >= '$scheduled_date_from'";
            }

            $scheduled_date_to =  $search['scheduled_date_year_to'] . '-' . $search['scheduled_date_month_to'] . '-' . $search['scheduled_date_day_to'];

            $scheduled_date_to_where = "";
            if(strptime($scheduled_date_to, '%Y-%m-%d')) {
                $scheduled_date_to_where = "interview_sub.scheduled_date <= '$scheduled_date_to'";
            }

            if($scheduled_date_from_where AND $scheduled_date_to_where) {
                $whereList[] = "($scheduled_date_from_where AND $scheduled_date_to_where)";
            }elseif(!$scheduled_date_from_where AND !$scheduled_date_to_where){
                $whereList[] = "";
            }else{
                $whereList[] = "$scheduled_date_from_where $scheduled_date_to_where";
            }

            //申込日
            $submission_from =  $search['submission_year_from'] . '-' . $search['submission_month_from'] . '-' . $search['submission_day_from'];

            $submission_from_where = "";
            if(strptime($submission_from, '%Y-%m-%d')) {
                $submission_from_where = "interview_main.submission_date >= '$submission_from'";
            }

            $submission_to =  $search['submission_year_to'] . '-' . $search['submission_month_to'] . '-' . $search['submission_day_to'];

            $submission_to_where = "";
            if(strptime($submission_to, '%Y-%m-%d')) {
                $submission_to_where = "interview_main.submission_date <= '$submission_to'";
            }

            if($submission_from_where AND $submission_to_where) {
                $whereList[] = "($submission_from_where AND $submission_to_where)";
            }elseif(!$submission_from_where AND !$submission_to_where){
                $whereList[] = "";
            }else{
                $whereList[] = "$submission_from_where $submission_to_where";
            }

//            if(!empty($search['staff_flg'])){
//                $whereList[] = "FIND_IN_SET(staff_flg, '$search[staff_flg]')";
//            }
            if(!empty($search['staff_hidden'])){
                $whereList[] = "FIND_IN_SET(staff_flg, '$search[staff_hidden]')";
            }

            if(!empty($search['recruit_hidden'])){
                $whereList[] = "FIND_IN_SET(media, '$search[recruit_hidden]')";
            }

            if(!empty($search['publicity_hidden'])){
                $whereList[] = "FIND_IN_SET(publicity, '$search[publicity_hidden]')";
            }

            if(!empty($search['reason_hidden'])){
                $whereList[] = "FIND_IN_SET(reason, '$search[reason_hidden]')";
            }

            // ID
            if(!empty($search['search_id'])){
                $whereList[] = "interview_main.id = '$search[search_id]'";
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

        // ディフォルトの表示は追跡予定日が当日のデータのみ表示
//        if($where === "") $where = "AND interview_sub.scheduled_date <= '$tracking_date' AND interview_sub.scheduled_date > 0";
//        if($where === "") $where = "AND interview_sub.scheduled_date = '$tracking_date' AND interview_sub.scheduled_date > 0";
        if($where === "") $where = "AND interview_sub.scheduled_date <= '$tracking_date' AND interview_sub.scheduled_date > 0";


        $sql = "
SELECT *
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE 1=1 $where
ORDER BY interview_sub.scheduled_date ASC, interview_sub.scheduled_date_hour ASC
";

//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo $sql;

        $tracking_data = Common::get_data( $sql );

        return $tracking_data;
    }

    public static function get_advance_contact_data()
    {
        $advance_contact_date = date("Y-m-d");

        $sql = "
SELECT *
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE 1=1
AND interview_main.advance_contact_date <= '$advance_contact_date'
AND interview_main.advance_contact_date > 0
AND interview_main.contact_flg = 0
ORDER BY advance_contact_date ASC, interview_sub.scheduled_date_hour ASC
";

//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r( $sql );

        $advance_contact_data = Common::get_data( $sql );

        return $advance_contact_data;
    }
}