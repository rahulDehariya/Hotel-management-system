
<?php
include_once 'config/config.php';

// require_once "data.php";
// global $myCategory;
// $myCategory = new Category();

error_reporting(E_ALL);
$action = $_GET['action'];

// print_r($_SESSION);die;


$accNum = accNum;

if(isset($_SESSION['accNum']))
{
	$accNum = $_SESSION['accNum'];
}



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

//  Start new code
if($action == "getInvoiceDetails"){
	$invoiceId = $_GET['id'];
	$accNum = $_SESSION['accNum'];
	$url = SERVER_APIURL.'?action=getInvoiceDetails&invoiceId='.$invoiceId.'&accNum='.$accNum;
	$post_data = array();
	$method = 'GET';
	$invoice_details = curl_post($url,$post_data,$method);
	//$invoice_details = $myCategory->getInvoiceDetails($accNum,$invoiceId);
	print_r($invoice_details); //die;
	//print_r( json_decode($invoice_details));
}

if($action == "GetItemDetails"){
	$invoiceId = $_GET['id'];
	$status_where = $_GET['status_where'];
	$accNum = $_SESSION['accNum'];
	if(!isset($accNum))
	{
		$accNum=$_GET['accNum'];
	}

  	$url = SERVER_APIURL.'?action=GetItemDetails&invoiceId='.$invoiceId.'&accNum='.$accNum;
	$post_data = array();
	$method = 'GET';
	$invoice_details = curl_post($url,$post_data,$method);
	//$invoice_details = $myCategory->getInvoiceDetails($accNum,$invoiceId);
	print_r($invoice_details); //die;

	//print_r( json_decode($invoice_details));
}

if($action == "getActiveSaleRegister"){


	$accNum = $_REQUEST['accNum'];
	$userNum = $_REQUEST['userNum'];

	$url = SERVER_APIURL.'?action=getActiveSaleRegister&userNum='.$userNum.'&accNum='.$accNum;
	$post_data = array();
	$method = 'GET';

	$invoice_details = curl_post($url,$post_data,$method);

	//$invoice_details = $myCategory->getInvoiceDetails($accNum,$invoiceId);

	print_r($invoice_details); //die;

	//print_r( json_decode($invoice_details));
}
if($action == "checkActiveSaleRegister"){


	$accNum = $_REQUEST['accNum'];
	$userNum = $_REQUEST['userNum'];

	$url = SERVER_APIURL.'?action=checkActiveSaleRegister&userNum='.$userNum.'&accNum='.$accNum;
	$post_data = array();
	$method = 'GET';

	$invoice_details = curl_post($url,$post_data,$method);

	//$invoice_details = $myCategory->getInvoiceDetails($accNum,$invoiceId);

	print_r($invoice_details); //die;

	//print_r( json_decode($invoice_details));
}
if($action == "submitOpeningBalance"){


	$regNum = $_REQUEST['regNum'];
	$userNum = $_REQUEST['userNum'];
	$opening_balance = $_REQUEST['opening_balance'];

	$url = SERVER_APIURL.'?action=submitOpeningBalance&userNum='.$userNum.'&regNum='.$regNum.'&opening_balance='.$opening_balance;
	$post_data = array();
	$method = 'GET';

	$invoice_details = curl_post($url,$post_data,$method);

	//$invoice_details = $myCategory->getInvoiceDetails($accNum,$invoiceId);

	print_r($invoice_details); //die;

	//print_r( json_decode($invoice_details));
}

if($action == "submitClosingBalance"){


	$regNum = $_REQUEST['regNum'];
	$userNum = $_REQUEST['userNum'];
	$closing_balance = $_REQUEST['closing_balance'];
	



	// $close_message = str_replace(" ", "%20", $close_message);
	$url = SERVER_APIURL.'?action=submitClosingBalance&userNum='.$userNum.'&regNum='.$regNum.'&closing_balance='.$closing_balance;
	 $post_data = $_POST;
	 $method = 'POST';
	// $post_data = array();
	// $method = 'GET';

	$invoice_details = curl_post($url,$post_data,$method);

	//$invoice_details = $myCategory->getInvoiceDetails($accNum,$invoiceId);

	print_r($invoice_details); //die;

	//print_r( json_decode($invoice_details));
}

