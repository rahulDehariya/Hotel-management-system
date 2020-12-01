<?php

require_once "server_data_hotel.php";
//print_r($_REQUEST);die;
global $myCategory;
$myCategory = new Category();

error_reporting(E_ALL);
$action = $_REQUEST['action'];

if($action == "getInvoiceDetails"){

	$invoiceId = $_REQUEST['invoiceId'];
	$accNum = $_REQUEST['accNum'];
	$mycattreee = $myCategory->getInvoiceDetails($accNum,$invoiceId);
	print_r(json_encode($mycattreee));

}
if($action == "GetItemDetails"){

	$invoiceId = $_REQUEST['invoiceId'];
	$accNum = $_REQUEST['accNum'];
	$status_where = " invoice_items.status in(2,3) ";
	$mycattreee = $myCategory->getInvoiceDetails($accNum,$invoiceId,$status_where);
	print_r(json_encode($mycattreee));

}


if($action == "getActiveSaleRegister"){

	$userNum = $_REQUEST['userNum'];
	$accNum = $_REQUEST['accNum'];
	$regNo = 0;

	if(isset($_REQUEST['regNo']))
	{
		$regNo = $_REQUEST['regNo'];
	}
	$mycattreee = $myCategory->getActiveSaleRegister($accNum,$userNum,$regNo);
	//print_r($mycattreee);die;
	 print_r(json_encode($mycattreee));

}

if($action == "checkActiveSaleRegister"){

	$userNum = $_REQUEST['userNum'];
	$accNum = $_REQUEST['accNum'];
	$mycattreee = $myCategory->checkActiveSaleRegister($accNum,$userNum);
	//print_r($mycattreee);die;
	print_r(json_encode($mycattreee));

}

if($action == "submitOpeningBalance"){

	$userNum = $_REQUEST['userNum'];
	$regNum = $_REQUEST['regNum'];
	$opening_balance = $_REQUEST['opening_balance'];
	$mycattreee = $myCategory->submitOpeningBalance($regNum,$userNum,$opening_balance);
	//print_r($mycattreee);die;
	print_r(json_encode($mycattreee));

}

if($action == "submitClosingBalance"){

	$userNum = $_REQUEST['userNum'];
	$regNum = $_REQUEST['regNum'];
	$closing_balance = $_REQUEST['closing_balance'];
	
	
	$POST = file_get_contents("php://input");
	$array_el = json_decode($POST, true);

	$post_data = $array_el['data'];


	$mycattreee = $myCategory->submitClosingBalance($regNum,$userNum,$closing_balance,$post_data);
	// print_r($mycattreee);die;
	print_r(json_encode($mycattreee));

}

if($action == "getjobItems"){

	$jobId = $_REQUEST['jobId'];
	$accNum = $_REQUEST['accNum'];
	$location = $_REQUEST['location'];
	$invoiceId = $_REQUEST['invoiceId'];
	$mycattreee = $myCategory->getjobItems($accNum,$jobId,$location,$invoiceId);
	// print_r($mycattreee);die;
	 print_r(json_encode($mycattreee));

}

if($action == "getalljobItems"){

	$jobId = $_REQUEST['jobId'];
	$accNum = $_REQUEST['accNum'];
	$location = $_REQUEST['location'];
	$invoiceId = $_REQUEST['invoiceId'];
	$mycattreee = $myCategory->getalljobItems($accNum,$jobId,$location,$invoiceId);
	// print_r($mycattreee);die;
	 print_r(json_encode($mycattreee));

}

if($action == "activeTables"){

	$accNum = $_REQUEST['accNum'];
	$mycattreee = $myCategory->activeTables($accNum);
	   // print_r($mycattreee);
	  print_r(json_encode($mycattreee));

}
if($action == "Department_tables"){

	$accNum = $_REQUEST['accNum'];
	$mycattreee = $myCategory->Department_tables($accNum);
	   // print_r($mycattreee);
	  print_r(json_encode($mycattreee));

}

if($action == "categories_item_list"){

	$accNum = $_REQUEST['accNum'];
	$mycattreee = $myCategory->categories_item_list($accNum);
	// print_r($mycattreee);
	print_r(json_encode($mycattreee));

}

