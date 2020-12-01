<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" >
<link href="dropzone/dist/dropzone.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
<style>
    .imagebox img{border: 1px solid #c9c9c9;padding: 5px;margin-bottom: 10px;}
</style>

<?php
include_once './imageClass.php';
$imageClass=new imageClass();
$listImages=$imageClass->listImages("", "", "");
if(count($listImages)){
    foreach ($listImages as $value) {
        echo '<div class="col-md-3 imagebox">
    <img src="gallery/'.$value["Image"].'" width="100%">
</div>';
    }
}
?>