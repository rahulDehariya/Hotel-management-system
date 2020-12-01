<?php
require_once "getdata/autopart_data.php";

$myCategory = new Category();

$specials = $myCategory->getSpecials(accNum);

//print_r($specials);

$specials_offrs = $_SESSION['specials'];


$data_Cat = $myCategory->getCategoryTreeView(accNum);

if (isset($_GET['test'])) {

  echo '<pre>';

  print_r($data_Cat);

  die;

}

// $data_Cat1 = $myCategory->getCategoryTreeView(accNum);

// if(isset($_GET['test11']))

// {

//     echo '<pre>';

//     print_r($data_Cat1);

//     die;

//  }

$cat_id = 0;

if (isset($_GET['id'])) {
  $cat_id = $_GET['id'];
}

$allMenuIds = $myCategory->getAllMenuIdAccount(accNum, $cat_id);

$menu_ids = implode(",", $allMenuIds);

// setcookie("cart_items", "", time() - 3600);
//    unset($_SESSION);

// print_r($_SESSION);
// print_r($_COOKIE);

$product_data = $myCategory->getMenuItems(accNum, $menu_ids);

if (isset($_GET['test1'])) {

  echo '<pre>';

  print_r($product_data);

  die;

}

$banners_result = $myCategory->getBanners(accNum);

require_once "header.php";
?>

  <style type="text/css">

    .footer-classic {
              position: relative;
              width: 100%;
              float: left;
            }

      .typeheader-2 .header-bottom {
         border-bottom:none;
        }
        body{font-family:'Rubik', sans-serif}

         .modal-header{

            width: 100%;

            float: left;

          }

          .modal-content{

            width: 100%;

            float: left;

              border: none;

          }

         label {

              font-weight: 500;

          }

         #menu_varient_data{

            border-bottom: 1px solid #ddd;

          }

         #menu_add_extra{

            border-top: 1px solid #ddd;

          }

         .modal-body{

            width: 100%;

            float: left;

          }

          .sub_menu_dropup{
              width: 400px !important;
          }

          .container-megamenu.vertical .vertical-wrapper ul.megamenu > li > .sub-menu .content .static-menu .menu > ul > li {
                 margin-bottom: 0px; 
            }
            ul.megamenu li .sub-menu .content .static-menu .menu ul {
              margin: 0px 0 0px; 
          }
          .products-list{
            width: 100%;
            float: left;
          }

          h5 {
              min-height: 40px;
              margin-top: 8px;
              font-weight: lighter;
          }

          .products-list.list .product-layout .product-item-container .right-block h5 {
            display: none;
        }

      </style>

<style>
* {box-sizing: border-box;}
body {font-family: Verdana, sans-serif;}
.mySlides {display: none;opacity: 1;}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@media screen and (max-width: 769px) {
    .menu-vertical-w{ 
      min-height: auto !important;
    }
}


/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .text {font-size: 11px}
}


.img_offer{
  width: 90px !important;
  position: absolute;
  top: 0;
  right: 0;
  z-index: 99;
}

#header{
  background: transparent;
}


#wrapper{
      background-image: url(assets/used-car-parts-Perth.jpg);
      background-position: top center;
      background-size: 100%;
      background-repeat: no-repeat;
      
    }

    @media (min-width: 1200px){

    .menu_container {
      margin-top: 50px;
      }
    }

