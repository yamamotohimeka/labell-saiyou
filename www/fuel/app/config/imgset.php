<?php
/* ■■■■■■■■■■■■■■■■■■■■■■■■■■*
 * 関数名	：set_image
 * --------------------------------------------------- *
 * 引数		：table=テーブル名
 *            files $_FILESのデータ
 *            imgId 既に登録がある場合のimgId
 *     		  sql 独自SQL（テスト）
 *    		  shopid 店舗のシーケンスID
 * --------------------------------------------------- *
 * 戻り値	：UPDATEの場合、last_query
 *            INSERTの場合、last_insert_id
 * --------------------------------------------------- *
 * 備考		：packflgがtrueの場合、引数$filesに$_FILESを
 *            そのまま渡すことで、一括処理が可能
 *            ※テーブル名が命名規則（img_field名）に
 *              則っていることが前提
 *            ※packflgがtrueの場合、imgIdも配列で渡す
 * ■■■■■■■■■■■■■■■■■■■■■■■■■■*
 * 関数名	：set_image_group
 * --------------------------------------------------- *
 * 引数		：table=テーブル名
 *            files $_FILESのデータ
 *            imgId 既に登録がある場合のimgId
 *    		  shopid 店舗のシーケンスID
 * --------------------------------------------------- *
 * 戻り値	：UPDATEの場合、last_query
 *            INSERTの場合、last_insert_id
 * --------------------------------------------------- *
 * 備考		：同一テーブルに一括で複数の画像を登録する
 * ■■■■■■■■■■■■■■■■■■■■■■■■■■*
 * 関数名	：userImgCacheDel
 * --------------------------------------------------- *
 * 引数		：MySQLTable 画像格納テーブル名
 *            imgId 削除対象画像のimgId
 * --------------------------------------------------- *
 * 戻り値	：成功=true 失敗=false
 * --------------------------------------------------- *
 * 備考		：picResizeで生成された画像のキャッシュを
 *			：削除する関数
 * ■■■■■■■■■■■■■■■■■■■■■■■■■■*
 * 関数名	：check_exists_record
 * --------------------------------------------------- *
 * 引数		：table テーブル名
 *            col カラム名
 *            search 検索値
 * --------------------------------------------------- *
 * 戻り値	：文字列（INSERT OR UPDATE）
 * --------------------------------------------------- *
 * 備考		：引数で指定したテーブルに条件に一致する
 *			  行が既に存在するか否かのチェック関数
 *            存在する場合は、UPDATE、しない場合はINSERT
 * ■■■■■■■■■■■■■■■■■■■■■■■■■■*/

/**
 * Class Imgset
 */
class Imgset
{
    /**
     * @param null $name
     * @param array $files
     * @param null $table
     * @param null $imgId
     * @param null $shopid
     * @param null $id
     * @param int $imgListNum
     * @param string $folderName
     * @param int $maxWidth
     * @param int $nameFlg
     * @param int $banaflag
     * @param null $diary_img_path
     * @return String
     */
    public static function set_image( $name=NULL, $files=array(), $table=NULL, $imgId=NULL, $shopid=NULL, $id=NULL, $imgListNum=0, $folderName = "shop", $maxWidth=1200, $nameFlg=0, $banaflag=0, $diary_img_path = NULL){

		//FILESが空だったら終了
		if( COUNT($files) == 0 ) return false;
		if(!empty($files['tmp_name'])){

			//ファイル情報
			$fileInfo = Imgset::img_check($files['tmp_name'],$name, $nameFlg);
			$file     = $fileInfo['name'];
			$type     = $files['type'];
			$tmp_name = $files['tmp_name'];
			$size     = $files['size'];
			$width    = $fileInfo['width'];
			$height   = $fileInfo['height'];
            $ext = Imgset::get_extention($type);

//            $folder = Imgset::get_folder_name($shopid, $id, $folderName);
			$contents = @file_get_contents( $tmp_name );

            if( $type == 'image/pjpeg' ) $type = 'image/jpeg';
			$contents = '0x' . bin2hex( $contents );

			if( $imgId ){
				//ファイルパスを生成
				$filePath = IMG_PATH . $table . "/$imgId";

				//画像ファイルを削除
				if(file_exists($filePath)){
                    File::delete_dir($filePath);
                }

				//画像をアップデート
				$data_array = array($imgListNum, $file, $size, $type, $ext, $width, $height, $contents, $imgId);

                if(strlen($contents) < 1000000) {
                    try {
                        Prepare::get_query("UPDATE {$table} SET `no` = ?, `file` = ?, `size` = ?, `file_type` = ?, `ext` = ?, `width` = ?, `height` = ?, `contents` = ! WHERE `img_id` = ?",
                            $data_array);
                    } catch (Exception $e) {
                        echo 'UPDATE ERROR: ', $e->getMessage(), "\n";
                        exit;
                    }
                }else{
                    echo '画像サイズが1MBを超えています。サイズが1MB以下の画像を登録して下さい。';
                    exit;
                }


			}else{
			    
                if($id){
                    $from_id = $id;
                }else{
                    $from_id = $shopid;
                }

                //画像を登録
				$data_array = array( $from_id, $imgListNum, $file, $size, $type, $ext, $width, $height, $contents);

                if(strlen($contents) < 1000000) {
                    try{
                        $imgId = Prepare::get_query( "INSERT {$table} ( `from_id`, `no`, `file`, `size`, `file_type`, `ext`, `width`, `height`, `contents` ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ! )", $data_array );
                    }catch (Exception $e){
                        echo 'INSERT ERROR: ',  $e->getMessage(), "\n";
                        exit;
                    }
                }else{
                    echo '画像サイズが1MBを超えています。サイズが1MB以下の画像を登録して下さい。';
                    exit;
                }


			}

			//画像をアップロード
//			Imgset::upload($files["tmp_name"],$folder,$maxWidth,1,$fileInfo);
		}

		return $file;
	}