if($action == "getinvoices_id"){

	$accNum = $_REQUEST['accNum'];
	$mycattreee = $myCategory->getinvoices_id($accNum);
	// print_r($mycattreee);
	print_r(json_encode($mycattreee));

}

if($action == "GetActiveJobs"){

	$accNum = $_REQUEST['accNum'];
	$mycattreee = $myCategory->GetActiveJobs($accNum);
	  // print_r($mycattreee);
	 print_r(json_encode($mycattreee));

}

if($action == "GetJobColors"){

	$accNum = $_REQUEST['accNum'];
	$mycattreee = $myCategory->GetJobColors($accNum);
	// print_r($mycattreee);
	print_r(json_encode($mycattreee));

}

if($action == "ConfirmInvoice"){

	$accNum = $_REQUEST['accNum'];


	$POST = file_get_contents("php://input");
	$array_el = json_decode($POST, true);

	$post_data = $array_el['data'];


	$mycattreee = $myCategory->ConfirmInvoice($accNum,$post_data);
	print_r($mycattreee);

}

if($action == "InsertOrderPayment"){

	$POST = file_get_contents("php://input");
	$array_el = json_decode($POST, true);
	$post_data = $array_el['data'];
	$mycattreee = $myCategory->InsertOrderPayment($post_data);
	print_r($mycattreee);

}

if($action == "Get_item_prepared"){

	$accNum = $_REQUEST['accNum'];
	$id=$_REQUEST['id'];

	$POST = file_get_contents("php://input");
	$array_el = json_decode($POST, true);

	$post_data = $array_el['data'];


	$mycattreee = $myCategory->Get_item_prepared($accNum,$post_data,$id);
	print_r($mycattreee);

}
if($action == "set_all_prepared"){

	$accNum = $_REQUEST['accNum'];
	$invoiceId = $_REQUEST['invoiceId'];

	$POST = file_get_contents("php://input");
	$array_el = json_decode($POST, true);

	$post_data = $array_el['data'];

	$mycattreee = $myCategory->set_all_prepared($accNum,$post_data,$invoiceId);
	print_r($mycattreee);

}
if($action == "set_all_pickedup"){

	$accNum = $_REQUEST['accNum'];
	$invoiceId = $_REQUEST['invoiceId'];

	$POST = file_get_contents("php://input");
	$array_el = json_decode($POST, true);

	$post_data = $array_el['data'];

	$mycattreee = $myCategory->set_all_pickedup($accNum,$post_data,$invoiceId);
	print_r($mycattreee);

}
if($action == "Get_item_pickedup"){

	$accNum = $_REQUEST['accNum'];
	$id=$_REQUEST['id'];

	$POST = file_get_contents("php://input");
	$array_el = json_decode($POST, true);

	$post_data = $array_el['data'];


	$mycattreee = $myCategory->Get_item_pickedup($accNum,$post_data,$id);
	print_r($mycattreee);

}


if($action == "Confirm_items_list"){

	$accNum = $_REQUEST['accNum'];


	$POST = file_get_contents("php://input");
	$array_el = json_decode($POST, true);

	$post_data = $array_el['data'];


	$mycattreee = $myCategory->insertConfirmedItem($accNum,$post_data);
	print_r($mycattreee);

}
if($action == "update_client_onInvoice"){

	$accNum = $_REQUEST['accNum'];


	$POST = file_get_contents("php://input");
	$array_el = json_decode($POST, true);

	$post_data = $array_el['data'];


	$mycattreee = $myCategory->update_client_onInvoice($accNum,$post_data);
	print_r($mycattreee);

}
if($action == "GetReports"){

	$accNum = $_REQUEST['accNum'];


	$POST = file_get_contents("php://input");
	$array_el = json_decode($POST, true);

	$post_data = $array_el['data'];


	$mycattreee = $myCategory->GetReports($accNum,$post_data);
	// print_r($mycattreee);die;
	print_r(json_encode($mycattreee));

}
if($action == "Register_history"){

	$accNum = $_REQUEST['accNum'];
	$userNum = $_REQUEST['userNum'];


	$POST = file_get_contents("php://input");
	$array_el = json_decode($POST, true);

	$post_data = $array_el['data'];


	$mycattreee = $myCategory->Register_history($accNum,$userNum);
	// print_r($mycattreee);die;
	print_r(json_encode($mycattreee));

}
if($action == "GetRegister_Download_XLSX"){

	$accNum = $_REQUEST['accNum'];
	$userNum = $_REQUEST['userNum'];
	$regNo = $_REQUEST['RegNo'];


	$POST = file_get_contents("php://input");
	$array_el = json_decode($POST, true);

	$post_data = $array_el['data'];


	
	$mycattreee = $myCategory->GetRegister_Download_XLSX($accNum,$userNum,$regNo);

	// print_r($mycattreee);
	print_r(json_encode($mycattreee));

}


