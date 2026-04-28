<?php

namespace Model;

use \Model\Common;
use Fuel\Core\Config;

class Analyze_Area extends \Model
{
    public static function get_area($search = null)
    {
        $where = "";
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($search);
        if (!empty($search)) {
            //入店日
            $submission_from = $search['submission_year_from'] . '-' . $search['submission_month_from'] . '-' . $search['submission_day_from'];

            $submission_from_where = "";
            if (strptime($submission_from, '%Y-%m-%d')) {
                $submission_from_where = "submission_date >= '$submission_from'";
            }

            $submission_to = $search['submission_year_to'] . '-' . $search['submission_month_to'] . '-' . $search['submission_day_to'];

            $submission_to_where = "";
            if (strptime($submission_to, '%Y-%m-%d')) {
                $submission_to_where = "submission_date <= '$submission_to'";
            }

            if ($submission_from_where AND $submission_to_where) {
                $whereList[] = "($submission_from_where AND $submission_to_where)";
            } elseif (!$submission_from_where AND !$submission_to_where) {
                $whereList[] = "";
            } else {
                $whereList[] = "$submission_from_where $submission_to_where";
            }

            //掲載媒体
            if (!empty($search['media_hidden'])) {
                $whereList[] = "FIND_IN_SET(publicity, '$search[media_hidden]')";
            }

            //掲載求人
            if (!empty($search['recruit_hidden'])) {
                $whereList[] = "FIND_IN_SET(media, '$search[recruit_hidden]')";
            }

            if (!empty($whereList)) {
                $whereList = array_filter($whereList, "strlen");
                foreach ($whereList as $key => $value) {
                    if (isset($where) AND $value !== reset($whereList)) {
                        $where .= " AND ";
                    }
                    $where .= $value;
                }
            }

            if ($where !== "") {
                $where = " AND (" . $where . ")";
            }
        }


        $sql = "SELECT count(interview_main.id) AS count, interview_main.media, interview_main.publicity
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE 1=1 AND interview_main.media > 0 $where
GROUP BY media
";

        $result["media"] = Common::get_data($sql);
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo $sql;
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($result["media"]);

        foreach ($result["media"] as $key => $value) {
            $sql = "SELECT
interview_main.id,
interview_main.media,
interview_main.publicity,
count(interview_main.id) AS count,
interview_main.area
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE interview_main.media = $value[media]
$where
GROUP BY publicity";

            $media_data = Common::get_data($sql);

            foreach ($media_data as $key2 => $value2) {

                $sql = "SELECT
interview_main.id,
interview_main.media,
interview_main.publicity,
count(interview_main.id) AS count,
interview_main.area
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE interview_main.media = $value[media]
AND interview_main.publicity = $value2[publicity]
$where
GROUP BY area";

                $publicity_data = Common::get_data($sql);

                foreach ($publicity_data as $key3 => $value3) {
                    $result["detail_result"][$value["media"]][$value2["publicity"]][$value3["area"]] = $value3["count"];
                }

            }
        }

        return $result;
    }
}