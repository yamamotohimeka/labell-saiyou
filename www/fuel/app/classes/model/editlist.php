<?php
namespace Model;
use \Model\Common;

class Editlist extends \Model
{
    public static function get_data()
    {

        $sql = "
SELECT interview_main.id, editlist.id AS edit_id, interview_main.submission_name, interview_main.media, interview_sub.surname, interview_sub.name, login_users.profile_fields, editlist.updated_at
FROM editlist
LEFT JOIN interview_main ON interview_main.id = editlist.data_id
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
LEFT JOIN login_users ON login_users.id = editlist.user_id
WHERE 1=1
";
        $edit_data = Common::get_data( $sql );

        foreach ($edit_data as $key => $value) {
            $profileData = unserialize($value["profile_fields"]);

            if(!isset($profileData["name"])){
                $edit_data[$key]["user_name"] = "";
            }else{
                $edit_data[$key]["user_name"] = $profileData["name"];
            }

        }
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r( $edit_data );

        return $edit_data;
    }
}