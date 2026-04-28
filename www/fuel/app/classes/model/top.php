<?php
namespace Model;
use \Model\Common;
use Fuel\Core\Config;
use Fuel\Core\Pagination;

class Top extends \Model
{
    public static function get_rowdata($search = null, $dataId = null)
    {

        $where = "";
        $get_pram = "";
        if(!empty($search)) {

            $get_pram = "?";
            foreach ($search as $key => $value) {
                if($key !== "/index"){
                    $get_pram = $get_pram . $key . "=" . $value . "&";
                }
            }
            $get_pram = rtrim($get_pram, "&");

            //面接日
            $interview_date_from =  $search['interview_date_year_from'] . '-' . $search['interview_date_month_from'] . '-' . $search['interview_date_day_from'];

            $interview_date_from_where = "";
            if(strptime($interview_date_from, '%Y-%m-%d')) {
                $interview_date_from_where = "interview_date >= '$interview_date_from'";
            }

            $interview_date_to =  $search['interview_date_year_to'] . '-' . $search['interview_date_month_to'] . '-' . $search['interview_date_day_to'];

            $interview_date_to_where = "";
            if(strptime($interview_date_to, '%Y-%m-%d')) {
                $interview_date_to_where = "interview_date <= '$interview_date_to'";
            }

            if($interview_date_from_where AND $interview_date_to_where) {
                $whereList[] = "($interview_date_from_where AND $interview_date_to_where)";
            }elseif(!$interview_date_from_where AND !$interview_date_to_where){
                $whereList[] = "";
            }else{
                $whereList[] = "$interview_date_from_where $interview_date_to_where";
            }

            //面接結果
            if(!empty($search['result_hidden'])){
                $whereList[] = "FIND_IN_SET(interview_result, '$search[result_hidden]')";
            }

            //面接担当
            if(!empty($search['interview_staff_hidden'])){
                $whereList[] = "FIND_IN_SET(interview_staff, '$search[interview_staff_hidden]')";
            }

            //源氏名
            if($search['genji_name']){
//                $whereList[] = "genji_name = '$search[genji_name]'";
                $whereList[] = "genji_name LIKE '$search[genji_name]%'";
            }

            //源氏名（ふりがな）
            if($search['genji_namekana']){
//                $whereList[] = "genji_namekana = '$search[genji_namekana]'";
                $whereList[] = "genji_namekana LIKE '$search[genji_namekana]%'";
            }

            // ID
            if(!empty($search['search_id'])){
                $whereList[] = "interview_main.id = '$search[search_id]'";
            }

            //所属店舗
            if(!empty($search['belonging_store_hidden'])){
                $whereList[] = "FIND_IN_SET(belonging_store, '$search[belonging_store_hidden]')";
            }

            //掲載求人
            if(!empty($search['media_hidden'])){
                $whereList[] = "FIND_IN_SET(media, '$search[media_hidden]')";
            }

            //名前(姓)
            if($search['surname']){
//                $whereList[] = "surname = '$search[surname]'";
                $whereList[] = "surname LIKE '$search[surname]%'";
            }

            //名前(名)
            if($search['name']){
//                $whereList[] = "name = '$search[name]'";
                $whereList[] = "name LIKE '$search[name]%'";
            }

            //名前かな(姓)
            if($search['surnamekana']){
//                $whereList[] = "surnamekana = '$search[surnamekana]'";
                $whereList[] = "surnamekana LIKE '$search[surnamekana]%'";
            }

            //名前かな(名)
            if($search['namekana']){
//                $whereList[] = "namekana = '$search[namekana]'";
                $whereList[] = "namekana LIKE '$search[namekana]%'";
            }

            //出稼ぎ
            if($search['emigrate']){
                $whereList[] = "working_away_flg = 1";
            }

            //ニコイチ
            if($search['peas']){
                $whereList[] = "nikoiti_flg = 1";
            }

            //退店日
            $leaving_from =  $search['leaving_year_from'] . '-' . $search['leaving_month_from'] . '-' . $search['leaving_day_from'];

            $leaving_from_where = "";
            if(strptime($leaving_from, '%Y-%m-%d')) {
                $leaving_from_where = "interview_sub.leaving_date >= '$leaving_from'";
            }

            $leaving_to =  $search['leaving_year_to'] . '-' . $search['leaving_month_to'] . '-' . $search['leaving_day_to'];

            $leaving_to_where = "";
            if(strptime($leaving_to, '%Y-%m-%d')) {
                $leaving_to_where = "interview_sub.leaving_date <= '$leaving_to'";
            }

            if($leaving_from_where AND $leaving_to_where) {
                $whereList[] = "($leaving_from_where AND $leaving_to_where)";
            }elseif(!$leaving_from_where AND !$leaving_to_where){
                $whereList[] = "";
            }else{
                $whereList[] = "$leaving_from_where $leaving_to_where";
            }


            //SC
//            if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($search);
//            if(empty($search['scout_hidden'])) $search['scout_hidden'] = 0;
//            if(!empty($search['scout_hidden']) AND $search['scout_hidden'] == 0){
            if(!empty($search['scout_hidden'])){
                $whereList[] = "FIND_IN_SET(scout, '$search[scout_hidden]')";
            }

            //出戻り・移籍・紹介
            if(!empty($search['move_hidden'])){
                $whereList[] = "FIND_IN_SET(move, '$search[move_hidden]')";
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

        if(isset($dataId)){
            $where = " AND interview_main.id = " . $dataId;
        }


        $sql = "
SELECT count(interview_main.id)
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE status = 2 $where
";

        $count = Common::get_data( $sql, "one" );
        $pager_url = "/index/index{$get_pram}";

        $config = array(
            'pagination_url' => $pager_url,
            'total_items' => $count,
            'per_page' => 10,
            'uri_segment' => 3,
            'num_links' => 20,
            'active' => '<span class="active">{link}</span>',
            'active-link'          => '{page}',
        );

        $pagination = Pagination::forge("mypagination", $config);

            $sql = "
SELECT * FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE status = 2 $where
ORDER BY adopt_send_date DESC, interview_main.id DESC
LIMIT $pagination->offset, $pagination->per_page
";
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo $sql;

            $interview_data = Common::get_data( $sql );
            if(!empty($interview_data)){
                // ナンバリング 設定
                $count_set = $count - $pagination->offset;
                foreach ($interview_data as $key => $value) {
                    // ナンバリング
                    $interview_data[$key]["number"] = $count_set - $key;
                    $sql = "SELECT img_id, no, ext FROM girl_image WHERE from_id = $value[id] AND no = 4";
                    $interview_data[$key]["image"] = Common::get_data( $sql );
                }
            }
            $interview_data["pager"] = $pagination;

//            if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) {
//                echo $count . '<hr />';
//                echo $pagination->offset;
//                print_r($interview_data);
//                var_dump($pagination);
//                exit;
//            }

            return $interview_data;

//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo print_r($search);

    }
}