<?php
namespace Model;
use \Model\Common;
use \Auth;
use Fuel\Core\Config;

class Inputdata extends \Model
{
    public static function get_rowdata($id)
    {
        $sql = "SELECT * FROM interview_main LEFT JOIN interview_sub ON interview_main.id = interview_sub.id  WHERE interview_main.id = $id";
        $interview_data = Common::get_data( $sql );



        $sql = Common::get_select_sql_class();
        $sql->query =  "SELECT * FROM interview_work_location 
          interview_work_location WHERE interview_work_location.main_id = ? ";
        $sql->params = array($id);
        $interview_data['work_location'] = Common::get_data( $sql );


        $sql = "SELECT img_id, no, ext FROM girl_image WHERE from_id = $id";
        $imageData = Common::get_data( $sql );

        foreach($imageData as $key=>$value){
            $interview_data[0]["image"][$value["no"]]["img_id"] = $value['img_id'];
            $interview_data[0]["image"][$value["no"]]["ext"] = $value['ext'];
        }

        $sql = "SELECT scheduled_date, responsible, passage FROM tracking_remarks WHERE interview_id = $id";
        $interview_data["tracking_remarks"] = Common::get_data( $sql );

        $sql = "SELECT means FROM other_means WHERE interview_id = $id";
        $interview_data["means"] = Common::get_data( $sql );

//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($interview_data);
        return $interview_data;
    }
    public static function get_Inputdata_join_master($id)
    {
        $db = Common::get_select_sql_class();

        $sql = <<<EOF
            SELECT interview_main.*, interview_sub.*
            , IF( master_interviewshop.name IS NULL, "", master_interviewshop.name) as interviewshop_name
            , IF( master_place.name IS NULL, "", master_place.name) as place_name
            , IF( master_media.name IS NULL, "", master_media.name) as media_name
            , IF( master_genre.name IS NULL, "", master_genre.name) as genre_name
            , IF( master_publicity.name IS NULL, "", master_publicity.name) as publicity_name
            , IF( master_area.name IS NULL, "", master_area.name) as area_name
            , IF( master_belonging_store.name IS NULL, "", master_belonging_store.name) as belonging_store_name
            FROM interview_main
            LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
            LEFT JOIN master_interviewshop ON interview_main.interviewshop = master_interviewshop.id
            LEFT JOIN master_place ON interview_main.place = master_place.id
            LEFT JOIN master_media ON interview_main.media = master_media.id
            LEFT JOIN master_genre ON interview_main.genre = master_genre.id
            LEFT JOIN master_publicity ON interview_main.publicity = master_publicity.id
            LEFT JOIN master_area ON interview_main.area = master_area.id
            LEFT JOIN master_experience ON interview_main.area = master_experience.id
            LEFT JOIN master_belonging_store ON interview_sub.belonging_store = master_belonging_store.id
            WHERE interview_main.id = ?

EOF;
        $db->query = $sql;
        $db->params = array($id);
        $interview_data = Common::get_data( $db );
        foreach( $interview_data as $key => $value ){
            if( !empty($value["experience"]) ){
                $experience_name = Common::get_data( "SELECT GROUP_CONCAT(`name`) as experience_name FROM `master_experience` WHERE `id` IN({$value["experience"]})", 'one' );
                $interview_data[$key]["experience_name"] = $experience_name;
                $interview_data[$key]["experience_flg"] = "経験あり";

            }else{
                $interview_data[$key]["experience_name"] = "";
                $interview_data[$key]["experience_flg"] = "経験なし";
            }
            if( !empty($value["identity_card_select"]) ){
                $identity_card_name = Common::get_data( "SELECT GROUP_CONCAT(`name`) as identity_card_name FROM `master_person` WHERE `id` IN({$value["identity_card_select"]})", 'one' );
                $interview_data[$key]["identity_card_name"] = $identity_card_name;
            }else{
                $interview_data[$key]["identity_card_name"] = "";
            }

        }
        $sql = "SELECT img_id, no, ext FROM girl_image WHERE from_id = $id";
        $imageData = Common::get_data( $sql );

        foreach($imageData as $key=>$value){
            $interview_data[0]["image"][$value["no"]]["img_id"] = $value['img_id'];
            $interview_data[0]["image"][$value["no"]]["ext"] = $value['ext'];
        }


        return $interview_data;

    }
//    public static function get_sameperson_data($id, $submission_name, $tel01, $tel02, $tel03)
    public static function get_sameperson_data($id, $surnamekana, $namekana, $tel01, $tel02, $tel03)
    {

//        $sql = "SELECT * FROM interview_main LEFT JOIN interview_sub ON interview_main.id = interview_sub.id WHERE (interview_main.submission_name = '$surnamekana' OR interview_main.tel01 = '$tel01' OR interview_main.tel02 = '$tel02' OR interview_main.tel03 = '$tel03') AND interview_main.id <> $id";
//        $sql = "SELECT * FROM interview_main LEFT JOIN interview_sub ON interview_main.id = interview_sub.id
//                WHERE ( interview_sub.surnamekana = '$surnamekana' AND interview_sub.namekana = '$namekana' ) OR
//                ( interview_main.tel01 = '$tel01' AND interview_main.tel02 = '$tel02' AND interview_main.tel03 = '$tel03') AND
//                interview_main.id <> $id";

        $where_set = "";
        if(!empty($surnamekana) AND !empty($namekana)){
            $where_set .= "( interview_sub.surnamekana = '$surnamekana' AND interview_sub.namekana = '$namekana' ) OR ";
        }
        if(!empty($tel01) AND !empty($tel02) AND !empty($tel03)){
            $where_set .= "( interview_main.tel01 = '$tel01' AND interview_main.tel02 = '$tel02' AND interview_main.tel03 = '$tel03' ) OR ";
        }
        $where_set = rtrim($where_set, ' OR');
        $sql = "SELECT * FROM interview_main LEFT JOIN interview_sub ON interview_main.id = interview_sub.id WHERE $where_set AND interview_main.id <> $id";
//        $fp = fopen('/var/www/re.sp-labelle.com/www/htdocs/log.txt','a');
//        fputs($fp, $sql);
//        fclose($fp);

        $interview_data = Common::get_data( $sql );
        foreach ($interview_data as $key => $value) {
            if(empty($value['id'])) {
                continue;
            }
            $sql = "SELECT img_id, no, ext FROM girl_image WHERE from_id = {$value['id']}";
            $imageData = Common::get_data( $sql );

            foreach($imageData as $key2=>$value2){
                $interview_data[$key]["image"][$value2["no"]]["img_id"] = $value2['img_id'];
                $interview_data[$key]["image"][$value2["no"]]["ext"] = $value2['ext'];
            }
        }

        return $interview_data;
    }

