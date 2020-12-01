<?php 
    $active_page = "Dashboard";
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
<style type="text/css">
    .sidebar{
      display: none;
    }
    .card-header {
      display: none;
    }
    .main-panel {
      width: 100%;
    }
</style>

    <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Dashboard</a>
            <!-- <button type="submit" class="btn btn-primary btn-round"  style="font-size: 12px;float: right; >Add New Table</button> -->
          </div>
          <div class="col-md-8"></div>
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
            <!-- <a class="navbar-brand" href="#pablo">Dashboard</a> -->
         
         </div>
          <div class="col-md-8"></div>
            <!-- <a href="kitchen2.php" class="btn btn-primary btn-round" style="font-size: 12px;float: right;">Kitchen</a> -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-bar navbar-kebab"></span>
              <span class="navbar-toggler-bar navbar-kebab"></span>
              <span class="navbar-toggler-bar navbar-kebab"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navigation">
            
              <ul class="navbar-nav">
              
                <li class="nav-item btn-rotate dropdown">
                  <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="nc-icon nc-layout-11"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="logout.php">Logout</a>
                  </div>
                </li>
              </ul>
            </div>
      </div>
   </nav>

         <!--  <a href="kitchen2.php" class="btn btn-primary btn-round" style="font-size: 12px;float: right;">Kitchen</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button> -->
       
        </div>
    <div class="content" >
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-globe text-warning"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Total Pax</p>
                      <p class="card-title" id="total_pax">
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-refresh"></i> Update Now
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-money-coins text-success"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Open Tables</p>
                      <p class="card-title" id="total_openTable">
                        <p>
                    </div>
                  </div>

                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-calendar-o"></i> Last day
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-vector text-danger"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Order in Que</p>
                      <p class="card-title" id="total_queOrder">
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-clock-o"></i> In the last hour
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-favourite-28 text-primary"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Pick Up Ready</p>
                      <p class="card-title" id="total_pickReady">
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-refresh"></i> Update now
                </div>
              </div>
            </div>
          </div>
        </div>
     </div>
   <!-- Navbar -->
   <div class="main-panel">
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
            <!-- <a class="navbar-brand" href="#pablo">Dashboard</a> -->
            <?php $p = 0; 
               foreach ($activeTables as $activeTable) 
               { 
               
                   $department = $activeTable['department'];
                   ?>
            <button type="button" class="btn btn-primary btn_department" id="btn_department_<?php echo $department['id'];?>" onclick="show_table_department(<?php echo $department['id'];?>)"><?php  echo $department['name'] ?></button>
            <?php } ?>
         </div>
          <div class="col-md-8"></div>
            <!-- <a href="kitchen2.php" class="btn btn-primary btn-round" style="font-size: 12px;float: right;">Kitchen</a> -->
            <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-bar navbar-kebab"></span>
              <span class="navbar-toggler-bar navbar-kebab"></span>
              <span class="navbar-toggler-bar navbar-kebab"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navigation">
            
              <ul class="navbar-nav">
              
                <li class="nav-item btn-rotate dropdown">
                  <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="nc-icon nc-layout-11"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="logout.php">Logout</a>
                  </div>
                </li>
              </ul>
            </div> -->
      </div>
   </nav>
   <!-- End Navbar -->
   <!-- <div class="panel-header panel-header-lg">
      <canvas id="bigDashboardChart"></canvas>
    </div> -->
   <div class="content">
      <div class="row" style="display: block;">
         <div class="item_table_test" id="now_table_test">
            <div class="row">
               <div class="col-md-12">
                  <div class="card ">
                     <?php $p = 0; 
                        //print_r($activeTables);
                           foreach ($activeTables as $activeTable) 
                           { 
                        
                               // print_r($activeTable['department']);
                        
                               $department = $activeTable['department'];
                               $active_tbl = $activeTable['department']['active_tables'];
                        
                               
                           $p++;
                           ?>
                     <div class="card-header " id="department_button_<?php echo $department['id']; ?>">
                        <h5 class="card-title"><?php echo $department['name']; ?>
                           <button type="submit" class="btn btn-primary btn-round"  style="font-size: 12px;float: right;" onclick="addNewTable(<?php echo $department['id']; ?>)" >Add New Table</button>
                        </h5>
                        <?php 
                           foreach ($active_tbl as $active_tbl1) { 
                              if(count($active_tbl1)>0){
                             
                           ?>
                        <button type="submit" class="btn btn-primary btn-round" id="table_btn_<?php echo $active_tbl1['id']; ?>" onclick="GetIvoiceDetail(<?php echo $active_tbl1['id']; ?>)" ><?php echo $active_tbl1['info1']; ?></button>
                        <!-- <p class="card-category"><?php echo $active_tbl1['info1']; ?></p> -->
                        <?php }
                              else{
                                 echo"No Data Found";
                              }
                              }
      
                            ?>
                            
                     </div>
                     <!-- <li><a href="#items_<?php echo $department['id']; ?>" onclick="open_menu_items()"><?php echo $department['name']; ?></a></li> -->
                     <?php }     ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="modal fade" id="addNewTable" role="dialog">
      <div class="modal-dialog modal-lg">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header modal-header-lg">
               <h4 class="modal-title" style="width: 100%;">New Table
               </h4>
               <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
               <input type="hidden" name="department_id" id="department_id" value="">
               <div class="row">
                  <div class="col-md-4 pr-1">
                     <div class="form-group">
                        <label>Table No.</label>
                        <input type="text" class="form-control" placeholder="Table No" name="new_table_number" id="new_table_number">
                     </div>
                  </div>
                  <div class="col-md-4 pl-1">
                     <div class="form-group">
                        <label>Pax</label>
                        <input type="text" class="form-control" name="pax_number" id="pax_number" placeholder="Pax" value="">
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" onclick="CreateNewTable()">Submit</button>
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
   <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog modal-lg">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header modal-header-lg">
               <h4 class="modal-title" style="width: 100%;">
                  
                  <p class="col-md-4" style="float: right;">
                     <!-- <span>T-</span> -->
                     <input type="text" name="table_number" id="table_number" disabled="true" style="max-width: 70%; float: right;">
                  </p>

                  <div class="col-md-4 pr-1" style="float: right;   ">
                     <div class="form-group">
                        <label>Pax</label>
                        <input type="text" onchange="update_paxNumber()" id="paxNumber" Name="paxNumber" class="" placeholder="Pax" value="" style=" width: 50%;">
                     </div>
                  </div>

                  <div class="col-md-4 pr-1" style="float: right;">
                     <div class="form-group">
                        <!-- <label>Item Code.</label> -->
                        <!-- <input type="text" class="form-control" id="item_code" placeholder="Item Code" value=""> -->
                        <select class="chosen" class="form-control" data-placeholder="Search Member" onchange="update_client_onInvoice()" id="search_member">
                        </select>
                     </div>
                  </div>
               </h4>
               <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
               <div class="row">
                  <!-- <div class="col-md-4 pr-1">
                     <div class="form-group">
                       <label>KOT No.</label>
                       <input type="text" class="form-control" placeholder="City" value="Melbourne">
                     </div>
                     </div> -->
                  
                  <!-- <div class="col-md-4 pl-1">
                     <div class="form-group">
                       <label>Steward Code</label>
                       <input type="number" class="form-control" placeholder="ZIP Code">
                     </div>
                     </div> -->
               </div>
               
               <button type="button" class="btn btn-default table_switch_btn active" id="now_btn" onclick="show_table('now')">NOW</button>
               <button type="button" class="btn btn-default table_switch_btn" id="full_btn" onclick="show_table('full')">ORDERED</button>
               <button type="button" class="btn btn-default table_switch_btn" style="display: none;" id="full_btn" onclick="show_table('payment')">Payment</button>
               <div class="item_table" id="now_table">

                <div class="add_new_item_div" style="padding: 15px;border: 1px solid #ddd;margin: 0 0 10px 0px;">
                  <div class="row">
                     <div class="form-group">
                        <label style="padding: 0 15px;">Add New Item</label>
                     </div>
                  </div>
                  <div class="row">
                     <input type="hidden" name="hiddeninvoiceId" id="hiddeninvoiceId">
                     <input type="hidden" name="hidden_itemId" id="hidden_itemId" value="0">
                     <div class="col-md-4 pr-1">
                        <div class="form-group">
                           <!-- <label>Item Code.</label> -->
                           <!-- <input type="text" class="form-control" id="item_code" placeholder="Item Code" value=""> -->
                           <select class="chosen" class="form-control" data-placeholder="Item"  id="item_code">
                           </select>
                        </div>
                     </div>
                     <div class="col-md-2 px-1">
                        <div class="form-group">
                           <!-- <label>Quantity</label> -->
                           <!-- <input type="number" class="form-control" id="item_quantity" placeholder="Quantity" value=""> -->
                           <input list="browsers" value="1" name="item_quantity" id="item_quantity" placeholder="Quantity" style="width: 100%;margin-top: 5px;">
                           <datalist id="browsers">
                              <?php for($i =1; $i<=10; $i++){
                                 ?>
                              <option value="<?php echo $i; ?>">
                                 <?php } ?>    
                           </datalist>
                        </div>
                     </div>
                     <div class="col-md-6 pl-1">
                     <div class="form-group">
                     <!-- <input type="submit" class="form-control" placeholder="ZIP Code" value="Add Item"> -->
                     <button type="submit" class="btn btn-primary btn-round" onclick="addItemIncart()" style="margin-top: 0;">Add Item</button>
                     <!-- <button type="submit" class="btn btn-primary btn-round" style="margin-top: 0;" data-target="#items_list" data-toggle="modal">?</button> -->
                     <button type="submit" class="btn btn-primary btn-round" style="margin-top: 0;" onclick="Confirm_items_list()">Confirm</button>
                     </div>
                     </div>
                  </div>
               </div>
               <!-- <div>
                  <input type="text" name="search_items" id="search_items">
                  </div> -->
               <table style="border: 1px solid #ddd;width: 100%;" id="cart_list_items" class="form-group">
               <thead class="cart__row cart__header">
               <tr>
               <th class="cart_items">SNo</th>
               <th class="cart_items">Item Code</th>
               <th class="cart_items">Description</th>
               <th class="cart_items">Quantity</th>
               <th class="cart_items">Rate</th>                        
               <th class="cart_items">Amount</th>
               <th class="cart_items">Action</th>
               </tr>
               </thead>
               <tbody id="invoice_items_tr">
               </tbody>
               </table>
               <button id="confirm_item" type="button" class=" disabled btn btn-default" onclick="Confirmitems()">Confirm</button>
               </div>
               <div class="item_table" id="full_table" style="display: none">
               <table style="border: 1px solid #ddd;width: 100%;" id="cart_list_items" class="form-group">
               <thead class="cart__row cart__header">
               <tr>
               <th class="cart_items">SNo</th>
               <th class="cart_items">Item Code</th>
               <th class="cart_items">Description</th>
               <th class="cart_items">Quantity</th>
               <th class="cart_items">Rate</th>
               <th class="cart_items">Amount</th>
               </tr>
               </thead>
               <tbody id="invoice_items_fulltr">
               <tr id="item"><td class="cart_items_empty" colspan=6>No item added</td></tr>
               </tbody>
               </table>
               <div class="row">
               <div class="col-md-9" style="text-align: right; "><label>Total</label></div>
               <div class="col-md-3" style="float: right">
               <div class="form-group ">
               <input id="sub_total" class="form-control" type="text" value="" readonly> 
               </div>
               </div>
               </div>
               <div class="row">
               <div class="col-md-3">
               <div class="form-group">
               <label>Extra Charges</label>
               <input id="extra_charge" class="form-control" type="text" value=""  onkeyup="retotaling()"> 
               </div>
               </div> 
               <div class="col-md-3 ">
               <div class="form-group">
               <label>CGST</label>
               <input id="cgst_val" class="form-control" type="text" value="" readonly> 
               </div>
               </div>
               <div class="col-md-3">
               <div class="form-group">
               <label>SGST</label>
               <input id="sgst_val" class="form-control" type="text" value="" readonly> 
               </div>
               </div>
               <div class="col-md-3">
               <div class="form-group">
               <label>Subtotal</label>
               <input id="subtotal_val" class="form-control" type="text" value=""> 
               </div>
               </div>
               </div>
               <button id="Subtotal" onclick="ConfirmInvoice()" class=" disabled btn btn-default table_switch_btn" type="button" >Close Order</button>
               <!-- </div> -->
               <!-- subtotal -->
               </div>
               <div class="item_table payment_div_table" id="payment_table" style="display: none">
               <div class="col-md-8">
               <form action="javascript:void(0);" method="post" class="cart" id="order_payment" style="width:100%">
               <br> 
               <input  name="accNum" id="order_payment_accnum"  type="hidden" value="<?php echo $accNum; ?>" />
               <input  name="invoice_id"  id="order_payment_invoiceId"  type="hidden" value="" />
               <input  name="invoicenum"  id="order_payment_invoiceNum"  type="hidden" value="" />
               <input  name="regNo"  id="regNo"  type="hidden" value="" />
               <div class="form-group row">
               <div class="col-md-3">
               <label for="Description" style="float: right;"> Total Bill:</label> 
               </div>
               <div class="col-md-9" style="float: right;">
               <input required class="form-control" id="total_bill" name="total_bill"  type="text" readonly/>
               </div>
               </div> 
               <div class="form-group row">
               <div class="col-md-3">
               <label for="Description" style="float: right;"> GST-1</label> 
               </div>
               <div class="col-md-9" style="float: right;">
               <input required class="form-control" id="gst1" name="gst1"  type="text" readonly />
               </div>
               </div> 
               <div class="form-group row">
               <div class="col-md-3">
               <label for="Description" style="float: right;"> GST-2:</label> 
               </div>
               <div class="col-md-9" style="float: right;">
               <input required class="form-control" id="gst2" name="gst2"   type="text" readonly/>
               </div>
               </div>
               <div class="row">
               <div class="col-md-4">
               <div class="form-group">
               <label>Discount</label>
               <input id="pay_discount" name="pay_discount" class="form-control" type="text" value=""  onkeyup="finalammount()"> 
               </div>
               </div>  
               <div class="col-md-4 ">
               <div class="form-group">
               <label>Amount</label>
               <input id="pay_amount" name="pay_amount" class="form-control" type="text" value="" readonly> 
               </div>
               </div>
               <div class="col-md-4">
               <div class="form-group">
               <label>Type</label>
               <select id="payment_type" name="payment_type" class="form-control">
               <option value="" disabled selected hidden>Payment Type</option>
               <option value="1">Cash</option>
               <option value="2">CC</option>
               <option value="3">Bank</option>
               <option value="4">Account</option>
               </select> 
               </div>
               </div>
               </div>
               <div class="row">
               <div class="col-md-4">
               </div>
               <div class="col-md-4">
               <div class="form-group">
               <input onclick="SubmitOrder()" class="form-control btn btn-default" type="submit" value="Submit"> 
               </div>
               </div>  
               </div>
               <div class="alert alert-success" id="order_success_message" style="display: none;">
               <strong>Success!</strong> Order has been proceed successfully.
               </div>
               </form>
               </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="items_list" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" style="width: 100%;">Item List
            </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-4"><label>Select Category</label></div>
               <div class="col-md-8">
                  <select  id="all_category" data-placeholder="Choose a items..."  tabindex="2" class="form-control" onchange="getCategoryItems()">
                     <!-- <select class="chosen" style="width: 20% !important;"> -->
                     <option value="">--Select Category--</option>
                     <?php
                        // while($row=mysqli_fetch_array($res))
                        foreach ($categories_item as $category_list) 
                         {
                        ?>
                     <option value="<?php echo $category_list['categoryNum'] ; ?>"><?php echo $category_list['categoryName'] ; ?></option>
                     <!-- <option value="Tawa Paneer">Tawa Paneer</option>
                        <option value="Tawa roti">Tawa roti</option>
                        <option value="Tawa paratha">Tawa paratha</option>
                         <option value="Aland Islands">Aland Islands</option>
                         <option value=""></option> -->
                     <?php
                        }
                        ?>
                  </select>
               </div>
            </div>
            <div class="row">
               <div class="col-md-4"><label>Select Item</label></div>
               <div class="col-md-8">
                  <select class="chosen" onchange="get_item_selected()" style="width: 80% !important;" id="category_list_item">
                  </select>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
   $("#department_button_1").show();
   
   
   //    $(window).load(function(){
   // $(".chosen").chosen()
   // });
