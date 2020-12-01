<?php 
// require_once "getdata/data.php";
// $myCategory = new Category();
include 'header.php'; 

$res = file_get_contents("http://hotel.staffstarr.com/ajax.php?action=getMainCategories&menuNum=76");
$main_Cat = json_decode($res,true);

// $main_Cat = $myCategory->getMainCategories(accNum,76);

$fist_sub_Cat = array();

if(isset($main_Cat[0]['categoryNum'])){

    $first_category = $main_Cat[0]['categoryNum'];
    //$fist_sub_Cat = $myCategory->getMainCategories(accNum,$first_category);

    $res = file_get_contents("http://hotel.staffstarr.com/ajax.php?action=getMainCategories&menuNum=".$first_category);
    $fist_sub_Cat = json_decode($res,true);

    // print_r($fist_sub_Cat); 
    // die;
}




//print_r($main_Cat);die;

?>

    <!-- Header / End -->
<style type="text/css">

    select.form-control:not([size]):not([multiple]) {
        height: calc(2.25rem + 4px);
    }

	.btn_add_to_Cart:hover:before, .btn_add_to_Cart:focus:before, .btn_add_to_Cart:active:before, .btn_add_to_Cart:focus:active:before {
    	opacity: 0.7;
	}

    .menu_mainCate{
        padding: 5px 10px;
        font-size: 18px;
        text-shadow: 0 0 3px #ddd;
        text-decoration: underline;
    }

    .menu_mainCate.active{
        background: #ddae71;
        text-transform: uppercase;
        text-decoration: none;
        border-radius: 5px;
    }
    #body-wrapper{
        display: block !important;
    }
    .bg_img_category{
        background-image: url("assets/img/photos/menu-title-burgers.jpg");
    }
    .model_menu_bg
    {
        background-image: url("assets/img/photos/modal-add.jpg");
    }
    .bg-image11, .bg-slideshow {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-position: center center;
    background-size: cover;
    background-repeat: no-repeat;
    z-index: 0;
}
.page-title {
    padding: 8rem 0 1rem 4rem;
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
                        <div class="module left">
                        <?php $p = 0; 
                         foreach ($main_Cat as $main_Cat_row) { 
                            $p++;
                            ?>
                        
                            <a onclick= "open_main_category(<?php echo $main_Cat_row['categoryNum']; ?>);" href="javascript:void(0);" class="btn btn-outline-secondary"><span><?php echo $main_Cat_row['categoryName']; ?></span></a>
                        <?php } ?>
                        </div>


                       
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

                        <?php 
                         foreach ($fist_sub_Cat as $fist_sub_CatOne) {
                            $img_url = $fist_sub_CatOne['image'];
                         ?>
                        <div id="Burgers" class="menu-category">
                            <div class="menu-category-title collapse-toggle" role="tab" data-target="#menu<?php echo $fist_sub_CatOne['categoryNum'] ?>" data-toggle="collapse" aria-expanded="false" onclick="open_sub_category(<?php echo $fist_sub_CatOne['categoryNum'] ?>);">
                                <div class="bg-image11" style="background-image: url(<?php echo $img_url;?>)"><img src="assets/img/photos/menu-title-burgers.jpg" alt="" style="display: none;"></div>
                                <h2 class="title"><?php echo $fist_sub_CatOne['categoryName'] ?></h2>
                            </div>
                            <div id="menu<?php echo $fist_sub_CatOne['categoryNum'] ?>" class="menu-category-content padded collapse ">
                                <div class="row gutters-sm" id="open_cate_div_<?php echo $fist_sub_CatOne['categoryNum'] ?>">
                                       </div>
                            </div>
                         </div> <?php 
                        }
                    ?>
                             <!--        <div class="col-lg-4 col-6">
                                        <div class="menu-item menu-grid-item">
                                            <img class="mb-4" src="assets/img/products/product-burger.jpg" alt="">
                                            <h6 class="mb-0">Beef Burger</h6>
                                            <span class="text-muted text-sm">Beef, cheese, potato, onion, fries</span>
                                            <div class="row align-items-center mt-4">
                                                <div class="col-sm-6"><span class="text-md mr-4"><span class="text-muted">from</span> $9.00</span></div>
                                                <div class="col-sm-6 text-sm-right mt-2 mt-sm-0"><button class="btn btn-outline-secondary btn-sm" data-target="#productModal" data-toggle="modal"><span>Add to cart</span></button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-6">
                                        <div class="menu-item menu-grid-item">
                                            <img class="mb-4" src="assets/img/products/product-pizza.jpg" alt="">
                                            <h6 class="mb-0">Broccoli</h6>
                                            <span class="text-muted text-sm">Beef, cheese, potato, onion, fries</span>
                                            <div class="row align-items-center mt-4">
                                                <div class="col-sm-6"><span class="text-md mr-4"><span class="text-muted">from</span> $9.00</span></div>
                                                <div class="col-sm-6 text-sm-right mt-2 mt-sm-0"><button class="btn btn-outline-secondary btn-sm" data-target="#productModal" data-toggle="modal"><span>Add to cart</span></button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-6">
                                        <div class="menu-item menu-grid-item">
                                            <img class="mb-4" src="assets/img/products/product-chicken-burger.jpg" alt="">
                                            <h6 class="mb-0">Chicken Burger</h6>
                                            <span class="text-muted text-sm">Beef, cheese, potato, onion, fries</span>
                                            <div class="row align-items-center mt-4">
                                                <div class="col-sm-6"><span class="text-md mr-4"><span class="text-muted">from</span> $9.00</span></div>
                                                <div class="col-sm-6 text-sm-right mt-2 mt-sm-0"><button class="btn btn-outline-secondary btn-sm" data-target="#productModal" data-toggle="modal"><span>Add to cart</span></button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-6">
                                        <div class="menu-item menu-grid-item">
                                            <img class="mb-4" src="assets/img/products/product-pasta.jpg" alt="">
                                            <h6 class="mb-0">Creste di Galli</h6>
                                            <span class="text-muted text-sm">Beef, cheese, potato, onion, fries</span>
                                            <div class="row align-items-center mt-4">
                                                <div class="col-sm-6"><span class="text-md mr-4"><span class="text-muted">from</span> $9.00</span></div>
                                                <div class="col-sm-6 text-sm-right mt-2 mt-sm-0"><button class="btn btn-outline-secondary btn-sm" data-target="#productModal" data-toggle="modal"><span>Add to cart</span></button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-6">
                                        <div class="menu-item menu-grid-item">
                                            <img class="mb-4" src="assets/img/products/product-chicken-wings.jpg" alt="">
                                            <h6 class="mb-0">Chicken wings</h6>
                                            <span class="text-muted text-sm">Beef, cheese, potato, onion, fries</span>
                                            <div class="row align-items-center mt-4">
                                                <div class="col-sm-6"><span class="text-md mr-4"><span class="text-muted">from</span> $9.00</span></div>
                                                <div class="col-sm-6 text-sm-right mt-2 mt-sm-0"><button class="btn btn-outline-secondary btn-sm" data-target="#productModal" data-toggle="modal"><span>Add to cart</span></button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-6">
                                        <div class="menu-item menu-grid-item">
                                            <img class="mb-4" src="assets/img/products/product-sushi.jpg" alt="">
                                            <h6 class="mb-0">Nigiri-sushi</h6>
                                            <span class="text-muted text-sm">Beef, cheese, potato, onion, fries</span>
                                            <div class="row align-items-center mt-4">
                                                <div class="col-sm-6"><span class="text-md mr-4"><span class="text-muted">from</span> $9.00</span></div>
                                                <div class="col-sm-6 text-sm-right mt-2 mt-sm-0"><button class="btn btn-outline-secondary btn-sm" data-target="#productModal" data-toggle="modal"><span>Add to cart</span></button></div>
                                            </div>
                                        </div>
                                    </div> -->
                             
                   
                        
                    </div>
                </div>
            </div>
        </div>

        

<!-- Modal / Product -->
<div class="modal fade" id="productModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content"  >
            <div id="model_menu">
                
            </div>
            <!-- <div class="modal-header modal-header-lg dark bg-dark">
                <div class="bg-image"><img src="assets/img/photos/modal-add.jpg" alt=""></div>
                <h4 class="modal-title">Specify your dish</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ti-close"></i></button>
            </div>
            <div class="modal-product-details">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h6 class="mb-0">Boscaiola Pasta</h6>
                        <span class="text-muted">Pasta, Cheese, Tomatoes, Olives</span>
                    </div>
                    <div class="col-3 text-lg text-right">$9.00</div>
                </div>
            </div> -->

            <form id="menuAddToCart">
          
            <div class="modal-body panel-details-container">
                <!-- Panel Details / Size -->

                <div class="panel-details">
                    <h5 class="panel-details-title">
                        <label class="custom-control custom-radio">
                            <input name="radio_title_size" type="radio" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                        </label>
                        <a href="#panelDetailsSize" data-toggle="collapse">Size</a>
                    </h5>
                    <div id="panelDetailsSize" class="collapse show">
                        <div class="panel-details-content" id ="model_vetrieties">
                            <div class="form-group">
                                <label class="custom-control custom-radio">
                                    <input name="radio_size" type="radio" class="custom-control-input" checked>
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Small - 100g ($9.99)</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="custom-control custom-radio">
                                    <input name="radio_size" type="radio" class="custom-control-input">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Medium - 200g ($14.99)</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="custom-control custom-radio">
                                    <input name="radio_size" type="radio" class="custom-control-input">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Large - 350g ($21.99)</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel-details" style="padding-bottom: 5px;">
                    <h5 class="panel-details-title">
                        <label class="custom-control custom-radio">
                            <input name="radio_title_size" type="radio" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                        </label>
                        <span>Quantity</span>

                        <p style="display: inline-block;float: right; margin: 0;font-size: 20px;border-right: none;margin-right: 15px;">
                            
                            <button type="button" class="sub btn rounded bg-danger btn-sm text-white"><strong>-</strong></button>

                            <input type="number" value="1" min="1" max="20" name="qty" id="qty" style="font-size: 20px; width: 40px;text-align: center;border: none;" readonly="">

                            <button type="button" class="add btn rounded bg-primary btn-sm text-white"><strong>+</strong></button>

                          </p>


                    </h5>
                    
                </div>
                <!-- Panel Details / Additions -->
                <div class="panel-details">
                    <h5 class="panel-details-title">
                        <label class="custom-control custom-radio">
                            <input name="radio_title_additions" type="radio" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                        </label>
                        <a href="#panelDetailsAdditions" data-toggle="collapse">Add Extra</a>
                    </h5>
                    <div id="panelDetailsAdditions" class="collapse">
                        <div class="panel-details-content">
                            <div class="row" id="ingredients_data">
                               
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Panel Details / Other -->
                <div class="panel-details">
                    <h5 class="panel-details-title">
                        <label class="custom-control custom-radio">
                            <input name="radio_title_other" type="radio" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                        </label>
                        <a href="#panelDetailsOther" data-toggle="collapse">Other</a>
                    </h5>
                    <div id="panelDetailsOther" class="collapse">
                        <textarea cols="30" rows="4" class="form-control" placeholder="Put this any other informations..."></textarea>
                    </div>
                </div>
            </div>
            <input type="hidden" name="activeTable" id="activeTable" value="0">
            <input type="hidden" name="invoice_id" id="invoice_id" value="0">

            <input type="hidden" name="activeDepartment" id="activeDepartment" value="0">

            <input type="hidden" name="menuNum" id="menuNum" value="0">

            <input type="hidden" name="totalPrice" id="totalPrice" value="0">
            <input type="hidden" name="unit_price" id="unit_price" value="">
            <input type="hidden" name="unit_gst" id="unit_gst" value="0">
            <input type="hidden" name="percentage" id="percentage" value="0">
            <div class="form-group d-flex">

              <div id="btn_addToCart" onclick="addToCart();" style="cursor: pointer;color: #ffffff; width: 100%;" >

                <div class="modal-btn btn btn_add_to_Cart btn-secondary btn-block btn-lg">

                    <p class="pull-left" style="width: 30%; display: inline-block;font-size: 16px;margin-bottom: 0;text-align: left;" ><span class="mquan">1</span> Item</p>
                    <p class="" style="width: 30%; display: inline-block;font-size: 16px;margin-bottom: 0;" ><span class="">ADD TO CART </span></p>
                    <p class="" style="width: 30%; display: inline-block; text-align: right;margin-bottom: 0;">$<span class="mprice">0</span></p>
                </div>
              </div>
                <div id="btn_outOfStock"  style="color: #ffffff; display: none;cursor: not-allowed;" >

                <div class="modal-btn btn btn_add_to_Cart btn-secondary btn-block btn-lg">

                    <p class="" style="width: 100%; display: inline-block;font-size: 16px;margin-bottom: 0;" ><span class="">OUT OF STOCK</span></p>
                </div>
              </div>

            </div>
        </form>



                    </div>
<!--             <button type="button" class="modal-btn btn btn-secondary btn-block btn-lg" data-dismiss="modal"><span>Add to Cart</span></button>
 -->        </div>
    </div>
</div>
<script type="text/javascript">
      function open_sub_category(category_id)
      {
        $.ajax({
            type:"GET",
            url:"ajax.php?action=getMenuItems&categoryNum="+category_id,
            data: {},
        success: function (result){
             // alert(result);

           var res_item_cat = JSON.parse(result);

           var item_cate_string = "";
           for(var i=0;i<res_item_cat.length;i++)
           {
            res_item_cat1 = res_item_cat[i];

            price = res_item_cat1["min_price"];
            //price = price.toFixed(2);
            // c
            item_cate_string+='<div class="col-lg-4 col-6" ><div class="menu-item menu-grid-item" onclick="open_sub_model('+res_item_cat1['menuNum']+');"  data-target="#productModal" data-toggle="modal"><img class="mb-4" src="'+res_item_cat1["image"]+'" alt=""><h6 class="mb-0" >'+res_item_cat1["menuName"]+'</h6> <span class="text-muted text-sm">'+res_item_cat1["description"]+'</span> <div class="row align-items-center mt-4"> <div class="col-sm-6"><span class="text-md mr-4"><span class="text-muted">from</span> $'+price+'</span></div><div class="col-sm-6 text-sm-right mt-2 mt-sm-0"><button class="btn btn-outline-secondary btn-sm" data-target="#productModal" data-toggle="modal" onclick="open_sub_model('+res_item_cat1['menuNum']+');"><span>Add to cart</span></button></div></div></div></div>';
                      // alert(res_item_cat1['menuName']);
                      // alert(res_item_cat1['image']);
                   // alert(res_item_cat1['image'])
                 // $("#sub_item_image").val(res_item_cat1['image']);
           }

           //alert(item_cate_string);
             $("#open_cate_div_"+category_id).html(item_cate_string);
        }

        });
      }
      function open_main_category(category_id)
      {
        //  alert(category_id);
        $.ajax({
             type:"GET",
            url:"ajax.php?action=getMainCategories&menuNum="+category_id,
            data: {},
            success: function (result){
                //alert(result);
                var main_category_string = " No Item Found ";
                $("#body-wrapper").removeClass("fade-out-up-sm");
                if(result != 'null'){
                
                    var res_main_cat = JSON.parse(result);
                    var main_category_string = "";

                    for(var i=0;i<res_main_cat.length;i++)
                    {
                        res_main_cat1 = res_main_cat[i];
                        // alert
                        // alert(res_main_cat1["categoryNum"]);
                        // alert(res_main_cat1["image"]);

                        var img_url= res_main_cat1['image'];

                        var bg_img = 'url('+img_url+')';
                        main_category_string += '<div id="Burgers" class="menu-category"><div class="menu-category-title collapse-toggle" role="tab" data-target="#menu'+res_main_cat1["categoryNum"]+'" data-toggle="collapse" aria-expanded="false" onclick="open_sub_category('+res_main_cat1['categoryNum']+');"><div class="bg-image" style="background-image:'+bg_img+'"><img src="assets/img/photos/menu-title-burgers.jpg" alt=""></div><h2 class="title">'+res_main_cat1['categoryName']+'</h2></div><div id="menu'+res_main_cat1['categoryNum']+'" class="menu-category-content padded collapse "><div class="row gutters-sm" id="open_cate_div_'+res_main_cat1['categoryNum']+'"></div></div></div>'

                    }
                }
               //alert(main_category_string);
               $("#main_category_items").html(main_category_string);

            }
        });
      }
      function open_sub_model(menuNum)
      {
        // var imgg = $("#sub_item_image");
        // alert(imgg);
        // for(i=0;i<imgg.length;i++)
        // {
        //     img2 = img[i];
        //     alert(img2[0]);

        // }

       $.ajax({
                type:"GET",
                url:"ajax.php?action=getItemDetails&menuNum="+menuNum,
                data: {},

               success: function (result)
               {
                // var model_menu_price = $(".mprice").html();
                // alert(model_menu_price);
                // console.log(result);
                var res_model444 = JSON.stringify(result);
                console.log(res_model444.length);
                var res_model = JSON.parse(result);
                var res_model_menu = res_model.menu;
                var res_model_varieties = res_model.varieties;
                   var firsr_prc =res_model_varieties[0];
                   var menu_price = firsr_prc['price'];
                var res_model_ingredients = res_model.ingredients;

                $("#menuNum").val(menuNum);
                // alert("first");
                // alert(res_model_ingredients);
                // var ingredients_ingredients = res_model_ingredients['ingredients'];
                // var ingredients_ingredient_options = res_model_ingredients.ingredient_options
                // alert(res_model_ingredients);
             // console.log(res_model.menu);
             // console.log(res_model_varieties);
             string_model_menu = "";
                for(var i=0;i<res_model_menu.length;i++)
                {
                    // alert(res_model_menu[i]);
                    res_model_menu1 = res_model_menu[i];
                       var model_bg = res_model_menu1['image'];
                       var model_img = 'url('+model_bg+')';
                       // alert(model_img);
                       string_model_menu+='<div class="modal-header modal-header-lg dark bg-dark"><div class="bg-image model_menu_bg" style="background-image:'+model_img+'"><img src="'+res_model_menu1['image']+'" alt=""></div><h4 class="modal-title">Specify your dish</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ti-close"></i></button></div><div class="modal-product-details"><div class="row align-items-center"><div class="col-9"><h6 class="mb-0" id="menu_name_modal">'+res_model_menu1['menuName']+'</h6><span class="text-muted">'+res_model_menu1['description']+'</span></div><div class="col-3 text-lg text-right mprice2">$'+menu_price+'</div></div></div>';
                }
                $("#model_menu").html(string_model_menu);

                var string_model_vetrieties ="";
                for(var i=0;i<res_model_varieties.length;i++)
                {
                    res_model_varieties1 = res_model_varieties[i];
                    string_model_vetrieties+='<div class="form-group"><input type="hidden" value="'+res_model_varieties1['stock']+'" name="" id="in_stock_'+res_model_varieties1['varietyNum']+'" ><label class="custom-control custom-radio"><input name="variety" type="radio" class="custom-control-input"  value="'+res_model_varieties1['varietyNum']+'" id="'+res_model_varieties1['varietyNum']+'" data-price="'+res_model_varieties1['price']+'" onclick="getMenuVarietyPrice(this)" ><span class="custom-control-indicator"><svg class="icon" x="0px" y="0px" viewBox="0 0 32 32"><path stroke-dasharray="19.79 19.79" stroke-dashoffset="19.79" fill="none" stroke="#FFFFFF" stroke-width="4" stroke-linecap="square" stroke-miterlimit="10" d="M9,17l3.9,3.9c0.1,0.1,0.2,0.1,0.3,0L23,11"></path></svg></span><span class="custom-control-description" id="varietyName_'+res_model_varieties1['varietyNum']+'">'+res_model_varieties1['itemName']+'- $'+res_model_varieties1['price']+'</span></label></div>';
                }
                // alert(string_model_vetrieties);
                $("#model_vetrieties").html(string_model_vetrieties);
              var string_ingredients= "";

            for(var i=0;i<res_model_ingredients.length;i++)
            {
                res_model_ingredients1 =res_model_ingredients[i];
                ingredients_ingredients = (res_model_ingredients1['ingredients']);
                 // alert(ingredients_ingredients['itemName']);
                ingredient_options = (res_model_ingredients1['ingredient_options']);


                string_ingredients+='<div class="row" style="width:100%;margin: 5px 0px;"><div class="col-md-8 col-lg-8" style="margin: 0;display: inline-block;" id="ingredients_name"><span class="custom-control-description">'+ingredients_ingredients['itemName']+'</span></div><div class="col-md-4 col-lg-4 " style="float: right;margin:0;padding:0;"><select style="float: right;     padding: 5px 10px;" onchange="getMenuIngredientOptionPrice(this)" class="add_extra_menu form-control"><option data-iotprice="0" data-iot="0" value="0">select</option>';

                // string_ingredients_name+='<span class="custom-control-description">'+ingredients_ingredients['itemName']+'</span>';

                for(var k=0;k<ingredient_options.length;k++)
                {
                   
                    var ingredient_options1 = ingredient_options[k];
                    // alert(ingredient_options1['option_price']);
                    // alert(ingredient_options1);
                    var option_name = ingredient_options1['plus_name'];
                    if(ingredient_options1['option_price'] > 0){
                        option_name += '&nbsp; $'+ingredient_options1['option_price'];
                    }
                        string_ingredients+='<option  data-iotprice="'+ingredient_options1['option_price']+'" data-iot="'+ingredient_options1['id']+'" value="'+ingredient_options1['option_price']+'">'+option_name+'</option>';
                    

                }

                string_ingredients+='</select></div></div>';
                 // alert(res_model_ingredients1['itemNam']
            }
            $("#ingredients_data").html(string_ingredients);
               }      
        }); 
      }

 </script>
<script type="text/javascript">

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

        for (i = 0; i < opt_price.length; i++) {

            total += Number(opt_price[i].getAttributeNode("data-iotprice").value);
        }

        $.post("ajax.php?action=getMenuVarietyPrice&varietyNum="+el.id,{},

        function (data) {

            // alert(data);

            //alert(status);

            temp = $("#varietyName_"+el.id).text();

            $("#verietyNamesingle").val(temp);

            prc = Number(data);

            //alert(prc);

            $("#unit_price").val(prc);


            if (prc > 0) {
                var qty = $('input[name=qty]').val();

                var multiplied_prc = (Number(prc * qty) + Number(total * qty));

                $('.mprice').html(multiplied_prc);
                $('.mprice2').html("$"+multiplied_prc);

                $('#totalPrice').val(multiplied_prc);

            }

        });
    }

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
                $('.mprice2').html("$"+multiplied_prc);

                $('#totalPrice').val(multiplied_prc);

        });

    }


    $('.add').click(function () {

          // alert("hello");
        if ($(this).prev().val() < 20) {

            var total = 0;

            var opt_price = $('.add_extra_menu').find(":selected");
            for (i = 0; i < opt_price.length; i++) {

                total += Number(opt_price[i].getAttributeNode("data-iotprice").value);

            }
            // alert(total);

            var qty = +$(this).prev().val() + 1;

            $(this).prev().val(qty);



            var prc = $('input[name=variety]:checked').data('price');



            // alert(prc);

            var multiplied_prc = (Number(prc * qty) + Number(total * qty));

            $('.mprice').html(multiplied_prc);
            $('.mprice2').html("$"+multiplied_prc);

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
            $('.mprice2').html("$"+multiplied_prc);

            $('#totalPrice').val(multiplied_prc);

            $('.mquan').html(qty);

        }

    });