if($action == "getCategoryItems"){

	$accNum = $_REQUEST['accNum'];
	// print_r($_POST);
	$POST = file_get_contents("php://input");
	$array_el = json_decode($POST, true);

	$post_data = $array_el['data'];


	$mycattreee = $myCategory->getCategoryItems($accNum,$post_data);
	print_r(json_encode($mycattreee));

}

if($action == "getAllItems"){
	// echo"hi";die;

	$accNum = $_REQUEST['accNum'];
	// print_r($_POST);
	$POST = file_get_contents("php://input");
	$array_el = json_decode($POST, true);

	$post_data = $array_el['data'];

	$mycattreee = $myCategory->getAllItems($accNum,$post_data);
	// print_r($mycattreee);die;
	print_r(json_encode($mycattreee));

}


if($action == "getAllMembers"){
	// echo"hi";die;

	$accNum = $_REQUEST['accNum'];
	$mycattreee = $myCategory->getAllMembers($accNum);
	// print_r($mycattreee);die;
	print_r(json_encode($mycattreee));

}


if($action == "AddIvoiceItems"){

	$accNum = $_REQUEST['accNum'];
	
	$POST = file_get_contents("php://input");
	$array_el = json_decode($POST, true);

	$post_data = $array_el['data'];


	$mycattreee = $myCategory->AddIvoiceItems($accNum,$post_data);
	print_r($mycattreee);

}
if($action == "update_paxNumber"){

	$accNum = $_REQUEST['accNum'];
	
	$POST = file_get_contents("php://input");
	$array_el = json_decode($POST, true);

	$post_data = $array_el['data'];


	$mycattreee = $myCategory->update_paxNumber($accNum,$post_data);
	print_r($mycattreee);

}

if($action == "Dashboard_data_Report"){

	$accNum = $_REQUEST['accNum'];
	
	$POST = file_get_contents("php://input");
	$array_el = json_decode($POST, true);

	$post_data = $array_el['data'];


	$mycattreee = $myCategory->Dashboard_data_Report($accNum,$post_data);
	// print_r($mycattreee);die;
	print_r(json_encode($mycattreee));

}


if($action == "confirmitems"){

	$accNum = $_REQUEST['accNum'];
	
	$POST = file_get_contents("php://input");
	$array_el = json_decode($POST, true);
	$post_data = $array_el['data'];

	$mycattreee = $myCategory->confirmitems($accNum,$post_data);
	print_r($mycattreee);

}

if($action == "deleteItemInvoice"){
	// echo "hello";
	 // print_r($_REQUEST);
	$accNum = $_REQUEST['accNum'];
	$id = $_REQUEST['id'];
	$mycattreee = $myCategory->deleteItemInvoice($id);
	print_r($mycattreee);

}

if($action == "CreateNewTable"){

	$accNum = $_REQUEST['accNum'];
	
	$POST = file_get_contents("php://input");
	$array_el = json_decode($POST, true);
	$post_data = $array_el['data'];

	$mycattreee = $myCategory->CreateNewTable($accNum,$post_data);
	// print_r($mycattreee);
	print_r(json_encode($mycattreee));

}
if($action == "getOrderDetails"){

	$order_id = $_REQUEST['order_id'];
	$accNum = $_REQUEST['accNum'];
	$mycattreee = $myCategory->getOrderDetails($accNum,$order_id);
	// print_r(json_encode($mycattreee));
	print_r($mycattreee);

}
if($action == "removeCartItems"){

	$accNum = $_REQUEST['accNum'];
	$cartId = $_REQUEST['cartId'];
	$mycattreee = $myCategory->removeCartItems($id);
	print_r($mycattreee);

}

