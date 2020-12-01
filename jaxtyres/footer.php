

      <?php 
      
  include_once 'config/config.php';
  
 $HTTP_HOST='http://hotel.staffstarr.com/jaxtyres/';

      // $myCategory = new Category();

       $contactDetails_json=file_get_contents($HTTP_HOST."ajax_autopart.php?action=getContactDetails");
      $contactDetails=json_decode($contactDetails_json,true);
      // $contactDetails = $myCategory->getContactDetails(accNum); 

      ?> 
      <footer class="section footer-classic context-dark bg-image" style="background: #0d0d0d;">
        <div class="container">
    <!-- <div class="row" style="padding:15px;"> -->
    <div class="row" style="padding:15px;">
      <div class="col-md-6 col-sm-6">
         <h4 style="color: white;font-weight: 600;margin-bottom: 0;">Contact us</h4>
         <table style="color: white;">
           <tr>
             <td style="padding-right: 10px;"><i class="fa fa-envelope"></i> : &nbsp;<a href="mailto:<?php echo $contactDetails['email']; ?>" ><?php echo $contactDetails['email']; ?></a></td>
             <td style="padding-right: 10px;" title="ABN"><i class="fa fa-building-o"></i> : &nbsp;<!-- <a href="tel:<?php echo $contactDetails['phone']; ?>" style="color: #c39729"> <?php echo $contactDetails['phone']; ?></a>, --> <a> <?php echo $contactDetails['abn']; ?> </a></td>
             <td></td>
           </tr>
           <!-- <tr>
             <td style="padding: 0;"><i class="fa fa-phone"></i> :  -->&nbsp;<!-- <a href="tel:<?php echo $contactDetails['phone']; ?>" style="color: #c39729"> <?php echo $contactDetails['phone']; ?></a>, --><!-- <a href="tel:<?php echo $contactDetails['mobile']; ?>" > <?php echo $contactDetails['mobile']; ?></a></td> -->
           </tr>
         </table>
         <!--  <ul class="list-unstyled" style="color: white;">
            <li><a href="#"></a></li>
            <li>EMAIL :<a href="mailto:info@abc.com.au">info@abc.com.au</a></li>
            <li>TELEPHONE :<a href="tel:+1231231231"> 123 1234 1234</a></li>
           
          </ul> -->
      </div>
      <div class="col-md-3"></div>
      <div class="col-md-3" style="text-align: left;color: white;display:none;">
        <h4>Follow Us</h4>
            <div class="sqs-svg-icon--outer social-icon-alignment-center social-icons-color-white social-icons-size-extra-large social-icons-shape-circle social-icons-style-solid" >
      <nav class="sqs-svg-icon--list" style="text-align: left;">
        <a href="http://instagram.com/laserengravingservicelondon" target="_blank" class="sqs-svg-icon--wrapper instagram">
          <div>
            <svg class="sqs-svg-icon--social" viewBox="0 0 64 64">
              <use class="sqs-use--icon" xlink:href="#instagram-icon"></use>
              <use class="sqs-use--mask" xlink:href="#instagram-mask"></use>
            </svg>
          </div>
        </a><a href="https://www.facebook.com/laserengravingservicelondon/" target="_blank" class="sqs-svg-icon--wrapper facebook">
          <div>
            <svg class="sqs-svg-icon--social" viewBox="0 0 64 64">
              <use class="sqs-use--icon" xlink:href="#facebook-icon"></use>
              <use class="sqs-use--mask" xlink:href="#facebook-mask"></use>
            </svg>
          </div>
        </a><a href="mailto:info@laserengravingservice.co.uk" target="_blank" class="sqs-svg-icon--wrapper email">
          <div>
            <svg class="sqs-svg-icon--social" viewBox="0 0 64 64">
              <use class="sqs-use--icon" xlink:href="#email-icon"></use>
              <use class="sqs-use--mask" xlink:href="#email-mask"></use>
            </svg>
          </div>
        </a>
      </nav>
    </div>
      </div>
    </div>
  </footer>

    <!-- //end Footer Container -->

      </div>

      <!-- Include Libs & Plugins

         ============================================ -->

      <!-- Placed at the end of the document so the pages load faster -->

      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/jquery-2.2.4.min.js.download"></script>

      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/bootstrap.min.js.download"></script>

      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/owl.carousel.js.download"></script>

      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/slick.js.download"></script>

      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/libs.js.download"></script>

      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/jquery.unveil.js.download"></script>

      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/jquery.countdown.min.js.download"></script>

      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/jquery.dcjqaccordion.2.8.min.js.download"></script>

      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/moment.js.download"></script>

      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/bootstrap-datetimepicker.min.js.download"></script>

      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/jquery-ui.min.js.download"></script>

      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/modernizr-2.6.2.min.js.download"></script>

      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/jquery.miniColors.min.js.download"></script>

      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/lightslider.js.download"></script>

      <!-- Theme files

         ============================================ -->

      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/application.js.download"></script>

      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/homepage.js.download"></script>

      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/toppanel.js.download"></script>

      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/so_megamenu.js.download"></script>

      <script type="text/javascript" src="./Autoparts - Multipurpose Responsive HTML5 Template_files/addtocart.js.download"></script>