<?php
   require_once "header.php";

   // require_once "getdata/data.php";
   // $myCategory = new Category();


    $guest_id = $_SESSION['guest_id'];

    $is_guest =0;

   if(!isset($_SESSION['user_id']) || $_SESSION['user_id'] == 0)
    {
      $is_guest = 1;
     // $guest_id = getGuestId($token);
    }
  else
    {
      $is_guest = 0;
      $guest_id = $_SESSION['user_id'];
    }
    // echo("http://hotel.staffstarr.com/ajax.php?action=getCartItems"); die;
    $res = file_get_contents(HTTP_HOST."ajax.php?action=getCartItemsofuserGrocers&user_id=$guest_id&guest_id=$guest_id&is_guest=$is_guest");
    $res_arr = json_decode($res,true);

    $getCartItems = $res_arr; //$myCategory->getCartItems(accNum,$guest_id);

    // print_r($getCartItems);

    $address = $user_details = array();
    $clientName = "";
    $email = "";
    $mobile = "";

    //echo $_SESSION['user_id'];
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];

        $user_json = file_get_contents(HTTP_HOST."ajax.php?action=getUserDetails&user_id=".$user_id);
        $user_address_json = file_get_contents(HTTP_HOST."ajax.php?action=getUserAddress&user_id=".$user_id);

        $getUserDetails = json_decode($user_json, true); //$myCategory->getUserDetails(accNum,$user_id);
        $getUserAddress = json_decode($user_address_json, true); // $myCategory->getUserAddress($user_id);

        // print_r($getUserDetails);die;
        $address = $getUserAddress;
        $clientName = $getUserDetails['username'];
        $email = $getUserDetails['email'];
        $mobile=$getUserDetails['mobile'];
        $user_details =  $getUserDetails;
    }


    //$_SESSION['accNum1'] = accNum;
   
   ?>


<style type="text/css">

