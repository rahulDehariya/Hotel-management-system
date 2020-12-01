<?php
require_once "getdata/autopart_data.php";
global $myCategory;
$myCategory = new Category();

error_reporting(E_ALL);
$action = $_GET['action'];

if($action == "alterDB"){

	$mycattreee = $myCategory->alterDB();

}

if($action == "getMenudetails"){

	$menuNum = $_GET['menuNum'];

	$mycattreee = $myCategory->getItemDetails(accNum,$menuNum);

	//print_r($mycattreee);die;

	echo json_encode($mycattreee);

}

if($action == "getOrderDetails"){

	$order_id = $_GET['order_id'];

	$order_details = $myCategory->getOrderDetails(accNum,$order_id);

	print_r($order_details); //die;

	//echo json_encode($mycattreee);

}



if($action == "getMenuVarietyPrice"){
	$varietyNum = $_GET['varietyNum'];
	$price = $myCategory->getVarietiesdata($varietyNum);
	echo $price;
}



if($action == "download_invoice"){

	include("mpdf/mpdf.php");

	$order_id = $_GET['order_id'];
	$mpdf=new mPDF('A4');

	$file_name = rand(99999,999999).'.pdf';
	$mpdf->WriteHTML(file_get_contents('https://autohubsolutions.com.au/invoice.php?order_id='.$order_id) ); 

	$mpdf->Output($file_name,'D');
	 header("Location:my_orders.php");
}


if($action == "download_items_pdf"){

	include("mpdf/mpdf.php");

	$mpdf=new mPDF('A4');

	$file_name = rand(99999,999999).'.pdf';
	$mpdf->WriteHTML(file_get_contents('https://autohubsolutions.com.au/items_pdf.php') ); 

	$mpdf->Output($file_name,'I');
	 //header("Location:my_orders.php");
}


if($action == "removeCartItems"){
	$cartId = $_GET['cartId'];
	$res = $myCategory->removeCartItems($cartId);
	echo $res;
}

if($action == "checkEmailExist"){
	//print_r($_POST);
	$res = $myCategory->checkEmailExist(accNum,$_POST);
	print_r($res);
}

if($action == "getUserRegister"){
	//print_r($_POST);
	$res = $myCategory->getUserRegister(accNum,$_POST);
	print_r($res);
}

if($action == "getMenuIngredientOptionPrice"){

	$iot_id = $_GET['iot_id'];

	$price = $myCategory->getMenuIngredientOptionPrice($iot_id);



	echo $price;

}


function getGuestId($myCategory){

	// setcookie("cart_items", "", time() - 3600);
	// $_SESSION = array();

	// print_r($_SESSION);
	// print_r($_COOKIE);



	if(!isset($_SESSION["guest_id"]) && !isset($_COOKIE['cart_items'])) { 
	 	$guest_ip = get_client_ip();
	 	$guest_id = $myCategory->createGuestUser($guest_ip);
	  	$_SESSION["guest_id"] = $guest_id;
	  	$_SESSION["guest_ip"] = $guest_ip;
	}else if(isset($_COOKIE['cart_items']) && count($_COOKIE['cart_items']) > 0 ){

		//echo "in cookies ";
		$cookie_items = json_decode($_COOKIE['cart_items'], true);
	    foreach ($cookie_items as $singleItem)
	      {
	      	$guest_id = $singleItem["guest_id"];

	      	$guest_ip = get_client_ip();

	      	if($guest_id == '' || $guest_id == 0) 
	      	{
	      		$guest_id = $myCategory->createGuestUser($guest_ip);
	      	}
	      	$_SESSION["guest_id"] = $guest_id;
	      	$_SESSION["guest_ip"] = $guest_ip;
	      }
	}else{
		$guest_id = $_SESSION["guest_id"];
	}

	return $guest_id;
}

if($action == "addToCart")
{
	$guest_id = getGuestId($myCategory);
	//print_r($_POST);die;
	$res = $myCategory->addToCart(accNum,$guest_id,$_POST);
	echo $res;
}

if($action == "updateCart")
{
	$guest_id = getGuestId($myCategory);
	//print_r($_POST);die;
	$res = $myCategory->updateCart(accNum,$guest_id,$_POST);
	echo $res;
}

if($action == "updateProfile")
{
	$res = $myCategory->updateProfile(accNum,$_POST);
	echo $res;
}

if($action == "updateProfilePic")
{
	//print_r($_POST);
	//print_r($_FILES);die;
	 $res = $myCategory->updateProfilePic(accNum,$_FILES);
	// echo $res;
}

if($action == "getOrders")
{
	 $res = $myCategory->getOrders(accNum);
	 echo json_encode($res);
	 //echo $res;
}

if($action == "confirmCart")
{
	$guest_id = getGuestId($myCategory);
	//print_r($_POST);//die;
	$res = $myCategory->confirmCart(accNum,$guest_id,$_POST);
	echo $res;
}

if($action == "forgot_password")
{
	$res = $myCategory->emailToForgotPassword(accNum,$_POST);
	echo $res;
}

if($action == "update_password")
{
	$res = $myCategory->updatePassword(accNum,$_POST);
	echo $res;
}


if($action == "getCartItems") {
	$guest_id = getGuestId($myCategory);
  	$getCartItems = $myCategory->getCartItems(accNum,$guest_id);
  	echo json_encode($getCartItems);
}


if($action == "check_cookies")
{
	print_r($_SESSION);
	$cookie_data = json_decode($_COOKIE['cart_items'], true);
	print_r($cookie_data);
}


if($action == "delete_cookies")
{
	session_destroy();
	setcookie("cart_items", "", time() - 3600);
	$cookie_data = json_decode($_COOKIE['cart_items'], true);
	print_r($cookie_data);
}


if($action == "getUserLogin") {
	//$guest_id = getGuestId($myCategory);
	$res = $myCategory->getUserLogin(accNum,$_POST);
	echo $res;
}


function get_client_ip() {

    $ipaddress = '';

    if (getenv('HTTP_CLIENT_IP'))

        $ipaddress = getenv('HTTP_CLIENT_IP');

    else if(getenv('HTTP_X_FORWARDED_FOR'))

        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');

    else if(getenv('HTTP_X_FORWARDED'))

        $ipaddress = getenv('HTTP_X_FORWARDED');

    else if(getenv('HTTP_FORWARDED_FOR'))

        $ipaddress = getenv('HTTP_FORWARDED_FOR');

    else if(getenv('HTTP_FORWARDED'))

       $ipaddress = getenv('HTTP_FORWARDED');

    else if(getenv('REMOTE_ADDR'))

        $ipaddress = getenv('REMOTE_ADDR');

    else

        $ipaddress = 'UNKNOWN';

    return $ipaddress;

}





 ?>