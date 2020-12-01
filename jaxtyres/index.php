

<!-- Font Awesome -->
<!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"> -->
<?php
   require_once "header.php";
   
   //require_once "getdata/autopart_data.php";
   //$myCategory = new Category();
   // echo ($HTTP_HOST."ajax_autopart.php?action=getSpecials"); die;
   $specials_json=file_get_contents($HTTP_HOST."ajax_autopart.php?action=getSpecials");
   //print_r($specials_json); die;
   $specials=json_decode($specials_json,true);
   
   //$specials = $myCategory->getSpecials(accNum);
   $specials_offrs = $_SESSION['specials'];
   
    $data_Cat_json=file_get_contents($HTTP_HOST."ajax_autopart.php?action=getCategoryTreeView");
    $data_Cat=json_decode($data_Cat_json,true);
   
   //$data_Cat = $myCategory->getCategoryTreeView(accNum);
   
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
   
   $cat_id = 29;
   
   if (isset($_GET['id'])) {
   $cat_id = $_GET['id'];
   }
   
   
   
   // $allMenuIds = $myCategory->getAllMenuIdAccount(accNum, $cat_id);
   
   // $menu_ids = implode(",", $allMenuIds);
   
   // setcookie("cart_items", "", time() - 3600);
   //    unset($_SESSION);
   
   // print_r($_SESSION);
   // print_r($_COOKIE);
   
   //echo ($HTTP_HOST."ajax_autopart.php?action=getMenuItems&categoryNum=".$cat_id);die;
   $product_data_json=file_get_contents($HTTP_HOST."ajax_autopart.php?action=getMenuItems&categoryNum=".$cat_id);
   $product_data=json_decode($product_data_json,true);
   
   // print_r($product_data);die;
   //$product_data = $myCategory->getMenuItems(accNum, $menu_ids);
   
   if (isset($_GET['test1'])) {
   
   echo '<pre>';
   
   print_r($product_data);
   
   die;
   
   }
   
   
   $banners_result = array();
   
   ?>
<style type="text/css">
   .header-bottom {
   margin-top: 10px;
   }
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
   .product-item-container:hover .second_img .img-1 {
   opacity: 1;
   }
   .table > tbody > tr > td {
   color:gray;
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
   /*  model table */
   tr, td {
   padding: 15px;
   }
   tbody td {
   text-align: left;
   }
   /*#header{
   background: transparent;
   }
   #header{
   background-image: url(assets/used-car-parts-Perth.jpg);
   background-position: bottom center;
   background-size: cover;
   background-repeat: no-repeat;
   }*/ 
   #header{
   /* background-image: linear-gradient(to bottom, rgba(3, 15, 84, 0.51), rgba(19, 16, 18, 0.36)),url(assets/used-car-parts-Perth.jpg);*/
   /*background-image: url("assets/used-car-parts-Perth.jpg"), linear-gradient(top to bottom, red, yellow);*/
   }
   @media (min-width: 1200px){
   .menu_container {
   margin-top: 50px;
   }
   }
   .level3_menu{
   font-size: 12px;
   }
   .main-menu{
   color: black !important;
   }
   .middle-right {
   background-color: transparent !important;
   }
   header .dropdown-menu {
   padding: 10px 20px;
   margin: 0;
   margin-top: 0px;
   min-width: max-content;
   box-shadow: 0 0px 10px 0px rgba(0, 0, 0, 0.2);
   left: 0 !important;
   left: auto;
   border-radius: 0;
   border-top-left-radius: 0px;
   border-top-right-radius: 0px;
   }
   .btn-header{
   padding: 12px 10px;
   color: #fff;
   background-color: #ff2d37;
   border: none;
   border-radius: 6px;
   width: 100%;
   }
   .header_text_div{
   font-size: 42px;
   line-height: 1;    
   text-align: center;
   color: #fff; 
   border-radius: 15px;
   padding: 10px; 
   text-align: center;
   text-shadow: 0 0 5px #222;
   }
   .chosen-container{
   width: 100% !important;
   }
   .chosen-container-single .chosen-single {
   padding: 7px 0px 0px 8px;
   height: 45px;
   }
   .chosen-container-active.chosen-with-drop .chosen-single div b {
   background-position: -18px 11px;
   }
   .chosen-container-single .chosen-single div b {
   background: url(chosen-sprite.png) no-repeat 0 10px;
   }
   .tab-content>.active {
   background: transparent;
   }
   @media screen and (max-width: 769px){
   .header_text_div {
   font-size: 28px;
   }
   .level3_menu{
   padding: 5px 15px 5px 25px;
   }
   .main-menu{
   color: #9d9d9d !important;
   }
   }
   @media screen and (max-width: 425px){
   .header_text_div {
   font-size: 18px;
   }
   .btn-header{
   font-size: 12px;
   }
   }
   a { 
   list-style-type: none;
   color:#fff;
   } 
   #sp2_data
   {
   width: 470px !important;
   height: 40px !important;
   }
   .nav-tabs>li>a {
   border: 1px solid #ddd;
   border-bottom-color: transparent;
   border-radius: 4px 4px 0 0;
   background-color: rgba(200, 188, 188, 0.2);
   } 
   /* multiple slider */
   /* img{
   width: 100%;
   }
   #exampleSlider .MS-content .item {
   border: none;
   }
   #exampleSlider .MS-content {
   border: none;
   }*/
   .item_name{
   font-weight: 600;
   font-size: 16px;
   }
   .item_description{
   font-size: 12px;
   color:gray;
   }

   #exampleSlider {
      border: none !important;
  }

  #exampleSlider .MS-content {
    
    border: none !important;
}
 #exampleSlider .MS-content .item {
    
    border: none !important;
}

