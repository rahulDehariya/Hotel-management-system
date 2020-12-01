<?php
// require_once "getdata/data.php";
// global $myCategory;
// $myCategory = new Category();

//require_once "getdata/autopart_data.php";

/*require_once "getdata/autopart_data.php";

global $myCategory;
$myCategory = new Category();*/


if(!isset($_SESSION)){
	session_start();

}


include_once 'config/config.php';
//include_once 'config/autopart_config.php';



error_reporting(E_ALL);
$action = $_GET['action'];

global $token;

$token = "sfkmnsdknflksdnfkl";

function curl_post($url,$fields,$method){

	//url-ify the data for the POST
	// foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	// rtrim($fields_string, '&');
// getAllMenuIdAccount
	$fields_string = json_encode(array("data" => $fields));
	//$url = urlencode($url);
	//open connection
	$ch = curl_init();
	//set the url, number of POST vars, POST data
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
	//curl_setopt($ch,CURLOPT_POST, count($fields_string));
	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_POSTREDIR, 3);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION , TRUE);

	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json',                                                                                
		'Content-Length: ' . strlen($fields_string))                                                                       
		); 

	//execute post
	$result = curl_exec($ch);
	//close connection
	curl_close($ch);

	return $result;

}
// getSpecial
if($action=="getSpecials")
{
 $url=SERVER_APIURL.'?action=getSpecials&token='.$token.'&accNum='.accNum;
	$post_data=array();

	$mycattreee = curl_post($url,$post_data,"GET");

	print_r($mycattreee);exit;
}





//getMenudetails new made;

if($action == "getMenudetails"){

	$menuNum = $_GET['menuNum'];

	//$mycattreee = $myCategory->getItemDetails(accNum,$menuNum);


	$url = SERVER_APIURL.'?action=getItemDetails&token='.$token.'&accNum='.accNum.'&menuNum='.$menuNum;

	$post_data=array();

	$mycattreee = curl_post($url,$post_data,"GET");

	print_r($mycattreee);

	// echo json_encode($mycattreee);

}

if($action == "getItemDetails"){

	$menuNum = $_GET['menuNum'];

	$url = SERVER_APIURL.'?action=getItemDetails&token='.$token.'&accNum='.accNum.'&menuNum='.$menuNum;

	$post_data=array();

	$mycattreee = curl_post($url,$post_data,"GET");

	print_r($mycattreee);exit;

	//echo $mycattreee;

}
if($action == "getMainCategories"){

	$menuNum = $_GET['menuNum'];

	$url = SERVER_APIURL.'?action=getMainCategories&token='.$token.'&accNum='.accNum.'&menuNum='.$menuNum;

	$post_data=array();

	$mycattreee = curl_post($url,$post_data,"GET");

	print_r($mycattreee);

}
if($action == "getItemListPrint"){

	$accNum = $_GET['accNum'];
	$date_time = $_GET['date_time'];

	$url = SERVER_APIURL.'?action=getItemListPrint&token='.$token.'&accNum='.$accNum.'&date_time='.$date_time;

	$post_data=array();

	$mycattreee = curl_post($url,$post_data,"GET");

	print_r($mycattreee);

}

if($action == "getCategoryTreeView"){

	$url = SERVER_APIURL.'?action=getCategoryTreeView&token='.$token.'&accNum='.accNum;

	$post_data=array();

	$mycattreee = curl_post($url,$post_data,"GET");

	print_r($mycattreee);

}
// new getCategoriesTree 
if($action == "getCategoriesTree"){

	$url = SERVER_APIURL.'?action=getCategoriesTree&token='.$token.'&accNum='.accNum;

	$post_data=array();

	$mycattreee = curl_post($url,$post_data,"GET");

	print_r($mycattreee);

}