</style>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script type="text/javascript">

     var IS_EXTRA_COMPULSORY = <?php echo IS_EXTRA_COMPULSORY;?>;
    window.onclick = function(event) {

       var modal = document.getElementById("myModal");

       if (event.target == modal) {

         modal.style.display = "none";

       }

     }

     function close_modal() {

       var modal = document.getElementById("myModal");

       modal.style.display = "none";

     }

     function show_modal (menu_id) {

       //   $('#myModal').fadeIn();

        //   $('#myModal').addClass("in");

       $.post("ajax_autopart.php?action=getMenudetails&menuNum="+menu_id, {},

         function (data) {

            //alert(data);

            obj = $.parseJSON(data);

           menu = obj.menu;

           $(".titleModal").text(menu[0]['menuName']);

            var calories = "NA";

            if(menu[0]['Calories'] != null)
            {

              calories = menu[0]['Calories'];
            }

            $(".calories").text("Part No. : "+calories);

           $(".menudesc").html(menu[0]['description']);

           $("#menu_image").attr('src',menu[0]['image']);

           var varieties = obj.varieties;

           var text_data = "";

            if(varieties.length > 0){

             for( i =0; i < varieties.length; i++ )

             {

               text_data+='<div class="col pretty p-switch p-fill p-2  col-md-6 col-sm-12" ><input type="hidden" value="'+varieties[i]['stock']+'" name="" id="in_stock_'+varieties[i]['varietyNum']+'" ><label style="font-size:14px;"><input type="radio" class="" name="variety" data-price="'+varieties[i]['price']+'" id="'+varieties[i]['varietyNum']+'" value="'+varieties[i]['varietyNum']+'" onclick="getMenuVarietyPrice(this)"> &nbsp '+varieties[i]['itemName']+' - $'+varieties[i]['price']+'</label></div>';

             }

           }

           if(text_data != '')

           {

              $("#menu_varient_data").show();

              $("#btn_addToCart").removeClass("disabled");

           }else{

              $("#menu_varient_data").hide();

              $("#btn_addToCart").addClass("disabled");

            }

            $("#btn_outOfStock").hide();
            $("#btn_addToCart").show();

            $(".varient_data").html(text_data);

           var ingredients = obj.ingredients;

            var text_data1 = "";

            var inline_ingredients = "";

             if(ingredients.length > 0){

               for( i =0; i < ingredients.length; i++ )

               {

                 var ingredient_text = ingredients[i]['ingredients'];

                 text_data1+='<div class="form-group d-flex" style="margin-bottom: 10px;"><div class="mr-auto p-2"><label>'+ingredient_text['itemName']+'</label><select class="ingnum4 form-control" style=" width:auto; padding:7px; margin: 0px;float: right;" data-ingid="'+ingredient_text['ingredientNum']+'" name="addextra['+ingredient_text['ingredientNum']+']" onchange="getMenuIngredientOptionPrice(this)">';

                 inline_ingredients+= ingredient_text['itemName']+',';

                 var ingredient_options = ingredients[i]['ingredient_options'];

                 text_data1+= '<option data-iotprice="0" data-iot="0" value="0">select one</option>';

                 if(ingredient_options.length > 0){

                   for( k =0; k < ingredient_options.length; k++ )

                    {

                     text_data1+='<option data-iot="'+ingredient_options[k]['id']+'" value="'+ingredient_options[k]['id']+'" data-iotprice="'+ingredient_options[k]['option_price']+'" name="'+ingredient_options[k]['plus_name']+'">'+ingredient_options[k]['plus_name']+' +$'+ingredient_options[k]['option_price']+'</option>';

                   }

                 }

                  text_data1+='</select></div></div>';

               }

             }

             inline_ingredients = inline_ingredients.replace(/,\s*$/, "");

             $("#inline_ingredients").text(inline_ingredients);

           if(text_data1 != '')

           {

             $("#menu_add_extra").show();

           }else{

             $("#menu_add_extra").hide();

           }

           $(".add_extra_menu").html(text_data1);

           $('.mprice').html(0);

           $('.mquan').html(1);

           $('#qty').val(1);

           $("#menuNum").val(menu_id);

           $('#totalPrice').val(0);

           $('#myModal').fadeIn();

            $('#myModal').addClass("in");

          // alert(status);

           // if (status == 'success') {

           //     prc = parseInt(data);

           //     var qty = $('input[name=qty]').val();

           //     var multiplied_prc = (parseInt(prc * qty) + parseInt(total * qty));

           //     $('.mprice').html(multiplied_prc);

           // }

       });

     }



     function addToCart() {

       /*  if($('#activeTable').val() != 0){

        if($('#activeDepartment').val() != 0){*/

         if ($("input[name='variety']").is(':checked')) {
       var err= 0;
         if(IS_EXTRA_COMPULSORY){

           var opt_price = $('.add_extra_menu').find(":selected");

           //alert(opt_price.length);

           var total = 0;

            var id = 0;

           for (i = 0; i < opt_price.length; i++) {

               total += Number(opt_price[i].getAttributeNode("data-iotprice").value);

               if(Number(opt_price[i].getAttributeNode("data-iot").value) != 0)

                {

                  id = Number(opt_price[i].getAttributeNode("data-iot").value);

                }

           }

           if(id ==0)

           {

                 $('.add_extra_menu').focus();

                 responseErr("Please select one Extra");

                  err = 1;

            }

          }
         //alert(err);

         if(err == 0){

            var qty = $('input[name=qty]').val();

            //var activeTable = $('#activeTable').val();

            if ((qty > 0) && (qty <= 20)) {

                $.ajax({

                    type: 'POST',

                   url: 'ajax_autopart.php?action=addToCart',

                   data: $('#menuAddToCart').serializeArray(),

                   success: function (response) {
                      //alert(response);

                      var modal = document.getElementById("myModal");

                      modal.style.display = "none";

                      //alert('Item added to Cart.');

                      swal("Item added to Cart!", "", "success");

                      $.post("ajax_autopart.php?action=getCartItems",{},

                      function (data1) {

                        //alert(data1)

                        data = $.parseJSON(data1);

                        var cart_count = data.length;

                        $("#cart_items").text(cart_count);

                      });

                    // alert(response);

                     // console.log(response);

                       if (response != '0') {

                           // modal.style.display = "block";

                           // // var pc = parseInt($('.itemAddedCart').text()) + 1;

                           // // $('.itemAddedCart').text(pc);

                          // alert('Item added to Cart.');

                           //Notify('Item added to Cart.');

                           //window.location.reload();

                       } else {

                           // $("#itmCart").modal('show');

                           // //$(".itemAddedCart").html("0");

                           // //$('#menuModal').modal('hide');

                           // $('#regModal').modal('show');

                          //window.location.replace(site_url+'home.php');

                       }

                   }

               });

           }

         }

       } else {

         $("input[name='variety']").focus();

           responseErr("Please select one Variety");

       }

       /*}else{

        responseErr("Please select Department");

        }

        }else{

        responseErr("Please select Table Number");

        }  */

     }

     function responseErr(msg) {

         $("#response_msg").removeClass('alert-success').addClass('alert-danger').fadeIn();

         $("#response_msg .res_msg").html(msg);

        $("#response_msg").delay(3000).fadeOut(1000);

        //$("html, body").animate({ scrollTop: $('#response_msg').offset().top }, 1000);

     }

     function add_quantity() {

       //alert ("in");



         if ($("#qty").val() < 20) {

             var total = 0;

             var opt_price = $('.add_extra_menu').find(":selected");

             for (i = 0; i < opt_price.length; i++) {

                 total += Number(opt_price[i].getAttributeNode("data-iotprice").value);

             }

            var qty = +$("#qty").val() + 1;

             $("#qty").val(qty);

            var prc = $('input[name=variety]:checked').data('price');

             var multiplied_prc = (parseInt(prc * qty) + parseInt(total * qty));

             $('.mprice').html(multiplied_prc);

             $('#totalPrice').val(multiplied_prc);

             $('.mquan').html(qty);

         }

     }

     function sub_quantity() {

         if ($("#qty").val() > 1) {

            var total = 0;

             var opt_price = $('.add_extra_menu').find(":selected");

             for (i = 0; i < opt_price.length; i++) {

                 total += Number(opt_price[i].getAttributeNode("data-iotprice").value);

             }

            var qty = +$("#qty").val() - 1;

             $("#qty").val(qty);

             var prc = $('input[name=variety]:checked').data('price');

             var multiplied_prc = (parseInt(prc * qty) + parseInt(total * qty));

             $('.mprice').html(multiplied_prc);

             $('#totalPrice').val(multiplied_prc);

             $('.mquan').html(qty);

         }

     }

     function getMenuVarietyPrice(el) {

          var total = 0;

          var is_stock = $("#in_stock_"+el.id).val();
          if(is_stock == 0) 
          {
            $("#btn_addToCart").hide();
            $("#btn_outOfStock").show();
          }else{
            $("#btn_outOfStock").hide();
            $("#btn_addToCart").show();
          
          var opt_price = $('.add_extra_menu').find(":selected");

          // console.log(opt_price);

          // console.log(opt_price[0].getAttributeNode("data-iotprice").value);

          // console.log(opt_price[1].getAttributeNode("data-iotprice").value);
         for (i = 0; i < opt_price.length; i++) {

             total += Number(opt_price[i].getAttributeNode("data-iotprice").value);

          }

          // alert(total);

         //alert(el.id);
         //$.post("https://order.everlastingengraving.com.au/common/ax.php?mode=getMenuVarietyPrice", {varietyNum: el.id},
         $.post("ajax_autopart.php?action=getMenuVarietyPrice&varietyNum="+el.id,{},

           function (data) {

             //alert(data);

             //alert(status);

             prc = parseInt(data);

             if (prc > 0) {

                var qty = $('input[name=qty]').val();

                //alert(qty);

                 var multiplied_prc = (parseInt(prc * qty) + parseInt(total * qty));

                 $('.mprice').html(multiplied_prc);

                 $('#totalPrice').val(multiplied_prc);

             }

         });

        }

      }

     var arr = new Array();

     function getMenuIngredientOptionPrice(el) {

         var iot = $(el).find(':selected').data("iot");

         var ing_id = parseInt($(el).data('ingid'));

         var opt_price = parseInt($(el).find(":selected").data("iotprice"));

         $.post("ajax_autopart.php?action=getMenuIngredientOptionPrice&iot_id="+iot, {},

         function (data) {

           //alert(ing_id);

           data = parseInt(data);

             if (data > 0) {

                 data = parseInt(data);

                 var added = false;

                 var total = 0;

                 $.map(arr, function (elementOfArray, indexInArray) {

                     if (elementOfArray.ing_id == ing_id) {

                         added = true;

                     }

                     for (var i in arr) {

                         if (arr[i].ing_id == ing_id) {

                             arr[i].amt = opt_price;

                             break;

                         }

                     }

                 });

                 if (!added) {

                     arr.push({ing_id: ing_id, iot: iot, amt: data});

                 }



            }

             var total = 0;

             var opt_price = $('.add_extra_menu').find(":selected");

                 for (i = 0; i < opt_price.length; i++) {

                     total += Number(opt_price[i].getAttributeNode("data-iotprice").value);

                 }

                 var prc = $('input[name=variety]:checked').data('price');

                 var qty = $('input[name=qty]').val();

                 var multiplied_prc = (parseInt(prc * qty) + parseInt(total * qty));

                 $('.mprice').html(multiplied_prc);

                 $('#totalPrice').val(multiplied_prc);

         });

     }

     </script>
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

                               <!-- <ul class="dropdown-menu pull-right shoppingcart-box" role="menu">

                                    <li>

                                        <table class="table table-striped">

                                            <tbody>

                                                <tr>

                                                    <td class="text-center" style="width:70px">

                                                        <a href="product.html">

                                                            <img src="image/catalog/demo/product/80/1.jpg" style="width:70px" alt="Yutculpa ullamcon" title="Yutculpa ullamco" class="preview">

                                                        </a>

                                                    </td>

                                                    <td class="text-left"> <a class="cart_product_name" href="product.html">Yutculpa ullamco</a>

                                                    </td>

                                                    <td class="text-center">x1</td>

                                                    <td class="text-center">$80.00</td>

                                                    <td class="text-right">

                                                        <a href="product.html" class="fa fa-edit"></a>

                                                    </td>

                                                    <td class="text-right">

                                                        <a onclick="cart.remove('2');" class="fa fa-times fa-delete"></a>

                                                    </td>

                                                </tr>

                                                <tr>

                                                    <td class="text-center" style="width:70px">

                                                        <a href="product.html">

                                                            <img src="image/catalog/demo/product/80/2.jpg" style="width:70px" alt="Xancetta bresao" title="Xancetta bresao" class="preview">

                                                        </a>

                                                    </td>

                                                    <td class="text-left"> <a class="cart_product_name" href="product.html">Xancetta bresao</a>

                                                    </td>

                                                    <td class="text-center">x1</td>

                                                    <td class="text-center">$60.00</td>

                                                    <td class="text-right">

                                                        <a href="product.html" class="fa fa-edit"></a>

                                                    </td>

                                                    <td class="text-right">

                                                        <a onclick="cart.remove('1');" class="fa fa-times fa-delete"></a>

                                                    </td>

                                                </tr>

                                            </tbody>

                                        </table>

                                    </li>

                                    <li>

                                        <div>

                                            <table class="table table-bordered">

                                                <tbody>

                                                    <tr>

                                                        <td class="text-left"><strong>Sub-Total</strong>

                                                        </td>

                                                        <td class="text-right">$140.00</td>

                                                    </tr>

                                                    <tr>

                                                        <td class="text-left"><strong>Eco Tax (-2.00)</strong>

                                                        </td>

                                                        <td class="text-right">$2.00</td>

                                                    </tr>

                                                    <tr>

                                                        <td class="text-left"><strong>VAT (20%)</strong>

                                                        </td>

                                                        <td class="text-right">$20.00</td>

                                                    </tr>

                                                    <tr>

                                                        <td class="text-left"><strong>Total</strong>

                                                        </td>

                                                        <td class="text-right">$162.00</td>

                                                    </tr>

                                                </tbody>

                                            </table>

                                            <p class="text-right"> <a class="btn view-cart" href="cart.html"><i class="fa fa-shopping-cart"></i>View Cart</a>&nbsp;
                                  &nbsp;
                                  &nbsp;
                                   <a class="btn btn-mega checkout-cart" href="checkout.html"><i class="fa fa-share"></i>Checkout</a>

                                            </p>

                                        </div>

                                    </li>

                                </ul> -->

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
                <div class="row" style="margin-top: 15px;">
                  <div class="col-lg-3"></div>
                  <!-- <div class="col-lg-6" style="background-color: rgba(137, 133, 133, 0.42);color: white;border-radius: 15px;padding: 10px; text-align: center;">

                    Priemium Quality At Affordable Prices

                  </div> -->
                  <div class="col-lg-3"></div>
                </div>


            </div>

        </div>

         <div class="header-bottom hidden-compact">

         <div class="container menu_container" style="">

         <div class="row">

         <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
         <div class="menu-vertical-w" style="min-height: 200px;">
            <div class="responsive so-megamenu megamenu-style-dev ">
               <div class="so-vertical-menu ">
                  <nav class="navbar-default">
                     <div class="container-megamenu vertical">
                        <div id="menuHeading">
                           <div class="megamenuToogle-wrapper">
                              <div class="megamenuToogle-pattern">
                                 <div class="container">
                                    <div>
                                       <span></span>
                                       <span></span>
                                       <span></span>
                                    </div>
                                    <?php echo $data_Cat[0]['main']['categoryName'];?>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="navbar-header" style="top: 0;">
                           <button type="button" id="show-verticalmenu" data-toggle="collapse" class="navbar-toggle">
                           <i class="fa fa-bars"></i>
                           <span>
                           <?php echo $data_Cat[0]['main']['categoryName'];?></span>
                           </button>
                        </div>
                        <div class="vertical-wrapper">
                           <span id="remove-verticalmenu" class="fa fa-times"></span>
                           <div class="megamenu-pattern">
                              <div class="container-mega">
                                 <ul class="megamenu">

                                  <?php foreach($data_Cat[0]['lavel1'] as $level1) { ?>
                                    <li class="item-vertical  style1 with-sub-menu hover">
                                       <p class="close-menu"></p>
                                       <a href="index.php?id=<?php echo $level1['categoryNum'];?>" class="clearfix">
                                       <span class="label"></span>
                                       <span><?php echo $level1['categoryName'];?></span>
                                       <b class="fa-angle-right"></b>
                                       </a>
                                       <?php if(isset($level1['lavel2'])) { 
                                    ?>
                                       <div class="sub-menu sub_menu_dropup" data-subwidth="40" style="right: 0px; width: 360px; display: none;">
                                          <div class="content" style="display: none;">
                                             <div class="row">
                                                <div class="col-md-12">
                                                   <div class="row">
                                                      <div class="col-md-12 static-menu">
                                                         <div class="menu">
                                                            <ul>
                                                              <?php foreach($level1['lavel2'] as $level2) { ?>
                                                               <li>
                                                                  <a href="index.php?id=<?php echo $level2['categoryNum']; ?>" class="main-menu"><?php echo $level2['categoryName']; ?> </a>

                                                                  <?php if(isset($level2['lavel3'])){

                                                                   ?>
                                                                  <ul>
                                                                    <?php foreach($level2['lavel3'] as $level3) { ?>
                                                                     <li><a href="index.php?id=<?php echo $level3['categoryNum']; ?>"><?php echo $level3['categoryName']; ?></a>
                                                                     </li>
                                                                     <?php } ?>                                 
                                                                  </ul>
                                                              <?php } ?>
                                                               </li>
                                                           <?php } ?>
                                                            </ul>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                   <?php  } ?>
                                    </li>

                                <?php } ?>
                                    <!-- <li class="item-vertical  style1 with-sub-menu hover">
                                       <p class="close-menu"></p>
                                       <a href="index.php?id=54" class="clearfix">
                                       <span class="label"></span>
                                       <span>HUNDAI</span>
                                       <b class="fa-angle-right"></b>
                                       </a>
                                       <div class="sub-menu sub_menu_dropup" data-subwidth="40" style="right: 0px; width: 360px; display: none;">
                                          <div class="content" style="display: none;">
                                             <div class="row">
                                                <div class="col-md-12">
                                                   <div class="row">
                                                      <div class="col-md-12 static-menu">
                                                         <div class="menu">
                                                            <ul>
                                                               <li>
                                                                  <a href="index.php?id=57" class="main-menu">ACCENT SEDAN 4DR 13-18</a>
                                                                  <ul>
                                                                     <li>
                                                                        <a href="index.php?id=61" class="main-menu">ACCENT</a>
                                                                        <ul>
                                                                           <li><a href="index.php?id=62">SEDAN 4 DR 13-18</a>
                                                                           </li>
                                                                        </ul>
                                                                     </li>
                                                                  </ul>
                                                               </li>
                                                            </ul>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </li>
                                    <li class="item-vertical  style1 with-sub-menu hover">
                                       <p class="close-menu"></p>
                                       <a href="index.php?id=25" class="clearfix">
                                       <span class="label"></span>
                                       <span>Toyota</span>
                                       <b class="fa-angle-right"></b>
                                       </a>
                                       <div class="sub-menu sub_menu_dropup" data-subwidth="40" style="right: 0px; width: 360px; display: none;">
                                          <div class="content" style="display: none;">
                                             <div class="row">
                                                <div class="col-md-12">
                                                   <div class="row">
                                                      <div class="col-md-12 static-menu">
                                                         <div class="menu">
                                                            <ul>
                                                               <li>
                                                                  <a href="index.php?id=29" class="main-menu">Camry Hybrid AVV50 4 Dr SEDAN 09/17 - </a>
                                                                  <ul>
                                                                     <li>
                                                                        <a href="index.php?id=30" class="main-menu">CAMRY ASV50  4Dr Sedan 10/15 - 9/17</a>
                                                                        <ul>
                                                                           <li>
                                                                              <a href="index.php?id=33" class="main-menu">CAMRY ASV50  HYBRID SEDAN 12-15</a>
                                                                              <ul>
                                                                                 <li>
                                                                                    <a href="index.php?id=34" class="main-menu">CAMRY AVV HYBRID 2011</a>
                                                                                    <ul>
                                                                                    </ul>
                                                                                 </li>
                                                                              </ul>
                                                                           </li>
                                                                        </ul>
                                                                     </li>
                                                                  </ul>
                                                               </li>
                                                            </ul>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </li>
                                    <li class="item-vertical  style1 with-sub-menu hover">
                                       <p class="close-menu"></p>
                                       <a href="index.php?id=26" class="clearfix">
                                       <span class="label"></span>
                                       <span>Mazda</span>
                                       <b class="fa-angle-right"></b>
                                       </a>
                                       <div class="sub-menu sub_menu_dropup" data-subwidth="40" style="display: none; right: 0px; width: 360px;">
                                          <div class="content" style="display: none;">
                                             <div class="row">
                                                <div class="col-md-12">
                                                   <div class="row">
                                                      <div class="col-md-12 static-menu">
                                                         <div class="menu">
                                                            <ul>
                                                               <li>
                                                                  <a href="index.php?id=56" class="main-menu"> 3 BM 13-18</a>
                                                                  <ul>
                                                                  </ul>
                                                               </li>
                                                            </ul>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </li> -->
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </nav>
               </div>
            </div>
         </div>
         <div>

          <div class="slideshow-container hidden-sm hidden-xs">
          <?php 

              foreach ($banners_result as $banners) { ?>

                  <!-- <img  src="<?php echo $banners['imageUrl'];?>" class="img-1 img-responsive" alt="image1"> -->
                  <div class="mySlides fade">
                  <!-- <div class="numbertext">1 / 3</div> -->
                  <img src="<?php echo $banners['imageUrl'];?>" style="width:100%;min-height: 150px;border: 1px solid #ddd;">
                  <!-- <div class="text">Caption Text</div> -->
                </div>

              <?php  } ?>

                </div>
                <div style="text-align:center;display: none;" >
                <span class="dot"></span> 
                <span class="dot"></span> 
                <span class="dot"></span> 
              </div>
         </div>
      </div>

            <div id="content" class="col-md-9 col-sm-8" style="background: white;border-radius: 5px;">

                <div class="products-category">

                    <!-- <h3 class="title-category ">Tool &amp; equipments</h3>

                    <div class="category-desc">

                        <div class="row">

                            <div class="col-sm-12">

                                <div class="banners">

                                    <div>

                                        <a href="#"><img src="image/catalog/demo/category/img-cate.jpg" alt="img cate"><br></a>

                                    </div>

                                </div>

                           </div>

                        </div>

                    </div> -->

                    <!-- Filters -->

                    <div class="product-filter product-filter-top filters-panel">

                        <div class="row">

                            <div class="col-md-5 col-sm-3 col-xs-12 view-mode">

                                   <div class="list-view">

                                        <button class="btn btn-default grid active" data-view="grid" data-toggle="tooltip" data-original-title="Grid"><i class="fa fa-th"></i></button>

                                        <button class="btn btn-default list" data-view="list" data-toggle="tooltip" data-original-title="List"><i class="fa fa-th-list"></i></button>

                                    </div>

                           </div>

                            <div style="display: none;" class="short-by-show form-inline text-right col-md-7 col-sm-9 col-xs-12">

                                <div class="form-group short-by">

                                    <label class="control-label" for="input-sort">Sort By:</label>

                                    <select id="input-sort" class="form-control" onchange="location = this.value;">

                                        <option value="" selected="selected">Default</option>

                                        <option value="">Name (A - Z)</option>

                                        <option value="">Name (Z - A)</option>

                                        <option value="">Price (Low &gt; High)</option>

                                        <option value="">Price (High &gt; Low)</option>

                                        <option value="">Rating (Highest)</option>

                                        <option value="">Rating (Lowest)</option>

                                        <option value="">Model (A - Z)</option>

                                        <option value="">Model (Z - A)</option>

                                    </select>

                                </div>

                                <div class="form-group">

                                    <label class="control-label" for="input-limit">Show:</label>

                                    <select id="input-limit" class="form-control" onchange="location = this.value;">

                                        <option value="" selected="selected">15</option>

                                        <option value="">25</option>

                                        <option value="">50</option>

                                        <option value="">75</option>

                                        <option value="">100</option>

                                    </select>

                                </div>

                            </div>

                            <!-- <div class="box-pagination col-md-3 col-sm-4 col-xs-12 text-right">

                                <ul class="pagination">

                                    <li class="active"><span>1</span></li>

                                    <li><a href="">2</a></li><li><a href="">&gt;</a></li>

                                    <li><a href="">&gt;|</a></li>

                                </ul>

                            </div> -->

                        </div>

                    </div>

                    <!-- //end Filters -->

                   <!--changed listings-->

                    <div class="products-list row nopadding-xs so-filter-gird grid">

