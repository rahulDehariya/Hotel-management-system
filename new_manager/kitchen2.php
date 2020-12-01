<?php
include_once 'config/config.php';
 $HTTP_HOST='http://hotel.staffstarr.com/manager/';
// require_once "data.php";
// $myCategory = new Category();

if(!isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] != 1)
{
    header("location:index.php");
}
// print_r($_SESSION);die;

$accNum=$_SESSION['accNum'];

 
 $invoicesId_json=file_get_contents($HTTP_HOST."ajax.php?action=getinvoices_id&accNum=".$accNum);
 $invoicesId=json_decode($invoicesId_json,true);
// $invoicesId = $myCategory->getinvoices_id($accNum);
// echo ($HTTP_HOST."ajax.php?action=GetActiveJobs&accNum=".$accNum);die;
$kitchn_order_json=file_get_contents($HTTP_HOST."ajax.php?action=GetActiveJobs&accNum=".$accNum);
$kitchn_order=json_decode($kitchn_order_json,true);
// $kitchn_order=$myCategory->GetActiveJobs($accNum);
//   print_r($kitchn_order);die;



// $job_colors_json=file_get_contents($HTTP_HOST."ajax.php?action=GetJobColors&accNum=".$accNum);
// $job_colors=json_decode($job_colors_json,true);

$job_colors = array();


$all_jobs_arr = array();

foreach ($kitchn_order as $orders) {
 if(($orders['location']!=""))
    {
      

      foreach($orders['jobs'] as $data)
      {
        $all_jobs_arr[] = $data['jobNumber'];
      }
     
    }
  }

  $job_order = array_unique($all_jobs_arr);

//print_r($job_order);

   $p = 0;
       $colors = array("#086d10","#6f6566","#9e3943","#2f0e7d","#857d98","#773c6a","#940a76","#5f6f07","#4d7350","#86402b","#5580a6","#1185ec","#cc79794f","#757131cf","#a1e839");
      foreach($job_order as $data)
      {
          //if(!isset($job_colors[$data['jobNumber']])){

            $job_colors[$data] = $colors[$p];
          //}
        $p++;
         // print_r($job_colors);
      }


function get_time_defference($date1,$date2){
    $diff = abs($date2 - $date1);  
      
      
    // To get the year divide the resultant date into 
    // total seconds in a year (365*60*60*24) 
    $years = floor($diff / (365*60*60*24));  
      
      
    // To get the month, subtract it with years and 
    // divide the resultant date into 
    // total seconds in a month (30*60*60*24) 
    $months = floor(($diff - $years * 365*60*60*24) 
                                   / (30*60*60*24));  
      
      
    // To get the day, subtract it with years and  
    // months and divide the resultant date into 
    // total seconds in a days (60*60*24) 
    $days = floor(($diff - $years * 365*60*60*24 -  
                 $months*30*60*60*24)/ (60*60*24)); 
      
      
    // To get the hour, subtract it with years,  
    // months & seconds and divide the resultant 
    // date into total seconds in a hours (60*60)
  
    
   
  
      $hours = floor(($diff - $years * 365*60*60*24  
           - $months*30*60*60*24 - $days*60*60*24) 
                                       / (60*60)). ' h ';  
  
    // To get the minutes, subtract it with years, 
    // months, seconds and hours and divide the  
    // resultant date into total seconds i.e. 60 

      $minutes = floor(($diff - $years * 365*60*60*24  
               - $months*30*60*60*24 - $days*60*60*24  
                                - $hours*60*60)/ 60). 'm ';       
      
    // To get the minutes, subtract it with years, 
    // months, seconds, hours and minutes  
    $seconds = floor(($diff - $years * 365*60*60*24  
             - $months*30*60*60*24 - $days*60*60*24 
                    - $hours*60*60 - $minutes*60)). 's ';  

    $time_deffernce = '';

    if($hours > 0)
    {
      $time_deffernce.= $hours;
    }

    if($hours > 0 || $minutes > 0)
    {
      $time_deffernce.= $minutes;
    }


    $time_deffernce.=$seconds.' BEFORE';
      
    // Print the result 
    // $time_deffernce = $hours.'h '.$minutes.'m '.$seconds.'s before';  
    //$time_deffernce = $hours . $minutes . $seconds . 'before';  
    return $time_deffernce;

}