</script>


<!-- add to cart function js -->

<script type="text/javascript">
//     function addtocart1(){

//   var prc = $('input[name=variety]:checked').data('price');

//   if(!prc)

//   {

//     alert("SELECT Price");

//   }

// }




IS_EXTRA_COMPULSORY = false;

function addToCart() {

  
        /*  if($('#activeTable').val() != 0){

         if($('#activeDepartment').val() != 0){*/
   if ($("input[name='variety']").is(':checked')) {

        var err= 0;

        if(IS_EXTRA_COMPULSORY){

            var opt_price = $('.add_extra_menu').find(":selected");

            //alert(opt_price);

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

        if(err == 0){

            var qty = $('input[name=qty]').val();

            //var activeTable = $('#activeTable').val();

            if ((qty > 0) && (qty <= 20)) {

                $.ajax({

                    type: 'POST',

                    url: 'ajax.php?action=addToCart',

                    data: $('#menuAddToCart').serializeArray(),

                    success: function (response) {
                        //alert(response);
                        var obj=JSON.parse(response);
                        var $invoice_id=obj['invoice_id'];
                        var   $item_it=obj['item_id'];

                        $("#invoice_id").val($invoice_id);

                        $("#body-wrapper").removeClass("fade-out-up-sm");

                        swal("Item added to Cart!","", "success");

                        var menuNum = $("#menuNum").val();
                        var totalPrice = $("#totalPrice").val();
                        var menuName = $("#menu_name_modal").text();
                        var varietyName = $("#verietyNamesingle").val();


                        var cart_data_table = '<tr><td class="title"><input type="hidden" name="" class="item_total_price" id="item_total_price'+menuNum+'" value="'+totalPrice+'"><input type="hidden" name="cart_id[]" id="'+menuNum+'" value="'+menuNum+'"><input type="hidden" name="qty[]" id="ContentPlaceHolder1_box_'+menuNum+'" value="1"><input type="hidden" name="perItemPrice[]" id="product_price_per_item_'+menuNum+'" value="'+total+'"><input type="hidden" name="extraPerItemPrice[]" id="extras_price_per_item_'+menuNum+'" value="0"><input type="hidden" name="is_stock" id="is_stock_1" value="1"><input type="hidden" name="" id="cart_id_1" value="'+menuNum+'"><span class="name">'+menuName+'</span><span class="caption text-muted">'+varietyName+'</span></td><td class="price">$'+totalPrice+'</td><td class="actions" style=" "><a href="#" class="action-icon" onclick="update_cart_page('+$item_it+',0);"><i class="ti ti-close"></i></a></td></tr>';
                        $("#cart_data_table").append(cart_data_table);
                        var total_cart_price = 0;
                        $(".item_total_price").each(function() {
                            item_price = $(this).val();
                            total_cart_price = Number(total_cart_price)+Number(item_price);
                        });

                        $(".cart_total_amount").text("$"+total_cart_price);

                        //window.location.reload();
                        
                       $("#productModal").modal("hide");
                      //alert('Item added to Cart.');
                      // 

                      $.post("ajax.php?action=getCartItems",{},function (data1) {
                      	//alert(data1);
                        data = $.parseJSON(data1);
                        var cart_count = data.length;

                        $(".notification").text(cart_count);
                      });



                      // alert(response);

                      // console.log(response);

                        //if (response != '0') {

                            // modal.style.display = "block";

                            // // var pc = parseInt($('.itemAddedCart').text()) + 1;

                            // // $('.itemAddedCart').text(pc);



                            // alert('Item added to Cart.');

                            //Notify('Item added to Cart.');

                            //window.location.reload();

                       // } else {

                            // $("#itmCart").modal('show');

                            // //$(".itemAddedCart").html("0");

                            // //$('#menuModal').modal('hide');

                            // $('#regModal').modal('show');



                            //window.location.replace(site_url+'home.php');

                       // }

                    }

                });

            }

          }

        } else {

          $("input[name='variety']").focus();

            //responseErr("Please select one Variety");
            swal("Please select variety"," ","warning");
            $("#body-wrapper").removeClass("fade-out-up-sm");

        }

        /*}else{

         responseErr("Please select Department");

         }

         }else{

         responseErr("Please select Table Number");

         }  */

    }



    // function responseErr(msg) {

    //     $("#response_msg").removeClass('alert-success').addClass('alert-danger').fadeIn();

    //     $("#response_msg .res_msg").html(msg);



    //     $("#response_msg").delay(3000).fadeOut(1000);



    //     //$("html, body").animate({ scrollTop: $('#response_msg').offset().top }, 1000);

    // }


</script>

<!-- end of add to cart js -->
<?php include 'footer.php'; ?>  