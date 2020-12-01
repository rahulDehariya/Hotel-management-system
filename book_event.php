  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" type="text/css" media="screen" /> -->
<?php
    require_once "header.php";

  // require_once "getdata/data.php"; 
  //  $myCategory = new Category();
   
   /*$data_Cat = $myCategory->getCategoriesTree(accNum);
   if(isset($_GET['test']))
   {
       echo '<pre>';
       print_r($data_Cat);
       die;
    }

    //print_r($_SESSION);
    $cat_id= 17;
    if(isset($_GET['id']))
    {
        $cat_id = $_GET['id'];
    }
    $product_data = $myCategory->getMenuItems(accNum,$cat_id);
    if(isset($_GET['test1']))
    {
        echo '<pre>';
        print_r($product_data);
        die;  
    }*/

    $guest_id = $_SESSION['guest_id'];

    // $getCartItems = $myCategory->getCartItems(accNum,$guest_id);

    //print_r($getCartItems);

    $address = array();
    $clientName = "";
    $email = "";
    $mobile = "";

    //echo $_SESSION['user_id'];
    if(isset($_SESSION['user_id'])){

        $user_id = $_SESSION['user_id'];

        $userDetails_json=file_get_contents("http://hotel.staffstarr.com/ajax.php?action=getUserDetails&user_id=".$user_id);
        $getUserDetails=json_decode($userDetails_json,true);

          $userAddr_json=file_get_contents("http://hotel.staffstarr.com/ajax.php?action=getUserAddress&user_id=".$user_id);
           $getUserAddress=json_decode($userAddr_json,true);

        // $getUserDetails = $myCategory->getUserDetails(accNum,$user_id);
        // $getUserAddress = $myCategory->getUserAddress($user_id);

        //print_r($getUserDetails);
        $address = $getUserAddress;
        $clientName = $getUserDetails['username'];
        $email = $getUserDetails['email'];
        $mobile=$getUserDetails['mobile'];
    }

    $eventId = '';
    $username = $clientName;
    $venue = '';
    $date_event = '';
    $no_of_people = '';
    $time_from = '';
    $time_to = '';
    $user_id = '';
    if(isset($_GET['token']))
    {
      $token = $_GET['token'];


        $eventItems_json=file_get_contents("http://hotel.staffstarr.com/ajax.php?action=getEventItems&user_id=".$user_id);
        $eventItems_Arr=json_decode($eventItems_json,true);
      // $eventItems_Arr = $myCategory->getEventItems(accNum,$eventId,$token);
      $eventId = $eventItems_Arr['id'];
      $username = $eventItems_Arr['username'];
      $email = $eventItems_Arr['email'];
      $mobile = $eventItems_Arr['mobile'];
      $venue = $eventItems_Arr['venue'];
      $date_event = $eventItems_Arr['date'];
      $no_of_people = $eventItems_Arr['no_of_people'];
      $time_from = $eventItems_Arr['time_from'];
      $time_to = $eventItems_Arr['time_to'];
      $user_id = $eventItems_Arr['user_id'];
    }

    $_SESSION['accNum1'] = accNum;

   ?>





<style type="text/css">

  /*@font-face{font-family:'Glyphicons Halflings';src:url(//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/fonts/glyphicons-halflings-regular.eot);src:url(//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/fonts/glyphicons-halflings-regular.eot?#iefix) format('embedded-opentype'),url(//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/fonts/glyphicons-halflings-regular.woff2) format('woff2'),url(//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/fonts/glyphicons-halflings-regular.woff) format('woff'),url(//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/fonts/glyphicons-halflings-regular.ttf) format('truetype'),url(//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/fonts/glyphicons-halflings-regular.svg#glyphicons_halflingsregular) format('svg')}*/

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
    .OutOfStock{
      opacity: 0.5;
    }

    .cancel{
      display: inline-block !important;
    }

    .glyphicon {
      display: inline-block;
      font: normal normal normal 14px/1 FontAwesome;
      font-size: inherit;
      text-rendering: auto;
      -webkit-font-smoothing: antialiased;
    }

    .glyphicon-chevron-up:before {
      content: "\f106";
    }
    .glyphicon-chevron-down:before {
      content: "\f107";
    }


</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css">