#exampleSlider .MS-controls button {
  
    top: 40%;
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

   function getSpecification(menu_id)
   {
     // alert(menu_id);
       $.ajax({
   
                  type: 'POST',
   
                 url: 'ajax_autopart.php?action=getSpecification',
   
                 data: {menu_id:menu_id},
   
                 success: function (response) {
                   // alert(response);
                    obj = $.parseJSON(response);
                    sp_details = obj.sp_details;

                    sp1= sp_details[0]['sp1'];
                    sp2= sp_details[0]['sp2'];
                    sp3= sp_details[0]['sp3'];
                    sp4= sp_details[0]['sp4'];
                    sp5= sp_details[0]['sp5'];
                    sp6= sp_details[0]['sp6'];

                      $("#width_val").html(sp1);
                      $("#ratio_val").html(sp2);
                      $("#rim_val").html(sp3);
                      $("#load_val").html(sp4);
                      $("#rating_val").html(sp5);
                      $("#fitment_val").html(sp6);
                    // alert(sp1);
                 }
   });
 }
   
   function show_modal (menu_id) {

    mprice_val = 0;
     $.post("ajax_autopart.php?action=getMenudetails&menuNum="+menu_id, {},
   
       function (data) {
   
             // alert(data);
   
          $.post("ajax_autopart.php?action=getOpenInvoiceId", {},
         function (invoice_id_return) {
          $("#invoice_id").val(invoice_id_return);
         });
   
          obj = $.parseJSON(data);
   
         menu = obj.menu;
   
         $(".titleModal").text(menu[0]['menuName']);
          // $('.mprice').html(menu[0]['price']);
   
          var calories = "NA";
   
          if(menu[0]['Calories'] != null)
          {
   
            calories = menu[0]['Calories'];
          }
   
          $(".calories").text("Part No. : "+calories);
   
         $(".menudesc").html(menu[0]['description']);
         var img=menu[0]['image'];
   
         // var img_url=img.replace("ecom-admin", "my-store");
   
         $("#menu_image").attr('src',img);
   
   
          // var img = img_url.replace("ecom-admin", "my-store");
         var varieties = obj.varieties;
   
         var text_data = "";
   
          if(varieties.length > 0){
   
           for( i =0; i < varieties.length; i++ )
   
           {
   
             text_data+='<div class="col pretty p-switch p-fill p-2  col-md-6 col-sm-12" ><input type="hidden" value="'+varieties[i]['stock']+'" name="" id="in_stock_'+varieties[i]['varietyNum']+'" ><label style="font-size:14px;"><input style="display:none;visibility:hidden;opacity:0" checked  type="radio" class="menuVariety_cls" name="variety" data-price="'+varieties[i]['price']+'" id="'+varieties[i]['varietyNum']+'" value="'+varieties[i]['varietyNum']+'" onclick="getMenuVarietyPrice(this)"> </label></div>';
            
               mprice_val = parseInt(varieties[i]['price'])+parseInt(mprice_val); 
           
   
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
   
         // $('.mprice').html(0);
         $('.mprice').html(mprice_val);
         $('#unit_price').val(mprice_val);
   
         $('.mquan').html(1);
   
         $('#qty').val(1);
   
         $("#menuNum").val(menu_id);
   
         $('#totalPrice').val(mprice_val);
   
         $('#myModal').fadeIn();
   
          $('#myModal').addClass("in");

    
   
       
   
     });
    getSpecification(menu_id);
   $(".menuVariety_cls").click();
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
                    // alert(response);
   
                    var obj=JSON.parse(response);
                      var $invoice_id=obj['invoice_id'];
                      var   $item_it=obj['item_id'];
   
                      $("#invoice_id").val($invoice_id);
   
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
   // alert(el_id);
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
   
           // alert(data);
   
           //alert(status);
   
           prc = parseInt(data);
           // alert(prc);
         $("#unit_price").val(prc);
   
   
   
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
<script type="text/javascript">
   $(document).ready(function(){
   $(".chosen_sp1").chosen();
   })
   $(document).ready(function(){
   $(".chosen_sp2").chosen();
   //jQuery(function($){ $('.chosen_slc').chosen(); });
   })
   
   $(document).ready(function(){
   $(".chosen_sp3").chosen();
   })
   
    $(".chosen_sp1").chosen({no_results_text: "Oops, nothing found!"});
    $(".chosen_sp2").chosen({no_results_text: "Oops, nothing found!"});
    $(".chosen_sp3").chosen({no_results_text: "Oops, nothing found!"});
    
</script>
<script>
   get_sp1();
   // get_sp2();
   // get_sp3();
   
   // function get_other_items(id){
   //  var sp1 =  $("#sp1_data").val();
   //  var sp2= $("#sp2_data").val();
   //  var sp3=$("#sp3_data").val();
   //  var prev_sp1 =  $("#sp1_prev").val();
   //  var prev_sp2= $("#sp2_prev").val();
   //  var prev_sp3=$("#sp3_prev").val();
   //  if(sp1 == "")
   //  {
   //     get_sp1();
   //  }else{
   //    //alert("hi");
   //     $("#sp1_data").attr("readonly", true);
   //  }
   //  if(sp2 == "")
   //  {
   //     get_sp2();
   //  }else{
   //     $("#sp2_data").attr("readonly", true);
   //  }
   //  if(sp3 == "")
   //  {
   //     get_sp3();
   //  }else{
   //     $("#sp3_data").attr("readonly", true);
   //  }
   
   //  // if(id == 1)
   //  // {
   //  //  if(prev_sp1 != sp1){
   //  //    get_sp2();
   //  //    get_sp3();
   //  //  }
   //  // }
   //  // if(id == 2)
   //  // {
   //  //   get_sp1();
   //  //   get_sp3();
   //  // }
   //  // if(id == 3)
   //  // {
   //  //   get_sp1();
   //  //   get_sp2();
   //  // }
   // }
     function get_sp1()
     {
         //var sp2= $("#sp2_data").val();
         //var sp3=$("#sp3_data").val();
   
         $.ajax
         ({
              type: 'POST',
   
              url: 'ajax_autopart.php?action=get_sp1',
   
              data:{ },
              success: function (response) {
                 // alert(response);
   
                 data = $.parseJSON(response);
   
                 var sp1_options = "<option value=''></option>";
                 //var sp1_options = "";
   
                 for(var i = 0; i< data['sp1'].length; i++)
                 {
                     sp1_options+="<option>"+ data['sp1'][i]+"</option>";
                 }
   
                 //alert(sp1_options);
                  $('#sp1_data').removeAttr("disabled");
                 $("#sp1_data").html(sp1_options);
   
                 $('.chosen_sp1').trigger("chosen:updated");
   
                 
              }
         });
     }
   
   function get_sp2()
   {
     var sp1= $("#sp1_data").val();
     // var sp3=$("#sp3_data").val();
   
     $.ajax
     ({
        type: 'POST',
   
              url: 'ajax_autopart.php?action=get_sp2',
   
              data:{ sp1: sp1, },
              success: function (response) {
               // alert(response);
   
               data = $.parseJSON(response);
   
               var sp2_options = "<option value=''></option>";
               // var sp2_options = "";
   
               for(var i = 0; i< data['sp2'].length; i++)
               {
                 sp2_options+="<option>"+ data['sp2'][i]+"</option>";
               }
   
               //alert(sp2_options);
                  $('#sp2_data').removeAttr("disabled");
               $("#sp2_data").html(sp2_options);
               $('.chosen_sp2').trigger("chosen:updated");
                 // $(".chosen_sp2").chosen("destroy");
   
              }
     });
   }
   
   function get_sp3()
   {
     var sp2= $("#sp2_data").val();
     var sp1=$("#sp1_data").val();
   
     $.ajax
     ({
        type: 'POST',
   
              url: 'ajax_autopart.php?action=get_sp3',
   
              data:{ sp2: sp2, sp1: sp1 },
              success: function (response) {
               // alert(response);
   
               data = $.parseJSON(response);
   
               var sp3_options = "<option value=''></option>";
   
               for(var i = 0; i< data['sp3'].length; i++)
               {
                 sp3_options+="<option>"+ data['sp3'][i]+"</option>";
               }
                    $('#sp3_data').removeAttr("disabled");
                  $("#sp3_data").html(sp3_options);
                 $('.chosen_sp3').trigger("chosen:updated");
              }
     });
   }
   function Getsp123_data()
   {
     
     var sp1=$("#sp1_data").val();
     var sp2= $("#sp2_data").val();
     var sp3=$("#sp3_data").val();
   
     //alert("hi");
     $.ajax({
       type:'POST',
       url:'ajax_autopart.php?action=GetSpData',
       data:{ sp1:sp1,sp2:sp2,sp3:sp3},
       success:function(response){
   
                    // alert(response);
                var res_item_cat = $.parseJSON(response);
   
                var item_cate_string = "";
                if(res_item_cat.length>0)
                {
                for(var i=0;i<res_item_cat.length;i++)
                {
                 res_item_cat1 = res_item_cat[i];
   
                 price = res_item_cat1["min_price"];
   
                 img_url = res_item_cat1["image"];
                 // alert(img_url);
   
                 // var img="";
   
                 // if(img_url!='null')
                 // {
   
                 //    var img = img_url.replace("ecom-admin", "my-store");
                 //  }
                 //price = price.toFixed(2);
                 // c
                 //item_cate_string+='<div class="col-lg-4 col-md-4"  ><div class="menu-item menu-grid-item"><img style="padding: 12px; margin-left:auto; margin-right:auto;  width:50%;" class="mb-4" src="'+img+'" alt=""><h6 class="font-weight-bold"><strong>'+res_item_cat1["menuName"]+'</strong></h6> <span class="text-muted text-sm">'+res_item_cat1["description"]+'</span> <div class="row align-items-center mt-4"> <div class="col-sm-6"><span class="text-md mr-4"><span class="text-muted text-sm">Min price</span> $'+price+'</span></div><div class="col-sm-6 text-sm-right mt-2 mt-sm-0"><button class="btn btn-outline-secondary btn-sm" data-target="#productModal" data-toggle="modal" onclick="show_modal('+res_item_cat1["menuNum"]+');"><span>Add to cart</span></button></div></div></div></div>';
   
                 item_cate_string+='<div class="product-layout col-lg-4 col-md-4 col-sm-4 col-xs-12"><div class="product-item-container item--static"><div class="left-block"><div class=""><a href="javascript:void(0)" target="_self" title="Volup tatem accu" onclick="show_modal('+res_item_cat1["menuNum"]+')"> <img  src="'+img_url+'" class="img-1 img-responsive" alt="image"></a></div><div class="item_name">'+res_item_cat1["info1"]+'</div><div class="item_description item-desc "><p>'+res_item_cat1["description"]+'</p></div><div class="item_description" style="">Price-$'+res_item_cat1["min_price"]+'</div><div class="list-block hidden"><button class="addToCart btn-button"  type="button" title="View Details" onclick="show_modal('+res_item_cat1["menuNum"]+')"><i class="fa fa-eye"></i></button></div> <div class="so-quickview"></div></div><div class="right-block" style="margin-top: 5px;"><div ><button type="button" class="btn-header btn btn-primary" title="View Details" onclick="show_modal('+res_item_cat1["menuNum"]+')"><span>View Details </span></button></div></div></div></div> ';
   
                 // <div style="text-align:center; padding:5px;">Qty-<select style="padding:5px 10px"><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option></select></div>
               }
                  $(".products-list").html(item_cate_string);
             }
   
       }
   
     });
   
   }
</script>
<div class="header-bottom hidden-compact">
   <div class="container menu_container" style="text-align: center">
      <div class="row">
         
         <div id="content" class="col-md-12 col-sm-12" style="background: white;border-radius: 5px;">
            <div class="products-category">
               
            </div>
         </div>
         <div class="container" style="" >
            <div class="row"  style=>
               <div class="col-md-4" style="border:">
                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                     <!-- Indicators -->
                     <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                     </ol>
                     <!-- Wrapper for slides -->
                     <div class="carousel-inner">
                        <div class="item active">
                           <img src="banner/TEYSEER%20TYRE%20CAMPAIGN%20ENG.jpg"  style="width:100%;">
                        </div>
                        <div class="item">
                           <img src="banner/michelin-promotion_1024x1024.jpg" style="width:100%;">
                        </div>
                        <div class="item">
                           <img src="banner/MICHELIN_REBATE_PROMO_1024x1024.jpg" style="width:100%;">
                        </div>
                     </div>
                     <!-- Left and right controls -->
                     <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                     <span class="glyphicon glyphicon-chevron-left"></span>
                     <span class="sr-only">Previous</span>
                     </a>
                     <a class="right carousel-control" href="#myCarousel" data-slide="next">
                     <span class="glyphicon glyphicon-chevron-right"></span>
                     <span class="sr-only">Next</span>
                     </a>
                  </div>
                  
               </div>
               <div class="col-md-8">
                  <ul class="nav nav-tabs">
                     <li class="active"><a data-toggle="tab" href="#home">Search by Tyre Size</a></li>
                     <li><a data-toggle="tab" href="#menu"> Search by Rego</a></li>
                     <li><a data-toggle="tab" href="#menu"> Search by Vehicle</a></li>
                  </ul>
                  <div class="tab-content">
                     <div id="home" class="tab-pane fade in active">
                        <form Action="" method="POST" >
                           <div class="row" style="margin-top: 15px;margin-bottom: 15px;text-align: center; padding: 50px;">
                              <div class="col-md-3">
                                 <select data-placeholder="Choose SP-1..." class="mdb-select md-form chosen_sp1" style="" onchange="get_sp2()" id="sp1_data" disabled="true">
                                    <option value=""></option>
                                 </select>
                              </div>
                              <div class="col-md-3">
                                 <select  data-placeholder="Choose SP-2..." id="sp2_data" class=" chosen_sp2" onchange="get_sp3()" style="" disabled="true" >
                                    <option value=""></option>
                                 </select>
                              </div>
                              <div class="col-md-3">
                                 <select data-placeholder="Choose SP-3..." id="sp3_data" class=" chosen_sp3" style=""  disabled="true">
                                    <!-- <option value="">SP-3</option> -->
                                 </select>
                              </div>
                              <div class="col-md-3">
                                 <button style=""  type="button" placeholder="Search" aria-label="Search" name="search" onclick="Getsp123_data()" id="submit" class="btn-header btn btn-primary">Submit</button>
                              </div>
                           </div>
                        </form>
                     </div>
                     <div id="menu1" class="tab-pane fade">
                        <p></p>
                     </div>
                     <div id="menu2" class="tab-pane fade">
                        <p></p>
                     </div>
                  </div>
                  <div class="products-list row nopadding-xs so-filter-gird grid" style="padding: 15px;">
                  </div>
               </div>
            </div>
         </div>

          <div class="container">
             <div class="row">
                <div id="exampleSlider">
                   <div class="MS-content">
                      <div class="item">
                         <img src="banner/TEYSEER%20TYRE%20CAMPAIGN%20ENG.jpg">
                      </div>
                      <div class="item">
                         <img src="banner/EricksenHonda_Z8-set-special_19-500x707.jpg">
                      </div>
                      <div class="item">
                         <img src="https://www.murphystyrepower.com.au/images/specials/Continental-Flipbook-3_small.jpg">
                      </div>
                      <div class="item">
                         <img src="https://www.murphystyrepower.com.au/images/specials/Continental-Flipbook-3_small.jpg">
                      </div>
                      <div class="item">
                         <img src="banner/michelin-promotion_1024x1024.jpg">
                      </div>
                      <div class="item">
                         <img src="banner/TEYSEER%20TYRE%20CAMPAIGN%20ENG.jpg">
                      </div>
                      <div class="item">
                         <img src="banner/michelin-promotion_1024x1024.jpg">
                      </div>
                      <div class="item">
                         <img src="banner/MICHELIN_REBATE_PROMO_1024x1024.jpg">
                      </div>
                      <div class="item">
                         <img src="https://www.murphystyrepower.com.au/images/specials/Continental-Flipbook-3_small.jpg
                         ">
                      </div>
                      <div class="item">
                         <img src="banner/TEYSEER%20TYRE%20CAMPAIGN%20ENG.jpg">
                      </div>
                   </div>
                   <div class="MS-controls">
                      <button class="MS-left"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
                      <button class="MS-right"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>
                   </div>
                </div>
             </div>
          </div>


         
      </div>
   </div>
</div>
</div>
<div id="myModal" class="modal fade" role="dialog" style="z-index: 99999;height:100%;background-color: rgba(0, 0, 0, 0.23);">
   <div class="modal-dialog modal-lg" style="height: auto;overflow: scroll;width: 100%;">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" onclick="close_modal()" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" ></h4>
            <div class="container">
               <div class="row">
                  <div class="col-md-6" style="border-right: 1px solid #c1abab;">
                     <h3>Description</h3>
                     <p style="text-align: justify;text-justify:initial;color: gray;">
                        Achilles Desert Hawk X- MT is an incredible 'Extreme Mud Terrain' tyre designed from the ground up to go places no ordinary tyre would dare.This tyre is a super-aggressive off road tyre featuring incredibly rigid high load construction and a unique block design.3 PLY sidewall, side blocks and a self cleaning pattern ensure the X-MT meanbusiness.An amazing new tyre for  off-road enthusiasts and anyone wanting the ultimate off-road performance.
                     </p>
                     <h2 class="pgTyDtl-productSpecTitle u-clr--xxxdk0">Specifications</h2>
                     <table class="table">
                        <tbody>
                           <tr>
                              <td>Width</td>
                              <td id="width_val"></td>
                           </tr>
                           <tr>
                              <td>Ratio</td>
                              <td id="ratio_val"></td>
                           </tr>
                           <tr>
                              <td>Rim</td>
                              <td id="rim_val"></td>
                           </tr>
                           <tr>
                              <td>Load</td>
                              <td id="load_val"></td>
                           </tr>
                           <tr>
                              <td>Rating</td>
                              <td id="rating_val"></td>
                           </tr>
                           <tr>
                              <td>Fitment</td>
                              <td id="fitment_val"></td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
                  <div class="col-md-6" >
                     <div class="col-md-3">
                        <img style="height:125px;" id="menu_image" src="">
                     </div>
                     <div class="col-md-7">
                        <h2 class="modal-title titleModal" style="text-align: center"></h2>
                        <p class="calories" style="text-align: center;color: gray;">Part No. : </p>
                        <p class="menudesc" style="text-align: center;color: gray;"> </p>
                     </div>
                     <div class="modal-body">
                        <p class="ingredients">
                           <span class="ingre" id='inline_ingredients'>Choose a Color,Choose thickness</span>
                        </p>
                        <div id="response_msg" class="alert alert-success col-sm-12 mt-3" role="alert" style="display: none;color: red;">
                           <a href="#" class="modal_close close" onclick="close_modal()" data-dismiss="alert">×</a>
                           <div class="res_msg"></div>
                        </div>
                        <form id="menuAddToCart" action="" method="POST">
                           <!--  <div class=" col-md-12 form-group menu-item-cart " id="menu_varient_data" style="display: none;"> -->
                           <!-- <div class="row" id="quan" name="variety"> -->
                           <div class=" col-md-12 col-sm my-1 varient_data">
                              <!-- </div> -->
                           </div>
                           <!-- </div> -->
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
                           <!--    <div class="form-group " style="margin-top: 20px; margin-bottom: 20px;">
                              <div class="">
                              
                                   <textarea name="note" rows="3" style="font-size: 14px;resize: none;border: 1px solid #e2dddd;padding: 20px;" class="form-control" placeholder="Add Note"></textarea>
                              
                               </div>
                              
                              </div> -->
                           <input type="hidden" name="unit_gst" id="unit_gst" value="0">
                           <input type="hidden" name="percentage" id="percentage" value="0">
                           <input type="hidden" name="unit_price" id="unit_price" value="0">
                           <input type="hidden" name="activeTable" id="activeTable" value="0">
                           <input type="hidden" name="activeDepartment" id="activeDepartment" value="0">
                           <input type="hidden" name="menuNum" id="menuNum" value="0">
                           <input type="hidden" name="totalPrice" id="totalPrice" value="0">
                           <input type="hidden" name="invoice_id" id="invoice_id" value="0">
                           <div class="form-group d-flex">
                              <a href="javascript:void(0)" id="btn_addToCart" onclick="addToCart();" style="color: #ffffff;">
                                 <div class="image-button-wrapper" style="padding: 10px;color: white;background-color: #171717;margin-top: 20px;margin-bottom: 8px;width: 100%;float: left;">
                                    <div class="image-button sqs-dynamic-text">
                                       <div class="image-button-inner">
                                          <p class="pull-left" style="width: 30%; display: inline-block;"><span class="mquan">1</span> ITEM</p>
                                          <p class="pull-left offset-sm-4" style="width: 30%; display: inline-block; text-align: center;">ADD TO CART</p>
                                          <p class="pull-right offset-sm-3" style="width: 30%; display: inline-block; text-align: right;">$<span  class="mprice">0</span></p>
                                       </div>
                                    </div>
                                 </div>
                              </a>
                              <div>                   
                                 <img src="https://image.shutterstock.com/z/stock-vector-tire-car-advertisement-poster-information-store-action-landscape-poster-digital-banner-flyer-1301106034.jpg">
                              </div>
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
                           </div>
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
</div>
</div>
</div>
</div>
<!-- Footer Container -->
<?php //require_once "footer.php"; ?>
<!-- Include jQuery -->
<!-- <script src="js/jquery-2.2.4.min.js"></script> -->
<!-- Include Multislider -->
<script src="sliderCss/multislider.min.js"></script>

<!-- Initialize element with Multislider -->
<script>
   $('#exampleSlider').multislider({
      interval: 4000,
       slideAll: true,
      duration: 1500
   });
</script>
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

