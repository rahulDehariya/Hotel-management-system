<?php 

$active_page = "sale_register";
include_once "header.php";
 //require_once "data.php";
 //$myCategory = new Category();
 // print_r($con);
 
// print_r($_SESSION);
$HTTP_HOST='http://hotel.staffstarr.com/manager/';

if(!isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] != 1)
{
    header("location:index.php");
}
  //print_r($_SESSION);die;

$authority = $_SESSION['authority'];

if(!in_array("admin", $authority))
{
  header("location:not_allowed.php");
}



//print_r($_SESSION);
$accNum = $_SESSION['accNum'];//12103;
$name = $_SESSION['name'];
$userNum = $_SESSION['userNum'];



  // echo $HTTP_HOST."ajax.php?action=getActiveSaleRegister&accNum=".$accNum."&userNum=".$userNum; die;


$getActiveSaleRegister_json=file_get_contents($HTTP_HOST."ajax.php?action=getActiveSaleRegister&accNum=".$accNum."&userNum=".$userNum);

// print_r($getActiveSaleRegister_json);die;

$getActiveSaleRegister_Arr=json_decode($getActiveSaleRegister_json,true);


$getActiveSaleRegister = $getActiveSaleRegister_Arr[0];

 //print_r($getActiveSaleRegister);die;
 // $categories_item = $myCategory->categories_item_list($accNum);
// print_r($categories_item); die;


?>
<style type="text/css">
  
  .sidebar{
    display:none;
  }
  hr
  {
    border-top: 2px solid rgba(26, 21, 21, 0.49);
  }