if($action == "getMenuItems"){

	$categoryNum = $_GET['categoryNum'];
	 $url = SERVER_APIURL.'?action=getMenuItems&token='.$token.'&accNum='.accNum.'&categoryNum='.$categoryNum; 
	$post_data=array();
	$mycattreee = curl_post($url,$post_data,"GET");
	 //print_r($mycattreee);die;
	echo $mycattreee;

}
if($action == "getMenuItems2"){

	$categoryNum = $_GET['categoryNum'];

	$url = SERVER_APIURL.'?action=getMenuItems2&token='.$token.'&accNum='.accNum.'&categoryNum='.$categoryNum;
	$post_data=array();
	echo $mycattreee = curl_post($url,$post_data,"GET");

}

if($action == "getContactDetails"){

	$url = SERVER_APIURL.'?action=getContactDetails&token='.$token.'&accNum='.accNum;
	$post_data=array();
	echo $mycattreee = curl_post($url,$post_data,"GET");

}

if($action == "getOrderDetails"){

	$order_id = $_GET['order_id'];
	//echo $order_id;

	$url = SERVER_APIURL.'?action=getOrderDetails&token='.$token.'&accNum='.accNum.'&order_id='.$order_id;
	 // echo $url; die;
	$post_data=array();
	$mycattreee = curl_post($url,$post_data,"GET");
	print_r($mycattreee); //die;

	//echo json_encode($mycattreee);

}

if($action == "getMenuVarietyPrice"){
	$varietyNum = $_GET['varietyNum'];

	$url = SERVER_APIURL.'?action=getMenuVarietyPrice&token='.$token.'&accNum='.accNum.'&varietyNum='.$varietyNum;
	$post_data=array();
	$mycattreee = curl_post($url,$post_data,"GET");
	echo $mycattreee;
}



if($action == "download_invoice"){

	include("mpdf/mpdf.php");

	$order_id = $_GET['order_id'];

	$file_name = rand(99999,999999).'.pdf';
	$mpdf=new mPDF('A4');
	$res = file_get_contents(HTTP_HOST.'invoice.php?order_id='.$order_id);
	
	$mpdf->WriteHTML($res); 
	
	$mpdf->Output($file_name,'D');
	//header("Location:order_history.php");
}


if($action == "download_items_pdf"){

	include("mpdf/mpdf.php");

	$mpdf=new mPDF('A4');

	$file_name = rand(99999,999999).'.pdf';
	$mpdf->WriteHTML(file_get_contents('http://hotel.staffstarr.com/items_pdf.php') ); 

	$mpdf->Output($file_name,'I');
	 //header("Location:my_orders.php");
}


if($action == "removeCartItems"){
	 $itemId = $_GET['itemId'];
	//$itemId = $_GET['cartId'];
	$url = SERVER_APIURL.'?action=removeCartItems&token='.$token.'&accNum='.accNum.'&itemId='.$itemId;
	$post_data=array();
	$res = curl_post($url,$post_data,"GET");
	// $res = $myCategory->removeCartItems($cartId);
	echo $res;
}

if($action == "checkEmailExist"){
	//print_r($_POST);

	$url = SERVER_APIURL.'?action=checkEmailExist&token='.$token.'&accNum='.accNum;
	$post_data=$_POST;
	$res = curl_post($url,$post_data,"POST");
	
	// $res = $myCategory->removeCartItems($cartId);
	// echo $res;
	// $res = $myCategory->checkEmailExist(accNum,$_POST);
	print_r($res);
}

if($action == "getUserRegister"){
	//print_r($_POST);

	$url = SERVER_APIURL.'?action=getUserRegister&token='.$token.'&accNum='.accNum;
	$post_data=$_POST;
	$res = curl_post($url,$post_data,"POST");

	// $res = $myCategory->getUserRegister(accNum,$_POST);
	print_r($res);
}

if($action == "getMenuIngredientOptionPrice"){

	$iot_id = $_GET['iot_id'];
	$url = SERVER_APIURL.'?action=getMenuIngredientOptionPrice&token='.$token.'&accNum='.accNum.'&iot_id='.$iot_id;
	$post_data=array();
	$res = curl_post($url,$post_data,"GET");
	//$price = $myCategory->getMenuIngredientOptionPrice($iot_id);
	echo $res;

}


