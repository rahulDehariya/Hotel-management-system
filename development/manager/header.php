<?php include_once 'config/config.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Restaurant
  </title>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Sweetalert     -->
  <link rel="stylesheet" href="https://wfolly.firebaseapp.com/node_modules/sweetalert/dist/sweetalert.css">
  <script src="https://wfolly.firebaseapp.com/node_modules/sweetalert/dist/sweetalert.min.js"></script>

    <!-- choosen -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">

    
  <!--     Fonts and icons     -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" /> -->
  <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet"> -->
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
  <style type="text/css">
      .cart_items {
        display: table-cell;
        padding: 5px;
        text-align: center;
    	border: 1px solid #ddd;
    }
    #table_number{
    	text-align: center;
    }
    .select {
 top: 22px ;
 left: 8px ;
}


#category_list_item_chosen{
  width: 100% !important;
  margin-top: 5px;
}
#item_code_chosen{
  width: 100% !important;
  margin-top: 5px;
}

#search_member_chosen{
	width: 100% !important;
}


  </style>
  
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="assets/img/logo-small.png">
          </div>
        </a>
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
          <?php echo $name; ?>
          <!-- <div class="logo-image-big">
            <img src="assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="<?php echo ($active_page == 'Dashboard' ? 'active' : '');?> ">
            <a href="dashboard.php">
              <i class="nc-icon nc-bank"></i>
              <p>Dashboard</p>
            </a>
          </li> 
          <li class="<?php echo ($active_page == 'MemberShip' ? 'active' : '');?> ">
            <a href="membership.php">
              <i class="nc-icon nc-bank"></i>
              <p>MemberShip</p>
            </a>
          </li>
         <li class="<?php echo ($active_page == 'Report' ? 'active' : '');?> ">
            <a href="reports.php">
              <i class="nc-icon nc-bank"></i>
              <p>Reports</p>
            </a>
          </li>
         
         <li class="<?php echo ($active_page == 'sale_register' ? 'active' : '');?> ">
            <a href="sale_register.php">
              <i class="nc-icon nc-bank"></i>
              <p>Sales Register</p>
            </a>
          </li>
         
       <!--   <li class="<?php echo ($active_page == 'pricing' ? 'active' : '');?> ">
            <a href="pricing.php">
              <i class="nc-icon nc-bank"></i>
              <p>Pricing</p>
            </a>
          </li> -->
         <li class="<?php echo ($active_page == 'sale_register' ? 'active' : '');?> ">
            <a href="logout.php">
              <i class="nc-icon nc-bank"></i>
              <p>Logout</p>
            </a>
          </li>
         
        </ul>
      </div>
    </div>