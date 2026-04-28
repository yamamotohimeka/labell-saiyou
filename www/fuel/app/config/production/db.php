<?php
/**
 * The production database settings. These get merged with the global settings.
 *
 * Docker 等: SP_LABELLE_DB_* があれば上書き（FUEL_ENV が production のままでも接続できるようにする）
 */
$in_docker = is_file('/.dockerenv');
$db_host = getenv('SP_LABELLE_DB_HOST');
$db_host = ($db_host !== false && $db_host !== '') ? trim($db_host) : '';
$db_name = getenv('SP_LABELLE_DB_NAME');
$db_name = ($db_name !== false && $db_name !== '') ? trim($db_name) : '';
$db_user = getenv('SP_LABELLE_DB_USER');
$db_user = ($db_user !== false && $db_user !== '') ? trim($db_user) : '';
$db_pass = getenv('SP_LABELLE_DB_PASSWORD');
$db_pass = ($db_pass !== false) ? $db_pass : null;

if ($db_host === '') {
    $db_host = $in_docker ? 'db' : 'localhost';
}
if ($db_name === '') {
    $db_name = $in_docker ? 'sp_labelle' : 're_sp_labelle_com';
}
if ($db_user === '') {
    $db_user = $in_docker ? 'app' : 're.sp-labelle';
}
if ($db_pass === null) {
    $db_pass = $in_docker ? 'app' : 'BM9Q5WzFpPYA5b3H';
}

return array(
    'default' => array(
        'connection'  => array(
            'dsn'        => 'mysql:host='.$db_host.';dbname='.$db_name,
            'username'   => $db_user,
            'password'   => $db_pass,
        ),
    ),
);