<?php
$m = 0;
if (count($product_data) > 0) {

  foreach ($product_data as $product_arr) {

    $res = $myCategory->getItemDetails(accNum, $product_arr['menuNum']);

    $price = $stock = "";

    $discountType = $product_arr['discountType'];

    $imageTag =  "";
    $m++;

    if($m == 1)
    {
      $discountType = 4;
    }

    if(isset($specials_offrs[$discountType]))
    {
      if(!empty($specials_offrs[$discountType]['imageTag'])){
        $imageTag = 'https://ecommerce.staffstarr.com/its-admin/assets/images/special/'.accNum.'/'.$specials_offrs[$discountType]['imageTag'];
      }
    }

    // echo "<pre>";

    // print_r($res['varieties']);

    foreach ($res['varieties'] as $var_arr) {

      $price .= "<option>$".$var_arr['price']."</option>";

      // $stock = $res['varieties'][0]['stock'];

    }

    // echo "<hr><hr>";

    ?>

   <div class="product-layout col-lg-4 col-md-4 col-sm-6 col-xs-12">

        <div class="product-item-container item--static">

            <div class="left-block">

                <div class="product-image-container second_img">

                    <a href="javascript:void(0)" target="_self" title="Volup tatem accu" onclick="show_modal(<?php echo $product_arr['menuNum'];?>)">

                      <?php if($imageTag != ""){ ?>
                        <img  src="<?php echo $imageTag;?>" class="img_offer img-responsive" alt="image">
                      <?php } ?>
                        <img  src="<?php echo $product_arr['image'];?>" class="img-1 img-responsive" alt="image1">
                        <img src="<?php echo $product_arr['image'];?>" class="img-2 img-responsive" alt="image2">
                    </a>

                </div>

                <!-- <span class="label-product label-new">New</span> -->

                <!--quickview-->

                <div class="so-quickview">

                  <a  style="display: none !important;" class="iframe-link btn-button quickview quickview_handler visible-lg" href="quickview.html" title="Quick view" data-fancybox-type="iframe"><i class="fa fa-search"></i><span>Quick view</span></a>

                </div>

                <!--end quickview-->

            </div>

            <div class="right-block">

                <div class="button-group cartinfo--static">

                   <button type="button" style="display: none;" class="wishlist btn-button" title="Add to Wish List" onclick="wishlist.add('60');"><i class="fa fa-heart"></i></button>

                    <button type="button" class="addToCart" title="View Details" onclick="show_modal(<?php echo $product_arr['menuNum'];?>)">

                        <span>View Details </span>

                    </button>

                    <button style="display: none;" type="button" class="compare btn-button" title="Compare this Product " onclick="compare.add('60');"><i class="fa fa-refresh"></i></button>
                </div>

                <h4><a href="javascript:void(0)" title="<?php echo $product_arr['menuName']; ?>" target="_self"><?php echo substr($product_arr['menuName'],0,15); echo (strlen($product_arr['menuName']) > 15 ? "..." : ""); ?></a></h4>

                <?php //$product_arr['description'].=$product_arr['description'].$product_arr['description']; ?>

                <h5><a href="javascript:void(0)" title="<?php echo $product_arr['description']; ?>" target="_self"><?php echo substr($product_arr['description'],0,80); echo (strlen($product_arr['description']) > 80 ? "..." : ""); ?></a></h5>

                <div class="rating" style="display: none;">    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>

                    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>

                    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>

                    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>

                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>

                </div>

                <div class="price" style="display: none;">

                    <select class="form-control"><?php echo $price;?></select>

                  <!-- <span class="price">$<?php echo $price;?></span> -->

                </div>

                <div class="description item-desc hidden">

                    <p>Part No. : <?php echo ($product_arr['Calories'] != null ? $product_arr['Calories'] : "NA");?></p>
                    <p><?php echo $product_arr['description'];?></p>

                </div>

                <div class="list-block hidden">

                    <button class="addToCart btn-button"  type="button" title="View Details" onclick="show_modal(<?php echo $product_arr['menuNum'];?>)"><i class="fa fa-eye"></i>

                    </button>

                    <button class="wishlist btn-button" style="display: none;" type="button" title="Add to Wish List" onclick="wishlist.add('101');"><i class="fa fa-heart"></i>

                    </button>

                    <button class="compare btn-button" style="display: none;" type="button" title="Compare this Product" onclick="compare.add('101');"><i class="fa fa-refresh"></i>

                    </button>

                    <!--quickview-->

                    <a style="display: none !important;" class="iframe-link btn-button quickview quickview_handler visible-lg" href="quickview.html" title="Quick view" data-fancybox-type="iframe"><i class="fa fa-eye"></i></a>

                    <!--end quickview-->

                </div>

            </div>

        </div>

    </div>

    <?php }

} else {

  echo "<div style='padding:15px; font-size:18px; min-height:230px;'> Sorry no product found in this category </div>";
}

