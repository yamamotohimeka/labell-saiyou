<?php
// Bootstrap the framework DO NOT edit this
require COREPATH.'bootstrap.php';
require APPPATH.'config/.ht_Config.php';

\Autoloader::add_classes(array(
	// Add classes you want to override here
	// Example: 'View' => APPPATH.'classes/view.php',
    'Fieldsetplus' => APPPATH.'config/fieldsetplus.php',
    'Prepare' => APPPATH.'config/prepare.php',
    'Imgset' => APPPATH.'config/imgset.php',
//    'admin_common' => APPPATH.'config/admin_common.php',
));

// Register the autoloader
\Autoloader::register();

/**
 * Your environment.  Can be set to any of the following:
 *
 * Fuel::DEVELOPMENT
 * Fuel::TEST
 * Fuel::STAGING
 * Fuel::PRODUCTION
 */

// Docker / CLI など: 環境変数 FUEL_ENV を最優先（Apache では PassEnv が必要）
$fuel_env_os = getenv('FUEL_ENV');
if ($fuel_env_os !== false && $fuel_env_os !== '') {
    Fuel::$env = $fuel_env_os;
} elseif (isset($_SERVER['FUEL_ENV']) && $_SERVER['FUEL_ENV'] !== '') {
    Fuel::$env = $_SERVER['FUEL_ENV'];
// 開発環境（固定 IP）
} elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] == "221.113.41.190") {
    Fuel::$env = Fuel::DEVELOPMENT;
} elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] == "113.197.142.105") { // TODO NAGAMORI 開発環境
    Fuel::$env = Fuel::DEVELOPMENT;
} else {
    Fuel::$env = Fuel::PRODUCTION;
}

//\Fuel::$env = (isset($_SERVER['FUEL_ENV']) ? $_SERVER['FUEL_ENV'] : \Fuel::DEVELOPMENT);

// Initialize the framework with the config file.
\Fuel::init('config.php');
