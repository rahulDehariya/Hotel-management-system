<?php

   // require_once "getdata/data.php";
   
   // $myCategory = new Category();
    require_once "header.php";

    $guest_id = $_SESSION['guest_id'];

    
    // echo("http://hotel.staffstarr.com/ajax.php?action=getCartItems"); die;
    $res = file_get_contents("http://hotel.staffstarr.com/ajax.php?action=getCartItems");





    $res_arr = json_decode($res,true);

    $getCartItems = $res_arr; //$myCategory->getCartItems(accNum,$guest_id);

    //print_r($getCartItems);die;

    $address = array();
    $clientName = "";
    $email = "";
    $mobile = "";

    //echo $_SESSION['user_id'];
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];

        $user_json = file_get_contents("http://hotel.staffstarr.com/ajax.php?action=getUserDetails&user_id=".$user_id);
        $user_address_json = file_get_contents("http://hotel.staffstarr.com/ajax.php?action=getUserAddress&user_id=".$user_id);

        $getUserDetails = json_decode($user_json, true); //$myCategory->getUserDetails(accNum,$user_id);
        $getUserAddress = json_decode($user_address_json, true); // $myCategory->getUserAddress($user_id);

        //print_r($getUserDetails);
        $address = $getUserAddress;
        $clientName = $getUserDetails['username'];
        $email = $getUserDetails['email'];
        $mobile=$getUserDetails['mobile'];
    }


    $_SESSION['accNum1'] = accNum;

   
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



<script type="text/javascript">

  function cart_confirmed()
  {
    var row_counter_items = $("#row_counter_i").val();

    if(row_counter_items > 0)
    {
      for(var p = 0; p < row_counter_items; p++)
      {
        k = p+1;
        is_stock = $("#is_stock_"+k).val();
        //alert(is_stock);
        if(is_stock == 0)
        {
          cart_id = $("#cart_id_"+k).val();

          $.post("ajax.php?action=removeCartItems&cartId="+cart_id,{},
            function (data) {
            });
        }
      }
    }

    //return false;

    var address = $("#address").val();
    var name = $("#clientName").val();
    var email = $("#email").val();
    var mobile = $("#mobile").val();
    var err = 0;

    var cart_items = $("#row_counter").val();
    //alert(cart_items);
    //err = 1;
    if(cart_items <= 0){
      err = 1;
      swal("Warning", "You have empty cart!", "warning");
      return false;

    }

    if($('#select_address').length && $('#select_address').val().length){

      //alert("true");

    }else{
      if(address == '' )
      {
        err = 1;
        $("#address_err").show();
      }else{
         $("#address_err").hide();
      }
    }
  
    if(name == '' )
    {
      err = 1;
      $("#clientName_err").show();
    }else{
       $("#clientName_err").hide();
    }
    if(email == '' )
    {
      err = 1;
      $("#email_err").show();
    }else if ( !validateEmail(email))
    {
      err = 1;
      $("#email_err").hide();
      $("#email_err2").show();
    }else{
      $("#email_err").hide();
      $("#email_err2").hide();
    }
    if(mobile == '' )
    {
      err = 1;
      $("#mobile_err").show();
    }else{
       $("#mobile_err").hide();
    }

    //var payment_type = $("input[name='payment_type']:checked").size();
    //alert(payment_type);

    payment_type = 'COD';

    if(payment_type == 0)
    {
      err = 1;
      $("#payment_type_err").show();
    }else{
       $("#payment_type_err").hide();
    }

    var accNum = <?php echo accNum; ?> ;


    if(err == 0){
      
      $.ajax({

          type: 'POST',
          url: 'ajax.php?action=confirmCart',
          data: $('#cart_block').serializeArray(),
          success: function (response) {
              // alert(response);
             //  console.log(response);

            var payment_type = $("input[name='payment_type']:checked").val();
            if(payment_type == "CC"){
             // swal("Good job!", "Proceed Payment", "success");

              var obj_data = JSON.parse(response);

              window.location.href = "https://autohubsolutions.com.au/Pay/P/checkout.php?order_id="+obj_data['order_id']+"&total="+obj_data['total_price']+"&email="+obj_data['email']+"&name="+obj_data['name']+"&address="+obj_data['address']+"&paymenttype=card&accNum="+accNum;
            }else if(payment_type == "POLI"){

                var obj_data = JSON.parse(response);
                window.location.href = "https://autohubsolutions.com.au/polipayment.php?order_id="+obj_data['order_id']+"&amount="+obj_data['total_price'];
            }
            else{

              var obj_data = JSON.parse(response);
              window.location.href = "order_success.php?order_id="+obj_data['order_id'];
            }
          }
        });
    }
  }

  function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test( $email );
  }
  
  

    function selected_address()
    {
      var select_address = $("#select_address").val();
      if(select_address != "")
      {
        $("#address").val("");
      }
    }
    function entered_address()
    {
      //alert("inn");
      $("#select_address").val("");
    }