if($action == "getjobItems")
{
	$accNum = $accNum;
	$jobId= $_GET['Id'];
	$location= $_GET['location'];
	$invoiceId= $_GET['invoiceId'];


	$url = SERVER_APIURL.'?action=getjobItems&jobId='.$jobId.'&accNum='.$accNum.'&location='.$location.'&invoiceId='.$invoiceId;
	$post_data = array();
	$method = 'GET';
	$res = curl_post($url,$post_data,$method);

	//$res=$myCategory->getjobItems($accNum,$jobId);
	echo $res;
}

if($action == "getalljobItems")
{
	$accNum = $accNum;
	$jobId= $_GET['Id'];
	$location= $_GET['location'];
	$invoiceId= $_GET['invoiceId'];


	$url = SERVER_APIURL.'?action=getalljobItems&jobId='.$jobId.'&accNum='.$accNum.'&location='.$location.'&invoiceId='.$invoiceId;
	$post_data = array();
	$method = 'GET';
	$res = curl_post($url,$post_data,$method);

	//$res=$myCategory->getjobItems($accNum,$jobId);
	echo $res;
}

//New action
if($action == "activeTables")
{
	$accNum = $_REQUEST['accNum']; 
	$url = SERVER_APIURL.'?action=activeTables&accNum='.$accNum;
	$post_data = array();
	$method = 'GET';
	$res = curl_post($url,$post_data,$method);
	echo $res;
}
if($action == "Department_tables")
{
	$accNum = $_REQUEST['accNum']; 
	$url = SERVER_APIURL.'?action=Department_tables&accNum='.$accNum;
	$post_data = array();
	$method = 'GET';
	$res = curl_post($url,$post_data,$method);
	echo $res;
}



if($action == "categories_item_list")
{
	$accNum = $_REQUEST['accNum'];
	  $url = SERVER_APIURL.'?action=categories_item_list&accNum='.$accNum;
	$post_data = array();
	$method = 'GET';
	$res = curl_post($url,$post_data,$method);
	echo $res;
}

if($action == "getinvoices_id")
{
	$accNum = $_REQUEST['accNum'];
	  $url = SERVER_APIURL.'?action=getinvoices_id&accNum='.$accNum;
	$post_data = array();
	$method = 'GET';
	$res = curl_post($url,$post_data,$method);
	echo $res;
}

if($action == "GetActiveJobs")
{
	$accNum = $_REQUEST['accNum'];
	  $url = SERVER_APIURL.'?action=GetActiveJobs&accNum='.$accNum;
	$post_data = array();
	$method = 'GET';
	$res = curl_post($url,$post_data,$method);
	echo $res;
}

if($action == "GetJobColors")
{
	$accNum = $_REQUEST['accNum'];
	  $url = SERVER_APIURL.'?action=GetJobColors&accNum='.$accNum;
	$post_data = array();
	$method = 'GET';
	$res = curl_post($url,$post_data,$method);
	echo $res;
}


if($action == "ConfirmInvoice")
{
	$accNum = $_SESSION['accNum'];

	$url = SERVER_APIURL.'?action=ConfirmInvoice&accNum='.$accNum;
	$post_data = $_POST;
	$method = 'POST';
	$res = curl_post($url,$post_data,$method);

	//$res = $myCategory->ConfirmInvoice($accNum,$_POST);
	echo $res;
}

if($action == "InsertOrderPayment")
{
	//$accNum = $_SESSION['accNum'];

	$url = SERVER_APIURL.'?action=InsertOrderPayment';
	$post_data = $_POST;
	$method = 'POST';
	$res = curl_post($url,$post_data,$method);

	//$res = $myCategory->ConfirmInvoice($accNum,$_POST);
	echo $res;
}

