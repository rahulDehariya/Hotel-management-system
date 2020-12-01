<?php 

 //require_once "data.php";
 //$myCategory = new Category();
 // print_r($con);
  $active_page='Report';
 include_once('header.php');
// print_r($_SESSION);
$HTTP_HOST='http://hotel.staffstarr.com/manager/';

if(!isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] != 1)
{
    header("location:index.php");
}

    // print_r($_SESSION);//die;

    // Array ( [manager_id] => 307 [name] => Hotel Pty Ltd [accNum] => 12103 [is_logged_in] => 1 )


$accNum = $_SESSION['accNum'];//12103;
$name = $_SESSION['name'];

// echo ($HTTP_HOST."ajax.php?action=activeTables&accNum=".$accNum);die;
$activeTables_json=file_get_contents($HTTP_HOST."ajax.php?action=activeTables&accNum=".$accNum);

 // print_r($activeTables_json);die;
$activeTables=json_decode($activeTables_json,true);


// $activeTables = $myCategory->activeTables($accNum);



$categories_item_json=file_get_contents($HTTP_HOST."ajax.php?action=categories_item_list&accNum=".$accNum);
$categories_item=json_decode($categories_item_json,true);
 // $categories_item = $myCategory->categories_item_list($accNum);
// print_r($categories_item); die;

?>

  <style type="text/css">
   
.col-md-3 {
    display: inline-block;
    max-width: 20%;
}


  </style>
  
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Report</a>
            <!-- <button type="submit" class="btn btn-primary btn-round"  style="font-size: 12px;float: right; >Add New Table</button> -->
          </div>
          <div class="col-md-8"></div>
          <!-- <button type="button" class="btn btn-primary btn-round" data-toggle="modal" data-target="#items_list">Add New Member</button> -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <!-- <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="nc-icon nc-zoom-split"></i>
                  </div>
                </div>
              </div>
            </form> -->
            <ul class="navbar-nav">
              <!-- <li class="nav-item">
                <a class="nav-link btn-magnify" href="#pablo">
                  <i class="nc-icon nc-layout-11"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Stats</span>
                  </p>
                </a>
              </li> -->
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-layout-11"></i>
                  <!-- <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p> -->
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <!-- <div class="panel-header panel-header-lg">

  <canvas id="bigDashboardChart"></canvas>