body{
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
    .OutOfStock{
      opacity: 0.5;
    }

    .cancel{
      display: inline-block !important;
    }

</style>

  <!-- Content -->
    <div id="content">

        <!-- Page Title -->
        <div class="page-title bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 push-lg-4">
                        <!-- <h1 class="mb-0">Menu Grid</h1>
                        <h4 class="text-muted mb-0">Some informations about our restaurant</h4> -->
                        <h1 class="mb-0">Cart Items</h1>

                    </div>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="page-content">
            <div class="container">
                <div class="row no-gutters">
                  <div class="col-12 mt-20 mb-20" id="replace_class_mt20" style="padding-right: 20px;">
                    <form enctype="multipart/form-data" method="post" action="javascript:void(0);"  class="cart" id="cart_block">
                      <div class="table-responsive">
                          <table class="table table-bordered" style="border: 1px solid #ddd;">
                            <thead>
                              <tr>
                                <td class="text-left">Product Name</td>
                                <td class="text-left">Quantity</td>
                                <td class="text-right">Total</td>
                                <input type="hidden" id= "row_counter" value="<?php echo count($getCartItems);?>">
                              </tr>
                            </thead>
                            <tbody>
                             <?php 
                                 $i=0;
                                 $invoice_id = $getCartItems[0]['cart']['invoiceId'];
                                 $total_gst = 0.00;
                                 $total_subtotal = 0.00;
                                 $grand_total = 0.00;
                            
                            for($i;$i<count($getCartItems);$i++){
                                 $cart_details = $getCartItems[$i]['cart'];
                                 $total_gst = $total_gst+$getCartItems[$i]['cart']['unit_gst'];
                                 $total_subtotal = $total_subtotal+$getCartItems[$i]['cart']['subtotal'];

                                 $item_img = $getCartItems[$i]['cart']['image'];
                             ?>
                              <tr id="remove_row_<?php echo $getCartItems[$i]['cart']['id'] ?>">

                                       <input type="hidden" name="cart_id[]" id="<?php echo $cart_details['id']; ?>" value="<?php echo $cart_details['id']; ?>">
                                       <input type="hidden" name="qty[]" id="ContentPlaceHolder1_box_<?php echo $cart_details['id']; ?>" value="<?php echo $cart_details['quantity']; ?>">
                                      <input type="hidden" name="perItemPrice[]" id="product_price_per_item_<?php echo $cart_details['id']; ?>" value="<?php echo $cart_details['perItemPrice']; ?>">
                                      <input type="hidden" name="extraPerItemPrice[]" id="extras_price_per_item_<?php echo $cart_details['id']; ?>" value="<?php echo $extraItemPrice_perItem; ?>">
                                      <input type="hidden" name="is_stock" id="is_stock_<?php echo $i; ?>" value="<?php echo $is_stock; ?>">
                                      <input type="hidden" name="" id="cart_id_<?php echo $i; ?>" value="<?php echo $cart_details['id']; ?>">
                                <td class="text-left"><a ><div class="col-sm-12 col-md-2" style="display: inline;"><img style="height: 45px;" src="<?php echo (!empty($item_img)  ? $item_img : ''); ?>" alt="item" title="item" onerror="err_function(this)"></div>
                                  <?php echo $getCartItems[$i]['cart']['product'] ?> - <?php echo $getCartItems[$i]['cart']['itemName'] ?></a></td>
                                <td class="text-left">
                                  <div style="max-width: 200px;" class="input-group btn-block quantity_div_td">
                                    <input type="text" class="form-control quantity" size="1" value="<?php echo $getCartItems[$i]['cart']['qty'] ?>" name="quantity" readonly>
                                    <span class="input-group-btn">
                                      <button class=" form-control" title="" data-toggle="tooltip" type="button" data-original-title="Remove" onclick="update_cart_page(<?php echo $getCartItems[$i]['cart']['id'] ?>,0);">
                                         <i class="fa fa-times-circle"></i>
                                      </button>
                                    </span>
                                </div>
                                </td>
                                <td class="text-right">$<?php echo $getCartItems[$i]['cart']['subtotal']; ?></td>
                              </tr>

                             
                          <?php } 

                          if($total_subtotal > 0)
                          {
                            $total_subtotal_new= $total_subtotal/1.1;
                            $total_gst = number_format(($total_subtotal-$total_subtotal_new),2);
                            $total_subtotal = number_format($total_subtotal_new,2);
                          }
                          $grand_total=$total_subtotal+$total_gst;
                          ?>
                         

                            </tbody>
                          </table>
                        </div>
                     

                        <div class="row">
                          <div class="col-md-6 offset-md-6">
                            <table class="table table-bordered">
                              <tbody class="express_delivery_charges">
                                <tr style="display: none;">
                                  <!-- <td class="text-right"><strong>Sub-Total:</strong></td> -->
                                  <!-- <td class="text-right">$<?php echo $total_subtotal ?></td> -->
                                </tr>
                                <tr>
                                    <input type="hidden" name="row_counter_i" id="row_counter_i" value="<?php echo $i; ?>">
                                    <input type="hidden" name="order_total_price" id="total_calculated_price_hidden" class="total_calculated_price_hidden" value="<?php echo $total_subtotal; ?>">
                                    <input type="hidden" name="order_offr_price" id="total_offer_price_hidden" class="total_offer_price_hidden" value="<?php echo $grand_total; ?>">
                                    <input type="hidden" name="total_item_price_hidden" id="total_item_price_hidden" class="total_item_price_hidden" value="<?php echo $grand_total; ?>">
                                    <input type="hidden" name="order_offr_minus" id="total_offer_minus" class="total_offer_minus_price" value="<?php echo 0 ?>">
                                    <td class="text-right grand_total_show"><strong>Total(all included):</strong></td>
                                  <td class="text-right grand_total_show" id="grand_total_payment">$<?php echo $grand_total ?></td>
                                </tr>
                               <!--


                                 <tr>
                                  <td class="text-right"><strong>VAT (0%):</strong></td>
                                  <td class="text-right">$00.00</td>
                                </tr> -->
                                <tr >
                                  
                                  <td class="text-right"><strong>GST Included:</strong></td>
                                  <td class="text-right">$<?php echo $total_gst ?></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>

                           <!-- <div class="row"> -->
                        <div class="row" style="float: right;">
                            <input type="hidden" name="country" id="country" value="">
                            <input type="hidden" name="city" id="locality" value="">
                            <input type="hidden" name="state" id="administrative_area_level_1" value="">
                            <input type="hidden" name="zip" id="postal_code" value="">
                            <input type="hidden" name="lat" id="hidden_lat" value="">
                            <input type="hidden" name="long" id="hidden_long" value="">
                            <input type="hidden" name="street_number" id="street_number" value="">
                            <input type="hidden" name="route" id="route" value="">
                            <input type="hidden" name="recent_delivery_address" id="hidden_recent_delivery_address" value="">
                            <input type="hidden" name="invoice_id" id="invoice_id" value="<?php echo $invoice_id; ?>">

                            <input type="hidden" name="delivery_type" id="delivery_type_input" value="1">
                            <input type="hidden" name="paymentType" id="paymentType" value="1">
                             <input type="hidden" name="expressDeliveryCharges" id="expressDeliveryCharges" value="0">

                            <input  type="hidden" name="clientName" id="clientName" readonly="" value="<?php echo $user_details?$user_details['username']:'' ?>" >
                            <input   type="hidden" name="email" id="email"  value="<?php echo $user_details?$user_details['email']:'' ?>" >

                            <input type="hidden" name="address" id="address__1" >
                            <input type="hidden" name="select_address" id="select_address__1" >
                            <input  type="hidden" name="mobile" id="mobile" value="<?php echo $user_details?$user_details['mobile']:'' ?>" required>
                        

                        <?php if($_SESSION['user_id'] && $_SESSION['user_id']>0){ ?>

                                <!-- <a href="category.php" class="btn pull-left mt_30" style="margin-right: 5px">Continue Shopping</a> -->
                                <!-- <a href="javascript:void(0);" class="btn pull-right mt_30" onclick="cart_confirmed()">Checkout</a> -->
                                <!-- <a href="javascript:void(0);" class="btn pull-right mt_30" data-toggle="modal" data-target="#checkout_modal" onclick="checkOutFunction()">Checkout</a> -->
                                <!-- <a href="javascript:void(0);" class="btn pull-right mt_30" onclick="checkOutFunction()">Checkout</a> -->
                                
                        <?php }else{ ?>
                          <a href="javascript:void(0);" class="btn pull-right mt_30" data-toggle="modal" data-target="#login_register_modal"  >Login/Register</a>
                       <?php } ?>
                      </div>
                    </form>
                  </div>

<?php if($_SESSION['user_id']){ ?>

  <style>
     .card-header,.collapseClass,.card-body
     {
       padding:2px 5px 2px 5px; 
     }
     #accordion h4
     {
      font-size: 14px;
      padding: 10px;
     }
     #accordion label
     {
       font-size: 13px;
     }
     .align-items-center

  </style>

        <div class="col-lg-6 mt-20 mb-20" style="padding-right: 20px;">
          <form action="" id="form_checkpout">
            <div id="accordion">
              <div class="card my-1" style="margin-top: 0 !important;">
                <div class="card-header" id="headingOne">
                  <h4 class="mb-0">
                    <a data-toggle="" data-parent="#accordion" href="javascript:void(0)" aria-expanded="true" class="">User Details <i class="fa fa-caret-down"></i></a>
                  </h4>
                </div>

                <div id="collapseOne" class="collapseClass show" aria-labelledby="headingOne" data-parent="#accordion" style="">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <label for="input-coupon" class="col-sm-4 control-label">Name</label>
                      <label for="input-coupon" class="col-sm-8 control-label"><?php echo (isset($user_details['username']) ? $user_details['username']:''); ?></label>
                      
                    </div>
                    <div class="row align-items-center">
                      <label for="input-coupon" class="col-sm-4 control-label">Email</label>
                      <label for="input-coupon" class="col-sm-8 control-label"><?php echo (isset($user_details['email']) ? $user_details['email']:''); ?></label>
                    </div>
                    <div class="row align-items-center">
                      <label for="input-coupon" class="col-sm-4 control-label">Phone</label>
                      <label for="input-coupon" class="col-sm-8 control-label"><?php echo (isset($user_details['mobile']) ? $user_details['mobile']:''); ?></label>
                    </div>
                  </div>
                </div>
              </div>
              <!-- <div class="card my-1">
                <div class="card-header" id="headingTwo">
                  <h4 class="mb-0">
                    <a data-toggle="collapse" data-parent="#accordion" >Amount <i id="total_pay_amt">$ 0.00</i></a>
                  </h4>
                </div>
              </div> -->
              <div class="card my-1">
                <div class="card-header" id="headingFour">
                  <h4 class="mb-0">
                    <a data-toggle="" data-parent="#accordion" href="javascript:void(0)" class="collapsed" aria-expanded="false">Delivery <i class="fa fa-caret-down"> </i> <i id="delivery_type_selected" style="padding-right: 10px;">Normal</i></a>
                  </h4>
                </div>
                <div id="collapseFour" class="collapseClass" aria-labelledby="headingFour" data-parent="#accordion" style="">
                  <div class="card-body">
                    <div class="align-items-center">
                      <div class="form-group required row">
                        <div class="col-sm-12">
                          <label for="input-country" class="col-sm-4 control-label"><input type="radio" id="delivery_type_1"  name="delivery_type" value="1" checked> Normal</label>
                          <label for="input-country" class="col-sm-4 control-label"><input type="radio" id="delivery_type_2"  name="delivery_type" value="2" > Express</label>
                          <label for="input-country" class="col-sm-4 control-label"><input type="radio" id="delivery_type_3"  name="delivery_type" value="3"> Pick up</label>
                          
                        </div>
                      </div> 
                      <p style="color: red;display: none" class="delivery_type_express">Express delivery charges : $5.00</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card my-1" id="address_div">
                <div class="card-header" id="headingThree">
                  <h4 class="mb-0">
                    <a data-toggle="" data-parent="#accordion" href="javascript:void(0)" class="collapsed" aria-expanded="false">Address <i class="fa fa-caret-down"></i></a>
                  </h4>
                </div>
                <div id="collapseThree" class="collapseClass" aria-labelledby="headingThree" data-parent="#accordion" style="">
                  <div class="card-body">
                    <div class="align-items-center">
                    <?php if(count($address) > 0){ ?>
                
                      <div class="form-group col-12" style="padding-right: 0;padding-left: 0;margin-bottom: 0;">
                        <div class="col-md-12">
                          <label for="Description" >Select From address:</label> 
                        </div>
                        <div class="col-md-12">
                          <select  class="form-control" name="select_address" id="select_address" onchange="selected_address();">
                            <option value="">SELECT</option>
                            <?php 
                            if($address){
                            $p = 0;
                            foreach($address as $single_address){ 
                              $p++; 
                              ?>
                              <option value="<?php echo $single_address['id'];?>" <?php echo($p == 1 ? "Selected" : "");?>> <?php echo $single_address['address'] ;?> </option>
                            <?php } } ?>
                          </select>
                        </div>
                      </div>
                      <p style="padding-left: 10px;margin:5px 0 0 0;"> OR </p>
                    <?php } ?>
                      <div class="col-md-12 form-group" style="padding-right: 0;padding-left: 0;margin-bottom: 0;">
                        <div class="col-md-12">
                          <label for="Description" >Enter New Delivery Address:</label> 
                        </div>

                        <div class="col-md-12" style="margin-bottom:0px;">
                          <textarea style="min-height:50px;" class="form-control" rows="1" onchange="entered_address()"  name="address" id="enter_address" placeholder="Enter your address" onFocus="geolocate()"></textarea>
                          <p id = "address_err" style="display: none; color: red;">Please enter Delivery Address</p>
                        
                        </div>
                      </div> 
                  </div>
                  </div>
                </div>
              </div>
              <div class="card my-1" style="display: block;">
                <div class="card-header" id="headingFive">
                  <h4 class="mb-0">
                    <!-- <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive" class="" aria-expanded="true">Payment Type<i class="fa fa-caret-down"></i></a> -->
                    <a data-toggle="" data-parent="#accordion" href="#" class="" aria-expanded="true">Payment Type</a>
                  </h4>
                </div>
                <div id="" class=" show" aria-labelledby="headingFive" data-parent="" style="">
                  <div class="card-body">
                    <div class="align-items-center" style="padding: 15px;">
                      <input type="button" class="btn btn-default d-none" id="button-quote" onclick="cart_confirmed(2)" value="Card Payment">
                      <input type="button" class="btn btn-default " id="button-quote" value="Cash On Delivery" onclick="cart_confirmed(1)">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>

        <!-- <div id="payment_form" class="col-12" style="display: none;">
          <iframe src="https://www.payment.starr365.com/eWay/ePayment/secureform2.php?url=rajspices.com.au?i=23&token=2_61P_fmTZD8i94gM1JP_Qf2T73j3Xmh5EXIvYyaojXaYY45W1lHim84W3WZbZUngxVbihjq6QswnJRWR7EuFdQOt7jOeteNn4b6g2RZfRiPJfEOaPFOMVXIP7EgLGJx_J4j9Xq3KTDQr-3bxqKVFCsIGwI4cpHowLSX1p9YscuzK3RSgFMLvGciRahKCuqK36qRHz7cdnZTZwMmwMUTYQ" width="100%" height="500px;" id="payment_iframe" style="border: none;"></iframe>
        </div> -->

    <script>
     $("#replace_class_mt20").removeClass('col-12').addClass(' col-lg-6');
       // var grand=$("#grand_total_payment").text();
       // $("#total_pay_amt").text(grand);
  </script>
<?php } ?>
                </div>
                <a href="category.php" class="btn btn-primary pull-left mt_30" style="margin-right: 5px">Continue Shopping</a>
            </div>
        </div>
</div>

<?php
  if($expressDel){ ?>

    <script>
       $('#delivery_type_2').prop('checked','true')
       $("#delivery_type_selected").text('Express');
       $("#address_div").show();
       $("#delivery_type_input").val(2);
       $(".express_delivery_charges").append('<tr class="ex_del_charge"><td class="text-right"><strong>Express Delivery Charges Included:</strong></td><td class="text-right">$5.00</td></tr>');
       $(".delivery_type_express").show();
       $("#expressDeliveryCharges").val(5);


      ex_del_charge = $("#expressDeliveryCharges").val();
      item_price = $("#total_item_price_hidden").val();
      total_amount = Number(ex_del_charge)+Number(item_price);
      $("#total_offer_price_hidden").val(total_amount);
      $("#grand_total_payment").text("$"+total_amount);
       
       
    </script>
<?php
  }
?>

<!-- end -->

      <!-- Footer Container -->

      <?php Include 'footer.php'; ?>
      <!-- //end Footer Container -->

      <script type="text/javascript">
  function checkOutFunction()
  {
    var cart_items = $("#row_counter").val();
    if(cart_items == 0 || cart_items == ''){
      swal("Warning", "You have empty cart!", "warning");
      return false;
    }
    // else
    // {
    //    $('#checkout_modal').modal('show');
    // }
      var gt=$("#grand_total_payment").text();
      $("#total_pay_amt").text(gt);


  }

 
    $('input[name="delivery_type"]').change(function(){
        if($('#delivery_type_1').prop('checked'))
        {
             $("#delivery_type_selected").text('Normal');
             $("#address_div").show();
             $("#delivery_type_input").val(1);
             $(".ex_del_charge").remove();
             $(".delivery_type_express").hide();
             $("#expressDeliveryCharges").val('0')

        }
        else if($('#delivery_type_2').prop('checked'))
        {
             $("#delivery_type_selected").text('Express');
             $("#address_div").show();
             $("#delivery_type_input").val(2);
             $(".express_delivery_charges").append('<tr class="ex_del_charge"><td class="text-right"><strong>Express Delivery Charges Included:</strong></td><td class="text-right">$5.00</td></tr>');
             $(".delivery_type_express").show();
             $("#expressDeliveryCharges").val(5);
        }
        else if($('#delivery_type_3').prop('checked'))
        {
           $("#delivery_type_selected").text('Pickup');
           $("#address_div").hide();
           $("#delivery_type_input").val(3);
           $(".ex_del_charge").remove();
           $(".delivery_type_express").hide();
           $("#expressDeliveryCharges").val('0')

        }
        retotaling_amount();
    });

    // function card_payment(){
    //   $("#payment_form").show();
    // }

    function retotaling_amount(){
      ex_del_charge = $("#expressDeliveryCharges").val();
      item_price = $("#total_item_price_hidden").val();
      total_amount = Number(ex_del_charge)+Number(item_price);
      $("#total_offer_price_hidden").val(total_amount);
      $("#grand_total_payment").text("$"+total_amount);

      // $("#payment_iframe").attr("src","");

      // $.ajax({
      //     type: 'POST',
      //     url: 'ajax.php?action=getPaymentUrl',
      //     data: {},
      //     success: function (response) {
      //     }
      //   });

    }

    selected_address();
    function selected_address()
    {
      var select_address = $("#select_address").val();
      // alert("select_address");
      if(select_address != "")
      {
        $("#enter_address").val("");
        $("#select_address__1").val(select_address);
        $("#address__1").val("");
      }
    }
    // function entered_address()
    // {
    //   alert($("#entered_address").val());
    //   //alert("inn");
    //   $("#select_address").val("");
    //   $("#select_address__1").val("");
    //   $("#address__1").val($("textarea#entered_address").val());
    // }

    //   function entered_address()
    // {
    //   var enter_add=$("textarea#enter_address").val();
    //   if(enter_add !="")
    //   {
    //    $("#select_address").val("");
    //     $("#select_address__1").val("");
    //     $("#address__1").val(enter_add);
    //   }    
      
    // }

     $("#enter_address").mouseleave(function(){
      var enter_address = $("textarea#enter_address").val();
      if(enter_address != "")
      {
        $("#select_address").val("");
        $("#select_address__1").val("");
        $("#address__1").val(enter_address);
      } 
     });

 // function delivery_type_changed(){
 //    // var delivery_type = $("input[name='delivery_type']:checked").val();
   
 //    // if(delivery_type == 3)
 //    // {
 //    //   $("#address_div").hide();
 //    // }else{
 //    //   $("#address_div").show();
 //    // }

 //    var delivery_type = $(this).val();
 //    alert(delivery_type);
 //    if(delivery_type == 1)
 //    {
 //      $("#delivery_type_selected").text('');
 //      $("#address_div").show();
 //    }
 //    else if(delivery_type == 2)
 //    {
 //        $("#delivery_type_selected").text('');
 //        $("#address_div").show();
 //    }
 //    else if(delivery_type == 3)
 //    {
 //         $("#delivery_type_selected").text('');
 //         $("#address_div").hide();
 //    }
    
 //  }
    

    function loginRegister(check)
    {
        if(check == 'login')
        {

           $("#login_form_checkpout").css({"display":"block"});
           $("#register_form_checkpout").css({"display":"none"});
           $("#otp_form_checkpout").css({"display":"none"});

            $(".active_deactive_regtab").removeClass("active");
            $('.active_deactive_logtab').addClass(" active");        
            // $('#login_register_modal').modal('show');
            // $('#login_form_checkpout').show();
            // $('#register_form_checkpout').hide();
            // $('#otp_form_checkpout').hide();
            // $('.reg_login_title').text('Login');
        
        }
        else if(check == 'register')
        {
          $("#login_form_checkpout").css({"display":"none"});
          $("#register_form_checkpout").css({"display":"block"});
          $("#otp_form_checkpout").css({"display":"none"});
          $(".active_deactive_logtab").removeClass("active");
          $('.active_deactive_regtab').addClass(" active");        
          // $('#login_register_modal').modal('show');
          // $('#login_form_checkpout').hide();
          // $('#register_form_checkpout').show();
          // $('#otp_form_checkpout').hide();
          // $('.reg_login_title').text('Register');
        }  
     }  

     function logRegOtp(check)
     {
        if(check == 'login')
        {
          var emailmob= $("#email_mobile").val();
            if(emailmob == '')
            {
                $("#err_log_1").css({"display":"block"});
            }
            else
            {
                $.ajax({
                type: 'POST',
                url: 'ajax.php?action=checkEmailMobile',
                data: $('#login_form_checkpout').serializeArray(),
                success: function (response) {
                  if(response == 1)
                  {
                    $("#otp_mob_email").val(emailmob);
                    $("#login_form_checkpout").css({"display":"none"});
                    $("#register_form_checkpout").css({"display":"none"});
                    $("#otp_form_checkpout").css({"display":"block"});
                    $(".reg_login_title").html("<span>Please enter OTP </span>");  
                  }
                  else if(response == 0)
                  {
                    $("#err_log_2").css({"display":"block"});
                  }
                }
              }); 

            }

        }
        else if(check == 'register')
        {
            var name= $("#name").val();
            var email= $("#email_reg").val();
            var mobile= $("#mobile_reg").val();
            var err = 0;
            if(name == '')
            {
               err = 1;
               $("#err_reg_1").css({"display":"block"});
            }
            else
            {
               $("#err_reg_1").css({"display":"none"});
            }
            if(email == '')
            {
               err = 1;
               $("#err_reg_2").css({"display":"block"});
            }
            else
            {
               $("#err_reg_2").css({"display":"none"});
            }
            if(email && !validateEmail(email))
            {
               err = 1;
               $("#reg_email_err2").css({"display":"block"});
            }
            else
            {
               $("#reg_email_err2").css({"display":"none"});
            }
            if(mobile == '')
            {
              err = 1;
               $("#err_reg_3").css({"display":"block"});
            }
            else
            {
                $("#err_reg_3").css({"display":"none"});
            }

            if(mobile && !validatePhone(mobile))
            {
              err = 1;
               $("#err_reg_4").css({"display":"block"});
            }
            else
            {
                $("#err_reg_4").css({"display":"none"});
            }

            if(err == 0)
            {
                $.ajax({
                type: 'POST',
                url: 'ajax.php?action=checkEmailExist',
                data: 'email='+email,
                success: function (response)
                {
                  if(response == 1)
                  {
                      $("#reg_email_exist_err").css({"display":"block"});
                  }
                  else
                  {
                      $("#reg_email_exist_err").css({"display":"none"});
                      $.ajax({
                      type: 'POST',
                      url: 'ajax.php?action=getUserRegisterNew',
                      data: $('#register_form_checkpout').serializeArray(),
                      success: function (response) {
                        // console.log(response);
                        if(response == 1)
                        {
                         $('#form_content_div').append('<p style="color:green" id="p1">registeration successfully<p>');
                            setTimeout(function() {
                                $('#p1').fadeOut('fast');
                           }, 10000);
                           loginRegister('login');
                        }
                        else
                        {  

                            $('#form_content_div').append('<p style="color;red" id="p2">someting went wrong!<p>');
                            setTimeout(function() {
                                $('#p2').fadeOut('fast');
                           }, 10000);
                            
                        }
                        
                      }
                      });
                  }
                }
                }); 
            }

            // $("#login_form_checkpout").css({"display":"block"});
            // $("#register_form_checkpout").css({"display":"none"});
            // $("#otp_form_checkpout").css({"display":"none"});

            // $(".active_deactive_regtab").removeClass("active");
            // $('.active_deactive_logtab').addClass(" active");
        }
        else if(check == 'otp')
        {
           if($("#otp").val()==1234)
           {
             var invoiceid=$("#invoice_id").val();
             var otp_mob_email=$("#otp_mob_email").val();
              $.ajax({
                type: 'POST',
                url: 'ajax.php?action=getUserLoginWithOtp',
                // data: $('#otp_form_checkpout').serializeArray() + "&invoiceid=" + invoiceid,
                // data: 'otp_mob_email='+'otp_mob_email'+'&invoiceid='+'invoiceid',
                   data:{otp_mob_email:otp_mob_email,invoiceid:invoiceid},
                success: function (response) {
                  //alert(response);
                  if(response == 1){
                       // swal("Login!", "You have Login successfully!", "success");
                      // document.getElementById('login_form').reset();
                       window.location.reload();
                  }else{
                    $("#login_failed").show();
                  }
                }
              });
           }
           else
           {
             alert("you enter  wrong OTP");
           }
        }
     }

  //      function validateEmail(email) {
  //   var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  //   return emailReg.test(email);
  // }
</script>

<script type="text/javascript">

  
      
   function update_cart_page(product_id,status)
    {
          if(confirm("You want to remove this item from cart ?")) {
            $.post("ajax.php?action=removeCartItems&cartId="+product_id,{},
            function (data) {
              //alert(data);
              swal("Deleted!", "Item removed from Cart!", "success");
              //console.log(data);
              window.location.reload();

              // $("#remove_row_"+product_id).remove();

            }
            );
          }
    }

  function cart_confirmed(payType)
  {
    $("#payment_form").hide();
    var row_counter_items = $("#row_counter_i").val();  
    var address = $("#enter_address").val();
    var name = $("#clientName").val();
    var email = $("#email").val();
    var mobile = $("#mobile").val();
    var err = 0;

    var cart_items = $("#row_counter").val();
    if(cart_items == 0 || cart_items == ''){
      swal("Warning", "You have empty cart!", "warning");
      return false;

    }
    if($("#delivery_type_input").val() !=3)
    {
      if($('#select_address__1').length && $('#select_address__1').val().length)
      {
      }
      else
      {
        if(address == '' )
        {
            err = 1;
            // $("#address_err").show();
            $("#form_content_div_").append('<div style="opacity:1" class="alert alert-danger alert-dismissible fade in flash_err_address"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Danger!</strong> Please Enter Delivery Address.</div>')
           
              setTimeout(function() {
                  $('.flash_err_address').fadeOut('fast');
              }, 5000);

           //alert("enter delivery address")
        }
        else
        {
          // $("#address_err").hide();
        }
      } 
    }
    
  
    if(name == '' )
    {
      err = 1;
      // $("#clientName_err").show();
      alert("enter name")
    }else{
       // $("#clientName_err").hide();
    }
    if(email == '' )
    {
      err = 1;
      // $("#email_err").show();
       alert("enter email")
    }else if ( !validateEmail(email))
    {
      err = 1;
       alert("enter valid email")
      // $("#email_err").hide();
      // $("#email_err2").show();
    }else{
      // $("#email_err2").hide();
    }
    if(mobile == '' )
    {
      err = 1;
       alert("enter mobile")
      // $("#mobile_err").show();
    }else{
       // $("#mobile_err").hide();
    }

    var accNum = <?php echo accNum; ?> ;


    if(err == 0){
      var payurl = '';
      if(payType == 1)
      {
         payurl ='ajax.php?action=confirmCart_grocers'
      }
      else if(payType == 2)
      {
          payurl = 'ajax.php?action=confirm_card_payment'
      }
      
      $.ajax({
          type: 'POST',
          url: payurl,
          data: $('#cart_block').serializeArray(),
          success: function (response) {
            var payment_type = $("input[name='payment_type']:checked").val();
            if(payment_type == "CC"){
             
              var obj_data = JSON.parse(response);
              window.location.href = "https://indiangrocers.com.au/Pay/P/checkout.php?order_id="+obj_data['order_id']+"&invoice_id="+obj_data['invoice_id']+"&total="+obj_data['total_price']+"&email="+obj_data['email']+"&name="+obj_data['name']+"&address="+obj_data['address']+"&paymenttype=card&accNum="+accNum;
            }else if(payment_type == "POLI"){
                var obj_data = JSON.parse(response);
                window.location.href = "<?php echo HTTP_HOST;?>/polipayment.php?order_id="+obj_data['order_id']+"&amount="+obj_data['total_price'];
            }
            else if (payType == 1){
              var obj_data = JSON.parse(response);
              window.location.href = "order_submitted.php?order_id="+obj_data['invoice_id'];
            }
            else if(payType == 2)
            {
               //swal("success", "Your request is proceed to pay", "success");

               window.location.href = "payment_proceed.php";
            }
          }
        });
    }

  }


  function validateEmail(email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test(email);
  }

  function validatePhone(phone) {
    var regex = /^[0-9]{7,13}$/;
     return regex.test(phone);
}
</script>
      
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAK4boX_o6ArPMYqO3vbwniRIA3iYUOMGI&libraries=places,geometry&callback=initAutocomplete" async defer></script>

      <script>
// This sample uses the Autocomplete widget to help the user select a
// place, then it retrieves the address components associated with that
// place, and then it populates the form fields with those details.
// This sample requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script
// src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

var placeSearch, autocomplete;

var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

function initAutocomplete() {
  // Create the autocomplete object, restricting the search predictions to
  // geographical location types.

  var options = {
    types: ['geocode'],
    componentRestrictions: {country: 'au'}
    };
   
  autocomplete = new google.maps.places.Autocomplete(
  document.getElementById('address'), options);

  //alert("here");

  // Avoid paying for data that you don't need by restricting the set of
  // place fields that are returned to just the address components.
  autocomplete.setFields(['address_component']);

  // When the user selects an address from the drop-down, populate the
  // address fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);
}


function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details,
  // and then fill-in the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];


    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];

      // alert(addressType + " : " + val);
      document.getElementById(addressType).value = val;

      if(addressType == "postal_code")
      {
        address_str = document.getElementById('address').value;
        if(address_str.indexOf(val) != -1){
        }else{
          document.getElementById('address').value = document.getElementById('address').value + ", " + val;
        }
      }
    }
  }

  if(!place.geometry)
  {
    return;
  }else{
    document.getElementById('hidden_lat').value = place.geometry.location.lat();
    document.getElementById('hidden_long').value = place.geometry.location.lng();
  }
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {

      var latitude = position.coords.latitude;
      var longitude = position.coords.longitude;
       //alert(latitude);
      // alert(longitude);

      var geolocation = {
        lat: latitude,
        lng: longitude
      };

      document.getElementById('hidden_lat').value = latitude;
      document.getElementById('hidden_long').value = longitude;

      var circle = new google.maps.Circle(
          {center: geolocation, radius: position.coords.accuracy});
      autocomplete.setBounds(circle.getBounds());
    });
  }
}
</script>