if($action == "Get_item_prepared")
{
	$accNum = $_SESSION['accNum'];
	$id=$_REQUEST['id'];

	 $url = SERVER_APIURL.'?action=Get_item_prepared&accNum='.$accNum.'&id='.$id; 
	$post_data = $_POST;
	$method = 'POST';
	$res = curl_post($url,$post_data,$method);

	//$res = $myCategory->ConfirmInvoice($accNum,$_POST);
	echo $res;
}

if($action == "set_all_prepared")
{
	$accNum = $_SESSION['accNum'];
	$invoiceId=$_REQUEST['invoiceId'];

	$url = SERVER_APIURL.'?action=set_all_prepared&accNum='.$accNum.'&invoiceId='.$invoiceId; 
	$post_data = $_POST;
	$method = 'POST';
	$res = curl_post($url,$post_data,$method);
	echo $res;
}

if($action == "set_all_pickedup")
{
	$accNum = $_SESSION['accNum'];
	$invoiceId=$_REQUEST['invoiceId'];

	$url = SERVER_APIURL.'?action=set_all_pickedup&accNum='.$accNum.'&invoiceId='.$invoiceId; 
	$post_data = $_POST;
	$method = 'POST';
	$res = curl_post($url,$post_data,$method);
	//$res = $myCategory->ConfirmInvoice($accNum,$_POST);
	echo $res;
}

if($action == "Get_item_pickedup")
{
	$accNum = $_SESSION['accNum'];
	$id=$_REQUEST['id'];

	 $url = SERVER_APIURL.'?action=Get_item_pickedup&accNum='.$accNum.'&id='.$id; 
	$post_data = $_POST;
	$method = 'POST';
	$res = curl_post($url,$post_data,$method);

	//$res = $myCategory->ConfirmInvoice($accNum,$_POST);
	echo $res;
}


if($action == "Confirm_items_list")
{
	$accNum = $_SESSION['accNum'];

	 $url = SERVER_APIURL.'?action=Confirm_items_list&accNum='.$accNum;
	$post_data = $_POST;
	$method = 'POST';
	$res = curl_post($url,$post_data,$method);
	
	// $res = $myCategory->insertConfirmedItem($accNum,$_POST);
	echo $res;
}

if($action == "update_client_onInvoice")
{
	$accNum = $_SESSION['accNum'];

	 $url = SERVER_APIURL.'?action=update_client_onInvoice&accNum='.$accNum;
	$post_data = $_POST;
	$method = 'POST';
	$res = curl_post($url,$post_data,$method);
	
	// $res = $myCategory->insertConfirmedItem($accNum,$_POST);
	echo $res;
}


if($action == "GetReports")
{
	//print_r($_POST);//die;
	$accNum = $_SESSION['accNum'];
 	 $url = SERVER_APIURL.'?action=GetReports&accNum='.$accNum; 
	$post_data = $_POST;
	$method = 'POST';
	$res = curl_post($url,$post_data,$method);
	// $res=$myCategory->getCategoryItems($accNum,$_POST);
	echo $res;
}

if($action == "Register_history")
{
	//print_r($_POST);//die;
	$userNum = $_SESSION['userNum'];
	$accNum = $_SESSION['accNum'];
 	 $url = SERVER_APIURL.'?action=Register_history&accNum='.$accNum.'&userNum='.$userNum; 
	$post_data = $_POST;
	$method = 'POST';
	$res = curl_post($url,$post_data,$method);
	// $res=$myCategory->getCategoryItems($accNum,$_POST);
	echo $res;
}

function cleanData(&$str)
  {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }

