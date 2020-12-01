<?php 
require_once "getdata/data.php";
$myCategory = new Category();

$main_Cat = $myCategory->getMainCategories(accNum,76);

$fist_sub_Cat = array();

if(isset($main_Cat[0]['categoryNum'])){

    $first_category = $main_Cat[0]['categoryNum'];
    $fist_sub_Cat = $myCategory->getMainCategories(accNum,$first_category);
    // print_r($fist_sub_Cat); 
    // die;
}




//print_r($main_Cat);die;

include 'header.php'; ?>

    <!-- Header / End -->
<style type="text/css">
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
                        <?php $p = 0; 
                         foreach ($main_Cat as $main_Cat_row) { 
                            $p++;
                            ?>

                        <a onclick= "open_main_category(<?php echo $main_Cat_row['categoryNum']; ?>);" href="javascript:void(0);" class="menu_mainCate <?php echo ($p==1 ? 'active':''); ?>"> <?php echo $main_Cat_row['categoryName']; ?></a>
                        <?php } ?>
                       
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

                         ?>
                            
                        <div id="Burgers" class="menu-category">
                            <div class="menu-category-title collapse-toggle" role="tab" data-target="#menu<?php echo $fist_sub_CatOne['categoryNum'] ?>" data-toggle="collapse" aria-expanded="false" onclick="open_sub_category(<?php echo $fist_sub_CatOne['categoryNum'] ?>);">
                                <div class="bg-image"><img src="assets/img/photos/menu-title-burgers.jpg" alt=""></div>
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
                <!-- Panel Details / Additions -->
                <div class="panel-details">
                    <h5 class="panel-details-title">
                        <label class="custom-control custom-radio">
                            <input name="radio_title_additions" type="radio" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                        </label>
                        <a href="#panelDetailsAdditions" data-toggle="collapse">Additions</a>
                    </h5>
                    <div id="panelDetailsAdditions" class="collapse">
                        <div class="panel-details-content">
                            <div class="row" id>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Tomato ($1.29)</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Ham ($1.29)</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Chicken ($1.29)</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Cheese($1.29)</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Bacon ($1.29)</span>
                                        </label>
                                    </div>
                                </div>
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
            <button type="button" class="modal-btn btn btn-secondary btn-block btn-lg" data-dismiss="modal"><span>Add to Cart</span></button>
        </div>
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
            // alert(res_item_cat1);
            item_cate_string+='<div class="col-lg-4 col-6" ><div class="menu-item menu-grid-item"><img class="mb-4" src="'+res_item_cat1["image"]+'" alt=""><h6 class="mb-0">'+res_item_cat1["menuName"]+'</h6> <span class="text-muted text-sm">Beef, cheese, potato, onion, fries</span> <div class="row align-items-center mt-4"> <div class="col-sm-6"><span class="text-md mr-4"><span class="text-muted">from</span> $9.00</span></div><div class="col-sm-6 text-sm-right mt-2 mt-sm-0"><button class="btn btn-outline-secondary btn-sm" data-target="#productModal" data-toggle="modal" onclick="open_sub_model('+res_item_cat1['menuNum']+');"><span>Add to cart</span></button></div></div></div></div>';
                      // alert(res_item_cat1['menuName']);
                      // alert(res_item_cat1['image']);

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

                        main_category_string += '<div id="Burgers" class="menu-category"><div class="menu-category-title collapse-toggle" role="tab" data-target="#menu'+res_main_cat1["categoryNum"]+'" data-toggle="collapse" aria-expanded="false" onclick="open_sub_category('+res_main_cat1['categoryNum']+');"><div class="bg-image bg_img_category"><img src="assets/img/photos/menu-title-burgers.jpg" alt=""></div><h2 class="title">'+res_main_cat1['categoryName']+'</h2></div><div id="menu'+res_main_cat1['categoryNum']+'" class="menu-category-content padded collapse "><div class="row gutters-sm" id="open_cate_div_'+res_main_cat1['categoryNum']+'"></div></div></div>'

                    }
                }
               //alert(main_category_string);
               $("#main_category_items").html(main_category_string);

            }
        });
      }
      function open_sub_model(menuNum)
      {
       $.ajax({
                type:"GET",
                url:"ajax.php?action=getItemDetails&menuNum="+menuNum,
                data: {},

               success: function (result)
               {
                // console.log(result);
                var res_model444 = JSON.stringify(result);
                console.log(res_model444.length);
                var res_model = JSON.parse(result);
                var res_model_menu = res_model.menu;
                var res_model_varieties = res_model.varieties;
                var res_model_ingredients = res_model.ingredients;
             console.log(res_model.menu);
             console.log(res_model_varieties);
             string_model_menu = "";
                for(var i=0;i<res_model_menu.length;i++)
                {
                    // alert(res_model_menu[i]);
                    res_model_menu1 = res_model_menu[i];
                       alert(res_model_menu1['image']);
                       string_model_menu+='<div class="modal-header modal-header-lg dark bg-dark"><div class="bg-image model_menu_bg"><img src="'+res_model_menu1['image']+'" alt=""></div><h4 class="modal-title">Specify your dish</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ti-close"></i></button></div><div class="modal-product-details"><div class="row align-items-center"><div class="col-9"><h6 class="mb-0">'+res_model_menu1['menuName']+'</h6><span class="text-muted">'+res_model_menu1['description']+'</span></div><div class="col-3 text-lg text-right">$9.00</div></div></div>';
                }
                $("#model_menu").html(string_model_menu);
                var string_model_vetrieties ="";
              for(var i=0;i<res_model_varieties.length;i++)
              {
                res_model_varieties1 = res_model_varieties[i];
                // alert(res_model_varieties1['itemName']);
                string_model_vetrieties+='<div class="form-group"><label class="custom-control custom-radio"><input name="radio_size" type="radio" class="custom-control-input" ><span class="custom-control-indicator"><svg class="icon" x="0px" y="0px" viewBox="0 0 32 32"><path stroke-dasharray="19.79 19.79" stroke-dashoffset="19.79" fill="none" stroke="#FFFFFF" stroke-width="4" stroke-linecap="square" stroke-miterlimit="10" d="M9,17l3.9,3.9c0.1,0.1,0.2,0.1,0.3,0L23,11"></path></svg></span><span class="custom-control-description">'+res_model_varieties1['itemName']+'- 100g -'+res_model_varieties1['price']+'$</span></label></div>';
              }
                // alert(string_model_vetrieties);
                $("#model_vetrieties").html(string_model_vetrieties);
            //        var string_model_ingredients= "";
            for(var i=0;i<res_model_ingredients.length;i++)
            {
               res_model_ingredients1 =res_model_ingredients[i];
               alert(res_model_ingredients1['itemName']); 
               // string_model_ingredients+='<div class="col-sm-6"><div class="form-group"><label class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input"><span class="custom-control-indicator"></span><span class="custom-control-description">Tomato ($1.29)</span></label></div>':
            }

               }      
        }); 
      }
 </script>

<?php include 'footer.php'; ?>