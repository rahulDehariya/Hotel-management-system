
<?php 
// require_once "getdata/data.php";
require_once "header.php";
// $myCategory = new Category();
if(!isset($_SESSION) || $_SESSION['user_id'] <= 0){
  header("Location:login.php");
}

$user_id = $_SESSION['user_id'];

//print_r($_SESSION);

// echo "http://hotel.staffstarr.com/ajax.php?action=getUserDetails&user_id=".$user_id;die;

$getuser_details = file_get_contents("http://hotel.staffstarr.com/ajax.php?action=getUserDetails&user_id=".$user_id);

$user_details=json_decode($getuser_details,true);

// print_r($user_details);
//$user_details = $myCategory->getUserDetails(accNum,$user_id);
?>

<style type="text/css">

    

          .modal-header{

            width: 100%;

            float: left;

          }

          .modal-content{

            width: 100%;

            float: left;

              border: none;

          }



          .modal-body{

            width: 100%;

            float: left;

          }

          


      </style>

   <div id="content">

        <!-- Page Title -->
        <div class="page-title bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 push-lg-4">
                        <!-- <h1 class="mb-0">Menu Grid</h1>
                        <h4 class="text-muted mb-0">Some informations about our restaurant</h4> -->
                        <h1 class="mb-0">User Profile</h1>

                    </div>
                </div>
            </div>
        </div>
        

        <div class="header-bottom hidden-compact">

        <div class="container" style="margin-top: 15px; margin-bottom: 15px;">

          <div class="row">

            <div class="col-md-2 col-sm-1">
             
            </div>
        
            <div id="content" class="col-md-8 col-sm-9" style="padding: 15px" >
                <div class="products-category">
                   <div class="page-width" data-section-id="cart-template" data-section-type="cart-template">
                     

                      <form action="javascript:void(0);" method="post" class="cart" id="profile_form">
                        <br> 
                        <!-- <input type="hidden" name="token" id="token" value="<?php //echo $_GET['user_token'];?>"> -->
                        <div class="form-group">
                          <div class="col-md-12">
                            <label for="Description" >Name:</label> 
                          </div>
                          <div class="col-md-12">
                            <input  class="form-control" type="text" name="user_name" id="clientName" value="<?php echo $user_details['username']; ?>" required>
                            <p id="user_name_err" style="display: none; color: red;">Please enter your name</p>
                          </div>
                        </div>
                          
                        <div class="form-group">
                          <div class="col-md-12">
                            <label for="Description" >Email:</label> 
                          </div>
                          <div class="col-md-12">
                            <input  class="form-control" type="email" name="email" id="email" value="<?php echo $user_details['email']; ?>" readonly required>
                          <p id="email_err" style="display: none; color: red;">Please enter email</p>
                          
                          </div>
                        </div>
                          

                        <div class="form-group">
                          <div class="col-md-12">
                            <label for="Description" >Mobile:</label> 
                          </div>
                          <div class="col-md-12">
                            <input  class="form-control" type="text" name="mobile" id="mobile" value="<?php echo $user_details['mobile']; ?>" required>
                            <p id="mobile_err" style="display: none; color: red;">Please enter mobile number</p>
                            
                          </div>
                        </div>
                          

                        <div class="form-group">
                          <div class="col-md-12">
                            <label for="Description" >Billing Address:</label> 
                          </div>
                          <div class="col-md-12">
                            <input type="hidden" name="user_id" id="user_id" value="<?php  echo $user_id ; ?>">
                            <input type="hidden" name="country" id="country" value="<?php echo $user_details['country']; ?>">
                            <input type="hidden" name="city" id="locality" value="<?php echo $user_details['city']; ?>">
                            <input type="hidden" name="state" id="administrative_area_level_1" value="<?php echo $user_details['state']; ?>">
                            <input type="hidden" name="zip" id="postal_code" value="<?php echo $user_details['zip']; ?>">
                            <input type="hidden" name="lat" id="hidden_lat" value="<?php echo $user_details['latitude']; ?>">
                            <input type="hidden" name="long" id="hidden_long" value="<?php echo $user_details['longitude']; ?>">
                            <input type="hidden" name="street_number" id="street_number" value="<?php echo $user_details['address1']; ?>">
                            <input type="hidden" name="route" id="route" value="">
                            <input type="hidden" name="recent_delivery_address" id="hidden_recent_delivery_address" value="<?php echo $user_details['recent_delivery_address']; ?>">

                            <!-- <input  class="form-control" type="password" name="b_address" id="b_address" value="" required> -->

                            <textarea class="form-control" rows="1" name="address" id="address" placeholder="Enter your billing address" onFocus="geolocate()"><?php echo $user_details['address']; ?></textarea>

                            <p id="b_address_err" style="display: none; color: red;">Please enter billing address</p>
                            
                          </div>
                        </div>
                          

                        <div class="form-group">
                          <div class="col-md-12" >
                            

                            <a href="javascript:void(0)" onclick="update_profile()">
                            <p style="margin-top: 20px;padding: 10px;color: white;background-color: #171717;margin-bottom: 20px;width: 100;text-align: center;">
                              <b>Update Profile</b>
                            </p>
                            </a>
                            
                          </div>
                        </div>
                              
                    </form>
                    
                  </div>
                    
                </div>
                
            </div>
 <div class="col-md-2 col-sm-1"></div>
            
          </div>

        </div>

      </header>

      <!-- //Header Container  -->