function getGuestId($token){

	setcookie("cart_items", "", time() - 3600);
	$_SESSION = array();

	// print_r($_SESSION);
	// print_r($_COOKIE);


	if(!isset($_SESSION["guest_id"]) && !isset($_COOKIE['cart_items'])) { 
	 	$url = SERVER_APIURL.'?action=getGuestId&token='.$token.'&accNum='.accNum;
		$post_data=array();
		$guest_arr = curl_post($url,$post_data,"GET");
		$json_data = json_decode($guest_arr,true);

		$guest_id = $json_data['guest_id'];
		$guest_ip = $json_data['guest_ip'];

	}else if(isset($_COOKIE['cart_items']) && count($_COOKIE['cart_items']) > 0 ){

		//echo "in cookies ";
		$cookie_items = json_decode($_COOKIE['cart_items'], true);
	    foreach ($cookie_items as $singleItem)
	      {
	      	$guest_id = $singleItem["guest_id"];

	      	$guest_ip = get_client_ip();

	      	if($guest_id == '' || $guest_id == 0) 
	      	{

	      		$url = SERVER_APIURL.'?action=getGuestId&token='.$token.'&accNum='.accNum;
				$post_data=array();
				$guest_arr = curl_post($url,$post_data,"GET");
				$json_data = json_decode($guest_arr,true);

				$guest_id = $json_data['guest_id'];
				$guest_ip = $json_data['guest_ip'];

	      		//$guest_id = $myCategory->createGuestUser($guest_ip);
	      	}
	      	$_SESSION["guest_id"] = $guest_id;
	      	$_SESSION["guest_ip"] = $guest_ip;
	      }
	}else{
		$guest_id = $_SESSION["guest_id"];


		if(!isset($_SESSION['user_id']) || $_SESSION['user_id'] == 0)
	    {
	      $is_guest = 1;
	      $guest_id = $_SESSION["guest_id"];
	    }
	  else
	    {
	      $is_guest = 0;
	      $guest_id = $_SESSION['user_id'];
	    }



		$guest_ip = $_SESSION["guest_ip"];
	}

	$_SESSION["guest_id"] = $guest_id;

	return $guest_id;
}

if($action == "addToCart")
{
	

	$is_guest = 1;

	if(!isset($_SESSION['user_id']) || $_SESSION['user_id'] == 0)
	    {
	      $is_guest = 1;
	      $guest_id = getGuestId($token);
	    }
	  else
	    {
	      $is_guest = 0;
	      $guest_id = $_SESSION['user_id'];
	    }
	//print_r($_POST);die;

	$url = SERVER_APIURL.'?action=addToCart&token='.$token.'&accNum='.accNum.'&guest_id='.$guest_id.'&is_guest='.$is_guest;
	$post_data=$_POST;
	$res = curl_post($url,$post_data,"POST");
	//print_r($res);

	//$res = $myCategory->addToCart(accNum,$guest_id,$_POST);
	echo $res;
}

if($action == "updateCart")
{
	$guest_id = getGuestId($token);
	//print_r($_POST);die;

	$url = SERVER_APIURL.'?action=updateCart&token='.$token.'&accNum='.accNum.'&guest_id='.$guest_id;
	$post_data=$_POST;
	$res = curl_post($url,$post_data,"POST");

	// $res = $myCategory->updateCart(accNum,$guest_id,$_POST);
	echo $res;
}

// poliPaymentCancelled
if($action == "poliPaymentCancelled")
{
	// print_r($_GET);die;

	$txn_tokken=$_GET['txn_tokken'];
	$guest_id=$_GET['user_id'];
	$order_id=$_GET['order_id'];

	$url = SERVER_APIURL.'?action=poliPaymentCancelled&token='.$token.'&txn_token='.$txn_tokken.'&accNum='.accNum.'&guest_id='.$guest_id.'&order_id='.$order_id; 
	$post_data=$_POST;
	$res = curl_post($url,$post_data,"POST");

	print_r($res);

	// $res = $myCategory->updateCart(accNum,$guest_id,$_POST);
	//echo $res;
}
// poliPaymentSuccess
if($action == "poliPaymentSuccess")
{
	// print_r($_GET);die;

	$txn_tokken=$_GET['txn_tokken'];
	$guest_id=$_GET['user_id'];
	$order_id=$_GET['order_id'];
	$amount=$_GET['amount'];

	$url = SERVER_APIURL.'?action=poliPaymentSuccess&token='.$token.'&txn_token='.$txn_tokken.'&accNum='.accNum.'&guest_id='.$guest_id.'&order_id='.$order_id.'&amount='.$amount; 
	$post_data=$_POST;
	$res = curl_post($url,$post_data,"POST");

	print_r($res);

	// $res = $myCategory->updateCart(accNum,$guest_id,$_POST);
	//echo $res;
}

