<?php
  require_once "jax_header.php";
// print_r($con);die;

?>

    <style type="text/css">
        .menu-grid-item {
    line-height: 1.2;
    margin-bottom: 1.5rem;
}
    </style>

</header>
  	
  	 <div class="container" style="margin: 30px;">
        <div class="row"> 
        	<div class="col-md-4">
        		<form Action="" method="POST" >
        			<input type="hidden" name="sp1_prev" id="sp1_prev" value="0">
        			<input type="hidden" name="sp2_prev" id="sp2_prev" value="0">
        			<input type="hidden" name="sp3_prev" id="sp3_prev" value="0">
        			 <!-- <select class="chosen" style="width:500px;"  onchange="get_other_items(1)" id="sp1_data"> -->
	        		<!-- <select class="chosen" style="width: 70%;" onchange="get_other_items(1)" id="sp1_data"> -->
	        		<select data-placeholder="Choose SP-1..." class="mdb-select md-form chosen_sp1" style="width: 50%;" onchange="get_sp2()" id="sp1_data" disabled="true">
	        			<option value=""></option>
	        			
	        			
	        			<?php 
	        		/*	while($row=mysqli_fetch_array($res))
	        			{
	        				?>
	        				<option value="<?php echo $row['sp1'] ?>"><?php echo $row['sp1'] ?></option>
	        				<?php

	        			}
*/
	        			?>
	        		</select>
	        	</div>
	        	<div class="col-md-3">
	        		<select  data-placeholder="Choose SP-2..." id="sp2_data" class="form-control chosen_sp2" onchange="get_sp3()" style="width: 70%;" disabled="true" >
	        			<option value=""></option>
	        		</select>
	        	</div>
	        	<div class="col-md-3">
	        		<select data-placeholder="Choose SP-3..." id="sp3_data" class="form-control chosen_sp3" style="width: 70%;"  disabled="true">
	        			<!-- <option value="">SP-3</option> -->
	        		</select>
	        	</div>
	        	<div class="col-md-2">
                    <a href="jax_view_cart.php" class="module module-cart right" data-toggle="panel-cart">
                        <span class="cart-icon">
                            <!-- <i class="ti ti-shopping-cart"></i> -->
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>

                            <span class="notification">3</span>
                        </span>
                      
                    </a>
                </div>
	        	<!-- <div class="col-md-2">
    	        		<span>Hey</span>
    	        	</div> -->
             </div>
           </div>
              <div class="container">
                 <div class="row">  
                    <div class="col-md-4"></div>
    	        	<div class="col-md-4">
    	        		<button style="margin: 12px; width:50%" class="form-control" type="button" placeholder="Search" aria-label="Search" name="search" onclick="Getsp123_data()" id="submit" class="btn btn-primary">Submit</button>
    	        	</div>
    	        	
	        		
	        	</form>

       </div> 
     </div>	
     	<div class="container">
     		<div class="row">
     			<div class="col-md-5"></div>
     			
     			
     		</div>
     		
     	</div>
        <div style="padding: 30px;margin: 10px; text-align: center;"  class="row gutters-sm"id="open_cate_div_">No Item Selected</div>


        <div class="modal fade in" id="myModal" role="dialog" style="display: block;">
    <div class="modal-dialog" style="max-height: 90%;overflow: scroll;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
             <div class="row">
             <div class="col-md-12">

          <button type="button" class="close" data-dismiss="modal" onclick="close_modal();$('#myModal').hide();">×</button>
        </div>
    </div>
             <div class="row">
         <div class="col-md-3">
          <img style="height:125px;" id="menu_image" src="https://www.go.staffstarr.com/ecom-admin/assets/images/10328/1571659441.jpg">
        </div>
        
        <div class="col-md-9">
          <h2 class="modal-title titleModal">Magnetic Stencil</h2><span class="calories"></span>
          <p class="menudesc">Metal</p>
        </div>
        </div>
        </div>
        <div class="modal-body">
          
                <p class="ingredients">
                  <span class="ingre" id="inline_ingredients"></span></p>

                <div id="response_msg" class="alert alert-success col-sm-12 mt-3" role="alert" style="display: none;color: red;">

                    <a href="#" class="modal_close close" onclick="close_modal()" data-dismiss="alert">×</a>

                    <div class="res_msg"></div>

                </div>

                <form id="menuAddToCart" action="" method="POST">

                    <div class=" col-md-12 form-group menu-item-cart " id="menu_varient_data" style="">

                        <div class="row" id="quan" name="variety">

                          <div class=" col-md-12 col-sm my-1 varient_data"><div class="col pretty p-switch p-fill p-2  col-md-6 col-sm-12"><input type="radio" class="" name="variety" data-price="15" id="905" value="905" onclick="getMenuVarietyPrice(this)"> &nbsp;<label id="varietyName_905"> 30 x 50 x 0.1 mm - $15</label></div></div>

                        </div>

                    </div>

                    <!-- Quantity start -->

                    <div class="form-group d-flex menu-item-cart">

                        <div class="mr-auto p-2">

                            <label>Quantity</label>

                          <p style="display: inline-block;float: right; margin: 0;font-size: 20px;margin-right: 30px;border: 1px solid #ddd;border-right: none;">

                            <button type="button" class="sub btn rounded bg-danger btn-sm text-white"><strong>-</strong></button>

                            <input type="number" value="1" min="1" max="20" name="qty" id="qty" style="font-size: 20px; width: 40px;text-align: center;border: none;" readonly="">

                            <button type="button" class="add btn rounded bg-primary btn-sm text-white"><strong>+</strong></button>

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

                    <div class="add_extra_menu"></div>

                  </div>

                    <div class="form-group " style="margin-top: 20px; margin-bottom: 20px;">



                        <div class="">

                            <textarea name="note" rows="3" style="resize: none;width: 94%;border: 1px solid #e2dddd;padding: 20px;" class="form-control" placeholder="Add Note"></textarea>

                        </div>

                    </div>



                    <input type="hidden" name="activeTable" id="activeTable" value="0">
                    <input type="hidden" name="invoice_id" id="invoice_id" value="0">

                    <input type="hidden" name="activeDepartment" id="activeDepartment" value="0">

                    <input type="hidden" name="menuNum" id="menuNum" value="258">

                    <input type="hidden" name="totalPrice" id="totalPrice" value="0">
                    <input type="hidden" name="unit_price" id="unit_price" value="">
                    <input type="hidden" name="unit_gst" id="unit_gst" value="0">
                    <input type="hidden" name="percentage" id="percentage" value="0">
                    <input type="hidden" name="verietyNamesingle" id="verietyNamesingle" value="0">

                    <div class="form-group d-flex">

                      <a href="javascript:void(0)" id="btn_addToCart" onclick="addToCart();" style="color: #ffffff;">

                      <div class="image-button-wrapper" style="padding: 10px;color: white;background-color: #171717;margin-top: 20px;margin-bottom: 20px;width: 100%;float: left;"><div class="image-button sqs-dynamic-text">
                        <div class="image-button-inner">

                        

                        <p class="pull-left" style="width: 30%; display: inline-block;"><span class="mquan">1</span> item</p>

                        <p class="pull-left offset-sm-4" style="width: 30%; display: inline-block; text-align: center;">Add To Cart</p>

                        <p class="pull-right offset-sm-3" style="width: 30%; display: inline-block; text-align: right;">$<span class="mprice">0</span></p>

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
     	// 	var sp1 =  $("#sp1_data").val();
     	// 	var sp2= $("#sp2_data").val();
     	// 	var sp3=$("#sp3_data").val();
     	// 	var prev_sp1 =  $("#sp1_prev").val();
     	// 	var prev_sp2= $("#sp2_prev").val();
     	// 	var prev_sp3=$("#sp3_prev").val();
     	// 	if(sp1 == "")
     	// 	{
     	// 		 get_sp1();
     	// 	}else{
     	// 		//alert("hi");
     	// 		 $("#sp1_data").attr("readonly", true);
     	// 	}
     	// 	if(sp2 == "")
     	// 	{
     	// 		 get_sp2();
     	// 	}else{
     	// 		 $("#sp2_data").attr("readonly", true);
     	// 	}
     	// 	if(sp3 == "")
     	// 	{
     	// 		 get_sp3();
     	// 	}else{
     	// 		 $("#sp3_data").attr("readonly", true);
     	// 	}

     	// 	// if(id == 1)
     	// 	// {
     	// 	// 	if(prev_sp1 != sp1){
     	// 	// 		get_sp2();
     	// 	// 	 	get_sp3();
     	// 	// 	}
     	// 	// }
     	// 	// if(id == 2)
     	// 	// {
     	// 	// 	 get_sp1();
     	// 	// 	 get_sp3();
     	// 	// }
     	// 	// if(id == 3)
     	// 	// {
     	// 	// 	 get_sp1();
     	// 	// 	 get_sp2();
     	// 	// }
     	// }
        function get_sp1()
        {
            //var sp2= $("#sp2_data").val();
            //var sp3=$("#sp3_data").val();

            $.ajax
            ({
                 type: 'POST',

                 url: 'ajax.php?action=get_sp1',

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

                 url: 'ajax.php?action=get_sp2',

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

                 url: 'ajax.php?action=get_sp3',

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
     			url:'ajax.php?action=GetSpData',
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

                    var img="";

	                  if(img_url!='null')
	                  {

	                     var img = img_url.replace("ecom-admin", "my-store");
	                   }
                    //price = price.toFixed(2);
                    // c
                    item_cate_string+='<div class="col-lg-4 col-md-4"  ><div class="menu-item menu-grid-item"><img style="padding: 12px; margin-left:auto; margin-right:auto;  width:50%;" class="mb-4" src="'+img+'" alt=""><h6 class="font-weight-bold"><strong>'+res_item_cat1["menuName"]+'</strong></h6> <span class="text-muted text-sm">'+res_item_cat1["description"]+'</span> <div class="row align-items-center mt-4"> <div class="col-sm-6"><span class="text-md mr-4"><span class="text-muted text-sm">Min price</span> $'+price+'</span></div><div class="col-sm-6 text-sm-right mt-2 mt-sm-0"><button class="btn btn-outline-secondary btn-sm" data-target="#productModal" data-toggle="modal" onclick="show_modal('+res_item_cat1["menuNum"]+');"><span>Add to cart</span></button></div></div></div></div>';
                             
                   }
                }
                else
                {
                   item_cate_string="No Item Found"; 
                }

                     $("#open_cate_div_").html(item_cate_string);




     				 // alert(response);
     			// 	data = $.parseJSON(response);
     			// 	var itemnum_data="";

     			// if(data['itemNum'].length>0)
     			// 	{
            //          	for(var i = 0; i< data['itemNum'].length; i++)
            //          	{
            //          		itemnum_data+="<p>"+ data['itemNum'][i]+"</p>";
            //          	}
            //          }
            //          else
            //          {
            //          	itemnum_data="No Item Found";
            //          }

            //          	$("#itemnum").html(itemnum_data);

     			}

     		});

     	}

