<?php 
require_once "data.php";
$myCategory = new Category();


$name = $_SESSION['name'];
$userNum = $_SESSION['userNum'];

 //echo $HTTP_HOST."ajax.php?action=getActiveSaleRegister&accNum=".$accNum."&userNum=".$userNum;
$HTTP_HOST='http://hotel.staffstarr.com/manager/';

$getActiveSaleRegister_json=file_get_contents($HTTP_HOST."ajax.php?action=checkActiveSaleRegister&accNum=".$accNum."&userNum=".$userNum);
$getActiveSaleRegister=json_decode($getActiveSaleRegister_json,true);

if(count($getActiveSaleRegister) > 0)
{
	header("location:sale_register.php");
	exit;
}

$_SESSION = array();

header("location:login.php");
?>
