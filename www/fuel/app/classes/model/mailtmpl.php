<?php
namespace Model;
use \Model\Common;

class Mailtmpl extends \Model
{
	public static function get_data()
    {
        $sql = "SELECT * FROM mail_template ORDER BY id DESC";
        $masterData = Common::get_data( $sql );

        return $masterData;
    }

    public static function get_rowdata($id)
    {
        $sql = "SELECT * FROM mail_template WHERE id = $id";
        $masterData = Common::get_data( $sql );

        return $masterData;
    }

    public static function set_data($dataArray, $id)
    {
        unset($dataArray['submit']);

        if(isset($id)){
            $dataArray["updated_at"] = date("Y-m-d H:i");
        }else{
            $dataArray["created_at"] = date("Y-m-d H:i");
        }

        if(isset($dataArray["mailaddress"]) AND isset($dataArray["maildomain"])){
            $dataArray["mailaddress"] = $dataArray["mailaddress"] . "@" . $dataArray["maildomain"];
            unset($dataArray['maildomain']);
        }

        $result = Common::set_data($dataArray, $id, 'mail_template');

        return $result;
    }


    public static function delete($id)
    {
        $masterData = Common::del_data( $id, 'mail_template' );

        return $masterData;
    }
}