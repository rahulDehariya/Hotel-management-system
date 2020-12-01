<?php 

   require_once "getdata/server_data.php";
 $myCategory = new Category();


 $myCategory->emailToClientOnOrderSubmit($_GET['order_id']);

    require_once "header.php";

 ?>
  <style type="text/css">
  	.backtostore{
  background-color: #ddae71;
    color: white !important;
    padding: 5px;
    text-align: center;
    text-decoration: none;
    margin: 0 auto;
    display: block;
    text-align: center;
    width: 120px;
}
  </style>

<div class="page-title bg-light" >
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 push-lg-4">
                        <!-- <h1 class="mb-0">Menu Grid</h1>
                        <h4 class="text-muted mb-0">Some informations about our restaurant</h4> -->
                       <!--  <h3 class="mb-0">Order has been successfully submitted. We will contact you soon...</h3>
                         <a href="index.php" class="backtostore">Back to store</a>
 -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="">
        	<div class="col-md-12"></div>
        </div>
 <div id="content" class="col-md-12 col-sm-12" style="margin: 15px; padding: 25px;">
                <div class="products-category">
                   <div class="page-width" data-section-id="cart-template" data-section-type="cart-template">

                    
                      <!-- <div class="section-header text-center">
                        <h1>Login</h1>
                      </div> -->
                        <h3 style="text-align: center; color: black;">Order has been successfully submitted. We will contact you soon...</h3>
                        <a href="index.php" class="backtostore">Back to store</a>

                        <!-- <button type="button" class="backtostore" title="Back to store" onclick="window.location.href='index.php';">

                          <span>Back to store</span>

                        </button> -->

                  </div>
                    
                </div>
                
            </div>


  <?php  
Include 'footer.php';

?>