if($action == "GetReports_Download_XLSX")
{
	//print_r($_POST);die;
	$accNum = $_SESSION['accNum'];
 	 $url = SERVER_APIURL.'?action=GetReports&accNum='.$accNum; 
	$post_data = $_GET;
// 	$post_data = array(
// 	"date_from"=>'2019-11-10',
// 	"date_to"=>'2019-11-23',
// 	"department_select"=>1,
// 	"payment_type"=>1

// );
$method = 'POST';
$result = curl_post($url,$post_data,$method);

$res = json_decode($result,true);
//print_r($result);die;
// foreach ($res as $rows) {
//    	print_r($rows);//die;
// }
//die;
$print_rows = 'Table NO' . "\t" . 'Client Name ' . "\t" . 'Membership'. "\t" . 'Total Amount'. "\t" . 'Balance Amount' . "\n";

foreach ($res as $data_rows) {

	//print_r($data_rows);die;
	 	# code...
	 	$type = $data_rows['jobType'];
      //Gold=1,silver=2,Bronze=3

      if($type == 1){
        $type = "Gold";
      }

      else if($type == 2){
        $type = "Silver";
      }

      if($type == 3){
        $type = "Bronze";
      }

      $invoice_total = $data_rows['invoice_total'];
      $balance_amount = floor($invoice_total-$data_rows['total_amount']);

		$print_rows.=$data_rows['info1'] . "\t" . $data_rows['name'] . "\t" . $type. "\t" . $data_rows['invoice_total']. "\t" .  $balance_amount . "\n";
	}


	$filename = "kitchen_report_" . date('Ymd') . ".xls";

  	header("Content-Disposition: attachment; filename=\"$filename\"");
  	header("Content-Type: application/vnd.ms-excel");

	echo $print_rows;
	  
	
	exit;




	// $res=$myCategory->getCategoryItems($accNum,$_POST);
	//echo $res;
}

if($action == "GetRegister_Download_XLSX")
{
	$accNum = $_SESSION['accNum'];
	$userNum = $_SESSION['userNum'];
	$regNo = $_GET['regNo'];
	$opening_balance = $_GET['opening_balance'];
	$closing_balance = $_GET['closing_balance'];
   	$url = SERVER_APIURL.'?action=GetRegister_Download_XLSX&accNum='.$accNum.'&userNum='.$userNum.'&RegNo='.$regNo; 
	$post_data = $_GET;

	$method = 'POST';
	$result = curl_post($url,$post_data,$method);

	// $url2 = SERVER_APIURL.'?action=getActiveSaleRegister&accNum='.$accNum.'&userNum='.$userNum.'&regNo='.$regNo;
	// $post_data = $_GET;

	// $method = 'POST';
	// $result2 = curl_post($url2,$post_data,$method);

	//print_r($result);die;

	$res = json_decode($result,true);

	 // print_r($res);die;
	$print_rows='';

	$total_cash_amount = $res[0]['total_cash_amount']; 
    $total_cc_amount = $res[0]['total_cc_amount']; 
    $total_bank_amount = $res[0]['total_bank_amount']; 
    $total_account_amount = $res[0]['total_account_amount']; 
    $total_sale_amount = $res[0]['total_sale_amount']; 

    $cash_in_hand = $total_cash_amount+$opening_balance;

	$print_rows.= 'Opening Amount' . "\t" . ' ' . "\t" . ''. "\t" .$opening_balance. "\t" . '' . "\n";
	$print_rows.= 'CC Transacton' . "\t" . ' ' . "\t" . ''. "\t" .$total_cc_amount. "\t" . '' . "\n";
	$print_rows.= 'Bank Transacton' . "\t" . ' ' . "\t" . ''. "\t" .$total_bank_amount. "\t" . '' . "\n";
	$print_rows.= 'Account Transacton' . "\t" . ' ' . "\t" . ''. "\t" .$total_account_amount. "\t" . '' . "\n";
	$print_rows.= 'Cash Amount' . "\t" . ' ' . "\t" . ''. "\t" .$total_cash_amount. "\t" . '' . "\n";
	$print_rows.= 'Total Sale Amount' . "\t" . ' ' . "\t" . ''. "\t" .$total_sale_amount. "\t" . '' . "\n";
	$print_rows.= 'Cash In Hand' . "\t" . ' ' . "\t" . ''. "\t" .$cash_in_hand. "\t" . '' . "\n";
	$print_rows.= 'Closing Amount' . "\t" . ' ' . "\t" . ''. "\t" .$closing_balance. "\t" . '' . "\n";
	

	$print_rows.= 'Table NO' . "\t" . 'Client Name ' . "\t" . 'Membership'. "\t" . 'Total Amount'. "\t" . 'Balance Amount' ."\t".'Payment Type'. "\n";




	foreach ($res as $data_rows) {

	//print_r($data_rows);die;
	 	# code...
		$payment_type=$data_rows['type'];

		if($payment_type==1){
			$payment_type="Cash";
		}
		else if($payment_type==2)
		{
			$payment_type="CC";
		}
	    else if($payment_type==3)
		{
			$payment_type="Bank";
		}
	   else 
		{
			$payment_type="Account";
		}



	 	$type = $data_rows['jobType'];
      //Gold=1,silver=2,Bronze=3

      if($type == 1){
        $type = "Gold";
      }

      else if($type == 2){
        $type = "Silver";
      }

      if($type == 3){
        $type = "Bronze";
      }

      $invoice_total = $data_rows['invoice_total'];
      $balance_amount = floor($invoice_total-$data_rows['total_amount']);

		$print_rows.=$data_rows['info1'] . "\t" . $data_rows['name'] . "\t" . $type. "\t" . $data_rows['invoice_total']. "\t" .  $balance_amount . "\t" . $payment_type. "\n";
	}

	//$print_rows.= 'Closing Amount' . "\t" . ' ' . "\t" . ''. "\t" .$closing_balance. "\t" . '' . "\n";


	$filename = "register_report_" . date('YmdHis') . ".xls";

  	header("Content-Disposition: attachment; filename=\"$filename\"");
  	header("Content-Type: application/vnd.ms-excel");

	echo $print_rows;
	  
	
	exit;
}