    public static function set_data($dataArray, $id)
    {

//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ){
//            print_r($dataArray);
//            exit;
//        }

//        申し込み名に全角・半角のスペースがあれば除去
        if(!empty($dataArray['submission_name'])) $dataArray['submission_name'] = str_replace(array(" ", "　"), "", $dataArray['submission_name']);

        if($dataArray["usergroup"] == 1){
            $data = Inputdata::generate_main_data($dataArray, $id);
        }elseif($dataArray["usergroup"] == 2){
            $data = Inputdata::generate_main_data_shopuser($dataArray, $id);
        }else{
            return false;
        }


        $result = Common::set_data($data, $id, 'interview_main');

        if(!isset($id)){
            $sub_data = Inputdata::generate_sub_data($dataArray, $result);

            Common::set_data($sub_data, $id, 'interview_sub');
            $id = $result["id"];

            if(isset($dataArray["copy_imgId"])){
                Inputdata::set_copy_image($dataArray["copy_imgId"], $id);
            }

            if(isset($dataArray["means_data"])){
                Inputdata::set_means_data($dataArray["means_data"], $id);
            }

        }else{
            $sub_data = Inputdata::generate_sub_data($dataArray, $id);
            Common::set_data($sub_data, $id, 'interview_sub');

            Inputdata::set_tracking_data($dataArray["tracking_data"], $id);

            Inputdata::set_means_data($dataArray["means_data"], $id);

        }

        //希望店舗
        if($id) {
            Common::del_data_col($id, 'interview_work_location', 'main_id');
            $locations = Inputdata::generate_work_location_data($dataArray, $id);
            foreach($locations as $location) {
                Common::set_data($location, null, 'interview_work_location');
            }
        }

        Common::del_data_col($id, 'editlist', 'data_id');

        return $id;
    }

