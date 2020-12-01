<?php 

    require_once "header.php";
 //   require_once "getdata/data.php";
 // $myCategory = new Category();

// print_r($_SESSION);

    if(isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0)
   {
      //header("location:index.php");
      echo "<script>window.location.href='index.php'; </script>";
   }


    

 ?>
 <style type="text/css">
label {
    font-size: 16px;
    font-weight: normal;
    margin-top: 20px;
    display: none;
}
 .col-md-12{
    margin: 5px;
 }

textarea, input[type="text"], input[type="password"], input[type="number"], input[type="email"], .form-control, select {
    font-size: 16px;
}

.footer-classic {
              position: relative;
              width: 100%;
              float: left;
            }

    .typeheader-2 .header-bottom {
        border-bottom: none;
    }
    .cart-flex-item{
      text-align: center;
    }
  
     table {
         width:100%;
      }
      
      th {
          font-family: "Montserrat", sans-serif;
          font-weight: 700;
      }
      th, td {
          text-align: left;
          padding: 10px 10px;
      }
      .cart__header {
          background: #ddd;
          border: 1px solid #ddd;
      }
      .border-bottom {
          border-bottom: 1px solid #f2f2f2;
      }
      .cart__image-wrapper {
        display: table-cell;
        width: 150px;
    }
    .total_td{
      border: 1px solid #ddd;
      background: #ddd;
    } 

    .products-category{
      width: 100%;float: left; padding: 15px;border: 1px solid #ddd;
      border-radius: 10px;
      box-shadow: 0 0 7px;
    }

</style>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">

  function get_login()
  {

    var email = $("#email").val();
    var password = $("#password").val();
    var err = 0;    

    $("#login_failed").hide();

    
    if(email == '' )
    {
      err = 1;
      $("#email_err").show();
    }else{
      $("#email_err").hide();
    } 

    if ( email != '' && !validateEmail(email))
    {
      err = 1;
      
      $("#email_err2").show();
    }else{
      
      $("#email_err2").hide();
    }
    if(password == '' )
    {
      err = 1;
      $("#password_err").show();
    }else{
       $("#password_err").hide();
    }


    if(err == 0){
      $.ajax({

          type: 'POST',
          url: 'ajax.php?action=getUserLogin',
          data: $('#login_form').serializeArray(),
          success: function (response) {
            //alert(response);
             $("#body-wrapper").removeClass("animsition");
             $("#body-wrapper").removeClass("fade-out-up-sm");

            // alert(response);
            if(response == 1){
              window.location.reload();
            }else
            {
              $("#login_failed").show();
            }
          }
        });
    }
  }

  function get_register()
  {

    var email = $("#reg_email").val();
    var password = $("#reg_password").val();
    var cpassword = $("#reg_cpassword").val();
    var mobile = $("#reg_mobile").val();
    var username = $("#reg_username").val();
    var err = 0;    

    //$("#register_failed").hide();

    $("#reg_email_exist_err").hide();
    
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

    if(username == '' )
    {
      err = 1;
      $("#reg_username_err").show();
    }else{
       $("#reg_username_err").hide();
    }

    if(mobile == '' )
    {
      err = 1;
      $("#reg_mobile_err").show();
    }else{
       $("#reg_mobile_err").hide();
    }

    if(password == '' )
    {
      err = 1;
      $("#reg_password_err").show();
    }else{
       $("#reg_password_err").hide();
    }
    if(cpassword == '' )
    {
      err = 1;
      $("#reg_cpassword_err").show();
    }else{
      $("#reg_cpassword_err").hide();
    }

    if(password != '' && cpassword != '' && password != cpassword){
      err = 1;
      $("#reg_cpassword_match_err").show();
    }else{
      $("#reg_cpassword_match_err").hide();
    }
console.log("sf"+err);
    if(err == 0){
      $.ajax({

          type: 'POST',
          url: 'ajax.php?action=checkEmailExist',
          data: 'email='+email,
          success: function (response) {
            // alert(response);
            if(response == 1){
              //alert("email exist");
              $("#reg_email_exist_err").show();
            }else{
                $.ajax({
                  type: 'POST',
                  url: 'ajax.php?action=getUserRegister',
                  data: $('#register_form').serializeArray(),
                  success: function (response) {
                      console.log("OUT=="+response);
                    if(response == 1)
                    {
                            $("#body-wrapper").removeClass("animsition");
                            $("#body-wrapper").removeClass("fade-out-up-sm");

                      swal("Registered!", "You have registered successfully! Please login to proceed...", "success");

                      document.getElementById('register_form').reset();
                    }else{
                      swal("Failed!", "Something went wrong! Please try again later", "warning");
                    }
                    //alert(response);
                    // if(response == 1){
                    //   window.location.reload();
                    // }else{
                    //   $("#login_failed").show();
                    // }
                  }
                });
            }
          }
        });
    }else{
      console.log("else");
      $("#body-wrapper").removeClass("animsition");
      $("#body-wrapper").removeClass("fade-out-up-sm");
    }
  }

  function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test( $email );
  }
  
  function update_cart_page(product_id,status)
    {
      //alert("remove_it");

      swal({
          title: "Are you sure?",
          text: "You want to remove this item from cart ?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {

            $.post("ajax_autopart.php?action=removeCartItems&cartId="+product_id,{},
            function (data) {

              swal("Deleted!", "Item removed from Cart!", "success");
              //console.log(data);
              window.location.reload();
            });

            
          } else {
            //swal("Your imaginary file is safe!");
          }
        });



    }