if($action == "getCategoryItems")
{
	//print_r($_POST);die;
	$accNum = $_SESSION['accNum'];
 	 $url = SERVER_APIURL.'?action=getCategoryItems&accNum='.$accNum; 
	$post_data = $_POST;
	$method = 'POST';
	$res = curl_post($url,$post_data,$method);
	// $res=$myCategory->getCategoryItems($accNum,$_POST);
	echo $res;
}

if($action == "getAllItems")
{
	// echo "hi";
	//print_r($_POST);die;
	$accNum = $_SESSION['accNum'];
    $url = SERVER_APIURL.'?action=getAllItems&accNum='.$accNum;
	$post_data = $_POST;
	$method = 'POST';
	$res = curl_post($url,$post_data,$method);
	// $res=$myCategory->getCategoryItems($accNum,$_POST);
	echo $res;
}


if($action == "getAllMembers")
{
	// echo "hi";
	//print_r($_POST);die;
	$accNum = $_SESSION['accNum'];
    $url = SERVER_APIURL.'?action=getAllMembers&accNum='.$accNum;
	$post_data = $_POST;
	$method = 'POST';
	$res = curl_post($url,$post_data,$method);
	// $res=$myCategory->getCategoryItems($accNum,$_POST);
	echo $res;
}


if($action == "AddIvoiceItems")
{
	//print_r($_POST);die;
	$accNum = $_SESSION['accNum'];
    $url = SERVER_APIURL.'?action=AddIvoiceItems&accNum='.$accNum;
	$post_data = $_POST;
	$method = 'POST';
	$res = curl_post($url,$post_data,$method);
	// $res = $myCategory->AddIvoiceItems($accNum,$_POST);
	echo $res;
}