    public static function last_insert_id()
    {
        $sql = "SELECT LAST_INSERT_ID();";
        $last_insert_id = Common::get_data( $sql, 'one' );

        return $last_insert_id;
    }

    public static function generate_main_data($data, $id){

        $staff_id = Auth::get_user_id();

//      if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) {
//        print_r($data);
//        exit;
//      }

//            // ★
//            if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) {
                $submission_date_array = Common::calendar_array_data($data["submission_date"]);
                $submission_date = $submission_date_array[0];
                $submission_hour = $submission_date_array[1];
                $submission_time = $submission_date_array[2];

                if(!empty($data["interview_date"])){
                    $interview_date_array = Common::calendar_array_data($data["interview_date"]);
                    $interview_date = $interview_date_array[0];
                    $interview_hour = $interview_date_array[1];
                    $interview_time = $interview_date_array[2];
                }else{
                    $interview_date = '';
                    $interview_hour = '';
                    $interview_time = '';
                }

                $advance_contact_date = '';
                if(!empty($data["advance_contact_date"])) $advance_contact_date = $data["advance_contact_date"];

//            }else{
//                $submission_date = $data["submission_year"] . '-' . $data["submission_month"] . '-' . $data["submission_day"];
//                $submission_hour = $data['submission_hour'];
//                $submission_time = $data['submission_time'];
//
//                $interview_date = $data["interview_year"] . '-' . $data["interview_month"] . '-' . $data["interview_day"];
//                $interview_hour = $data['interview_hour'];
//                $interview_time = $data['interview_time'];
//
//                $advance_contact_date = $data["advance_contact_date_year"] . '-' . $data["advance_contact_date_month"] . '-' . $data["advance_contact_date_day"];
//
//            }

//            $tel = $data["tel01"] . '-' . $data["tel02"] . '-' . $data["tel03"];

//        if($data['check'] == 6){
//            $data['timer'] = '';
//        }elseif($data['check'] == 10 OR $data['check'] == 3 OR $data['check'] == 4){
//            $data['timer_flg'] = 1;
//        }
        
        if(empty($data['introduction_listening_flg'])) $data['introduction_listening_flg'] = 0;
        if(empty($data['confirm_introduction'])) $data['confirm_introduction'] = 0;



        if(empty($data['media'])) $data['media'] = 0;
        if(empty($data['genre'])) $data['genre'] = 0;
        if(empty($data['area'])) $data['area'] = 0;
        if(empty($data['scout'])) $data['scout'] = 0;
        if(empty($data['move'])) $data['move'] = 0;
        if(empty($data['publicity'])) $data['publicity'] = 0;


          $main_data = array(
              'staff_id' => $staff_id[1],
              'submission_date' => $submission_date,
              'submission_hour' => $submission_hour,
              'submission_time' => $submission_time,
              'apply' => $data['apply'],
              'submission_name' => $data['submission_name'],
              'contact'         => $data['contact'],
              'check'    => $data['check'],
              'timer_flg'       => $data['timer_flg'],
              'interview_date'  => $interview_date,
              'interview_hour'  => $interview_hour,
              'interview_time'  => $interview_time,
              'timer'  => $data['timer'],
              'tentative_reserve_flg'  => $data['tentative_reserve_flg'],
              'advance_contact_date' => $advance_contact_date,
              'contact_flg'     => $data['contact_flg'],
              'staff_flg'       => $data['staff_flg'],
              'interviewshop'   => $data['interviewshop'],
              'place'           => $data['place'],
              'place_remarks'   => $data['place_remarks'],
              'tel01'           => $data["tel01"],
              'tel02'           => $data["tel02"],
              'tel03'           => $data["tel03"],
              'mail01'          => $data['mail01'],
              'maildomain'      => $data['maildomain'],
              'age'             => $data['age'],
              'experience'      => $data['experience_hidden'],
              'experience_remarks' => $data['experience_remarks'],
              'tall'            => $data['tall'],
              'weight'          => $data['weight'],
              'bmi'             => $data['bmi'],
              'bust'            => $data['bust'],
              'cup'             => $data['cup'],
              'waist'           => $data['waist'],
              'hip'             => $data['hip'],
              'hope_back_flg'   => $data['hope_back_flg'],
              'hope_back_price' => $data['hope_back_price'],
              'warranty_flg'    => $data['warranty_flg'],
              'warranty_time'   => $data['warranty_time'],
              'warranty_price'  => $data['warranty_price'],
              'celebration_flg' => $data['celebration_flg'],
              'celebration_price' => $data['celebration_price'],
              'send_to_home_flg' => $data['send_to_home_flg'],
              'send_to_shop_flg' => $data['send_to_shop_flg'],
              'advance_salary_flg'  => $data['advance_salary_flg'],
              'menses_flg'          => $data['menses_flg'],
              'transportation_expenses_flg' => $data['transportation_expenses_flg'],
              'dorm_flg'        => $data['dorm_flg'],
              'single_room_wait_flg'        => $data['single_room_wait_flg'],
              'tatoo_flg'       => $data['tatoo_flg'],
              'nursery_flg'     => $data['nursery_flg'],
              'experience_possible_flg' => $data['experience_possible_flg'],
              'without_prior_flg' => $data['without_prior_flg'],
              'apply_identity_card' => $data['apply_identity_card_hidden'],
              'apply_identity_card_remark'   => $data['apply_identity_card_remark'],
              'residence_flg'   => $data['residence_flg'],
              'residence'       => $data['residence'],
//              'confirmed_flg'   => $data['confirmed_flg'],
              'same_person_flg' => $data['same_person_flg'],
//              'hope_workplace' => $data['hope_workplace'],
              'hope_workplace' => $data['hope_workplace_hidden'],
//              'introduction_listening_flg' => $data['introduction_listening_flg'],
              'confirm_introduction' => $data['confirm_introduction'],
              'other_flg'       => $data['other_flg'],
              'other'           => $data['other'],
              'media'           => $data['media'],
              'genre'           => $data['genre'],
              'publicity'           => $data['publicity'],
              'area'           => $data['area'],
              'scout'           => $data['scout'],
              'move'           => $data['move']
          );

        if(isset($id)){
            $main_data["updated_at"] = date("Y-m-d H:i");
        }else{
            $main_data["updated_at"] = date("Y-m-d H:i");
            $main_data["created_at"] = date("Y-m-d H:i");
        }
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ){
//            print_r($main_data);
//            exit;
//        }
        return $main_data;
    }

