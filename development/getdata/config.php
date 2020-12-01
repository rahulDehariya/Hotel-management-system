<?php

session_start();
ini_set('display_errors', '0');
date_default_timezone_set("Asia/Kolkata");
define('DB_HOST', 'localhost');
/*define('DB_USER', 'order');
define('DB_PASSWORD', 'PASSWORD');*/
// define('DB_USER', 'testingstaffstarr');
// define('DB_PASSWORD', 'STAFF@emocms');
// define('DB_DATABSE', 'testingstaffstarr');

define('DB_USER', 'dbtest.test');
define('DB_PASSWORD', 'DB@testP$13322');
define('DB_DATABSE', 'db_test_new');


$servername = DB_HOST;
$username = DB_USER;
$password = DB_PASSWORD;
$dbname = DB_DATABSE;
$con=mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