<script type="text/javascript">

  // $(document).ready(function()
  // {
  //   alert(11);
  //   $(".glyphicon-chevron-up").addClass("fa fa-angle-up"); 
  //   $(".glyphicon-chevron-down").addClass("fa fa-angle-down"); 
  // });


  function cart_confirmed()
  {
    var row_counter_items = $("#row_counter_i").val();

    if(row_counter_items > 0)
    {
      for(var p = 0; p < row_counter_items; p++)
      {
        k = p+1;
        is_stock = $("#is_stock_"+k).val();
        //alert(is_stock);
        if(is_stock == 0)
        {
          cart_id = $("#cart_id_"+k).val();

          $.post("ajax.php?action=removeCartItems&cartId="+cart_id,{},
            function (data) {
            });
        }
      }
    }

    //return false;

    var address = $("#address").val();
    var name = $("#clientName").val();
    var email = $("#email").val();
    var mobile = $("#mobile").val();
    var err = 0;

    var cart_items = $("#row_counter").val();
    //alert(cart_items);
    //err = 1;
    if(cart_items <= 0){
      err = 1;
      swal("Warning", "You have empty cart!", "warning");
      return false;

    }

    if($('#select_address').length && $('#select_address').val().length){

      //alert("true");

    }else{
      if(address == '' )
      {
        err = 1;
        $("#address_err").show();
      }else{
         $("#address_err").hide();
      }
    }
  
    if(name == '' )
    {
      err = 1;
      $("#clientName_err").show();
    }else{
       $("#clientName_err").hide();
    }
    if(email == '' )
    {
      err = 1;
      $("#email_err").show();
    }else if ( !validateEmail(email))
    {
      err = 1;
      $("#email_err").hide();
      $("#email_err2").show();
    }else{
      $("#email_err").hide();
      $("#email_err2").hide();
    }
    if(mobile == '' )
    {
      err = 1;
      $("#mobile_err").show();
    }else{
       $("#mobile_err").hide();
    }

    //var payment_type = $("input[name='payment_type']:checked").size();
    //alert(payment_type);

    payment_type = 'COD';

    if(payment_type == 0)
    {
      err = 1;
      $("#payment_type_err").show();
    }else{
       $("#payment_type_err").hide();
    }

    var accNum = <?php echo accNum; ?> ;


    if(err == 0){
      $.ajax({

          type: 'POST',
          url: 'ajax.php?action=confirmCart',
          data: $('#cart_block').serializeArray(),
          success: function (response) {
             // alert(response);
             // console.log(response);

            var payment_type = $("input[name='payment_type']:checked").val();
            if(payment_type == "CC"){
             // swal("Good job!", "Proceed Payment", "success");

              var obj_data = JSON.parse(response);

              window.location.href = "https://autohubsolutions.com.au/Pay/P/checkout.php?order_id="+obj_data['order_id']+"&total="+obj_data['total_price']+"&email="+obj_data['email']+"&name="+obj_data['name']+"&address="+obj_data['address']+"&paymenttype=card&accNum="+accNum;
            }else if(payment_type == "POLI"){

                var obj_data = JSON.parse(response);
                window.location.href = "https://autohubsolutions.com.au/polipayment.php?order_id="+obj_data['order_id']+"&amount="+obj_data['total_price'];
            }
            else{

              //var obj_data = JSON.parse(response);
              //window.location.href = "order_success.php?order_id="+obj_data['order_id'];
            }
          }
        });
    }
  }

  function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test( $email );
  }
  
  

    function selected_address()
    {
      var select_address = $("#select_address").val();
      if(select_address != "")
      {
        $("#address").val("");
      }
    }
    function entered_address()
    {
      //alert("inn");
      $("#select_address").val("");
    }