    public static function generate_sub_data($data, $id){

        // ★
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) {
            $leaving_date = $data["leaving_date"];
            $working_date = $data["working_day_date"];

            // 追跡理由が空の場合は（7 => 前日ストップ）を登録
            if(empty($data['reason'])){
                $reason = 7;
            }else{
                $reason = $data["reason"];
            }

            // 追跡予定日時が空の場合は翌日を登録
            if(empty($data['scheduled_date'])){
                $scheduled_date = date("Y-m-d", strtotime("+1 day"));
            }else{
                $scheduled_date = $data["scheduled_date"];
            }

            if(empty($data['scheduled_date_hour'])){
                $scheduled_date_hour = null;
            }else{
                $scheduled_date_hour = sprintf("%02d", $data["scheduled_date_hour"]);
            }

//        }else{
//            $leaving_date = $data["leaving_year"] . '-' . $data["leaving_month"] . '-' . $data["leaving_day"];
//            $working_date = $data["working_day_year"] . '-' . $data["working_day_month"] . '-' . $data["working_day_day"];
//
//            if($data["scheduled_date_year"] AND $data["scheduled_date_month"] AND $data["scheduled_date_day"]){
//                $scheduled_date = $data["scheduled_date_year"] . '-' . $data["scheduled_date_month"] . '-' . $data["scheduled_date_day"];
//            }else{
////            $scheduled_date = date("Y-m-d", strtotime("+1 month"));
//                $scheduled_date = date("Y-m-d", strtotime("+1 day"));
//            }
//            if(empty($data['scheduled_date_hour'])){
//                $scheduled_date_hour = null;
//            }else{
//                $scheduled_date_hour = $data['scheduled_date_hour'];
//            }
//        }

        if($data["stop_tracking_flg"] === "2"){
            $scheduled_date = "";
        }


        // 検索ワード：1.大阪、2.風俗 を固定にし入力項目を3個までに変更の為
        $data['word1'] = 0;
        $data['word2'] = 0;

        $multiple_word_array = array(
            $data['word1'],
            $data['word2'],
            $data['word3'],
            $data['word4'],
            $data['word5'],
            $data['word6']
        );

        $word_count = 0;
        foreach ($multiple_word_array as $key => $value) {
            if($value){
                $word_count += 1;
            }
        }

        $multiple_word = $data['word1'] . " " . $data['word2'] . " " . $data['word3'] . " " . $data['word4'] . " " . $data['word5'] . " " . $data['word6'];

        $multiple_word = trim($multiple_word);


            $sub_data = array(
            'id'                => $id,
            'belonging_store'   => $data['belonging_store'],
            'genji_name'        => $data['genji_name'],
            'genji_namekana'    => $data['genji_namekana'],
            'leaving_date'      => $leaving_date,
            'leaving_reason'    => $data['leaving_reason'],
            'surname'           => $data['surname'],
            'name'              => $data['name'],
            'surnamekana'       => $data['surnamekana'],
            'namekana'          => $data['namekana'],
            'pref'              => $data['pref'],
            'address'           => $data['address'],
            'interview_result'  => $data['interview_result'],
            'interview_staff'   => $data['interview_staff'],
            'interview_staff_sub' => $data['interview_staff_sub'],
            'ks_staff'          => $data['ks_staff'],
            'work'              => $data['work'],
            'identity_card_select' => $data['identity_card_select_hidden'],
            'identity_card_remarks' => $data['identity_card_remarks'],
            'salary'            => $data['salary'],
            'nomination_fee'    => $data['nomination_fee'],
            'another_shop'      => $data['another_shop'],
            'another_shop_remarks' => $data['another_shop_remarks'],
            'word1'             => $data['word1'],
            'word2'             => $data['word2'],
            'word3'             => $data['word3'],
            'word4'             => $data['word4'],
            'word5'             => $data['word5'],
            'word6'             => $data['word6'],
            'word_remarks'      => $data['word_remarks'],
            'multiple_word'     => $multiple_word,
            'word_count'       => $word_count,
            'nikoiti_flg'       => $data['nikoiti_flg'],
            'nikoiti'           => $data['nikoiti'],
            'working_away_flg'  => $data['working_away_flg'],
            'days_to_work_num'  => $data['days_to_work_num'],
            'scout_mail_flg'    => $data['scout_mail_flg'],
            'working_day_date'  => $working_date,
            'working_day_undecided_flg' => $data['working_day_undecided_flg'],
            'remarks'           => $data['remarks'],
            'reason'            => $reason,
            'scheduled_date'    => $scheduled_date,
            'scheduled_date_hour' => $scheduled_date_hour,
            'stop_tracking_flg' => $data['stop_tracking_flg'],
            'memo'              => $data['memo']
        );

//            $sub_data["confirmation_chk"] = $data['confirmation_chk'];
//            $sub_data["confirmation_date"] = $data['confirmation_date'];

            $sub_data["confirmation_chk_1"] = $data['confirmation_chk_1'];
            $sub_data["confirmation_date_1"] = $data['confirmation_date_1'];
            $sub_data["confirmation_chk_2"] = $data['confirmation_chk_2'];
            $sub_data["confirmation_date_2"] = $data['confirmation_date_2'];
            $sub_data["confirmation_chk_3"] = $data['confirmation_chk_3'];
            $sub_data["confirmation_date_3"] = $data['confirmation_date_3'];
            $sub_data["confirmation_chk_4"] = $data['confirmation_chk_4'];
            $sub_data["confirmation_date_4"] = $data['confirmation_date_4'];
            
        if(isset($id)){
            $sub_data["updated_at"] = date("Y-m-d H:i");
        }else{
            $sub_data["updated_at"] = date("Y-m-d H:i");
            $sub_data["created_at"] = date("Y-m-d H:i");
        }

        return $sub_data;
    }

