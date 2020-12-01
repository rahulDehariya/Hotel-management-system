<?php 
// require_once "getdata/data.php";
  require_once "header.php";
// $myCategory = new Category();
if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];

       
       // $getUserDetails_json = file_get_contents("http://hotel.staffstarr.com/ajax.php?action=getUserDetails&user_id=".$user_id);

       // $getUserDetails=json_decode($getUserDetails_json,true);

       //  // $getUserDetails = $myCategory->getUserDetails(accNum,$user_id);
       // // echo("http://hotel.staffstarr.com/ajax.php?action=getUserAddress&user_id=".$user_id);
       // $userAddr_api=file_get_contents("http://hotel.staffstarr.com/ajax.php?action=getUserAddress&user_id=".$user_id);

       // $getUserAddress=json_decode($userAddr_api);
       //  // $getUserAddress = $myCategory->getUserAddress($user_id);
        
       //  // $address = $getUserAddress['address'];
       //  $clientName = $getUserDetails['username'];
       //  $email = $getUserDetails['email'];
       //  $mobile=$getUserDetails['mobile'];
    }


    $_SESSION['accNum1'] = accNum;



// $order_id = $_GET['order_id'];
// $order_details = $myCategory->getOrderDetails(accNum,$order_id);

//  if(count($order_details)){

//     foreach ($order_details as $od) { 
//        // print_r($od);
//     }
//   }

?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">

  function close_modal() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
      }

  function view_order_details(order_id)
  {
    $.post("ajax.php?action=getOrderDetails&order_id="+order_id,{},
        function (data1){
          // alert(data1);
          data = $.parseJSON(data1);
          
          var item_list = "";

          var order_details = data['order_details'];

          $(".order_number").text(order_details['order_id']);
          $(".order_created_on").text(order_details['created_at']);
          $(".payment_type").text(order_details['payment_type']);

          var items = order_details['items'];
          var total_price = 0;
             
          for(var i =0; i<items.length; i++)
          {
            p=i+1;
            item_list+= '<tr class="cart__row border-bottom line1 cart-flex border-top"><td class="cart__image-wrapper cart-flex-item"><b>'+p+'</b></td><td class="cart__image-wrapper cart-flex-item">'+items[i]['menuName']+'</td><td class="cart__image-wrapper cart-flex-item">'+items[i]['itemName']+'</td><td class="cart__update-wrapper cart-flex-item product-quantity">'+items[i]['quantity']+'</td><td class="cart__update-wrapper cart-flex-item product-quantity">'+items[i]['price']+'</td></tr>';

            total_price = Number(total_price)+Number(items[i]['price']);
          }

          item_list+='<tr class="cart__row border-bottom line1 cart-flex border-top"><td class="cart__image-wrapper cart-flex-item"><b>Total Price</b></td><td class="cart__image-wrapper cart-flex-item"></td><td class="cart__image-wrapper cart-flex-item"></td><td class="cart__update-wrapper cart-flex-item product-quantity"></td><td class="cart__update-wrapper cart-flex-item product-quantity">'+total_price+'</td></tr>';

          $("#order_items_list").html(item_list);

          $('#myModal').fadeIn();
          $('#myModal').addClass("in");

    });
  }

  function invoice_download(order_id){
    $.post("ajax.php?action=download_invoice&order_id="+order_id,{},
        function (data1){
          alert(data1);
        });

  }
</script>

  <style type="text/css">

    body{
      width: 100%;
      float: left;
    }

    .typeheader-2 .header-bottom {
        border-bottom: none;
    }
    .cart-flex-item{
      text-align: center;
    }
  
     table {
         width:100%;
      }
      
      th {
          font-family: "Montserrat", sans-serif;
          font-weight: 700;
      }
      th, td {
          text-align: left;
          padding: 10px 10px;
      }
      .cart__header {
          background: #ddd;
          border: 1px solid #ddd;
      }
      .border-bottom {
          border-bottom: 1px solid #f2f2f2;
      }
      .cart__image-wrapper {
        display: table-cell;
        width: 150px;
    }
    .total_td{
      border: 1px solid #ddd;
      background: #ddd;
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
                        <h1 class="mb-0">Order History</h1>

                    </div>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="page-content">
            <div class="container">

              <div class="row">
                <div id="content" class="col-md-12 col-sm-12">
                    <div class="products-category">
                       <div class="page-width" data-section-id="cart-template" data-section-type="cart-template">
                            <table style="border: 1px solid #ddd;" id="cart_list_items" class="form-group">
                              <thead class="cart__row cart__header">
                                <tr>
                                  <th class="product-info">SN.</th>
                                  <th class="product-info">Order Number</th>
                                  <th class="product-quantity">Payment Via</th>
                                  <th class="product-price">Status</th>
                                  <th class="product-price">Placed on</th>
                                  <th class="product-remove">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                               
                                  
                                </tbody>
                            </table>
                                
                        
                      </div>
                        
                    </div>
                    
                </div>
              </div>  
            </div>
        </div>
      </div>
      
      <!-- //Header Container  -->
<div id="myModal" class="modal" role="dialog" style="z-index: 99999;height:100%;background-color: rgba(0, 0, 0, 0.23);">
  <div class="modal-dialog" style="height: auto;overflow: scroll;">
    <!-- Modal content-->
    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" onclick="close_modal()" data-dismiss="modal">&times;</button>

        <h4 class="modal-title"></h4>

        <div class="col-md-12">

          <h2 class="modal-title"> Order Number : #<span class="order_number"> </span> </h2>
          <p style="margin-bottom: 0;"> Order Placed on : <span class="order_created_on"> </span></p>
          <p > Payment Type : <span class="payment_type"></span></p>

        </div>

      </div>

      <div class="modal-body">

                <p class="ingredients">

                  <span class="ingre" id='inline_ingredients'>Items</span></p>

                  <table style="margin-bottom: 0;" id="cart_list_items" class="form-group">
                          <thead class="cart__row cart__header">
                            <tr>
                                <th class="product-info">SN.</th>
                                <th class="product-info">Product</th>
                                <th class="product-info">Item</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-price">Price</th>
                              
                              <input type="hidden" id= "row_counter" value="<?php echo count($getCartItems);?>">
                            </tr>
                          </thead>
                          <tbody id="order_items_list">
                                    <tr>
                                        <td colspan="4"> No Item In Cart</td>
                                    </tr>
                                                              
                            </tbody>
                        </table> 
      </div>

    </div>
  </div>
</div>

 <?php Include 'footer.php'; ?>

 <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

      <script type="text/javascript">
        
        $(document).ready(function() {
          $('#cart_list_items').DataTable({
              "ajax":{
                  url :"ajax.php?action=getOrders", // json datasource
                  type: "GET",  // type of method  , by default would be get
                  error: function($res){  // error handling code
                    // alert($res);
                    //  console.log(Object($res));
                  }
                }
            });
        });
      </script>