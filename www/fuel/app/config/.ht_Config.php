<?php
/**
 * 本番ではサーバー固有の設定をここに置くことが多いです。
 * 本番の同ファイルに定数やパスがあれば、そちらをコピーして追記してください。
 */

// Smarty の {include file=$smarty.const.ADMIN_HEADER} 用（header.tpl / footer.tpl）
if (defined('APPPATH') && defined('DS')) {
	if ( ! defined('ADMIN_HEADER')) {
		define('ADMIN_HEADER', APPPATH . 'views' . DS . 'header.tpl');
	}
	if ( ! defined('ADMIN_FOOTER')) {
		define('ADMIN_FOOTER', APPPATH . 'views' . DS . 'footer.tpl');
	}
	// Smarty の {include file=$smarty.const.ANALYZE_MENU} 用（集計ページ共通ナビ）
	if ( ! defined('ANALYZE_MENU')) {
		define('ANALYZE_MENU', APPPATH . 'views' . DS . 'analyze' . DS . 'menu.tpl');
	}
}