  public static function generate_sub_tracking_remarks_data($data, $id){
        
     // 追跡理由が空の場合は（7 => 前日ストップ）を登録
     if(empty($data['reason'])){
       $reason = 7;
     }else{
       $reason = $data["reason"];
     }

    // 追跡予定日時が空の場合は翌日を登録
    if(empty($data['scheduled_date'])){
      $scheduled_date = date("Y-m-d", strtotime("+1 day"));
    }else{
      $scheduled_date = $data["scheduled_date"];
    }

    if(empty($data['scheduled_date_hour'])){
      $scheduled_date_hour = null;
    }else{
      $scheduled_date_hour = sprintf("%02d", $data["scheduled_date_hour"]);
    }

    if($data["stop_tracking_flg"] === "2"){
      $scheduled_date = "";
    }

    $sub_data = array(
      'id'                => $id,
      'reason'            => $reason,
      'scheduled_date'    => $scheduled_date,
      'scheduled_date_hour' => $scheduled_date_hour,
      'stop_tracking_flg' => $data['stop_tracking_flg'],
      'updated_at' => date("Y-m-d H:i")
    );

    return $sub_data;
  }

    public static function generate_work_location_data($data, $id)
    {
        $result = array();
        if(!isset($data['work_location'])) {
            return $result;
        }
        foreach($data['work_location'] as $key => $work) {
            if(!empty($work)) {
                $work_location = array(
                    'main_id'        => $id,
                    'location_id'   => (string)$key,
                    'updated_at'    => date("Y-m-d H:i"),
                    'created_at'    => date("Y-m-d H:i")
                );
                $result[] = $work_location;
            }
        }
        return $result;
    }


