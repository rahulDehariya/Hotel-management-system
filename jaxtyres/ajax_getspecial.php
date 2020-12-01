<?php

if(!isset($_SESSION)){
	session_start();
}

include_once '../config/config.php';

 global $con;

$action = $_GET['action'];

if($action=="Getsp123_data")
{
	
	// print_r($_POST); die;

	$sp1=$_POST['sp1'];
	$sp2=$_POST['sp2'];
	$sp3=$_POST['sp3'];


	$where = "";

	if($sp1 != "")
	{
		$where.= " and sp1='$sp1' ";
	}
	if($sp2 != "")
	{
		$where.= " and sp2='$sp2' ";
	}
	if($sp3 != "")
	{
		$where.= " and sp3='$sp3' ";
	}

	$sql="SELECT DISTINCT(itemNum) from ecom_item_special where sp1='$sp1' and sp2='$sp2' and sp3='$sp3'".$where;
	
	
	$result=mysqli_query($con,$sql);
	// print_r($result);die;


	$res_array =array();
 	while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
 		$res_array[] = $row['itemNum'];
 	}
 	//print_r($res_array);die;
  	
	echo json_encode(array("itemNum"=>$res_array));

}

if($action=="get_sp1")
{
	// $sp2=$_POST['sp2'];
	// $sp3=$_POST['sp3'];

	// //print_r($_POST);

	// $where = "";

	// if($sp2 != "")
	// {
	// 	$where.= " and sp2='$sp2' ";
	// }
	// if($sp3 != "")
	// {
	// 	$where.= " and sp3='$sp3' ";
	// }

	$sql="SELECT DISTINCT(sp1) from ecom_item_special ";


	$result=mysqli_query($con,$sql);

	$res_array =array();
 	while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
 		$res_array[] = $row['sp1'];
 	}
  	
	echo json_encode(array("sp1"=>$res_array));
}

if($action=="get_sp2")
{
	$sp1=$_POST['sp1'];
	// $sp3=$_POST['sp3'];

	//print_r($_POST);

	$where = "";

	if($sp1 != "")
	{
		$where.= " and sp1='$sp1' ";
	}
	// if($sp3 != "")
	// {
	// 	$where.= " and sp3='$sp3' ";
	// }

	$sql="SELECT DISTINCT(sp2) from ecom_item_special where sp1='$sp1' ";
	// echo $sql;die;

	$result=mysqli_query($con,$sql);

	$res_array =array();
 	while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
 		$res_array[] = $row['sp2'];
 	}
  	
	echo json_encode(array("sp2"=>$res_array));
}




if($action=="get_sp3")
{
	$sp2=$_POST['sp2'];
	$sp1=$_POST['sp1'];

	//print_r($_POST);

	$where = "";

	if($sp2 != "")
	{
		$where.= " and sp2='$sp2' ";
	}
	if($sp1 != "")
	{
		$where.= " and sp1='$sp1' ";
	}

	$sql="SELECT DISTINCT(sp3) from ecom_item_special where sp1='$sp1' and sp2='$sp2' ";

	$result=mysqli_query($con,$sql);

	$res_array =array();
 	while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
 		$res_array[] = $row['sp3'];
 	}
  	
	echo json_encode(array("sp3"=>$res_array));
}



?>