if($action == "updateProfile")
{
	$url = SERVER_APIURL.'?action=updateProfile&token='.$token.'&accNum='.accNum;
	$post_data=$_POST;
	$res = curl_post($url,$post_data,"POST");
	//print_r($res); die;

	//$res = $myCategory->updateProfile(accNum,$_POST);
	echo $res;
}

if($action == "updateProfilePic")
{
	//print_r($_POST);
	//print_r($_FILES);die;
	// $url = SERVER_APIURL.'?action=updateProfile&token='.$token.'&accNum='.accNum;
	// $post_data=$_POST;
	// $res = curl_post($url,$post_data,"POST");

	// $res = $myCategory->updateProfilePic(accNum,$_FILES);
	// echo $res;
}

if($action == "getOrders")
{
	$user_id=$_SESSION['user_id'];
	$url = SERVER_APIURL.'?action=getOrders&token='.$token.'&accNum='.accNum.'&user_id='.$user_id;
	$post_data=$_POST;
	$res = curl_post($url,$post_data,"POST");

	// $res = $myCategory->getOrders(accNum);
	 echo $res;
	 //echo $res;
}

if($action == "confirmCart_grocers")
{
	//$guest_id = getGuestId($token);

	 $is_guest = 1;

	if(!isset($_SESSION['user_id']) || $_SESSION['user_id'] == 0)
    {
      $is_guest = 1;
      $guest_id = getGuestId($token);
    }
  	else
    {
      $is_guest = 0;
      $guest_id = $_SESSION['user_id'];
    }


	//print_r($_POST);die;

	$url = SERVER_APIURL.'?action=confirmCart_grocers&token='.$token.'&accNum='.accNum.'&guest_id='.$guest_id.'&is_guest='.$is_guest;
	$post_data=$_POST;
	$res = curl_post($url,$post_data,"POST");

	$result_arr = json_decode($res,true);

	$user_data = $result_arr['user_data'];

	$_SESSION = $user_data;

	//$res = $myCategory->confirmCart(accNum,$guest_id,$_POST);
	echo $res;
}


if($action == "getCartItemsofuserGrocers") {
	
	
	$guest_id = $_GET['guest_id'];
	$is_guest = $_GET['is_guest'];

	 $url = SERVER_APIURL.'?action=getCartItems_grocer&token='.$token.'&accNum='.accNum.'&guest_id='.$guest_id.'&is_guest='.$is_guest;
	$post_data=$_POST;
	$res = curl_post($url,$post_data,"POST");

  	//$getCartItems = $myCategory->getCartItems(accNum,$guest_id);
  	echo $res;
}

if($action == "eventCreate")
{
	$guest_id = getGuestId($token);
	//print_r($_POST);//die;
	//print_r($_POST);die;

	$url = SERVER_APIURL.'?action=eventCreate&token='.$token.'&accNum='.accNum.'&guest_id='.$guest_id;
	$post_data=$_POST;
	$res = curl_post($url,$post_data,"POST");

	//$res = $myCategory->eventCreate(accNum,$guest_id,$_POST);
	echo $res;
}

if($action == "eventMenu")
{
	$guest_id = getGuestId($token);
	//print_r($_POST);//die;
	//print_r($_POST);die;

	$url = SERVER_APIURL.'?action=eventMenu&token='.$token.'&accNum='.accNum.'&guest_id='.$guest_id;
	$post_data=$_POST;
	$res = curl_post($url,$post_data,"POST");
	//$res = $myCategory->eventMenu(accNum,$guest_id,$_POST);
	echo $res;
}

