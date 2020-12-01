<?php
   require_once "getdata/autopart_data.php";
   
   $myCategory = new Category();
   
   $data_Cat = $myCategory->poliPaymentCancelled(accNum,$_GET); 

    require_once "header.php";
   ?>


      

<style type="text/css">

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
h2 {
    display: block;
    font-size: 1.5em;
    margin-block-start: 0.83em;
    margin-block-end: 0.83em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    font-weight: bold;
}

.backtostore{
  background-color: #f44336;
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

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


 
        <div class="header-middle hidden-compact">
            <div class="container">
                <div class="row">           
                    <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                        
                        
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 middle-right">
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
          <div class="col-md-3 col-sm-2"></div>
        
            <div id="content" class="col-md-12 col-sm-12" style="padding: 15px;border: 1px solid #ddd;">
                <div class="products-category">
                   <div class="page-width" data-section-id="cart-template" data-section-type="cart-template">

                    
                      <!-- <div class="section-header text-center">
                        <h1>Login</h1>
                      </div> -->
                        <h2 style="text-align: center; color: red;">Order Cancelled...</h2>

                        <div class="col-md-12">
                        <div class="col-md-6">
                        <a href="polipayment.php?order_id=<?php echo $_GET['order_id']; ?>&amount=<?php echo $_GET['amount']; ?>" class="backtostore" style="float: right;">Try Again</a>
                      </div>
                        <div class="col-md-6">
                        <a href="index.php" class="backtostore" style="float: left;">Back to store</a>
                      </div>
                      </div>

                        <!-- <button type="button" class="backtostore" title="Back to store" onclick="window.location.href='index.php';">

                          <span>Back to store</span>

                        </button> -->

                  </div>
                    
                </div>
                
            </div>

            <div class="col-md-3 col-sm-2"></div>
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

