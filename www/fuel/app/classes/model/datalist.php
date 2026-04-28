<?php
namespace Model;
use \Model\Common;
use Fuel\Core\Pagination;

class Datalist extends \Model
{
    public static function get_data($search = null, $sort = 'interview_main.updated_at')
    {

        $where = "";
        $get_pram = "";
        if(!empty($search)){

            $get_pram = "?";
            foreach ($search as $key => $value) {
                if($key !== "/datalist"){
                    $get_pram = $get_pram . $key . "=" . $value . "&";
                }
            }
            $get_pram = rtrim($get_pram, "&");

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

            // ID
            if(!empty($search['search_id'])){
                $whereList[] = "interview_main.id = '$search[search_id]'";
            }

            //申し込み名
            if($search['submission_name']){
                //        申し込み名に全角・半角のスペースがあれば除去
                $search['submission_name'] = str_replace(array(" ", "　"), "", $search['submission_name']);
//                $whereList[] = "submission_name = '$search[submission_name]'";
                $whereList[] = "submission_name LIKE '%$search[submission_name]%'";
            }

            //TEL
            if($search['tel01']){
                $whereList[] = "tel01 LIKE '$search[tel01]%'";
            }

            if($search['tel02']){
                $whereList[] = "tel02 LIKE '$search[tel02]%'";
            }

            if($search['tel03']){
                $whereList[] = "tel03 LIKE '$search[tel03]%'";
            }

            //メール
            if($search['mail']) {
//                $whereList[] = "CONCAT(mail01, '@', maildomain) LIKE '%$search[mail]%'";
                $whereList[] = "CONCAT(mail01, '@', maildomain) LIKE '$search[mail]%'";
            }

            //追跡状況
            if(!empty($search['stop_tracking_flg_hidden'])){
                $whereList[] = "FIND_IN_SET(stop_tracking_flg, '$search[stop_tracking_flg_hidden]')";
            }

            //掲載求人
            if(!empty($search['media_hidden'])){
                $whereList[] = "FIND_IN_SET(media, '$search[media_hidden]')";
            }

            //申込方法
            if(!empty($search['apply_hidden'])){
                $whereList[] = "FIND_IN_SET(apply, '$search[apply_hidden]')";
            }

            //名前 姓
            if($search['surname']){
//                $whereList[] = "surname = '$search[surname]'";
                $whereList[] = "surname LIKE '$search[surname]%'";
            }

            //名前 名
            if($search['name']){
//                $whereList[] = "name = '$search[name]'";
                $whereList[] = "name LIKE '$search[name]%'";
            }

            //名前 姓(ふりがな)
            if($search['surnamekana']){
//                $whereList[] = "surnamekana = '$search[surnamekana]'";
                $whereList[] = "surnamekana LIKE '$search[surnamekana]%'";
            }

            //名前 名(ふりがな)
            if($search['namekana']){
//                $whereList[] = "namekana = '$search[namekana]'";
                $whereList[] = "namekana LIKE '$search[namekana]%'";
            }

            //面接結果
            if(!empty($search['interview_result_hidden'])){
                $whereList[] = "FIND_IN_SET(interview_result, '$search[interview_result_hidden]')";
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

        $sql = "
SELECT count(interview_main.id)
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE 1=1 $where
";

        $count = Common::get_data( $sql, "one" );

        $pager_url = "/datalist/index{$get_pram}";

        $config = array(
            'pagination_url' => $pager_url,
            'total_items' => $count,
            'per_page' => 10,
            'uri_segment' => 3,
            'num_links' => 3,
            'active' => '<span class="active">{link}</span>',
            'active-link'          => '{page}',
        );

        $pagination = Pagination::forge("mypagination", $config);
        

        // 申し込み日順▼ の場合は古い順
        if( $sort == 'interview_main.submission_date' ){
            $sortSet = 'ASC';
        }else{
            $sortSet = 'DESC';
        }

        $sql = "
SELECT *
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE 1=1 $where
ORDER BY {$sort} {$sortSet}
LIMIT $pagination->offset, $pagination->per_page
";

        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r( $sql );

        $datalist = Common::get_data( $sql );
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r( $datalist );

        $datalist["pager"] = $pagination;

        return $datalist;
    }
}