</script>
<!-- Start -->

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
                    <div class="col-md-10 push-md-1" role="tablist" id= "main_category_items">
                        <!-- Menu Category / Burgers -->

                       <form action="javascript:void(0);" method="post" class="cart" id="cart_block">
                    <table style="border: 1px solid #ddd;" id="cart_list_items" class="form-group">
                          <thead class="cart__row cart__header">
                            <tr>
                                <th class="product-info">SN.</th>
                                <th class="product-info">Product</th>
                              <th class="product-quantity">Quantity</th>
                              <th class="product-price">Price</th>
                              <th class="product-remove">Remove</th>

                              <input type="hidden" id= "row_counter" value="<?php echo count($getCartItems);?>">
                          </tr></thead>
                          <tbody>

                            <?php  $i = $total = 0 ; 

                            if(count($getCartItems)){

                              foreach ($getCartItems as $CartItems) { 

                                //print_r($CartItems);
                                $cart_details = $CartItems['cart'];
                                $total+=$cart_details['price'];
                                $i++;

                                $extraItemPrice_perItem = 0;
                                $invoice_id = $CartItems['invoiceId'];
                                $extras = $CartItems['extra'];
                                foreach ($extras as $extra) {
                                  $extraItemPrice_perItem+=$extra['price'];
                                }

                                $is_stock = 1;//$cart_details['stock'];
                                $class_on_stock = "";
                                if($is_stock == 0)
                                {
                                  $class_on_stock = "OutOfStock";
                                }
                                ?>
                                
                              <tr class="cart__row border-bottom line1 cart-flex border-top <?php echo $class_on_stock; ?>">
                                  <input type="hidden" name="cart_id[]" id="<?php echo $cart_details['id']; ?>" value="<?php echo $cart_details['id']; ?>">

                                  <input type="hidden" name="qty[]" id="ContentPlaceHolder1_box_<?php echo $cart_details['id']; ?>" value="<?php echo $cart_details['quantity']; ?>">
                                  <input type="hidden" name="perItemPrice[]" id="product_price_per_item_<?php echo $cart_details['id']; ?>" value="<?php echo $cart_details['perItemPrice']; ?>">
                                  <input type="hidden" name="extraPerItemPrice[]" id="extras_price_per_item_<?php echo $cart_details['id']; ?>" value="<?php echo $extraItemPrice_perItem; ?>">
                                  <input type="hidden" name="is_stock" id="is_stock_<?php echo $i; ?>" value="<?php echo $is_stock; ?>">
                                  <input type="hidden" name="" id="cart_id_<?php echo $i; ?>" value="<?php echo $cart_details['id']; ?>">
                                  
                                  <td class="cart__image-wrapper cart-flex-item">
                                   <b> <?php echo $i; ?></b>
                                  </td>
                                  <td class="cart__image-wrapper cart-flex-item">
                                   <?php echo $cart_details['menuName']; ?>                               
                                  </td>
                                  
                                  <td class="cart__update-wrapper cart-flex-item product-quantity">
                                    
                                    <!-- <input type="button" class="buttoncls allbuton quantity_popup" value="-" id="dec" onclick="quantity(<?php echo $cart_details['id']; ?>,0);"> -->
                                    <input name="ctl00$ContentPlaceHolder1$box" onchange="quantity(<?php echo $cart_details['id']; ?>,2);" type="text" id="ContentPlaceHolder1_box22_<?php echo $cart_details['id']; ?>" value="<?php echo $cart_details['quantity']; ?>" class="manual-adjust quantity_popup_manual" style="width: 30px;    padding-left: 7px;" readonly>
                                    <!-- <input type="button" class="buttoncls allbuton quantity_popup" value="+" id="inc" onclick="quantity(<?php echo $cart_details['id']; ?>,1);"> -->
                                  </td>
                                  <td class="small--hide total-product cart-flex-item">
                                    <div>
                                     $<span class="calculated_price_peritem" id="total_calculated_price_<?php echo $cart_details['id']; ?>"><?php echo number_format($cart_details['price'],2); ?></span>

                                     </div>
                                  </td>
                                  <td class="product_remove cart-flex-item" style="<?php echo ($is_stock == 0 ? "display: none;" : "" ); ?> ">
                                      <span style="cursor: pointer;" class="cart__remove" aria-label="Remove this item" onclick="update_cart_page(<?php echo $cart_details['id']; ?>,0);"><!-- Remove -->×</span></td>
                                  <td class="product_remove cart-flex-item" style="<?php echo ($is_stock == 1 ? "display: none;" : "" ); ?> ">
                                      <span style="color:red;">OUT OF STOCK</span>
                                      
                                  </td>
                                </tr>
                            <?php } } else{ ?>
                              <tr>
                                <td  colspan="5">You don't have anything in your cart</td>
                                
                              </tr>

                           <?php  } ?>
                              <tr>

                                <input type="hidden" name="row_counter_i" id="row_counter_i" value="<?php echo $i; ?>">

                                <input type="hidden" name="order_total_price" id="total_calculated_price_hidden" class="total_calculated_price_hidden" value="<?php echo $total; ?>">


                                <td class="total_td" colspan="3">Total</td>
                                <td class="total_td total_calculated_price cart-flex-item" >$<?php echo number_format($total,2); ?></td>
                                <td class="total_td"></td>
                                
                              </tr>
                            </tbody>
                        </table>

                        <br> 

                        <?php if(count($address) > 0){ ?>
                          
                        <div class="form-group">
                          <div class="col-md-12">
                            
                            <label for="Description" >Select From address:</label> 
                        </div>
                        <div class="col-md-12">

                          <select  class="form-control" name="select_address" id="select_address" onchange="selected_address();">
                            <option value="">SELECT</option>
                            <?php 
                            $p = 0;
                            foreach($address as $single_address){ 
                              $p++; 
                              ?>
                              <option value="<?php echo $single_address['id'];?>" <?php echo($p == 1 ? "Selected" : "");?>> <?php echo $single_address['address'] ;?> </option>
                            <?php } ?>
                          </select>

                            <!-- <textarea class="form-control" rows="2" name="address" id="address" placeholder="Enter your address" onFocus="geolocate()"><?php echo $address;?></textarea> -->
                          
                          
                          </div>
                        </div>
                        <p style="padding-left: 15px;margin-bottom: 0;"> OR </p>
                      <?php } ?>

                        <div class="form-group" >
                          <div class="col-md-12">
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

                            <label for="Description" >Enter New Delivery Address:</label> 
                        </div>
                        <div class="col-md-12" style="margin-bottom: 10px; width: 100%;" >

                          <!-- <input id="autocomplete" placeholder="Enter your address" onFocus="geolocate()" type="text"/> -->

                            <textarea class="form-control" rows="2" onchange="entered_address()" name="address" id="address" placeholder="Enter your address" onFocus="geolocate()"><?php //echo $address;?></textarea>
                          <p id = "address_err" style="display: none; color: red;">Please enter Delivery Address</p>
                          
                          </div>
                        </div>
                        
                        <div class="row" style="padding: 0 15px;">
                          <div class="col-md-6 form-group" style="">
                            
                            <div class="">
                              <label for="Description" >Name Of Client:</label> 
                              <input  class="form-control" type="text" name="clientName" id="clientName" value="<?php echo $clientName;?>" <?php echo($clientName!='' ? "readonly" : "");?> >
                              <p id = "clientName_err" style="display: none; color: red;">Please enter Name Of Client</p>
                            
                            </div>
                          </div>
                          <div class="col-md-6 form-group">
                          
                            <div class="">
                              <label for="Description" >Email:</label> 
                              <input  class="form-control" type="text" name="email" id="email" <?php echo($email!='' ? "readonly" : "");?> value="<?php echo $email;?>">
                            <p id="email_err" style="display: none; color: red;">Please enter Email</p>
                            <p id="email_err2" style="display: none; color: red;">Please enter valid Email</p>

                            </div>
                          </div>
                        </div>

                        

                        <div class="col-md-12 form-group" style="padding-right: 0;padding-left: 0;">
                          <div class="col-md-12">
                            <label for="Description" >Mobile:</label> 
                          </div>
                          <div class="col-md-12">
                            <input  class="form-control" type="number" name="mobile" id="mobile" <?php echo($mobile!='' ? "readonly" : "");?> value="<?php echo $mobile;?>" required>
                            <p id="mobile_err" style="display: none; color: red;">Please enter mobile number</p>

                          </div>
                        </div>

                        <div class="form-group col-md-12" style="display: none;">
                        <hr>
                          <div class="section-header col-md-12">
                            <h1>Payment Type</h1>
                          </div>

                          <!-- <div class="" style="padding-right: 0;padding-left: 0;"> -->
                            <!-- <div class="col-md-12">
                              <label for="Description" >Payment Type:</label> 
                            </div> -->
                            <div class="col-md-8 form-group">
                              
                              <span class="col-md-4"><input type="radio" name="payment_type" value="POLI" > POLI </span>
                              <!-- <span class="col-md-4"><input type="radio" name="payment_type" value="CC" > CARD PAYMENT</span> -->
                              <span class="col-md-4"><input type="radio" name="payment_type" value="COD" checked > CASH ON DELIVERY</span>

                              <p id="payment_type_err" style="display: none; color: red;">Please select payment type</p>
  
                            </div>
                          <!-- </div> -->
                        </div>
                        <div class="form-group">
                          <div class="col-md-12" >
                            <div style="cursor: pointer;" onclick="cart_confirmed()">
                            <p style="margin-top: 20px;padding: 10px;color: white;background-color: #171717;margin-bottom: 20px;width: 100;text-align: center;">
                              <b>Submit Order</b>
                            </p>
                            </div>
                          </div>
                        </div>
                              
                    </form>
                    </div>
                </div>
            </div>
        </div>
</div>

<!-- end -->

      <!-- Footer Container -->

      <?php Include 'footer.php'; ?>
      <!-- //end Footer Container -->
      
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