if($action == "forgot_password")
{
	$url = SERVER_APIURL.'?action=forgot_password&token='.$token.'&accNum='.accNum;
	$post_data=$_POST;
	$res = curl_post($url,$post_data,"POST");

	//$res = $myCategory->emailToForgotPassword(accNum,$_POST);
	echo $res;
}

if($action == "update_password")
{
	$url = SERVER_APIURL.'?action=update_password&token='.$token.'&accNum='.accNum;
	$post_data=$_POST;
	$res = curl_post($url,$post_data,"POST");
	//$res = $myCategory->updatePassword(accNum,$_POST);
	echo $res;
}


if($action == "getUserDetails") {
	$user_id = $_GET['user_id'];

	$url = SERVER_APIURL.'?action=getUserDetails&token='.$token.'&accNum='.accNum.'&user_id='.$user_id;
	$post_data=$_POST;
	$res = curl_post($url,$post_data,"POST");

  	//$getCartItems = $myCategory->getCartItems(accNum,$guest_id);
  	echo $res;
}

if($action == "getUserAddress") {
	$user_id = $_GET['user_id'];

	$url = SERVER_APIURL.'?action=getUserAddress&token='.$token.'&accNum='.accNum.'&user_id='.$user_id;
	$post_data=$_POST;
	$res = curl_post($url,$post_data,"POST");

  	//$getCartItems = $myCategory->getCartItems(accNum,$guest_id);
  	echo $res;
}


if($action == "getCartItems") {
	
	$is_guest =0;

	//print_r($_SESSION);

	 if(!isset($_SESSION['user_id']) || $_SESSION['user_id'] == 0)
    {
      $is_guest = 1;
      $guest_id = getGuestId($token);
    }
  else
    {
      $is_guest = 0;
      $guest_id = $_SESSION['user_id'];
    }

    //$guest_id = 81;
   // $_SESSION['is_guest'] = $is_guest;

    //echo $guest_id;

    //print_r($_SESSION);


	 $url = SERVER_APIURL.'?action=getCartItems&token='.$token.'&accNum='.accNum.'&guest_id='.$guest_id.'&is_guest='.$is_guest;
	$post_data=$_POST;
	$res = curl_post($url,$post_data,"POST");

  	//$getCartItems = $myCategory->getCartItems(accNum,$guest_id);
  	echo $res;
}



if($action == "getOpenInvoiceId") {
	
	$is_guest =0;

	 if(!isset($_SESSION['user_id']) || $_SESSION['user_id'] == 0)
    {
      $is_guest = 1;
      $guest_id = getGuestId($token);
    }
  else
    {
      $is_guest = 0;
      $guest_id = $_SESSION['user_id'];
    }


	 $url = SERVER_APIURL.'?action=getOpenInvoiceId&token='.$token.'&accNum='.accNum.'&guest_id='.$guest_id.'&is_guest='.$is_guest;
	$post_data=$_POST;
	$res = curl_post($url,$post_data,"POST");

  	//$getCartItems = $myCategory->getCartItems(accNum,$guest_id);
  	echo $res;
}


if($action == "getCartItemsofuser") {
	
	
	$guest_id = $_GET['guest_id'];
	$is_guest = $_GET['is_guest'];


	$url = SERVER_APIURL.'?action=getCartItems&token='.$token.'&accNum='.accNum.'&guest_id='.$guest_id.'&is_guest='.$is_guest;
	$post_data=$_POST;
	$res = curl_post($url,$post_data,"POST");

  	//$getCartItems = $myCategory->getCartItems(accNum,$guest_id);
  	echo $res;
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

	$url = SERVER_APIURL.'?action=getUserLogin&token='.$token.'&accNum='.accNum;
	$post_data=$_POST;
	$res = curl_post($url,$post_data,"POST");

	$result_data = json_decode($res,true);


	if($result_data['status'] == 1)
	{
		$user_data = $result_data['msg'];
		$_SESSION =$user_data;
	}

	//print_r($_SESSION);

	//$res = $myCategory->getUserLogin(accNum,$_POST);
	echo $result_data['status'];
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