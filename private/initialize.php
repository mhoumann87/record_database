<?php
/*
 * Turn on output buffering 
 */
ob_start();

/*
 * Display PHP errors on the pages
 ! REMEMBER TO DELETE THIS BEFORE UPLOADING TO PRODUCTION
*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/*
 ! Delete this ^ 
*/

/* 
 * Assign file paths to PHP constants
 * __FILE__ returns the current path to this file
 * dirname() returns the path to the parent directory
*/
define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PRIVATE_PATH));
define("PUBLIC_PATH", PROJECT_PATH . '/public');
define("SHARED_PATH", PRIVATE_PATH . '/shared');

/*
 * Assign the root URL to a PHP constant
 * - Do not need to include the domain
 * - Use the same document root as webserver
*/
$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public');
$public_end = $public_end + 7;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define('WWW_ROOT', $doc_root);

/*
  * Add all the files needed for the site
*/
require_once 'db_credentials.php';
require_once 'db_functions.php';
require_once 'functions.php';

/*
  * Load class definitions manually
  * All classes in directory 
*/
foreach (glob('classes/*.class.php') as $file) {
  require_once($file);
}

/*
  * Instead of manually loading the classes,
  * you can also autoload the class definitions 
*/
function my_autoload($class)
{
  if (preg_match('/\A\w+\Z/'.$class)) {
    include 'classes/'.$class.'.class.php';
  }
}
spl_autoload_register('my_autoload');

/*
 * Connect to the database
*/
$db = db_connect();