</div> -->
      <div class="content">
        
        <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <form action="" method="POST" id="report_data" >
                 <div class="form-group ">
                    <div class="col-md-3">
                      <label for="Description"> Date From:</label> 
                    
                      <input required class="form-control" id="date_from" name="date_from" placeholder="Enter your Date From"  type="date" style="display: inline-block;" />
                      <p id="datefrom_err" style="display: none; color: red;">Please enter Date From</p>
                     </div>
                            <div class="col-md-3">
                              <label for="Description">Date To</label> 
                            
                            
                              <input required class="form-control" id="date_to" name="date_to" placeholder="Enter Date To"  type="date"  style="display: inline-block;"  />
                              <p id="dateto_err" style="display: none; color: red;">Please enter Date to</p>
                            </div>
                       
                            
                            <div class="col-md-3">
                              <label for="Description"> Department:</label> 

                                    
                                    
                                  <select id="department_select" class="browser-default custom-select" name="department_select"  >
                                    <option value="" disabled selected hidden> Department Type</option>
                                  <?php 
                                    foreach($activeTables as $department)
                                    {
                                     ?>
                                   
                                   <option value="<?php echo $department['department']['id']; ?>"><?php  echo $department['department']['name'];  ?></option>
                                   <?php
                                 }
                                   ?>
                                </select>
                            
                            
                              <p id="department_err" style="display: none; color: red;">Please Select Department</p>
                            </div>    
                            <div class="col-md-3">
                                <label for="Description"> Payment Type:</label> 
                                    <select id="payment_type" class="browser-default custom-select" name="payment_type"  >
                                     <option value="" disabled selected hidden> Payment Type</option>
                                     <option value="1">Cash</option>
                                     <option value="2">CC</option>
                                     <option value="3">Bank</option>
                                     <option value="4">Account</option>
                                  </select>
                                
                              <p id="paytype_err" style="display: none; color: red;">Please Select Payment type</p>
                            </div>
                            <button style=""  onclick="GetReports()" type="button" placeholder="Search" aria-label="Search" name="search" onclick="" id="submit" class="btn-header btn btn-primary">Submit</button>
                          </form>
                            </div>
                            <div class="container">
                              <div class="row">
                                <div class="col-md-12">
                                   <table class="table">
                                  <thead>
                                    <tr>
                                      <th>Table No.</th>
                                      <th>Client Name</th>
                                      <th>Membership</th>
                                      <th>Total Amount</th>
                                      <th>Balance Due</th>                                   
                                    </tr>
                                  </thead>
                                  <tbody id="data_report">
                                   <tr id="empty_report" style="text-align: center;"></tr>
                                  </tbody>
                                </table>
                                </div>

                            
                          </div>
                          
                        </div>
                      </div>
                         <a style="float: right;"  href="javascript:void(0)" type="button" placeholder="Search" aria-label="Search" name="search" id="download_excel" class="btn-header btn btn-primary" >Excel Export</a>

                     </div>                    
                  </div>


                <div class="modal fade" id="items_list" role="dialog">
                    <div class="modal-dialog modal-lg">
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" style="width: 100%; text-align: center;">Add New Member
                            </h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                         <div class="row">
                              <form action="javascript:void(0);" method="post" class="cart" id="register_form" style="width:100%">
                                      <br> 
                                     
                                          <input  name="accNum"   type="hidden" value="" />
                                       
                                      </div>
                                       <div class="form-group row">
                                        <div class="col-md-3">
                                          <label for="Description" style="float: right;"> Name:</label> 
                                        </div>
                                        <div class="col-md-9" style="float: right;">
                                          <input required class="form-control" id="reg_username" name="username" placeholder="Enter your name"  type="text" />
                                          <p id="reg_username_err" style="display: none; color: red;">Please enter your name</p>
                                        </div>
                                      </div>
                                       <div class="form-group row">
                                        <div class="col-md-3">
                                          <label for="Description" style="float: right;">DOB:</label> 
                                        </div>
                                        <div class="col-md-9" style="float: right;">
                                          <input class="form-control" id="reg_dob" name="dob" placeholder="Enter your DOB"  type="date" required/>
                                          <p id="reg_dob_err" style="display: none; color: red;">Please enter your DOB</p>
                                        </div>
                                      </div>
                                       <div class="form-group row">
                                        <div class="col-md-3">
                                          <label for="Description" style="float: right;">Mobile:</label> 
                                        </div>
                                        <div class="col-md-9" style="float: right;">
                                          <input class="form-control" id="reg_mobile" name="mobile" placeholder="Enter your mobile"  type="tel" required/>
                                          <p id="reg_mobile_err" style="display: none; color: red;">Please enter your mobile</p>
                                        </div>
                                      </div>
                                       <div class="form-group row">
                                        <div class="col-md-3">
                                          <label for="Description" style="float: right;">Email:</label> 
                                        </div>
                                        <div class="col-md-9" style="float: right;">
                                          <input class="form-control" id="reg_email" name="email" placeholder="Enter your email"  type="email" required/>
                                          <p id="reg_email_err" style="display: none; color: red;">Please enter your email</p>
                                           <p id="reg_email_err2" style="display: none; color: red;">Please enter valid Email</p>
                                        </div>
                                      </div>
                                      
                                       <div class="form-group row">
                                        <div class="col-md-3">
                                          <label for="Description" style="float: right;">Membership Number:</label> 
                                        </div>
                                        <div class="col-md-9" style="float: right;">
                                          <input class="form-control" id="memb_num" name="memberNum" placeholder="Enter your Membership number"  type="text" required/>
                                          <p id="reg_memNum_err" style="display: none; color: red;">Please enter your Membership number</p>
                                        </div>
                                      </div> 
                                      <div class="form-group row">
                                        <div class="col-md-3">
                                          <label for="Description" style="float: right;">Membership Type:</label> 
                                        </div>
                                        <div class="col-md-9" style="float: right;">
                                          <select id="memtype_select" class="form-control" name="job_type"  >
                                             <option value="" disabled selected hidden>Select Your Membership Type</option>
                                             <option value="1">Gold:1</option>
                                             <option value="2">Silver:2</option>
                                             <option value="3">Bronze:3</option>
                                          </select>
                                          <p id="reg_memType_err" style="display: none; color: red;">Please select your Job Type</p>
                                        </div>
                                      </div>
                                       
                                     
                                      <div class="form-group">
                                        <div class="col-md-3" ></div>
                                          <div class="col-md-9">
                                          <p id="reg_email_exist_err" style="display: none; color: red;">Email Id already exist</p>

                                          <a href="javascript:void(0)" onclick="get_register()" style="text-align: -moz-center;">
                                          <p style="margin-top: 20px;padding: 10px;color: white;background-color: #282b2e !important;margin-bottom: 20px;width:40%;text-align: center;">
                                            <b>REGISTER</b>
                                          </p>
                                          </a>
                                          
                                        </div>
                                      </div>
                                            
                                  </form>
                               </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                            
                          </div>
                      </div>

                        <div class="modal fade" id="editMember_model" role="dialog">
                            <div class="modal-dialog modal-lg">
                            
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" style="width: 100%; text-align: center;">Edit Your Profile
                                    </h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                 <div class="row">
                                   <form action="javascript:void(0);" method="post" class="cart" id="update_form" style="width:100%">
                                          <br>                                
                                          <input  name="accNum"   type="hidden" value="" />
                                           <div class="form-group row">
                                            <div class="col-md-3">
                                              <label for="Description" style="float: right;"> Name:</label> 
                                            </div>
                                            <div class="col-md-9" style="float: right;">
                                              <input class="form-control" id="username" name="username" placeholder="Enter your name"  type="text"/>
                                              <p id="reg_username_err" style="display: none; color: red;">Please enter your name</p>
                                            </div>
                                          </div>
                                           <div class="form-group row">
                                            <div class="col-md-3">
                                              <label for="Description" style="float: right;">DOB:</label> 
                                            </div>
                                            <div class="col-md-9" style="float: right;">
                                              <input class="form-control" id="mem_dob" name="dob" placeholder="Enter your DOB"  type="date"/>
                                              <p id="reg_dob_err" style="display: none; color: red;">Please enter your DOB</p>
                                            </div>
                                          </div>
                                           <div class="form-group row">
                                            <div class="col-md-3">
                                              <label for="Description" style="float: right;">Mobile:</label> 
                                            </div>
                                            <div class="col-md-9" style="float: right;">
                                              <input class="form-control" id="mem_mobile" name="mobile" placeholder="Enter your mobile"  type="tel"/>
                                              <p id="reg_username_err" style="display: none; color: red;">Please enter your mobile</p>
                                            </div>
                                          </div>
                                           <div class="form-group row">
                                            <div class="col-md-3">
                                              <label for="Description" style="float: right;">Email:</label> 
                                            </div>
                                            <div class="col-md-9" style="float: right;">
                                              <input class="form-control" id="mem_email" name="email" placeholder="Enter your email"  type="email"/>
                                              <p id="reg_username_err" style="display: none; color: red;">Please enter your email</p>
                                            </div>
                                          </div>
                                          
                                           <div class="form-group row">
                                            <div class="col-md-3">
                                              <label for="Description" style="float: right;">Membership Number:</label> 
                                            </div>
                                            <div class="col-md-9" style="float: right;">
                                              <input class="form-control" id="mem_num" name="memberNum" placeholder="Enter your Membership number"  type="text"/>
                                              <p id="reg_username_err" style="display: none; color: red;">Please enter your Membership number</p>
                                            </div>
                                          </div> 
                                          <div class="form-group row">
                                            <div class="col-md-3">
                                              <label for="Description" style="float: right;">Membership Type:</label> 
                                            </div>
                                            <div class="col-md-9" style="float: right;">
                                              <select class="form-control" id="mem_type" name="job_type">
                                                 <option default>-Select Your Job Type-</option>
                                                 <option value="1">Gold:1</option>
                                                 <option value="2">Silver:2</option>
                                                 <option value="3">Bronze:3</option>
                                              </select>
                                               <p id="reg_username_err" style="display: none; color: red;">Please enter your Job Type</p>
                                            </div>
                                          </div>
                                           
                                         
                                          <div class="form-group">
                                            <div class="col-md-3" ></div>
                                              <div class="col-md-9">
                                              <p id="reg_email_exist_err" style="display: none; color: red;">Email Id already exist</p>
                                              <input type="hidden" name="user_id" id="user_id" value="">
                                              <a href="javascript:void(0)" onclick="update_profile()" style="text-align: -moz-center;">
                                              <p style="margin-top: 20px;padding: 10px;color: white;background-color: #282b2e !important;margin-bottom: 20px;width:40%;text-align: center;">
                                                <b>Update Profile</b>
                                              </p>
                                              </a>
                                              
                                            </div>
                                          </div>
                                                
                                      </form>
                                 </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                              
                            </div>
                        </div>
                      </div>
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
        
        $(document).ready(function() {
          $('#cart_list_items').DataTable({
              "ajax":{
                  url :"ajax.php?action=getstaff", // json datasource
                  type: "GET",  // type of method  , by default would be get
                  error: function($res){  // error handling code
                      // alert($res);
                    //  console.log(Object($res));
                  }
                }
            });
        });

        function get_register()
        {


            var username= $("#reg_username").val();
            var dob= $("#reg_dob").val();
            var mobile= $("#reg_mobile").val();
            var email= $("#reg_email").val();
            var mem_num= $("#memb_num").val();
            var memb_type= $("#memtype_select").val();
            var err = 0;  

              if(username == '' )
                {
                  err = 1;
                  $("#reg_username_err").show();
                }else{
                  $("#reg_username_err").hide();
                }

                if(memb_type == '' )
                {
                  err = 1;
                  $("#reg_memType_err").show();
                }else{
                  $("#reg_memType_err").hide();
                } 
                
               if(dob == '' )
                    {
                      err = 1;
                      $("#reg_dob_err").show();
                    }else{
                      $("#reg_dob_err").hide();
                    } 
                if(mobile == '' )
                        {
                          err = 1;
                          $("#reg_mobile_err").show();
                        }else{
                          $("#reg_mobile_err").hide();
                        } 
                if(mem_num == '' )
                      {
                        err = 1;
                        $("#reg_memNum_err").show();
                       }else{
                          $("#reg_memNum_err").hide();
                        } 
                    if(email == '' )
                      {
                        err = 1;
                        $("#reg_email_err").show();
                      }else{
                        $("#reg_email_err").hide();
                      } 
                  
                     if ( email != '' && !validateEmail(email))
                      {
                        err = 1;
                        
                        $("#reg_email_err2").show();
                      }else{
                        
                        $("#reg_email_err2").hide();
                      }

                      if(err == 1)
                      {
                        return false;
                      }
                      else
                      {
                       $.ajax({
                            type: 'POST',
                            url: 'ajax.php?action=getmemberAdd',
                            data: $('#register_form').serializeArray(),
                            success: function (response) {
                               // alert(response); 

                            if(response == 1)
                              {
                                      $("#body-wrapper").removeClass("animsition");
                                      $("#body-wrapper").removeClass("fade-out-up-sm");

                                swal("Registered!", "You have registered successfully! Please login to proceed...", "success");

                                document.getElementById('register_form').reset();
                              }else{
                                swal("Failed!", "Something went wrong! Please try again later", "warning");
                              }
                              $('#cart_list_items').DataTable().ajax.reload();
                              $('#items_list').modal('hide');
                            }

                            });
                      
                     }
                     

        }
          function edit_member(id)
          {
            // alert(id);
            $.ajax({
                  type:'POST',
                  url:'ajax.php?action=getMemberdetails&id='+id,
                  data:{},
                  success:function(response)
                  {
                    // alert(response);
                    var obj = JSON.parse(response);
                    var name=obj[0]['name'];
                    var mobile=obj[0]['mobile'];
                    var dob=obj[0]['dob'];
                    var email=obj[0]['name'];
                    var member_num=obj[0]['jobTitle'];
                    var member_type=obj[0]['jobType'];
                    $('#mem_type option[value="'+member_type+'"]').prop('selected', true);

                    // $("#membertype_select option:"+member_type).attr('selected','selected');

                    var user_id=obj[0]['id'];
                    $("#username").val(name);
                    $("#mem_dob").val(dob);
                    $("#mem_mobile").val(mobile);
                    $("#mem_email").val(email);
                    $("#mem_num").val(member_num);
                    $("#user_id").val(user_id);


                  }
            })

          }
          function update_profile()
          {
            
              $.ajax({
                type:'POST',
                url:'ajax.php?action=updateMember_profile',
                data: $('#update_form').serializeArray(),
                success:function(response)
                {
                  // alert(response);
                   swal("Profile updated successfully", "", "success");
                   $('#cart_list_items').DataTable().ajax.reload();
                   $('#editMember_model').modal('hide');
                }
              })
          }
          function validateEmail($email) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test( $email );
          }

          function GetReports()
          {
            // alert('ajax.php?action=GetReports');

            var date_from =$("#date_from").val();
            var date_to=$("#date_to").val();
            var department =$("#department_select").val();
            var payment_type=$("#payment_type").val();

             $.ajax({
                type:'POST',
                url:'ajax.php?action=GetReports',
                data: $('#report_data').serializeArray(),
                success:function(response)
                {

                  $("#download_excel").attr("href","ajax.php?action=GetReports_Download_XLSX&date_from="+date_from+"&date_to="+date_to+"&department_select="+department+"&payment_type="+payment_type);
                     // alert(response);
                    var obj=JSON.parse(response);
                     // alert(obj[0]['info1']);
                    var report_data_string = "";

                    if(obj.length>0)
                    {
                      for(var i=0;i<obj.length;i++)
                      {
                        var  balance_due= Math.floor(obj[0]["invoice_total"]-obj[0]["total_amount"]);
                        report_data_string+='<tr><td>'+obj[0]["info1"]+'</td><td>'+obj[0]["name"]+'</td><td>'+obj[0]["jobType"]+'</td><td>'+obj[0]["total_amount"]+'</td><td>'+balance_due+'</td></tr>';

                      }
                      $("#data_report").html(report_data_string);
                    

                    }
                    else
                    {
                      $("#empty_report").text('No data Found');
                    }
                    

                   


                }
              })
          }
         
        
          function GetReports_Download_XLSX()
          {
            
             $.ajax({
                type:'POST',
                url:'ajax.php?action=GetReports_Download_XLSX',
                data: $('#report_data').serializeArray(),
                success:function(response)
                {

                  alert(response);
                }
              })
          }

      </script>
</body>

</html>
