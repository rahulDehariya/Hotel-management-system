<!-- Footer -->
        <footer id="footer" class="bg-dark dark">
            
            <div class="container">
                <!-- Footer 1st Row -->
                <div class="footer-first-row row">
                    <div class="col-lg-3 text-center">
                        <a href="index.html"><img src="assets/img/logo-light.svg" alt="" width="88" class="mt-5 mb-5"></a>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <h5 class="text-muted">Latest news</h5>
                        <ul class="list-posts">
                            <li>
                                <a href="blog-post.html" class="title">How to create effective webdeisign?</a>
                                <span class="date">February 14, 2015</span>
                            </li>
                            <li>
                                <a href="blog-post.html" class="title">Awesome weekend in Polish mountains!</a>
                                <span class="date">February 14, 2015</span>
                            </li>
                            <li>
                                <a href="blog-post.html" class="title">How to create effective webdeisign?</a>
                                <span class="date">February 14, 2015</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-5 col-md-6">
                        <h5 class="text-muted">Subscribe Us!</h5>
                        <!-- MailChimp Form -->
                        <form action="" id="sign-up-form" class="sign-up-form validate-form mb-3" method="POST">
                            <div class="input-group">
                                <input name="EMAIL" id="mce-EMAIL" type="email" class="form-control" placeholder="Tap your e-mail..." required>
                                <span class="input-group-btn">
                                    <button class="btn btn-primary btn-submit" type="submit">
                                        <span class="description">Subscribe</span>
                                        <span class="success">
                                            <svg x="0px" y="0px" viewBox="0 0 32 32"><path stroke-dasharray="19.79 19.79" stroke-dashoffset="19.79" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="square" stroke-miterlimit="10" d="M9,17l3.9,3.9c0.1,0.1,0.2,0.1,0.3,0L23,11"/></svg>
                                        </span>
                                        <span class="error">Try again...</span>
                                    </button>
                                </span>
                            </div>
                        </form>
                        <h5 class="text-muted mb-3">Social Media</h5>
                        <a href="#" class="icon icon-social icon-circle icon-sm icon-facebook"><i class="fa fa-facebook"></i></a>
                        <a href="#" class="icon icon-social icon-circle icon-sm icon-google"><i class="fa fa-google"></i></a>
                        <a href="#" class="icon icon-social icon-circle icon-sm icon-twitter"><i class="fa fa-twitter"></i></a>
                        <a href="#" class="icon icon-social icon-circle icon-sm icon-youtube"><i class="fa fa-youtube"></i></a>
                        <a href="#" class="icon icon-social icon-circle icon-sm icon-instagram"><i class="fa fa-instagram"></i></a>
                    </div>
                </div>
                <!-- Footer 2nd Row -->
                <div class="footer-second-row">
                    <span class="text-muted">Copyright Soup 2017©. Made with love by Suelo.</span>
                </div>
            </div>

            <!-- Back To Top -->
            <a href="#" id="back-to-top"><i class="ti ti-angle-up"></i></a>

        </footer>
        <!-- Footer / End -->

    </div>
    <!-- Content / End -->

    <!-- Panel Cart -->
    <div id="panel-cart">
        <div class="panel-cart-container">
            <div class="panel-cart-title">
                <h5 class="title">Your Cart</h5>
                <?php 
                $guest_id = $_SESSION['guest_id'];

                $res = file_get_contents("http://hotel.staffstarr.com/ajax.php?action=getCartItems&guest_id=".$guest_id);

                //print_r($res);die;
                $getCartItems = json_decode($res,true);

                //print_r($getCartItems);
                ?>
                <button class="close" data-toggle="panel-cart"><i class="ti ti-close"></i></button>
            </div>
            <div class="panel-cart-content">
                <table class="table-cart" id="cart_data_table">

                    <?php  $i = $total = 0 ; 

                    $total_cart_items = count($getCartItems);

                    ?>
                    <script type="text/javascript">
                        
                        $(".notification").text(<?php echo $total_cart_items;?>);
                    </script>

                    <?php

                            if(count($getCartItems)){

                              foreach ($getCartItems as $CartItems) { 

                                //print_r($CartItems);
                                $cart_details = $CartItems['cart'];
                                $total+=$cart_details['price'];
                                $i++;

                                $extraItemPrice_perItem = 0;
                                $extras = $CartItems['extra'];
                                foreach ($extras as $extra) {
                                  $extraItemPrice_perItem+=$extra['price'];
                                }

                                $is_stock = 1;//$cart_details['stock'];
                                $class_on_stock = "";
                                // if($is_stock == 0)
                                // {
                                //   $class_on_stock = "OutOfStock";
                                // }
                                ?>

                                <script type="text/javascript">
                                    
                                    var invoice_id = '<?php echo $cart_details['invoiceId']; ?>';
                                    $("#invoice_id").val(invoice_id);
                                </script>
                    <tr>
                        <td class="title">
                            <input type="hidden" name="cart_id[]" id="<?php echo $cart_details['id']; ?>" value="<?php echo $cart_details['id']; ?>">

                            <input type="hidden" name="qty[]" id="ContentPlaceHolder1_box_<?php echo $cart_details['id']; ?>" value="<?php echo $cart_details['quantity']; ?>">
                            <input type="hidden" name="perItemPrice[]" id="product_price_per_item_<?php echo $cart_details['id']; ?>" value="<?php echo $cart_details['perItemPrice']; ?>">
                            <input type="hidden" name="extraPerItemPrice[]" id="extras_price_per_item_<?php echo $cart_details['id']; ?>" value="<?php echo $extraItemPrice_perItem; ?>">
                            <input type="hidden" name="is_stock" id="is_stock_<?php echo $i; ?>" value="<?php echo $is_stock; ?>">
                            <input type="hidden" name="" id="cart_id_<?php echo $i; ?>" value="<?php echo $cart_details['id']; ?>">
                            <input type="hidden" name="" class="item_total_price" id="item_total_price<?php echo $i; ?>" value="<?php echo $cart_details['price']; ?>">

                            <span class="name"><?php echo $cart_details['menuName']; ?></span>
                            <span class="caption text-muted"><?php echo $cart_details['itemName']; ?></span>
                        </td>
                        <td class="price">&#8377;<?php echo number_format($cart_details['price'],2); ?></td>
                        <td class="actions" style="<?php echo ($is_stock == 0 ? "display: none;" : "" ); ?> ">
                            <a href="#" class="action-icon" onclick="update_cart_page(<?php echo $cart_details['id']; ?>,0);"><i class="ti ti-close"></i></a>
                        </td>
                        <td class="actions" style="<?php echo ($is_stock == 1 ? "display: none;" : "" ); ?> ">
                            <span style="color:red;">OUT OF STOCK</span>
                        </td>
                    </tr>
                <?php }  } else{ ?>
                              <tr>
                                <td  colspan="3">You don't have anything in your cart</td>
                              </tr>
                           <?php  } ?>

                </table>
                <div class="cart-summary">
                    <div class="row">
                        <input type="hidden" name="row_counter_i" id="row_counter_i" value="<?php echo $i; ?>">
                        <input type="hidden" name="order_total_price" id="total_calculated_price_hidden" class="total_calculated_price_hidden" value="<?php echo $total; ?>">
                        <div class="col-7 text-right text-muted">Order total:</div>
                        <div class="col-5"><strong class="cart_total_amount">&#8377;<?php echo number_format($total,2); ?></strong></div>
                    </div>
                    <div class="row">
                        <div class="col-7 text-right text-muted">Devliery:</div>
                        <div class="col-5"><strong>Free</strong></div>
                    </div>
                    <hr class="hr-sm">
                    <div class="row text-lg">
                        <div class="col-7 text-right text-muted">Total:</div>
                        <div class="col-5"><strong class="cart_total_amount">&#8377;<?php echo number_format($total,2); ?></strong></div>
                    </div>
                </div>
            </div>
        </div>
        <a href="view_cart.php" class="panel-cart-action btn btn-secondary btn-block btn-lg"><span>Go to checkout</span></a>
    </div>

    <!-- Panel Mobile -->
    <nav id="panel-mobile">
        <div class="module module-logo bg-dark dark">
            <a href="#">
                <img src="assets/img/logo-light.svg" alt="" width="88">
            </a>
            <button class="close" data-toggle="panel-mobile"><i class="ti ti-close"></i></button>
        </div>
        <nav class="module module-navigation"></nav>
        <div class="module module-social">
            <h6 class="text-sm mb-3">Follow Us!</h6>
            <a href="#" class="icon icon-social icon-circle icon-sm icon-facebook"><i class="fa fa-facebook"></i></a>
            <a href="#" class="icon icon-social icon-circle icon-sm icon-google"><i class="fa fa-google"></i></a>
            <a href="#" class="icon icon-social icon-circle icon-sm icon-twitter"><i class="fa fa-twitter"></i></a>
            <a href="#" class="icon icon-social icon-circle icon-sm icon-youtube"><i class="fa fa-youtube"></i></a>
            <a href="#" class="icon icon-social icon-circle icon-sm icon-instagram"><i class="fa fa-instagram"></i></a>
        </div>
    </nav>

    <!-- Body Overlay -->
    <div id="body-overlay"></div>