?>
</div>

                    <!--// End Changed listings-->

                    <!-- Filters -->

                    <div class="product-filter product-filter-bottom filters-panel" style="display: none;">

                        <div class="row">

                            <div class="col-sm-6 text-left"></div>

                            <!-- <div class="col-sm-6 text-right">Showing 1 to 12 of 12 (1 Pages)</div> -->

                        </div>

                    </div>

                    <!-- //end Filters -->

               </div>

           </div>

            </div>

            </div>

      </header>

      <!-- //Header Container  -->





<div id="myModal" class="modal fade" role="dialog" style="z-index: 99999;height:100%;background-color: rgba(0, 0, 0, 0.23);">

  <div class="modal-dialog" style="height: auto;overflow: scroll;">

   <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" onclick="close_modal()" data-dismiss="modal">&times;</button>

        <h4 class="modal-title"></h4>

        <div class="col-md-3">

          <img style="height:125px;" id="menu_image" src="">

        </div>

        <div class="col-md-9">

          <h2 class="modal-title titleModal"></h2>
          <span class="calories">Part No. : </span>

          <p class="menudesc"> </p>

        </div>

      </div>

      <div class="modal-body">



               <p class="ingredients">

                  <span class="ingre" id='inline_ingredients'>Choose a Color,Choose thickness</span></p>

               <div id="response_msg" class="alert alert-success col-sm-12 mt-3" role="alert" style="display: none;color: red;">

                   <a href="#" class="modal_close close" onclick="close_modal()" data-dismiss="alert">×</a>

                   <div class="res_msg"></div>

               </div>

               <form id="menuAddToCart" action="" method="POST">

                   <div class=" col-md-12 form-group menu-item-cart " id="menu_varient_data" style="display: none;">

                       <div class="row" id="quan" name="variety">

                         <div class=" col-md-12 col-sm my-1 varient_data">

                        </div>

                       </div>

                   </div>

                   <!-- Quantity start -->

                   <div class="form-group d-flex menu-item-cart">

                       <div class="mr-auto p-2" style="padding-left: 30px;">

                           <label style="font-size: 14px;">Quantity</label>

                         <p style="display: inline-block;float: right; margin: 0;font-size: 20px;margin-right: 30px;border: 1px solid #ddd;border-right: none;">

                           <button type="button" class="sub btn rounded bg-danger btn-sm text-white" onclick="sub_quantity()"><strong style="font-size: 14px;">  &nbsp;-  </strong></button>

                           <input type="text" value="1" min="1" max="20" name="qty" id="qty" style="font-size: 20px; width: 40px;text-align: center;border: none;" readonly="">

                           <button type="button" class="add btn rounded bg-primary btn-sm text-white" onclick="add_quantity()"><strong style="font-size: 14px;">+</strong></button>

                         </p>

                       </div>

                   </div>

                   <!-- add extra options start -->

                   <!-- <div class="form-group d-flex">

                         <div class="mr-auto p-2"> -->

                 <div class="form-group d-flex menu-item-cart " id="menu_add_extra" style="display: none;">

                   <div class="form-group">

                           <p class="add_extra">Add Extra</p>

                  </div>

                   <div class="add_extra_menu">

                  </div>

                 </div>

                   <div class="form-group " style="margin-top: 20px; margin-bottom: 20px;">

                      <div class="">

                           <textarea name="note" rows="3" style="font-size: 14px;resize: none;border: 1px solid #e2dddd;padding: 20px;" class="form-control" placeholder="Add Note"></textarea>

                       </div>

                   </div>

                  <input type="hidden" name="activeTable" id="activeTable" value="0">

                   <input type="hidden" name="activeDepartment" id="activeDepartment" value="0">

                   <input type="hidden" name="menuNum" id="menuNum" value="0">

                   <input type="hidden" name="totalPrice" id="totalPrice" value="0">

                   <div class="form-group d-flex">

                     <a href="javascript:void(0)" id="btn_addToCart" onclick="addToCart();" style="color: #ffffff;">

                        <div class="image-button-wrapper" style="padding: 10px;color: white;background-color: #171717;margin-top: 20px;margin-bottom: 20px;width: 100%;float: left;">
                          <div class="image-button sqs-dynamic-text">

                            <div class="image-button-inner">

                              <p class="pull-left" style="width: 30%; display: inline-block;"><span class="mquan">1</span> ITEM</p>

                              <p class="pull-left offset-sm-4" style="width: 30%; display: inline-block; text-align: center;">ADD TO CART</p>

                              <p class="pull-right offset-sm-3" style="width: 30%; display: inline-block; text-align: right;">$<span class="mprice">0</span></p>

                            </div>
                          </div>
                        </div>
                      </a>

                      <a href="javascript:void(0)" id="btn_outOfStock"  style="color: #ffffff; display: none;cursor: not-allowed;">

                        <div class="image-button-wrapper" style="padding: 10px;color: white;background-color: #171717;margin-top: 20px;margin-bottom: 20px;width: 100%;float: left;">
                          <div class="image-button sqs-dynamic-text">

                            <div class="image-button-inner">

                              <!-- <p class="pull-left" style="width: 30%; display: inline-block;"><span class="mquan">1</span> ITEM</p> -->

                              <p class="pull-left" style="width: 100%; margin-bottom:0; display: inline-block; text-align: center; color: red; font-size: 20px; margin-bottom: 0; ">OUT OF STOCK</p>

                              <!-- <p class="pull-right offset-sm-3" style="width: 30%; display: inline-block; text-align: right;">$<span class="mprice">0</span></p> -->

                            </div>
                          </div>
                        </div>
                      </a>

                   </div>



               </form>

      </div>

    </div>

 </div>

</div>

      
       

<!-- Main Container  -->
      </div>

      <!-- //Main Container -->

     

<!-- Footer Container -->

     <?php require_once "footer.php"; ?>
<script>
var slideIndex = 0;
showSlides();

//setInterval(showSlides(), 300);

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 5000); // Change image every 2 seconds
}
</script>