<?php
   // require_once "getdata/autopart_data.php";
   
   // $myCategory = new Category();
 require_once "header.php";
   
   if(isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0)
   {
      header("location:index.php");
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
          url: 'ajax_autopart.php?action=getUserLogin',
          data: $('#login_form').serializeArray(),
          success: function (response) {
            //alert(response);
            if(response == 1){
              window.location.reload();
            }else{
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

    if(err == 0){
      $.ajax({

          type: 'POST',
          url: 'ajax_autopart.php?action=checkEmailExist',
          data: 'email='+email,
          success: function (response) {
            // alert(response);
            if(response == 1){
              //alert("email exist");
              $("#reg_email_exist_err").show();
            }else{
                $.ajax({
                  type: 'POST',
                  url: 'ajax_autopart.php?action=getUserRegister',
                  data: $('#register_form').serializeArray(),
                  success: function (response) {
                    if(response == 1)
                    {
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

 
        <div class="header-middle hidden-compact">
            <div class="container">
                <div class="row">           
                    <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12"  style="display: none;">
                        
                        
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 middle-right"  style="display: none;">
                        <div class="search-header-w">
                            <!-- <div class="icon-search hidden-lg hidden-md"><i class="fa fa-search"></i></div>                                 -->
                              
                            <div id="sosearchpro" class="sosearchpro-wrapper so-search " style="display: none;">
                                <form method="GET" action="index.html">
                                    <div id="search0" class="search input-group form-group">
                                        <div class="select_category filter_type  icon-select hidden-sm hidden-xs">
                                            <select class="no-border" name="category_id">
                                                <option value="0">All Categories</option>
                                                <option value="78">Apparel</option>
                                                <option value="77">Cables &amp; Connectors</option>
                                                <option value="82">Cameras &amp; Photo</option>
                                                <option value="80">Flashlights &amp; Lamps</option>
                                                <option value="81">Mobile Accessories</option>
                                                <option value="79">Video Games</option>
                                                <option value="20">Jewelry &amp; Watches</option>
                                                <option value="76">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Earings</option>
                                                <option value="26">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Wedding Rings</option>
                                                <option value="27">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Men Watches</option>
                                            </select>
                                        </div>

                                        <input class="autosearch-input form-control" type="text" value="" size="50" autocomplete="off" placeholder="Keyword here..." name="search">
                                
                                        <button type="submit" class="button-search btn btn-primary" name="submit_search"><i class="fa fa-search"></i></button>
                                    
                                    </div>
                                    <input type="hidden" name="route" value="product/search">
                                </form>
                            </div>
                        </div>

                        <div class="shopping_cart" style="display: none;">
                            <div id="cart" class="btn-shopping-cart">

                                <a href="javascript:void(0)" data-loading-text="Loading... " class="btn-group top_cart dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <div class="shopcart" onclick="window.location.href='autoparts_view_cart.php';">
                                        <span class="icon-c">
                                            <i class="fa fa-shopping-basket"></i>
                                        </span>
                                        <div class="shopcart-inner">
                                            <p class="text-shopping-cart">
                                                My cart
                                            </p>

                                            <span class="total-shopping-cart cart-total-full">
                                            <span class="items_cart" id="cart_items">0</span><!-- <span class="items_cart2"> item(s)</span><span class="items_carts">$162.00</span> -->
                                            </span>

                                        </div>
                                    </div>
                                </a>

                                
                            </div>
                            <script type="text/javascript">
            
                                $.post("ajax_autopart.php?action=getCartItems",{},
                                  function (data1) {

                                    //alert(data1);

                                    data = $.parseJSON(data1);
                                    // alert(data);
                                    // console.log(data);

                              //alert(data1);
                                    var cart_count = data.length;
                                    //alert(cart_count);
                                    $("#cart_items").text(cart_count);
                                    });
                              </script>
                        </div>

                        <div style="display: none;" class="wishlist hidden-md hidden-sm hidden-xs"><a href="#" id="wishlist-total" class="top-link-wishlist" title="Wish List (0) "><i class="fa fa-heart"></i></a></div>
                                         
                    </div>
                </div>
            </div>
        </div>
         <div class="header-bottom hidden-compact">
         <div class="container">
         <div class="row">
          <!-- <div class="col-md-3 col-sm-2"></div> -->
        
            <div id="login_content" class="col-md-6 col-sm-12" >
                <div class="products-category" >
                   <div class="page-width" data-section-id="cart-template" data-section-type="cart-template">

                    
                      <div class="section-header text-center">
                        <h1><b>LOGIN</b></h1>
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
                            <p style="margin-top: 20px;padding: 10px;color: white;background-color: #171717;margin-bottom: 20px;width: 100;text-align: center;">
                              <b>LOGIN</b>
                            </p>
                            </a>
                            
                          </div>
                        </div>
                              
                    </form>
                    
                  </div>
                    
                </div>
                
            </div>

            <div id="register_content" class="col-md-6 col-sm-12">
              <div class="products-category" >
                   <div class="page-width" data-section-id="cart-template" data-section-type="cart-template">
                      <div class="section-header text-center">
                        <h1><b>REGISTER</b></h1>
                      </div>

                      <form action="javascript:void(0);" method="post" class="cart" id="register_form">
                        <br> 
                        <div class="form-group">
                          <div class="col-md-12">
                            <label for="Description" >User Name:</label> 
                          </div>
                          <div class="col-md-12">
                            <input class="form-control" id="reg_username" name="username" placeholder="Enter your name"  type="email"/>
                            <p id="reg_username_err" style="display: none; color: red;">Please enter your name</p>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-12">
                            <label for="Description" >Mobile:</label> 
                          </div>
                          <div class="col-md-12">
                            <input class="form-control" id="reg_mobile" name="mobile" placeholder="Enter your mobile"  type="text"/>
                            <p id="reg_mobile_err" style="display: none; color: red;">Please enter mobile</p>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="col-md-12">
                            <label for="Description" >Email:</label> 
                          </div>
                          <div class="col-md-12">
                            <input class="form-control" id="reg_email" name="email" placeholder="Enter your email"  type="email"/>
                            <p id="reg_email_err" style="display: none; color: red;">Please enter Email</p>
                            <p id="reg_email_err2" style="display: none; color: red;">Please enter valid Email</p>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="col-md-12">
                            <label for="Description" >Password:</label> 
                          </div>
                          <div class="col-md-12">
                            <input  class="form-control" type="password" placeholder="Enter your password"  name="password" id="reg_password" value="" required>
                          <p id="reg_password_err" style="display: none; color: red;">Please enter password</p>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-12">
                            <label for="Description" >Confirm Password:</label> 
                          </div>
                          <div class="col-md-12">
                            <input  class="form-control" type="password" name="cpassword" id="reg_cpassword" value="" placeholder="Re-Enter your password" required>
                          <p id="reg_cpassword_err" style="display: none; color: red;">Please re-enter password</p>
                          <p id="reg_cpassword_match_err" style="display: none; color: red;">Password and confirm password must be  same </p>
                          </div>
                        </div>
                          
                        <div class="form-group">
                          <div class="col-md-12" >

                            <p id="reg_email_exist_err" style="display: none; color: red;">Email Id already exist</p>

                            <a href="javascript:void(0)" onclick="get_register()">
                            <p style="margin-top: 20px;padding: 10px;color: white;background-color: #171717;margin-bottom: 20px;width: 100;text-align: center;">
                              <b>REGISTER</b>
                            </p>
                            </a>
                            
                          </div>
                        </div>
                              
                    </form>
                    
                  </div>
                    
                </div>

            </div>
            </div>  
            </div>
      

      </header>
      <!-- //Header Container  -->



      <!-- Main Container  -->
      </div>
      <!-- //Main Container -->
      <!-- Footer Container -->
      <!-- //end Footer Container -->
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

<?php Include 'footer.php' ?>
  <script type="text/javascript">
        
      function forgot_password(){
        $.ajax({

          type: 'POST',
          url: 'ajax_autopart.php?action=forgot_password',
          data: $('#forgot_password_form').serializeArray(),
          success: function (response) {
            if(response == 1){

              swal("Good", "Password recovery link has been sent to your email address", "success");
              //window.location.reload();
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


      <!-- Include Libs & Plugins
         ============================================ -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/jquery-2.2.4.min.js.download"></script>
      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/bootstrap.min.js.download"></script>
      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/owl.carousel.js.download"></script>
      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/slick.js.download"></script>
      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/libs.js.download"></script>
      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/jquery.unveil.js.download"></script>
      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/jquery.countdown.min.js.download"></script>
      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/jquery.dcjqaccordion.2.8.min.js.download"></script>
      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/moment.js.download"></script>
      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/bootstrap-datetimepicker.min.js.download"></script>
      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/jquery-ui.min.js.download"></script>
      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/modernizr-2.6.2.min.js.download"></script>
      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/jquery.miniColors.min.js.download"></script>
      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/lightslider.js.download"></script>
      <!-- Theme files
         ============================================ -->
      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/application.js.download"></script>
      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/homepage.js.download"></script>
      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/toppanel.js.download"></script>
      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/so_megamenu.js.download"></script>
      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/addtocart.js.download"></script>  
      <?php
         die;
         
         $getCategoryTreeView  = $myCategory->getCategoryTreeView(888888);
         
         ?>
      <!DOCTYPE html>
      <html>
      <head>
      <title></title>
      <link href="https://jonmiles.github.io/bootstrap-treeview/bower_components/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
      <!-- <link href="./css/bootstrap-treeview.css" rel="stylesheet"> -->
      </head>
      <body>
      <div class="container">
      <h1></h1>
      <br>
    
      <br/>
      <br/>
      <br/>
      <br/>
      </div>



      <script src="https://jonmiles.github.io/bootstrap-treeview/bower_components/jquery/dist/jquery.js"></script>
      <script src="https://jonmiles.github.io/bootstrap-treeview/js/bootstrap-treeview.js"></script>
     
      </body>
      </html>