	public static function userImgFileDel( $table , $filename, $shopid=NULL, $id=NULL, $folderName = "shop" ){
		if( !$table OR !$filename ) return false;

        $folder = Imgset::get_folder_name($id, $folderName);
		$filePath = $folder . $filename;

		//画像ファイルを削除
		if(file_exists($filePath)){
			unlink($filePath);
		}
	}

    public static function userImgDilDel( $table , $id ){
        if( !$table OR !$id ) return false;

        $dir = "/img/{$table}/{$id}";

        if(file_exists($dir)) {
            if ($handle = opendir("$dir")) {
                while (false !== ($item = readdir($handle))) {
                    if ($item != "." && $item != "..") {
                        if (is_dir("$dir/$item")) {
                            remove_directory("$dir/$item");
                        } else {
                            unlink("$dir/$item");
                            echo " removing $dir/$item<br>\n";
                        }
                    }
                }
                @closedir($handle);
                @rmdir($dir);
            }
        }
    }

	private static function check_exists_record( $table, $col, $search ){
		$res = Prepare::get_row( "SELECT `{$col}` FROM `{$table}` WHERE `{$col}` = ?", array($search) );
		if( is_array($res) ){
			return true;
		}else{
			return false;
		}
	}

	public static function upload($upfile,$folder,$size, $flg = 0, $list=array()){

		if(!file_exists($folder)){
			mkdir($folder, 0777, true);
            chmod($folder, 0777);
		}

		if($list['name']){
			$sendpath = $folder.$list['name'];

			if(move_uploaded_file($upfile, $sendpath)){
				chmod($sendpath,0666);

				if($list['width'] >= $size && $list['flag'] != 0 && $list['flag'] != 3){

					if($list['flag'] == 0){
						$img = imagecreatefromgif($sendpath);
					}elseif($list['flag'] == 1){
						$img = imagecreatefromjpeg($sendpath);
					}elseif($list['flag'] == 2){
						$img = imagecreatefrompng($sendpath);
					}

					$ix = ImageSx($img);
					$iy = ImageSy($img);

					$ox = $size;
					$oy = ($ox * $iy) / $ix;

					$gdimg = imagecreatetruecolor($ox, $oy);

                    //ブレンドモードを無効にする
                    imagealphablending($gdimg, false);
                    //完全なアルファチャネル情報を保存するフラグをonにする
                    imagesavealpha($gdimg, true);

					imagecopyresampled($gdimg, $img,0,0,0,0, $ox, $oy, $ix, $iy);

					if($list['flag'] == 0){
						imagegif($gdimg,$folder.$list['next'],100);
					}elseif($list['flag'] == 1){
						imagejpeg($gdimg,$folder.$list['next'],95);
					}elseif($list['flag'] == 2){
						imagepng($gdimg,$folder.$list['next'],2);
                        //imagepng($gdimg, null, 100);
					}

					imagedestroy($img);
					imagedestroy($gdimg);

					unlink($folder.$list['name']);
                    rename($folder.$list['next'], $folder.$list['name']);
                    //print_r ($list);exit;
					$fname = $list['next'];
				}else{

					$fname = $list['name'];

				}
			}
		}

		return $fname;
	}

	public static function img_check($file,$name = false, $flg = 0){

		$imagesize = @getimagesize($file);

		$filename = time().rand();

		if(strlen($name) > 0){
			$filename = $filename."_".$name;
		}

		if($flg === 1){
			$filename = $name;
		}
		switch($imagesize[2]){
			case 1:
				$out = $filename . ".gif";
				$next = $filename . "1.gif";
				$flag = 0;
				break;
			case 2:
				$out = $filename . ".jpg";
				$next = $filename . "1.jpg";
				$flag = 1;
				break;
			case 3:
				$out = $filename . ".png";
				$next = $filename . "1.png";
				$flag = 2;
				break;
			default:
				@unlink($file);
		}

		if($imagesize[2] == 4 || $imagesize[2] == 13){
			$out = time() . ".swf";
			$next = time() . "1.swf";
			$flag = 3;
		}

		$list = array();

		$list = array(
			"name" => $out,
			"next" => $next,
			"flag" => $flag,
			"width" => $imagesize[0],
			"height" => $imagesize[1]
		);

		return $list;

	}

	public static function delete_imgfile($filePath, $id, $table, $column){
		$res = Prepare::get_row( "SELECT `$column` FROM `$table` WHERE `img_id` = ?", array($id) );
		$imgfile = $filePath . $res[$column];

		if(file_exists($imgfile) AND $res[$column]){
			unlink($imgfile);
		}
	}

    public static function get_extention($param){
        $ext = 'jpg';

        switch($param){
            case 'image/jpeg':$ext = 'jpg';break;
            case 'image/pjpeg':$ext = 'jpg';break;
            case 'image/gif':$ext = 'gif';break;
            case 'image/png':$ext = 'png';break;
            case 'image/x-png':$ext = 'png';break;
            default: $ext = 'jpg';break;
        }

        return $ext;
    }

    public static function get_folder_name($id = NULL, $folderName = "shop"){
        //各種フォルダ
        if($folderName === "girl"){
            $folder = IMG_PATH . "girl_image/{$id}/";
        }

        return $folder;
    }

}