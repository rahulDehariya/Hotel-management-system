<?php

session_start();
ini_set('display_errors', '0');
// define('accNum', '12103');
define('accNum', '12116');
define('DB_HOST', 'localhost');
date_default_timezone_set("Australia/Perth");

/*define('DB_USER', 'order');
define('DB_PASSWORD', 'PASSWORD');*/
/*define('DB_USER', 'testingstaffstarr');
define('DB_PASSWORD', 'STAFF@emocms');
define('DB_DATABSE', 'testingstaffstarr');*/


define('DB_USER','beta_deepika');
define('DB_PASSWORD','2927Y3VY1gQH');
define('DB_DATABSE','beta_app_store');


define('HTTP_HOST', 'http://hotel.staffstarr.com/');
define('SITE_PATH', '');
define('SITE_URL', HTTP_HOST.SITE_PATH);

$dirpath = dirname(dirname(__FILE__));
define('Dir_Path', $dirpath);
define('JS_PATH', SITE_URL.'assets/js/');
define('CSS_PATH', SITE_URL.'assets/css/');
define('IMAGE_PATH', SITE_URL.'assets/images/');

define('HTTP_HOST', 'http://hotel.staffstarr.com/');

// Server url ----
define('SERVER_APIURL', 'https://www.safeonwork.com/shop/config/server_action_hotel.php');
// define('SERVER_APIURL', 'https://www.go.staffstarr.com/getData/server_action_hotel.php');

// Hotel url ----
// define('SERVER_APIURL', 'http://hotel.staffstarr.com/manager/server_action_hotel.php');
// 

define('SITE_PATH', '');
define('SITE_URL', HTTP_HOST.SITE_PATH);

$dirpath = dirname(dirname(dirname(__FILE__)));
define('Dir_Path', $dirpath);

define('PICKUP', 'true');//true or false
define('DELIVERY', 'true');//true or false
define('SELECTION_MUST', 'true');//true or false
define('IS_EXTRA_COMPULSORY', 'false');//true or false extra compulsory

define('CATEGORY_IMAGES_PATH', SITE_URL.'its-admin/assets/images/');
define('MENU_IMAGE_PATH', SITE_URL.'its-admin/assets/images/');
define('PROFILE_IMAGE_PATH', SITE_URL.'/assets/profile/');
define('currency', '$');
$servername = DB_HOST;
$username = DB_USER;
$password = DB_PASSWORD;
$dbname = DB_DATABSE;
// $con=mysqli_connect($servername, $username, $password, $dbname);
//print_r($con);
// print_r(mysqli_connect_error());
// Check connection
    // if (mysqli_connect_errno())
    // {
    //   echo "Failed to connect to MySQL: " . mysqli_connect_error();
    // }

