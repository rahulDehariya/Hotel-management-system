<?php
// require_once "data.php";
// echo "string"; die;
// $myCategory = new Category();
include_once"config/config.php";

if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == 1)
{
    header("location:dashboard.php");
}

?>

 <?php
 /* $err_msg="";
   if(isset($_POST['email']))
    {

    
      $email=(isset($_POST['email']))?$_POST['email']:"";
      $password=(isset($_POST['password']))?$_POST['password']:"";
      $res=mysqli_query($con,"select * from dbtest.Manager where email= '$email'");
      if(mysqli_num_rows($res)==1)
      {
        echo"<p>Login</p>";
        $row=mysqli_fetch_assoc($res);
        
        // $_SESSION = array('manager_id' => $row['id'], 'name' => $row['name'], 'accNum' => $row['accNum'], 'is_logged_in' => 1);
        $_SESSION = array('manager_id' => $row['id'], 'name' => $row['name'], 'accNum' => 12116, 'is_logged_in' => 1);

        header("Location:dashboard.php");
      }
      else
      {
        $err_msg="Email Not Matched";
        //echo"<p>Email Not Matched</p>";
      }
    }*/
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Manager Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<style>
  .products-category {
width: 100%;
float: left;
padding: 15px;
border: 1px solid #ddd;
border-radius: 10px;
box-shadow: 0 0 7px;
}
</style>
 
<body>

     <!-- Content -->
    <div id="content">

        <!-- Page Title -->
      <!--   <div class="page-title bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 push-lg-4">
                        <h1 class="mb-0">Menu Grid</h1>
                        <h4 class="text-muted mb-0">Some informations about our restaurant</h4> -->
                        <!-- <h1 class="mb-0">Login</h1>
                        <h4 class="text-muted mb-0"> Login to exist account. or do not have account <a href="register.php" class="btn btn-outline-secondary"><span>Register</span></a></h4>

                    </div>
                </div>
            </div>
        </div> -->

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

                          <form action="" method="POST" class="cart" id="login_form">
                            <br> 
                            <div class="form-group">
                              <div class="col-md-12">

                                <label for="Description" >Email:</label> 
                            </div>
                            <div class="col-md-12">

                              <input class="form-control" id="email" name="email" placeholder="Enter your email">

                                
                              <p id="email_err" style="display: none; color: red;">Please enter Email</p>
                              <p id="email_err2" style="display: none; color: red;">Please enter valid Email</p>
                              </div>
                            </div>
                            
                            <div class="form-group">
                              <div class="col-md-12">
                                <label for="Description" >Password:</label> 
                              </div>
                              <div class="col-md-12">
                                <input  class="form-control" type="password" name="password" id="password" placeholder="Enter your password" value="">
                              <p id="password_err" style="display: none; color: red;">Please enter password</p>
                              <!-- <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal">Forgot password?
                                </a> -->
                              </div>
                            </div>
                              

                            <div class="form-group">
                              <div class="col-md-12" >
                                <p id="login_failed" style="<?php echo ($err_msg=="" ? "display: none;" : "");?> color: red;">Login Failed : Wrong email Id and password. </p>

                                <a href="javascript:void(0)" onclick="get_login()">
                                <p style="margin-top: 20px;padding: 10px;color: white;background-color:#282b2e !important;margin-bottom: 20px;width: 100;text-align: center;">Login
                                 <!-- <input type="submit" name="login" value="" > -->
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
<script>
	function get_login()
	{
    $("#login_failed").hide();
		var email= $("#email").val();
		var err_flag =0;
		$("#email_err").hide();
    $("#email_err2").hide();
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if(email=="")

		{
			$("#email").css("border", "1px solid red");
			$("#email_err").text();
			$("#email_err").show();
			err_flag =1;
        }
         else if(!regex.test(email))
        {

			$("#email").css("border", "1px solid red");
			$("#email_err2").text();
			$("#email_err2").show();
			err_flag =1;
        }
        else
        {
        	$("#email").css("border", "1px solid #e3e9ef");
        	
        }
        var pwd=$("#password").val();
        //var pwdptr=/^[A-za-z0-9]{6,12}$/
        if(pwd=="")
        {
        	$("#password").css("border", "1px solid red");
        	$("#password_err").text();
        	$("#password_err").show();
        	err_flag =1;
        }
        else
        {
        	$("#password_err").hide();	
        }
          if(err_flag == 0){

             $.ajax({
              type: 'POST',
              url: 'ajax.php?action=getUserLogin',
              data: $('#login_form').serializeArray(),
              success: function (response) {
               alert(response);
              if(response == 1){
                // window.location.reload();
                window.location="sale_register.php  ";
              }else{
                $("#login_failed").show();
              }
            }
          });
    }


          
        
       
	}
</script>

</body>
</html>