</script>
<!-- Start -->



  <!-- Content -->
    <div id="content">

        <!-- Page Title -->
        <section class="section section-lg bg-dark">

            <!-- Video BG -->
            <div class="bg-video mb_YTPlayer isMuted" data-property="{videoURL:'https://youtu.be/t4gN-iqeY0E', showControls: false, containment:'self',startAt:1,stopAt:39,mute:true,autoPlay:true,loop:true,opacity:0.8,quality:'hd1080'}" id="YTP_1570258947545" style="background-image: none;"><div class="mbYTP_wrapper" id="wrapper_mbYTP_YTP_1570258947545" style="position: absolute; z-index: 0; min-width: 100%; min-height: 100%; left: 0px; top: 0px; overflow: hidden; opacity: 0.8; transition-property: opacity; transition-duration: 2000ms;"><iframe id="mbYTP_YTP_1570258947545" class="playerBox" style="position: absolute; z-index: 0; width: 1535px; height: 1101.3px; top: 0px; left: 0px; overflow: hidden; opacity: 1; user-select: none; margin-top: -146.9px; margin-left: -123px; transition-property: opacity; transition-duration: 1000ms;" frameborder="0" allowfullscreen="1" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" title="YouTube video player" width="640" height="360" src="https://www.youtube.com/embed/t4gN-iqeY0E?autoplay=0&amp;modestbranding=1&amp;controls=0&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1&amp;version=3&amp;playerapiid=mbYTP_YTP_1570258947545&amp;origin=*&amp;allowfullscreen=true&amp;wmode=transparent&amp;iv_load_policy=3&amp;html5=1&amp;widgetid=1" unselectable="on"></iframe><div class="YTPOverlay" style="position: absolute; top: 0px; left: 0px; width: 100%; height: 100%;"></div></div></div>
            <div class="bg-image bg-video-placeholder zooming" style="background-image: url(&quot;assets/img/photos/bg-restaurant.jpg&quot;);"><img src="assets/img/photos/bg-restaurant.jpg" alt="" style="display: none;"></div>
            
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 push-lg-3">
                        <!-- Book a Table -->
                        <div class="utility-box">
                            <div class="utility-box-title bg-dark dark">
                                <div class="bg-image" style="background-image: url(&quot;assets/img/photos/modal-review.jpg&quot;);"><img src="assets/img/photos/modal-review.jpg" alt="" style="display: none;"></div>
                                <div>
                                    <span class="icon icon-primary"><i class="ti ti-bookmark-alt"></i></span>
                                    <h4 class="mb-0">Book Your Event</h4>
                                    <p class="lead text-muted mb-0">Details about your event.</p>
                                </div>
                            </div>
                            <form action="javascript:void(0)" id="event_details" data-validate="" novalidate="novalidate">
                              <input type="hidden" name="eventId" id="eventId" value="<?php echo $eventId; ?>">
                              <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
                                <div class="utility-box-content">
                                    <div class="form-group">
                                        <label>Full Name:</label>
                                        <input type="text" name="name" class="form-control" required="" aria-required="true" id="username" value="<?php echo $username; ?>">
                                        <p class="username_err" style="color: red; display: none;" >Please Enter Name</p>
                                    </div>
                                    <div class="form-group">
                                        <label>E-mail:</label>
                                        <input type="email" name="email" class="form-control" required="" aria-required="true" id="email" <?php echo ($email!='' ? 'readonly' : ''); ?>  value="<?php echo $email; ?>">
                                        <p class="email_err" style="color: red; display: none;" >Invalid Email</p>
                                    </div>

                                    <div class="form-group">
                                        <label>Phone:</label>
                                        <input type="text" name="phone" class="form-control" required="" aria-required="true" id="phone" value="<?php echo $mobile; ?>">
                                         <p class="phone_err" style="color: red; display: none;" >Invalid Phone Number</p>
                                    </div>
                                     <div class="form-group">
                                        <label>venue:</label>
                                        <!-- <input type="text" name="venue" class="form-control" required="" aria-required="true" id="venue" value="<?php echo $venue; ?>"> -->

                                        <select name="venue" class="form-control" required="" aria-required="true" id="venue">
                                          <option value="">Select</option>
                                          <option value="1" <?php echo ($venue == 1 ? "Selected" : ""); ?> >Option 1</option>
                                          <option value="2" <?php echo ($venue == 2 ? "Selected" : ""); ?> >Option 2</option>
                                          <option value="3" <?php echo ($venue == 3 ? "Selected" : ""); ?> >Option 3</option>
                                        </select>
                                         <p class="venue_err" style="color: red; display: none;" >Please Enter venue</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Date:</label>
                                                <input type="date" name="date" class="form-control" required="" aria-required="true" id="date" value="<?php echo ($date_event!= '' ? date("Y-m-d",strtotime($date_event)) : '' ); ?>">
                                                 <p class="date_err" style="color: red; display: none;" >Invalid date</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Attendens:</label>
                                                <input type="number" name="no_of_people" min="1" class="form-control" required="" aria-required="true" id="attendents" value="<?php echo $no_of_people; ?>">
                                                 <p class="attendents_err" style="color: red; display: none;" >Please Enter Attendents </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group bootstrap-timepicker timepicker">
                                                <label>Time From:</label>
                                                <input type="text" name="time_from" class="form-control" required="" aria-required="true" id="time" value="<?php echo $time_from; ?>">
                                                
                                                 <p class="time_err" style="color: red; display: none;" >Please Enter Time </p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Time To:</label>
                                                <input type="text" name="time_to" class="form-control" required="" aria-required="true" id="time_to" value="<?php echo $time_to; ?>">
                                                <p class="timeto_err" style="color: red; display: none;" >Please Enter Time </p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="utility-box-btn btn btn-secondary btn-block btn-lg btn-submit" type="" onclick="save_data()">
                                    <span class="description">Next</span>
                                   
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                    
        </section>

