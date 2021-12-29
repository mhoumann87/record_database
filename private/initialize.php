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
  * Add all the files needed for the site
*/
require_once 'functions.php';