if($action=="confirmitems")
{
	$accNum = $_SESSION['accNum'];
    $url = SERVER_APIURL.'?action=confirmitems&accNum='.$accNum;
	$post_data = $_POST;
	$method = 'POST';
	$res = curl_post($url,$post_data,$method);

	// $res = $myCategory->confirmitems($accNum,$_POST);
	echo $res;
}

if($action == "deleteItemInvoice")
{
	

	$accNum = $_SESSION['accNum'];
	$id = $_REQUEST['id'];


    $url = SERVER_APIURL.'?action=deleteItemInvoice&id='.$id; 
    $post_data = array();
	$method = 'GET';
	$res = curl_post($url,$post_data,$method);
	// $res = curl_post($url,$id);
	// $res = $myCategory->deleteItemInvoice($id);
	echo $res;
}

if($action == "CreateNewTable")
{
	// print_r($_POST);die;
	$accNum = $_SESSION['accNum'];
	 $url = SERVER_APIURL.'?action=CreateNewTable&accNum='.$accNum;
	$post_data = $_POST;
	$method = 'POST';
	$res = curl_post($url,$post_data,$method);
	// $res = $myCategory->CreateNewTable($accNum,$_POST);
	echo $res;
}

//  End new code

if($action == "getOrderDetails"){

	$order_id = $_GET['order_id'];
	$accNum = $_SESSION['accNum'];

	 $url = SERVER_APIURL.'?action=getOrderDetails&accNum='.$accNum.'&order_id='.$order_id;
	$post_data = array();
	$method = 'GET';
	$order_details = curl_post($url,$post_data,$method);

	// $order_details = $myCategory->getOrderDetails(accNum,$order_id);

	print_r($order_details); //die;

	
}

if($action == "removeCartItems"){
	$cartId = $_GET['cartId'];

	$url = SERVER_APIURL.'?action=removeCartItems&cartId='.$cartId;
	$post_data = array();
	$method = 'GET';
	$res = curl_post($url,$post_data,$method);

	// $res = $myCategory->removeCartItems($cartId);
	echo $res;
}



if($action == "updateCart")
{
	$guest_id = getGuestId($myCategory);
	$url = SERVER_APIURL.'?action=updateCart&accNum='.$accNum.'&guest_id='.$guest_id;
	$post_data = $_POST;
	$method = 'POST';
	$res = curl_post($url,$post_data,$method);
	
	// $res = $myCategory->updateCart(accNum,$guest_id,$_POST);
	echo $res;
}


if($action == "getOrders")
{
	$accNum = $_SESSION['accNum'];

	 $url = SERVER_APIURL.'?action=getOrders&accNum='.$accNum;
	$post_data = array();
	$method = 'GET';
	$res = curl_post($url,$post_data,$method);
	 // $res = $myCategory->getOrders(accNum);
	 // echo json_encode($res);
	 echo $res;
}

if($action == "getstaff")
{
	$accNum = $_SESSION['accNum'];

	 $url = SERVER_APIURL.'?action=getstaff&accNum='.$accNum;
	$post_data = array();
	$method = 'GET';
	$res = curl_post($url,$post_data,$method);
	 // $res = $myCategory->getOrders(accNum);
	 // echo json_encode($res);
	 echo $res;
}

if($action == "confirmCart")
{
	$accNum = $_SESSION['accNum'];
	$guest_id = getGuestId($myCategory);
	$url = SERVER_APIURL.'?action=confirmCart&accNum='.$accNum.'&guest_id='.$guest_id;
	$post_data = $_POST;
	$method = 'POST';
	$res = curl_post($url,$post_data,$method);
	// $res = $myCategory->confirmCart(accNum,$guest_id,$_POST);
	echo $res;
}

if($action == "getCartItems") {

	$guest_id = getGuestId($myCategory);
	$accNum = $_SESSION['accNum'];
	$url = SERVER_APIURL.'?action=getOrders&accNum='.$accNum.'&guest_id='.$guest_id;
	$post_data = array();
	$method = 'GET';
	$getCartItems = curl_post($url,$post_data,$method);
  	// $getCartItems = $myCategory->getCartItems($accNum,$guest_id);
  	// echo json_encode($getCartItems);
  	print_r($getCartItems);
}