//print_r($job_colors);



// $job_colors=$myCategory->GetJobColors($accNum);

?>

	<!DOCTYPE html>
<html lang="en">

   <head>
	  <meta charset="utf-8" />
	  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	  <link rel="icon" type="image/png" href="assets/img/favicon.png">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
     Kitchen
     </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--    Bootstrap     -->
 <!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->
   <script src="assets/js/core/jquery.min.js"></script>
   <script src="assets/js/core/bootstrap.min.js"></script>

  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
</head>
<style type="text/css">
	/*li
   { 
     display:inline; 
   }
   i
   {
   	display: inline;
   } */  
   .modal-lg {
    max-width: 100%;
   }

   li{
   	width: 120px;
   	text-align: center;
   	padding: 5px 0px 0px 0px;

   }
  .demo-icons ul li {
    width: auto;
    background: #ddd;
    padding: 5px 0;
    margin:0 5px;
  }
  .nc-icon {
    font-size: 30px;
}
.demo-icons section h2 {
    bottom: 1px solid #e2e2e2;
    padding: 0 0 0.3em .2em;
    margin-bottom: 1em;
}
.demo-icons ul p {
    color: black;
    }

.demo-icons ul p {
    padding: 10px 0 0;
}
.column {
  /*float: left;*/
  width: 25%;
  padding: 2px;
  height: 50%;
}
.row
{
	margin: 0 0;
}
section
{
	/*width:30%;*/
	/*height: 80%;*/
}
ul{
	list-style-type: none;
}
 .img_offer {
    font-size: 14px;
    color: #2b2727;
    background: yellow;
    float: right;
    padding: 5px;
}

</style>

<body style="background-color:">
	<div class="row">
		 
	
		<?php
			//  $color=array('#cab7b7','#bf8484','#7588b9','#d65876');
			// $p=0;

     // print_r($kitchn_order);die;

		 foreach ($kitchn_order as $orders) {
     if(($orders['location']!=""))
        {

    			$location = $orders['location'];

    			$job_order = $orders['jobs'];

			//print_r($location);
			
		?>

	    <div class="column" style="">
			<!-- <div class="card demo-icons"> -->
			<section style="border: 5px solid #937e7e;background-color: <?php /*echo $color[$p]; */?>">
			    <h2 style="border: none; margin: 0; text-align: center">K-<?php echo $location; ?> </h2>
			    <ul style="padding:0;">
			      
			        <?php

              // print_r($job_order);
			          foreach($job_order as $data)
			          {
                   // print_r($data);

                  // echo "updated at ".$data['updated_at'];echo "<br>";
                  // echo "current ".date("Y-m-d H:i:s");
                  
                 $date1 = $ordered_time=  strtotime($data['updated_at']);
                  // echo $ordered_time .'<br>';
                  
                 $date2= $current_time= strtotime(date("Y-m-d H:i:s")); 


                  $time_difference = get_time_defference($date1,$date2);   
                 

                 ?>
                 
					    	
					        <li onclick="getjobItems_call('<?php echo $data['jobNumber'];?>',<?php echo $location;?>,<?php echo $data['invoiceId'];?>)" data-toggle="modal" data-target="#myModal" style="cursor:pointer;background:<?php echo($job_colors[$data['jobNumber']]); ?>;width: 98%; font-size: 30px;color: #fff;margin: 1%;">
					        <!-- <i class="nc-icon nc-alert-circle-i"></i> -->
                  <p style="width: 100%;    float: left;">
					         <span class="img_offer badge badge-warning" ><?php echo $time_difference;?></span></p>
					        <!-- <p style="font-size: 19px;">Job-<?php echo $data['jobNumber'];  ?></p> -->

                    <?php
                      $invoiceId=$data['invoiceId'];
                     $id=$data['jobNumber'];


                      // echo ($HTTP_HOST."ajax.php?action=getjobItems&Id=".$id."&location=".$location."&invoiceId=".$invoiceId);//die;

                      $cartData_json=file_get_contents($HTTP_HOST."ajax.php?action=getjobItems&Id=".$id."&location=".$location."&invoiceId=".$invoiceId);

                      $cartData=json_decode($cartData_json,true);

                      // if($location == 5){

                      //   print_r($cartData);continue;
                      // }

                         // print_r($cartData);
                      foreach ($cartData as  $item_quantity) {
                        $sn=0;
                        
                        ?>
                          
                         <div style="text-align: left ;margin-left: 2px;border-bottom: 1px solid #f7f7f7;"><?php echo $item_quantity['info1'] ?>

                         <span style="text-align: right;margin-right:2px;float: right;"><?php echo $item_quantity['qty']  ?></span></div>
                        <?php
                       
                      }

                    ?>
                     
					        </li>
					        <?php 
                     // print_r($data);

					          
					      }
			        ?>
			    </ul>
			</section>
		</div>
	<?php 
	$p++;
} }?>


  </div>
        <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog modal-lg">
    
          <!-- Modal content-->
          <div class="modal-content" style="font-size: 21px;">
            <div class="modal-header">
              <h4 class="modal-title" style="width:120%;">Item List</h4>

              <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                    <div class="modal-body">
                  
                  <table style="border:1px black; width:100%;" id="kitchen_list_items" class="form-group" >
 
                      <thead class="cart__row cart__header">
                        <tr>        
                          <th class="cart_items">SNo</th>
                          <th class="cart_items">Item Code</th>
                          <th class="cart_items">Item Name</th>
                          <th class="cart_items">Quantity</th>
                           <th class="cart_items" style="text-align: center">Action</th>
                        </tr>
                       </thead>
                       <tbody id="job_items_list">
                       <tr>
                       <td class="cart_items_empty" colspan=6>No item added</td></tr>
                       </tr>
                  </tbody>
                 
                </table>
              </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
            </div>
        </div>
    </div>
