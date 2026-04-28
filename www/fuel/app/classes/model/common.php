<?php
namespace Model;
/* ■■■■■■■■■■■■■■■■■■■■■■■■■■*
 * 関数名	：get_data
 * --------------------------------------------------- *
 * 引数		：配列
 *            cols 取得するカラム名（default * ）
 *            where 取得条件(default 1=1)
 *     		  order 取得データの並び順（default ASC ）
 *    		  limit 取得データ件数offset（default 空 ）
 * --------------------------------------------------- *
 * 戻り値	：取得データ array(カラム名=>値)
 * ■■■■■■■■■■■■■■■■■■■■■■■■■■*
 * 関数名	：set_data
 * --------------------------------------------------- *
 * 引数		：id（idがあったらUPDATE、無かったらINSERT）
 *            post(POSTデータ)
 * --------------------------------------------------- *
 * 戻り値	：last_query
 * --------------------------------------------------- *
 * 備考		：カラム名と連想配列名を合わせること
 * ■■■■■■■■■■■■■■■■■■■■■■■■■■*
 * 関数名	：make_paths
 * --------------------------------------------------- *
 * 引数		：segments（カレントのセグメント配列)
 *            choice (パスとして使用するセグメントの数)
 *            3の場合、/seg1/seg2/seg3/seg4の1～3までを
 *            パスとして使用する
 *            default（セグメントで指定されないdefault値）
 *            例：/webadmin/gravure/にアクセスがあった場合
 *                indexやlistに転送する設定をしたいなら
 *                choiceに3、defaultにindexもしくはlistを
 *                設定する
 * --------------------------------------------------- *
 * 戻り値	：paths["route"] カレントパス
 *            paths["tpl_path"] templateのパス
 *            ※segmentsの最後から2番目と最後を_で繋げている
 * --------------------------------------------------- *
 * 備考		：カレントのパスとtemplateのパスを
 * ■■■■■■■■■■■■■■■■■■■■■■■■■■*
 * 関数名	：make_sql
 * --------------------------------------------------- *
 * 引数		：data（カラム名=>値 の連想配列)
 *            type SQLタイプ（SELECT OR UPDATE OR INSERT）
 *            ※defaultはUPDATE
 * --------------------------------------------------- *
 * 戻り値	：sql[cols] SQL文のカラム部分(str)
 *            sql[place] SQL文のプレースホルダ部分(str)
 *            sql[value] bindする値（array）
 * --------------------------------------------------- *
 * 備考		：カラム名と連想配列名を合わせること
 * ■■■■■■■■■■■■■■■■■■■■■■■■■■*/

use Oil\Exception;

class Select_Sql {
    public $query = "";
    public $params = array();
    public function create_convert() {
        $param_count = array();
        $sql = $this->query;
        if( is_array($this->params) && !empty($this->params) ){
            foreach( $this->params as $key => $value ){
                $sql = preg_replace_callback( '/\?|\!/',
                    function($matches) use($key, $value, &$param_count){
                        if( $matches[0] == '?' ){
                            $param_count[$key] = $value;
                            return ':param'.$key;
                        }elseif( $matches[0] == '!' ){
                            return $value;
                        }
                    },
                    $this->query, 1 );
            }
        }
        foreach( $param_count as $key => $value ){
            $stmt[':param'.$key] = $value;
        }

        $converted  = new Converted_Select_Sql();
        $converted->query = $sql;
        $converted->params = $stmt;

        return $converted;
    }
};

class Converted_Select_Sql {
    public $query = "";
    public $params = array();
}



class Common extends \Model
{
	private static $tablename = "shop";

	public static function get_select_sql_class() {
	    return new Select_Sql();
    }
	