</style>

   <div class="page-content">
          <div class="container">
             <div class="row">
               <!-- <div class="col-md-3 col-sm-2"></div>  -->
            
                <div id="login_content" class="col-md-12 col-sm-12" >
                    <div class="products-category" >
                       <div class="page-width" data-section-id="cart-template" data-section-type="cart-template">

                        
                         

                          <form action="" method="POST" class="cart" id="login_form">
                            

                            <?php if($getActiveSaleRegister['opening_balance'] <= 0 ){ ?>
                              <div class="row">

                              <div class="col-md-2"></div>
                              <div class="col-md-8">

                            <div class="section-header text-center">
                              <h3><b>Start New Sale Number</b></h3> 
                              <p>Started At - <?php echo $getActiveSaleRegister['started_at'];?></p>
                            </div>
                            <br> 
                            <div class="form-group">
                              <div class="col-md-12">

                                <label for="Description" >Enter Opening Balance:</label> 
                              </div>
                              <div class="col-md-12">

                                <input class="form-control" type="text" id="opening_balance" name="opening_balance" placeholder="Enter your opening balance">

                                  
                                <p id="opening_balance_err" style="display: none; color: red;">Please enter Opening Balance</p>
                              </div>
                            </div>

                            <div class="form-group">
                              <div class="col-md-12" >
                                
                                <a href="javascript:void(0)" onclick="submit_balance('open','<?php echo $getActiveSaleRegister['id']; ?>')">
                                <p style="margin-top: 20px;padding: 10px;color: white;background-color:#282b2e !important;margin-bottom: 20px;width: 40%;text-align: center;float: left;">Submit
                                 <!-- <input type="submit" name="login" value="" > -->
                                </p>
                                </a>

                                <a href="javascript:void(0)" onclick="continue_sale()">
                                <p class="btn btn-primary" style="margin-top: 20px;padding: 10px;color: white;margin-bottom: 20px;width: 40%;text-align: center;float:right;">Continue to sale
                                 <!-- <input type="submit" name="login" value="" > -->
                                </p>
                                </a>
                                
                              </div>
                            </div>
                            </div>
                            <div class="col-md-2"></div>
                            </div>

                          <?php }else{ ?>

                            <div class="section-header text-center">
                              <h3><b>Open Register Report</b></h3>
                              <p>Started At - <?php echo $getActiveSaleRegister['started_at'];?></p>
                            </div>
                            <br>

                            <div class="container">
                            	<div class="row">
                            		<div class="col-md-6">
			                            <div class="form-group">
                                      <div class="col-md-6" style="float: left;">
    				                          <label for="Description" >Sale Number: #<?php echo $getActiveSaleRegister['regNo'];?></label>
                                      </div>  
                                      <div class="col-md-6" style="float: left;">
                                       <label for="Dated" >Dated:<?php echo date("d M Y h:i A",strtotime($getActiveSaleRegister['started_at']));?> </label>
                                      </div>  
                                  </div>
                                  <div class="form-group">
                                      <div class="col-md-6" style="float: left;">
                                      <label for="Description" >Total Sale: &#8377;<?php echo $getActiveSaleRegister['total_sale_amount'];?></label>
                                      </div>  
                                      <div class="col-md-6" style="float: left;">
                                       <label for="Dated" >CC: &#8377;<?php echo $getActiveSaleRegister['total_cc_amount'];?></label>
                                      </div>  
                                  </div>
                                  
                                  <div class="form-group">
                                      <div class="col-md-6" style="float: left;">
                                      <label for="Description" >Bank: &#8377;<?php echo $getActiveSaleRegister['total_bank_amount'];?></label>
                                      </div>  
                                      <div class="col-md-6" style="float: left;">
                                       <label for="Dated" >Account: &#8377;<?php echo $getActiveSaleRegister['total_account_amount'];?></label>
                                      </div>  
                                  </div>
                                  
                                  <div class="form-group">
                                      <div class="col-md-6" style="float: left;">
                                      <label for="Description" > </label>
                                      </div>  
                                      <div class="col-md-6" style="float: left;">
                                       <label for="Dated" >Cash Received: &#8377;<?php echo $getActiveSaleRegister['total_cash_amount'];?></label>
                                      </div>  
                                  </div>
                                  
                                  <div class="form-group">
                                      <div class="col-md-6" style="float: left;">
                                      <label for="Description" >Opening balance: <?php echo $getActiveSaleRegister ['opening_balance'];?></label>
                                      </div>  
                                      <div class="col-md-6" style="float: left;">
                                        <?php 
                                          $cash_inHand= $getActiveSaleRegister['opening_balance']+$getActiveSaleRegister['total_cash_amount'];
                                        ?>
                                       <label for="Dated" >Cash In Hand: &#8377;<?php echo $cash_inHand;?></label>
                                      </div>  
                                  </div>
                                  
			                           </div>
			                              <div class="col-md-6">
			                              	 <label for="Description" >Enter Closing Balance:</label>
			                                <input class="form-control" type="text" id="closing_balance" name="closing_balance" placeholder="Enter your closing balance">
                                       <label for="Description" style="margin-top: 15px;" >Enter  Message :</label>
                                      <textarea class="form-control" type="text" id="close_message" name="close_message" placeholder="Enter your Message Here" style="padding: 10px;"></textarea>
                                      
			                                  
			                                <p id="closing_balance_err" style="display: none; color: red;">Please enter Closing Balance</p>
			                             
			                           

			                            <!-- <div class="form-group"> -->
			                              <!-- <div class="col-md-12" > -->
			                                
			                                <a href="javascript:void(0)" onclick="submit_balance('close','<?php echo $getActiveSaleRegister['id']; ?>')">
			                                <p style="margin-top: 20px;padding: 7px;color: white;background-color:#ff003b  !important;margin-bottom: 20px;width: 46%;text-align: center;float: left;">Close the sale
			                                 <!-- <input type="submit" name="login" value="" > -->
			                                </p>
			                                </a>

			                                <a href="javascript:void(0)" onclick="continue_sale()">
			                                <p class="btn btn-primary" style="margin-top: 20px;padding: 10px;color: white;background-color:#282b2e !important;margin-bottom: 20px;width: 52%;text-align: center;float:right;">Continue to sale
			                                 <!-- <input type="submit" name="login" value="" > -->
			                                </p>
			                                </a>
			                                 </div>
			                             <!-- </div>    -->
			                                <!-- </div> -->
			                              </div>
			                            </div>
			                            

			                          <?php } ?>
                             
                        </form>
                        
                      </div>
                        
                    </div>
                    
                </div>

                <!-- <div class="col-md-3 col-sm-2"></div> -->

              </div>  
          </div>
          <hr>
               <div class="container">
                  <div class="row">
                    <div class="col-md-12">
                      <h3>Register History</h3>
                       <table class="table">
                      <thead>
                        <tr>
                          <th>RegNo.</th>
                          <th>Opening Balance</th>
                          <th>Closing Balance</th>
                          <th>Action</th>                                   
                        </tr>
                      </thead>
                      <tbody id="Reg_history">
                       <tr id="empty_report" style="text-align: center;"></tr>
                      </tbody>
                    </table>
                    </div>              
                </div>          
              </div>

          <!-- Main Container  -->
        </div>
      
  <!--   Core JS Files   -->

  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>

  <script src="assets/js/core/bootstrap.min.js"></script>

  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>

  <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">

   function continue_sale(){
    window.location.href="dashboard.php";
   }
        
     
        function submit_balance(open_or_close, reg_id)
        {
          var err = 0;  
          if(open_or_close == 'open')
          {
            var opening_balance= $("#opening_balance").val();

              if(opening_balance <= 0 )
                {
                  err = 1;
                  $("#opening_balance_err").show();
                }else{
                  $("#opening_balance_err").hide();
                }

                if(err == 0)
                {
                  $.ajax({
                      type: 'POST',
                      url: 'ajax.php?action=submitOpeningBalance&regNum='+reg_id+'&opening_balance='+opening_balance+'&userNum='+<?php echo $userNum;?>,
                      data: {},
                      success: function (response) {
                        continue_sale();
                      }
                    });
                }

          }
          else
          {
            var closing_balance= $("#closing_balance").val();
            var close_message= $("textarea#close_message").val();


              if(closing_balance <= 0 )
                {
                  err = 1;
                  $("#closing_balance_err").show();
                }else{
                  $("#closing_balance_err").hide();
                }

                if(err == 0)
                {
                  $.ajax({
                      type: 'POST',
                      url: 'ajax.php?action=submitClosingBalance&regNum='+reg_id+'&closing_balance='+closing_balance+'&userNum='+<?php echo $userNum;?>,
                      data: {close_message:close_message},
                      success: function (response) {
                        // alert(response);
                        //window.location.href="logout.php";
                        window.location.reload();
                      }
                    });
                }

          }

        }
        Register_history();
        function Register_history(){



             $.ajax({
                type:'POST',
                url:'ajax.php?action=Register_history',
                data: {},
                success:function(response)
                {
                   // alert(response);
                  var obj=JSON.parse(response);
                  // alert(obj['regNo'])
                  
                  
                  var register_dataString="";

                  if(obj.length>0)
                  {

                    for(var i=0;i<obj.length;i++)
                    {
                      closed_balance = obj[i]['closing_balance'];

                      if(closed_balance == 0)
                      {
                        closed_balance = "Active Register";
                      }

                     var url = "ajax.php?action=GetRegister_Download_XLSX&regNo="+obj[i]['regNo']+"&opening_balance="+obj[i]['opening_balance']+"&closing_balance="+obj[i]['closing_balance'];

                     register_dataString+='<tr><td>'+obj[i]["regNo"]+'</td><td>'+obj[i]["opening_balance"]+'</td><td>'+closed_balance+'</td><td><a class="btn btn-primary" href="'+url+'" id="registerReport_'+obj[i]["regNo"]+'">Download Report</a></td></tr>';
                     
                    }

                     $("#Reg_history").html(register_dataString);
                   }
                  else
                  {
                       $("#empty_report").text('No data Found');
                  }

                   
                }
              })

        }

          
      </script>
</body>

</html>