</script>

 
        <!-- Content -->
    <div id="content">

        <!-- Page Title -->
        <div class="page-title bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 push-lg-4">
                        <!-- <h1 class="mb-0">Menu Grid</h1>
                        <h4 class="text-muted mb-0">Some informations about our restaurant</h4> -->
                        <h1 class="mb-0">Login</h1>
                        <h4 class="text-muted mb-0"> Login to exist account. or do not have account <a href="register.php" class="btn btn-outline-secondary"><span>Register</span></a></h4>

                    </div>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="page-content">
          <div class="container">
             <div class="row">
               <div class="col-md-3 col-sm-2"></div> 
            
                <div id="login_content" class="col-md-6 col-sm-8" >
                    <div class="products-category" >
                       <div class="page-width" data-section-id="cart-template" data-section-type="cart-template">

                        
                          <div class="section-header text-center">
                            <h3><b>LOGIN</b></h3>
                          </div>

                          <form action="javascript:void(0);" method="post" class="cart" id="login_form">
                            <br> 
                            <div class="form-group">
                              <div class="col-md-12">

                                <label for="Description" >Email:</label> 
                            </div>
                            <div class="col-md-12">

                              <input class="form-control" id="email" name="email" placeholder="Enter your email"  type="email"/>

                                
                              <p id="email_err" style="display: none; color: red;">Please enter Email</p>
                              <p id="email_err2" style="display: none; color: red;">Please enter valid Email</p>
                              </div>
                            </div>
                            
                            <div class="form-group">
                              <div class="col-md-12">
                                <label for="Description" >Password:</label> 
                              </div>
                              <div class="col-md-12">
                                <input  class="form-control" type="password" name="password" id="password" placeholder="Enter your password" value="" required>
                              <p id="password_err" style="display: none; color: red;">Please enter password</p>
                              <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal">Forgot password?
                                </a>
                              </div>
                            </div>
                              

                            <div class="form-group">
                              <div class="col-md-12" >
                                <p id="login_failed" style="display: none; color: red;">Login Failed : Wrong email Id and password. </p>

                                <a href="javascript:void(0)" onclick="get_login()">
                                <p style="margin-top: 20px;padding: 10px;color: white;background-color:#282b2e !important;margin-bottom: 20px;width: 100;text-align: center;">
                                  <b>LOGIN</b>
                                </p>
                                </a>
                                
                              </div>
                            </div>
                                  
                        </form>
                        
                      </div>
                        
                    </div>
                    
                </div>

                <div class="col-md-3 col-sm-2"></div>

              </div>  
          </div>
      

          <!-- Main Container  -->
        </div>
    </div>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Forgot Password</h4>
      </div>
      <div class="modal-body">
        <p class="ingredients">
          <span class="ingre" id='inline_ingredients'>Enter your e-mail address to have the password associated with that account reset. A new password will be e-mailed to the address.</span>
        </p>

        <form id="forgot_password_form" action="" method="POST">
          <div class="form-group">
            <input type="email" class="form-control" name="email">
          </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="forgot_password();">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
 <?php 

Include 'footer.php';


 ?>
   <script type="text/javascript">
        
      function forgot_password(){
        $("#body-wrapper").removeClass("fade-out-up-sm");
        $.ajax({
          type: 'POST',
          url: 'ajax.php?action=forgot_password',
          data: $('#forgot_password_form').serializeArray(),
          success: function (response) {
            if(response == 1){

              swal("Good", "Password recovery link has been sent to your email address", "success");
              // window.location.reload();
              // $('.close').click(); 
              // $('.modal-backdrop').hide();
            }else{
              swal("Warning", "Something went wrong. Please try again later", "error");
              // $('.close').click(); 
              // $('.modal-backdrop').hide();
            }
            //alert(response);
          }
        });
      }
      </script>
