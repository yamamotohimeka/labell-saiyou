<?php
namespace Model;
use \Model\Common;
use Fuel\Core\Config;

class Interview extends \Model
{
    public static function get_data($search = null, $userData = null)
    {
        $setting_data = Config::get('setting', array());
        $interview_date = date("Y-m-d");

        // 明日
        $interview_tomorrow_date = date("Y-m-d", mktime (0,0,0,date("m"),date("d")+1,date("Y")));
        // 切替時間
        $set_tomorrow_hour = $setting_data['Switching_time'];
//        $set_tomorrow_hour = '11';
        $interview_tomorrow_hour = $set_tomorrow_hour . "00";

        $searchSet = '';
        $where = "";
        if(!empty($search)){

                if(empty($search['interview_date_day_from'])) $search['interview_date_day_from'] = date("d");
                if(empty($search['interview_date_day_to'])) $search['interview_date_day_to'] = date("d");

//            if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) {
                $interview_date_from =  $search['interview_date_year_from'] . '-' . $search['interview_date_month_from'] . '-' . $search['interview_date_day_from'];
                $interview_date_to =  $search['interview_date_year_to'] . '-' . $search['interview_date_month_to'] . '-' . $search['interview_date_day_to'];
                $interview_tomorrow_date_to = date("Y-m-d", mktime (0,0,0,$search['interview_date_month_to'],$search['interview_date_day_to']+1,$search['interview_date_year_to']));

                // 期間内の日付をすべて取得
                for($i=date('Ymd', strtotime($interview_date_from)); $i<=date('Ymd', strtotime($interview_date_to)); $i++) {
                    $year = substr($i, 0,4);
                    $month = substr($i, 4,2);
                    $day = substr($i, 6,2);
                    if(checkdate ( $month , $day , $year )) $days[] = date('Y-m-d', strtotime($i));
                }
                $whereSet = "";
                foreach($days AS $key => $value){
                    if($key == 0){
                        $whereSet .= "( interview_date = '$value' AND CONCAT(interview_main.interview_hour, interview_main.interview_time) >= $interview_tomorrow_hour ) ";
                    }else{
                        $whereSet .= " OR interview_date = '$value'";
                    }
                }
                $whereSet .= " OR ( interview_date = '$interview_tomorrow_date_to' AND CONCAT(interview_main.interview_hour, interview_main.interview_time) <= $interview_tomorrow_hour ) ";
                $whereList[] = $whereSet;

//            }else{
//                $interview_date_from =  $search['interview_date_year_from'] . '-' . $search['interview_date_month_from'] . '-' . $search['interview_date_day_from'];
//                $interview_date_from_where = "";
//
//                if(strptime($interview_date_from, '%Y-%m-%d')) {
//                    $interview_date_from_where = "interview_date >= '$interview_date_from'";
//                }
//
//                $interview_tomorrow_date_to = date("Y-m-d", mktime (0,0,0,$search['interview_date_month_to'],$search['interview_date_day_to']+1,$search['interview_date_year_to']));
//                $interview_date_to =  $search['interview_date_year_to'] . '-' . $search['interview_date_month_to'] . '-' . $search['interview_date_day_to'];
//                $interview_date_to_where = "";
//
//                if(strptime($interview_date_to, '%Y-%m-%d')) {
////                if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ){
//                    $interview_date_to_where .= "interview_date <= '$interview_date_to' OR ";
//                    $interview_date_to_where .= "( interview_date = '$interview_tomorrow_date_to' AND ";
//                    $interview_date_to_where .= "CONCAT(interview_main.interview_hour, interview_main.interview_time) <= $interview_tomorrow_hour ) ";
////                }else{
////                    $interview_date_to_where = "interview_date <= '$interview_date_to'";
////                }
//                }
//
//                if($interview_date_from_where AND $interview_date_to_where) {
////                if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ){
////                    $whereList[] = "($interview_date_from_where OR $interview_date_to_where)";
////                }else{
//                    $whereList[] = "($interview_date_from_where AND $interview_date_to_where)";
////                }
//                }elseif(!$interview_date_from_where AND !$interview_date_to_where){
//                    $whereList[] = "";
//                }else{
//                    $whereList[] = "$interview_date_from_where $interview_date_to_where";
//                }
//            }


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


            if(!empty($search['interviewshop_hidden'])){
                $searchSet .= " AND FIND_IN_SET(interviewshop, '$search[interviewshop_hidden]')";
            }

            if(!empty($search['check_hidden'])){
                $searchSet .= " AND FIND_IN_SET(interview_main.check, '$search[check_hidden]')";
            }


        }

        // ディフォルト
        if($where === ""){

//                $where  = "AND (( interview_date = '$interview_date' ) OR ";
//                $where .= "( interview_date = '$interview_tomorrow_date' AND ";
//                $where .= "CONCAT(interview_main.interview_hour, interview_main.interview_time) <= $interview_tomorrow_hour )) ";

                $where .= "AND ( interview_date = '$interview_date' AND CONCAT(interview_main.interview_hour, interview_main.interview_time) >= $interview_tomorrow_hour ) ";
                $where .= "OR ( interview_date = '$interview_tomorrow_date' AND CONCAT(interview_main.interview_hour, interview_main.interview_time) <= $interview_tomorrow_hour ) ";


        }


        // ログイン（求人センター or 店舗）によって表示データの切替
        if( isset($userData) ){
            // 求人センターの場合
            if($userData == 1){
                $status = 'status <= 1';
            }else{
                $status = 'status = 1 AND stop_tracking_flg = 2';
            }
        }


        $sql = "
SELECT *
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE interview_send = 1 AND $status $searchSet $where
ORDER BY interview_date ASC
";
//        ORDER BY interview_date ASC, interview_hour ASC, interview_time ASC

//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo $userData;
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ){
//            echo $sql;
////            exit;
//        }

        $interview_data = Common::get_data( $sql );

        $week = array('日','月','火','水','木','金','土');

        if(!empty($interview_data)){
            foreach ($interview_data as $key => $value){
                $interviewDateArray = explode('-', $value['interview_date']);
                $interview_data[$key]['interview_mktime'] = mktime(sprintf("%02d", $value['interview_hour']), sprintf("%02d", $value['interview_time']), 00, $interviewDateArray[1], $interviewDateArray[2], $interviewDateArray[0]);
                $interview_data[$key]['interview_time_set'] = date("Y-m-d H:i:s", $interview_data[$key]['interview_mktime']);

                // ★ 曜日（日本語）
                $w = (int)date('w', $interview_data[$key]['interview_mktime']); // 0=日〜6=土
                $interview_data[$key]['interview_weekday_ja'] = $week[$w];

            }

//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($interview_data);

            // interview_mktime 順にソートし直し
            foreach ($interview_data as $key => $value){
                $key_id[$key] = $value['interview_mktime'];
            }
            array_multisort ( $key_id , SORT_ASC , $interview_data);

//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($interview_data);

            return $interview_data;
        }

    }
}