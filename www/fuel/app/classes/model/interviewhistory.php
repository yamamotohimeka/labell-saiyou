<?php
namespace Model;
use \Model\Common;

class Interviewhistory extends \Model
{
    private static $table = 'interview_history';
	public static function get_id($interview_id, $status='0')
    {

        $db = \DB::select();
        $db->from(self::$table);
        $db->where('interview_id', $interview_id);
        $db->where('status', $status);
        $db->limit(1);
        $result = $db->execute()->get('id');

        return !empty($result) ? $result : NULL;
    }

    public static function history_save($interview_id, $interview_result, $submission_date, $interview_date)
    {

        if( empty($interview_result) || $interview_result == '1' ){
            $status = '0';
        }elseif($interview_result == '2' || $interview_result == '7'){
            $status = '2';
        }else{
            $status = '1';
        }

        $history_id = self::get_id($interview_id, $status);

        if(empty($status)){
            //statusが0＝問い合わせの場合、他のstatusの履歴が存在する場合は削除する
            $set_data = self::set_save_data($interview_id, '0', $submission_date, $history_id);
            self::save_interview_history($set_data, $history_id);
            if(!empty($interview_id)){
                for($i = 1; $i <= 2; $i++){
                    $delete_history_id = self::get_id($interview_id, $i);
                    if( !empty($delete_history_id) ){
                        self::delete_interview_history($delete_history_id);
                    }
                }
            }
        }elseif( $status == '2' ){
            //statusが2＝当日入店 OR 7=後日入店の場合、他のstatusも更新する
            $set_data = self::set_save_data($interview_id, '2', $interview_date, $history_id);
            self::save_interview_history($set_data, $history_id);

            //問い合わせ履歴
            $history_submission_id = self::get_id($interview_id, 0);
            $set_data = self::set_save_data($interview_id, '0', $submission_date, $history_submission_id);
            self::save_interview_history($set_data, $history_submission_id);

            //面接履歴
            $history_interview_id = self::get_id($interview_id, 1);
            $set_data = self::set_save_data($interview_id, '1', $interview_date, $history_interview_id);
            self::save_interview_history($set_data, $history_interview_id);

        }else{
            //statusが1＝面接の場合、入店のstatusの履歴があれば削除する
            $set_data = self::set_save_data($interview_id, '1', $interview_date, $history_id);
            self::save_interview_history($set_data, $history_id);

            //問い合わせ履歴
            $history_submission_id = self::get_id($interview_id, 0);
            $set_data = self::set_save_data($interview_id, '0', $submission_date, $history_submission_id);
            self::save_interview_history($set_data, $history_submission_id);

            //入店履歴
            $delete_history_id = self::get_id($interview_id, 2);
            if( !empty($delete_history_id) ){
                self::delete_interview_history($delete_history_id);
            }
        }
    }


    public static function save_interview_history($set_data, $history_id = NULL)
    {
        Common::set_data($set_data, $history_id, self::$table);
    }

    public static function delete_interview_history($history_id)
    {
        Common::del_data($history_id, self::$table);
    }

    private static function set_save_data($interview_id, $status, $submission_date, $history_id = NULL)
    {
        if( !empty($history_id) ){
            $set_data = array('updated_at' => date('Y-m-d H:i:s'));
        }else{
            $set_data = array('created_at' => date('Y-m-d H:i:s'));
        }

        if( empty($status) ){
            $set_data += array(
                'interview_id' => $interview_id,
                'status' => 0,
                'submission_date' => $submission_date,
            );
        }elseif( $status == '2' || $status == '7' ){
            $set_data += array(
                'interview_id' => $interview_id,
                'status' => 2,
                'submission_date' => $submission_date,
            );
        }else{
            $set_data += array(
                'interview_id' => $interview_id,
                'status' => 1,
                'submission_date' => $submission_date,
            );
        }

        return $set_data;
    }


}