    public static function generate_main_data_shopuser($data, $id){
        $staff_id = Auth::get_user_id();

//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ){
//            print_r($data);
//            exit;
//        }

        // ★
//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) {
//            if(!empty($data["interview_date"])){
//                $interview_date_array = explode(" ", $data["interview_date"]);
//                $interview_date = $interview_date_array[0];
//            }else{
//                $interview_date = '';
//            }

//        }else{
//            $interview_date = $data["interview_year"] . '-' . $data["interview_month"] . '-' . $data["interview_day"];
//        }

//        $tel = $data["tel01"] . '-' . $data["tel02"] . '-' . $data["tel03"];

            $main_data = array(
            'staff_id' => $staff_id[1],
//            'interview_date'  => $interview_date,
            'publicity'       => $data['publicity'],
            'genre'           => $data['genre'],
            'tel01'           => $data["tel01"],
            'tel02'           => $data["tel02"],
            'tel03'           => $data["tel03"],
            'mail01'          => $data['mail01'],
            'maildomain'      => $data['maildomain'],
            'age'             => $data['age'],
            'experience'      => $data['experience_hidden'],
            'experience_remarks' => $data['experience_remarks'],
            'tall'            => $data['tall'],
            'weight'          => $data['weight'],
            'bmi'             => $data['bmi'],
            'bust'            => $data['bust'],
            'cup'             => $data['cup'],
            'waist'           => $data['waist'],
            'hip'             => $data['hip'],
            'hope_back_flg'   => $data['hope_back_flg'],
            'hope_back_price' => $data['hope_back_price'],
            'warranty_flg'    => $data['warranty_flg'],
            'warranty_time'   => $data['warranty_time'],
            'warranty_price'  => $data['warranty_price'],
            'celebration_flg' => $data['celebration_flg'],
            'celebration_price' => $data['celebration_price'],
            'send_to_home_flg' => $data['send_to_home_flg'],
            'send_to_shop_flg' => $data['send_to_shop_flg'],
            'advance_salary_flg'  => $data['advance_salary_flg'],
            'menses_flg'          => $data['menses_flg'],
            'transportation_expenses_flg' => $data['transportation_expenses_flg'],
            'dorm_flg'        => $data['dorm_flg'],
            'single_room_wait_flg'        => $data['single_room_wait_flg'],
            'tatoo_flg'       => $data['tatoo_flg'],
            'nursery_flg'     => $data['nursery_flg'],
            'experience_possible_flg' => $data['experience_possible_flg'],
            'without_prior_flg' => $data['without_prior_flg'],
            'apply_identity_card' => $data['apply_identity_card_hidden'],
            'apply_identity_card_remark'   => $data['apply_identity_card_remark'],
            'residence_flg'   => $data['residence_flg'],
            'residence'       => $data['residence'],
//            'confirmed_flg'   => $data['confirmed_flg'],
            'same_person_flg' => $data['same_person_flg'],
//            'hope_workplace' => $data['hope_workplace'],
            'hope_workplace' => $data['hope_workplace_hidden'],
//            'introduction_listening_flg' => $data['introduction_listening_flg'],
////            'confirm_introduction' => $data['confirm_introduction'],
            'other_flg'       => $data['other_flg'],
            'other'           => $data['other']
        );

        if(isset($data['media'])) {
            $main_data['media'] = $data['media'];
        }
        if(isset($data['scout'])) {
            $main_data['scout'] = $data['scout'];
        }
        if(isset($data['move'])) {
            $main_data['move'] = $data['move'];
        }

        if(isset($id)){
            $main_data["updated_at"] = date("Y-m-d H:i");
        }else{
            $main_data["updated_at"] = date("Y-m-d H:i");
            $main_data["created_at"] = date("Y-m-d H:i");
        }

        return $main_data;
    }

