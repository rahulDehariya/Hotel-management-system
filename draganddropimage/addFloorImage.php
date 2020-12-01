<?php
define('731RcTnFAO', TRUE);
error_reporting(E_ALL & ~E_NOTICE & ~E_USER_NOTICE);
include_once '/projectClass.php';
$projectClass=new projectClass();
$storeFolder = '../../../images/floor/';
if (!empty($_FILES)) {
    if($_POST["WPDID"]==""){
        echo "Some error";
    }
    else
    {
    $tempFile = $_FILES['file']['tmp_name'];          //3      
    $ran = time();
    $targetPath = $storeFolder;  //4
    $fileName=$ran.$_FILES['file']['name'];
    $targetFile =  $targetPath.$fileName;  //5
    move_uploaded_file($tempFile,$targetFile); //6
    $data["Image"]=$fileName;
    $data["WPDID"]=$_POST["WPDID"];
    $table=$_POST["table"];
    $data["Status"]=1;
    $alert=$projectClass->addProjectImagesDetails($data,$table);
}
}
    if($alert==1){
        echo "Image is added";
    }
    else
    {
        echo "Error while adding Image";
    }