</script>
<script>
   $(document).ready(function() {
     // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
     demo.initChartsPages();
   });
   
   
   function update_client_onInvoice(){
   
    invoiceId = $("#hiddeninvoiceId").val();
    clientNum = $("#search_member").val();
    //alert(clientNum);
    $.ajax({
           type: 'POST',
           url: 'ajax.php?action=update_client_onInvoice',
           data: {invoiceId:invoiceId,clientNum:clientNum},
           success: function (response) {
           // alert(response);
           }
       });
   }
   
   function CreateNewTable()
   {
    //validation -----------
   
    var table=$("#new_table_number").val();
    var  pax=$("#pax_number").val();
    var  department_id=$("#department_id").val();
   
   
    $.ajax({
           type: 'POST',
           url: 'ajax.php?action=CreateNewTable',
           data: {table:table,pax:pax,department_id:department_id},
           success: function (response) {
              // alert(response);
             var obj = JSON.parse(response);
            $('#addNewTable').modal('toggle');
   
            $("#new_table_number").val("");
            $("#pax_number").val("");
            $("#department_id").val("");
   
   
            var invoice_id=obj['invoice_id'];
            var table_name=obj['table'];
   
            var new_button='<button type="submit" id="table_btn_'+invoice_id+'" class="btn btn-primary btn-round" onclick="GetIvoiceDetail('+invoice_id+')" >'+table_name+'</button>';
   
            $("#department_button_"+department_id).append(new_button);
           }
       });
   }
   function retotaling()
   {
     var total_ammount=$("#sub_total").val();
     var extra_ammount=$("#extra_charge").val();
     var sgst_ammount=$("#sgst_val").val();
     var scst_ammount=$("#cgst_val").val();
   
   
     var subtotal_ammount=Number(total_ammount)+Number(extra_ammount)+Number(sgst_ammount)+Number(scst_ammount);
     var subtotal_ammount1=subtotal_ammount.toFixed(2);
      $("#subtotal_val").val(subtotal_ammount1);
      
   
   }
   function finalammount()
   {
     var total_payment=$("#total_bill").val();
     var gst1=$("#gst1").val();
     var gst2=$("#gst2").val();
     var discount=$("#pay_discount").val();
     var totalP=Number(total_payment)+Number(gst1)+Number(gst2)-Number(discount);
     var totalP=totalP.toFixed(2);
     $("#pay_amount").val(totalP);
   
   }
   
   function Confirm_items_list()
   {
         invoiceId = $("#hiddeninvoiceId").val();
        itemCode = $("#item_code").val();
        item_quantity = $("#item_quantity").val();
        hidden_itemId = $("#hidden_itemId").val();
        search_member = $("#search_member").val();
   
          if(itemCode=="")
            {
                 swal({
                 title: "OOPS",
                 text: "Please add item code",
                 type: "warning",
                 icon: "success",
                });
                //alert("Please add item code");
            }
          if(item_quantity=="")
            {
               //alert("Please add item quantity");
               swal({
                 title: "OOPS",
                 text: "Please add item Quantity",
                 type: "warning",
                 icon: "success",
                });
            }   
         if(itemCode!="" && item_quantity != "")
           {
          
             $.ajax({
                   type: 'POST',
                   url: 'ajax.php?action=Confirm_items_list',
                   data: {invoiceId:invoiceId,itemCode:itemCode,item_quantity:item_quantity,itemId:hidden_itemId,search_member:search_member},
                   success: function (response)
                 {
                      // alert(response);
                    $("#item_code").val("");
                  $("#item_code option[selected]").removeAttr("selected");
                  $("#item_code").val('').trigger("chosen:updated");
                   $("#item_quantity").val("1");
                   $("#hidden_itemId").val(0);
                   refresh_tables(invoiceId);
                   $('#myModal').modal('toggle');
                   GetIvoiceDetail(invoiceId);
                }
                  })
           }
   
   }
   getAllItems();
   
   function getAllItems()
   {
       $.ajax({
           type: 'POST',
           url: 'ajax.php?action=getAllItems',
           data: {},
           success: function (response)
             {
              // alert(response);
   
               var obj= JSON.parse(response);
                $("#item_code").html("");
   
               var selectItem_list="<option></option>";
               for(var i=0;i<obj.length;i++)
               {
                if(obj[i]['itemCode'] != ''){
   
                selectItem_list+='<option id="cat_list_close"  value="'+obj[i]['itemCode']+'">'+obj[i]['info1']+' '+obj[i]['itemCode']+'</option>'
                }
               }
               // alert(selectItem_list);
               $("#item_code").html(selectItem_list);
               $('#item_code').trigger("chosen:updated");
   
             }
   
             })
   
   
   
   }
   
   getAllMembers();
   
   function getAllMembers()
   {
       $.ajax({
           type: 'POST',
           url: 'ajax.php?action=getAllMembers',
           data: {},
           success: function (response)
             {
              // alert(response);
              var obj= JSON.parse(response);
              $("#search_member").html("");
   
              var selectItem_list="<option></option>";
              for(var i=0;i<obj.length;i++)
              {
                if(obj[i]['id'] != ''){
                  selectItem_list+='<option value="'+obj[i]['staffNum']+'">'+obj[i]['name']+' '+obj[i]['mobile']+' '+obj[i]['jobType']+'</option>';
                }
              }
               // alert(selectItem_list);
               $("#search_member").html(selectItem_list);
               $('#search_member').trigger("chosen:updated");
   
             }
   
           })
   }
   
   function getCategoryItems()
   {
     var selected_cat=$("#all_category").val();
       $.ajax({
           type: 'POST',
           url: 'ajax.php?action=getCategoryItems',
           data: {selected_cat:selected_cat},
           success: function (response)
             {
               //alert(response);
               var obj= JSON.parse(response);
               //$('#myModal').modal('toggle');
               $("#category_list_item").html("");
   
               var cat_list="<option></option>";
   
                //alert(obj.length);
   
               for(var p=0; p<obj.length;p++)
               {
   
                 K = p+1;
                       
                 // cat_list+='<tr><td class="cart_items">'+K+'</td><td class="cart_items">'+obj[p]['info1']+'</td><td class="cart_items">'+obj[p]['itemCode']+'</td><td class="cart_items"><input type="radio" onchange="get_item_selected()" name="item_code_modal" value="'+obj[p]['itemCode']+'">  </td> </tr>'
   
                 cat_list+='<option id="cat_list_close"  value="'+obj[p]['itemCode']+'">'+obj[p]['info1']+' '+obj[p]['itemCode']+'</option>'
               }
   
               // alert(cat_list);
   
   
                if(cat_list == "")
                {
                    cat_list+='<tr id="item"><td class="cart_items_empty" colspan=4>No item added</td></tr>';
                }
                //alert(cat_list);
                $("#category_list_item").html(cat_list);
                $('#category_list_item').trigger("chosen:updated");
             }
   
           })
   }
   
   
   function addNewTable(department)
   {
    $("#department_id").val(department);
    $('#addNewTable').modal('toggle');
   }
   function ConfirmInvoice()
   {
     var invoice_id=$("#hiddeninvoiceId").val();
     $.ajax({
           type: 'POST',
           url: 'ajax.php?action=ConfirmInvoice',
           data: {invoice_id:invoice_id},
           success: function (response)
             {
               // alert(response);
               $('#myModal').modal('toggle');
               $("#table_btn_"+invoice_id).remove();
               
           }
     })
   }
   
   
   function Confirmitems()
   {
     
    var invoice_id=$("#hiddeninvoiceId").val();
    $.ajax({
           type: 'POST',
           url: 'ajax.php?action=confirmitems',
           data: {invoice_id:invoice_id},
           success: function (response)
           {
             // alert(response);
             $('#myModal').modal('toggle');
             GetIvoiceDetail(invoice_id);
            
           }
       })
   }
   
   function show_table_department(id)
   {
     
     $(".card-header").hide();
     $("#department_button_"+id).show();
    $(".btn_department").removeClass("active");
    $("#btn_department_"+id).addClass("active");
   }
   function show_table(tbl)
   {
     // if(tbl == 'now')
     // {
     //   $(".add_new_item_div").show();
     // }else{
     //   $(".add_new_item_div").hide();
     // }
   
   
   
     $(".table_switch_btn").removeClass("active");
     $("#"+tbl+"_btn").addClass("active");
   
     if(tbl == 'payment')
     {
      
         getopenregisterId();
   
         
     }
   
     $(".item_table").hide();
     $("#"+tbl+"_table").show();
   }
   
   function GetIvoiceDetail(invoiceId){
    $.ajax({
           type: 'POST',
           url: 'ajax.php?action=getInvoiceDetails&id='+invoiceId,
           data: {},
           success: function (response) {
                // alert(response);
                // console.log(response);
   
            var obj = JSON.parse(response);
   
            var data = obj['order_details'];
            $("#table_number").val(data['info1']);
             $("#paxNumber").val(data['info2']);
   
            $("#hiddeninvoiceId").val(data['id']);
            $("#search_member").val(data['clientNum']);
            $('#search_member').trigger("chosen:updated");
            $("#order_payment_invoiceId").val(data['id']);
            $("#order_payment_invoiceNum").val(data['order_id']);
            $('#myModal').modal('toggle');
            $("#invoice_items_tr").html("");
            $("#invoice_items_fulltr").html("");
   
            // now table start---------
              var items = data['items_now'];
            var item_list="";
            // alert(items);
            var total_price=0;
            for(var p=0; p<items.length; p++){
              k=p+1;
              //alert(items[p]['sgst']);
              total_price=total_price+items[p]['subtotal'];
              item_list+='<tr id="item_'+items[p]['id']+'"><td class="cart_items"><input type="hidden" id="itemCode_'+items[p]['id']+'" value="'+items[p]['itemCode']+'"><input type="hidden" id="itemQTY_'+items[p]['id']+'" value="'+items[p]['quantity']+'">'+k+'</td><td class="cart_items">'+items[p]['itemCode']+'</td><td class="cart_items">'+items[p]['info1']+'</td><td class="cart_items">'+items[p]['quantity']+'</td><td class="cart_items">'+items[p]['unit_price']+'</td><td class="cart_items">'+items[p]['subtotal']+'</td><td class="cart_items"><a href="javascript:void(0)" onclick="edit_itemInvoice('+items[p]['id']+')">Edit</a> <a href="javascript:void(0)" onclick="deleteItemInvoice('+items[p]['id']+')">Delete</a></td></tr>';
            }
            // alert(total_price);
   
            if(item_list == ""){
              item_list+='<tr id="item"><td class="cart_items_empty" colspan=7>No item added</td></tr>';
            }
              else{
                $("#confirm_item").removeClass("disabled");
              }
   
   
            //alert(item_list);
   
            $("#invoice_items_tr").append(item_list);
   
            // now table end---------
   
            // full table start ------
            var items = data['items_full'];
            var item_list="";
            var full_total_price=0;
            var sgst_ammount=0;
            var cgst_ammount=0;
            var sub_ammount=0;
             //alert(items);
            for(var p=0; p<items.length; p++){
              k=p+1;
              sgst_ammount=Number(sgst_ammount)+Number(items[p]['sgst']);
              cgst_ammount=Number(cgst_ammount)+Number(items[p]['cgst']);
              full_total_price=Number(full_total_price)+Number(items[p]['subtotal']);
              sub_ammount=sgst_ammount+cgst_ammount+full_total_price;
   
              // full_total_price=full_total_price+items[p]['unit_price'];
              item_list+='<tr id="item_'+items[p]['id']+'"><td class="cart_items"><input type="hidden" id="itemCode_'+items[p]['id']+'" value="'+items[p]['itemCode']+'"><input type="hidden" id="itemQTY_'+items[p]['id']+'" value="'+items[p]['quantity']+'">'+k+'</td><td class="cart_items">'+items[p]['itemCode']+'</td><td class="cart_items">'+items[p]['info1']+'</td><td class="cart_items">'+items[p]['quantity']+'</td><td class="cart_items">'+items[p]['unit_price']+'</td><td class="cart_items">'+items[p]['subtotal']+'</td></tr>';
            }
   
              //alert("sgst"+sgst_ammount);
              // alert("subtotal_val"+sub_ammount);
              //alert("cgst"+cgst_ammount);
              // alert(full_total_price);
               sub_ammount1 = sub_ammount.toFixed(2);
              cgst_ammount1 = cgst_ammount.toFixed(2);
              sgst_ammount1 = sgst_ammount.toFixed(2);
   
               full_total_price=full_total_price.toFixed(2);
              $("#sub_total").val(full_total_price);
   
              $("#sgst_val").val(sgst_ammount1);
              $("#cgst_val").val(cgst_ammount1);
              $("#subtotal_val").val(sub_ammount1);
   
                $("#total_bill").val(full_total_price);
                $("#pay_amount").val(full_total_price);
                $("#gst1").val(sgst_ammount1);
                $("#gst2").val(cgst_ammount1);
   
   
            if(item_list == ""){
              item_list+='<tr id="item"><td class="cart_items_empty" colspan=7>No item added</td></tr>';
   
            }else{
                 $("#Subtotal").removeClass("disabled");
             }
   
            //alert(item_list);
   
            $("#invoice_items_fulltr").append(item_list);
            // full table end --------
   
            
            //$("#myModal").show();
   
           }
       });
   }
   
   function get_item_selected(){
    var checked_item = $("#category_list_item").val();
     // alert(checked_item);
    $("#item_code").val(checked_item);
   
    $("#items_list").modal("hide");
   
   }
   
   
   function refresh_tables(invoiceId)
   {
     $.ajax({
             type: 'POST',
             url: 'ajax.php?action=getInvoiceDetails&id='+invoiceId,
             data: {},
             success: function (response) {
                // alert(response);
               var obj = JSON.parse(response);
               $("#invoice_items_tr").html("");
               $("#invoice_items_fulltr").html("");
   
   
               var data = obj['order_details']
               $("#table_number").val(data['info1']);
               $("#hiddeninvoiceId").val(data['id']);
   
               var items = data['items_now'];
               var item_list="";
               for(var p=0; p<items.length; p++){
                 k=p+1;
                 item_list+='<tr id="item_'+items[p]['id']+'"><td class="cart_items"><input type="hidden" id="itemCode_'+items[p]['id']+'" value="'+items[p]['itemCode']+'"><input type="hidden" id="itemQTY_'+items[p]['id']+'" value="'+items[p]['quantity']+'">'+k+'</td><td class="cart_items">'+items[p]['itemCode']+'</td><td class="cart_items">'+items[p]['info1']+'</td><td class="cart_items">'+items[p]['quantity']+'</td><td class="cart_items">'+items[p]['unit_price']+'</td><td class="cart_items">'+items[p]['subtotal']+'</td><td class="cart_items"><a href="javascript:void(0)" onclick="edit_itemInvoice('+items[p]['id']+')">Edit</a> <a href="javascript:void(0)" onclick="deleteItemInvoice('+items[p]['id']+')">Delete</a></td></tr>';
               }
   
               //alert(item_list);
               if(item_list == ""){
                 item_list+='<tr id="item"><td class="cart_items_empty" colspan=7>No item added</td></tr>';
               }
               else{
                 $("#confirm_item").removeClass("disabled");
             }
   
   
               $("#invoice_items_tr").append(item_list);
   
         // now table end---------
   
         // full table start ------
         var items = data['items_full'];
         var item_list="";
         var full_total_price=0;
         var sgst_ammount=0;
         var cgst_ammount=0;
         var sub_ammount=0;
          //alert(items);
         for(var p=0; p<items.length; p++){
           k=p+1;
           sgst_ammount=Number(sgst_ammount)+Number(items[p]['sgst']);
           cgst_ammount=Number(cgst_ammount)+Number(items[p]['cgst']);
           full_total_price=Number(full_total_price)+Number(items[p]['subtotal']);
           sub_ammount=sgst_ammount+cgst_ammount+full_total_price;
   
           // full_total_price=full_total_price+items[p]['unit_price'];
           item_list+='<tr id="item_'+items[p]['id']+'"><td class="cart_items"><input type="hidden" id="itemCode_'+items[p]['id']+'" value="'+items[p]['itemCode']+'"><input type="hidden" id="itemQTY_'+items[p]['id']+'" value="'+items[p]['quantity']+'">'+k+'</td><td class="cart_items">'+items[p]['itemCode']+'</td><td class="cart_items">'+items[p]['info1']+'</td><td class="cart_items">'+items[p]['quantity']+'</td><td class="cart_items">'+items[p]['unit_price']+'</td><td class="cart_items">'+items[p]['subtotal']+'</td></tr>';
         }
   
           //alert("sgst"+sgst_ammount);
           // alert("subtotal_val"+sub_ammount);
           //alert("cgst"+cgst_ammount);
           // alert(full_total_price);
           cgst_ammount1 = cgst_ammount.toFixed(2);
           sgst_ammount1 = sgst_ammount.toFixed(2);
           $("#sub_total").val(full_total_price);
           $("#sgst_val").val(sgst_ammount1);
           $("#cgst_val").val(cgst_ammount1);
           $("#subtotal_val").val(sub_ammount);
   
         if(item_list == ""){
           item_list+='<tr id="item"><td class="cart_items_empty" colspan=7>No item added</td></tr>';
   
         }else{
             $("#Subtotal").removeClass("disabled");
         }
   
         //alert(item_list);
   
         $("#invoice_items_fulltr").append(item_list);
               
               //$("#myModal").show();
   
             }
         });
   }
   
   function addItemIncart()
   {
    invoiceId = $("#hiddeninvoiceId").val();
    itemCode = $("#item_code").val();
    item_quantity = $("#item_quantity").val();
    hidden_itemId = $("#hidden_itemId").val();
    search_member = $("#search_member").val();
   
    if(itemCode=="")
    {
      //alert("Please add item code");
           swal({
                 title: "OOPS",
                 text: "Please add item code",
                 type: "warning",
                 icon: "warning",
                });
    }
    if(item_quantity=="")
    {
      //alert("Please add item quantity");
            swal({
                 title: "OOPS",
                 text: "Please add item quantity",
                 type: "warning",
                 icon: "warning",
                });
    } 
    if(itemCode!="" && item_quantity != ""){
      $.ajax({
            type: 'POST',
            url: 'ajax.php?action=AddIvoiceItems',
            data: {invoiceId:invoiceId,itemCode:itemCode,item_quantity:item_quantity,itemId:hidden_itemId,search_member:search_member},
            success: function (response) {
              //alert(response);
   
                $("#item_code").val("");
   
                $("#item_code option[selected]").removeAttr("selected");
   
                //alert("Deselct");
   
                $("#item_code").val('').trigger("chosen:updated");
   
                //$('#item_code').trigger("chosen:updated");
   
                $("#item_quantity").val("1");
                $("#hidden_itemId").val(0);
                 refresh_tables(invoiceId);
               }
        });
     }
   }
   
   function deleteItemInvoice(itemId)
   {
    //if(confirm("Are you sure you want to delete this item"))
     //swal("Are you sure you want to do this?")
     // alert(itemId);
      swal({title: "Are you sure?",
           text: "Once deleted, you will not be able to recover this imaginary item!",
           icon: "warning",
           showCancelButton: true,
           closeOnConfirm: false,
          }, function ()
           {
             $.ajax({
             type: 'POST',
             url: 'ajax.php?action=deleteItemInvoice&id='+itemId,
             data: {},
             success: function (response) {
               // alert(response);
               //swal("Cancelled", "Your imaginary file is safe :)", "error");
               $("#item_"+itemId).remove(); 
               swal("Deleted!", "Your imaginary file has been deleted.", "success"); 
   
           }
         });
   
          });
         //swal("Cancelled", "Your imaginary file is safe :)", "error");
   
   
         
   }
   
   function edit_itemInvoice(itemId)
   {
    var item_code = $("#itemCode_"+itemId).val();
    var item_QTY = $("#itemQTY_"+itemId).val();
    $("#item_code").val(item_code);
    $("#item_quantity").val(item_QTY);
    $("#hidden_itemId").val(itemId);
   }
   
   
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
   
                       $("#body-wrapper").removeClass("fade-out-up-sm");
   
                       swal("Item added to Cart!","", "success");
   
                       var menuNum = $("#menuNum").val();
                       var totalPrice = $("#totalPrice").val();
                       var menuName = $("#menu_name_modal").text();
                       var varietyName = $("#verietyNamesingle").val();
   
   
                       var cart_data_table = '<tr><td class="title"><input type="hidden" name="" class="item_total_price" id="item_total_price'+menuNum+'" value="'+totalPrice+'"><input type="hidden" name="cart_id[]" id="'+menuNum+'" value="'+menuNum+'"><input type="hidden" name="qty[]" id="ContentPlaceHolder1_box_'+menuNum+'" value="1"><input type="hidden" name="perItemPrice[]" id="product_price_per_item_'+menuNum+'" value="'+total+'"><input type="hidden" name="extraPerItemPrice[]" id="extras_price_per_item_'+menuNum+'" value="0"><input type="hidden" name="is_stock" id="is_stock_1" value="1"><input type="hidden" name="" id="cart_id_1" value="'+menuNum+'"><span class="name">'+menuName+'</span><span class="caption text-muted">'+varietyName+'</span></td><td class="price">$'+totalPrice+'</td><td class="actions" style=" "><a href="#" class="action-icon" onclick="update_cart_page('+menuNum+',0);"><i class="ti ti-close"></i></a></td></tr>';
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
   
   
   }
   
   
   function SubmitOrder()
   {
   
   
     if($("#payment_type").val()){
      // alert($("#payment_type").val());
    
        $.ajax({
           type: 'POST',
           url: 'ajax.php?action=InsertOrderPayment',
           data: $('#order_payment').serializeArray(),
           success: function (response) {
               // alert(response);
               if(response == 1)
               {
                 $("#order_success_message").show();
                 // location.reload();
               }else{
                // alert("Something went wrong")
                 swal({
                 title: "OOPS",
                 text: "Something went wrong! Please Try again later",
                 type: "warning",
                 icon: "error",
                });
               }
   
           }
         });
      }else{
       
        swal({
                 title: "OOPS",
                 text: "Please Select Payment Type",
                 type: "warning",
                 icon: "error",
                });
      }
   
   }
   
   
   function getopenregisterId()
   {
       $.ajax({
           type: 'POST',
           url: 'ajax.php?action=getopenregisterId',
           data: {},
           success: function (response) {
              // alert(response);
             // response = 0;
            if(response==0)
            {
               swal({
                      title: "OOPS",
                        text: "You Don't have open Register",
                  type: "warning",
                  showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Click here to Open Register!"
                  },
                function(isConfirm) {
              if (isConfirm) {
                   window.location="sale_register.php";
              } 
          });
               show_table('now');
            }
            else
            {
              
               $("#regNo").val(Number(response));
            }
            
   
   
           }
       })
   }
   
   function update_paxNumber()
   {
    var paxNumber= $("#paxNumber").val();
    var table_number= $("#table_number").val();
     var invoice_id=$("#hiddeninvoiceId").val();
      $.ajax({
           type: 'POST',
           url: 'ajax.php?action=update_paxNumber',
           data: {paxNumber:paxNumber,invoice_id:invoice_id},
           success: function (response) {
               // alert(response);
   
             }
           })
   
   }
     Dashboard_data();
    function Dashboard_data()
    {
           $.ajax({
            type: 'POST',
            url: 'ajax.php?action=Dashboard_data_Report',
            data: {},
            success: function (response) {
                // alert(response);
                var obj=JSON.parse(response);

                $("#total_pax").text(obj['total_pax']);
                $("#total_openTable").text(obj['open_table']);
                $("#total_queOrder").text(obj['que_order']);
                $("#total_pickReady").text(obj['picup_order']);

              }
            })
    }
   
</script>
</body>
</html>