if($action == "updateCart"){

	$accNum = $_REQUEST['accNum'];
	$guest_id = $_REQUEST['guest_id'];
	
	$POST = file_get_contents("php://input");
	$array_el = json_decode($POST, true);
	$post_data = $array_el['data'];

	$mycattreee = $myCategory->updateCart($accNum,$guest_id,$post_data);
	// print_r($mycattreee);
	print_r($mycattreee);

}
if($action == "getOrders"){

	$accNum = $_REQUEST['accNum'];
	$mycattreee = $myCategory->getOrders($accNum);
	// print_r(json_encode($mycattreee));
	print_r(json_encode($mycattreee));

}


if($action == "confirmCart"){

	$accNum = $_REQUEST['accNum'];
	$guest_id = $_REQUEST['guest_id'];
	
	$POST = file_get_contents("php://input");
	$array_el = json_decode($POST, true);
	$post_data = $array_el['data'];

	$mycattreee = $myCategory->confirmCart($accNum,$guest_id,$post_data);
	// print_r($mycattreee);
	print_r(json_encode($mycattreee));
}
if($action == "getUserLogin") {


	//$guest_id = getGuestId($myCategory);
	$accNum = $_REQUEST['accNum'];

	$POST = file_get_contents("php://input");
	$data = json_decode($POST, true);
	  // print_r($data);//die;
	$post_data = $data['data'];

	$res = $myCategory->getUserLogin($accNum,$post_data);
	// print_r($res); die;

print_r(json_encode($res));
	// $msg = array();
	// $result = 0;
	// if($res!= 0)
	// 	{
	// 		$msg = $res;
	// 		$result = 1;
	// 	}
	
	// $arr_res = array("status"=>$result,"msg" => $msg);

	// echo json_encode($arr_res);
}

if($action == "getstaff"){

	$accNum = $_REQUEST['accNum'];
	$mycattreee = $myCategory->getstaff($accNum);
	 // print_r($mycattreee);die;
	print_r(json_encode($mycattreee));

}
if($action == "getauthoritiesDetails"){

	$accNum = $_REQUEST['accNum'];
	$user_id = $_REQUEST['user_id'];
	$mycattreee = $myCategory->getauthoritiesDetails($accNum,$user_id);
	 // print_r($mycattreee);die;
	print_r(json_encode($mycattreee));

}

if($action == "getmemberAdd"){
	//print_r($_POST);
	$accNum = $_REQUEST['accNum'];
	$POST = file_get_contents("php://input");
	$data = json_decode($POST, true);
	$post_data = $data['data'];

	$res = $myCategory->getmemberAdd($accNum,$post_data);
	print_r($res);
}
if($action == "updateMember_profile"){
	//print_r($_POST);
	$accNum = $_REQUEST['accNum'];
	$POST = file_get_contents("php://input");
	$data = json_decode($POST, true);
	$post_data = $data['data'];

	$res = $myCategory->updateMember_profile($accNum,$post_data);
	print_r($res);
}


if($action == "getMemberdetails"){
	$id=$_REQUEST['id'];
	$accNum = $_REQUEST['accNum'];
	$POST = file_get_contents("php://input");
	$data = json_decode($POST, true);
	$post_data = $data['data'];

	$res = $myCategory->getMemberdetails($accNum,$post_data,$id);
	print_r(json_encode($res));
}
if($action == "getopenregisterId"){
	// $id=$_REQUEST['id'];
	$accNum = $_REQUEST['accNum'];
	$userNum = $_REQUEST['userNum'];
	$POST = file_get_contents("php://input");
	$data = json_decode($POST, true);
	$post_data = $data['data'];

	$res = $myCategory->getopenregisterId($accNum,$userNum);
	print_r($res);
	 // print_r(json_encode($res));
}

?>