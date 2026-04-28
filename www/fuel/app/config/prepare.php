<?php
class Prepare extends \DB
{

	public static function get_query( $sql, $params = array() )
	{
		if( is_array($params) && !empty($params) ){
			$parmcount = array();
			foreach( $params as $key => $value ){
				$sql = preg_replace_callback( '/\?|\!/',
					function($matches) use($key, $value, &$parmcount){
						if( $matches[0] == '?' ){
							$parmcount[$key] = $value;
							return ':param'.$key;
						}elseif( $matches[0] == '!' ){
							return $value;
						}
					},
					$sql, 1 );
			}
		}else{
			return 'parameter empty error!';
		}
		//パラメータ生成
		foreach( $parmcount as $key => $value ){
			$stmt[':param'.$key] = $value;
		}
		
		$db = DB::query($sql);
		
		
		$consider = $db->parameters($stmt)->execute();
		//SQL文の判別
		$query_kind = array();
		$query_kind = explode(' ', \DB::last_query());
		
		if( stristr($query_kind[0], "SELECT") !== FALSE ){
			$result = $consider->as_array();
		}elseif( stristr($query_kind[0], "INSERT") !== FALSE ){
			$result = $consider[0];
		}else{
			$result = \DB::last_query();
		}
		
		return $result;

	}

	public static function get_row( $sql, $params = array() )
	{
		//一行だけ取得
		if( is_array($params) && !empty($params) ){
			$parmcount = array();
			foreach( $params as $key => $value ){
				$sql = preg_replace_callback( '/\?|\!/',
					function($matches) use($key, $value, &$parmcount){
						if( $matches[0] == '?' ){
							$parmcount[$key] = $value;
							return ':param'.$key;
						}elseif( $matches[0] == '!' ){
							return $value;
						}
					},
					$sql, 1 );
			}
		}else{
			return 'parameter empty error!';
		}
		//パラメータ生成
		foreach( $parmcount as $key => $value ){
			$stmt[':param'.$key] = $value;
		}
		
		$db = DB::query($sql);
		
		
		$res = $db->parameters($stmt)->execute()->as_array();
		//配列をシフト
		$result = array_shift($res);
		
		return $result;

	}
	
}