	public static function get_data($sql, $return = "array", $assocKey = "id")
	{
//		$table= self::$tablename;
//
//		if( !is_array($ops) ) return array();
//		//初期化
//		$table = $table;
//		$cols = "*";
//		$where = "WHERE 1=1";
//        $group = "";
//		$order = "";
//		$limit = "";
//		foreach( $ops as $key => $value ){
//			$key = mb_strtolower($key);
//			switch( $key ){
//				case 'table':
//					$table = $value;
//					break;
//				case 'cols':
//					$cols = $value;
//					break;
//				case 'where':
//					$where = "WHERE {$value}";
//					break;
//                case 'group':
//                    $group = "GROUP BY {$value}";
//                    break;
//				case 'order':
//					$order = "ORDER BY {$value}";
//					break;
//				case 'limit':
//					$limit = "LIMIT {$value}";
//					break;
//				default:
//					break;
//			}
//		}
        $params = null;
        if(is_object($sql) && $sql instanceof Select_Sql) {
            $convert_sql = $sql->create_convert();
            $result = \DB::query($convert_sql->query);
            $result = $result->parameters($convert_sql->params);
        } else{
            $result = \DB::query($sql);
        }

		//getAll 配列で返す
		if($return === "array"){
			$result = $result->execute()->as_array();
			//getOne 値で返す
		}elseif($return === "one"){
			$result = $result->execute()->current();
			if(isset($result)){
				$result = array_values($result);
				$result = $result[0];
			}
			//getAssoc 連想配列で返す
		}elseif($return === "row"){
			$result = $result->execute()->current();
			//getAssoc 連想配列で返す
		}elseif($return === "assoc"){
			$result = $result->execute()->as_array($assocKey);
			foreach($result as $key=>$value){
				$result[$key] = $value['name'];
			}
        }elseif($return === "master"){
            $result = $result->execute()->as_array($assocKey);
            foreach($result as $key=>$value){
                $result[$key] = $value['name'];
            }
			//count値を返す
		}elseif($return === "count"){
			$result = $result->execute()->count();

		}
	    return $result;
	}
	
	
	//登録、修正
    public static function set_data( $post, $id="", $table="" ){

        $table= ($table)? $table : self::$tablename;

        if( $id ){
            $sql = self::make_sql($post, 'UPDATE');

            $sql["value"][] = $id;

            $res = \Prepare::get_query( "UPDATE `{$table}` SET {$sql['cols']} WHERE `id` = ? ", $sql["value"] );
//            if ($_SERVER["REMOTE_ADDR"] == "221.113.41.190") echo "UPDATE `{$table}` SET {$sql['cols']} WHERE `id` = $id ";
        }else{
            $sql = self::make_sql($post, 'INSERT');
            $res = \Prepare::get_query( " INSERT `{$table}` ( {$sql['cols']} ) VALUES ( {$sql['place']} )", $sql["value"] );

            $res = \DB::query("SELECT LAST_INSERT_ID() AS id");
            $res = $res->execute()->current();
        }
        return $res;
    }
    //登録、修正
    public static function set_data_group( $shopid="", $id="", $sort="", $table="", $file="" ){

        $table= ($table)? $table : self::$tablename;
            if ($file) {
                $res = \Prepare::get_query( "UPDATE `{$table}` SET `shop` = ?,`thumb` = ? WHERE `group_id` = ? AND `sort` = ? ", array($shopid, $file, $id, $sort)  );
            }else{
                $res = \Prepare::get_query( "UPDATE `{$table}` SET `shop` = ? WHERE `group_id` = ? AND `sort` = ? ", array($shopid, $id, $sort)  );
            }

        return $res;
    }

    //登録、修正
    public static function set_data_iki( $id="1",  $table="" ){

        $table= ($table)? $table : self::$tablename;

            $res = \Prepare::get_query( "UPDATE `{$table}` SET `view_flag` = ? ", array( $id)  );
        return $res;
    }

	//データ削除
    public static function del_data( $id="", $table="" ){

        $table= ($table)? $table : self::$tablename;


        $res = \Prepare::get_query( " DELETE FROM `{$table}` WHERE `id` = ?", array($id) );

        return $res;
    }

    //データ削除　カラム指定
    public static function del_data_col( $id="", $table="", $column="" ){

        $table= ($table)? $table : self::$tablename;


        $res = \Prepare::get_query( " DELETE FROM `{$table}` WHERE `{$column}` = ?", array($id) );

        return $res;
    }

    //データ削除　カラム指定 小なり
    public static function del_data_col_less( $id="", $table="", $column="" ){

        $table= ($table)? $table : self::$tablename;


        $res = \Prepare::get_query( " DELETE FROM `{$table}` WHERE `{$column}` < ?", array($id) );

        return $res;
    }


	//画像データ削除
	public static function del_img_data( $id="", $table="" ){

		$table= ($table)? $table : self::$tablename;


		$res = \Prepare::get_query( " DELETE FROM `{$table}` WHERE `imgId` = ?", array($id) );

		return $res;
	}
	
	//パス生成
	public static function make_paths($segments = array(), $choice = 0, $default = NULL){
		
		if( COUNT($segments) === 0 ) return;
		
		//実際のセグメントの数より、セグメント選択数が大きい場合、defaultを追加する
		if( ( $choice > COUNT($segments) ) && $default ){
			$segments[] = $default;
		}
		
		$count = ( $choice > 0 ) ? $choice : COUNT($segments);
		
		for( $i = 0; $i < $count; $i++ ){
			$seg_array[] = strtolower($segments[$i]);
		}
		
		$temp = $seg_array;
		
		unset($temp[$count-1]);
		$paths['route'] = implode( '/', $seg_array );
		$paths['tpl_path'] = implode( '/', $temp )."_".$seg_array[COUNT($seg_array)-1];
		
		return $paths;

	}

		
	//SQLの部品生成
	private static function make_sql( $data, $type = 'UPDATE'){
	
		foreach( $data as $key => $value ){
			if( $type == 'UPDATE' ){
				//token、submitは除く
				if( $key !== "fuel_csrf_token" ) $cols_array[] = '`' . $key . '` = ?';
			}else{
				//tokenは除く
				if( $key !== "fuel_csrf_token" ) $cols_array[] = '`' . $key . '` ';
			}
			$place_array[] = '?';
			$value_array[] = $value;
		}
		
		$result['cols'] = implode( ', ', $cols_array );
		$result['place'] = implode( ', ', $place_array );
		$result['value'] = $value_array;

		return $result;
	}

    // 日時配列カレンダー用
    public static function calendar_array_data($data){
        $data_array = explode(" ", $data);
        $return_array[0] = $data_array[0];
        $time_array = explode(":", $data_array[1]);
        $return_array[1] = $time_array[0];
        $return_array[2] = $time_array[1];
        return $return_array;
    }

}