</body>
      <script type="text/javascript">

         // setTimeout(function(){
            
         //     location.reload();

         // },60000);

      </script>
    <script>
	  function getjobItems_call(jobId,location,invoiceId)
	  {
      // alert('ajax.php?action=getjobItems&Id='+jobId+"&location="+location+"&invoiceId="+invoiceId);
	    $.ajax({
	            type: 'POST',
	            url: 'ajax.php?action=getalljobItems&Id='+jobId+"&location="+location+"&invoiceId="+invoiceId,
	            data: {},
	            success: function (response)
	            {
	              //  alert(response);
	               var obj = JSON.parse(response);
	              //alert(obj);

	            // $("#job_items_list").html("");

	              var job_items="";
	              for(var p=0;p<obj.length;p++)
	              {
	                K=p+1;

                  var btn_prepared = "";

                  


	               // job_items +='<tr><td>'+K+'</td><td>'+obj[p]['itemCode']+'</td><td>'+obj[p]['info1']+'</td><td>'+obj[p]['qty']+'</td><td>'+obj[p]['itemName']+'</td><td>';
                  job_items +='<tr id="item_row_'+obj[p]['id']+'"><td>'+K+'</td><td>'+obj[p]['itemCode']+'</td><td>'+obj[p]['info1']+'</td><td>'+obj[p]['qty']+'</td><td>';


                  if(obj[p]['status']!=3){

                    job_items +='<button onclick=Get_item_prepared('+obj[p]['id']+')  id="item_prepared" class="btn btn-primary btn-round" style="margin-left: 100px;">Prepared</button>';

                  }


                  job_items +='<button id="item_pickedup" onclick=Get_item_pickedup('+obj[p]['id']+') class="btn btn-primary btn-round  ">PickedUp</button></td></tr>'
	              }

	               if(job_items == "")
	               {
	               	 job_items+='<tr id="item"><td class="cart_items_empty" colspan=4>No item added</td></tr>';
	               }
	               $("#job_items_list").html(job_items);

	            }
                 // $("#details").html(job_items);

	            
	        })
	      }
        function Get_item_prepared(id)
        {

          $.ajax({
            type:'POST',
            url:'ajax.php?action=Get_item_prepared&id='+id,
            data:{},
            success:function(data)
            {
              // alert(data);
              
              $("#item_prepared").hide();
            

            }

          })
        }
         function Get_item_pickedup(id)
        {
          // alert(id);
          $.ajax({
            type:'POST',
            url:'ajax.php?action=Get_item_pickedup&id='+id,
            data:{},
            success:function(data)
            {
               //$("#item_pickedup").hide();
               $("#item_row_"+id).hide();

               // $("#myModal").modal("hide");
            }

          })
        }
     </script>
</html>