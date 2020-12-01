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

$contactDetails = $myCategory->getContactDetails(accNum);

// require_once "header.php";
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
</style>

         <div class="header-bottom hidden-compact">

         <div class="container" style="">

         <div class="row">

            <div class="logo " style="width: 100%;display: inline-block;float: left;margin-bottom: 
            50px;">
                    <p style="font-size: 28px;margin-bottom: 0;margin-top:-5px;color: #ff2d37;font-family: 'Grenze', serif;">AUTO HUB SOLUTIONS      </p>

                    <p style="margin: 0;">ABN : <?php echo $contactDetails['abn']; ?> </p>
                    <p style="margin: 0;">Email : <?php echo $contactDetails['email']; ?> </p>
                    <p style="margin: 0;">Contact : <?php echo $contactDetails['mobile']; ?> </p>
                    

                </div>
         

            <div id="content" class="col-md-12 col-sm-12">

                <div class="products-category">

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



    <div class="product-layout col-lg-4 col-md-4 col-sm-6 col-xs-12" style="width: 25%;display: inline-block;float: left;padding: 15px;">

        <div class="product-item-container item--static" style="border: 1px solid #ddd;padding: 15px;">

            <div class="left-block">

                <div class="product-image-container second_img">

                    
                      <?php if($imageTag != ""){ ?>
                        <!-- <img  src="<?php echo $imageTag;?>" class="img_offer img-responsive" alt="image" style="width: 90px !important;  position: absolute;  top: 0;  right: 0;  z-index: 99;"> -->
                      <?php } ?>
                        <img src="<?php echo $product_arr['image'];?>" class="img-2 img-responsive" alt="image2" style="width: 100%;">

                    
                </div>

                

            </div>

            <div class="right-block">

                <h4><?php echo $product_arr['menuName']; ?></h4>
                
                <div class="description item-desc hidden">
                  <p><?php echo $product_arr['description']; ?></p>

                    <p>Part No. : <?php echo ($product_arr['Calories'] != null ? $product_arr['Calories'] : "NA");?></p>
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

                    
                </div>



            </div>

            </div>

            </div>

      </header>

      <!-- //Header Container  -->


<!-- Main Container  -->
      </div>

      <!-- //Main Container -->

     