if($action == "getUserLogin") {
	//$guest_id = getGuestId($myCategory);
	// $accNum = $_SESSION['accNum'];
	// print_r($_SESSION);die;

  	echo $url = SERVER_APIURL.'?action=getUserLogin&accNum='.$accNum;
	$post_data=$_POST;
	$res = curl_post($url,$post_data,"POST");
	
	// echo $res[0];die;

	print_r($res);die;
	$result_data = json_decode($res,true);
	
	session_destroy();

	// print_r($_SESSION);

	$result = 0;
	if(count($result_data)>0)
	{
		$result=1;
		session_start();
		 // $result_data['accNum'] = 12116;
		 // $result_data['accNum'] = 12103;
		 $accNum=$result_data['accNum'] ;
		 $user_id=$result_data['user_id'] ;

	    $url2 = SERVER_APIURL.'?action=getauthoritiesDetails&accNum='.$accNum.'&user_id='.$user_id; 
		$post_data2=$_POST;
		$res2 = curl_post($url2,$post_data2,"POST");

		// print_r($res2);die;

		$result_data2 = json_decode($res2,true);

		$set_data = $result_data2['SET1'];

		$set_data_arr = str_split($set_data);

		$authority_arr = array();

		for($i=1;$i<count($set_data_arr); $i++)
		{
			if($i == 1 && $set_data_arr[$i])
			{
				$authority_arr[]='admin';

				$result = 1;break;
			}
			if($i == 2 && $set_data_arr[$i])
			{
				$result = 2;
				$authority_arr[]='order';break;
			}
			if($i == 3 && $set_data_arr[$i])
			{
				$result = 3;
				$authority_arr[]='kitchen';break;
			}
		}

		$result_data['authority'] = $authority_arr;
	
		$_SESSION =$result_data;
	}
	echo $result;


}

if($action == "getmemberAdd"){
	//print_r($_POST);

	 $url = SERVER_APIURL.'?action=getmemberAdd&accNum='.$accNum; 
	$post_data=$_POST;
	$res = curl_post($url,$post_data,"POST");

	// $res = $myCategory->getUserRegister(accNum,$_POST);
	print_r($res);
}
if($action == "updateMember_profile"){

	 $url = SERVER_APIURL.'?action=updateMember_profile&accNum='.$accNum; 
	$post_data=$_POST;
	$res = curl_post($url,$post_data,"POST");

	// $res = $myCategory->getUserRegister(accNum,$_POST);
	print_r($res);
}

if($action == "getMemberdetails"){
	$id=$_REQUEST['id'];
	$url = SERVER_APIURL.'?action=getMemberdetails&accNum='.$accNum.'&id='.$id;
	$post_data=$_POST;
	$res = curl_post($url,$post_data,"POST");

	print_r($res);
}
if($action == "getopenregisterId"){
	$id=$_REQUEST['id'];
	$userNum = $_SESSION['userNum'];
	$url = SERVER_APIURL.'?action=getopenregisterId&accNum='.$accNum.'&userNum='.$userNum;
	$post_data=$_POST;
	$res = curl_post($url,$post_data,"POST");

	print_r($res);
}

if($action == "update_paxNumber"){
	
	$accNum = $_SESSION['accNum'];
	$url = SERVER_APIURL.'?action=update_paxNumber&accNum='.$accNum;
	$post_data=$_POST;
	$method = 'POST';
	$res = curl_post($url,$post_data,$method);

	print_r($res);
}

if($action == "Dashboard_data_Report"){
	
	$accNum = $_SESSION['accNum'];
    $url = SERVER_APIURL.'?action=Dashboard_data_Report&accNum='.$accNum; 
	$post_data=$_POST;
	$method = 'POST';
	$res = curl_post($url,$post_data,$method);

	print_r($res);
}


 ?>