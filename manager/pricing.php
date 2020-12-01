<?php 

$active_page = "pricing";
include_once "header.php";
 //require_once "data.php";
 //$myCategory = new Category();
 // print_r($con);
 
// print_r($_SESSION);
$HTTP_HOST='http://hotel.staffstarr.com/manager/';

if(!isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] != 1)
{
    header("location:index.php");
}

    // print_r($_SESSION);//die;

    // Array ( [manager_id] => 307 [name] => Hotel Pty Ltd [accNum] => 12103 [is_logged_in] => 1 )


$accNum = $_SESSION['accNum'];//12103;
$name = $_SESSION['name'];

// echo ($HTTP_HOST."ajax.php?action=activeTables&accNum=".$accNum);die;
$activeTables_json=file_get_contents($HTTP_HOST."ajax.php?action=activeTables&accNum=".$accNum);

  // print_r($activeTables_json);die;
$activeTables=json_decode($activeTables_json,true);

// $activeTables = $myCategory->activeTables($accNum);



$categories_item_json=file_get_contents($HTTP_HOST."ajax.php?action=categories_item_list&accNum=".$accNum);
$categories_item=json_decode($categories_item_json,true);
 // $categories_item = $myCategory->categories_item_list($accNum);
// print_r($categories_item); die;

?>
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
* {
  box-sizing: border-box;
}

.columns {
  float: left;
  width: 32.3%;
  padding: 8px;
}

.price {
  list-style-type: none;
  border: none;
  margin: 0;
  padding: 0;
  -webkit-transition: 0.3s;
  transition: 0.3s;
}

.price:hover {
  box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
}

.price .header {
  background-color: #3fa8f3;
  color: white;
  font-size: 25px;
}
.price .header i{
	color: #fff;

}
.price li {
  border-bottom: 1px solid #eee;
  padding: 15px;
  text-align: center;
}

.price .grey {
  background-color: #eee;
  font-size: 20px;
}

.button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 10px 25px;
  text-align: center;
  text-decoration: none;
  font-size: 18px;
}

.row-eq-height {
	display: -webkit-box;
}
.card{
	border-radius: 10px;
	overflow: hidden;
}
.main-panel .header{
	margin: 0;
	font-weight: 600;
}
.bg-2{
	background-color: #3fa8f329;
}
.btn-main{
	background: #3fa8f3;
}
@media only screen and (max-width: 600px) {
  .columns {
    width: 100%;
  }
}
</style>

    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Pricing</a>
            <!-- <button type="submit" class="btn btn-primary btn-round"  style="font-size: 12px;float: right; >Add New Table</button> -->
          </div>
          <div class="col-md-8"></div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <!-- <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="nc-icon nc-zoom-split"></i>
                  </div>
                </div>
              </div>
            </form> -->
            <ul class="navbar-nav">
              <!-- <li class="nav-item">
                <a class="nav-link btn-magnify" href="#pablo">
                  <i class="nc-icon nc-layout-11"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Stats</span>
                  </p>
                </a>
              </li> -->
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-layout-11"></i>
                  <!-- <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p> -->
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link btn-rotate" href="#pablo">
                  <i class="nc-icon nc-settings-gear-65"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Account</span>
                  </p>
                </a>
              </li> -->
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <!-- <div class="panel-header panel-header-lg">

  <canvas id="bigDashboardChart"></canvas>


</div> -->
      <div class="content">
        
        <div class="row">
          <div class="col-md-12">
            <div class="row-eq-height">


              <div class="columns col-md-4">
              	<div class="card">
	                <ul class="price">
	                  <li class="header">Basic</li>
	                  <li class="bg-1">$ 9.99 / year</li>
	                  <li class="bg-2">10GB Storage</li>
	                  <li class="bg-1">10 Emails</li>
	                  <li class="bg-2">10 Domains</li>
	                  <li class="bg-1">1GB Bandwidth</li>
	                  <li class="text-detail">
	                  	<p class="p-0 m-0">It’s a mixture of essential icons and symbols for everyday design work.</p>
	                  	<h3 class="p-0 m-0">$19.93</h3>
	                  </li>
	                  <li><a href="#" class="btn btn-round btn-secondary btn-main">Sign Up</a></li>
	                </ul>
	            </div>
              </div>

              <div class="columns col-md-4">
              	<div class="card">
	                <ul class="price">
	                  <li class="header">Pro</li>
	                  <li class="bg-1">$ 24.99 / year</li>
	                  <li class="bg-2">25GB Storage</li>
	                  <li class="bg-1">25 Emails</li>
	                  <li class="bg-2">25 Domains</li>
	                  <li class="bg-1">2GB Bandwidth</li>
	                  <li class="text-detail">
	                  	<p class="p-0 m-0">It’s a mixture of essential icons and symbols for everyday design work.</p>
	                  	<h3 class="p-0 m-0">$19.93</h3>
	                  </li>
	                  <li><a href="#" class="btn btn-round btn-secondary btn-main">Sign Up</a></li>
	                </ul>
	            </div>
              </div>

              <div class="columns col-md-4">
              	<div class="card">
	                <ul class="price">
	                  <li class="header">Premium</li>
	                  <li class="bg-1">$ 49.99 / year</li>
	                  <li class="bg-2">50GB Storage</li>
	                  <li class="bg-1">50 Emails</li>
	                  <li class="bg-2">50 Domains</li>
	                  <li class="bg-1">5GB Bandwidth</li>
	                  <li class="text-detail">
	                  	<p class="p-0 m-0">It’s a mixture of essential icons and symbols for everyday design work.</p>
	                  	<h3 class="p-0 m-0">$19.93</h3>
	                  </li>
	                  <li><a href="#" class="btn btn-round btn-secondary btn-main">Sign Up</a></li>
	                </ul>
	            </div>
              </div>
            </div>
          </div>
        </div>
      
      </div>


</div>






    </div>
  </div>

  <!--   Core JS Files   -->

  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>

  <script src="assets/js/core/bootstrap.min.js"></script>

  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>



<script type="text/javascript">
    $(document).ready(function(){

   $("#category_list_item").chosen();
   })

    $(document).ready(function(){

   $("#item_code").chosen();
   $("#search_member").chosen();
   })
    

//    $(window).load(function(){
// $(".chosen").chosen()
// });
 </script>


  <script>


    $(document).ready(function() {
      // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
      demo.initChartsPages();
    });
</script>
</body>

</html>
