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


// include_once 'config/config.php';
include_once 'config/autopart_config.php';



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
// ge
if($action == "download_invoice"){

	include("mpdf/mpdf.php");

	$order_id = $_GET['order_id'];

	$file_name = rand(99999,999999).'.pdf';
	$mpdf=new mPDF('A4');

	//echo $url = HTTP_HOST.'invoice.php?order_id='.$order_id;die;
	$res = file_get_contents(HTTP_HOST.'invoice.php?order_id='.$order_id);
	
	$mpdf->WriteHTML($res); 
	
	$mpdf->Output($file_name,'D');
	//header("Location:my_orders.php");
}


if($action == "download_items_pdf"){

	include("mpdf/mpdf.php");

	$mpdf=new mPDF('A4');

	$file_name = rand(99999,999999).'.pdf';
	$mpdf->WriteHTML(file_get_contents('http://hotel.staffstarr.com/items_pdf.php') ); 

	$mpdf->Output($file_name,'I');
	 //header("Location:my_orders.php");
}






 ?>