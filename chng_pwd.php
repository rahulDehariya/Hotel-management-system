<?php 

require_once "getdata/data.php";

    require_once "header.php";

?>
<div id="content">

        <!-- Page Title -->
        <div class="page-title bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 push-lg-4">
                        <!-- <h1 class="mb-0">Menu Grid</h1>
                        <h4 class="text-muted mb-0">Some informations about our restaurant</h4> -->
                        <h3 class="mb-0">Change Your Password Carefully</h3	>

                    </div>
                </div>
            </div>
        </div>
        <div class="container" style="margin-bottom: 20px; margin-top: 20px;">
         <div class="row">
          <div class="col-md-3 col-sm-2"></div>
        
            <div id="content" class="col-md-6 col-sm-8" style="padding: 15px;border: 1px solid #ddd;">
                <div class="products-category">
                   <div class="page-width" data-section-id="cart-template" data-section-type="cart-template">

                    
                      <div class="section-header text-center">
                        <h3>Update Password</h3>
                      </div>

                      <form action="javascript:void(0);" method="post" class="cart" id="login_form">
                        <br> 
                        <input type="hidden" name="token" id="token" value="<?php echo $_GET['user_token'];?>">
                        
                        <div class="form-group">
                          <div class="col-md-12">
                            <label for="Description" >New Password:</label> 
                          </div>
                          <div class="col-md-12">
                            <input  class="form-control" type="password" name="password" id="password" value="" required>
                          <p id="password_err" style="display: none; color: red;">Please enter password</p>
                          
                          </div>
                        </div>
                          

                        <div class="form-group">
                          <div class="col-md-12">
                            <label for="Description" >Confirm Password:</label> 
                          </div>
                          <div class="col-md-12">
                            <input  class="form-control" type="password" name="cpassword" id="cpassword" value="" required>
                            <p id="cpassword_err" style="display: none; color: red;">Please enter confirm password</p>
                            <p id="dis_cpassword_err" style="display: none; color: red;">Password and confirm password must be same</p>
                          
                          </div>
                        </div>
                          

                        <div class="form-group">
                          <div class="col-md-12" >
                            

                            <a href="javascript:void(0)" onclick="update_password();">
                            <p style="margin-top: 20px;padding: 10px;color: white;background-color: #171717;margin-bottom: 20px;width: 100;text-align: center;">
                              <b>Update Password</b>
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

            <script type="text/javascript">
        
      function update_password()
      { 
        var password = $("#password").val();
        var cpassword = $("#cpassword").val();
        if(password=="")
        {
          err = 1;
          $("#password_err").show();
        }else{
           $("#password_err").hide();
        }
        if(cpassword=="")
        {
          err = 1;
          $("#cpassword_err").show();
        }else{
           $("#cpassword_err").hide();
        }
        if(password!="" && cpassword!="" && cpassword!= password)
        {
          err = 1;
          $("#dis_cpassword_err").show();
        }else if(password!="" && cpassword!="" && cpassword == password){
           err = 0;
           $("#password_err").hide();
           $("#cpassword_err").hide();
           $("#dis_cpassword_err").hide();
        }


        if(err != 1){
          $.ajax({
            type: 'POST',
            url: 'ajax.php?action=update_password',
            data: $('#login_form').serializeArray(),
            success: function (response) {
              //alert(response);
              if(response == 1){
                swal("Good", "Password updated successfully, Go to login", "success");
                // window.location.href = "login.php";
              }else{
                swal("Warning", "Something went wrong. Please try again later", "error");
              }
              //alert(response);
            }
          });
        }
    }
      </script>

<?php 

Include 'footer.php';
?>
