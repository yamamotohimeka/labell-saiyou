<?php
class Controller_Picresize extends Controller
{
	public function action_index($table, $imgId, $g_width = null, $g_height = null, $pp = 1 )
	{

		error_reporting(0);

        if($g_width == 0){
            $g_width = null;
        }

        if($g_height == 0){
            $g_height = null;
        }

		$prtData = Config::get('prtdata', array());
		//テーブル、画像idがなければ終了
		#$table = 'img_bn200';
		#$imgId = '1';
		if( !$table OR !$imgId ) exit;

		/*--------------------picResize設定--------------------//
		 * 各値の説明
		 * $dbConfigFileはDBの設定ファイルを指定します
		 * $imgSaveFolderNameはリサイズ画像を保存するフォルダ名を指定します
		 * $defaultImgは、DBに画像データがない、もしくはimgIdがない場合のデフォルト画像
		 * $rawImgMaxWidthは「width」と「height」を指定しなかった場合に自動リサイズされる際の最大widthの指定
		 * JPEGの圧縮品質 (0 高圧縮低画質 --> 100 低圧縮高画質)
		 * PNGの圧縮品質 (0 圧縮しない --> 9)
		 * $smallImgDefaultOutput="1"の場合は指定したサイズより、元ファイルが小さい場合にはリサイズせず、そのまま表示します。
		 * $rawImgMaxWidthを無効（0やエスケープ）の場合は登録サイズを表示
		 
		 ※キャッシュ置場の作成
		 /www/htdocs/userImg を作成し、設置用 .htaccess を入れる
		 
		 ※キャッシュの自動削除※
			dairy.shを設置（パス注意）
			/etc ⇒ crontab -e に記載（以下例）
			#DELETE TO picResize.php userImg cache
			45 4 * * * /var/www/yanneko10.com/www/dairy.sh 2>&1 > /dev/null
		 
		 ※画像の表示パス例：/userImg/テーブル名/画像ID（imgId）/～.jpg
		 
		 ※管理画像更新時のキャッシュ削除
			//picResize.phpで作成されたキャッシュ画像を削除する
			$imgSaveFolder = realpath(dirname(__FILE__) . '/../');
			system( '/bin/rm -rf ' . $imgSaveFolder . '/userImg/' . テーブル名 . '/' . 画像ID（imgId） . "/*" );

		//------------------------------------------------------*/
		//$dbConfigFile      = ".ht_DBConnect.inc";
		$imgSaveFolderName = '/htdocs'.ASSETS_PATH.'/userImg';
		$rawImgMaxWidth    = null;
		$defaultImg        = "../img/ngs.gif";
		$jpgQuality        = 95;
		$pngQuality        = 2;
		$smallImgDefaultOutput = 1;
		//------------------------------------------------------//

		//require_once( $dbConfigFile );
		//require_once( "DB.php" );

		//---------------------ファイル保存設定---------------------//
		$imgSaveFolder = realpath(IMG_PATH);

		if($imgSaveFolder){
		    $imgSaveFolder .= '/';
		}else{
		    echo('キャッシュディレクトリが存在しません。');
		    die;
		}

		//--------------------変数--------------------//
		$width           = 0;
		$height          = 0;
		$MySQLTable      = $table;
		$targetImgId     = $imgId;
		$change_width    = 0;
		$change_height   = 0;
		$proportional    = FALSE;  //アスペクト比の計算

		//------------------------DB接続----------------------------//

        try{
            $res = Prepare::get_query( "SELECT * FROM `{$MySQLTable}` WHERE `img_id` = ?", array($targetImgId) );
        }catch (Exception $e){
            echo "imagedb not found";
            exit;
        }

        if(!$res){
            echo "image not found";
            exit;
        }
		
		$imgData['img'] = array_shift($res);


		//------------------------画像情報の取得----------------------------//
		//対象のテーブルから画像データが取得出来たらリサイズと保存を実行する
		if( $imgData['img'] && $imgData['img']['contents']){
		    $imgId       = $imgData['img']['img_id'];
		    $imgContents = $imgData['img']['contents'];
		    $imgType     = $imgData['img']['file_type'];
		    $image       = imagecreatefromstring($imgContents);
		    $imgWidth    = imagesx ( $image );
		    $imgHeight   = imagesy ( $image );

			//MACバイナリの除去
		    if($imgType == "application/x-macbinary"){
		        $imgData   = substr( $imgData , 128);
		        $imgType   = "image/jpeg";
			}
			
			//width、height両方の指定がない場合は、$rawImgMaxWidthで指定された値で表示
		    if( isset($g_width) ){
		        $width  = $g_width;
		    }
			if( isset($g_height) ){
		        $height = $g_height;
		    }
			if($smallImgDefaultOutput == 1){
			    //指定サイズより、保存されている画像サイズが小さい場合はリサイズしない
			    if($imgWidth < $width OR $imgHeight < $height ){
			        $width  = $imgWidth;
					$height = $imgHeight;
			    }
			}
			if( isset($g_width) == FALSE AND isset($g_height) == FALSE){
			    $width  = $rawImgMaxWidth;
			}
			//MAX指定サイズが無ければ登録サイズを表示
		    if( !$rawImgMaxWidth AND !$width AND !$height ){
		        $width  = $imgWidth;
				$height = $imgHeight;
		    }
			
			//JPGの圧縮品質を取得
			if( isset($_GET['q']) ){
		        $jpgQuality = $_GET['q'];
		    }
			
		    //.htaccessにwidthとheightの両方指定していない場合、pp=1を付加しています。
		    if( $pp == 1 ){
		        $proportional = TRUE;
		    }

			
		    //アスペクト比の計算
		    if ($proportional){
		      if($width  == 0){
		          $factor = $height/$imgHeight;
		      }elseif($height == 0){
		          $factor = $width/$imgWidth;
		      }else{
		          $factor = min( $width / $imgWidth, $height / $imgHeight );
		      }

		      $change_width  = round( $imgWidth * $factor );
		      $change_height = round( $imgHeight * $factor );
		    }
		    else {
		      $change_width = ( $width <= 0 ) ? $imgWidth : $width;
		      $change_height = ( $height <= 0 ) ? $imgHeight : $height;
		    }

		//------------------------画像の作成----------------------------//
		    $image_resized = ImageCreateTrueColor( $change_width,  $change_height );
		    //PNGの場合は透過処理をする
		    if (($imgType == "image/png") ) {
		      $transparency = imagecolortransparent($image);

		      if ($transparency >= 0) {
		        $transparent_color  = imagecolorsforindex($image, $transparency);
		        $transparency       = imagecolorallocate($image_resized,
		                                                 $transparent_color['red'],
		                                                 $transparent_color['green'],
		                                                 $transparent_color['blue']);
		        imagefill($image_resized, 0, 0, $transparency);
		        imagecolortransparent($image_resized, $transparency);
		      }
		      elseif ($imgType == "image/png") {
		      	//pixelblendを停止(false）して、α値を使用する
		        imagealphablending($image_resized, false);
		        //透過色で塗りつぶす
		        $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
		        imagefill($image_resized, 0, 0, $color);
		        //α値の保存
		        imagesavealpha($image_resized, true);
		      }
		    }
		    
		    ImageCopyResampled( $image_resized,
		                        $image,
		                        0,
		                        0,
		                        0,
		                        0,
		                        $change_width,
		                        $change_height,
		                        $imgWidth,
		                        $imgHeight );
            ob_end_clean();

			//画像データの一時保管場所を作成して、リサイズした画像を保存する
		    ob_start();
		    switch ( $imgType ) {
		      case "image/gif":   imagegif($image_resized);                     break;
              case "image/jpg": imagejpeg($image_resized, NULL, $jpgQuality); break;
		      case "image/jpeg":  imagejpeg($image_resized, NULL, $jpgQuality); break;
			  case "image/pjpeg": imagejpeg($image_resized, NULL, $jpgQuality); break;
		      case "image/png":   imagepng($image_resized,  NULL, $pngQuality);  break;
		      default: return false;
		    }
			//データの取得
		    $imgData = ob_get_contents();
			//キャプチャ終了

		//保存ファイルの名称を設定する
		    switch ( $imgType ) {
		      case "image/gif":    $add = ".gif";   break;
              case "image/jpg":   $add = ".jpg";   break;
              case "image/jpeg":   $add = ".jpg";   break;
			  case "image/pjpeg":  $add = ".jpg";   break;
		      case "image/png":    $add = ".png";   break;
		      default: return false;
		    }

		    if( isset($g_width) AND isset($g_height) ){
			    $lengeFileName  = "/w"   . $width;
				$lengeFileName .= "-h"   . $height;
			}elseif( isset($g_width) AND isset($g_height) == FALSE){
			    $lengeFileName  = "/w"   . $width;
			}elseif( isset($g_height) AND isset($g_width) == FALSE){
		        $lengeFileName  = "/h"   . $height;
			}else{
			    $lengeFileName  = "/" . $imgId;
			}
			
			if( isset($_GET['q']) ){
		        $jpgQualityFileName = "-q"   . $jpgQuality;
		    }

			//指定されたフォルダなかったら作成する
			if( !file_exists( $imgSaveFolder . $MySQLTable ) ){
		        mkdir( $imgSaveFolder . $MySQLTable, 0755  );
		    }
		    if( !file_exists( $imgSaveFolder . $MySQLTable . "/" . $targetImgId ) ){
		        mkdir( $imgSaveFolder . $MySQLTable. "/" . $targetImgId, 0755  );
		    }


			$imgSaveFileName =  $imgSaveFolder
				              . $MySQLTable
				              . '/'   . $imgId
				              . $lengeFileName
		                      . $jpgQualityFileName
				              . $add;

            //gif画像だった場合は、DBに保存されている画像をそのまま出力
            if( $imgType == "image/gif"){
                $imgData = $imgContents;
            }

		    //画像をキャッシュディレクトリに保存
		    $fp = fopen($imgSaveFileName, 'w');
		    if($imgData) {
		        fwrite($fp, $imgData);
		    }
		    fclose($fp);
		    //ブラウザに表示する
			$mime = $imgType;
		    header("Content-type: $mime");
		    echo($imgData);
		    
		    ImageDestroy( $image_resized );
		    ImageDestroy( $image );
		}else{
		    //DBに画像データがない、もしくはimgIdがない場合はデフォルト画像を表示
		    #header('Content-type: image/jpeg');
		    #readfile($defaultImg);
		}
		//ディレクトリ削除のシェルスクリプトを書いていないので、データが溜まったら
		//この関数で消しているだけです。。。(いつか消す）
//		function remove_directory($dir) {
//		  if ($handle = opendir("$dir")) {
//		   while (false !== ($item = readdir($handle))) {
//		     if ($item != "." && $item != "..") {
//		       if (is_dir("$dir/$item")) {
//		         remove_directory("$dir/$item");
//		       } else {
//		         unlink("$dir/$item");
//		         echo " removing $dir/$item<br>\n";
//		       }
//		     }
//		   }
//		   closedir($handle);
//		   rmdir($dir);
//		   echo "removing $dir<br>\n";
//		  }
//		}
	}

}