<!-- end -->

<!-- Footer Container -->
<!-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

 -->

<?php Include 'footer.php'; ?>
<!-- //end Footer Container -->

<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.css"> -->

<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>

<script type="text/javascript">

   $('#time_to').timepicker();
   $('#time').timepicker();

  // $('#time_to').timepicker({
  //     template: false,
  //     showInputs: false,
  //     minuteStep: 5
  // });
  // $('#time').timepicker({
  //     template: false,
  //     showInputs: false,
  //     minuteStep: 5
  // });
	function save_data()
	{
		var is_error=0;
		var name =$("#username").val();
		var email =$("#email").val();
		var phone =$("#phone").val();
		var venue =$("#venue").val();
		var date =$("#date").val();
		var attendents =$("#attendents").val();
		var time =$("#time").val();
	    var time_to =$("#time_to").val();


		if(name=="")
		{
			$("#username").css("border", "1px solid red");
			$(".username_err").show();
			is_error=1;
		}
		else
		{
			$("#username").css("border", "1px solid #e3e9ef");
			$(".username_err").hide();
		}
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if(!regex.test(email))
		{
			$("#email").css("border", "1px solid red");
			$(".email_err").show();
			is_error=1;
		}
		else
		{
			$("#email").css("border", "1px solid #e3e9ef");
			$(".email_err").hide();
		}
		phone = phone.replace(/[^0-9]/g,'');
        // if(phone.length != 10)
        // {
        //     $("#phone").css("border", "1px solid red");
        // 	$(".phone_err").show();
        // 	is_error=1;
        // }
        // else
        // {
        // 	$("#phone").css("border", "1px solid #e3e9ef");
        // 	$(".phone_err").hide();
        // }
        if(venue=="")
		{
			$("#venue").css("border", "1px solid red");
			$(".venue_err").show();
			is_error=1;
		}
		else
		{
			$("#venue").css("border", "1px solid #e3e9ef");
			$(".venue_err").hide();
		}
        if(date=="")
		{
			$("#date").css("border", "1px solid red");
			$(".date_err").show();
			is_error=1;
		}
		else
		{
			$("#date").css("border", "1px solid #e3e9ef");
			$(".date_err").hide();
		}
		if(attendents=="")
		{
			$("#attendents").css("border", "1px solid red");
			$(".attendents_err").show();
			is_error=1;
		}
		else
		{
			$("#attendents").css("border", "1px solid #e3e9ef");
			$(".attendents_err").hide();
		}
			if(time =="")
		{

			$("#time").css("border", "1px solid red");
			// alert(time);
			$(".time_err").show();
			is_error=1;
		}
		else
		{
			$("#time").css("border", "1px solid #e3e9ef");
			$(".time_err").hide();
		}
		if(time_to=="")
		{
			$("#time_to").css("border", "1px solid red");
			$(".timeto_err").show();
			is_error=1;
		}
		else
		{
			$("#time_to").css("border", "1px solid #e3e9ef");
			$(".timeto_err").hide();
		}
		//alert(is_error);

		if(is_error==0)
		{
		 // alert(is_error);
			$.ajax({ 
				type: 'POST',
				url: 'ajax.php?action=eventCreate',
				data: $('#event_details').serializeArray(), 
				success: function (response) {
	        	 // alert(response);
          window.location.href= "http://hotel.staffstarr.com/eventsubmit.php?event_id="+response;
	            		
				}
			});
		}
	}
</script>

