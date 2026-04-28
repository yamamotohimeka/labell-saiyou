<?php
namespace Model;
use \Model\Common;

class Search extends \Model
{
    public static function get_data($search = null)
    {
        $tracking_date = date("Y-m-d");
        
        $where = "";
        if(!empty($search)){
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

            //申し込み時間
            $submission_hour_from = "";
            if($search['submission_hour_from']){
                $submission_hour_from = 'submission_hour >= ' . $search['submission_hour_from'];
            }

            $submission_hour_to = "";
            if($search['submission_hour_to']){
                $submission_hour_to = 'submission_hour <= ' . $search['submission_hour_to'];
            }

            if($submission_hour_from AND $submission_hour_to) {
                $whereList[] = "($submission_hour_from AND $submission_hour_to)";
            }elseif(!$submission_hour_from AND !$submission_hour_to){
                $whereList[] = "";
            }else{
                $whereList[] = "$submission_hour_from $submission_hour_to";
            }

            //申し込み名
            if($search['submission_name']){
                //        申し込み名に全角・半角のスペースがあれば除去
                $search['submission_name'] = str_replace(array(" ", "　"), "", $search['submission_name']);
                $whereList[] = "submission_name = '$search[submission_name]'";
            }

            //面接日
            $interview_from =  $search['interview_year_from'] . '-' . $search['interview_month_from'] . '-' . $search['interview_day_from'];

            $interview_from_where = "";
            if(strptime($interview_from, '%Y-%m-%d')) {
                $interview_from_where = "interview_main.interview_date >= '$interview_from'";
            }

            $interview_to =  $search['interview_year_to'] . '-' . $search['interview_month_to'] . '-' . $search['interview_day_to'];

            $interview_to_where = "";
            if(strptime($interview_to, '%Y-%m-%d')) {
                $interview_to_where = "interview_main.interview_date <= '$interview_to'";
            }

            if($interview_from_where AND $interview_to_where) {
                $whereList[] = "($interview_from_where AND $interview_to_where)";
            }elseif(!$interview_from_where AND !$interview_to_where){
                $whereList[] = "";
            }else{
                $whereList[] = "$interview_from_where $interview_to_where";
            }

            //面接店舗
            if(!empty($search['interviewshop_hidden'])){
                $whereList[] = "FIND_IN_SET(interviewshop, '$search[interviewshop_hidden]')";
            }

            //所属店舗
            if(!empty($search['belonging_store_hidden'])){
                $whereList[] = "FIND_IN_SET(belonging_store, '$search[belonging_store_hidden]')";
            }

            //源氏名
            if($search['genji_name']){
//                $whereList[] = "genji_name = '$search[genji_name]'";
                $whereList[] = "genji_name LIKE '$search[genji_name]%'";
            }

            //源氏名（かな）
            if($search['genji_namekana']){
//                $whereList[] = "genji_namekana = '$search[genji_namekana]'";
                $whereList[] = "genji_namekana LIKE '$search[genji_namekana]%'";
            }

            // ID
            if(!empty($search['search_id'])){
                $whereList[] = "interview_main.id = '$search[search_id]'";
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

            //名前 姓かな
            if($search['surnamekana']){
//                $whereList[] = "surnamekana = '$search[surnamekana]'";
                $whereList[] = "surnamekana LIKE '$search[surnamekana]%'";
            }

            //名前 名かな
            if($search['namekana']){
//                $whereList[] = "namekana = '$search[namekana]'";
                $whereList[] = "namekana LIKE '$search[namekana]%'";
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

            //カップ
            if(!empty($search['cup_hidden'])){
                $whereList[] = "FIND_IN_SET(cup, '$search[cup_hidden]')";
            }

//            $cup_from = "";
//            if($search['cup_from']){
//                $cup_from = 'cup >= ' . $search['cup_from'];
//            }
//
//            $cup_to = "";
//            if($search['cup_to']){
//                $cup_to = 'cup <= ' . $search['cup_to'];
//            }
//
//            if($cup_from AND $cup_to) {
//                $whereList[] = "($cup_from AND $cup_to)";
//            }elseif(!$cup_from AND !$cup_to){
//                $whereList[] = "";
//            }else{
//                $whereList[] = "$cup_from $cup_to";
//            }


            //経験
            if(!empty($search['experience_hidden'])){
//                $whereList[] = "FIND_IN_SET(experience, '$search[experience_hidden]')";
                $whereList[] = "FIND_IN_SET('$search[experience_hidden]', experience)";
            }

            //都道府県
            if(!empty($search['pref_hidden'])){
                $whereList[] = "FIND_IN_SET(pref, '$search[pref_hidden]')";
            }

            //面接前確認
            if(!empty($search['check_hidden'])){
                $whereList[] = "FIND_IN_SET(interview_main.check, '$search[check_hidden]')";
            }

            //住所
//            if($search['address']){
//            if($search['address_hidden']){
//                    $whereList[] = "address = '$search[address_hidden]'";
//            }

            //身分証
            if(!empty($search['identity_card_select_hidden'])){
//                $whereList[] = "FIND_IN_SET(apply_identity_card, '$search[identity_card_select_hidden]')";
                $whereList[] = "FIND_IN_SET('$search[identity_card_select_hidden]', apply_identity_card)";
            }

            //TEL
//            if($search['tel01'] AND $search['tel02'] AND $search['tel03']){
//                $whereList[] = "tel = " . $search['tel01'] . "-" . $search['tel02'] . "-" . $search['tel03'];
//            }
            if($search['tel01']){
                $whereList[] = "tel01 LIKE '$search[tel01]%'";
            }

            if($search['tel02']){
                $whereList[] = "tel02 LIKE '$search[tel02]%'";
            }

            if($search['tel03']){
                $whereList[] = "tel03 LIKE '$search[tel03]%'";
            }


            //MAIL
//            if($search['mail01'] AND $search['maildomain']){
//                $whereList[] = "(mail01 = $search[mail01] AND maildomain = $search[maildomain])";
//            }
            if($search['mail01']){
                $whereList[] = "mail01 LIKE '$search[mail01]%'";
            }
            if($search['maildomain']){
                $whereList[] = "FIND_IN_SET(maildomain, '$search[maildomain]')";
            }

            //面接結果
            if(!empty($search['interview_result_hidden'])){
                $whereList[] = "FIND_IN_SET(interview_result, '$search[interview_result_hidden]')";
            }

            //面接担当
            if(!empty($search['interview_staff_hidden'])){
                $whereList[] = "FIND_IN_SET(interview_staff, '$search[interview_staff_hidden]')";
            }

            //KS担当
            if(!empty($search['ks_staff_hidden'])){
                $whereList[] = "FIND_IN_SET(ks_staff, '$search[ks_staff_hidden]')";
            }

            //勤務形態
            if(!empty($search['work_hidden'])){
                $whereList[] = "FIND_IN_SET(work, '$search[work_hidden]')";
            }

            //給料
            $salary_from = "";
            if($search['salary_from']){
                $salary_from = 'salary >= ' . $search['salary_from'];
            }

            $salary_to = "";
            if($search['salary_to']){
                $salary_to = 'salary <= ' . $search['salary_to'];
            }

            if($salary_from AND $salary_to) {
                $whereList[] = "($salary_from AND $salary_to)";
            }elseif(!$salary_from AND !$salary_to){
                $whereList[] = "";
            }else{
                $whereList[] = "$salary_from $salary_to";
            }

            //特別指名料
            $nomination_fee_from = "";
            if($search['nomination_fee_from']){
                $nomination_fee_from = 'nomination_fee >= ' . $search['nomination_fee_from'];
            }

            $nomination_fee_to = "";
            if($search['nomination_fee_to']){
                $nomination_fee_to = 'nomination_fee <= ' . $search['nomination_fee_to'];
            }

            if($nomination_fee_from AND $nomination_fee_to) {
                $whereList[] = "($nomination_fee_from AND $nomination_fee_to)";
            }elseif(!$nomination_fee_from AND !$nomination_fee_to){
                $whereList[] = "";
            }else{
                $whereList[] = "$nomination_fee_from $nomination_fee_to";
            }

            //退店?
            if($search['leaving_check']){
                $whereList[] = "interview_sub.leaving_date > 0";
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

            //退店理由
            if(!empty($search['leaving_reason_hidden'])){
                $whereList[] = "FIND_IN_SET(leaving_reason, '$search[leaving_reason_hidden]')";
            }

            //掲載媒体
            if(!empty($search['publicity_hidden'])){
                $whereList[] = "FIND_IN_SET(publicity, '$search[publicity_hidden]')";
            }

            //掲載エリア
            if(!empty($search['area_hidden'])){
                $whereList[] = "FIND_IN_SET(area, '$search[area_hidden]')";
            }

            //掲載求人
            if(!empty($search['media_hidden'])){
                $whereList[] = "FIND_IN_SET(media, '$search[media_hidden]')";
            }

            //掲載業種
            if(!empty($search['genre_hidden'])){
                $whereList[] = "FIND_IN_SET(genre, '$search[genre_hidden]')";
            }

            //SC
//            if(empty($search['scout_hidden'])) $search['scout_hidden'] = 0;
//            if(!empty($search['scout_hidden']) OR $search['scout_hidden'] == 0){
//                $whereList[] = "FIND_IN_SET(scout, '$search[scout_hidden]')";
//            }
            if(!empty($search['scout_hidden'])){
                $whereList[] = "FIND_IN_SET(scout, '$search[scout_hidden]')";
            }


            //出戻り・移籍・紹介
            if(!empty($search['move_hidden'])){
                $whereList[] = "FIND_IN_SET(move, '$search[move_hidden]')";
            }

            //他店紹介
            if(!empty($search['another_shop_hidden'])){
                $whereList[] = "FIND_IN_SET(another_shop, '$search[another_shop_hidden]')";
            }

            //他店紹介備考
            if($search['another_shop_remarks']){
                $whereList[] = "another_shop_remarks = '$search[another_shop_remarks]'";
            }

            //検索ワード
            if(!empty($search['word_hidden'])){
                $whereList[] = "FIND_IN_SET(word1, '$search[word_hidden]') OR FIND_IN_SET(word2, '$search[word_hidden]') OR FIND_IN_SET(word3, '$search[word_hidden]') OR FIND_IN_SET(word4, '$search[word_hidden]') OR FIND_IN_SET(word5, '$search[word_hidden]') OR FIND_IN_SET(word6, '$search[word_hidden]')";
            }

            //出稼ぎ
            if($search['working_away_flg']){
                $whereList[] = "working_away_flg = 1";
            }

            //オファーメールからの申し込み
            if($search['scout_mail_flg']){
                $whereList[] = "scout_mail_flg = 1";
            }

            //店舗スタッフ
            if($search['staff_flg']){
                $whereList[] = "staff_flg = 1";
            }

            //ニコイチ
            if($search['nikoiti_flg']){
                $whereList[] = "nikoiti_flg = 1";
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

        if($where === "") $where = "AND interview_sub.scheduled_date = '$tracking_date'";

            $sql = "
SELECT *
FROM interview_main
LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
WHERE 1=1 $where
ORDER BY interview_main.submission_date ASC
";

        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) echo $sql;


        $tracking_data = Common::get_data( $sql );

        return $tracking_data;
    }
}