<!-- Main Container  -->
      </div>

      <!-- //Main Container -->

     

<!-- Footer Container -->


<script type="text/javascript">

  function imgError(image) {
    image.onerror = "";
    image.src = "assets/images/no_image.png";
    return true;
}


    function readURL(input) {
        

        var file_data = $('#profile_pic').prop('files')[0];

        var form_data = new FormData();
        form_data.append("file", file_data);

        $.ajax({
        url: 'ajax_autopart.php?action=updateProfilePic', // point to server-side PHP script 
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(response){
            //alert(response); // display response from the PHP script, if 

            if(response == 1){

              if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function (e) {
                  $('#blah').attr('src', e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
            }
              swal("Profile picture updated successfully", "", "success");
          }else{
              swal("Warning", "Something went wrong. Please try again later", "error");
            }
        }
     });
    }

  function update_profile (){
    $.ajax({
      type: 'POST',
      url: 'ajax.php?action=updateProfile',
      data: $('#profile_form').serializeArray(),
      success: function (response) {
        //alert(response);
        swal("Profile updated successfully", "", "success");
      }

    });
  }
</script>

      <?php Include 'footer.php'; ?>

      <script src="https://maps.googleapis.com/maps/api/js?sensor=false&region=au&key=AIzaSyAK4boX_o6ArPMYqO3vbwniRIA3iYUOMGI&libraries=places,geometry&callback=initAutocomplete" async defer></script>

<script>


var placeSearch, autocomplete;

var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

function initAutocomplete() {
  // Create the autocomplete object, restricting the search predictions to
  // geographical location types.

   var options = {
types: ['geocode'],
componentRestrictions: {country: 'au'}
};

  autocomplete = new google.maps.places.Autocomplete(
  document.getElementById('address'), options);


  // Avoid paying for data that you don't need by restricting the set of
  // place fields that are returned to just the address components.
  autocomplete.setFields(['address_component']);

  autocomplete.setComponentRestrictions({'country': ['au']});
  // When the user selects an address from the drop-down, populate the
  // address fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);


}

function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    console.log(component);
     document.getElementById(component).value = '';
     document.getElementById(component).disabled = false;
  }

  // alert(place);
  // console.log(Object(place));

  var place_address_components = place.address_components;

  // Get each component of the address from the place details,
  // and then fill-in the corresponding field on the form.
  for (var i = 0; i < place_address_components.length; i++) {
    var addressType = place_address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place_address_components[i][componentForm[addressType]];

      //alert(addressType);
      document.getElementById(addressType).value = val;

      if(addressType == "postal_code")
      {
        address_str = document.getElementById('address').value;
        if(address_str.indexOf(val) != -1){
        }else{
          document.getElementById('address').value = document.getElementById('address').value + ", " + val;
        }
      }
    }
  }

  if (!place.geometry) {
      return;
    }
    // console.log(place.geometry.location.lat());
    // alert(place.geometry.location.lat());
    document.getElementById('hidden_lat').value = place.geometry.location.lat();
    document.getElementById('hidden_long').value = place.geometry.location.lng();
  //geolocate();
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {

      var latitude = position.coords.latitude;
      var longitude = position.coords.longitude;
      // alert(latitude);
      // alert(longitude);

      var geolocation = {
        lat: latitude,
        lng: longitude
      };

      document.getElementById('hidden_lat').value = latitude;
      document.getElementById('hidden_long').value = longitude;

      var circle = new google.maps.Circle(
          {center: geolocation, radius: position.coords.accuracy});
      autocomplete.setBounds(circle.getBounds());
    });
  }
}
</script>