<?php
namespace Model;
use \Model\Common;
use Fuel\Core\Config;

class Scout extends \Model
{
    public static function get_shop_data($search = null)
    {
        $where = "";
        if(!empty($search)) {

            //所属店舗
            if(!empty($search['belonging_store_hidden'])){
                $whereList[] = "FIND_IN_SET(belonging_store, '$search[belonging_store_hidden]')";
            }

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

            //年齢
            $age_from = "";
            if($search['age_from']){
                $age_from = 'age >= ' . $search['age_from'];
            }

            $age_to = "";
            if($search['age_to']){
                $age_to = 'age <= ' . $search['age_to'];
            }

            if($age_from AND $age_to) {
                $whereList[] = "($age_from AND $age_to)";
            }elseif(!$age_from AND !$age_to){
                $whereList[] = "";
            }else{
                $whereList[] = "$age_from $age_to";
            }

            //身長
            $tall_from = "";
            if($search['tall_from']){
                $tall_from = 'tall >= ' . $search['tall_from'];
            }

            $tall_to = "";
            if($search['tall_to']){
                $tall_to = 'tall <= ' . $search['tall_to'];
            }

            if($tall_from AND $tall_to) {
                $whereList[] = "($tall_from AND $tall_to)";
            }elseif(!$tall_from AND !$tall_to){
                $whereList[] = "";
            }else{
                $whereList[] = "$tall_from $tall_to";
            }


            //体重
            $weight_from = "";
            if($search['weight_from']){
                $weight_from = 'weight >= ' . $search['weight_from'];
            }

            $weight_to = "";
            if($search['weight_to']){
                $weight_to = 'weight <= ' . $search['weight_to'];
            }

            if($weight_from AND $weight_to) {
                $whereList[] = "($weight_from AND $weight_to)";
            }elseif(!$weight_from AND !$weight_to){
                $whereList[] = "";
            }else{
                $whereList[] = "$weight_from $weight_to";
            }

            //住所
            if(!empty($search['shop_pref_hidden'])){
                $whereList[] = "FIND_IN_SET(pref, '$search[shop_pref_hidden]')";
            }

//            //都道府県
//            if($search['address']){
//                $whereList[] = "address = '$search[address]'";
//            }

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

        $sql = "SELECT * FROM interview_main LEFT JOIN interview_sub ON interview_main.id = interview_sub.id WHERE status = 2 $where ORDER BY interview_main.interview_date ASC";

//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo $sql;

        $scout_data = Common::get_data( $sql );

        return $scout_data;
    }

    public static function get_recruit_data($search = null)
    {
        $where = "";
        if(!empty($search)) {

//            if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($search);

            //掲載求人
            if(!empty($search['media'])){
                $whereList[] = 'media = ' . $search['media'];
            }

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

            //出稼ぎ
            if(!empty($search['working_away_flg'])){
                $whereList[] = 'working_away_flg = ' . $search['working_away_flg'];
            }

            //経験
            if(!empty($search['experience_hidden'])){
                $whereList[] = "FIND_IN_SET(experience, '$search[experience_hidden]')";
            }

            //年齢
            $age_from = "";
            if($search['age_from']){
                $age_from = 'age >= ' . $search['age_from'];
            }

            $age_to = "";
            if($search['age_to']){
                $age_to = 'age <= ' . $search['age_to'];
            }

            if($age_from AND $age_to) {
                $whereList[] = "($age_from AND $age_to)";
            }elseif(!$age_from AND !$age_to){
                $whereList[] = "";
            }else{
                $whereList[] = "$age_from $age_to";
            }

            //身長
            $tall_from = "";
            if($search['tall_from']){
                $tall_from = 'tall >= ' . $search['tall_from'];
            }

            $tall_to = "";
            if($search['tall_to']){
                $tall_to = 'tall <= ' . $search['tall_to'];
            }

            if($tall_from AND $tall_to) {
                $whereList[] = "($tall_from AND $tall_to)";
            }elseif(!$tall_from AND !$tall_to){
                $whereList[] = "";
            }else{
                $whereList[] = "$tall_from $tall_to";
            }

            //体重
            $weight_from = "";
            if($search['weight_from']){
                $weight_from = 'weight >= ' . $search['weight_from'];
            }

            $weight_to = "";
            if($search['weight_to']){
                $weight_to = 'weight <= ' . $search['weight_to'];
            }

            if($weight_from AND $weight_to) {
                $whereList[] = "($weight_from AND $weight_to)";
            }elseif(!$weight_from AND !$weight_to){
                $whereList[] = "";
            }else{
                $whereList[] = "$weight_from $weight_to";
            }

//            //住所
//            if(!empty($search['recruit_pref_hidden'])){
//                $whereList[] = "FIND_IN_SET(pref, '$search[recruit_pref_hidden]')";
//            }

            //都道府県
//            if($search['address']){
//                $whereList[] = "address = '$search[address]'";
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
        }

        $sql = "SELECT * FROM interview_main LEFT JOIN interview_sub ON interview_main.id = interview_sub.id WHERE status != 2 $where ORDER BY interview_main.submission_date ASC";

//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo $sql;

        $scout_data = Common::get_data( $sql );

//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($scout_data);

        return $scout_data;
    }
}