</div>
<script type="text/javascript">
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
          //alert(willDelete);update_cart_page
          if (willDelete) {

            $.post("ajax.php?action=removeCartItems&itemId="+product_id,{},
            function (data) {
              //alert(data);
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

<!-- JS Plugins -->
<script src="assets/plugins/jquery/dist/jquery.min.js"></script>
<script src="assets/plugins/tether/dist/js/tether.min.js"></script>
<script src="assets/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="assets/plugins/slick-carousel/slick/slick.min.js"></script>
<script src="assets/plugins/jquery.appear/jquery.appear.js"></script>
<script src="assets/plugins/jquery.scrollto/jquery.scrollTo.min.js"></script>
<script src="assets/plugins/jquery.localscroll/jquery.localScroll.min.js"></script>
<script src="assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="assets/plugins/jquery.mb.ytplayer/dist/jquery.mb.YTPlayer.min.js"></script>
<script src="assets/plugins/twitter-fetcher/js/twitterFetcher_min.js"></script>
<script src="assets/plugins/skrollr/dist/skrollr.min.js"></script>
<script src="assets/plugins/animsition/dist/js/animsition.min.js"></script>

<!-- JS Core -->
<script src="assets/js/core.js"></script>

<!-- JS Stylewsitcher -->
<script src="styleswitcher/styleswitcher.js"></script>

</body>


<!-- Mirrored from themes.suelo.pl/soup/menu-grid-collapse.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 25 Sep 2019 20:07:36 GMT -->
</html>
