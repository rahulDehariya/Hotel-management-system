<?php
require_once "getdata/autopart_data.php";

$myCategory = new Category();

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

//     if($action == "getMenuVarietyPrice"){

// $varietyNum = $_GET['varietyNum'];

// $price = $myCategory->getVarietiesdata($varietyNum);

// echo $price;

// }

//

require_once "header.php";
?>
 <style type="text/css">

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

      </style>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script type="text/javascript">



      var IS_EXTRA_COMPULSORY = <?php echo IS_EXTRA_COMPULSORY;
?>;






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

            alert(data);

            obj = $.parseJSON(data);



            menu = obj.menu;



            $(".titleModal").text(menu[0]['menuName']);

            var calories = "NA";

            if(menu[0]['Calories'] != null)
            {

              calories = menu[0]['Calories'];
            }

            $(".calories").text("Part No. : "+calories);



            $(".menudesc").text(menu[0]['description']);



            $("#menu_image").attr('src',menu[0]['image']);



            var varieties = obj.varieties;



            var text_data = "";



             if(varieties.length > 0){



              for( i =0; i < varieties.length; i++ )



              {



                text_data+='<div class="col pretty p-switch p-fill p-2  col-md-6 col-sm-12" ><input type="radio" class="" name="variety" data-price="'+varieties[i]['price']+'" id="'+varieties[i]['varietyNum']+'" value="'+varieties[i]['varietyNum']+'" onclick="getMenuVarietyPrice(this)"> &nbsp<label> '+varieties[i]['itemName']+' - $'+varieties[i]['price']+'</label></div>';



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

                      swal("Good job!", "Item added to Cart!", "success");

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


<div class="header-bottom hidden-compact">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
			   <div class="menu-vertical-w">
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
			</div>
		</div>
	</div>
</div>

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