IS_EXTRA_COMPULSORY = false;
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

                    url: 'ajax.php?action=addToCart',

                    data: $('#menuAddToCart').serializeArray(),

                    success: function (response) {

                       alert(response);

                       var obj=JSON.parse(response);
                        var $invoice_id=obj['invoice_id'];
                        var   $item_it=obj['item_id'];

                        $("#invoice_id").val($invoice_id);



                      var modal = document.getElementById("myModal");

                      modal.style.display = "none";

                      //alert('Item added to Cart.');
                      swal("Item added to Cart!","", "success");


                      $.post("ajax.php?action=getCartItems",{},
                      function (data1) {
                        data = $.parseJSON(data1);
                        var cart_count = data.length;

                        $("#cart_items").text("Cart ("+cart_count+")");
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





   $('.add').click(function () {

        if ($(this).prev().val() < 20) {



            var total = 0;

            var opt_price = $('.add_extra_menu').find(":selected");

            for (i = 0; i < opt_price.length; i++) {

                total += Number(opt_price[i].getAttributeNode("data-iotprice").value);

            }



            var qty = +$(this).prev().val() + 1;

            $(this).prev().val(qty);



            var prc = $('input[name=variety]:checked').data('price');



            

            var multiplied_prc = (Number(prc * qty) + Number(total * qty));

            $('.mprice').html(multiplied_prc);

            $('#totalPrice').val(multiplied_prc);

            $('.mquan').html(qty);

        }

    });



    $('.sub').click(function () {

        if ($(this).next().val() > 1) {



            var total = 0;

            var opt_price = $('.add_extra_menu').find(":selected");

            for (i = 0; i < opt_price.length; i++) {

                total += Number(opt_price[i].getAttributeNode("data-iotprice").value);

            }



            var qty = +$(this).next().val() - 1;

            $(this).next().val(qty);

            var prc = $('input[name=variety]:checked').data('price');

            var multiplied_prc = (Number(prc * qty) + Number(total * qty));

            $('.mprice').html(multiplied_prc);

            $('#totalPrice').val(multiplied_prc);

            $('.mquan').html(qty);

        }

    });



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



        $.post("ajax.php?action=getMenuVarietyPrice&varietyNum="+el.id,{},

          function (data) {

            //alert(data);

            //alert(status);

            temp = $("#varietyName_"+el.id).text();

            $("#verietyNamesingle").val(temp);

            prc = Number(data);
            $("#unit_price").val(prc);

            if (prc > 0) {

                

                var qty = $('input[name=qty]').val();



                //alert(qty);

                var multiplied_prc = (Number(prc * qty) + Number(total * qty));

                $('.mprice').html(multiplied_prc);

                $('#totalPrice').val(multiplied_prc);

            }

        });

    }





    var arr = new Array();

    function getMenuIngredientOptionPrice(el) {

        var iot = $(el).find(':selected').data("iot");

        var ing_id = Number($(el).data('ingid'));

        var opt_price = Number($(el).find(":selected").data("iotprice"));

        $.post("ajax.php?action=getMenuIngredientOptionPrice&iot_id="+iot, {},

        function (data) {

          //alert(ing_id);

          data = Number(data);

            if (data > 0) {

                data = Number(data);

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

                var multiplied_prc = (Number(prc * qty) + Number(total * qty));

                $('.mprice').html(multiplied_prc);

                $('#totalPrice').val(multiplied_prc);

        });

    }



       var modal = document.getElementById("myModal");


function show_modal (menu_id) {

$("#divloader").show();

  $.post("ajax.php?action=getItemDetails&menuNum="+menu_id, {}, 

          function (data) {


            $.post("ajax.php?action=getOpenInvoiceId", {},
           function (invoice_id_return) {
            $("#invoice_id").val(invoice_id_return);
           });
            // alert(data);
           // obj = JSON.parse(data);

            obj = $.parseJSON(data);

            //alert(obj);

            menu = obj.menu;



            $(".titleModal").text(menu[0]['menuName']);

            $(".menudesc").text(menu[0]['description']);

            img_url = menu[0]['image'];
            var img="";
            if(img_url!="null")
            {

            var img = img_url.replace("ecom-admin", "my-store");
			}

            $("#menu_image").attr('src',img);

            //alert(data);



            var varieties = obj.varieties;



            // alert(varieties);

             var text_data = "";



             if(varieties.length > 0){



              for( i =0; i < varieties.length; i++ )

              {

                //var varieties1 = $.makeArray(varieties[i]);



                //console.log(varieties1);



                text_data+='<div class="col pretty p-switch p-fill p-2  col-md-6 col-sm-12" ><input type="radio" class="" name="variety" data-price="'+varieties[i]['price']+'" id="'+varieties[i]['varietyNum']+'" value="'+varieties[i]['varietyNum']+'" onclick="getMenuVarietyPrice(this)"> &nbsp<label id="varietyName_'+varieties[i]['varietyNum']+'"> '+varieties[i]['itemName']+' - $'+varieties[i]['price']+'</label></div>';

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





            // alert(varieties);

             var text_data1 = "";

             var inline_ingredients = "";





              if(ingredients.length > 0){



                for( i =0; i < ingredients.length; i++ )

                {

                  //var varieties1 = $.makeArray(varieties[i]);



                  //console.log(varieties1);



                  var ingredient_text = ingredients[i]['ingredients'];



                  text_data1+='<div class="form-group d-flex" style="margin-bottom: 10px;"><div class="mr-auto p-2"><label>'+ingredient_text['itemName']+'</label><select class="ingnum4" style=" width:auto; padding:0px; margin: 0px;float: right;" data-ingid="'+ingredient_text['ingredientNum']+'" name="addextra['+ingredient_text['ingredientNum']+']" onchange="getMenuIngredientOptionPrice(this)">';



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


            //  alert(text_data1);



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

            $("#divloader").hide();

            // alert(status);

            // if (status == 'success') {

            //     prc = parseInt(data);

            //     var qty = $('input[name=qty]').val();

            //     var multiplied_prc = (parseInt(prc * qty) + parseInt(total * qty));

            //     $('.mprice').html(multiplied_prc);

            // }

        });



  

}

close_modal();

// When the user clicks on <span> (x), close the modal

function close_modal() {

  modal.style.display = "none";

}

     </script>


 <?php //Include 'footer.php'; ?>



