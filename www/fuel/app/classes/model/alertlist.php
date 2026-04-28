<?php
namespace Model;
use \Model\Common;
use Fuel\Core\Config;

class Alertlist extends \Model
{
    public static function get_data()
    {
        $setting_data = Config::get('setting', array());
        $masterData = Inputdata::get_select_data($setting_data);

        $interview_date = date("Y-m-d");
        $interview_from_hour = date("Hi");

        // 明日の朝5
        $interview_tomorrow_date = date("Y-m-d", mktime (0,0,0,date("m"),date("d")+1,date("Y")));
        // 切替時間
        $set_tomorrow_hour = $setting_data['Switching_time'];
//        $set_tomorrow_hour = '11';
        $interview_tomorrow_hour = $set_tomorrow_hour . "00";

        // 1時間前までは表示中にする
        $interview_delete_hour = date("H") -1 . date("i");

//        if( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ){
            $where_set  = "( interview_date = '$interview_date' AND ";
            $where_set .= "CONCAT(interview_main.interview_hour, interview_main.interview_time) >= $interview_delete_hour ) ";
            $where_set .= "OR ";
            $where_set .= "( interview_date = '$interview_tomorrow_date' AND ";
            $where_set .= "CONCAT(interview_main.interview_hour, interview_main.interview_time) <= $interview_tomorrow_hour ) ";
            $where_set .= "ORDER BY interview_date";
//        }else{
//            $where_set  = "interview_date = '$interview_date' AND ";
//            $where_set .= "( CONCAT(interview_main.interview_hour, interview_main.interview_time) >= $interview_from_hour ";
//            $where_set .= "OR CONCAT(interview_main.interview_hour, interview_main.interview_time) >= $interview_delete_hour )";
//        }


//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo $interview_tomorrow_date . '<hr />';
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo $where_set . '<hr />';
            // 面接前確認 が（on）のみ表示
//        $whereCheck = "( interview_main.check = 2 or interview_main.check = 3 or interview_main.check = 4 or interview_main.check = 5 )";

        $sql = "
SELECT 
       interview_main.id, 
       interview_main.submission_name, 
       interview_main.interviewshop, 
       interview_main.media, 
       interview_main.interview_date, 
       interview_main.interview_hour, 
       interview_main.tentative_reserve_flg, 
       interview_main.interview_time, 
       interview_main.timer, 
       interview_main.timer_flg, 
       interview_main.timer, 
       interview_main.check, 
       interview_main.contact, 
       interview_main.tel01, 
       interview_main.tel02, 
       interview_main.tel03, 
       interview_main.place, 
       interview_main.place_remarks, 
       interview_sub.nikoiti_flg, 
       interview_sub.nikoiti 
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE interview_main.interview_send = 1 AND interview_main.status <= 1  AND interview_main.timer_flg = 0 AND $where_set";

//        AND ( CONCAT(interview_main.interview_hour, interview_main.interview_time) >= $interview_from_hour OR CONCAT(interview_main.interview_hour, interview_main.interview_time) >= $interview_delete_hour OR interview_main.timer < 0 )

        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo $sql;
        $alert_data = Common::get_data( $sql );

//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($alert_data);

        $timer_count = 0;
        if(!empty($alert_data)){
            foreach ($alert_data as $key => $value) {

//                $interview_date = $value["interview_date"] . " " . $value["interview_hour"] . ":" . $value["interview_time"];
//                 マイナスの場合（面接予定時間に『＋』プラスする *『-』マイナスだが『＋』プラス扱いになる！！）
                if($value["timer"] < "0"){
                    // 先頭の『-』を削除
                    $str = ltrim($value["timer"], '-');
                    // 面接予定時間 分解
                    $interviewDateArray = explode("-", $value["interview_date"]);
                    // 面接予定時間に『＋』プラスする
                    $interview_date = date("Y-m-d H:i:s", mktime($value["interview_hour"], $value["interview_time"] + $str, 00, $interviewDateArray[1], $interviewDateArray[2], $interviewDateArray[0]));
//                    if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo '<hr />' . $interview_date . '<hr />';
                }else{
                    $interview_date = $value["interview_date"] . " " . $value["interview_hour"] . ":" . $value["interview_time"];
                }


                if(isset($masterData['media'][$value['media']])){
                    $alert_data[$key]['media'] = $masterData['media'][$value['media']];
                }else{
                    $alert_data[$key]['media'] = "";
                }

                if(isset($masterData['place'][$value['place']])){
                    $alert_data[$key]['place'] = $masterData['place'][$value['place']];
                }else{
                    $alert_data[$key]['place'] = "";
                }

                //面接時間までを計算
                $diff_sec = strtotime($interview_date) - time();

//                    if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ){
//                        echo strtotime($interview_date) . '<br />';
//                        echo time() . '<br />';
//                        echo $value["timer"] . '<br />';
//                        echo $diff_sec . '<hr />';
//                    }


//                // マイナス（遅刻）の場合
//                if($value["timer"] < "0"){
//                    $timer = $value["timer"];
//                }else{
//                    if($value["timer"] === "0"){
//                        $timer = 120;
//                    }else{
//                        $timer = $value["timer"];
//                    }
//                }

                // 何分前設定？
                $timer = $value["timer"];

//                if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ){
//                    echo $timer . '<hr />';
//                    echo $value["timer_flg"] . '<hr />';
//                }

//                // 面接前確認が確認済みの場合
//                if($value["check"] === "6"){
//                    $timer = 0;
//                }

//                if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ){
//                    echo "interview_date->" . $interview_date . '<br />';
//                    echo "diff_sec->" . $diff_sec . '<br />';
//                    echo "time->" . $timer . '<br />';
//                    echo round($diff_sec/60) . '<br />';
//                    echo strval(round($diff_sec/60)) . '<br />';
//                    echo is_numeric(strval(round($diff_sec/60))) . '<hr />';
//                }


                    // 面接前確認 が（on）の場合はアラームを鳴らし続ける
                    if($value['check'] == 2 or $value['check'] == 3 or $value['check'] == 4 or $value['check'] == 5 or $value['check'] == 9 ){
                        $alert_data[$key]["checkalert"] = 1;
                    }

//                if($timer >= round($diff_sec/60) AND ctype_digit(strval(round($diff_sec/60)))){
                    if(is_numeric(strval(round($diff_sec/60)))){
                        //面接店舗
                        if(isset($masterData['interviewshop'][$value['interviewshop']])){
                            $alert_data[$key]['interviewshop'] = $masterData['interviewshop'][$value['interviewshop']];
                        }

                        //連絡方法
                        if(isset($masterData['contact'][$value['contact']])){
                            $alert_data[$key]['contact'] = $masterData['contact'][$value['contact']];
                        }

                        // 実際、何分前？
                        $alert_data[$key]['before'] = round($diff_sec/60);

//                        if($value["timer_flg"] == 0){

                            // マイナスの場合
                            if($alert_data[$key]['before'] < 0) {
//                                if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo '【koko1】' . $timer . ' | ' . $alert_data[$key]['before'];
                                if($timer == $alert_data[$key]['before'] ){
                                    if (!empty($alert_data[$key]["checkalert"])) {

                                        // 対象のデータをチカチカ光らせる
                                        $alert_data[$key]["timer_enable"] = 1;

                                        // チカチカ光るデータが1件でもあればアラームを鳴らす
                                        $timer_count = $timer_count + 1;
                                    }else{
                                        $alert_data[$key]["timer_enable"] = 0;
                                    }
                                // 面接時間が過ぎた場合
                                }else{
                                    if (!empty($alert_data[$key]["checkalert"])) {

                                        // 対象のデータを黄色にする
                                        $alert_data[$key]["timer_enable"] = 2;

                                        // チカチカ光るデータが1件でもあればアラームを鳴らす
                                        $timer_count = $timer_count + 1;
                                    }else{
                                        $alert_data[$key]["timer_enable"] = 0;
                                    }
                                }
                            }else {
                                if ($timer > $alert_data[$key]['before']) {
//                                    if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo '【koko2】' . $timer . ' | ' . $alert_data[$key]['before'];
                                    if (!empty($alert_data[$key]["checkalert"])) {
                                        // 対象のデータをチカチカ光らせる
                                        $alert_data[$key]["timer_enable"] = 1;

                                        // チカチカ光るデータが1件でもあればアラームを鳴らす
                                        $timer_count = $timer_count + 1;
                                    } else {
                                        $alert_data[$key]["timer_enable"] = 0;
                                    }

                                } else {
                                    if (!empty($alert_data[$key]["checkalert"])) {
//                                        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo '【koko3】' . $timer . ' | ' . $alert_data[$key]['before'];
                                        // 0分前設定の場合はジャストの時間になったら鳴らす
                                        if($timer == 0 and $alert_data[$key]['before'] == 0){
                                            // 対象のデータをチカチカ光らせる
                                            $alert_data[$key]["timer_enable"] = 1;

                                            // チカチカ光るデータが1件でもあればアラームを鳴らす
                                            $timer_count = $timer_count + 1;

                                        }else{
                                            $alert_data[$key]["timer_enable"] = 0;
                                        }

                                    } else {
//                                        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo '【koko4】' . $timer . ' | ' . $alert_data[$key]['before'];
                                        $alert_data[$key]["timer_enable"] = 0;
                                    }
                                }
                            }
//                        }else{
//                           if(!empty($alert_data[$key]["checkalert"])){
//                                $alert_data[$key]["timer_enable"] = 1;
//                            }else{
//                                $alert_data[$key]["timer_enable"] = 0;
//                            }
//                        }
                    }else{
                        unset($alert_data[$key]);
                    }
            }
        }

        $alert_data["timer_count"] = $timer_count;
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($alert_data);

        // 面接○○分前 順にソートし直し
        foreach ($alert_data as $key => $value){
            $key_id[$key] = $value['interview_date'] . ' ' . $value['interview_hour'] . ':' . $value['interview_time'];
//            $key_id[$key] = $value['before'];
        }
        array_multisort ( $key_id , SORT_ASC , $alert_data);

        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($alert_data);
        
        return $alert_data;
    }
}