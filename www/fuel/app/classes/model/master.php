<?php
namespace Model;
use \Model\Common;

class Master extends \Model
{
	public static function get_data($table)
    {
        if($table === "master_publicity" OR $table === "master_media"){
            $order = "ORDER BY namekana ASC, name ASC";
        }else{
            $order = "ORDER BY sort ASC";
        }


        $sql = "SELECT * FROM $table $order";
        $masterData = Common::get_data( $sql );

        return $masterData;
    }

    public static function get_rowdata($table, $id)
    {
        $sql = "SELECT * FROM $table WHERE id = $id";
        $masterData = Common::get_data( $sql );

        return $masterData;
    }

    public static function get_media_data($id)
    {
        $sql = "SELECT id, genre FROM master_media WHERE id = $id";
        $masterData = Common::get_data( $sql );

        return $masterData;
    }

    public static function find($table, $id)
    {
        $sql = "SELECT id FROM $table WHERE id = $id";
        $masterData = Common::get_data( $sql, 'one' );

        return $masterData;
    }

    public static function set_data($dataArray, $id, $table)
    {
        unset($dataArray['submit']);

        $count = 0;

        if(isset($id)){
            $dataArray["updated_at"] = date("Y-m-d H:i");

            $sql = "SELECT count(id) FROM $table WHERE id <> $id AND name = '$dataArray[name]'";
            $count = Common::get_data( $sql, "one" );
        }else{
            $dataArray["created_at"] = date("Y-m-d H:i");

            $sql = "SELECT count(id) FROM $table";
            $count = Common::get_data($sql, "one");
            $dataArray["sort"] = $count + 1;

            $sql = "SELECT count(id) FROM $table WHERE name = '$dataArray[name]'";
            $count = Common::get_data( $sql, "one" );
        }

        if(isset($dataArray["mailaddress"]) AND isset($dataArray["maildomain"])){
            $dataArray["mailaddress"] = $dataArray["mailaddress"] . "@" . $dataArray["maildomain"];
            unset($dataArray['maildomain']);
        }


        if($count == 0){
            $result = Common::set_data($dataArray, $id, $table);
        }else{
            $result = "error";
        }


        return $result;
    }

    public static function check_delete($column, $id)
    {

        if($column !== "group") {
            if ($column === "word") {
                $sql = "SELECT interview_main.id FROM interview_main LEFT JOIN interview_sub ON interview_main.id = interview_sub.id WHERE word1 = $id OR word2 = $id OR word3 = $id OR word4 = $id OR word5 = $id OR word6 = $id";
            } elseif ($column === "check") {
                $sql = "SELECT interview_main.id FROM interview_main LEFT JOIN interview_sub ON interview_main.id = interview_sub.id WHERE interview_main.{$column} = $id";
            } elseif ($column === "person") {
                $sql = "SELECT interview_main.id FROM interview_main LEFT JOIN interview_sub ON interview_main.id = interview_sub.id WHERE FIND_IN_SET($id, identity_card_select)";
            } elseif ($column === "experience") {
                $sql = "SELECT interview_main.id FROM interview_main LEFT JOIN interview_sub ON interview_main.id = interview_sub.id WHERE FIND_IN_SET($id, experience)";
            } elseif ($column === "maildomain") {
                $sql = "SELECT interview_main.id FROM interview_main LEFT JOIN interview_sub ON interview_main.id = interview_sub.id WHERE maildomain = '$id'";
            } elseif ($column === "staff") {
            $sql = "SELECT interview_main.id FROM interview_main LEFT JOIN interview_sub ON interview_main.id = interview_sub.id WHERE staff_id = '$id'";
            }else {
                $sql = "SELECT interview_main.id FROM interview_main LEFT JOIN interview_sub ON interview_main.id = interview_sub.id WHERE $column = $id";
            }

            $check_result = Common::get_data($sql);
        }else{
            $check_result = null;
        }

        return count($check_result);
    }

    public static function delete($table, $id)
    {
        if($table === "master_maildomain") {
            $masterData = Common::del_data_col( $id, $table, "name" );
        }elseif($table === "master_group"){
            $masterData = Common::del_data( $id, $table );
            $masterData = Common::del_data( $id, "staff_group" );
        }else{
            $masterData = Common::del_data( $id, $table );
        }



        return $masterData;
    }
}