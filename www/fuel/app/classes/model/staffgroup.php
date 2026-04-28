<?php
namespace Model;
use \Model\Common;
use Fuel\Core\Config;

class Staffgroup extends \Model
{
    public static function get_rowdata($id)
    {
        $sql = "SELECT * FROM staff_group WHERE id = $id";
        $staff_group = Common::get_data( $sql );

        if(!empty($staff_group)){
            $group = explode(",", $staff_group[0]['group']);

            foreach ($group as $key => $value) {
                $staff_group[0]['group_data'][$value] = $value;
            }
        }

        return $staff_group;
    }

    public static function set_data($dataArray, $id)
    {
        $groupId = Staffgroup::is_groupId($id);

        if(isset($groupId)){
            $dataArray["updated_at"] = date("Y-m-d H:i");
        }else{
            $dataArray["created_at"] = date("Y-m-d H:i");
        }

        if(!isset($groupId)){
            Common::set_data($dataArray, $groupId,'staff_group');

        }else{
            Common::set_data($dataArray, $id, 'staff_group');
        }

        return $id;
    }

    public static function is_groupId($id)
    {
        $sql = "SELECT id FROM staff_group WHERE id = $id";

        $groupId = Common::get_data( $sql, 'one' );
        return $groupId;
    }
}