    public static function set_tracking_data($data, $id){

        $tracking_data = "";

        if(!empty($data)){
            Common::del_data_col( $id, 'tracking_remarks', 'interview_id' );

                foreach ($data as $key => $value) {
                    // ★
//                    if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) {
                        $scheduled_date = $value["scheduled_date_remarks"];
//                    }else{
//                        $scheduled_date = $value["scheduled_date_remarks_year"] . '-' . $value["scheduled_date_remarks_month"] . '-' . $value["scheduled_date_remarks_day"];
//                    }

//                    if($scheduled_date !== "--"){
                    if(!empty($scheduled_date)){
                        $tracking_data = array(
                            'interview_id' => $id,
                            'scheduled_date' => $scheduled_date,
                            'responsible' => $value["responsible"],
                            'passage' => $value["passage"]
                        );

                        Common::set_data($tracking_data, null, 'tracking_remarks');
                    }
                }
        }


        return $tracking_data;
    }

    public static function set_means_data($data, $id){

        $means_data = "";

        if(!empty($data)){
            Common::del_data_col( $id, 'other_means', 'interview_id' );

            foreach ($data as $key => $value) {

                if(!empty($value["means"])){
                    $means_data = array(
                        'interview_id' => $id,
                        'means' => $value["means"]
                    );

                    Common::set_data($means_data, null, 'other_means');
                }
            }
        }


        return $means_data;
    }

    public static function set_copy_image($data, $id){

        if(!empty($data)){
            foreach ($data as $key => $value) {
                $image_data = Common::get_data( "SELECT * FROM girl_image WHERE img_id = $value", "row" );
                $image_data["from_id"] = $id;
                unset($image_data["img_id"]);

                Common::set_data($image_data, null, 'girl_image');
            }
        }


        return true;
    }

    public static function delete($table, $id)
    {
        $masterData = Common::del_data( $id, $table );

        return $masterData;
    }

    public static function edit_delete( $id )
    {
        $res = \Prepare::get_query( " DELETE FROM `editlist` WHERE `data_id` = ?", array($id) );

        return $res;
    }

