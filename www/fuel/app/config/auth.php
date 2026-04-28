<?php
/**
 * Fuel
 *
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.7
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2013 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * NOTICE:
 *
 * If you need to make modifications to the default configuration, copy
 * this file to your app/config folder, and make them in there.
 *
 * This will allow you to upgrade fuel without losing your custom config.
 */

return array(
	'driver' => array('Simpleauth'),
	'verify_multiple_logins' => false,
	'salt' => 'f4601135e157ade32272bae3141336f534634db17393671f397f80b0e7b798ef2f1b338a734d80336eade0d815e4b633c060d9b680959c59e866afc241922143',
	'iterations' => 10000,
);
