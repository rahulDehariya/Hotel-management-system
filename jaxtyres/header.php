<?php
session_start();

  include_once 'config/config.php';
  
 $HTTP_HOST='http://hotel.staffstarr.com/jaxtyres/';


?>


<!DOCTYPE html>
<!-- saved from url=(0063)http://demo.smartaddons.com/templates/html/autoparts/home2.html -->
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <!-- Basic page needs
         ============================================ -->
      <title>Bro Tyres</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="Magentech">
      <meta name="robots" content="index, follow">
      <!-- Mobile specific metas
         ============================================ -->
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
      <!-- Favicon
         ============================================ -->
      
      <!-- Libs CSS
         ============================================ -->

         <link href="sliderCss/custom.css" rel="stylesheet">
         
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">

      <link rel="stylesheet" href="./Autoparts - Multipurpose Responsive HTML5 Template_files/bootstrap.min.css">
      <link href="./Autoparts - Multipurpose Responsive HTML5 Template_files/font-awesome.min.css" rel="stylesheet">
      <link href="./Autoparts - Multipurpose Responsive HTML5 Template_files/bootstrap-datetimepicker.min.css" rel="stylesheet">
      <link href="./Autoparts - Multipurpose Responsive HTML5 Template_files/owl.carousel.css" rel="stylesheet">
      <link href="./Autoparts - Multipurpose Responsive HTML5 Template_files/lib.css" rel="stylesheet">
      <link href="./Autoparts - Multipurpose Responsive HTML5 Template_files/jquery-ui.min.css" rel="stylesheet">
      <link href="./Autoparts - Multipurpose Responsive HTML5 Template_files/miniColors.css" rel="stylesheet">
      <link href="./Autoparts - Multipurpose Responsive HTML5 Template_files/pe-icon-7-stroke.css" rel="stylesheet">
      <link href="./Autoparts - Multipurpose Responsive HTML5 Template_files/helper.css" rel="stylesheet">
      <!-- Theme CSS
         ============================================ -->
      <link href="./Autoparts - Multipurpose Responsive HTML5 Template_files/so_searchpro.css" rel="stylesheet">
      <link href="./Autoparts - Multipurpose Responsive HTML5 Template_files/so_megamenu.css" rel="stylesheet">
      <link href="./Autoparts - Multipurpose Responsive HTML5 Template_files/so-categories.css" rel="stylesheet">
      <link href="./Autoparts - Multipurpose Responsive HTML5 Template_files/so-listing-tabs.css" rel="stylesheet">
      <link href="./Autoparts - Multipurpose Responsive HTML5 Template_files/so-category-slider.css" rel="stylesheet">
      <link href="./Autoparts - Multipurpose Responsive HTML5 Template_files/so-newletter-popup.css" rel="stylesheet">
      <link href="./Autoparts - Multipurpose Responsive HTML5 Template_files/footer2.css" rel="stylesheet">
      <link href="./Autoparts - Multipurpose Responsive HTML5 Template_files/header2.css?var=1" rel="stylesheet">
      <link id="color_scheme" href="./Autoparts - Multipurpose Responsive HTML5 Template_files/home2.css" rel="stylesheet">
      <link href="./Autoparts - Multipurpose Responsive HTML5 Template_files/responsive.css" rel="stylesheet">
      <!-- Google web fonts
         ============================================ -->
      <link href="./Autoparts - Multipurpose Responsive HTML5 Template_files/css" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/css?family=Fjalla+One|Grenze|Roboto+Condensed&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>
      <style type="text/css">
        
           .header-bottom{
            width: 100%;
            float: left;
            height: 100% !important;
            background: none !important;
          }

          /*body {
            width: 100%;
            float: left;
           position: relative;
           min-height: 100%;
          }

          #wrapper{
            width: 100%;
            float: left;
          }
          .footer-classic {
           position: absolute;
           right: 0;
           bottom: 0;
           left: 0;
          }*/

          tbody td {
            text-align: center;
          }


          body {
              position: relative;
              min-height: 100vh;
              padding-bottom: 100px;
            }

            #wrapper {
              padding-bottom: 3.5rem;    /* Footer height */
              margin-bottom: 30px;
              width: 100%;
              float: left;
            }

            .footer-classic {
              position: absolute;
              bottom: 0;
              width: 100%;
              height: auto;  
              margin-top: 30px;
            }

            .typeheader-2 .header-top {
                font-size: 16px;
            }

            .typeheader-2 ul.top-link > li .btn-group .btn-link {
                color: #222222;
            }

            #header{
              /*background-image: linear-gradient(to bottom, rgba(250, 250, 251, 0.48), rgba(28, 28, 28, 0.72)),url(assets/used-car-parts-Perth.jpg);*/
              /*background-image: linear-gradient(to bottom, rgba(250, 250, 251, 0.48), rgba(28, 28, 28, 0.72)),url(https://www.jaxtyres.com.au/globalassets/products/product-promotions/instore-promotions/jax_new_ecomm_header-desktop_1920_x_710px_wow_nov19v2.jpg);*/
              background-image: url(https://www.jaxtyres.com.au/globalassets/products/product-promotions/instore-promotions/jax_new_ecomm_header-desktop_1920_x_710px_wow_nov19v2.jpg);
              background-position: top center;
              background-size: cover;
              background-repeat: no-repeat;
                  min-height: 335px;
              
            }

            .nav-tabs>li>a {
                color: #5f625e;
            }


            .header-bottom {
              margin-top: 15px;
            }
            .typeheader-2 .header-top {
                background-color: transparent;
            }

            .shopping_cart .btn-shopping-cart .shopcart-inner  {
                /*color: #ccc !important;*/
            }
            .typeheader-2 .shopping_cart .btn-shopping-cart .top_cart .icon-c i  {
                /*color: #ccc !important;*/
            }

            .fa-lock{
              color:#222;
            }

            @media (max-width: 767px){
              header.typeheader-2 .middle-right {
                   background-color: transparent;
              }
            }

            .navbar-inverse .navbar-nav>li>a {
                color: #fff;
            }
            .navbar-inverse .navbar-brand {
                color: #fff;
            }



      </style>

   </head>
   <body class="common-home res layout-2 loaded hidden-scorll">
      <div id="wrapper" class="wrapper-fluid banners-effect-8">
      <!-- Header Container  -->
      <header id="header" class=" typeheader-2" >
        <div class="header-top hidden-compact"> 
            <div class="container">
                <div class="row">
                    <div class="header-top-left col-lg-3 col-md-4 col-sm-5 " style="font-size: 26px;    color: #ff2d37;"> 

                        

                        <div class="logo">

                            <a href="index.php"><p style="margin-bottom: 0;padding-top: 6px;    color: #ff2d37;font-family: 'Grenze', serif;">Bro Tyres</p></a>

                        </div>

                        <div class="telephone " style="display: none;">

                            <ul class="socials">

                                <li class="facebook"><a href="https://www.facebook.com/smartaddons.page" target="_blank"><i class="fa fa-facebook"></i></a></li>

                                <li class="twitter"><a href="https://twitter.com/smartaddons" target="_blank"><i class="fa fa-twitter"></i></a></li>

                                <li class="google_plus"><a href="https://plus.google.com/u/0/+Smartaddons/posts" target="_blank"><i class="fa fa-google-plus"></i></a></li>

                                <li class="pinterest"><a href="https://www.pinterest.com/smartaddons/" target="_blank"><i class="fa fa-pinterest-p"></i></a></li>

                                <li class="instagram"><a href="#" target="_blank"><i class="fa fa-instagram"></i></a></li>

                                <li class="linkedin"><a href="#" target="_blank"><i class="fa fa-linkedin"></i></a></li>

                            </ul>

                        </div>             

                        

                        

                    </div>
                    <div class="header-top-right col-lg-9 col-md-8 col-sm-7 col-xs-12">
                        <ul class="top-link list-inline lang-curr" style="display: none;">
                            <li class="currency">
                                <div class="btn-group currencies-block">
                                    <form action="index.html" method="post" enctype="multipart/form-data" id="currency">
                                        <a class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                                            <span class="icon icon-credit "></span> $ US Dollar  <span class="fa fa-angle-down"></span>
                                        </a>
                                        <ul class="dropdown-menu btn-xs">
                                            <li> <a href="#">(€)&nbsp;Euro</a></li>
                                            <li> <a href="#">(£)&nbsp;Pounds    </a></li>
                                            <li> <a href="#">($)&nbsp;US Dollar </a></li>
                                        </ul>
                                    </form>
                                </div>
                            </li>   
                            <li class="language">
                                <div class="btn-group languages-block ">
                                    <form action="index.html" method="post" enctype="multipart/form-data" id="bt-language">
                                        <!-- <a class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                                            <img src="image/catalog/flags/gb.png" alt="English" title="English">
                                            <span class="eng">English</span>
                                            <span class="fa fa-angle-down"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="index.html"><img class="image_flag" src="image/catalog/flags/gb.png" alt="English" title="English"> English </a></li>
                                            <li> <a href="html_with_RTL/index.html"> <img class="image_flag" src="image/catalog/flags/ar.png" alt="Arabic" title="Arabic"> Arabic </a> </li>
                                        </ul> -->
                                    </form>
                                </div>
                                
                            </li>
                        </ul>
                        <!-- <ul class="top-log list-inline"> -->
                          <ul class="top-link list-inline lang-curr" style="/* display: none; */">
                           <?php  

                           if(isset($_SESSION['user_id']))
                                    {
                                       ?>

                                       
                                        <li class="currency">
                                            <div class="btn-group currencies-block">
                                                
                                                    <a class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                                                         <?php echo 'Hello '.$_SESSION["username"]; ?>  <span class="fa fa-angle-down"></span>
                                                    </a>
                                                    <ul class="dropdown-menu btn-xs">
                                                        <li><a href="my_profile.php"> My Profile </a></li>
                                                        <li><a href="my_orders.php"> My Orders </a></li>
                                                        <li><a href="change_password.php"> Change Password </a></li>
                                                        <li> <a href="logout.php">  Logout </a> </li>
                                                    </ul>
                                                
                                            </div>
                                        </li>   
                                        
                                    <!-- 

                                       <a class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                                            <span class="eng"><?php echo 'Deepika';//$_SESSION["username"]; ?></span>
                                            <span class="fa fa-angle-down"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="index.html"> Change Password </a></li>
                                            <li> <a href="html_with_RTL/index.html">  Logout </a> </li>
                                        </ul>

 -->
                                       <!-- <li><a href="logout.php">Logout</a> </li> -->
                                       <?php 
                                    }else{
                                    ?>
                          
                            <li><i class="fa fa-lock"></i><a href="login.php">Login</a>  </li> <li><a href="login.php">Register</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>      
        </div>

        <div class="header-middle hidden-compact" >

            <div class="container" >

                <div class="row">

                    <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">

                    </div>

                    <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 middle-right">

                        <div class="search-header-w" style="display: none;">

                            <!-- <div class="icon-search hidden-lg hidden-md"><i class="fa fa-search"></i></div> -->

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

                                                <option value="76">&nbsp;
                                                      &nbsp;
                                                      &nbsp;
                                                      &nbsp;
                                                      &nbsp;
                                                      &nbsp;
                                                      Earings</option>

                                                                                                      <option value="26">&nbsp;
                                                      &nbsp;
                                                      &nbsp;
                                                      &nbsp;
                                                      &nbsp;
                                                      &nbsp;
                                                      Wedding Rings</option>

                                                                                                      <option value="27">&nbsp;
                                                      &nbsp;
                                                      &nbsp;
                                                      &nbsp;
                                                      &nbsp;
                                                      &nbsp;
                                                      Men Watches</option>

                                            </select>

                                        </div>

                                       <input class="autosearch-input form-control" type="text" value="" size="50" autocomplete="off" placeholder="Keyword here..." name="search">

                                       <button type="submit" class="button-search btn btn-primary" name="submit_search"><i class="fa fa-search"></i></button>

                                   </div>

                                    <input type="hidden" name="route" value="product/search">

                                </form>

                            </div>

                        </div>

                       <div class="shopping_cart">

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



                                           <!-- <span class="total-shopping-cart cart-total-full">

                                            <span class="items_cart">02</span><span class="items_cart2"> item(s)</span><span class="items_carts">$162.00</span>

                                            </span> -->

                                        </div>

                                    </div>

                                </a>


                            </div>

                            <script type="text/javascript">

                               $.post("ajax_autopart.php?action=getCartItems",{},

                                  function (data1) {

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

                       <div class="wishlist hidden-md hidden-sm hidden-xs" style="display: none;"><a href="#" id="wishlist-total" class="top-link-wishlist" title="Wish List (0) "><i class="fa fa-heart"></i></a></div>

                   </div>

                </div>

                  <div class="row"> <div class="col-md-12"> &nbsp;</div></div>
                  <div class="row"> <div class="col-md-12"> &nbsp;</div></div>
                  <div class="row"> <div class="col-md-12"> &nbsp;</div></div>
                  <div class="row"> <div class="col-md-12"> &nbsp;</div></div>
                  <div class="row"> <div class="col-md-12"> &nbsp;</div></div>
                  <div class="row"> <div class="col-md-12"> &nbsp;</div></div>

                 
            </div>



        </div>
      </header>
        