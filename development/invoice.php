<?php
// require_once "getdata/data.php";

// $myCategory = new Category();


$order_id = $_GET['order_id'];


$order_details_json = file_get_contents("http://hotel.staffstarr.com/ajax.php?action=getOrderDetails&order_id=".$order_id);


// $order_details_json = $myCategory->getOrderDetails(accNum,$order_id);

$order_details = json_decode($order_details_json,true);

$contactDetails_json = file_get_contents("http://hotel.staffstarr.com/ajax.php?action=getContactDetails");

$contactDetails = json_decode($contactDetails_json,true);

// print_r($contactDetails);die;
//$contactDetails = //$myCategory->getContactDetails(accNum);
//print_r($order_details);
?>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Fjalla+One|Grenze|Roboto+Condensed&display=swap" rel="stylesheet">
<!------ Include the above in your HEAD tag ---------->

<style type="text/css">
    
    table {
        font-size: 14px;
    }

    strong{
        font-weight: 600;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="invoice-title">

                <div class="row" style="width:100%;float: left;">

                <div class="logo " style="width: 50%;display: inline-block;float: left;">
                    <p style="font-size: 28px;margin-bottom: 0;margin-top:-5px;color: #ff2d37;font-family: 'Grenze', serif;    padding: 0px 0px 15px;    width: 200px;">
                        <img src="http://hotel.staffstarr.com/assets/img/logo-dark.png" class="img-2 img-responsive" alt="image2" style="width: 100px;">
                     </p>

                    <p style="margin: 0;">ABN : <?php echo $contactDetails['abn']; ?> </p>
                    <p style="margin: 0;">Email : <?php echo $contactDetails['email']; ?> </p>
                    <p style="margin: 0;">Contact : <?php echo $contactDetails['mobile']; ?> </p>
                    

                </div>
                <div class="" style="text-align: right;width: 50%;display: inline-block;float: right; ">
                    <!-- <p style="font-size: 28px;margin-bottom: 0;padding-top: 6px;font-family: 'Grenze', serif;">
                    </p> -->
                    <h3 style="margin-top: 25px;">INVOICE NO. : #<?php echo $order_details['order_details']["order_id"]; ?></h3>
                    <p style="margin: 0;">Address : 
                    <?php $company_addess = $contactDetails["address"]; 
                                echo $company_addess."<br>";
                             ?>
                            </p>
                    
                </div>
                </div>

                <!-- <h2>Invoice</h2> -->


                <!-- <h3 class="pull-right">Invoice No. : #<?php //echo $order_details['order_details']["order_id"]; ?></h3> -->
            </div>
            <hr>
            <div class="row" style="width:100%;">
                <div style="width: 50%;display: inline-block;float: left; ">
                    <p style="font-weight:bold;margin-bottom: 0;"><span >Billed To:</span></p>
                        <?php echo $order_details['order_details']["username"]; ?><br>
                        <?php $address = $order_details['order_details']["address1"]; 
                                echo $address."<br>";
                                 echo ($order_details['order_details']["city"]!="" ? $order_details['order_details']["city"].", " : ""). ($order_details['order_details']["zip"]!="" ? $order_details['order_details']["zip"]."<br>" : ""); 
                                echo ($order_details['order_details']["state"]!="" ? $order_details['order_details']["state"].", " : ""). $order_details['order_details']["country"]."<br>"; 
                                
                             ?>
                        
                </div>
                <div style="width: 50%;display: inline-block;float: right;text-align: right; ">
                    <p style="font-weight:bold;margin-bottom: 0;"><span >Shipped To:</span></p>
                        <?php echo $order_details['order_details']["username"]; ?><br>
                        <?php $address = $order_details['order_details']["address1"]; 
                                echo $address."<br>";
                                echo ($order_details['order_details']["city"]!="" ? $order_details['order_details']["city"].", " : ""). $order_details['order_details']["zip"]."<br>"; 
                                echo ($order_details['order_details']["state"]!="" ? $order_details['order_details']["state"].", " : ""). $order_details['order_details']["country"]."<br>"; 
                                
                             ?>
                    </address>
                </div>
            </div>
            <div class="row" style="width:100%; margin-top: 5%; margin-bottom: 2%;">
                <div style="width: 50%;display: inline-block;float: left; ">
                    <p style="font-weight:bold;margin-bottom: 0;"><span >Payment Method:</span></p>
                        Visa ending **** 4242<br>
                        jsmith@email.com
                </div>
                <div style="width: 50%;display: inline-block;float: right;text-align: right; ">
                    <p style="font-weight:bold;margin-bottom: 0;"><span >Order Date:</span></p>
                        <?php echo (date("d M Y h:i A",strtotime($order_details['order_details']["created_at"]))); ?><br><br>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row" style="width: 100%;float: left;margin-top: 5%;">
        <div class="col-md-12" style="padding: 0;">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><p style="font-weight:bold;margin-bottom: 0;"><span >Order summary</span></p></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <td style="padding: 5px;"><p style="font-weight:bold;margin-bottom: 0;"><span >S No.</span></p></td>
                                    <td style="padding: 5px;"><p style="font-weight:bold;margin-bottom: 0;"><span >Part Number</span></p></td>
                                    <td style="padding: 5px;"><p style="font-weight:bold;margin-bottom: 0;"><span >Product</span></p></td>
                                    <!-- <td style="padding: 5px;"><strong>Description</strong></td> -->
                                    <td class="text-center"><p style="font-weight:bold;margin-bottom: 0;"><span >Quantity</span></p></td>
                                     <!-- <td class="text-center"><strong>Unit Net Price</strong></td> -->
                                    <td class="text-right"><p style="font-weight:bold;margin-bottom: 0;"><span >Total</span></p></td>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- foreach ($order->lineItems as $line) or some such thing here -->

                            <?php  $i = $total = 0 ; 

                            if(count($order_details['order_details']['items']) > 0){


                              foreach ($order_details['order_details']['items'] as $CartItems) { 
                                //$cart_details = $order_details['order_details'];

                                //print_r($CartItems);

                                $total+=$CartItems['price'];
                                $i++;

                                
                                ?>
                                <tr>
                                    <td ><?php echo $i; ?></td>
                                    <td><?php echo ($CartItems['Calories']!='' ? $CartItems['Calories'] : 'NA'); ?></td>
                                    <td><?php echo $CartItems['menuName']; if($CartItems['itemName'] != "" ) { ?> <br> (<?php echo $CartItems['itemName']; ?>) <?php } ?> </td>
                                    <!-- <td><?php echo ($CartItems['description']!='' ? $CartItems['description'] : 'NA'); ?></td> -->
                                    <td class="text-center"><?php echo $CartItems['quantity']; ?></td>
                                    <!-- <td class="text-center">$10.99</td> -->
                                    <td class="text-right">$<?php echo number_format($CartItems['price'],2); ?></td>
                                </tr>
                            <?php } } else{ ?>
                              <tr>
                                <td  colspan="5">You don't have anything in your cart</td>
                                
                              </tr>

                           <?php  } ?>
                                
                                <tr>
                                    <td class="thick-line"></td>
                                    <!-- <td class="thick-line"></td> -->
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line text-center" style="padding: 2%;"><p style="font-weight:bold;margin-bottom: 0;"><span >Total</span></p></td>
                                    <td class="thick-line text-right" style="padding: 2%; padding-right: 0;">

                                        <p style="font-weight:bold;margin-bottom: 0;"><span >$<?php echo number_format($total,2); ?></span></p>
                                        </td>
                                </tr>
                                <!-- <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Shipping</strong></td>
                                    <td class="no-line text-right">$15</td>
                                </tr>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Total</strong></td>
                                    <td class="no-line text-right">$685.99</td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>