    public static function get_select_data($setting_data)
    {

//        if ( $_SERVER["REMOTE_ADDR"] == "221.113.41.190" ) print_r($setting_data);

        $blank_data = array('' => '—');
        foreach ($setting_data['master_page'] as $key => $value) {

            $table = 'master_' . $key;

            // 掲載媒体 の場合は名前順
            if($key == 'publicity') {
                $sql = "SELECT id, name FROM $table ORDER BY namekana ASC";
            // 掲載求人 の場合も名前順
            }elseif($key == 'media'){
                $sql = "SELECT id, name FROM $table ORDER BY namekana ASC, name ASC";
            }else{
                $sql = "SELECT id, name FROM $table ORDER BY sort ASC";
            }
            $masterData[$key] = Common::get_data( $sql, 'master' );
            if ( ! is_array($masterData[$key])) {
                $masterData[$key] = array();
            }

            //メールドメインはそのまま文字列を入れる
            if($key === "maildomain"){
                $maildomain = array();
                foreach ($masterData[$key] as $key2 => $value2) {
                    $maildomain[$value2] = $value2;
                }
                $masterData[$key] = $maildomain;
            }

            // 面接前確認 は --- 無し
            if($key === "check"){
                $masterData[$key] = $masterData[$key];
            }else{
                $masterData[$key] = $blank_data + $masterData[$key];
            }
        }


        // 全 スタッフ
//        $sql = "SELECT id, profile_fields FROM login_users WHERE hidden = 0 ORDER BY sort ASC";
//        $sql = "SELECT id, profile_fields FROM login_users WHERE hidden = 0 ORDER BY namekana ASC";
        $sql = "SELECT id, profile_fields FROM login_users ORDER BY namekana ASC";
        $userData = Common::get_data( $sql );
        $result = array('name' => array(), 'sender' => array());

        foreach($userData as $key=>$value){
            $profile = unserialize($value['profile_fields']);
            if(isset($profile['name']) AND $profile['name'] !== "kouji"){
                $result['name'][$value['id']] = $profile['name'];
            }
            if(isset($profile['sender'])){
                $result['sender'][$value['id']] = $profile['sender'];
            }
        }
        $masterData["staff"] = $blank_data + $result['name'];
        $masterData["sender"] = $blank_data + $result['sender'];


        // 表示中 スタッフ
        $sql = "SELECT id, profile_fields FROM login_users WHERE hidden = 0 ORDER BY namekana ASC";
        $userPrintData = Common::get_data( $sql );
        $result_print = array('name' => array(), 'sender' => array());

        foreach($userPrintData as $key=>$value){
            $profile = unserialize($value['profile_fields']);
            if(isset($profile['name']) AND $profile['name'] !== "kouji"){
                $result_print['name'][$value['id']] = $profile['name'];
            }
            if(isset($profile['sender'])){
                $result_print['sender'][$value['id']] = $profile['sender'];
            }
        }
        $masterData["staff_print"] = $blank_data + $result_print['name'];
        $masterData["sender_print"] = $blank_data + $result_print['sender'];

        // 非表示中 スタッフ
//        $sql = "SELECT id, profile_fields FROM login_users WHERE hidden = 1 ORDER BY sort ASC";
        $sql = "SELECT id, hidden, profile_fields FROM login_users WHERE hidden = 1 ORDER BY namekana ASC";
        $userHiddenData = Common::get_data( $sql );
        $result_hidden = array('name' => array(), 'sender' => array());

        foreach($userHiddenData as $key=>$value){
            $profile = unserialize($value['profile_fields']);
            if(isset($profile['name']) AND $profile['name'] !== "kouji"){
                $result_hidden['name'][$value['id']] = $profile['name'];
            }
            if(isset($profile['sender'])){
                $result_hidden['sender'][$value['id']] = $profile['sender'];
            }
        }
        $masterData["staff_hidden"] = $blank_data + $result_hidden['name'];
        $masterData["sender_hidden"] = $blank_data + $result_hidden['sender'];

        return $masterData;
    }

    public static function get_staff_mail()
    {
        $sql = "SELECT id, email FROM login_users ORDER BY id ASC";
        $staffData = Common::get_data( $sql );

        foreach($staffData as $key=>$value){
            if($value["email"] !== "kouji"){
                $staffData[$value['id']] = $value['email'];
            }
        }

        return $staffData;
    }

    //内容があれば、タイトルとくっつけて返す。なければNULLを返すだけ
    public static function set_mail_body( $contents=null, $title="", $unit="", $nl="\n", $mark_up="", $def="" ){
        if(empty($contents)) return $def;
        if(!empty($mark_up) && mb_strlen($mark_up) > 1 ){
            //最初の一文字目を先頭にして、その他の文字を最後尾につける（）とかで囲むときに使う。
            //()))))とかされても、その、、、、知らん
            $mark_up_start = mb_substr($mark_up, 0,1);
            $mark_up_end = str_replace($mark_up_start, '', $mark_up);
        }else{
            $mark_up_start = "";
            $mark_up_end = "";
        }
        $contents = $mark_up_start.$contents.$mark_up_end;
        return $title.$contents.$unit.$nl;
    }


}